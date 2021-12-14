<?php

use Slim\Factory\AppFactory;

require_once __DIR__ . '/../include/vendor/autoload.php';
require_once __DIR__ . '/Session.php';
require_once __DIR__ . '/Action.php';
require_once __DIR__ . '/../src/Storage.php';


$app = AppFactory::create();


$app->get('/getStyle', function ($request, $response) {
    return (router($request, $response, "\Actions::getStyle"));
});
$app->get('/getHome', function ($request, $response) {
    return (router($request, $response, "\Actions::getHome"));
});

$app->run();
