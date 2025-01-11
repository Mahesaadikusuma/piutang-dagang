<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';

    protected $fillable = [
        'user_id',
        'username',
        'full_name',
        'email',
        'phone_number',
        'address',
        'avatar',
        'is_complete',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
