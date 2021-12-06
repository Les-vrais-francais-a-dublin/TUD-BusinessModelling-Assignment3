<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;
use Slim\Psr7\Response;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/../include/vendor/autoload.php';

$app = AppFactory::create();

$app->post('/crypt', function ($request, $response) {
});

$app->group('/connect', function (RouteCollectorProxy $group) {
    $group->get('/negociate', Session::class . ':negociate');
    $group->get('/connect', function ($request, $response) {
        return ();
    });
});
