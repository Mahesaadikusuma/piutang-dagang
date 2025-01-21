<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cicilan extends Model
{
    use HasFactory;
    protected $table = 'cicilans';
    protected $fillable = [
        'piutang_id',
        'nomor_cicilan',
        'awal_tempo',
        'akhir_jatuh_tempo',
        'jumlah_cicilan',
        'status_pembayaran',
    ];

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
