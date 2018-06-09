var base_display = window.display;
window.display = function (v) {
    agile_display(v);
}

function agile_display(view) {
    var sellernames = [];
    $('.product_list > li').each(function (index, element) {
        if ($(element).find('.agile_sellername_onlist').html() == undefined)
            sellernames[index] = '<p class="agile_sellername_onlist"></p>';
        else
            sellernames[index] = '<p class="agile_sellername_onlist">' + $(element).find('.agile_sellername_onlist').html() + '</p>';
    });

    base_display(view);

    $('.product_list > li').each(function (index, element) {
        var html = $(element).html();
        if (view == 'list') {
            html = html + sellernames[index];
        }
        else {
            html = sellernames[index] + html;
        }
        $(element).html(html);
    });
}