<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'images',
        'description',
        'price',
        'is_active',
        'is_featured',
        'in_stock',
        'on_sale'
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'in_stock' => 'boolean',
        'on_sale' => 'boolean',
        'price' => 'decimal:2'
    ];

    protected $attributes = [
        'is_active' => true,
        'in_stock' => true,
        'is_featured' => false,
        'on_sale' => false,
    ];

    protected $appends = [
        'average_rating',
        'reviews_count',
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function approvedReviews(): HasMany
    {
        return $this->reviews()->where('is_approved', true);
    }

    protected function averageRating(): Attribute
    {
        return Attribute::make(
            get: fn () =>
                round(
                    $this->approvedReviews()->avg('rating') ?? 0,
                    1
                )
        );
    }
    protected function reviewsCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->approvedReviews()->count()
        );
    }
    public function recalculateRating(): void
    {
        $stats = $this->approvedReviews()
            ->selectRaw('COUNT(*) as count, AVG(rating) as avg')
            ->first();
    }

}
