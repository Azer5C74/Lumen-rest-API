<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|Sans votre adresse, nous ne pouvons pas certifier que cet établissement peut vous livrer.
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'api'], function () use ($router) {

    $router->group(['namespace'=>'Auth'], function () use ($router) {
        $router->post('/register', 'RegisterController@store');
        $router->post('/login', 'LoginController@store');
    });

    $router->group(['middleware' => 'auth'], function () use ($router) {

$router->group(['namespace'=>'Article'], function () use ($router){
    $router->get('/articles', 'ArticleController@index');
    $router->get('/articles/{slug}', 'ArticleController@show');
    $router->post('/articles', 'ArticleController@store');
    $router->put('/articles/{id}', 'ArticleController@update');
    $router->delete('/articles/{id}', 'ArticleController@destroy');

});

        $router->post('/logout', 'Auth\LogoutController@store');
        $router->get('/users/{id}','Auth\UserDetails@show');

        $router->post('/categories','Category\CategoryController@store');
        $router->get('/categories', 'Category\CategoryController@index');
        $router->get('/categories/{id}','Category\CategoryController@show');


    });
});
