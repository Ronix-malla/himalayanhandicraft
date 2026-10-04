<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'category',
        'category_label',
        'metal',
        'available_metals',
        'price',
        'original_price',
        'rating',
        'reviews_count',
        'badge',
        'image',
        'secondary_image',
        'sizes',
        'description',
        'artisan_notes',
        'in_stock',
        'is_featured',
    ];

    protected $casts = [
        'available_metals' => 'array',
        'sizes' => 'array',
        'is_featured' => 'boolean',
        'price' => 'float',
        'original_price' => 'float',
        'rating' => 'float',
        'reviews_count' => 'integer',
        'in_stock' => 'integer',
    ];

    protected $appends = [
        'categoryLabel',
        'metalKey',
        'availableMetals',
        'originalPrice',
        'reviewsCount',
        'secondaryImage',
        'artisanNotes',
        'inStock',
        'isFeatured',
    ];

    public function getCategoryLabelAttribute()
    {
        return $this->category_label ?? ($this->category === 'rings' ? 'Artisanal Rings' : 'Hand Bangles');
    }

    public function getMetalKeyAttribute()
    {
        return $this->attributes['metal'] ?? 'brass';
    }

    public function getAvailableMetalsAttribute()
    {
        return $this->available_metals ?? [];
    }

    public function getOriginalPriceAttribute()
    {
        return $this->attributes['original_price'] ?? null;
    }

    public function getReviewsCountAttribute()
    {
        return $this->attributes['reviews_count'] ?? 0;
    }

    public function getSecondaryImageAttribute()
    {
        return $this->attributes['secondary_image'] ?? $this->image;
    }

    public function getArtisanNotesAttribute()
    {
        return $this->attributes['artisan_notes'] ?? '';
    }

    public function getInStockAttribute()
    {
        return $this->attributes['in_stock'] ?? 0;
    }

    public function getIsFeaturedAttribute()
    {
        return (bool)($this->attributes['is_featured'] ?? false);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
