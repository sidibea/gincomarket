$(document).ready(function () {
    $(document).on('click', '#seller_tab', function (e) {
        hideOrDisplaySellerInfoThemeStyle();
    });

});

function hideOrDisplaySellerInfoThemeStyle() {
    if ($("input[id='seller_tab']").attr('checked') == 'checked')
    {
        $('div.seller_info_theme').removeClass('hidden');
        $("#vertical").attr('checked', true).checkboxradio('refresh', true);
        $("#horizonal").attr('checked', false).checkboxradio('refresh', true);
    } else {
        $('div.seller_info_theme').addClass('hidden');
        $("#vertical").attr('checked', false).checkboxradio('refresh', true);
        $("#horizonal").attr('checked', false).checkboxradio('refresh', true);
    }
}
