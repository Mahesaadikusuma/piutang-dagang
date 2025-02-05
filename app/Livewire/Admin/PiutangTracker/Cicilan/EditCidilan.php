<?php

namespace App\Livewire\Admin\PiutangTracker\Cicilan;

use App\Enums\StatusType;
use App\Models\Cicilan;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Carbon\Carbon;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;

#[Layout('layouts.dashboard')]
#[Title('Piutang Tracker Cicilan')]
class EditCidilan extends Component
{   
    public Cicilan $cicilan;
    public $showModal = false;

    #[Validate] 
    public $product;
    public $jumlahCicilan;
    public $awalTempo;
    public $akhirJatuhTempo;
    public $statusPembayaran;
    public $tanggalLunas;

    protected function rules()
    {
        return [
            'product' => 'required',
            'jumlahCicilan' => 'required',
            'awalTempo' => ['required', 'date'],
            'akhirJatuhTempo' => ['required', 'date', 'after:awalTempo:'],
            'statusPembayaran' => ['required', new Enum(StatusType::class)],
            'tanggalLunas' => 'nullable|date',
        ];
    }


    public function mount(Cicilan $cicilan)
    {
        $this->product = $cicilan->piutang->product->name;
        $this->jumlahCicilan = $cicilan->jumlah_cicilan;
        $this->awalTempo = $cicilan->awal_tempo;
        $this->akhirJatuhTempo = $cicilan->akhir_jatuh_tempo;
        $this->statusPembayaran = $cicilan->status_pembayaran;
        $this->tanggalLunas = $cicilan->tanggal_lunas;
    }

    public function openModal(){
        $this->showModal = true;
    }   

    public function update()
    {
        try {
            $this->validate();
            if ($this->cicilan->status_pembayaran === StatusType::SUCCESS->value && 
                $this->statusPembayaran !== StatusType::SUCCESS->value) {
                throw new \Exception('Status tidak bisa diubah setelah SUCCESS.');
            }
            $data = [
                'piutang_id' => $this->cicilan->piutang_id,
                'jumlah_cicilan' => $this->jumlahCicilan,
                'awal_tempo' => $this->awalTempo,
                'akhir_jatuh_tempo' => $this->akhirJatuhTempo,
                'status_pembayaran' => $this->statusPembayaran,
                'tanggal_lunas' => $this->tanggalLunas ?? null
            ];
            
            // dd($data);
            $this->cicilan->update($data);
            Toaster::success('Cicilan Telah di Update!');
            $this->dispatch("cicilan-updated");
        } catch (\Exception $e) {
            Log::info('Cicilan Update Error: ' . $e->getMessage());
            Toaster::error('Validasi gagal: ' . $e->getMessage());
        }
    }   

    public function render()
    {
        return view('livewire.admin.piutang-tracker.cicilan.edit-cidilan');
    }
}
