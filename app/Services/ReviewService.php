<?php namespace App\Services;

/**
 * Created by Johan Vester
 * johan@wasitworth.it
 *
 * Date: 13/12/15
 *
 * (c) 2015 wasitworth.it
 */

// Core
use Symfony\Component\HttpFoundation\ParameterBag;

// Doctrine
use EntityManager;

// JWT
use JWTAuth;

// Exceptions
use App\Exceptions\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// Repositories
use App\Repositories\Contracts\ReviewRepository;
use App\Repositories\Contracts\ProductRepository;

// Services
use App\Services\AuthService;

// Models
use App\Models\Review;
use App\Models\Product;

class ReviewService
{
    protected $reviewRepository;
    protected $productRepository;

    public function __construct(
        ReviewRepository $reviewRepository,
        ProductRepository $productRepository,
        AuthService $authService
    ) {
        $this->reviewRepository = $reviewRepository;
        $this->productRepository = $productRepository;
        $this->authService = $authService;
    }

    public function createFromInput($input)
    {
        $review = new Review;
        $user = $this->authService->getAuthenticatedUser();

        $review->setAuthor($user);

        return $this->buildFromInput($review, $input);
    }

    public function updateFromInput(Review $review, $input)
    {
        return $this->buildFromInput($review, $input);
    }

    protected function buildFromInput(Review $review, $input)
    {
        $verdict = $input->get('verdict');
        $productId = $input->get('product_id');
        $product = $this->findProduct($productId);

        if (!$product) {
            throw ($this->createModelNotFoundException('Product', $productId));
        }

        $review->setVerdictFromBool($verdict);
        $review->setProduct($product);

        EntityManager::persist($review);
        EntityManager::flush();

        return $review;
    }

    protected function findProduct($productId)
    {
        $product = $this->productRepository->find($productId);

        return $product;
    }

    private function createModelNotFoundException($model, $id, $previous=null)
    {
        return (new NotFoundHttpException("Could not find $model with id '$id'", $previous));
    }
}