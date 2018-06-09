/*
$(document).ready(function () {
    getExtendedProductFields(module_dir + "agilemultipleseller/ajax_products.php");
});


function getExtendedProductFields(url) {
    $.ajax({
        url: url,
        data: {
            ajax: true,
            id_product: id_product,
            action: 'getExtendedProductsFields'
        },
        dataType: 'json',
        async: false,
        success: function (data) {
            if (data.status == 'ok') {
                $(data.message + '<div class="separation"></div>').insertBefore("#warn_virtual_combinations");
            }
            else
                alert("Error:" + data.message);
        }
    });
}
*/
