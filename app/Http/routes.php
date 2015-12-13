<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Resource routes
$app->group(['namespace' => 'App\Http\Controllers'], function($app) {
    $app->get('/reviews', 'ReviewController@index');
    $app->get('/products', 'ProductController@index');

    // Protected
    $app->group(['namespace' => 'App\Http\Controllers', 'middleware' => ['jwt.auth']], function($app) {
        $app->post('/reviews', 'ReviewController@store');
        $app->post('/products', 'ProductController@store');
    });

    // Token refresh
    $app->group(['namespace' => 'App\Http\Controllers', 'middleware' => 'jwt.refresh'], function($app) {
        $app->get('/refresh', 'AuthController@refresh');
    });

    $app->post('/login', 'AuthController@login');
    $app->post('/register', 'UserController@store');
});
