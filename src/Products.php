<?php

require_once __DIR__ . '/Storage.php';


class Product
{
    private $_name;
    private $_stock;
    private $_expiration_date;
    private $_price;
    private $_type;


    public function __construct($name, $stock, $expiration_date, $type)
    {
        $this->_name = $name;
        $this->_stock = $stock;
        $this->_expiration_date = $expiration_date;
        switch ($type) {
            case 'Luxury':
                $this->_price = 50;
                break;
            case 'Essential':
                $this->_price = 30;
                break;
            case 'Gift':
                $this->_price = 20;
                break;
        }
        print_r($type);
        $this->_type = $type;
    }
    public function getProduct()
    {
        return (array(
            'name' => $this->_name,
            'stock' => $this->_stock,
            'expiration_date' => $this->_expiration_date,
            'price' => $this->_price,
            'type' => $this->_type
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
    public function getType()
    {
        return $this->_type;
    }
    public function getPrice()
    {
        return $this->_price;
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
        $product_list = array();
        if ($this->_storage->getContent() != null) {
            $product_list = $this->_storage->getContent();
        }
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
            $product = new Product($product_getted->name, $product_getted->stock, $product_getted->expiration_date, $product_getted->type);
            array_push($obj_list, $product);
        }
        return ($obj_list);
    }
    public function deleteProduct($product_name)
    {
        $product_list = $this->_storage->getContent();
        foreach ($product_list as $key => $product_getted) {
            if ($product_getted->name == $product_name) {
                unset($product_list[$key]);
            }
        }
        $this->_storage->setContent($product_list);
        $this->_storage->writeStorage();
    }
    public function displayProduct($product)
    {
        $response = array();
        array_push($response, '<div class="prod-info-main prod-wrap clearfix">');
        array_push($response, '<div class="row">');
        array_push($response, '<div class="col-md-5 col-sm-12 col-xs-12">');
        array_push($response, '<div class="product-image">');
        array_push($response, '<img src="https://upload.wikimedia.org/wikipedia/commons/1/14/Product_sample_icon_picture.png" class="img-responsive" width=300px>');
        array_push($response, '</div></div>');
        array_push($response, '<div class="col-md-7 col-sm-12 col-xs-12">');
        array_push($response, '<div class="product-deatil"></a>');
        array_push($response, '<h5 class="name">');
        array_push($response, '<a href="#">' . $product->getName() . '</a>');
        array_push($response, '<a href="#"><span>' . $product->getType() . '</span></a>');
        array_push($response, '</h5>');
        array_push($response, '<p class="price-container"><span>' . $product->getPrice() . '€</span></p>');
        array_push($response, '<span class="tag1"></span>');
        array_push($response, '</div>');
        array_push($response, '<div class="description">');
        array_push($response, '</div>');

        array_push($response, '<div class="product-info smart-form">');
        array_push($response, '<div class="row">');
        array_push($response, '<div class="col-md-12">');
        array_push($response, '<a href="http://127.0.0.1/deleteProduct?product_name=' . $product->getName() . '" class="btn btn-danger">Delete product</a>');
        array_push($response, '</div></div></div></div></div></div>');

        return (implode("\n", $response));
    }
    public function displayProducts($products)
    {
        $response = array();
        array_push($response, '<link href="http://127.0.0.1/getStyle?name=product" rel="stylesheet">');
        array_push($response, '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">');
        array_push($response, '<div class="containermain">');
        foreach ($products as $product) {
            array_push($response, $this->displayProduct($product));
        }
        array_push($response, '</div>');
        return (implode("\n", $response));
    }
}
