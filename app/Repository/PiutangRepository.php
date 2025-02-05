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
use Illuminate\Database\Eloquent\Collection;

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

    public function getPaginatedPiutang(?string $search, int $limit = 10, $sortBy = 'id', $sortDir = 'DESC')
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
                ->orderBy($sortBy, $sortDir)
                ->paginate($limit);

            if ($search) {
                if ($piutangSearch->isNotEmpty()) {
                    Toaster::success("Data yang dicari ditemukan.");
                } else {
                    Toaster::error("Data yang dicari tidak ditemukan.");
                }
            }

            return $piutangSearch;
        } catch (\Exception $e) {
            Toaster::error('Terjadi kesalahan saat mengambil data: ' . $e->getMessage());
            Log::error('Error in getPaginatedPiutang: ' . $e->getMessage());
            return collect();
        }
    }

    public function getHistoryPiutangByUser(?string $search, int $limit, $sortBy = 'id', $sortDir = 'DESC')
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
                ->orderBy($sortBy, $sortDir)
                ->paginate($limit);

            if ($search) {
                if ($searchHistory->isNotEmpty()) {
                    Toaster::info("Data yang dicari ditemukan.");
                } else {
                    Toaster::error("Data yang dicari tidak ditemukan.");
                }
            }

            return  $searchHistory;
        } catch (Exception $e) {
            Toaster::error('Error search history: ' . $e->getMessage());
            return collect();
        }
    }


    public function getCicilanByPiutang(Piutang $piutang, string $sortBy, string $sortDir): Collection
    {
        return $piutang->cicilans()
            ->orderBy($sortBy, $sortDir)
            ->get();
    }

}
