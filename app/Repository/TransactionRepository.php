<?php

namespace App\Repository;

use App\Interface\TransactionInterface;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Auth;
use Masmerise\Toaster\Toaster;

class TransactionRepository implements TransactionInterface
{
    protected $transactionModel;
    protected $productModel;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->transactionModel = new Transaction();
    }

    public function getAll()
    {
        return $this->transactionModel
            ->with(['user', 'product.category'])
            ->all();
    }

    // public function getPaginatedUsers(?string $search, int $limit)
    // {
    //     return $this->transactionModel
    //         ->with(['user', 'product.category'])
    //         ->when($search, function ($query) use ($search) {
    //             // return $query->where('name', 'like', '%' . $search . '%');
    //             $query->whereHas('product', function ($query) use ($search) {
    //                 $query->where('name', 'like', '%' . $search . '%');
    //             });
    //         })
    //         ->orderBy('id', 'asc')
    //         ->paginate($limit);
    // }    

    public function getPaginatedUsers(?string $search, int $limit = 10, $sortBy = 'id', $sortDir = 'DESC')
    {
        return $this->transactionModel
            ->with(['user', 'product.category'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('kode_unik', 'like', '%' . $search . '%')
                        ->orWhereHas('product', function ($query) use ($search) { 
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                });
            })
            ->orderBy($sortBy, $sortDir)
            ->paginate($limit);
    }

    public function getHistoryByUser(?string $search, int $limit, $sortBy = 'id', $sortDir = 'DESC')
    {
        try {
            $user = Auth::user();
            $searchHistory = $this->transactionModel
                ->with(['user', 'product.category'])
                ->where('user_id', $user->id)
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('kode_unik', 'like', '%' . $search . '%') 
                            ->orWhereHas('product', function ($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%');
                            });
                    });
                })
                ->orderBy($sortBy, $sortDir)
                ->paginate($limit);

            return  $searchHistory;
        } catch (Exception $e) {
            Toaster::error('Error search history: ' . $e->getMessage());
        }
    }

}
