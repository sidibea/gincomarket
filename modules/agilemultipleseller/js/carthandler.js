/** _agile_ when document is loaded... _agile_  **/
$(document).ready(function () {
    setTimeout(overrideAjaxCart, 200);
});

function overrideAjaxCart() {
    if (isAjaxCartEnabled == 1) {
        var origUpdateCart = ajaxCart.updateCart;
        ajaxCart.updateCart = function (data) {
            origUpdateCart(data);
            replaceClickHandler();
        }
    }

    replaceClickHandler();
}


function replaceClickHandler() {
    /** _agile_ for every 'add' buttons... _agile_  **/
    $('.ajax_add_to_cart_button').unbind('click').click(function () {
        var idProduct = $(this).attr('data-id-product').replace('ajax_id_product_', '');
        if ($(this).attr('disabled') != 'disabled') {
            checkSellers(idProduct, null, false, this);
            return false;
        }
    });

    /** _agile_ for product page 'add' button... _agile_  **/
    $('p#add_to_cart input').unbind('click').click(function () {
        checkSellers($('#product_page_product_id').val(), $('#idCombination').val(), true, null, $('#quantity_wanted').val(), null);
        return false;
    });

    $('p#add_to_cart button').unbind('click').click(function () {
        checkSellers($('#product_page_product_id').val(), $('#idCombination').val(), true, null, $('#quantity_wanted').val(), null);
        return false;
    });
}

function checkSellers(idProduct, idCombination, addedFromProductPage, callerElement, quantity, whishlist) {
    var url = module_dir + 'ajax_checkseller.php';
    /** _agile_ alert(url); _agile_  **/
    $.post(url, { id_product: idProduct },
            function (data) {
                if (data == 'OK') {
                    if (isAjaxCartEnabled == 1) {
                        ajaxCart.add(idProduct, idCombination, addedFromProductPage, callerElement, quantity, whishlist);
                        return false;
                    }
                    else {
                        /** _agile_                         alert(callerElement); _agile_  **/
                        if (callerElement != null) window.location.href = $(callerElement).attr("href");
                        else $('form#buy_block').submit();
                        return true;
                    }
                } else {
                    /** _agile_ show error message _agile_  **/
                    alert(data);
                    return false;
                }
            });
}


