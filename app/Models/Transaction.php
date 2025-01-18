<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'transaction_total',
        'kode_unik',
        'jenis_pembayaran',
        'qty',
        'cicilan',
        'awal_tempo',
        'akhir_jatuh_tempo',
        'status',
    ];

    // /**
    //  * Get the attributes that should be cast.
    //  *
    //  * @return array<string, string>
    //  */
    // protected function casts(): array
    // {
    //     return [
    //         'akhir_jatuh_tempo' => 'datetime',
    //         'awal_tempo' => 'datetime',
    //     ];
    // }

    protected $casts = [
        'akhir_jatuh_tempo' => 'datetime',
        'awal_tempo' => 'datetime',
    ];



    public function getPriceTotalAttribute()
    {
        return 'Rp. ' . number_format($this->transaction_total, 0, ',', '.');
    }

    /**
     * Get the user that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    
    /**
     * Get the product that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
