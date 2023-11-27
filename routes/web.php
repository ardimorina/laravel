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
|
*/
/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Route;

// Authentication routes
$router->post('/login', 'AuthController@login');
$router->post('/register', 'AuthController@register');

// Routes requiring authentication via JWT middleware
$router->group(['middleware' => 'auth.jwt'], function () use ($router) {
    // User-related routes
    $router->get('/user', 'UserController@getUser');
    $router->put('/user/{id}', 'UserController@updateUser');

    // Post-related routes
    $router->get('/posts', 'PostController@getAllPosts');
    $router->post('/post', 'PostController@storePost');
    $router->put('/post/{postId}', 'PostController@updatePost');
    $router->delete('/post/{postId}', 'PostController@deletePost');

    // Reply-related routes
    $router->post('/post/{postId}/reply', 'ReplyController@storeReply');
    $router->put('/reply/{replyId}', 'ReplyController@updateReply');
    $router->delete('/reply/{replyId}', 'ReplyController@deleteReply');
});

// Admin routes (assuming admins have a specific role or permission)
$router->group(['middleware' => ['auth.jwt', 'admin'], 'prefix' => 'admin'], function () use ($router) {
    $router->delete('/post/{postId}', 'AdminController@deleteAnyPost');
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});

