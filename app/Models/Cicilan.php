<?php

namespace App\Models;

use App\Enums\StatusType;
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
        'tanggal_lunas',
    ];

    protected $casts = [
        // 'akhir_jatuh_tempo' => 'datetime',
        // 'awal_tempo' => 'datetime',
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
    
    public function jumlahCicilanFormatted(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) =>
                'Rp. ' . number_format($attributes['jumlah_cicilan'], 0, ',', '.'),
        );
    }

     protected function jumlahCicilan(): Attribute
    {
        return Attribute::make(
            set: fn($value) => (int) preg_replace('/[^\d]/', '', $value)
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
