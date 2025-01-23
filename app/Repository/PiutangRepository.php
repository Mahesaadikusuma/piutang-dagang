<?php

namespace App\Repository;

use App\Interface\PiutangInterface;
use App\Interface\TransactionInterface;
use App\Models\Piutang;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Masmerise\Toaster\Toaster;

class PiutangRepository implements PiutangInterface
{
    protected $piutangModel;
    protected $productModel;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->piutangModel = new Piutang();
    }

    public function getAll()
    {
        return $this->piutangModel
            ->with(['transaction', 'product.category', 'user'])
            ->all();
    }

    public function getPaginatedPiutang(?string $search, int $limit = 10)
    {
        try {
            $piutangSearch = $this->piutangModel
                ->with(['transaction', 'product.category', 'user', 'cicilans'])
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('status', 'like', '%' . $search . '%')
                            ->orWhereHas('transaction', function ($query) use ($search) {
                                $query->where('kode_unik', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('product', function ($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('user', function ($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            });
                    });
                })
                ->orderBy('id', 'desc')
                ->paginate($limit);

            // Jika data kosong
            if ($piutangSearch->isEmpty()) {
                Toaster::error('Data tidak ditemukan.');
                return collect();
            }
            
            return $piutangSearch;
        } catch (\Exception $e) {
            // Tangkap error dan tampilkan notifikasi
            Toaster::error('Terjadi kesalahan saat mengambil data: ' . $e->getMessage());
            Log::error('Error in getPaginatedPiutang: ' . $e->getMessage());
            return collect();
        }
    }

    public function getHistoryPiutangByUser(?string $search, int $limit)
    {
        try {
            $user = Auth::user();
            $searchHistory = $this->piutangModel
                ->with(['transaction', 'product.category', 'user'])
                ->where('user_id', $user->id)
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('status', 'like', '%' . $search . '%') // Pencarian di piutang
                            ->orWhere('transaction', function($query) use ($search) {
                                $query->where('kode_unik', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('product', function ($query) use ($search) { // Pencarian di relasi product
                                $query->where('name', 'like', '%' . $search . '%');
                            });
                    });
                })
                ->orderBy('id', 'desc')
                ->paginate($limit);

            return  $searchHistory;
        } catch (Exception $e) {
            Toaster::error('Error search history: ' . $e->getMessage());
            return collect();
        }
    }

}
