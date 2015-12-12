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

/**
 * Class ReviewController
 *
 * @Resource("Reviews" uri="/reviews")
 */
class ReviewController extends Controller
{
    private $reviewRepository;

    public function __construct()
    {
        $this->reviewRepository = EntityManager::getRepository(Review::class);
    }

    /**
     * List all reviews
     *
     * Get a JSON representation of all the registered users.
     *
     * @Get("/")
     * @Response(200, body=[{"id": "407b1ece-a115-11e5-b1d9-22000b95c3d9" , "worth_it": true}])
     */
    public function index()
    {
        $reviews = $this->reviewRepository->findAll();

        return response()->json(
            (new ReviewSerializer)->many($reviews),
            HttpCodes::HTTP_OK
        );
    }

    /**
     * Submit a new review
     *
     * Submit a new review with a `verdict`
     *
     * @Post("/")
     * @Request({"worth_it": true})
     * @Response(200, body={"id": "407b1ece-a115-11e5-b1d9-22000b95c3d9" , "worth_it": true})
     *
     * @param Request $request
     */
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