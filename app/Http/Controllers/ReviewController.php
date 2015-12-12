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

// Models
use App\Models\Review;

// Serializers
use App\Serializers\ReviewSerializer;

class ReviewController extends Controller
{
    private $reviewRepository;

    public function __construct()
    {
        $this->reviewRepository = EntityManager::getRepository(Review::class);
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

        $review = new Review;
        $review->setVerdictFromBool($input->get('worth_it'));

        EntityManager::persist($review);
        EntityManager::flush();

        return response()->json(
            (new ReviewSerializer)->one($review),
            HttpCodes::HTTP_CREATED
        );
    }
}