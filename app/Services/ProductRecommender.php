<?php
namespace App\Services;

use App\Models\Product;
use App\Utilities\Similarity;

class ProductRecommender
{
    protected $priceWeight = 0.3;
    protected $categoryWeight = 0.5;
    protected $brandWeight = 0.2;

    // Set custom weights if some attributes are more important
    public function setWeights($price, $category, $brand): void
    {
        $total = $price + $category + $brand;
        $this->priceWeight = $price / $total;
        $this->categoryWeight = $category / $total;
        $this->brandWeight = $brand / $total;
    }

    // Main function to get similar products
    public function getSimilarProducts(Product $baseProduct, int $limit = 5)
    {
        $allProducts = Product::where('id', '!=', $baseProduct->id)
                              ->where('is_active', true)
                              ->get();

        $productsWithScores = [];
        foreach ($allProducts as $product) {
            $score = $this->calculateSimilarityScore($baseProduct, $product);
            $productsWithScores[] = [
                'product' => $product,
                'score' => $score
            ];
        }

        // Sort by highest similarity score and return the top results
        usort($productsWithScores, fn($a, $b) => $b['score'] <=> $a['score']);
        return array_slice($productsWithScores, 0, $limit);
    }

    protected function calculateSimilarityScore(Product $productA, Product $productB): float
    {
        // 1. Compare Categories (using Jaccard Index on category IDs)
        $catScore = Similarity::jaccard(
            [$productA->category_id],
            [$productB->category_id]
        );

        // 2. Compare Brands (exact match)
        $brandScore = ($productA->brand_id === $productB->brand_id) ? 1.0 : 0.0;

        // 3. Compare Price (using normalized Euclidean Similarity)
        // Normalize prices to a 0-1 scale based on the most expensive product in the set
        $maxPrice = max($productA->price, $productB->price, 1); // Avoid division by zero
        $normPriceA = $productA->price / $maxPrice;
        $normPriceB = $productB->price / $maxPrice;
        $priceScore = Similarity::euclidean([$normPriceA], [$normPriceB]);

        // 4. Calculate Weighted Average
        $finalScore = ($catScore * $this->categoryWeight)
                    + ($brandScore * $this->brandWeight)
                    + ($priceScore * $this->priceWeight);

        return round($finalScore, 3);
    }
}
