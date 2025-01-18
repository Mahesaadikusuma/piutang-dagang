<?php

namespace App\Repository;

use App\Interface\TransactionInterface;
use App\Models\Transaction;

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
        return $this->transactionModel->all();
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

    public function getPaginatedUsers(?string $search, int $limit)
    {
        return $this->transactionModel
            ->with(['user', 'product.category'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('kode_unik', 'like', '%' . $search . '%') // Pencarian di transaksi
                        ->orWhereHas('product', function ($query) use ($search) { // Pencarian di relasi product
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                });
            })
            ->orderBy('id', 'asc')
            ->paginate($limit);
    }

}
