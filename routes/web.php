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
$router->post('users/create','UsersController@createUser');
$router->group(['prefix'=>'users', 'middleware'=>'auth' ], function() use ($router){
    $router->get('/','UsersController@listUsers');
    $router->get('/{id}','UsersController@listUser');
    $router->put('{id}','UsersController@updateUser');
    $router->delete('{id}','UsersController@deleteUser');
    $router->get('{id}/restore','UsersController@restoreUser');
});
