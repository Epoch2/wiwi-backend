<?php namespace App\Serializers;

/**
 * Created by Johan Vester
 * johan@wasitworth.it
 *
 * Date: 12/12/15
 *
 * (c) 2015 wasitworth.it
 */

// Models
use App\Models\Product;

class ProductSerializer
{
    public function one(Product $product)
    {
        return [
            'id' => $product->getId(),
            'title' => $product->getTitle(),
            'image_url' => $product->getImageUrl(),
        ];
    }

    public function many($products)
    {
        return array_map(function($product) {
            return $this->one($product);
        }, $products);
    }

    private function verdictToHumanReadable($verdict)
    {
        return ($verdict == Review::VERDICT_WORTH_IT);
    }
}