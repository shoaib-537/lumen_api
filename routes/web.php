<?php

$router->get('/products', 'ProductController@index');
$router->get('/products/{id}', 'ProductController@show');
$router->post('/products/create', 'ProductController@store');
$router->post('/products/update/{id}', 'ProductController@update');
$router->delete('/products/delete/{id}', 'ProductController@destroy');


$router->get('/', function () use ($router) {
    return $router->app->version();
});
