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



$router->post('/login', 'AuthController@login');
$router->post('/register', 'AuthController@register');

$router->get('/user', 'UserController@index');
$router->get('/user/{id}', 'UserController@show');
$router->delete('/user/{id}', 'UserController@delete');
$router->put('/user/{id}', 'UserController@update');

$router->get('/discussion', 'RoomController@index');
$router->post('/discussion}', 'RoomController@create');
$router->get('/discussion/{id}', 'RoomController@show');
$router->delete('/discussion/{id}', 'RoomController@delete');

$router->get('/message', 'MessageController@index');
$router->post('/message/{idRoom}', 'MessageController@create');
$router->get('/message/{id}', 'MessageController@show');
$router->delete('/message/{idRoom}/{idMessage}', 'MessageController@delete');


