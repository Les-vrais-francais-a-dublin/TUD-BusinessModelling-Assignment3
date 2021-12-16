<?php

use Slim\Factory\AppFactory;

require_once __DIR__ . '/../include/vendor/autoload.php';
require_once __DIR__ . '/Session.php';
require_once __DIR__ . '/Action.php';
require_once __DIR__ . '/../src/Storage.php';


$app = AppFactory::create();

//PAGE
$app->get('/', function ($request, $response) {
    return (router($request, $response, "\Actions::getHome"));
});
$app->get('/shopping', function ($request, $response) {
    return (router($request, $response, "\Actions::getShoppingBasket"));
});
$app->get('/change', function ($request, $response) {
    return (router($request, $response, "\Actions::getChangeCalculator"));
});
$app->get('/getProducts', function ($request, $response) {
    return (router($request, $response, "\Actions::getProducts"));
});
$app->get('/getProductForm', function ($request, $response) {
    return (router($request, $response, "\Actions::getProductForm"));
});

//API
$app->get('/deleteProduct', function ($request, $response) {
    return (router($request, $response, "\Actions::deleteProduct"));
});
$app->post('/getFormProductResponse', function ($request, $response) {
    return (router($request, $response, "\Actions::getFormProductResponse"));
});
$app->get('/getStyle', function ($request, $response) {
    return (router($request, $response, "\Actions::getStyle"));
});



$app->run();
