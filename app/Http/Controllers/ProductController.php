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
use App\Services\ProductService;

// Repositories
use App\Repositories\Contracts\ProductRepository;

// Models
use App\Models\Product;

// Serializers
use App\Serializers\ProductSerializer;

class ProductController extends Controller
{
    private $productRepository;
    private $productService;

    public function __construct(
        ProductRepository $productRepository,
        ProductService $productService
    ) {
        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        // #TODO: Implement real searching
        if ($request->has('query')) {
            $titleQuery = $request->get('query');

            $products = $this->productRepository->searchByTitle($titleQuery);
        } else {
            $products = $this->productRepository->findAll();
        }

        return response()->json(
            (new ProductSerializer)->many($products),
            HttpCodes::HTTP_OK
        );
    }

    public function store(Request $request)
    {
        $input = $request->json();

        $product = $this->productService->createFromInput($input);

        return response()->json(
            (new ProductSerializer)->one($product),
            HttpCodes::HTTP_CREATED
        );
    }
}