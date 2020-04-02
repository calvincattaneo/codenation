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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('category', 'CategoryController@lists');
$router->get('category/{id}', 'CategoryController@show');
$router->put('category/{id}', 'CategoryController@update');
$router->post('category', 'CategoryController@store');

$router->get('challenge', 'ChallengeController@lists');
$router->get('challenge/{id}', 'ChallengeController@show');
$router->put('challenge/{id}', 'ChallengeController@update');
$router->post('challenge', 'ChallengeController@store');