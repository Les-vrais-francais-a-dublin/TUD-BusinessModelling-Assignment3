<?php

require_once __DIR__ . "/Products.php";

function parseHtml($content, array $replace)
{
    foreach ($replace as $key => $value) {
        $content = str_replace($key, $value, $content);
    }
    return $content;
}

function getHtml($name)
{
    $html = file_get_contents(__DIR__ . '/../public/html/' . $name . '.html');
    return ($html);
}

function productToHtml()
{
    $pc = new ProductController();

    // $obj_list = $pc->getProducts();

    /*
    $product1 = new Product("Rings", "In stock", "15/12/2021", "50");
    $product2 = new Product("Jewelry", "Out of stock", "31/06/2022", "50");
    $product3 = new Product("Necklaces", "In stock", "21/08/2025", "50");
    $product4 = new Product("Apple", "In stock", "24/02/2035", "30");
    $product5 = new Product("Pear", "In stock", "24/03/2035", "30");
    $product6 = new Product("Spoon", "In stock", "24/05/2035", "30");
    $product7 = new Product("Candle", "Out of stock", "03/11/2022", "20");
    $product8 = new Product("Perfume", "Out of stock", "23/11/2022", "20");
    $pc = new ProductController();
    $pc->addProduct($product1);
    $pc->addProduct($product2);
    $pc->addProduct($product3);
    $pc->addProduct($product4);
    $pc->addProduct($product5);
    $pc->addProduct($product6);
    $pc->addProduct($product7);
    $pc->addProduct($product8);

    // $stor = new Storage("products");
    // $stor->setContent($product->getProduct());
    // $tmp = array($stor->getContent());
    // array_push($tmp, $product->getProduct());
    // $stor->setContent($tmp);
    // $stor->writeStorage();
    */
    return ("");
}
function fillPage($body)
{
    $html = file_get_contents(__DIR__ . '/../public/html/template.html');
    $html = str_replace("#body", $body, $html);
    return ($html);
}
