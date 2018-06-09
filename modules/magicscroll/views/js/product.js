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

var mjsAddEventMethod = 'je1';
if (typeof(magicJS.Doc.je1) == 'undefined') {
    mjsAddEventMethod = 'jAddEvent';
}

var magictoolboxImagesOrder;
updateMagicScrollIntervalID = null;

window['refreshProductImagesOriginal'] = window['refreshProductImages'];
window['refreshProductImages'] = function(id_product_attribute) {

    id_product_attribute = parseInt(id_product_attribute);

    //NOTE: to avoid double restart
    if (typeof(arguments.callee.last_id_product_attribute) !== 'undefined' && (arguments.callee.last_id_product_attribute == id_product_attribute)) {
        var r = window['refreshProductImagesOriginal'].apply(window, arguments);
        return r;
    }
    arguments.callee.last_id_product_attribute = id_product_attribute;

    //NOTE: does not scroll until tool is ready

    //NOTE: clears a timer
    if (updateMagicScrollIntervalID != null) {
        clearInterval(updateMagicScrollIntervalID);
        updateMagicScrollIntervalID = null;
    }
    //NOTE: set a timer
    mtIntervals = isProductMagicScrollReady ? 0 : 500;
    updateMagicScrollIntervalID = setInterval(function() {
        if (isProductMagicScrollReady) {
            clearInterval(updateMagicScrollIntervalID);
            updateMagicScrollIntervalID = null;

            var idCombination = $('#idCombination').val();
            for (var i in combinations) {
                if (combinations[i]['idCombination'] == idCombination) {
                    var position = jQuery.inArray(combinations[i]['image'], magictoolboxImagesOrder);
                    MagicScroll.jump('productMagicScroll', position);
                    //DEPRECATED:
                    //$('#bigpic').attr('src', $('#productMagicScroll img').get(position).src);
                    break;
                }
            }
        }
    }, mtIntervals);

    var r = window['refreshProductImagesOriginal'].apply(window, arguments);
    return r;

}


