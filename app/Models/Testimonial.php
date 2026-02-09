<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    protected $fillable = [
        'customer_name',
        'rating',
        'review_text',
        'product_id',
        'is_featured',
        'is_approved',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_approved' => 'boolean',
    ];

    /**
     * Get the product for this testimonial
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Scope to get only approved testimonials
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Scope to get only featured testimonials
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_approved', true);
    }

    /**
     * Get star rating as HTML
     */
    public function getStarsAttribute()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            $stars .= $i <= $this->rating ? '⭐' : '☆';
        }
        return $stars;
    }
}
