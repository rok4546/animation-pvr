<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'compare_price',
        'stock',
        'sku',
        'stock_quantity',
        'category_id',
        'anime_collection_id',
        'image',
        'images',
        'rating',
        'review_count',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_featured',
        'is_new_arrival',
        'is_active',
        'views_count',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_new_arrival' => 'boolean',
        'is_active' => 'boolean',
        'images' => 'array',
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function animeCollection()
    {
        return $this->belongsTo(AnimeCollection::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Check if product is in stock
     */
    public function isInStock()
    {
        return $this->stock_quantity > 0;
    }

    /**
     * Get discount percentage
     */
    public function getDiscountPercentageAttribute()
    {
        if ($this->compare_price && $this->compare_price > $this->price) {
            return round((($this->compare_price - $this->price) / $this->compare_price) * 100);
        }
        return 0;
    }

    /**
     * Increment view count
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }
}
