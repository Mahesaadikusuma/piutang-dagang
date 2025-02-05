<?php

namespace App\Models;

use App\Enums\StatusType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Piutang extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'product_id',
        'user_id',
        'cicilan',
        'awal_tempo',
        'akhir_jatuh_tempo',
        'jumlah_piutang',
        'status',
    ];

    protected $casts = [
        'akhir_jatuh_tempo' => 'datetime',
        'awal_tempo' => 'datetime',
        'status' => StatusType::class,
    ];

    public function awalTempoFormatted(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => 
                isset($attributes['awal_tempo']) 
                    ? \Carbon\Carbon::parse($attributes['awal_tempo'])->format('d M Y') 
                    : null
        );
    }

    public function akhirJatuhTempoFormatted(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => 
                isset($attributes['akhir_jatuh_tempo']) 
                    ? \Carbon\Carbon::parse($attributes['akhir_jatuh_tempo'])->format('d M Y') 
                    : null
        );
    }

    public function jumlahPiutangFormatted(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) =>
                'Rp. ' . number_format($attributes['jumlah_piutang'], 0, ',', '.')
        );
    }


    /**
     * Get the transaction associated with the Piutang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'id', 'transaction_id');
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

    /**
     * Get the user associated with the Piutang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }


    /**
     * Get all of the cicilans for the Piutang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cicilans(): HasMany
    {
        return $this->hasMany(Cicilan::class, 'piutang_id', 'id');
    }
}
