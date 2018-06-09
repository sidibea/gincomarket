$(document).ready(function () {
    toggleSpecificPrice();

    $('#specific_prices_list').delegate('a[name="delete_link"]', 'click', function (e) {
        e.preventDefault();
        deleteSpecificPrice(this.href, $(this).parents('tr'));
    })

    if (currentmenuid && currentmenuid == 4) {
        $('#product_autocomplete_input')
			.autocomplete(base_dir + 'ajax_products_list.php', {
			    minChars: 1,
			    autoFill: true,
			    max: 20,
			    matchContains: true,
			    mustMatch: true,
			    scroll: false,
			    cacheLength: 0,
			    formatItem: function (item) {
			        return item[1] + ' - ' + item[0];
			    }
			}).result(self.addAccessory);

        $('#product_autocomplete_input').setOptions({
            extraParams: {
                excludeIds: getAccessoriesIds()
            }
        });

    }
    function getAccessoriesIds() {
        if ($('#inputAccessories').val() === undefined)
            return '';
        var ids = id_product + ',';
        ids += $('#inputAccessories').val().replace(/\\-/g, ',').replace(/\\,$/, '');
        ids = ids.replace(/\,$/, '');

        return ids;
    }

});

/**
* Ajax call to delete a specific price
*
* @param ids
* @param token
* @param parent
*/
function deleteSpecificPrice(url, parent) {
    $.ajax({
        url: url,
        data: {
            ajax: true
        },
        context: document.body,
        dataType: 'json',
        context: this,
        async: false,
        type: "POST",
        success: function (data) {
            if (data.status == 'ok') {
                /** _agile_                 showSuccessMessage(data.message); _agile_  **/
                parent.remove();
            }
            else
                showErrorMessage(data.message);
        }
    });
}


function toggleSpecificPrice() {
    $('#show_specific_price').click(function () {
        $('#add_specific_price').slideToggle();

        $('#add_specific_price').append('<input type="hidden" name="submitPriceAddition"/>');

        $('#hide_specific_price').show();
        $('#show_specific_price').hide();
        return false;
    });

    $('#hide_specific_price').click(function () {
        $('#add_specific_price').slideToggle();
        $('#add_specific_price').find('input[name=submitPriceAddition]').remove();

        $('#hide_specific_price').hide();
        $('#show_specific_price').show();
        return false;
    });
}

function addAccessory(event, data, formatted) {
    if (data == null)
        return false;
    var productId = data[1];
    var productName = data[0];

    var $divAccessories = $('#divAccessories');
    var $inputAccessories = $('#inputAccessories');
    var $nameAccessories = $('#nameAccessories');

    /* delete product from select + add product line to the div, input_name, input_ids elements */
    $divAccessories.html($divAccessories.html() + productName + ' <span onclick="delAccessory(' + productId + ');" style="cursor: pointer;"><img src="' + base_dir + 'img/admin/delete.gif" /></span><br />');
    $nameAccessories.val($nameAccessories.val() + productName + '¤');
    $inputAccessories.val($inputAccessories.val() + productId + '-');
    $('#product_autocomplete_input').val('');
}


function delAccessory(id) {
    var div = getE('divAccessories');
    var input = getE('inputAccessories');
    var name = getE('nameAccessories');

    /** _agile_  Cut hidden fields in array _agile_  **/
    var inputCut = input.value.split('-');
    var nameCut = name.value.split('¤');

    if (inputCut.length != nameCut.length)
        return jAlert('Bad size');

    /** _agile_  Reset all hidden fields _agile_  **/
    input.value = '';
    name.value = '';
    div.innerHTML = '';
    for (i in inputCut) {
        /** _agile_  If empty, error, next _agile_  **/
        if (!inputCut[i] || !nameCut[i])
            continue;

        /** _agile_  Add to hidden fields no selected products OR add to select field selected product _agile_  **/
        if (inputCut[i] != id) {
            input.value += inputCut[i] + '-';
            name.value += nameCut[i] + '¤';
            div.innerHTML += nameCut[i] + ' <span onclick="delAccessory(' + inputCut[i] + ');" style="cursor: pointer;"><img src="' + base_dir + 'img/admin/delete.gif" /></span><br />';
        }
        else
            $('#selectAccessories').append('<option selected="selected" value="' + inputCut[i] + '-' + nameCut[i] + '">' + inputCut[i] + ' - ' + nameCut[i] + '</option>');
    }

}


function doFrontAjax(url, data, success_func, error_func) {
    $.ajax(
    {
        url: url,
        data: data,
        type: "POST",
        success: function (data) {
            if (success_func)
                return success_func(data);

            data = $.parseJSON(data);
            if (data.confirmations.length != 0)
                showSuccessMessage(data.confirmations);
            else
                showErrorMessage(data.error);
        },
        error: function (data) {
            if (error_func)
                return error_func(data);

            alert("[TECHNICAL ERROR]");
        }
    });
}

function noComma(elem) {
    getE(elem).value = getE(elem).value.replace(new RegExp(',', 'g'), '.');
}

function getE(name) {
    if (document.getElementById)
        var elem = document.getElementById(name);
    else if (document.all)
        var elem = document.all[name];
    else if (document.layers)
        var elem = document.layers[name];
    return elem;
}
