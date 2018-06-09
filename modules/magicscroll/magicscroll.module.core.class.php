<?php
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

if (!defined('MAGICSCROLL_MODULE_CORE_CLASS_LOADED')) {

    define('MAGICSCROLL_MODULE_CORE_CLASS_LOADED', true);

    require_once(dirname(__FILE__).'/magictoolbox.params.class.php');

    /**
     * MagicScrollModuleCoreClass
     *
     */
    class MagicScrollModuleCoreClass
    {

        /**
         * MagicToolboxParamsClass class
         *
         * @var   MagicToolboxParamsClass
         *
         */
        public $params;

        /**
         * Tool type
         *
         * @var   string
         *
         */
        public $type = 'category';

        /**
         * Constructor
         *
         * @return void
         */
        public function __construct($reloadDefaults = true)
        {
            static $params = null;
            if ($params === null) {
                $params = new MagicToolboxParamsClass();
                $params->setScope('magicscroll');
                $params->setMapping(array(
                    'width' => array('0' => 'auto'),
                    'height' => array('0' => 'auto'),
                    'step' => array('0' => 'auto'),
                    'pagination' => array('Yes' => 'true', 'No' => 'false'),
                    'scrollOnWheel' => array('turn on' => 'true', 'turn off' => 'false'),
                    'lazy-load' => array('Yes' => 'true', 'No' => 'false'),
                ));
                //NOTE: if the constructor is called for the first time, we load the defaults anyway
                $reloadDefaults = true;
            }
            $this->params = $params;

            //NOTE: do not load defaults, if they have already been loaded by MagicScroll module
            if ($reloadDefaults) {
                $this->loadDefaults();
            }
        }

        /**
         * Method to get headers string
         *
         * @param string $jsPath  Path to JS file
         * @param string $cssPath Path to CSS file
         *
         * @return string
         */
        public function getHeadersTemplate($jsPath = '', $cssPath = null, $linkModuleCss = true)
        {
            //to prevent multiple displaying of headers
            if (!defined('MAGICSCROLL_MODULE_HEADERS')) {
                define('MAGICSCROLL_MODULE_HEADERS', true);
            } else {
                return '';
            }
            if ($cssPath == null) {
                $cssPath = $jsPath;
            }
            $headers = array();
            // add module version
            $headers[] = '<!-- Magic Scroll Prestashop module version v5.9.1 [v1.6.42:v2.0.26] -->';
            $headers[] = '<script type="text/javascript">window["mgctlbx$Pltm"] = "Prestashop";</script>';
            // add tool style link
            $headers[] = '<link type="text/css" href="'.$cssPath.'/magicscroll.css" rel="stylesheet" media="screen" />';
            if ($linkModuleCss) {
                // add module style link
                $headers[] = '<link type="text/css" href="'.$cssPath.'/magicscroll.module.css" rel="stylesheet" media="screen" />';
            }
            // add script link
            $headers[] = '<script type="text/javascript" src="'.$jsPath.'/magicscroll.js"></script>';
            // add options
            $headers[] = $this->getOptionsTemplate();
            return "\r\n".implode("\r\n", $headers)."\r\n";
        }

        /**
         * Method to get options string
         *
         * @return string
         */
        public function getOptionsTemplate()
        {
            return "<script type=\"text/javascript\">\n\tMagicScrollOptions = {\n\t\t".$this->params->serialize(true, ",\n\t\t")."\n\t}\n</script>";
        }

        /**
         * Method to get MagicScroll HTML
         *
         * @param array $itemsData MagicScroll data
         * @param array $params Additional params
         *
         * @return string
         */
        public function getMainTemplate($itemsData, $params = array())
        {
            $id = '';
            $width = '';
            $height = '';

            $html = array();

            extract($params);

            if (empty($width)) {
                $width = '';
            } else {
                $width = " width=\"{$width}\"";
            }
            if (empty($height)) {
                $height = '';
            } else {
                $height = " height=\"{$height}\"";
            }

            if (empty($id)) {
                $id = '';
            } else {
                $id = ' id="'.addslashes($id).'"';
            }

            // add div with tool className
            $additionalClasses = $this->params->getValue('scroll-extra-styles');
            if (empty($additionalClasses)) {
                $additionalClasses = '';
            } else {
                $additionalClasses = ' '.$additionalClasses;
            }

            //NOTE: get personal options
            $options = $this->params->serialize();
            if (empty($options)) {
                $options = '';
            } else {
                $options = ' data-options="'.$options.'"';
            }

            $html[] = '<div'.$id.' class="MagicScroll'.$additionalClasses.'"'.$width.$height.$options.'>';

            // add items
            foreach ($itemsData as $item) {

                $img = '';
                $img2x = '';
                $thumb = '';
                $thumb2x = '';
                $link = '';
                $target = '';
                $alt = '';
                $title = '';
                $description = '';
                $width = '';
                $height = '';
                $medium = '';
                $content = '';

                extract($item);

                // check big image
                if (empty($img)) {
                    $img = '';
                }

                //NOTE: remove this?
                if (!empty($medium)) {
                    $thumb = $medium;
                }

                // check thumbnail
                if (!empty($img) || empty($thumb)) {
                    $thumb = $img;
                }
                if (!empty($img2x) || empty($thumb2x)) {
                    $thumb2x = $img2x;
                }

                // check item link
                if (empty($link)) {
                    $link = '';
                } else {
                    // check target
                    if (empty($target)) {
                        $target = '';
                    } else {
                        $target = ' target="'.$target.'"';
                    }
                    $link = $target.' href="'.addslashes($link).'"';
                }

                // check item alt tag
                if (empty($alt)) {
                    $alt = '';
                } else {
                    $alt = htmlspecialchars(htmlspecialchars_decode($alt, ENT_QUOTES));
                }

                // check title
                if (empty($title)) {
                    $title = '';
                } else {
                    $title = htmlspecialchars(htmlspecialchars_decode($title, ENT_QUOTES));
                    if (empty($alt)) {
                        $alt = $title;
                    }
                    if ($this->params->checkValue('show-image-title', 'No')) {
                        $title = '';
                    }
                }

                // check description
                if (!empty($description) && $this->params->checkValue('show-image-title', 'Yes')) {
                    //$description = preg_replace("/<(\/?)a([^>]*)>/is", "[$1a$2]", $description);
                    //NOTICE: span or div?
                    //NOTICE: scroll takes the first child after image and place it in span.mcs-caption
                    if (empty($title)) {
                        $title = "<span class=\"mcs-description\">{$description}</span>";
                    } else {
                        //NOTE: to wrap title in span for show with description
                        $title = "<span>{$title}<br /><span class=\"mcs-description\">{$description}</span></span>";
                    }
                }

                if (empty($width)) {
                    $width = '';
                } else {
                    $width = " width=\"{$width}\"";
                }
                if (empty($height)) {
                    $height = '';
                } else {
                    $height = " height=\"{$height}\"";
                }

                if (!empty($thumb2x)) {
                    //$thumb2x = ' srcset="'.$thumb2x.' 2x"';
                    $thumb2x = ' srcset="'.$thumb.' 1x, '.$thumb2x.' 2x"';
                }

                // add item
                if (empty($content)) {
                    $html[] = "<a{$link}><img{$width}{$height} src=\"{$thumb}\" {$thumb2x} alt=\"{$alt}\" />{$title}</a>";
                } else {
                    $html[] = "<div class=\"mcs-content-container\">{$content}</div>";
                }
            }

            // close core div
            $html[] = '</div>';

            // create HTML string
            $html = implode('', $html);

            // return result
            return $html;
        }

        /**
         * Method to load defaults options
         *
         * @return void
         */
        public function loadDefaults()
        {
            $params = array(
                'include-headers-on-all-pages'=>array('id'=>'include-headers-on-all-pages','group'=>'General','order'=>'20','default'=>'No','label'=>'Include headers on all pages','description'=>'To be able to apply an effect on any page','type'=>'array','subType'=>'radio','values'=>array('Yes','No'),'scope'=>'module'),
                'thumb-image'=>array('id'=>'thumb-image','group'=>'Image type','order'=>'10','default'=>'large','label'=>'Main image','type'=>'array','subType'=>'select','values'=>array('original','large'),'scope'=>'module'),
                'width'=>array('id'=>'width','group'=>'Scroll','order'=>'10','default'=>'auto','label'=>'Scroll width','description'=>'auto | pixels | percetage','type'=>'text','scope'=>'magicscroll'),
                'height'=>array('id'=>'height','group'=>'Scroll','order'=>'20','default'=>'auto','label'=>'Scroll height','description'=>'auto | pixels | percetage','type'=>'text','scope'=>'magicscroll'),
                'orientation'=>array('id'=>'orientation','group'=>'Scroll','order'=>'30','default'=>'horizontal','label'=>'Orientation of scroll','type'=>'array','subType'=>'radio','values'=>array('horizontal','vertical'),'scope'=>'magicscroll'),
                'mode'=>array('id'=>'mode','group'=>'Scroll','order'=>'40','default'=>'scroll','label'=>'Scroll mode','type'=>'array','subType'=>'radio','values'=>array('scroll','animation','carousel','cover-flow'),'scope'=>'magicscroll'),
                'items'=>array('id'=>'items','group'=>'Scroll','order'=>'50','default'=>'3','label'=>'Items to show','description'=>'auto | fit | integer | array','type'=>'text','scope'=>'magicscroll'),
                'speed'=>array('id'=>'speed','group'=>'Scroll','order'=>'60','default'=>'600','label'=>'Scroll speed (in milliseconds)','description'=>'e.g. 5000 = 5 seconds','type'=>'num','scope'=>'magicscroll'),
                'autoplay'=>array('id'=>'autoplay','group'=>'Scroll','order'=>'70','default'=>'0','label'=>'Autoplay speed (in milliseconds)','description'=>'e.g. 0 = disable autoplay; 600 = 0.6 seconds','type'=>'num','scope'=>'magicscroll'),
                'loop'=>array('id'=>'loop','group'=>'Scroll','order'=>'80','advanced'=>'1','default'=>'infinite','label'=>'Continue scroll after the last(first) image','description'=>'infinite - scroll in loop; rewind - rewind to the first image; off - stop on the last image','type'=>'array','subType'=>'radio','values'=>array('infinite','rewind','off'),'scope'=>'magicscroll'),
                'step'=>array('id'=>'step','group'=>'Scroll','order'=>'90','default'=>'auto','label'=>'Number of items to scroll','description'=>'auto | integer','type'=>'text','scope'=>'magicscroll'),
                'arrows'=>array('id'=>'arrows','group'=>'Scroll','order'=>'100','default'=>'inside','label'=>'Prev/Next arrows','type'=>'array','subType'=>'radio','values'=>array('inside','outside','off'),'scope'=>'magicscroll'),
                'pagination'=>array('id'=>'pagination','group'=>'Scroll','order'=>'110','advanced'=>'1','default'=>'No','label'=>'Show pagination (bullets)','type'=>'array','subType'=>'radio','values'=>array('Yes','No'),'scope'=>'magicscroll'),
                'easing'=>array('id'=>'easing','group'=>'Scroll','order'=>'120','advanced'=>'1','default'=>'cubic-bezier(.8, 0, .5, 1)','label'=>'CSS3 Animation Easing','description'=>'see cubic-bezier.com','type'=>'text','scope'=>'magicscroll'),
                'scrollOnWheel'=>array('id'=>'scrollOnWheel','group'=>'Scroll','order'=>'130','advanced'=>'1','default'=>'auto','label'=>'Scroll On Wheel mode','description'=>"auto - automatically turn off scrolling on mouse wheel in the 'scroll' and 'animation' modes, and enable it in 'carousel' and 'cover-flow' modes",'type'=>'array','subType'=>'radio','values'=>array('auto','turn on','turn off'),'scope'=>'magicscroll'),
                'lazy-load'=>array('id'=>'lazy-load','group'=>'Scroll','order'=>'140','advanced'=>'1','default'=>'No','label'=>'Lazy load','description'=>'Delay image loading. Images outside of view will be loaded on demand.','type'=>'array','subType'=>'radio','values'=>array('Yes','No'),'scope'=>'magicscroll'),
                'scroll-extra-styles'=>array('id'=>'scroll-extra-styles','group'=>'Scroll','order'=>'150','advanced'=>'1','default'=>'','label'=>'Scroll extra styles','description'=>'mcs-rounded | mcs-shadows | bg-arrows | mcs-border','type'=>'text','scope'=>'module'),
                'show-image-title'=>array('id'=>'show-image-title','group'=>'Scroll','order'=>'160','default'=>'No','label'=>'Show image title','type'=>'array','subType'=>'radio','values'=>array('Yes','No'),'scope'=>'module'),
                'max-number-of-products'=>array('id'=>'max-number-of-products','group'=>'Miscellaneous','order'=>'0','default'=>'1','label'=>'Products displayed','description'=>'Set the number of products to be displayed in this block','type'=>'num','scope'=>'module'),
                'enable-effect'=>array('id'=>'enable-effect','group'=>'Miscellaneous','order'=>'10','default'=>'Yes','label'=>'Enable effect','type'=>'array','subType'=>'select','values'=>array('Yes','No'),'scope'=>'module'),
                'link-to-product-page'=>array('id'=>'link-to-product-page','group'=>'Miscellaneous','order'=>'20','default'=>'Yes','label'=>'Link image to the product page','type'=>'array','subType'=>'select','values'=>array('Yes','No'),'scope'=>'module')
            );
            $this->params->appendParams($params);
        }
    }

}
