<?php

namespace App\Livewire\Page;

use App\Events\OrderStatusUpdated;
use App\Jobs\SendCheckoutEmail;
use App\Models\Cicilan;
use App\Models\Piutang;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.app')]
#[Title('Checkout Product')]
class CheckoutPage extends Component
{
    public Product $product;
    public User $user;

    public int $qty = 1;
    public bool $showError = false;
    public float $price;
    public float $total;
    public float $tax = 0.11;

    public $setCicilan = '2';
    public $start_at;
    public $end_at;

    #[Url(keep: true)]
    public $paymentType = 'tunai';

    public function mount()
    {
        if ($this->paymentType !== 'tunai') {
            $this->paymentType = 'tunai';
        }

        $this->user = Auth::user();
        $this->price = $this->product->price * $this->qty;
        $this->start_at = Carbon::now()->format('Y-m-d');
        $this->end_at = Carbon::now()->addMonths(3)->format('Y-m-d');

        $this->calculateTotal();
    }

    public function hydrate()
    {
        $this->setPaymentType($this->paymentType);
    }

    public function setPaymentType($type)
    {
        if ($type === 'cicilan' && $this->qty <= 5) {
            $this->showError = true;
            session()->flash('error', 'Cicilan hanya tersedia untuk jumlah lebih dari 5.');
            return;
        }
        $this->paymentType = $type;
        session()->forget('error');
    }

    public function checkout()
    {
        try {
            $this->showError = false;

            // Validasi pembayaran cicilan
            if ($this->paymentType === 'cicilan') {
                $this->validate([
                    'start_at' => 'required|date|after_or_equal:' . now()->format('Y-m-d'),
                    'end_at' => 'required|date|after_or_equal:' . Carbon::parse($this->start_at)->addMonths(3)->format('Y-m-d'),
                    'setCicilan' => 'required|integer|min:2|max:12',
                ]);
            } else {
                $this->start_at = null;
                $this->end_at = null;
                $this->setCicilan = null;
            }

            if ($this->qty > $this->product->stock) {
                $this->showError = false;
                session()->flash('error', 'Stok produk tidak mencukupi.');
                return;
            }

            // Transaksi dengan database transaction
            DB::transaction(function () {
                $invoice = "JSX-" . rand(0000, 9999);

                $transaction = Transaction::create([
                    'user_id' => $this->user->id,
                    'product_id' => $this->product->id,
                    'transaction_total' => $this->total,
                    'kode_unik' => $invoice,
                    'jenis_pembayaran' => $this->paymentType,
                    'qty' => $this->qty,
                    'cicilan' => $this->setCicilan ?? null,
                    'awal_tempo' => $this->start_at ?? null,
                    'akhir_jatuh_tempo' => $this->end_at ?? null,
                    'status' => 'pending',
                ]);

                // Simpan data piutang jika pembayaran cicilan
                if ($this->paymentType === 'cicilan') {
                    $piutang = Piutang::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $this->product->id,
                        'user_id' => $this->user->id,
                        'cicilan' => $this->setCicilan ?? null,
                        'awal_tempo' => $this->start_at ?? null,
                        'akhir_jatuh_tempo' => $this->end_at ?? null,
                        'jumlah_piutang' => $this->total,
                        'status' => 'pending',
                    ]);

                    $installmentAmount = $this->total / (int) $this->setCicilan;
                    $installmentInterval = Carbon::parse($this->start_at);

                    $installments = collect(range(1, (int) $this->setCicilan))->map(function ($i) use ($piutang, $installmentAmount, $installmentInterval) {
                        $currentTime = Carbon::now();
                        return [
                            'piutang_id' => $piutang->id,
                            'nomor_cicilan' => $i,
                            'awal_tempo' => $i === 1 ? $this->start_at : $installmentInterval->format('Y-m-d'),
                            'akhir_jatuh_tempo' => $installmentInterval->addMonth()->format('Y-m-d'),
                            'jumlah_cicilan' => $installmentAmount,
                            'status_pembayaran' => 'pending',
                            'created_at' => $currentTime,
                            'updated_at' => $currentTime,
                        ];
                    });

                    Cicilan::insert($installments->toArray());
                }

                $this->product->decrement('stock', $this->qty);
                Log::info('Stok setelah pengurangan: ' . $this->product->stock);
                event(new OrderStatusUpdated($transaction));
            });

            return $this->redirect("/success/{$this->product->slug}", navigate: true);
        } catch (\Exception $th) {
            $this->showError = true;
            session()->flash('error', 'Terjadi kesalahan: ' . $th->getMessage());
            Toaster::error('Validasi Error: ' . $th->getMessage());
        }
    }

    public function increment()
    {
        if ($this->qty < $this->product->stock) {
            $this->qty++;
            $this->calculatePrice();
            $this->showError = false;
        } else {
            session()->flash('error', 'Jumlah produk melebihi stok tersedia.');
            $this->showError = true;
        }
    }

    public function decrement()
    {
        if ($this->qty > 1) {
            $this->qty--;
            $this->calculatePrice();
            $this->showError = false;
        }
    }

    private function calculatePrice()
    {
        $this->price = $this->product->price * $this->qty;
        $this->calculateTotal();
    }

    private function calculateTotal()
    {
        $this->total = $this->price + ($this->price * $this->tax);
    }

    public function render()
    {
        return view('livewire.page.checkout-page');
    }
}
