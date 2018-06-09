$(document).ready(function () {
    $(".delivery_options").hide(); /** _agile_ if you want to hide Carriers Section sections  _agile_  **/
    agilesellershipping_update_carrier_totalsummary();
    agilesellershipping_updateCarrierPrice();
});



function update_product_carrier(id_cart, id_product, id_product_attribute) {
    id_carrier = $("#id_carrier_sellershipping_" + id_product + "_" + id_product_attribute).val();
    update_product_carrier_location(id_cart, id_product, id_product_attribute, id_carrier, 0);
}

function update_product_location(id_cart, id_product, id_product_attribute, id_carrier) {
    id_location = $("#id_pklocation_sellershipping_" + id_product + "_" + id_product_attribute).val();
    update_product_carrier_location(id_cart, id_product, id_product_attribute, id_carrier, id_location);
}

function update_product_carrier_location(id_cart, id_product, id_product_attribute, id_carrier, id_location) {
    url = base_dir_ssl + 'modules/agilesellershipping/ajax_update_product_carrier.php';
    $.ajax({
        type: 'POST',
        url: url,
        async: true,
        cache: false,
        data: 'id_cart=' + id_cart_sellershipping + '&id_product=' + id_product + '&id_product_attribute=' + id_product_attribute + '&id_carrier=' + id_carrier + '&id_location=' + id_location,
        success: function (data) {
            if (id_location == 0) {
                $("div#id_location_sellershipping_" + id_product + "_" + id_product_attribute).html(data);
            }
            $("div#sellershipping_totalsummary").html("");
            agilesellershipping_update_carrier_totalsummary();
            agilesellershipping_updateCartSummary();
            agilesellershipping_updateCarrierPrice();
        }
    });
}

function agilesellershipping_updateCarrierPrice() {
    url = base_dir_ssl + 'modules/agilesellershipping/ajax_shipping_price.php';
    $.ajax({
        type: 'POST',
        url: url,
        async: true,
        cache: false,
        data: '',
        success: function (data) {
            /** _agile_ This line for PS 1.4x _agile_  **/
            $("td.carrier_price").html(data);
            /** _agile_ this line for PS 1.5x _agile_  **/
            $(".delivery_option_price").html(data);
        }
    });
}



function agilesellershipping_update_carrier_totalsummary() {
    url = base_dir_ssl + 'modules/agilesellershipping/ajax_carrier_total_summary.php';
    $.ajax({
        type: 'POST',
        url: url,
        async: true,
        cache: false,
        data: 'id_cart=' + id_cart_sellershipping,
        success: function (data) {
            $("div#sellershipping_totalsummary").html(data);
        }
    });
}


function agilesellershipping_updateCartSummary() {
    /** _agile_ alert("calling update"); _agile_  **/
    $.ajax({
        type: 'POST',
        headers: { "cache-control": "no-cache" },
        url: base_dir_ssl + '?rand=' + new Date().getTime(),
        async: true,
        cache: false,
        dataType: 'json',
        data: 'controller=cart&ajax=true&summary=1&token=' + static_token,
        success: function (jsonData) {
            if (jsonData.hasError) {
                alert('error when update cart summary');
            }
            else {
                updateCartSummary(jsonData.summary);
            }
        }
    });

}
