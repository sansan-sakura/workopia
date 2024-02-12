<?php

// $router->get('/','controllers/home.php');
// $router->get('/listings','controllers/listings/index.php');
// $router->get('/listings/create','controllers/listings/create.php');
// $router->get('/listing/','controllers/listings/show.php');

$router->get("/",'HomeController@index');
$router->get("/listings",'ListingsController@index');
$router->get("/listings/create",'ListingsController@create');
$router->get("/listing/{id}",'ListingsController@show');