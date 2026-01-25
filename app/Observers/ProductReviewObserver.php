<?php

namespace App\Observers;

use App\Models\ProductReview;

class ProductReviewObserver
{
    public function saved(ProductReview $review): void
    {
        $review->product->recalculateRating();
    }

    public function deleted(ProductReview $review): void
    {
        $review->product->recalculateRating();
    }
}
