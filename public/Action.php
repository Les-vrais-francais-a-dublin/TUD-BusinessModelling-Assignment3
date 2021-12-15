<?php

require_once __DIR__ . "/../src/function.php";

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

    static public function getShoppingBasket($args)
    {
        $name = 'shopping';
        
        $keys = array(
            '#script' => file_get_contents(__DIR__ . '/style/' . $name . '.js'),
            '#style' => file_get_contents(__DIR__ . '/style/' . $name . '.css'),
            '#product' => productToHtml()
        );
        $parsial_html = getHtml("shopping");
        $html = parseHtml($parsial_html, $keys);
        return (getResponse(array('Content-Type' => 'text/html'), $html, 200));
    }
}

function getResponse($headers, $body, $status)
{
    $response = new Response();
    $response->getBody()->write($body);
    return $response
        ->withStatus($status)
        ->withHeader('Content-Type', $headers["Content-Type"])
        ->withoutHeader("Content-Length");
}
