<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Piutang extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'cicilan',
        'awal_tempo',
        'akhir_jatuh_tempo',
        'jumlah_piutang',
        'status',
    ];


    /**
     * Get the transaction associated with the Piutang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'transaction_id');
    }

    /**
     * Get the product that owns the Piutang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
