<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory, Sluggable;
    
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'thumbnail',
        'price',
        'stock',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($product) {
            $product ->slug = SlugService::createSlug($product, 'slug', $product->name);
        });
    }

    // public function getPricedAttribute()
    // {
    //     return 'Rp. ' . number_format($this->price, 0, ',', '.');
    // }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn($value) => 'Rp. ' . number_format($value, 0, ',', '.'),
            set: fn($value) => (int) preg_replace('/[^\d]/', '', $value)
        );
    }

    protected function stock(): Attribute
    {
        return Attribute::make(
            get: fn($value) => number_format($value, 0, ',', '.'),
            set: fn($value) => (int) preg_replace('/[^\d]/', '', $value)
        );
    }

    /**
     * Get the categories that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
