var id_product_table = 1

function display_vat(type) {
    disp = document.getElementById("vat")
    value = type.value
    if (value == "luxury") {
        disp.innerHTML = "VAT : 20%"
    } else if (value == "essential") {
        disp.innerHTML = "VAT : 10%"
    } else if (value == "gift") {
        disp.innerHTML = "VAT : 5%"
    }
}

function add_item(name, category, stock, quantity, price, vat) {
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

function load_item_from_category(category) {
    if (category == "luxury") {
        disp.innerHTML = "VAT : 20%"
    } else if (category == "essential") {
        disp.innerHTML = "VAT : 10%"
    } else if (category == "gift") {
        disp.innerHTML = "VAT : 5%"
    }






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
}