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

class ReviewSerializer
{
    public function one(Review $review)
    {
        return [
            'id' => $review->getId(),
            'worth_it' => $this->verdictToHumanReadable($review->getVerdict()),
        ];
    }

    public function many($reviewCollection)
    {
        return array_map(function($review) {
            return $this->one($review);
        }, $reviewCollection);
    }

    private function verdictToHumanReadable($verdict)
    {
        return ($verdict == Review::VERDICT_WORTH_IT);
    }
}