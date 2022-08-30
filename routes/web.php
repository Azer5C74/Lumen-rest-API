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

    $router->group(['namespace' => 'Auth'], function () use ($router) {
        $router->post('/register', 'RegisterController@store');
        $router->post('/login', 'LoginController@store');
    });

    $router->group(['middleware' => 'auth'], function () use ($router) {

        $router->group(['namespace' => 'Article'], function () use ($router) {
            $router->get('/articles', 'ArticleController@index');
            $router->get('/articles/{slug}', 'ArticleController@show');
            $router->post('/articles', 'ArticleController@store');
            $router->put('/articles/{id}', 'ArticleController@update');
            $router->delete('/articles/{id}', 'ArticleController@destroy');

        });
        $router->group(['namespace' => 'Auth'], function () use ($router) {
            $router->post('/logout', 'LogoutController@store');
            $router->get('/users/me', 'UserDetails@show');
        });

        $router->group(['namespace' => 'Category'], function () use ($router) {

            $router->post('/categories', 'CategoryController@store');
            $router->delete('/categories/{slug}', 'CategoryController@destroy');
            $router->get('/categories', 'CategoryController@index');
            $router->get('/categories/{id}', 'CategoryController@show');
        });

        $router->group(['middleware' => 'isAdmin'], function () use ($router) {
            $router->group(['namespace' => 'Admin'], function () use ($router) {
            $router->get('/users', 'AdminController@index');

        });});
    });
});
