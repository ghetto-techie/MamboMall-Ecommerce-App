<?php
namespace App\Utilities;

class Similarity
{
    // Jaccard Index: Good for comparing categories (set similarity)
    public static function jaccard($setA, $setB): float
    {
        $intersection = array_intersect($setA, $setB);
        $union = array_unique(array_merge($setA, $setB));
        return count($union) > 0 ? count($intersection) / count($union) : 0.0;
    }

    // Euclidean Distance: Good for comparing numeric values like price
    public static function euclidean(array $a, array $b, bool $returnDistance = false): float
    {
        $distance = sqrt(array_sum(array_map(fn($val, $val2) => pow($val - $val2, 2), $a, $b)));
        return $returnDistance ? $distance : 1 / (1 + $distance);
    }

    // Cosine Similarity: Advanced method for comparing text (e.g., descriptions)[citation:1]
    public static function cosineSimilarity(array $vectorA, array $vectorB): float
    {
        $dotProduct = 0.0;
        $magnitudeA = 0.0;
        $magnitudeB = 0.0;
        foreach ($vectorA as $key => $value) {
            $valueB = $vectorB[$key] ?? 0;
            $dotProduct += $value * $valueB;
            $magnitudeA += $value ** 2;
            $magnitudeB += $valueB ** 2;
        }
        $magnitudeA = sqrt($magnitudeA);
        $magnitudeB = sqrt($magnitudeB);
        return ($magnitudeA * $magnitudeB) ? $dotProduct / ($magnitudeA * $magnitudeB) : 0.0;
    }
}
