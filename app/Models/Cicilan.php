<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Cicilan extends Model
{
    use HasFactory;
    protected $table = 'cicilans';
    protected $fillable = [
        'piutang_id',
        'transaction_id',
        'nomor_cicilan',
        'awal_tempo',
        'akhir_jatuh_tempo',
        'jumlah_cicilan',
        'status_pembayaran',
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
    
    public function jumlahCicilanFormatted(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) =>
                'Rp. ' . number_format($attributes['jumlah_cicilan'], 0, ',', '.')
        );
    }

    /**
     * Get the piutang that owns the Cicilan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function piutang(): BelongsTo
    {
        return $this->belongsTo(Piutang::class, 'piutang_id');
    }
}
