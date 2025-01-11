<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
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

        static::updating(function ($category) {
            $category ->slug = SlugService::createSlug($category, 'slug', $category->name);
        });
    }

    public function getThumbnailUrl()
    {
        return Str::startsWith($this->thumbnail, ['http://', 'https://']) 
            ? $this->thumbnail 
            : asset(Storage::url($this->thumbnail));
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
