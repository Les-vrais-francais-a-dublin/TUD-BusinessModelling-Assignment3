<?php

require_once __DIR__ . "/../src/function.php";

use Slim\Psr7\Response;

require_once(__DIR__ . "/../src/Products.php");
require_once(__DIR__ . "/../src/function.php");

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
        return (getResponse('text/css', $style, 200));
    }
    static public function getProductForm($args)
    {
        $html = file_get_contents(__DIR__ . '/html/'  . 'productForm.html');
        $html = fillPage($html);
        return (getResponse('text/html', $html, 200));
    }
    static public function getFormProductResponse($args)
    {
        $product = new Product($args["params"]["name"], $args["params"]["stock"], $args["params"]["expiration_date"], $args["params"]["type"]);
        $product_engine = new ProductController();
        $product_engine->addProduct($product);
        return (Actions::getProductForm($args));
    }
    static public function getProducts($args)
    {
        $product_engine = new ProductController();
        $products = $product_engine->getProducts();
        $products_list = $product_engine->displayProducts($products);
        $html = fillPage($products_list);
        return (getResponse('text/html',  $html, 200));
    }
    static public function deleteProduct($args)
    {
        $product_name = $args["query_params"]["product_name"];
        $product_engine = new ProductController();
        $product_engine->deleteProduct($product_name);
        return (Actions::getProducts($args));
    }
    static public function getShoppingBasket($args)
    {
        $name = 'shopping';

        $keys = array(
            '#script' => file_get_contents(__DIR__ . '/style/' . $name . '.js'),
            '#style' => file_get_contents(__DIR__ . '/style/' . $name . '.css'),
            '#product' => productToHtml()
        );
        $parsial_html = getHtml($name);
        $html = parseHtml($parsial_html, $keys);

        return (getResponse(array('Content-Type' => 'text/html'), fillPage($html), 200));
    }

    static public function getHome()
    {
        $html = getHtml("home");

        return (getResponse(array('Content-Type' => 'text/html'), fillPage($html), 200));
    }

    static public function getChangeCalculator()
    {
        $name = 'correct-change';

        $keys = array(
            '#style' => file_get_contents(__DIR__ . '/style/' . $name . '.css')
        );
        $parsial_html = getHtml($name);
        $html = parseHtml($parsial_html, $keys);

        return (getResponse(array('Content-Type' => 'text/html'), fillPage($html), 200));
    }
}

function getResponse($content_type, $body, $status)
{
    $response = new Response();
    $response->getBody()->write($body);
    return $response
        ->withStatus($status)
        ->withHeader('Content-Type', $content_type)
        ->withoutHeader("Content-Length");
}
