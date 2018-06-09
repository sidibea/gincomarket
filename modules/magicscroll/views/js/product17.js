/**
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    Magic Toolbox <support@magictoolbox.com>
*  @copyright Copyright (c) 2015 Magic Toolbox <support@magictoolbox.com>. All rights reserved
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

function mtDefer(method) {
    if (window.jQuery) {
        method();
    } else {
        setTimeout(function() { mtDefer(method) }, 50);
    }
}

mtDefer(function () {

    $(document).ready(function() {

        prestashop.on('updatedProduct', function (resp) {

            var productId = $('#product_page_product_id').val(),
                msContainer = $('#productMagicSlideshow');

            //NOTE: add selecrors
            var ids = mtСombinationData.attributes[resp.id_product_attribute];
            if (ids) {
                for (var i = 0; i < mtСombinationData.order.length; i++) {
                    if (ids.indexOf(mtСombinationData.order[i]) >= 0) {
                        MagicScroll.jump('productMagicScroll', i);
                        break;
                    }
                }
            }
        });
    });
});

function mtCreateSelectorContainer() {
    var productId = $('#product_page_product_id').val();

    switch(mtLayout) {
        case 'original':
            $('.mt-images-container .product-cover').after(
                '<div class="MagicToolboxSelectorsContainer js-qv-mask mask">'+
                  '<ul id="MagicToolboxSelectors'+productId+'" class="product-images js-qv-product-images">'+
                  '</ul>'+
                '</div>'
            );
            break;
        case 'bottom':
        case 'right':
            $('#content .MagicToolboxContainer').append(
                '<div class="MagicToolboxSelectorsContainer">'+
                  '<div id="MagicToolboxSelectors'+productId+'">'+
                  '</div>'+
                '</div>'
            );
            break;
        case 'top':
        case 'left':
            $('#content .MagicToolboxContainer').prepend(
                '<div class="MagicToolboxSelectorsContainer">'+
                  '<div id="MagicToolboxSelectors'+productId+'">'+
                  '</div>'+
                '</div>'
            );
            break;
        default:
            break;
    }
}
