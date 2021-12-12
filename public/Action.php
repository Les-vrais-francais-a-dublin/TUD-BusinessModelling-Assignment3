<?php

use Slim\Psr7\Response;


class Actions
{
    static public function getProfile($args)
    {
        return ("contenu de la page");
    }
    static public function getStyle($args)
    {
        $name = $args["query_params"]["name"];
        $style = file_get_contents(__DIR__ . '/style/' . $name . '.css');
        return (getResponse(array('Content-Type' => 'application/json'), $style, 200));
    }
}

function getResponse($headers, $body, $status)
{
    $response = new Response();
    $response->getBody()->write($body);
    return $response
        ->withStatus($status)
        ->withHeader('Content-Type', 'text/plain')
        ->withoutHeader("Content-Length");
}
