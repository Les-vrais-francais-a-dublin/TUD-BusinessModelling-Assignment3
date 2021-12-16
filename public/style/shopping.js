var id_product_table = 1
var id_shoppable_product = 10000;

function display_vat(type) {
    table = document.getElementById("all_product")
    disp = document.getElementById("vat")
    value = type.value
    if (value == "Luxury") {
        disp.innerHTML = "VAT : 20%"
    } else if (value == "Essential") {
        disp.innerHTML = "VAT : 10%"
    } else if (value == "Gift") {
        disp.innerHTML = "VAT : 5%"
    }

    for (var i = 10000; i < id_shoppable_product; i++) {
        var row = document.getElementById(i)
        if (document.getElementById(row.id + "_table_category").innerHTML == value)
            row.style.display = ''
        else
            row.style.display = 'none'

    }
}

function add_item(name, category, stock, id_quantity, price, vat) {
    var quantity = document.getElementById(id_quantity).value
    const total = (price * (1 + (vat / 100)) * quantity)
    const item = `
    <tr id="${id_product_table}">
        <td class="col-sm-8 col-md-6">
            <div class="media">
                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                <div class="media-body">
                    <h4 class="media-heading"><a href="#">${name}</a></h4>
                    <h5 class="media-heading"><strong>${category}</strong></h5>
                    <span>Status: </span><span class="text-success"><strong>${stock}</strong></span>
                </div>
            </div>
        </td>
    
        <td class="col-sm-1 col-md-1 text-center"><span id="${id_product_table}_table_quantity">${quantity}</span></td>
        <td class="col-sm-1 col-md-1 text-center"><span id="${id_product_table}_table_price">${price}</span>€</td>
        <td class="col-sm-1 col-md-1 text-center"><span id="${id_product_table}_table_vat">${vat}</span>%</td>
        <td id="${id_product_table}_table_total" class="col-sm-1 col-md-1 text-center">${total}</td>
        <td class="col-sm-1 col-md-1">
            <button type="button" class="btn btn-danger" onclick="remove_item(${id_product_table})">
                <span class="glyphicon glyphicon-remove"></span> Remove
            </button>
        </td>
    </tr>
    `
    
    const base = document.getElementById("shopping_basket").innerHTML
    document.getElementById("shopping_basket").innerHTML = item + base
    id_product_table +=1

    for (var i = 10000; i < id_shoppable_product; i++) {
        document.getElementById(i).style.display = 'none'
    }
}

function remove_item(id) {
    var elem = document.getElementById(id)
    elem.innerHTML = ""
    elem.remove()
}

function calculate_price() {
    table = document.getElementById("shopping_basket")
    var total_basket = 0
    
    for (var i = 0; i < table.rows.length; i++) {
        var row = document.getElementById(table.rows.item(i).id)
        if (row == null)
            continue
        const vat = document.getElementById(table.rows.item(i).id + "_table_vat").innerHTML
        const price = document.getElementById(table.rows.item(i).id + "_table_price").innerHTML
        const quantity = document.getElementById(table.rows.item(i).id + "_table_quantity").innerHTML
        const total = (price * (1 + (vat / 100)) * quantity)
        document.getElementById(table.rows.item(i).id + "_table_total").innerHTML = total
        total_basket += total
    }
    document.getElementById("shopping_basket_total").innerHTML = total_basket   
}

function load_item_from_category(name, category, stock, price, vat) {
    const item = `
    <tr id="${id_shoppable_product}">
        <td class="col-sm-8 col-md-6">
            <div class="media">
                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                <div class="media-body">
                    <h4 class="media-heading"><a href="#">${name}</a></h4>
                    <h5 class="media-heading"><strong  id="${id_shoppable_product}_table_category">${category}</strong></h5>
                    <span>Status: </span><span class="text-success"><strong>${stock}</strong></span>
                </div>
            </div>
        </td>
    
        <td class="col-sm-1 col-md-1 text-center"><input type='number' id="${id_shoppable_product}_table_quantity" value=1></span></td>
        <td class="col-sm-1 col-md-1 text-center"><span id="${id_shoppable_product}_table_price">${price}</span>€</td>
        <td class="col-sm-1 col-md-1 text-center"><span id="${id_shoppable_product}_table_vat">${vat}</span>%</td>
        <td class="col-sm-1 col-md-1">
            <button type="button" class="btn btn-success" onclick="add_item('${name}', '${category}', '${stock}', '${id_shoppable_product}_table_quantity', '${price}', '${vat}')">
                <span class="glyphicon glyphicon-plus"></span> Add to basket
            </button>
        </td>
    </tr>
    `
    
    const base = document.getElementById("all_product").innerHTML
    document.getElementById("all_product").innerHTML = item + base
    id_shoppable_product += 1

}