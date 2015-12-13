<?php namespace App\Services;

/**
 * Created by Johan Vester
 * johan@assimilate.se
 *
 * Date: 13/12/15
 *
 * (c) 2015 Assimilate
 */

// Doctrine
use EntityManager;

// Repositories
use App\Repositories\Contracts\ProductRepository;

// Models
use App\Models\Product;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function createFromInput($input)
    {
        $product = new Product;

        return $this->buildFromInput($product, $input);
    }

    public function updateFromInput(Product $product, $input)
    {
        return $this->buildFromInput($product, $input);
    }

    public function buildFromInput(Product $product, $input)
    {
        $title = $input->get('title');
        // #TODO: Shouldn't really be optional
        $imageUrl = $input->has('image_url') ? $input->get('image_url') : null;

        $product->setTitle($title);
        $product->setImageUrl($imageUrl);

        EntityManager::persist($product);
        EntityManager::flush();

        return $product;
    }
}