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
    $id = 10000;
    $html = "";
    $obj_list = $pc->getProducts();
    for ($i = 0; $i < count($obj_list); $i++) {
        $obj_list[$i];
        $name = $obj_list[$i]->getName();
        $stock = $obj_list[$i]->getStock();
        $category = $obj_list[$i]->getType();
        $price = $obj_list[$i]->getPrice();
        $vat = 0;
        if ($category == "Luxury") {
            $vat = 20;
        } elseif ($category == "Essential") {
            $vat = 10;
        } elseif ($category == "Gift") {
            $vat = 5;
        }

        $item = <<<EOT
        <tr id="$id" style="display:none">
            <td class="col-sm-8 col-md-6">
                <div class="media">
                    <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                    <div class="media-body">
                        <h4 class="media-heading"><a href="#">$name</a></h4>
                        <h5 class="media-heading"><strong  id="{$id}_table_category">$category</strong></h5>
                        <span>Status: </span><span class="text-success"><strong>$stock</strong></span>
                    </div>
                </div>
            </td>
        
            <td class="col-sm-1 col-md-1 text-center"><input type='number' id="{$id}_table_quantity" value=1></span></td>
            <td class="col-sm-1 col-md-1 text-center"><span id="${id}_table_price">$price</span>€</td>
            <td class="col-sm-1 col-md-1 text-center"><span id="${id}_table_vat">$vat</span>%</td>
            <td class="col-sm-1 col-md-1">
                <button type="button" class="btn btn-success" onclick="add_item('$name', '$category', '$stock', '${id}_table_quantity', '$price', '$vat')">
                    <span class="glyphicon glyphicon-plus"></span> Add to basket
                </button>
            </td>
        </tr>
        EOT;
        $html .= $item;
        $id += 1;
    }
    return ($html);
}
function fillPage($body)
{
    $html = file_get_contents(__DIR__ . '/../public/html/template.html');
    $html = str_replace("#body", $body, $html);
    return ($html);
}
