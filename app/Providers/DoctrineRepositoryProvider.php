<?php namespace App\Providers;

/**
 * Created by Johan Vester
 * johan@wasitworth.it
 *
 * Date: 02/12/15
 *
 * (c) 2015 wasitworth.it
 */

/*
 * Defines and registers the mappings between a model, the repository contract,
 * and the Doctrine implementation.
 *
 */

use Illuminate\Support\ServiceProvider;

// Models
use App\Models\Review;
use App\Models\Product;

// Repositories
use App\Repositories\Contracts\ReviewRepository;
use App\Repositories\Contracts\ProductRepository;

// Implementations
use App\Repositories\DoctrineReviewRepository;
use App\Repositories\DoctrineProductRepository;

class DoctrineRepositoryProvider extends ServiceProvider
{
    /* Defines the mappings between a Model, its repository contract,
     * and the repository implementation
     */
    private $repositories = [
        Review::class => [
            ReviewRepository::class,
            DoctrineReviewRepository::class,
        ],
        Product::class => [
            ProductRepository::class,
            DoctrineProductRepository::class,
        ],
    ];

    public function register()
    {
        foreach ($this->repositories as $model => $repositoryMapping) {
            // Register the interface implementation
            $this->app->bind($repositoryMapping[0], function($app) use ($model, $repositoryMapping) {
                // This is what Doctrine's EntityRepository needs in its constructor.
                return new $repositoryMapping[1](
                    $app['em'],
                    $app['em']->getClassMetaData($model)
                );
            });
        }
    }
}