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

var magicscrollState = '';

$(document).ready(function() {
    if (typeof(window['display']) != 'undefined') {
        window['display_original'] = window['display'];
        window['display'] = function display(view) {
            if (typeof(MagicScroll) != 'undefined' && magicscrollState != 'stopped') {
                magicscrollState = 'stopped';
                MagicScroll.stop();
            }
            var r = window['display_original'].apply(window, arguments);
            if (typeof(MagicScroll) != 'undefined' && magicscrollState != 'started') {
                magicscrollState = 'started';
                MagicScroll.start();
            }
            return r;
        }
    }
});

if ($ && $.ajax) {
    (function($) {
        //NOTE: override default ajax method
        var ajax = $.ajax;
        $.ajax = function(url, options) {
            var settings = {};
            if (typeof url === 'object') {
                settings = url;
            } else {
                settings = options || {};
            }
            if (settings.type == 'GET' && settings.url == baseDir+'modules/blocklayered/blocklayered-ajax.php') {
                if (typeof(MagicScroll) != 'undefined' && magicscrollState != 'stopped') {
                    magicscrollState = 'stopped';
                    MagicScroll.stop();
                }
                settings.url = baseDir+'modules/magicscroll/blocklayered-ajax.php';
                settings.successOriginal = settings.success;
                settings.success = function(result) {
                    var r = settings.successOriginal.apply(settings, arguments);
                    if (typeof(MagicScroll) != 'undefined' && magicscrollState != 'started') {
                        magicscrollState = 'started';
                        MagicScroll.start();
                    }
                    return r;
                };
            }
            return ajax(url, options);
        }
    })($);
}
