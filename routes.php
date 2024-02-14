<?php

$router->get("/",'HomeController@index');
$router->get("/listings",'ListingsController@index');
$router->get("/listings/create",'ListingsController@create');
$router->get("/listings/edit/{id}",'ListingsController@edit');
$router->get("/listing/{id}",'ListingsController@show');



$router->post("/listings",'ListingsController@store');
$router->delete('/listings/{id}','ListingsController@destroy');
$router->put('/listings/{id}','ListingsController@update');


$router->get('/auth/register','UserController@create');
$router->get('/auth/login','UserController@login');

$router->post('/auth/register','UserController@store');
$router->post('/auth/logout','UserController@logout');