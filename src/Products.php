<?php

require_once __DIR__ . '/Storage.php';


class Product
{
    private $_name;
    private $_stock;
    private $_expiration_date;
    private $_price;


    public function __construct($name, $stock, $expiration_date, $price)
    {
        $this->_name = $name;
        $this->_stock = $stock;
        $this->_expiration_date = $expiration_date;
        $this->_price = $price;
    }
    public function getProduct()
    {
        return (array(
            'name' => $this->_name,
            'stock' => $this->_stock,
            'expiration_date' => $this->_expiration_date,
            'price' => $this->_price
        ));
    }
    public function setStock($stock)
    {
        $this->_stock = $stock;
    }
    public function getStock()
    {
        return $this->_stock;
    }
    public function getName()
    {
        return $this->_name;
    }
    public function getExpirationDate()
    {
        return $this->_expiration_date;
    }
}

class ProductController
{
    private $_storage;
    public function __construct()
    {
        $this->_storage = new Storage("products");
        $this->_storage->readStorage();
    }
    public function addProduct($product)
    {
        $product_list = $this->_storage->getContent();
        array_push($product_list, $product->getProduct());
        $this->_storage->setContent($product_list);
        $this->_storage->writeStorage();
    }
    public function updateProduct($product)
    {
        $product_list = $this->_storage->getContent();
        foreach ($product_list as $key => $product_getted) {
            if ($product_getted['name'] == $product->getName()) {
                $product_list[$key] = $product->getProduct();
            }
        }
    }
    public function getProducts()
    {
        $obj_list = array();
        $product_list = $this->_storage->getContent();
        foreach ($product_list as $product_getted) {
            $product = new Product($product_getted["name"], $product_getted["stock"], $product_getted["expiration_date"], $product_getted["price"]);
            array_push($obj_list, $product);
        }
        return ($obj_list);
    }
    public function deleteProduct($product_name)
    {
        $product_list = $this->_storage->getContent();
        foreach ($product_list as $key => $product_getted) {
            if ($product_getted['name'] == $product_name) {
                unset($product_list[$key]);
            }
        }
        $this->_storage->setContent($product_list);
        $this->_storage->writeStorage();
    }
}
