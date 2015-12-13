<?php namespace App\Http\Controllers;

/**
 * Created by Johan Vester
 * johan@wasitworth.it
 *
 * Date: 12/12/15
 *
 * (c) 2015 wasitworth.it
 */

// Core
use Illuminate\Http\Request;

// Doctrine
use EntityManager;

// Helpers
use Epoch2\HttpCodes;

// Services
use App\Services\ReviewService;

// Repositories
use App\Repositories\Contracts\ReviewRepository;

// Models
use App\Models\Review;

// Serializers
use App\Serializers\ReviewSerializer;

class ReviewController extends Controller
{
    private $reviewRepository;
    private $reviewService;

    public function __construct(
        ReviewRepository $reviewRepository,
        ReviewService $reviewService
    ) {
        $this->reviewRepository = $reviewRepository;
        $this->reviewService = $reviewService;
    }

    public function index()
    {
        $reviews = $this->reviewRepository->findAll();

        return response()->json(
            (new ReviewSerializer)->many($reviews),
            HttpCodes::HTTP_OK
        );
    }

    public function store(Request $request)
    {
        $input = $request->json();

        $review = $this->reviewService->createFromInput($input);

        return response()->json(
            (new ReviewSerializer)->one($review),
            HttpCodes::HTTP_CREATED
        );
    }

    public function update(Request $request, $reviewId)
    {
        $input = $request->json();

        $review = $this->reviewRepository->find($reviewId);

        $this->reviewService->updateFromInput($review, $input);

        return response()->json(
            (new ReviewSerializer)->one($review),
            HttpCodes::HTTP_OK
        );
    }
}