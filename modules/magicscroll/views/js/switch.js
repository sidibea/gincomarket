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


function mtBindSelectors() {

    //NOTE: to swicth between 360, zoom and video
    var magicToolboxTool = 'magicscroll',
        magicToolboxToolMainId = 'MagicScrollImageMainImage',
        isMagicZoom = (magicToolboxTool == 'magiczoom' || magicToolboxTool == 'magiczoomplus'),
        magicToolboxSwitchMetod = mEvent,
        loadVimeoJSFramework = function() {
            //NOTE: to avoid multiple loading
            if (typeof(arguments.callee.loadedVimeoJSFramework) !== 'undefined') {
                return;
            }
            arguments.callee.loadedVimeoJSFramework = true;

            //NOTE: load vimeo js framework
            if (typeof(window.$f) == 'undefined') {
                var firstScriptTag = document.getElementsByTagName('script')[0],
                    newScriptTag = document.createElement('script');
                newScriptTag.async = true;
                newScriptTag.src = 'https://secure-a.vimeocdn.com/js/froogaloop2.min.js';
                firstScriptTag.parentNode.insertBefore(newScriptTag, firstScriptTag);
            }
        },
        loadYoutubeApi = function() {
            //NOTE: to avoid multiple loading
            if (typeof(arguments.callee.loadedYoutubeApi) !== 'undefined') {
                return;
            }
            arguments.callee.loadedYoutubeApi = true;

            //NOTE: load youtube api
            if (typeof(window.YT) == 'undefined' || typeof(window.YT.Player) == 'undefined') {
                var firstScriptTag = document.getElementsByTagName('script')[0],
                    newScriptTag = document.createElement('script');
                newScriptTag.async = true;
                newScriptTag.src = 'https://www.youtube.com/iframe_api';
                firstScriptTag.parentNode.insertBefore(newScriptTag, firstScriptTag);
            }
        },
        pauseYoutubePlayer = function(iframe) {
            if (typeof(arguments.callee.youtubePlayers) === 'undefined') {
                arguments.callee.youtubePlayers = {};
            }
            var id = iframe.getAttribute('id');
            if (id && typeof(arguments.callee.youtubePlayers[id]) != 'undefined') {
                arguments.callee.youtubePlayers[id].pauseVideo();
                return;
            }
            var player = new window.YT.Player(iframe, {
                events: {
                    'onReady': function(event) {
                        event.target.pauseVideo();
                    }
                }
            });
            id = iframe.getAttribute('id');
            arguments.callee.youtubePlayers[id] = player;
            return;
        },
        switchFunction = function(event) {

            event = event || window.event;

            var element = event.target || event.srcElement,
                currentContainer = document.querySelector('.mt-active'),
                currentSlideId = null,
                newSlideId = null,
                newContainer = null,
                switchContainer = false;

            if (!currentContainer) {
                return false;
            }

            if (element.tagName.toLowerCase() != 'a') {
                element = element.parentNode;
                if (element.tagName.toLowerCase() != 'a') {
                    return false;
                }
            }

            currentSlideId = currentContainer.getAttribute('data-magic-slide');
            newSlideId = element.getAttribute('data-magic-slide-id');

            if (currentSlideId == newSlideId/* && currentSlideId == 'zoom'*/) {
                if (isMagicZoom) {
                    allowHighlightActiveSelectorOnUpdate = false;
                    mtHighlightActiveSelector(element);
                }
                return false;
            }

            //NOTE: check when one image + 360 selector
            newContainer = document.querySelector('div[data-magic-slide="'+newSlideId+'"]');

            if (!newContainer) {
                return false;
            }

            if (newSlideId == 'zoom' && isMagicZoom) {
                //NOTE: in order to magiczoom(plus) was not switching selector
                event.stopQueue && event.stopQueue();
            }

            //NOTE: switch slide container
            currentContainer.className = currentContainer.className.replace(/(\s|^)mt-active(\s|$)/, ' ');
            newContainer.className += ' mt-active';

            if (newSlideId == 'zoom' && isMagicZoom) {
                //NOTE: hide image to skip magiczoom(plus) switching effect
                if (!$mjs(element).jHasClass('mz-thumb-selected')) {
                    document.querySelector('#'+magicToolboxToolMainId+' .mz-figure > img').style.visibility = 'hidden';
                }
                //NOTE: switch image
                MagicZoom.switchTo(magicToolboxToolMainId, element);
                allowHighlightActiveSelectorOnUpdate = false;
                mtHighlightActiveSelector(element);
            }

            var videoType = null;

            //NOTE: stop previous video slide
            if (currentSlideId.match(/^video\-\d+$/)) {
                //NOTE: need to stop current video
                var iframe = currentContainer.querySelector('iframe');
                if (iframe) {
                    videoType = iframe.getAttribute('data-video-type');
                    if (videoType == 'vimeo') {
                        var vimeoPlayer = window.$f(iframe);
                        if (vimeoPlayer) {
                            vimeoPlayer.api('pause');
                        }
                    } else if (videoType == 'youtube') {
                        pauseYoutubePlayer(iframe);
                    }
                }
            }

            //NOTE: load api for video if need it
            if (newSlideId.match(/^video\-\d+$/)) {
                videoType = element.getAttribute('data-video-type');
                if (videoType == 'vimeo') {
                    loadVimeoJSFramework();
                } else if (videoType == 'youtube') {
                    loadYoutubeApi();
                }
                if (isMagicZoom) {
                    mtHighlightActiveSelector(element);
                }
            }

            if (newSlideId == '360' && isMagicZoom) {
                mtHighlightActiveSelector(element);
            }

            event.preventDefault ? event.preventDefault() : (event.returnValue = false);

            return false;
        },
        switchEvent,
        magicToolboxLinks = $('.magictoolbox-selector');

    if (isMagicZoom || magicToolboxTool == 'magicthumb') {

        var mjsAddEventMethod = 'je1';
        if (typeof(magicJS.Doc.je1) == 'undefined') {
            mjsAddEventMethod = 'jAddEvent';
        }

        if (isMagicZoom) {
            switchEvent = (magicToolboxSwitchMetod == 'click' ? 'btnclick' : magicToolboxSwitchMetod);
            mtFindAndHighlightActiveSelector();
        }
        //NOTE: a[data-magic-slide-id]
        for (var j = 0; j < magicToolboxLinks.length; j++) {
            if (isMagicZoom) {
                //NOTE: if MagicThumb is present
                if (mjsAddEventMethod == 'je1') {
                    $mjs(magicToolboxLinks[j])[mjsAddEventMethod](magicToolboxSwitchMetod, switchFunction);
                    $mjs(magicToolboxLinks[j])[mjsAddEventMethod]('touchstart', switchFunction);
                } else {
                    $mjs(magicToolboxLinks[j])[mjsAddEventMethod](switchEvent+' tap', switchFunction, 1);
                }
            } else if (magicToolboxTool == 'magicthumb') {
                $mjs(magicToolboxLinks[j])[mjsAddEventMethod](magicToolboxSwitchMetod, switchFunction);
                $mjs(magicToolboxLinks[j])[mjsAddEventMethod]('touchstart', switchFunction);
            }
        }
    }

}

function mtHighlightActiveSelector(selectedElement) {
    //NOTE: to highlight selector when switching thumbnails
    var selectors = $('.magictoolbox-selector');
    if (originalLayout) {
        if (isPrestaShop17x) {
            $(selectors).removeClass('selected');
            $(selectedElement).addClass('selected');
        } else {
            $(selectors).removeClass('shown');
            $(selectedElement).addClass('shown');
        }
    }
}

function mtFindAndHighlightActiveSelector() {
    var activeSlide, slideId, query, thumbnail;
    activeSlide = document.querySelector('.magic-slide.mt-active');
    if (activeSlide) {
        slideId = activeSlide.getAttribute('data-magic-slide');
        query = slideId != 'zoom' ? '[data-magic-slide-id="'+slideId+'"]' : '.mz-thumb.mz-thumb-selected';
        thumbnail = document.querySelector(query);
        if (thumbnail) {
            mtHighlightActiveSelector(thumbnail);
        }
    }
}

function mtClickElement(element, eventType, eventName) {
    var event;
    if (document.createEvent) {
        event = document.createEvent(eventType);
        event.initEvent(eventName, true, true);
        element.dispatchEvent(event);
    } else {
        event = document.createEventObject();
        event.eventType = eventType;
        element.fireEvent('on' + eventName, event);
    }
    return event;
}
