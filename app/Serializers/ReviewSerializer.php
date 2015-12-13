<?php namespace App\Serializers;

/**
 * Created by Johan Vester
 * johan@assimilate.se
 *
 * Date: 12/12/15
 *
 * (c) 2015 Assimilate
 */

// Models
use App\Models\Review;

// Serializers
use App\Serializers\ProductSerializer;

class ReviewSerializer
{
    public function one(Review $review)
    {
        return [
            'id' => $review->getId(),
            'product' => (new ProductSerializer)->one($review->getProduct()),
            'worth_it' => $this->verdictToHumanReadable($review->getVerdict()),
        ];
    }

    public function many($reviews)
    {
        return array_map(function($review) {
            return $this->one($review);
        }, $reviews);
    }

    private function verdictToHumanReadable($verdict)
    {
        return ($verdict == Review::VERDICT_WORTH_IT);
    }
}