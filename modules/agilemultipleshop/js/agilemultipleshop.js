$(document).ready(function () {
    bindSellerGrid();
});


function bindSellerGrid() {
    var view = $.totalStorage('display');

    if (view && view != 'grid')
        displaySeller(view);
    else {
        displaySeller('grid');
        $('.display').find('li#grid').addClass('selected');
    }

    $(document).on('click', '#grid', function (e) {
        e.preventDefault();
        displaySeller('grid');
    });

    $(document).on('click', '#list', function (e) {
        e.preventDefault();
        displaySeller('list');
    });
}

function displaySeller(view) {
    if (view == 'list') {
        $('#listview').removeClass('hidden').addClass('list row');
        $('#gridview').removeClass('grid').addClass('hidden');
        $('.display').find('li#list').addClass('selected');
        $('.display').find('li#grid').removeAttr('class');
        $.totalStorage('display', 'list');
    }
    else {
        $('#gridview').removeClass('hidden').addClass('grid row');
        $('#listview').removeClass('list').addClass('hidden');
        $('.display').find('li#grid').addClass('selected');
        $('.display').find('li#list').removeAttr('class');
        $.totalStorage('display', 'grid');
    }
}

function jumptoagilesellerspage(base_dir_ssl,filter, loclevel, parentid)
{
    var seller_type = $("#seller_type").val();
    var seller_location = $("#seller_location").val();
    var userview = $.totalStorage('display');
    var data = "filter=" + filter + "&loclevel=" + loclevel + "&seller_type=" + seller_type + "&parentid=" + parentid + "&seller_location=" + encodeURI(seller_location) + '&userview=' + userview;
    var url = base_dir_ssl + 'modules/agilemultipleshop/ajax_getsellerpageurl.php?' + data;
    /// alert(url);
    $.ajax({
        url: url,
        type: "POST",
        async: true,
        success: function(returl) {
            window.location.href = returl;
        },
        error: function() {
            alert("Unexpected error");
        }
    });

}

