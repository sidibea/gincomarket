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

if (!defined('_PS_VERSION_')) {
    exit;
}

if (!isset($GLOBALS['magictoolbox'])) {
    $GLOBALS['magictoolbox'] = array();
    $GLOBALS['magictoolbox']['filters'] = array();
    $GLOBALS['magictoolbox']['isProductScriptIncluded'] = false;
    $GLOBALS['magictoolbox']['standardTool'] = '';
    $GLOBALS['magictoolbox']['selectorImageType'] = '';
    $GLOBALS['magictoolbox']['isProductBlockProcessed'] = false;
}

if (!isset($GLOBALS['magictoolbox']['magicscroll'])) {
    $GLOBALS['magictoolbox']['magicscroll'] = array();
    $GLOBALS['magictoolbox']['magicscroll']['headers'] = false;
    $GLOBALS['magictoolbox']['magicscroll']['scripts'] = '';
}

class MagicScroll extends Module
{

    /* PrestaShop v1.5 or above */
    public $isPrestaShop15x = false;

    /* PrestaShop v1.5.5.0 or above */
    public $isPrestaShop155x = false;

    /* PrestaShop v1.6 or above */
    public $isPrestaShop16x = false;

    /* PrestaShop v1.7 or above */
    public $isPrestaShop17x = false;

    /* Smarty v3 template engine */
    public $isSmarty3 = false;

    /* Smarty 'getTemplateVars' function name */
    public $getTemplateVars = 'getTemplateVars';

    /* Suffix was added to default images types since version 1.5.1.0 */
    public $imageTypeSuffix = '';

    /* To display 'product.js' file inline */
    public $displayInlineProductJs = false;

    /* Ajax request flag */
    public $isAjaxRequest = false;

    /* Featured Products module name */
    public $featuredProductsModule = 'homefeatured';

    /* Top-sellers block module name */
    public $topSellersModule = 'blockbestsellers';

    /* New Products module name */
    public $newProductsModule = 'blocknewproducts';

    /* Specials Products module name */
    public $specialsProductsModule = 'blockspecials';

    /* NOTE: identifying PrestaShop version class */
    public $psVersionClass = 'mt-ps-old';

    public function __construct()
    {
        $this->name = 'magicscroll';
        $this->tab = 'Tools';
        $this->version = '5.9.1';
        $this->author = 'Magic Toolbox';


        $this->module_key = '0da9dca768b05e93d1cde8b495070296';

        //NOTE: to link bootstrap css for settings page in v1.6
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = 'Magic Scroll';
        $this->description = 'Effortlessly scroll through images and/or text on your web pages.';

        $this->confirmUninstall = 'All magicscroll settings would be deleted. Do you really want to uninstall this module ?';

        $this->isPrestaShop15x = version_compare(_PS_VERSION_, '1.5', '>=');
        $this->isPrestaShop155x = version_compare(_PS_VERSION_, '1.5.5', '>=');
        $this->isPrestaShop16x = version_compare(_PS_VERSION_, '1.6', '>=');
        $this->isPrestaShop17x = version_compare(_PS_VERSION_, '1.7', '>=');

        $this->displayInlineProductJs = version_compare(_PS_VERSION_, '1.6.0.3', '>=') && version_compare(_PS_VERSION_, '1.6.0.7', '<');

        if ($this->isPrestaShop16x) {
            $this->tab = 'others';
        }

        $this->isSmarty3 = $this->isPrestaShop15x || Configuration::get('PS_FORCE_SMARTY_2') === '0';
        if ($this->isSmarty3) {
            //Smarty v3 template engine
            $this->getTemplateVars = 'getTemplateVars';
        } else {
            //Smarty v2 template engine
            $this->getTemplateVars = 'get_template_vars';
        }

        $this->imageTypeSuffix = version_compare(_PS_VERSION_, '1.5.1.0', '>=') ? '_default' : '';

        $this->isAjaxRequest = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');

        if ($this->isPrestaShop17x) {
            $this->featuredProductsModule = 'ps_featuredproducts';
            $this->topSellersModule = 'ps_bestsellers';
            $this->newProductsModule = 'ps_newproducts';
            $this->specialsProductsModule = 'ps_specials';
        }

        if (version_compare(_PS_VERSION_, '1.4.5.1', '>=')) {
            $this->psVersionClass = 'mt-ps-1451x';
            if ($this->isPrestaShop15x) {
                $this->psVersionClass = 'mt-ps-15x';
                if ($this->isPrestaShop16x) {
                    $this->psVersionClass = 'mt-ps-16x';
                    if ($this->isPrestaShop17x) {
                        $this->psVersionClass = 'mt-ps-17x';
                    }
                }
            }
        }
    }

    protected function _generateConfigXml($need_instance = 1)
    {
        //NOTE: this fix an issue with description in PrestaShop 1.4
        $description = htmlentities($this->description, ENT_COMPAT, 'UTF-8');
        $this->description = htmlentities($description);
        return parent::_generateConfigXml($need_instance);
    }

    public function install()
    {
        if ($this->isPrestaShop15x) {
            if ($this->isPrestaShop16x) {
                if ($this->isPrestaShop17x) {
                    $homeHookID = Hook::getIdByName('displayHome');
                    $homeHookName = 'displayHome';
                } else {
                    $homeHookID = Hook::getIdByName('displayTopColumn');
                    $homeHookName = 'displayTopColumn';
                }
            } else {
                $homeHookID = Hook::getIdByName('displayHome');
                $homeHookName = 'displayHome';
            }
        } else {
            $homeHookID = Hook::get('home');
            $homeHookName = 'home';
        }
        $headerHookID = $this->isPrestaShop15x ? Hook::getIdByName('displayHeader') : Hook::get('header');

        if (!parent::install()
            || !$this->registerHook($this->isPrestaShop15x ? 'displayHeader' : 'header')
            || $this->isPrestaShop17x && !$this->registerHook('actionDispatcher')
            || !$this->registerHook($this->isPrestaShop15x ? 'displayFooterProduct' : 'productFooter')
            || !$this->registerHook($this->isPrestaShop15x ? 'displayFooter' : 'footer')
            || !$this->installDB()
            || !$this->fixCSS()
            || !$this->registerHook($homeHookName)
            //NOTICE: this function can return false if the module is the only one in this position
            || !($this->updatePosition($homeHookID, 0, 1) || true)
            || !$this->createImageFolder('magicscroll')
            //NOTICE: this function can return false if the module is the only one in this position
            || !($this->updatePosition($headerHookID, 0, 1) || true)
            /**/) {
            return false;
        }

        return true;
    }

    private function createImageFolder($imageFolderName)
    {
        if (!is_dir(_PS_IMG_DIR_.$imageFolderName)) {
            if (!mkdir(_PS_IMG_DIR_.$imageFolderName, 0755)) {
                return false;
            }
        }
        return true;
    }

    private function installDB()
    {
        if (!Db::getInstance()->Execute('CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'magicscroll_settings` (
                                        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                                        `block` VARCHAR(32) NOT NULL,
                                        `name` VARCHAR(32) NOT NULL,
                                        `value` TEXT,
                                        `default_value` TEXT,
                                        `enabled` TINYINT(1) UNSIGNED NOT NULL,
                                        `default_enabled` TINYINT(1) UNSIGNED NOT NULL,
                                        PRIMARY KEY (`id`)
                                        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;')
            || !$this->fillDB()
            || !$this->fixDefaultValues()
            || !Db::getInstance()->Execute('CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'magicscroll_images` (
                                            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                                            `order` INT UNSIGNED DEFAULT 0,
                                            `name` VARCHAR(64) NOT NULL DEFAULT \'\',
                                            `ext` VARCHAR(16) NOT NULL DEFAULT \'\',
                                            `title` VARCHAR(64) NOT NULL DEFAULT \'\',
                                            `description` TEXT,
                                            `link` VARCHAR(256) NOT NULL DEFAULT \'\',
                                            `lang` INT(10) UNSIGNED DEFAULT 0,
                                            `enabled` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1,
                                            PRIMARY KEY (`id`)
                                            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;')
        /**/) {
            return false;
        }

        return true;
    }

    private function fixCSS()
    {
        //fix url's in css files
        $path = dirname(__FILE__);
        $list = glob($path.'/*');
        $files = array();
        if (is_array($list)) {
            $listLength = count($list);
            for ($i = 0; $i < $listLength; $i++) {
                if (is_dir($list[$i])) {
                    if (!in_array(basename($list[$i]), array('.svn', '.git'))) {
                        $add = glob($list[$i].'/*');
                        if (is_array($add)) {
                            $list = array_merge($list, $add);
                            $listLength += count($add);
                        }
                    }
                } elseif (preg_match('#\.css$#i', $list[$i])) {
                    $files[] = $list[$i];
                }
            }
        }
        foreach ($files as $file) {
            $cssPath = dirname($file);
            $cssRelPath = str_replace($path, '', $cssPath);
            $toolPath = _MODULE_DIR_.'magicscroll'.$cssRelPath;
            $pattern = '#url\(\s*(\'|")?(?!data:|mhtml:|http(?:s)?:|/)([^\)\s\'"]+?)(?(1)\1)\s*\)#is';
            $replace = 'url($1'.$toolPath.'/$2$1)';
            $fileContents = Tools::file_get_contents($file);
            $fixedFileContents = preg_replace($pattern, $replace, $fileContents);
            //preg_match_all($pattern, $fileContents, $matches, PREG_SET_ORDER);
            //debug_log($matches);
            if ($fixedFileContents != $fileContents) {
                $fp = fopen($file, 'w+');
                if ($fp) {
                    fwrite($fp, $fixedFileContents);
                    fclose($fp);
                }
            }
        }

        return true;
    }


    public function fixDefaultValues()
    {
        $result = true;
        if (version_compare(_PS_VERSION_, '1.5.1.0', '>=')) {
            $sql = 'UPDATE `'._DB_PREFIX_.'magicscroll_settings` SET `value`=CONCAT(value, \'_default\'), `default_value`=CONCAT(default_value, \'_default\') WHERE (`name`=\'thumb-image\' OR `name`=\'selector-image\' OR `name`=\'large-image\') AND `value`!=\'original\'';
            $result = Db::getInstance()->Execute($sql);
        }
        if ($this->isPrestaShop16x) {
            $sql = 'UPDATE `'._DB_PREFIX_.'magicscroll_settings` SET `value`=\'home_default\', `default_value`=\'home_default\', `enabled`=1 WHERE `name`=\'thumb-image\' AND (`block`=\'homefeatured\' OR `block`=\'blocknewproducts_home\' OR `block`=\'blockbestsellers_home\' OR `block`=\'blockspecials_home\')';
            $result = Db::getInstance()->Execute($sql);
        }
        if ($this->isPrestaShop17x) {
            $sql = 'UPDATE `'._DB_PREFIX_.'magicscroll_settings` SET `enabled`=1, `value`=\'large_default\', `default_value`=\'large_default\' WHERE `name`=\'large-image\'';
            $result = Db::getInstance()->Execute($sql);
            $sql = 'UPDATE `'._DB_PREFIX_.'magicscroll_settings` SET `enabled`=1, `value`=\'medium_default\', `default_value`=\'medium_default\' WHERE `name`=\'thumb-image\' AND `block`=\'product\'';
            $result = Db::getInstance()->Execute($sql);
            $sql = 'UPDATE `'._DB_PREFIX_.'magicscroll_settings` SET `enabled`=1, `value`=\'home_default\', `default_value`=\'home_default\' WHERE `name`=\'thumb-image\' AND (`block`=\'category\' OR `block`=\'manufacturer\' OR `block`=\'newproductpage\' OR `block`=\'bestsellerspage\' OR `block`=\'specialspage\')';
            $result = Db::getInstance()->Execute($sql);
            $sql = 'UPDATE `'._DB_PREFIX_.'magicscroll_settings` SET `enabled`=1, `value`=\'home_default\', `default_value`=\'home_default\' WHERE `name`=\'thumb-image\' AND (`block`=\'blocknewproducts_home\' OR `block`=\'blockbestsellers_home\' OR `block`=\'blockspecials_home\' OR `block`=\'homefeatured\')';
            $result = Db::getInstance()->Execute($sql);
            $sql = 'UPDATE `'._DB_PREFIX_.'magicscroll_settings` SET `enabled`=1, `value`=\'small_default\', `default_value`=\'small_default\' WHERE `name`=\'thumb-image\' AND (`block`=\'blocknewproducts\' OR `block`=\'blockbestsellers\' OR `block`=\'blockspecials\' OR `block`=\'blockviewed\')';
            $result = Db::getInstance()->Execute($sql);
        }
        return $result;
    }

    public function uninstall()
    {
        if (version_compare(_PS_VERSION_, '1.5.5.0', '>=')) {
            $this->_clearCache('*');
        }
        if (!parent::uninstall() || !$this->uninstallDB()) {
            return false;
        }
        return true;
    }

    private function uninstallDB()
    {
        return Db::getInstance()->Execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'magicscroll_settings`;');
    }

    public function disable($forceAll = false)
    {
        if (version_compare(_PS_VERSION_, '1.5.5.0', '>=')) {
            $this->_clearCache('*');
        }
        return parent::disable($forceAll);
    }

    public function enable($forceAll = false)
    {
        if (version_compare(_PS_VERSION_, '1.5.5.0', '>=')) {
            $this->_clearCache('*');
        }
        return parent::enable($forceAll);
    }

    public function _clearCache($template, $cache_id = null, $compile_id = null)
    {
        if ($this->isPrestaShop17x) {
            $this->name = 'ps_featuredproducts';
            parent::_clearCache('ps_featuredproducts.tpl', 'ps_featuredproducts');

            $this->name = 'ps_bestsellers';
            parent::_clearCache('module:ps_bestsellers/views/templates/hook/ps_bestsellers.tpl');

            $this->name = 'ps_newproducts';
            parent::_clearCache('module:ps_newproducts/views/templates/hook/ps_newproducts.tpl');

            $this->name = 'ps_specials';
            parent::_clearCache('module:ps_specials/views/templates/hook/ps_specials.tpl');

            $this->name = 'magicscroll';
            return;
        }

        $this->name = 'homefeatured';//NOTE: spike to clear cache for 'homefeatured.tpl'
        parent::_clearCache('homefeatured.tpl');
        parent::_clearCache('tab.tpl', 'homefeatured-tab');

        $this->name = 'blockbestsellers';
        parent::_clearCache('blockbestsellers.tpl');
        parent::_clearCache('blockbestsellers-home.tpl', 'blockbestsellers-home');
        parent::_clearCache('blockbestsellers.tpl', 'blockbestsellers_col');
        parent::_clearCache('tab.tpl', 'blockbestsellers-tab');

        $this->name = 'blocknewproducts';
        parent::_clearCache('blocknewproducts.tpl');
        parent::_clearCache('blocknewproducts_home.tpl', 'blocknewproducts-home');
        parent::_clearCache('tab.tpl', 'blocknewproducts-tab');

        $this->name = 'blockspecials';
        parent::_clearCache('blockspecials.tpl');
        parent::_clearCache('blockspecials-home.tpl', 'blockspecials-home');
        parent::_clearCache('tab.tpl', 'blockspecials-tab');

        $this->name = 'blockspecials';
        parent::_clearCache('blockspecials.tpl');

        $this->name = 'magicscroll';
    }

    public function getImagesTypes()
    {
        if (!isset($GLOBALS['magictoolbox']['imagesTypes'])) {
            $GLOBALS['magictoolbox']['imagesTypes'] = array('original');
            //NOTE: get image type values
            $sql = 'SELECT name FROM `'._DB_PREFIX_.'image_type` ORDER BY `id_image_type` ASC';
            $result = Db::getInstance()->ExecuteS($sql);
            foreach ($result as $row) {
                $GLOBALS['magictoolbox']['imagesTypes'][] = $row['name'];
            }
        }
        return $GLOBALS['magictoolbox']['imagesTypes'];
    }

    public function getContent()
    {
        $action = Tools::getValue('magicscroll-submit-action', false);
        $activeTab = Tools::getValue('magicscroll-active-tab', false);

        if ($action == 'reset' && $activeTab) {
            Db::getInstance()->Execute(
                'UPDATE `'._DB_PREFIX_.'magicscroll_settings` SET `value`=`default_value`, `enabled`=`default_enabled` WHERE `block`=\''.pSQL($activeTab).'\''
            );
        }

        $tool = $this->loadTool();
        $paramsMap = $this->getParamsMap();

        $_imagesTypes = array(
            'thumb'
        );

        foreach ($_imagesTypes as $name) {
            foreach ($this->getBlocks() as $blockId => $blockLabel) {
                if ($tool->params->paramExists($name.'-image', $blockId)) {
                    $tool->params->setValues($name.'-image', $this->getImagesTypes(), $blockId);
                }
            }
        }

        $paramData = $tool->params->getParam('enable-effect', 'homeslideshow');
        $paramData['label'] = 'Show slideshow on home page';
        $paramData['description'] = '<h2>Slideshow shortcodes</h2>'.
            'In order to show slideshow on any CMS page just insert slideshow shortcode <b>[magicscroll]</b>.<br />'.
            'If you want to show slideshow with specific images only, please use shortcode <b>[magicscroll id=1,2,5]</b> where 1, 2 and 5 are numbers of images from the ID column.';

        $tool->params->appendParams(array('enable-effect' => $paramData), 'homeslideshow');


        //debug_log($_GET);
        //debug_log($_POST);

        $params = Tools::getValue('magicscroll', false);

        //NOTE: save settings
        if ($action == 'save' && $params) {
            foreach ($paramsMap as $blockId => $groups) {
                foreach ($groups as $group) {
                    foreach ($group as $param => $required) {
                        if (isset($params[$blockId][$param])) {
                            $valueToSave = $value = trim($params[$blockId][$param]);
                            switch ($tool->params->getType($param)) {
                                case 'num':
                                    $valueToSave = $value = (int)$value;
                                    break;
                                case 'array':
                                    if (!in_array($value, $tool->params->getValues($param))) {
                                        $valueToSave = $value = $tool->params->getDefaultValue($param);
                                    }
                                    $valueToSave = pSQL($valueToSave);
                                    break;
                                case 'text':
                                    $valueToSave = $value = str_replace('"', '&quot;', $value);//NOTE: fixed issue with "
                                    $valueToSave = pSQL($value);
                                    break;
                            }
                            Db::getInstance()->Execute(
                                'UPDATE `'._DB_PREFIX_.'magicscroll_settings` SET `value`=\''.$valueToSave.'\', `enabled`=1 WHERE `block`=\''.pSQL($blockId).'\' AND `name`=\''.pSQL($param).'\''
                            );
                            $tool->params->setValue($param, $value, $blockId);
                        } else {
                            Db::getInstance()->Execute(
                                'UPDATE `'._DB_PREFIX_.'magicscroll_settings` SET `enabled`=0 WHERE `block`=\''.pSQL($blockId).'\' AND `name`=\''.pSQL($param).'\''
                            );
                            if ($tool->params->paramExists($param, $blockId)) {
                                $tool->params->removeParam($param, $blockId);
                            }
                        }
                    }
                }
            }
            if (version_compare(_PS_VERSION_, '1.5.5.0', '>=')) {
                $this->_clearCache('*');
            }
        }

        $imageFilePath = _PS_IMG_DIR_.'magicscroll/';
        $imagesTypes = ImageType::getImagesTypes();

        //NOTE: upload images
        if ($action == 'upload' && isset($_FILES['magicscroll-image-files']['tmp_name'])
                                && is_array($_FILES['magicscroll-image-files']['tmp_name'])
                                && count($_FILES['magicscroll-image-files']['tmp_name'])) {
            $errors = array();
            $imageResizeMethod = 'imageResize';
            //NOTE: __autoload function in Prestashop 1.3.x leads to PHP fatal error because ImageManager class does not exists
            //      can not use class_exists('ImageManager', false) because ImageManager class will not load where it is needed
            //      so check version before
            if ($this->isPrestaShop15x && class_exists('ImageManager') && method_exists('ImageManager', 'resize')) {
                $imageResizeMethod = array('ImageManager', 'resize');
            }

            foreach ($_FILES['magicscroll-image-files']['tmp_name'] as $key => $tempName) {
                if (!empty($tempName) && file_exists($tempName)) {
                    $tmpName = tempnam(_PS_TMP_IMG_DIR_, 'PS');
                    if (!$tmpName || !move_uploaded_file($tempName, $tmpName)) {
                        $errors[] = 'An error occurred during the image upload.';
                    } else {
                        preg_match('/^(.*?)\.([^\.]*)$/is', $_FILES['magicscroll-image-files']['name'][$key], $matches);
                        list(, $imageFileName, $imageFileExt) = $matches;
                        $imageSuffix = 0;
                        while (file_exists($imageFilePath.$imageFileName.($imageSuffix?'-'.$imageSuffix:'').'.'.$imageFileExt)) {
                            $imageSuffix++;
                        }
                        $imageFileName = $imageFileName.($imageSuffix?'-'.$imageSuffix:'');
                        if (!call_user_func($imageResizeMethod, $tmpName, $imageFilePath.$imageFileName.'.'.$imageFileExt, null, null, $imageFileExt)) {
                            $errors[] = 'An error occurred while copying image.';
                        } else {
                            foreach ($imagesTypes as $k => $imageType) {
                                if (!call_user_func($imageResizeMethod, $tmpName, $imageFilePath.$imageFileName.'-'.Tools::stripslashes($imageType['name']).'.'.$imageFileExt, $imageType['width'], $imageType['height'], $imageFileExt)) {
                                    $errors[] = 'An error occurred while copying resized image ('.Tools::stripslashes($imageType['name']).').';
                                }
                            }
                        }
                    }
                    @unlink($tmpName);
                    Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'magicscroll_images` (`name`, `ext`, `title`, `description`, `link`, `lang`, `enabled`, `order`) VALUES (\''.pSQL($imageFileName).'\', \''.pSQL($imageFileExt).'\', \'\', \'\', \'\', 0, 1, 0)');
                    Db::getInstance()->Execute('UPDATE `'._DB_PREFIX_.'magicscroll_images` SET `order`=LAST_INSERT_ID() WHERE `id`=LAST_INSERT_ID()');
                }
            }
        }

        $imagesUpdateData = Tools::getValue('images-update-data', false);
        if (!$imagesUpdateData) {
            $imagesUpdateData = array();
        }
        // save images data
        if ($action == 'save' && !empty($imagesUpdateData)) {
            foreach ($imagesUpdateData as $imageId => $imageData) {
                if ((int)$imageData['delete']) {
                    $sql = 'SELECT `name`, `ext` FROM `'._DB_PREFIX_.'magicscroll_images` WHERE `id`='.(int)$imageId;
                    $result = Db::getInstance()->ExecuteS($sql);
                    $result = $result[0];
                    foreach ($imagesTypes as $k => $imageType) {
                        @unlink($imageFilePath.$result['name'].'-'.Tools::stripslashes($imageType['name']).'.'.$result['ext']);
                    }

                    @unlink($imageFilePath.$result['name'].'.'.$result['ext']);
                    Db::getInstance()->Execute('DELETE FROM `'._DB_PREFIX_.'magicscroll_images` WHERE `id`='.(int)$imageId);
                } else {
                    Db::getInstance()->Execute(
                        'UPDATE `'._DB_PREFIX_.'magicscroll_images` SET '.
                        '`order`='.(int)$imageData['order'].
                        ', `title`=\''.pSQL(htmlspecialchars($imageData['title'])).'\''.
                        ', `description`=\''.pSQL(htmlspecialchars($imageData['description'])).'\''.
                        ', `link`=\''.pSQL($imageData['link']).'\''.
                        ', `lang`=\''.pSQL($imageData['lang']).'\''.
                        ', `enabled`='.(isset($imageData['exclude']) ? '0' : '1').
                        ' WHERE `id`='.(int)$imageId
                    );
                }
            }
        }

        include(dirname(__FILE__).'/admin/magictoolbox.settings.editor.class.php');
        $settings = new MagictoolboxSettingsEditorClass(dirname(__FILE__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'js');
        $settings->paramsMap = $this->getParamsMap();
        $settings->core = $this->loadTool();
        $settings->profiles = $this->getBlocks();
        $settings->pathToJS = dirname(__FILE__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'js';
        $settings->action = htmlentities($_SERVER['REQUEST_URI']);
        $settings->setResourcesURL(_MODULE_DIR_.'magicscroll/admin/resources/');
        $settings->setResourcesURL(_MODULE_DIR_.'magicscroll/views/js/', 'js');
        $settings->setResourcesURL(_MODULE_DIR_.'magicscroll/views/css/', 'css');
        $settings->namePrefix = 'magicscroll';


        $settings->languagesData = Db::getInstance()->ExecuteS('SELECT id_lang as id, iso_code as code, active FROM `'._DB_PREFIX_.'lang` ORDER BY `id_lang` ASC');

        if ($activeTab) {
            $settings->activeTab = $activeTab;
        }

        $settings->imageBaseUrl = _PS_IMG_.'magicscroll/';

        $result = Db::getInstance()->ExecuteS('SELECT * FROM `'._DB_PREFIX_.'magicscroll_images` ORDER BY `order`');
        if ($result) {
            $settings->customSlideshowImagesData = $result;
        }
        foreach ($settings->customSlideshowImagesData as &$imageData) {
            $imageData['name'] = $imageData['name'].'-home'.$this->imageTypeSuffix.'.'.$imageData['ext'];
            $imageData['exclude'] = 1 - (int)$imageData['enabled'];
        }



        $html = $settings->getHTML();
        return $html;
    }

    public function loadTool($profile = false, $force = false)
    {
        if (!isset($GLOBALS['magictoolbox']['magicscroll']['class']) || $force) {
            require_once(dirname(__FILE__).'/magicscroll.module.core.class.php');
            $GLOBALS['magictoolbox']['magicscroll']['class'] = new MagicScrollModuleCoreClass();
            $tool = &$GLOBALS['magictoolbox']['magicscroll']['class'];
            // load current params
            $sql = 'SELECT `name`, `value`, `block` FROM `'._DB_PREFIX_.'magicscroll_settings` WHERE `enabled`=1';
            $result = Db::getInstance()->ExecuteS($sql);
            foreach ($result as $row) {
                $tool->params->setValue($row['name'], $row['value'], $row['block']);
            }

            // load translates
            $GLOBALS['magictoolbox']['magicscroll']['translates'] = $this->getMessages();
            $translates = & $GLOBALS['magictoolbox']['magicscroll']['translates'];
            foreach ($this->getBlocks() as $block => $label) {
                //NOTE: prepare image types
                foreach (array('large', 'selector', 'thumb') as $name) {
                    if ($tool->params->checkValue($name.'-image', 'original', $block)) {
                        $tool->params->setValue($name.'-image', false, $block);
                    }
                }
            }


        }

        $tool = &$GLOBALS['magictoolbox']['magicscroll']['class'];

        if ($profile) {
            $tool->params->setProfile($profile);
        }

        return $tool;

    }
    public function hookHeader($params)
    {
        //global $smarty;
        $smarty = &$GLOBALS['smarty'];

        if (!$this->isPrestaShop15x) {
            ob_start();
        }

        $headers = '';
        $tool = $this->loadTool();
        $tool->params->resetProfile();

        if ($this->isPrestaShop17x) {
            $page = $smarty->{$this->getTemplateVars}('page');
            if (is_array($page) && isset($page['page_name'])) {
                $page = $page['page_name'];
            }
        } else {
            $page = $smarty->{$this->getTemplateVars}('page_name');
        }

        switch ($page) {
            case 'product':
            case 'index':
            case 'category':
            case 'manufacturer':
            case 'search':
                break;
            case 'best-sales':
                $page = 'bestsellerspage';
                break;
            case 'new-products':
                $page = 'newproductpage';
                break;
            case 'prices-drop':
                $page = 'specialspage';
                break;
            default:
                $page = '';
        }

        if ($tool->params->checkValue('include-headers-on-all-pages', 'Yes', 'default') && ($GLOBALS['magictoolbox']['magicscroll']['headers'] = true)
            || $tool->params->profileExists($page) && !$tool->params->checkValue('enable-effect', 'No', $page)
            || $page == 'index' && !$tool->params->checkValue('enable-effect', 'No', 'homeslideshow')
            || $page == 'index' && !$tool->params->checkValue('enable-effect', 'No', 'homefeatured') && parent::isInstalled($this->featuredProductsModule) && parent::getInstanceByName($this->featuredProductsModule)->active
            || $page == 'index' && !$tool->params->checkValue('enable-effect', 'No', 'blocknewproducts_home') && parent::isInstalled($this->newProductsModule) && parent::getInstanceByName($this->newProductsModule)->active
            || $page == 'index' && !$tool->params->checkValue('enable-effect', 'No', 'blockbestsellers_home') && parent::isInstalled($this->topSellersModule) && parent::getInstanceByName($this->topSellersModule)->active
            || $page == 'index' && !$tool->params->checkValue('enable-effect', 'No', 'blockspecials_home') && parent::isInstalled($this->specialsProductsModule) && parent::getInstanceByName($this->specialsProductsModule)->active
            || !$tool->params->checkValue('enable-effect', 'No', 'blockviewed') && parent::isInstalled('blockviewed') && parent::getInstanceByName('blockviewed')->active
            || !$tool->params->checkValue('enable-effect', 'No', 'blockspecials') && parent::isInstalled($this->specialsProductsModule) && parent::getInstanceByName($this->specialsProductsModule)->active
            || !$tool->params->checkValue('enable-effect', 'No', 'blocknewproducts') && parent::isInstalled($this->newProductsModule) && parent::getInstanceByName($this->newProductsModule)->active
            || !$tool->params->checkValue('enable-effect', 'No', 'blockbestsellers') && parent::isInstalled($this->topSellersModule) && parent::getInstanceByName($this->topSellersModule)->active
        /**/) {
            // include headers
            $headers = $tool->getHeadersTemplate(_MODULE_DIR_.'magicscroll/views/js', _MODULE_DIR_.'magicscroll/views/css');

            if (!$this->isPrestaShop17x) {
                //NOTE: if we need this on product page!?
                $headers .= '<script type="text/javascript" src="'._MODULE_DIR_.'magicscroll/views/js/common.js"></script>';
            }

            if ($page == 'product' && !$tool->params->checkValue('enable-effect', 'No', 'product')) {
                $headers .= '
<script type="text/javascript">

    var isProductMagicScrollReady = false;
    MagicScrollOptions[\'onReady\'] = function(id) {
        //console.log(\'MagicScroll onReady: \', id);
        if (id == \'productMagicScroll\') {
            isProductMagicScrollReady = true;
        }
    }

</script>';
                if ($this->isPrestaShop17x) {
                    $headers .= "\n".'<script type="text/javascript" src="'._MODULE_DIR_.'magicscroll/views/js/product17.js"></script>'."\n";
                }
                if (!$this->isPrestaShop17x && !$GLOBALS['magictoolbox']['isProductScriptIncluded']) {
                    if ($this->displayInlineProductJs || (bool)Configuration::get('PS_JS_DEFER')) {
                        //NOTE: include product.js as inline because it has to be called after previous inline scripts
                        $productJsCContents = Tools::file_get_contents(_PS_ROOT_DIR_.'/modules/magicscroll/views/js/product.js');
                        $headers .= "\n".'<script type="text/javascript">'.$productJsCContents.'</script>'."\n";
                    } else {
                        $headers .= "\n".'<script type="text/javascript" src="'._MODULE_DIR_.'magicscroll/views/js/product.js"></script>'."\n";
                    }

                    $GLOBALS['magictoolbox']['isProductScriptIncluded'] = true;
                }
            }
            if ($page == 'index' && !$this->isPrestaShop17x) {
                $headers .= '
<script type="text/javascript">
    var isPrestaShop16x = '.($this->isPrestaShop16x ? 'true' : 'false').';
    $(document).ready(function() {

        //NOTE: fix, because Prestashop adds class only for ul.tab-pane
        $(\'#index .tab-pane\').removeClass(\'active\');
        $(\'#index .tab-pane:first\').addClass(\'active\');

        if (isPrestaShop16x && typeof(MagicScroll) != \'undefined\') {
            var homepageLastTab = \'\';
            var homepageTabs = {};
            $(\'#home-page-tabs li a\').each(function(index) {
                homepageTabs[this.href.replace(/^.*?#([^#]+)$/, \'$1\')] = 0;
            });
            $(\'#home-page-tabs li.active a\').each(function(index) {
                homepageTabs[this.href.replace(/^.*?#([^#]+)$/, \'$1\')] = 1;
                homepageLastTab = this.href.replace(/^.*?#([^#]+)$/, \'$1\');
            });
            $(\'#home-page-tabs a[data-toggle="tab"]\').on(\'shown.bs.tab\', function (e) {
                var key = e.target.href.replace(/^.*?#([^#]+)$/, \'$1\');
                if (typeof(homepageTabs[key]) != \'undefined\') {
                    var toolEl = $(\'div#\'+key+\' .MagicScroll[id]\').get(0);
                    if (toolEl) {
                        if (homepageTabs[key]) {
                            //NOTE: temporarily refresh always because of issue with transition effect
                            MagicScroll.refresh(toolEl.id);
                        } else {
                            homepageTabs[key] = 1;
                            MagicScroll.refresh(toolEl.id);
                        }
                    }
                    toolEl = $(\'div#\'+homepageLastTab+\' .MagicScroll[id]\').get(0);
                    if (toolEl) {
                    }
                    homepageLastTab = key;
                }
            });
        }
    });
</script>
';
            }

            $domNotAvailable = extension_loaded('dom') ? false : true;
            if ($this->displayInlineProductJs && $domNotAvailable) {
                $scriptsPattern = '#(?:\s*+<script\b[^>]*+>.*?<\s*+/script\b[^>]*+>)++#Uims';
                if (preg_match($scriptsPattern, $headers, $scripts)) {
                    $GLOBALS['magictoolbox']['magicscroll']['scripts'] =
                        '<!-- MAGICSCROLL HEADERS START -->'.$scripts[0].'<!-- MAGICSCROLL HEADERS END -->';
                    $headers = preg_replace($scriptsPattern, '', $headers);
                }
            }

            if ($this->isSmarty3) {
                //Smarty v3 template engine
                $smarty->registerFilter('output', array(Module::getInstanceByName('magicscroll'), 'parseTemplateCategory'));
            } else {
                //Smarty v2 template engine
                $smarty->register_outputfilter(array(Module::getInstanceByName('magicscroll'), 'parseTemplateCategory'));
            }
            $GLOBALS['magictoolbox']['filters']['magicscroll'] = 'parseTemplateCategory';

            // presta create new class every time when hook called
            // so we need save our data in the GLOBALS
            $GLOBALS['magictoolbox']['magicscroll']['cookie'] = $params['cookie'];
            $GLOBALS['magictoolbox']['magicscroll']['productsViewedIds'] = (isset($params['cookie']->viewed) && !empty($params['cookie']->viewed)) ? explode(',', $params['cookie']->viewed) : array();

            $headers = '<!-- MAGICSCROLL HEADERS START -->'.$headers.'<!-- MAGICSCROLL HEADERS END -->';

        }

        return $headers;

    }

    public function hookActionDispatcher($params)
    {
        //NOTE: registered for 1.7.x
        if (!$this->isAjaxRequest) {
            return;
        }

        switch ($params['controller_class']) {
            case 'CategoryController':
                $page = 'category';
                break;
            case 'SearchController':
                $page = 'search';
                break;
            default:
                return;
        }

        $smarty = &$GLOBALS['smarty'];
        $smarty->assign('page', array(
            'page_name' => $page
        ));

        $this->hookHeader($params);
    }

    public function hookProductFooter($params)
    {
        //NOTE: we need save this data in the GLOBALS for compatible with some Prestashop modules which reset the $product smarty variable
        if ($this->isPrestaShop17x && is_array($params['product'])) {
            $GLOBALS['magictoolbox']['magicscroll']['product'] = array(
                'id' => $params['product']['id'],
                'name' => $params['product']['name'],
                'link_rewrite' => $params['product']['link_rewrite']
            );
        } else {
            $GLOBALS['magictoolbox']['magicscroll']['product'] = array(
                'id' => $params['product']->id,
                'name' => $params['product']->name,
                'link_rewrite' => $params['product']->link_rewrite
            );
        }
        return '';
    }

    public function hookFooter($params)
    {
        if (!$this->isPrestaShop15x) {

            $contents = ob_get_contents();
            ob_end_clean();

            $matches = array();
            $lang = isset($params['cart']->id_lang) ? $params['cart']->id_lang : 0;
            if (preg_match_all('/\[magicscroll(?:\sid=(\d+(?:,\d+)*))?\]/', $contents, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $contents = str_replace($match[0], $this->getCustomSlideshow(empty($match[1]) ? '' : $match[1], $lang, false), $contents);
                }
                $GLOBALS['magictoolbox']['magicscroll']['headers'] = true;
            }

            if ($GLOBALS['magictoolbox']['magicscroll']['headers'] == false) {
                $contents = preg_replace('/<\!-- MAGICSCROLL HEADERS START -->.*?<\!-- MAGICSCROLL HEADERS END -->/is', '', $contents);
            } else {
                $contents = preg_replace('/<\!-- MAGICSCROLL HEADERS (START|END) -->/is', '', $contents);
                //NOTE: add class for identifying PrestaShop version
                if (preg_match('#(<body\b[^>]*?\sclass\s*+=\s*+"[^"]*+)("[^>]*+>)#is', $contents)) {
                    $contents = preg_replace('#(<body\b[^>]*?\sclass\s*+=\s*+"[^"]*+)("[^>]*+>)#is', '$1 '.$this->psVersionClass.'$2', $contents);
                } else {
                    $contents = preg_replace('#(<body\s[^>]*+)>#is', '$1 class="'.$this->psVersionClass.'">', $contents);
                }
            }

            echo $contents;

        }

        return '';

    }

    public function hookDisplayTopColumn($params)
    {
        $page = $params['smarty']->{$this->getTemplateVars}('page_name');
        return $page == 'index' ? $this->hookHome($params) : '';
    }

    public function hookHome($params)
    {
        $tool = $this->loadTool();
        $tool->params->setProfile('homeslideshow');
        if ($tool->params->checkValue('enable-effect', 'No')) {
            return '';
        }
        $lang = isset($params['cart']->id_lang) ? $params['cart']->id_lang : 0;
        $slideshow = $this->getCustomSlideshow('', $lang, true);
        if (!empty($slideshow)) {
            $GLOBALS['magictoolbox']['magicscroll']['headers'] = true;
        }
        return $slideshow;
    }

    public function getCustomSlideshow($ids = '', $lang = 0, $enabledOnly = false)
    {
        $slideshow = '';
        $tool = $this->loadTool();
        $tool->params->setProfile('homeslideshow');
        if (empty($ids)) {
            $where = '';
            $order = 'ORDER BY `order`';
        } else {
            $ids = pSQL($ids);
            $where = '`id` IN ('.$ids.') AND ';
            $order = 'ORDER BY FIELD(`id`,'.$ids.')';
        }
        $where .= $enabledOnly ? '`enabled`=1 AND ' : '';
        $where .= $lang ? '(`lang`=0 OR `lang`='.(int)$lang.') ' : '`lang`=0 ';
        $sql = 'SELECT * FROM `'._DB_PREFIX_.'magicscroll_images` WHERE '.$where.$order;
        $result = Db::getInstance()->ExecuteS($sql);
        if (is_array($result) && count($result)) {
            $imagesData = array();
            $thumbSuffix = $tool->params->getValue('selector-image');
            $thumbSuffix = $thumbSuffix ? '-'.$thumbSuffix : '';
            $imgSuffix = $tool->params->getValue('thumb-image');
            $imgSuffix = $imgSuffix ? '-'.$imgSuffix : '';
            $fullscreenSuffix = $tool->params->getValue('large-image');
            $fullscreenSuffix = $fullscreenSuffix ? '-'.$fullscreenSuffix : '';
            foreach ($result as $row) {
                $imagesData[$row['id']]['link'] = $row['link'];
                $imagesData[$row['id']]['title'] = $row['title'];
                $imagesData[$row['id']]['description'] = htmlspecialchars_decode($row['description']);
                $imagesData[$row['id']]['thumb'] = _PS_IMG_.'magicscroll/'.$row['name'].$thumbSuffix.'.'.$row['ext'];
                $imagesData[$row['id']]['img'] = _PS_IMG_.'magicscroll/'.$row['name'].$imgSuffix.'.'.$row['ext'];
                $imagesData[$row['id']]['fullscreen'] = _PS_IMG_.'magicscroll/'.$row['name'].$fullscreenSuffix.'.'.$row['ext'];
            }
            $slideshow = '<div class="MagicToolboxContainer">'.$tool->getMainTemplate($imagesData, array('id' => 'customSlideshow'.md5($where))).'</div>';
        }
        return $slideshow;
    }

    private static $outputMatches = array();

    public function prepareOutput($output, $index = 'DEFAULT')
    {
        if (!isset(self::$outputMatches[$index])) {
            $regExp = '<div\b[^>]*?\sclass\s*+=\s*+"[^"]*?(?<=\s|")MagicToolboxContainer(?=\s|")[^"]*+"[^>]*+>'.
                        '('.
                        '(?:'.
                            '[^<]++'.
                            '|'.
                            '<(?!/?div\b|!--)'.
                            '|'.
                            '<!--.*?-->'.
                            '|'.
                            '<div\b[^>]*+>'.
                                '(?1)'.
                            '</div\s*+>'.
                        ')*+'.
                        ')'.
                        '</div\s*+>';
            preg_match_all('#'.$regExp.'#is', $output, self::$outputMatches[$index]);
            foreach (self::$outputMatches[$index][0] as $key => $match) {
                $output = str_replace($match, 'MAGICSCROLL_MATCH_'.$index.'_'.$key.'_', $output);
            }
        } else {
            foreach (self::$outputMatches[$index][0] as $key => $match) {
                $output = str_replace('MAGICSCROLL_MATCH_'.$index.'_'.$key.'_', $match, $output);
            }
            unset(self::$outputMatches[$index]);
        }
        return $output;

    }

    public function parseTemplateCategory($output, $smarty)
    {
        if ($this->isSmarty3) {
            //Smarty v3 template engine
            $currentTemplate = Tools::substr(basename($smarty->template_resource), 0, -4);
            if ($currentTemplate == 'breadcrumb') {
                $currentTemplate = 'product';
            } elseif ($currentTemplate == 'pagination') {
                $currentTemplate = 'category';
            }
        } else {
            //Smarty v2 template engine
            $currentTemplate = $smarty->currentTemplate;
        }

        if ($this->isPrestaShop17x && $currentTemplate == 'index' ||
            $this->isPrestaShop15x && $currentTemplate == 'layout') {

            $matches = array();
            $lang = (int)$GLOBALS['magictoolbox']['magicscroll']['cookie']->id_lang;
            if (preg_match_all('/\[magicscroll(?:\sid=(\d+(?:,\d+)*))?\]/', $output, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $output = str_replace($match[0], $this->getCustomSlideshow(empty($match[1]) ? '' : $match[1], $lang, false), $output);
                }
                $GLOBALS['magictoolbox']['magicscroll']['headers'] = true;
            }

            if (version_compare(_PS_VERSION_, '1.5.5.0', '>=')) {
                //NOTE: because we do not know whether the effect is applied to the blocks in the cache
                $GLOBALS['magictoolbox']['magicscroll']['headers'] = true;
            }
            //NOTE: full contents in prestashop 1.5.x
            if ($GLOBALS['magictoolbox']['magicscroll']['headers'] == false) {
                $output = preg_replace('/<\!-- MAGICSCROLL HEADERS START -->.*?<\!-- MAGICSCROLL HEADERS END -->/is', '', $output);
            } else {
                $output = preg_replace('/<\!-- MAGICSCROLL HEADERS (START|END) -->/is', '', $output);
            }
            return $output;
        }

        switch ($currentTemplate) {
            case 'search':
            case 'manufacturer':
                //$currentTemplate = 'manufacturer';
                break;
            case 'best-sales':
                $currentTemplate = 'bestsellerspage';
                break;
            case 'new-products':
                $currentTemplate = 'newproductpage';
                break;
            case 'prices-drop':
                $currentTemplate = 'specialspage';
                break;
            case 'blockbestsellers-home':
                $currentTemplate = 'blockbestsellers_home';
                break;
            case 'blockspecials-home':
                $currentTemplate = 'blockspecials_home';
                break;
            case 'product-list'://for 'Layered navigation block'
                if (strpos($_SERVER['REQUEST_URI'], 'blocklayered-ajax.php') !== false) {
                    $currentTemplate = 'category';
                }
                break;
            //NOTE: just in case (issue 88975)
            case 'ProductController':
                $currentTemplate = 'product';
                break;
            case 'products':
                if ($this->isPrestaShop17x && $this->isAjaxRequest) {
                    $page = $smarty->{$this->getTemplateVars}('page');
                    if (is_array($page) && isset($page['page_name'])) {
                        $currentTemplate = $page['page_name'];
                    }
                }
                break;
            case 'ps_featuredproducts':
                if ($this->isPrestaShop17x) {
                    $currentTemplate = 'homefeatured';
                }
                break;
            case 'ps_bestsellers':
                if ($this->isPrestaShop17x) {
                    $currentTemplate = 'blockbestsellers_home';
                }
                break;
            case 'ps_newproducts':
                if ($this->isPrestaShop17x) {
                    $currentTemplate = 'blocknewproducts_home';
                }
                break;
            case 'ps_specials':
                if ($this->isPrestaShop17x) {
                    $currentTemplate = 'blockspecials_home';
                }
                break;
        }

        $tool = $this->loadTool();
        if (!$tool->params->profileExists($currentTemplate) || $tool->params->checkValue('enable-effect', 'No', $currentTemplate)) {
            return $output;
        }
        $tool->params->setProfile($currentTemplate);

        //global $link;
        $link = &$GLOBALS['link'];
        $cookie = &$GLOBALS['magictoolbox']['magicscroll']['cookie'];
        if (method_exists($link, 'getImageLink')) {
            $_link = &$link;
        } else {
            /* for Prestashop ver 1.1 */
            $_link = &$this;
        }

        $output = self::prepareOutput($output);

        switch ($currentTemplate) {
            case 'homefeatured':
                $categoryID = $this->isPrestaShop15x ? Context::getContext()->shop->getCategory() : 1;
                $category = new Category($categoryID);
                $nb = (int)Configuration::get('HOME_FEATURED_NBR');//Number of product displayed
                $products = $category->getProducts((int)$cookie->id_lang, 1, ($nb ? $nb : 10));
                if (!is_array($products)) {
                    break;
                }
                if (count($products) < 2) {
                    break;
                }
                $GLOBALS['magictoolbox']['magicscroll']['headers'] = true;
                $productImagesData = array();
                $useLink = $tool->params->checkValue('link-to-product-page', 'Yes');
                foreach ($products as $p_key => $product) {
                    $productImagesData[$p_key]['link'] = $useLink?$link->getProductLink($product['id_product'], $product['link_rewrite'], isset($product['category']) ? $product['category'] : null):'';
                    $productImagesData[$p_key]['title'] = $product['name'];
                    $productImagesData[$p_key]['img'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], $tool->params->getValue('thumb-image'));
                }
                $html = $tool->getMainTemplate($productImagesData, array('id' => 'homefeaturedMagicScroll'));
                if ($this->isPrestaShop16x) {
                    $html = '<div id="homefeatured" class="MagicToolboxContainer homefeatured tab-pane">'.$html.'</div>';
                } else {
                    $html = '<div class="MagicToolboxContainer">'.$html.'</div>';
                }

                if ($this->isPrestaShop17x) {
                    $pattern =  '<div\b[^>]*?\bclass\s*+=\s*+"[^"]*?\bproducts\b[^"]*+"[^>]*+>'.
                                '('.
                                '(?:'.
                                    '[^<]++'.
                                    '|'.
                                    '<(?!/?div\b|!--)'.
                                    '|'.
                                    '<!--.*?-->'.
                                    '|'.
                                    '<div\b[^>]*+>'.
                                        '(?1)'.
                                    '</div\s*+>'.
                                ')*+'.
                                ')'.
                                '</div\s*+>';
                } else {
                    $pattern = '<ul\b[^>]*?>.*?</ul>';
                }
                // preg_match_all('#'.$pattern.'#is', $output, $matches, PREG_SET_ORDER);
                // debug_log($matches);

                $output = preg_replace('#'.$pattern.'#is', $html, $output);
                break;
            case 'category':
            case 'manufacturer':
            case 'newproductpage':
            case 'bestsellerspage':
            case 'specialspage':
            case 'search':
                $products = $smarty->{$this->getTemplateVars}('products');
                if (!is_array($products)) {
                    break;
                }
                $pCount = count($products);
                if (!$pCount) {
                    break;
                }
                $GLOBALS['magictoolbox']['magicscroll']['headers'] = true;
                $dataOptions = $tool->params->serialize();
                if (empty($dataOptions)) {
                    $dataOptions = '';
                } else {
                    $dataOptions = ' data-options="'.$dataOptions.'"';
                }

                $additionalClasses = $tool->params->getValue('scroll-extra-styles');
                if (empty($additionalClasses)) {
                    $additionalClasses = '';
                } else {
                    $additionalClasses = ' '.trim($additionalClasses);
                }

                if ($this->isPrestaShop15x) {
                    $additionalClasses .= ' prestashop15x';
                } else {
                    $additionalClasses .= ' prestashop14x';
                }

                $ulPattern =	'(<ul\b[^>]*?\bid\s*+=\s*+"product_list"[^>]*+>)'.
                                '('.
                                '(?:'.
                                    '[^<]++'.
                                    '|'.
                                    '<(?!/?ul\b|!--)'.
                                    '|'.
                                    '<!--.*?-->'.
                                    '|'.
                                    '<ul\b[^>]*+>'.
                                        '(?2)'.
                                    '</ul\s*+>'.
                                ')*+'.
                                ')'.
                                '</ul\s*+>';
                $matches = array();
                if (preg_match("#{$ulPattern}#is", $output, $matches)) {
                    if (strpos($matches[1], 'class')) {
                        $replace = preg_replace('#\bclass\s*+=\s*+"#i', '$0MagicScroll'.$additionalClasses.' ', $matches[1]);
                    } else {
                        $replace = preg_replace('#<ul\b#i', '$0 class="MagicScroll'.$additionalClasses.'"', $matches[1]);
                    }

                    //$dataOptions = strtr($dataOptions, array('\\' => '\\\\', '$' => '\$'));
                    $replace = preg_replace('#>$#i', "{$dataOptions} >", $replace);
                    $replace = $replace.$matches[2].'</ul>';
                    $output = str_replace($matches[0], $replace, $output);
                }

                break;
            case 'product':
                //debug_log('MagicScroll parseTemplateCategory product');
                if (!isset($GLOBALS['magictoolbox']['magicscroll']['product'])) {
                    //for skip loyalty module product.tpl
                    break;
                }

                //NOTE: if product block was processed by another tool (magic360)
                if ($GLOBALS['magictoolbox']['isProductBlockProcessed']) {
                    break;
                }

                //NOTE: get some data from $GLOBALS for compatible with Prestashop modules which reset the $product smarty variable
                //$product = &$GLOBALS['magictoolbox']['magicscroll']['product'];
                $product = new Product((int)$GLOBALS['magictoolbox']['magicscroll']['product']['id'], true, (int)$cookie->id_lang);
                $lrw = $product->link_rewrite;
                $pid = (int)$product->id;


                $images = $product->getImages((int)$cookie->id_lang);
                if (empty($images) || !is_array($images)) {
                    break;
                }
                if (count($images) < ($this->isPrestaShop17x ? 1 : 2)) {
                    break;
                }

                if ($this->isPrestaShop17x) {
                    $cover = $smarty->{$this->getTemplateVars}('product');
                    $cover = isset($cover['cover']) ? $cover['cover'] : array();
                } else {
                    $cover = $smarty->{$this->getTemplateVars}('cover');
                }

                if (!isset($cover['id_image'])) {
                    break;
                }

                $productImagesData = array();
                $selectorIDs = array();
                foreach ($images as $image) {
                    $id_image = (int)$image['id_image'];
                    //NOTE: to prevent dublicates
                    if (isset($selectorIDs[$id_image])) {
                        continue;
                    }
                    $selectorIDs[] = $id_image;
                    //if ($image['cover']) $coverID = $id_image;
                    $productImagesData[$id_image]['title'] = $image['legend'];
                    $productImagesData[$id_image]['img'] = $_link->getImageLink($lrw, $pid.'-'.$id_image, $tool->params->getValue('thumb-image'));
                }

                $GLOBALS['magictoolbox']['magicscroll']['headers'] = true;

                $html = $tool->getMainTemplate($productImagesData, array('id' => 'productMagicScroll'));

                if ($this->isPrestaShop17x) {
                    $attributeId = $smarty->{$this->getTemplateVars}('product');
                    $attributeId = isset($attributeId['id_product_attribute']) ? $attributeId['id_product_attribute'] : null;
                    $combinationImages = $smarty->{$this->getTemplateVars}('combinationImages');
                    $combinationData = array(
                        'attributes' => array(),
                        'order' => $selectorIDs
                    );
                    if (is_array($combinationImages)) {
                        foreach ($combinationImages as $attrId => $combImages) {
                            $combinationData['attributes'][$attrId] = array();
                            foreach ($combImages as $combImage) {
                                $combinationData['attributes'][$attrId][] = (int)$combImage['id_image'];
                            }
                        }
                    }
                    $html .= '
<script type="text/javascript">
    //<![CDATA[
    var mtСombinationData = '.Tools::jsonEncode($combinationData).';
    //]]>
</script>
';
                } else {
                    $html .= '
<script type="text/javascript">
    //<![CDATA[
    magictoolboxImagesOrder = ['.implode(',', $selectorIDs).'];
    //]]>
</script>';
                }

                //NOTE: append main container
                if ($this->isPrestaShop17x) {
                    $mainImagePattern = '<div\b[^>]*?\bclass\s*+=\s*+"[^"]*?\bimages-container\b[^"]*+"[^>]*+>'.
                                        '('.
                                        '(?:'.
                                            '[^<]++'.
                                            '|'.
                                            '<(?!/?div\b|!--)'.
                                            '|'.
                                            '<!--.*?-->'.
                                            '|'.
                                            '<div\b[^>]*+>'.
                                                '(?1)'.
                                            '</div\s*+>'.
                                        ')*+'.
                                        ')'.
                                        '</div\s*+>';
                } else {
                    //NOTE: 'image' class added to support custom theme #53897
                    $mainImagePattern = '(<div\b[^>]*?(?:\bid\s*+=\s*+"image-block"|\bclass\s*+=\s*+"[^"]*?\bimage\b[^"]*+")[^>]*+>)'.
                                        '('.
                                        '(?:'.
                                            '[^<]++'.
                                            '|'.
                                            '<(?!/?div\b|!--)'.
                                            '|'.
                                            '<!--.*?-->'.
                                            '|'.
                                            '<div\b[^>]*+>'.
                                                '(?2)'.
                                            '</div\s*+>'.
                                        ')*+'.
                                        ')'.
                                        '</div\s*+>';
                }

                $matches = array();
                //preg_match_all('#'.$mainImagePattern.'#is', $output, $matches, PREG_SET_ORDER);
                //debug_log($matches);

                if (!preg_match('#'.$mainImagePattern.'#is', $output, $matches)) {
                    break;
                }

                if ($this->isPrestaShop17x) {
                    //NOTE: div.hidden-important can be replaced with ajax contents
                    $output = str_replace(
                        $matches[0],
                        '<div class="hidden-important">'.$matches[0].'</div>'.$html,
                        $output
                    );

                    //NOTE: cut arrows
                    $arrowsPattern = '<div\b[^>]*?\bclass\s*+=\s*+"[^"]*?\bscroll-box-arrows\b[^"]*+"[^>]*+>'.
                                        '('.
                                        '(?:'.
                                            '[^<]++'.
                                            '|'.
                                            '<(?!/?div\b|!--)'.
                                            '|'.
                                            '<!--.*?-->'.
                                            '|'.
                                            '<div\b[^>]*+>'.
                                                '(?1)'.
                                            '</div\s*+>'.
                                        ')*+'.
                                        ')'.
                                        '</div\s*+>';
                    $output = preg_replace('#'.$arrowsPattern.'#', '', $output);

                    $output = preg_replace('/<\!-- MAGICSCROLL HEADERS (START|END) -->/is', '', $output);
                } else {
                    $iconsPattern = '<span\b[^>]*?\bclass\s*+=\s*+"[^"]*?\b(?:new-box|sale-box|discount)\b[^"]*+"[^>]*+>'.
                                    '('.
                                    '(?:'.
                                        '[^<]++'.
                                        '|'.
                                        '<(?!/?span\b|!--)'.
                                        '|'.
                                        '<!--.*?-->'.
                                        '|'.
                                        '<span\b[^>]*+>'.
                                            '(?1)'.
                                        '</span\s*+>'.
                                    ')*+'.
                                    ')'.
                                    '</span\s*+>';
                    $iconMatches = array();
                    if (preg_match_all('%'.$iconsPattern.'%is', $matches[2], $iconMatches, PREG_SET_ORDER)) {
                        foreach ($iconMatches as $key => $iconMatch) {
                            $matches[2] = str_replace($iconMatch[0], '', $matches[2]);
                            $iconMatches[$key] = $iconMatch[0];
                        }
                    }
                    $icons = implode('', $iconMatches);

                    $output = str_replace($matches[0], "{$matches[1]}{$icons}<div class=\"hidden-important\">{$matches[2]}</div>{$html}</div>", $output);

                    //NOTE: hide selectors from contents
                    //NOTE: 'image-additional' added to support custom theme #53897
                    //NOTE: div#views_block is parent for div#thumbs_list
                    $thumbsPattern =	'(<div\b[^>]*?(?:\bid\s*+=\s*+"(?:views_block|thumbs_list)"|\bclass\s*+=\s*+"[^"]*?\bimage-additional\b[^"]*+")[^>]*+>)'.
                                        '('.
                                        '(?:'.
                                            '[^<]++'.
                                            '|'.
                                            '<(?!/?div\b|!--)'.
                                            '|'.
                                            '<!--.*?-->'.
                                            '|'.
                                            '<div\b[^>]*+>'.
                                                '(?2)'.
                                            '</div\s*+>'.
                                        ')*+'.
                                        ')'.
                                        '</div\s*+>';
                    $matches = array();
                    if (preg_match("#{$thumbsPattern}#is", $output, $matches)) {
                        if (strpos($matches[1], 'class')) {
                            $replace = preg_replace('#\bclass\s*+=\s*+"#i', '$0hidden-important ', $matches[1]);
                        } else {
                            $replace = preg_replace('#<div\b#i', '$0 class="hidden-important"', $matches[1]);
                        }

                        $output = str_replace($matches[1], $replace, $output);
                    }

                    //NOTE: remove "View full size" link (in old PrestaShop)
                    $output = preg_replace('/<li[^>]*+>[^<]*+<span[^>]*?id="view_full_size"[^>]*+>[^<]*<\/span>[^<]*+<\/li>/is', '', $output);

                    //NOTE: hide span#wrapResetImages or a#resetImages
                    $matches = array();
                    if (preg_match('#(?:<span\b[^>]*?\bid\s*+=\s*+"wrapResetImages"[^>]*+>|<a\b[^>]*?\bid\s*+=\s*+"resetImages"[^>]*+>)#is', $output, $matches)) {
                        if (strpos($matches[0], 'class')) {
                            $replace = preg_replace('#\bclass\s*+=\s*+"#i', '$0hidden-important ', $matches[0]);
                        } else {
                            $replace = preg_replace('#<span\b#i', '$0 class="hidden-important"', $matches[0]);
                        }

                        $output = str_replace($matches[0], $replace, $output);
                    }
                }

                $GLOBALS['magictoolbox']['isProductBlockProcessed'] = true;
                break;
            case 'blockspecials':
                if (version_compare(_PS_VERSION_, '1.4', '<')) {
                    $products = $this->getAllSpecial((int)$cookie->id_lang);
                } else {
                    $products = Product::getPricesDrop((int)($cookie->id_lang), 0, 10, false, 'position', 'asc');
                }

                if (!is_array($products)) {
                    break;
                }
                $pCount = count($products);
                if ($pCount < 2) {
                    break;
                }
                $GLOBALS['magictoolbox']['magicscroll']['headers'] = true;
                $productImagesData = array();
                $useLink = $tool->params->checkValue('link-to-product-page', 'Yes');

                foreach ($products as $p_key => $product) {
                    if ($useLink && (!Tools::getValue('id_product', false) || (Tools::getValue('id_product', false) != $product['id_product']))) {
                        $productImagesData[$p_key]['link'] = $link->getProductLink($product['id_product'], $product['link_rewrite'], isset($product['category']) ? $product['category'] : null);
                    } else {
                        $productImagesData[$p_key]['link'] = '';
                    }

                    $productImagesData[$p_key]['title'] = $product['name'];
                    $productImagesData[$p_key]['img'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], $tool->params->getValue('thumb-image'));
                }

                $html = $tool->getMainTemplate($productImagesData, array('id' => 'blockspecialsMagicScroll'));

                //NOTE: to place it in the center (can't use "margin: 0 auto" because "display: inline-block")
                $html = '<div class="MagicToolboxContainer">'.$html.'</div>';

                $pattern = '<ul[^>]*?>.*?<\/ul>';
                $output = preg_replace('/'.$pattern.'/is', $html, $output);
                break;
            case 'blockspecials_home':
                if ($this->isPrestaShop17x) {
                    $products = $smarty->{$this->getTemplateVars}('products');
                } else {
                    $products = $smarty->{$this->getTemplateVars}('specials');
                }
                if (!is_array($products)) {
                    break;
                }
                $pCount = count($products);
                if ($pCount < 2) {
                    break;
                }

                $GLOBALS['magictoolbox']['magicscroll']['headers'] = true;
                $productImagesData = array();
                $useLink = $tool->params->checkValue('link-to-product-page', 'Yes');

                foreach ($products as $p_key => $product) {
                    if ($useLink/* && (!Tools::getValue('id_product', false) || (Tools::getValue('id_product', false) != $product['id_product']))*/) {
                        $productImagesData[$p_key]['link'] = $link->getProductLink($product['id_product'], $product['link_rewrite'], isset($product['category']) ? $product['category'] : null);
                    } else {
                        $productImagesData[$p_key]['link'] = '';
                    }

                    $productImagesData[$p_key]['title'] = $product['name'];
                    $productImagesData[$p_key]['img'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], $tool->params->getValue('thumb-image'));
                }

                $html = $tool->getMainTemplate($productImagesData, array('id' => 'blockspecialsMagicScroll'));

                if ($this->isPrestaShop17x) {
                    $html = '<div id="blockspecials" class="MagicToolboxContainer blockspecials">'.$html.'</div>';
                    $pattern =  '<div\b[^>]*?\bclass\s*+=\s*+"[^"]*?\bproducts\b[^"]*+"[^>]*+>'.
                                '('.
                                '(?:'.
                                    '[^<]++'.
                                    '|'.
                                    '<(?!/?div\b|!--)'.
                                    '|'.
                                    '<!--.*?-->'.
                                    '|'.
                                    '<div\b[^>]*+>'.
                                        '(?1)'.
                                    '</div\s*+>'.
                                ')*+'.
                                ')'.
                                '</div\s*+>';
                    $matches = array();
                    if (preg_match('#'.$pattern.'#is', $output, $matches)) {
                        $pattern = '(<article\b[^>]*+>.*?</article>[^<]*+)++';
                        $html = preg_replace('#'.$pattern.'#is', $html, $matches[0]);
                        $output = str_replace($matches[0], $html, $output);
                    }
                } else {
                    $html = '<div id="blockspecials" class="MagicToolboxContainer blockspecials tab-pane">'.$html.'</div>';
                    $pattern = '<ul\b[^>]*+>.*?</ul>';
                    $output = preg_replace('#'.$pattern.'#is', $html, $output);
                }

                break;
            case 'blockviewed':
                $productIDs = $GLOBALS['magictoolbox']['magicscroll']['productsViewedIds'];
                if ($this->isPrestaShop155x) {
                    $productIDs = array_reverse($productIDs);
                }

                $pCount = count($productIDs);
                if ($pCount < 2) {
                    break;
                }
                $GLOBALS['magictoolbox']['magicscroll']['headers'] = true;
                $productImagesData = array();
                $useLink = $tool->params->checkValue('link-to-product-page', 'Yes');

                foreach ($productIDs as $id_product) {
                    $productViewedObj = new Product((int)$id_product, false, (int)$cookie->id_lang);
                    if (!Validate::isLoadedObject($productViewedObj) || !$productViewedObj->active) {
                        continue;
                    } else {
                        $images = $productViewedObj->getImages((int)$cookie->id_lang);
                        foreach ($images as $image) {
                            if ($image['cover']) {
                                $productViewedObj->cover = $productViewedObj->id.'-'.$image['id_image'];
                                $productViewedObj->legend = $image['legend'];
                                break;
                            }
                        }
                        if (!isset($productViewedObj->cover)) {
                            $productViewedObj->cover = Language::getIsoById($cookie->id_lang).'-default';
                            $productViewedObj->legend = '';
                        }
                        $lrw = $productViewedObj->link_rewrite;
                        if ($useLink && (!Tools::getValue('id_product', false) || (Tools::getValue('id_product', false) != $id_product))) {
                            $productImagesData[$id_product]['link'] = $link->getProductLink($id_product, $lrw, $productViewedObj->category);
                        } else {
                            $productImagesData[$id_product]['link'] = '';
                        }

                        $productImagesData[$id_product]['title'] = $productViewedObj->name;
                        $productImagesData[$id_product]['img'] = $_link->getImageLink($lrw, $productViewedObj->cover, $tool->params->getValue('thumb-image'));
                    }
                }
                $html = $tool->getMainTemplate($productImagesData, array('id' => 'blockviewedMagicScroll'));

                //NOTE: to place it in the center (can't use "margin: 0 auto" because "display: inline-block")
                $html = '<div class="MagicToolboxContainer">'.$html.'</div>';

                $pattern = '<ul\b[^>]*?>.*?</ul>';
                $output = preg_replace('#'.$pattern.'#is', $html, $output);
                break;
            case 'blockbestsellers':
            case 'blockbestsellers_home':
            case 'blocknewproducts':
            case 'blocknewproducts_home':
                if (in_array($currentTemplate, array('blockbestsellers', 'blockbestsellers_home'))) {
                    $nb_products = $tool->params->getValue('max-number-of-products', $currentTemplate);
                    //$products = $smarty->{$this->getTemplateVars}('best_sellers');
                    //to get with description etc.
                    $products = ProductSale::getBestSales((int)$cookie->id_lang, 0, $nb_products);
                } else {
                    if ($this->isPrestaShop17x) {
                        $products = $smarty->{$this->getTemplateVars}('products');
                    } else {
                        $products = $smarty->{$this->getTemplateVars}('new_products');
                    }
                }

                if (!is_array($products)) {
                    break;
                }
                $pCount = count($products);
                if ($pCount < 2/* || !$products*/) {
                    break;
                }
                $GLOBALS['magictoolbox']['magicscroll']['headers'] = true;
                $productImagesData = array();
                $useLink = $tool->params->checkValue('link-to-product-page', 'Yes');
                foreach ($products as $p_key => $product) {
                    if ($useLink && (!Tools::getValue('id_product', false) || (Tools::getValue('id_product', false) != $product['id_product']))) {
                        $productImagesData[$p_key]['link'] = $link->getProductLink($product['id_product'], $product['link_rewrite'], isset($product['category']) ? $product['category'] : null);
                    } else {
                        $productImagesData[$p_key]['link'] = '';
                    }

                    $productImagesData[$p_key]['title'] = $product['name'];
                    $productImagesData[$p_key]['img'] = $_link->getImageLink($product['link_rewrite'], $product['id_image'], $tool->params->getValue('thumb-image'));
                }
                $html = $tool->getMainTemplate($productImagesData, array('id' => $currentTemplate.'MagicScroll'));
                if ($this->isPrestaShop16x) {
                    if ($currentTemplate == 'blockbestsellers_home') {
                        $html = '<div id="blockbestsellers" class="MagicToolboxContainer blockbestsellers tab-pane">'.$html.'</div>';
                    } elseif ($currentTemplate == 'blocknewproducts_home') {
                        $html = '<div id="blocknewproducts" class="MagicToolboxContainer blocknewproducts tab-pane active">'.$html.'</div>';
                    }
                } else {
                    //NOTE: to place it in the center (can't use "margin: 0 auto" because "display: inline-block")
                    $html = '<div class="MagicToolboxContainer">'.$html.'</div>';
                }
                if ($this->isPrestaShop17x) {
                    $pattern =  '<div\b[^>]*?\bclass\s*+=\s*+"[^"]*?\bproducts\b[^"]*+"[^>]*+>'.
                                '('.
                                '(?:'.
                                    '[^<]++'.
                                    '|'.
                                    '<(?!/?div\b|!--)'.
                                    '|'.
                                    '<!--.*?-->'.
                                    '|'.
                                    '<div\b[^>]*+>'.
                                        '(?1)'.
                                    '</div\s*+>'.
                                ')*+'.
                                ')'.
                                '</div\s*+>';
                    $matches = array();
                    if (preg_match('#'.$pattern.'#is', $output, $matches)) {
                        $pattern = '(<article\b[^>]*+>.*?</article>[^<]*+)++';
                        $html = preg_replace('#'.$pattern.'#is', $html, $matches[0]);
                        $output = str_replace($matches[0], $html, $output);
                    }
                } else {
                    $pattern = '<ul\b[^>]*+>.*?</ul>';
                    $output = preg_replace('#'.$pattern.'#is', $html, $output);
                }
                break;
        }

        return self::prepareOutput($output);

    }

    public function getAllSpecial($id_lang, $beginning = false, $ending = false)
    {
        $currentDate = date('Y-m-d');
        $result = Db::getInstance()->ExecuteS('
        SELECT p.*, pl.`description`, pl.`description_short`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, p.`ean13`,
            i.`id_image`, il.`legend`, t.`rate`
        FROM `'._DB_PREFIX_.'product` p
        LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.(int)$id_lang.')
        LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
        LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)$id_lang.')
        LEFT JOIN `'._DB_PREFIX_.'tax` t ON t.`id_tax` = p.`id_tax`
        WHERE (`reduction_price` > 0 OR `reduction_percent` > 0)
        '.((!$beginning && !$ending) ?
            'AND (`reduction_from` = `reduction_to` OR (`reduction_from` <= \''.pSQL($currentDate).'\' AND `reduction_to` >= \''.pSQL($currentDate).'\'))'
        :
            ($beginning ? 'AND `reduction_from` <= \''.pSQL($beginning).'\'' : '').($ending ? 'AND `reduction_to` >= \''.pSQL($ending).'\'' : '')).'
        AND p.`active` = 1
        ORDER BY RAND()');

        if (!$result) {
            return false;
        }

        $rows = array();
        foreach ($result as $row) {
            $rows[] = Product::getProductProperties($id_lang, $row);
        }

        return $rows;
    }

    /* for Prestashop ver 1.1 */
    public function getImageLink($name, $ids, $type = null)
    {
        return _THEME_PROD_DIR_.$ids.($type ? '-'.$type : '').'.jpg';
    }


    public function getProductDescription($id_product, $id_lang)
    {
        $sql = 'SELECT `description` FROM `'._DB_PREFIX_.'product_lang` WHERE `id_product` = '.(int)($id_product).' AND `id_lang` = '.(int)($id_lang);
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
        return isset($result[0]['description'])? $result[0]['description'] : '';
    }

    public function setImageSizes()
    {
        static $sizes = array();
        $tool = $this->loadTool();
        $profile = $tool->params->getProfile();
        if (!isset($sizes[$profile])) {
            $thumbImageType = $tool->params->getValue('thumb-image');
            $selectorImageType = $tool->params->getValue('selector-image');
            $sql = 'SELECT name, width, height FROM `'._DB_PREFIX_.'image_type` WHERE name in (\''.pSQL($thumbImageType).'\', \''.pSQL($selectorImageType).'\')';
            $result = Db::getInstance()->ExecuteS($sql);
            $result[$result[0]['name']] = $result[0];
            $result[$result[1]['name']] = $result[1];
            $tool->params->setValue('thumb-max-width', $result[$thumbImageType]['width']);
            $tool->params->setValue('thumb-max-height', $result[$thumbImageType]['height']);
            $tool->params->setValue('selector-max-width', $result[$selectorImageType]['width']);
            $tool->params->setValue('selector-max-height', $result[$selectorImageType]['height']);
            $sizes[$profile] = true;
        }
    }

    public function fillDB()
    {
        $sql = 'INSERT INTO `'._DB_PREFIX_.'magicscroll_settings` (`block`, `name`, `value`, `default_value`, `enabled`, `default_enabled`) VALUES
                (\'default\', \'include-headers-on-all-pages\', \'No\', \'No\', 1, 1),
                (\'default\', \'thumb-image\', \'large\', \'large\', 1, 1),
                (\'default\', \'width\', \'auto\', \'auto\', 1, 1),
                (\'default\', \'height\', \'auto\', \'auto\', 1, 1),
                (\'default\', \'orientation\', \'horizontal\', \'horizontal\', 1, 1),
                (\'default\', \'mode\', \'scroll\', \'scroll\', 1, 1),
                (\'default\', \'items\', \'3\', \'3\', 1, 1),
                (\'default\', \'speed\', \'600\', \'600\', 1, 1),
                (\'default\', \'autoplay\', \'0\', \'0\', 1, 1),
                (\'default\', \'loop\', \'infinite\', \'infinite\', 1, 1),
                (\'default\', \'step\', \'auto\', \'auto\', 1, 1),
                (\'default\', \'arrows\', \'inside\', \'inside\', 1, 1),
                (\'default\', \'pagination\', \'No\', \'No\', 1, 1),
                (\'default\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 1, 1),
                (\'default\', \'scrollOnWheel\', \'auto\', \'auto\', 1, 1),
                (\'default\', \'lazy-load\', \'No\', \'No\', 1, 1),
                (\'default\', \'scroll-extra-styles\', \'\', \'\', 1, 1),
                (\'default\', \'show-image-title\', \'No\', \'No\', 1, 1),
                (\'default\', \'link-to-product-page\', \'Yes\', \'Yes\', 1, 1),
                (\'product\', \'thumb-image\', \'large\', \'large\', 0, 0),
                (\'product\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'product\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'product\', \'orientation\', \'horizontal\', \'horizontal\', 0, 0),
                (\'product\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'product\', \'items\', \'3\', \'3\', 0, 0),
                (\'product\', \'speed\', \'600\', \'600\', 0, 0),
                (\'product\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'product\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'product\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'product\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'product\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'product\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'product\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'product\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'product\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'product\', \'show-image-title\', \'No\', \'No\', 0, 0),
                (\'product\', \'enable-effect\', \'No\', \'No\', 1, 1),
                (\'category\', \'thumb-image\', \'large\', \'large\', 0, 0),
                (\'category\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'category\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'category\', \'orientation\', \'vertical\', \'vertical\', 1, 1),
                (\'category\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'category\', \'items\', \'3\', \'3\', 0, 0),
                (\'category\', \'speed\', \'600\', \'600\', 0, 0),
                (\'category\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'category\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'category\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'category\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'category\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'category\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'category\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'category\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'category\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'category\', \'show-image-title\', \'No\', \'No\', 0, 0),
                (\'category\', \'enable-effect\', \'No\', \'No\', 1, 1),
                (\'category\', \'link-to-product-page\', \'Yes\', \'Yes\', 0, 0),
                (\'manufacturer\', \'thumb-image\', \'large\', \'large\', 0, 0),
                (\'manufacturer\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'manufacturer\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'manufacturer\', \'orientation\', \'vertical\', \'vertical\', 1, 1),
                (\'manufacturer\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'manufacturer\', \'items\', \'3\', \'3\', 0, 0),
                (\'manufacturer\', \'speed\', \'600\', \'600\', 0, 0),
                (\'manufacturer\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'manufacturer\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'manufacturer\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'manufacturer\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'manufacturer\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'manufacturer\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'manufacturer\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'manufacturer\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'manufacturer\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'manufacturer\', \'show-image-title\', \'No\', \'No\', 0, 0),
                (\'manufacturer\', \'enable-effect\', \'No\', \'No\', 1, 1),
                (\'manufacturer\', \'link-to-product-page\', \'Yes\', \'Yes\', 0, 0),
                (\'newproductpage\', \'thumb-image\', \'large\', \'large\', 0, 0),
                (\'newproductpage\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'newproductpage\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'newproductpage\', \'orientation\', \'vertical\', \'vertical\', 1, 1),
                (\'newproductpage\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'newproductpage\', \'items\', \'3\', \'3\', 0, 0),
                (\'newproductpage\', \'speed\', \'600\', \'600\', 0, 0),
                (\'newproductpage\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'newproductpage\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'newproductpage\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'newproductpage\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'newproductpage\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'newproductpage\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'newproductpage\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'newproductpage\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'newproductpage\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'newproductpage\', \'show-image-title\', \'No\', \'No\', 0, 0),
                (\'newproductpage\', \'enable-effect\', \'No\', \'No\', 1, 1),
                (\'newproductpage\', \'link-to-product-page\', \'Yes\', \'Yes\', 0, 0),
                (\'blocknewproducts\', \'thumb-image\', \'home\', \'home\', 1, 1),
                (\'blocknewproducts\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'blocknewproducts\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'blocknewproducts\', \'orientation\', \'vertical\', \'vertical\', 1, 1),
                (\'blocknewproducts\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'blocknewproducts\', \'items\', \'3\', \'3\', 0, 0),
                (\'blocknewproducts\', \'speed\', \'600\', \'600\', 0, 0),
                (\'blocknewproducts\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'blocknewproducts\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'blocknewproducts\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'blocknewproducts\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'blocknewproducts\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'blocknewproducts\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'blocknewproducts\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'blocknewproducts\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'blocknewproducts\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'blocknewproducts\', \'show-image-title\', \'No\', \'No\', 0, 0),
                (\'blocknewproducts\', \'enable-effect\', \'Yes\', \'Yes\', 1, 1),
                (\'blocknewproducts\', \'link-to-product-page\', \'Yes\', \'Yes\', 0, 0),
                (\'blocknewproducts_home\', \'thumb-image\', \'large\', \'large\', 0, 0),
                (\'blocknewproducts_home\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'blocknewproducts_home\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'blocknewproducts_home\', \'orientation\', \'horizontal\', \'horizontal\', 0, 0),
                (\'blocknewproducts_home\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'blocknewproducts_home\', \'items\', \'3\', \'3\', 0, 0),
                (\'blocknewproducts_home\', \'speed\', \'600\', \'600\', 0, 0),
                (\'blocknewproducts_home\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'blocknewproducts_home\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'blocknewproducts_home\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'blocknewproducts_home\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'blocknewproducts_home\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'blocknewproducts_home\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'blocknewproducts_home\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'blocknewproducts_home\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'blocknewproducts_home\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'blocknewproducts_home\', \'show-image-title\', \'No\', \'No\', 0, 0),
                (\'blocknewproducts_home\', \'enable-effect\', \'Yes\', \'Yes\', 1, 1),
                (\'blocknewproducts_home\', \'link-to-product-page\', \'Yes\', \'Yes\', 0, 0),
                (\'bestsellerspage\', \'thumb-image\', \'large\', \'large\', 0, 0),
                (\'bestsellerspage\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'bestsellerspage\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'bestsellerspage\', \'orientation\', \'vertical\', \'vertical\', 1, 1),
                (\'bestsellerspage\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'bestsellerspage\', \'items\', \'3\', \'3\', 0, 0),
                (\'bestsellerspage\', \'speed\', \'600\', \'600\', 0, 0),
                (\'bestsellerspage\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'bestsellerspage\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'bestsellerspage\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'bestsellerspage\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'bestsellerspage\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'bestsellerspage\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'bestsellerspage\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'bestsellerspage\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'bestsellerspage\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'bestsellerspage\', \'show-image-title\', \'No\', \'No\', 0, 0),
                (\'bestsellerspage\', \'enable-effect\', \'No\', \'No\', 1, 1),
                (\'bestsellerspage\', \'link-to-product-page\', \'Yes\', \'Yes\', 0, 0),
                (\'blockbestsellers\', \'thumb-image\', \'home\', \'home\', 1, 1),
                (\'blockbestsellers\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'blockbestsellers\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'blockbestsellers\', \'orientation\', \'vertical\', \'vertical\', 1, 1),
                (\'blockbestsellers\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'blockbestsellers\', \'items\', \'3\', \'3\', 0, 0),
                (\'blockbestsellers\', \'speed\', \'600\', \'600\', 0, 0),
                (\'blockbestsellers\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'blockbestsellers\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'blockbestsellers\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'blockbestsellers\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'blockbestsellers\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'blockbestsellers\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'blockbestsellers\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'blockbestsellers\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'blockbestsellers\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'blockbestsellers\', \'show-image-title\', \'No\', \'No\', 0, 0),
                (\'blockbestsellers\', \'max-number-of-products\', \'5\', \'5\', 1, 1),
                (\'blockbestsellers\', \'enable-effect\', \'Yes\', \'Yes\', 1, 1),
                (\'blockbestsellers\', \'link-to-product-page\', \'Yes\', \'Yes\', 0, 0),
                (\'blockbestsellers_home\', \'thumb-image\', \'large\', \'large\', 0, 0),
                (\'blockbestsellers_home\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'blockbestsellers_home\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'blockbestsellers_home\', \'orientation\', \'horizontal\', \'horizontal\', 0, 0),
                (\'blockbestsellers_home\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'blockbestsellers_home\', \'items\', \'3\', \'3\', 0, 0),
                (\'blockbestsellers_home\', \'speed\', \'600\', \'600\', 0, 0),
                (\'blockbestsellers_home\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'blockbestsellers_home\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'blockbestsellers_home\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'blockbestsellers_home\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'blockbestsellers_home\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'blockbestsellers_home\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'blockbestsellers_home\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'blockbestsellers_home\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'blockbestsellers_home\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'blockbestsellers_home\', \'show-image-title\', \'No\', \'No\', 0, 0),
                (\'blockbestsellers_home\', \'max-number-of-products\', \'8\', \'8\', 1, 1),
                (\'blockbestsellers_home\', \'enable-effect\', \'Yes\', \'Yes\', 1, 1),
                (\'blockbestsellers_home\', \'link-to-product-page\', \'Yes\', \'Yes\', 0, 0),
                (\'specialspage\', \'thumb-image\', \'large\', \'large\', 0, 0),
                (\'specialspage\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'specialspage\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'specialspage\', \'orientation\', \'vertical\', \'vertical\', 1, 1),
                (\'specialspage\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'specialspage\', \'items\', \'3\', \'3\', 0, 0),
                (\'specialspage\', \'speed\', \'600\', \'600\', 0, 0),
                (\'specialspage\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'specialspage\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'specialspage\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'specialspage\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'specialspage\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'specialspage\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'specialspage\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'specialspage\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'specialspage\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'specialspage\', \'show-image-title\', \'No\', \'No\', 0, 0),
                (\'specialspage\', \'enable-effect\', \'No\', \'No\', 1, 1),
                (\'specialspage\', \'link-to-product-page\', \'Yes\', \'Yes\', 0, 0),
                (\'blockspecials\', \'thumb-image\', \'home\', \'home\', 1, 1),
                (\'blockspecials\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'blockspecials\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'blockspecials\', \'orientation\', \'vertical\', \'vertical\', 1, 1),
                (\'blockspecials\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'blockspecials\', \'items\', \'3\', \'3\', 0, 0),
                (\'blockspecials\', \'speed\', \'600\', \'600\', 0, 0),
                (\'blockspecials\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'blockspecials\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'blockspecials\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'blockspecials\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'blockspecials\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'blockspecials\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'blockspecials\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'blockspecials\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'blockspecials\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'blockspecials\', \'show-image-title\', \'No\', \'No\', 0, 0),
                (\'blockspecials\', \'enable-effect\', \'Yes\', \'Yes\', 1, 1),
                (\'blockspecials\', \'link-to-product-page\', \'Yes\', \'Yes\', 0, 0),
                (\'blockspecials_home\', \'thumb-image\', \'large\', \'large\', 0, 0),
                (\'blockspecials_home\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'blockspecials_home\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'blockspecials_home\', \'orientation\', \'horizontal\', \'horizontal\', 0, 0),
                (\'blockspecials_home\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'blockspecials_home\', \'items\', \'3\', \'3\', 0, 0),
                (\'blockspecials_home\', \'speed\', \'600\', \'600\', 0, 0),
                (\'blockspecials_home\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'blockspecials_home\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'blockspecials_home\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'blockspecials_home\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'blockspecials_home\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'blockspecials_home\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'blockspecials_home\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'blockspecials_home\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'blockspecials_home\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'blockspecials_home\', \'show-image-title\', \'No\', \'No\', 0, 0),
                (\'blockspecials_home\', \'enable-effect\', \'Yes\', \'Yes\', 1, 1),
                (\'blockspecials_home\', \'link-to-product-page\', \'Yes\', \'Yes\', 0, 0),
                (\'blockviewed\', \'thumb-image\', \'home\', \'home\', 1, 1),
                (\'blockviewed\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'blockviewed\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'blockviewed\', \'orientation\', \'vertical\', \'vertical\', 1, 1),
                (\'blockviewed\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'blockviewed\', \'items\', \'3\', \'3\', 0, 0),
                (\'blockviewed\', \'speed\', \'600\', \'600\', 0, 0),
                (\'blockviewed\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'blockviewed\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'blockviewed\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'blockviewed\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'blockviewed\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'blockviewed\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'blockviewed\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'blockviewed\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'blockviewed\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'blockviewed\', \'show-image-title\', \'No\', \'No\', 0, 0),
                (\'blockviewed\', \'enable-effect\', \'Yes\', \'Yes\', 1, 1),
                (\'blockviewed\', \'link-to-product-page\', \'Yes\', \'Yes\', 0, 0),
                (\'homefeatured\', \'thumb-image\', \'home\', \'home\', 1, 1),
                (\'homefeatured\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'homefeatured\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'homefeatured\', \'orientation\', \'horizontal\', \'horizontal\', 0, 0),
                (\'homefeatured\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'homefeatured\', \'items\', \'3\', \'3\', 0, 0),
                (\'homefeatured\', \'speed\', \'600\', \'600\', 0, 0),
                (\'homefeatured\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'homefeatured\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'homefeatured\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'homefeatured\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'homefeatured\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'homefeatured\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'homefeatured\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'homefeatured\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'homefeatured\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'homefeatured\', \'show-image-title\', \'Yes\', \'Yes\', 1, 1),
                (\'homefeatured\', \'enable-effect\', \'Yes\', \'Yes\', 1, 1),
                (\'homefeatured\', \'link-to-product-page\', \'Yes\', \'Yes\', 0, 0),
                (\'homeslideshow\', \'thumb-image\', \'large\', \'large\', 0, 0),
                (\'homeslideshow\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'homeslideshow\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'homeslideshow\', \'orientation\', \'horizontal\', \'horizontal\', 0, 0),
                (\'homeslideshow\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'homeslideshow\', \'items\', \'fit\', \'fit\', 1, 1),
                (\'homeslideshow\', \'speed\', \'600\', \'600\', 0, 0),
                (\'homeslideshow\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'homeslideshow\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'homeslideshow\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'homeslideshow\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'homeslideshow\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'homeslideshow\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'homeslideshow\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'homeslideshow\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'homeslideshow\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'homeslideshow\', \'show-image-title\', \'No\', \'No\', 0, 0),
                (\'homeslideshow\', \'enable-effect\', \'Yes\', \'Yes\', 1, 1),
                (\'search\', \'thumb-image\', \'large\', \'large\', 0, 0),
                (\'search\', \'width\', \'auto\', \'auto\', 0, 0),
                (\'search\', \'height\', \'auto\', \'auto\', 0, 0),
                (\'search\', \'orientation\', \'vertical\', \'vertical\', 1, 1),
                (\'search\', \'mode\', \'scroll\', \'scroll\', 0, 0),
                (\'search\', \'items\', \'3\', \'3\', 0, 0),
                (\'search\', \'speed\', \'600\', \'600\', 0, 0),
                (\'search\', \'autoplay\', \'0\', \'0\', 0, 0),
                (\'search\', \'loop\', \'infinite\', \'infinite\', 0, 0),
                (\'search\', \'step\', \'auto\', \'auto\', 0, 0),
                (\'search\', \'arrows\', \'inside\', \'inside\', 0, 0),
                (\'search\', \'pagination\', \'No\', \'No\', 0, 0),
                (\'search\', \'easing\', \'cubic-bezier(.8, 0, .5, 1)\', \'cubic-bezier(.8, 0, .5, 1)\', 0, 0),
                (\'search\', \'scrollOnWheel\', \'auto\', \'auto\', 0, 0),
                (\'search\', \'lazy-load\', \'No\', \'No\', 0, 0),
                (\'search\', \'scroll-extra-styles\', \'\', \'\', 0, 0),
                (\'search\', \'show-image-title\', \'No\', \'No\', 0, 0),
                (\'search\', \'enable-effect\', \'No\', \'No\', 1, 1),
                (\'search\', \'link-to-product-page\', \'Yes\', \'Yes\', 0, 0)';
        if ($this->isPrestaShop16x) {
            $sql = preg_replace('/\r\n\s*..(?:category|manufacturer|newproductpage|bestsellerspage|specialspage|search)\b[^\r]*+/i', '', $sql);
            $sql = rtrim($sql, ',');
        }
        if (!$this->isPrestaShop16x) {
            $sql = preg_replace('/\r\n\s*..(?:blockbestsellers_home|blocknewproducts_home|blockspecials_home)\b[^\r]*+/i', '', $sql);
            $sql = rtrim($sql, ',');
        }
        return Db::getInstance()->Execute($sql);
    }

    public function getBlocks()
    {
        $blocks = array(
            'default' => 'Default settings',
            'product' => 'Product page',
            'category' => 'Category page',
            'manufacturer' => 'Manufacturers page',
            'newproductpage' => 'New products page',
            'blocknewproducts' => 'New products sidebar',
            'blocknewproducts_home' => 'New products block',
            'bestsellerspage' => 'Bestsellers page',
            'blockbestsellers' => 'Bestsellers sidebar',
            'blockbestsellers_home' => 'Bestsellers block',
            'specialspage' => 'Specials page',
            'blockspecials' => 'Specials sidebar',
            'blockspecials_home' => 'Specials block',
            'blockviewed' => 'Viewed sidebar',
            'homefeatured' => 'Featured block',
            'homeslideshow' => 'Home page/custom slideshow',
            'search' => 'Search page'
        );
        if ($this->isPrestaShop16x) {
            unset($blocks['category'], $blocks['manufacturer'], $blocks['newproductpage'], $blocks['bestsellerspage'], $blocks['specialspage'], $blocks['search']);
        }
        if (!$this->isPrestaShop16x) {
            unset($blocks['blockbestsellers_home'], $blocks['blocknewproducts_home'], $blocks['blockspecials_home']);
        }
        if ($this->isPrestaShop17x) {
            unset($blocks['blocknewproducts'], $blocks['manufacturer'], $blocks['blockspecials'], $blocks['blockbestsellers'], $blocks['blockviewed']);
        }
        return $blocks;
    }

    public function getMessages()
    {
        return array(
            'default' => array(
            ),
            'product' => array(
            ),
            'category' => array(
            ),
            'manufacturer' => array(
            ),
            'newproductpage' => array(
            ),
            'blocknewproducts' => array(
            ),
            'blocknewproducts_home' => array(
            ),
            'bestsellerspage' => array(
            ),
            'blockbestsellers' => array(
            ),
            'blockbestsellers_home' => array(
            ),
            'specialspage' => array(
            ),
            'blockspecials' => array(
            ),
            'blockspecials_home' => array(
            ),
            'blockviewed' => array(
            ),
            'homefeatured' => array(
            ),
            'homeslideshow' => array(
            ),
            'search' => array(
            )
        );
    }

    public function getParamsMap()
    {
        $map = array(
            'default' => array(
                'General' => array(
                    'include-headers-on-all-pages' => true
                ),
                'Image type' => array(
                    'thumb-image' => true
                ),
                'Scroll' => array(
                    'width' => true,
                    'height' => true,
                    'orientation' => true,
                    'mode' => true,
                    'items' => true,
                    'speed' => true,
                    'autoplay' => true,
                    'loop' => true,
                    'step' => true,
                    'arrows' => true,
                    'pagination' => true,
                    'easing' => true,
                    'scrollOnWheel' => true,
                    'lazy-load' => true,
                    'scroll-extra-styles' => true,
                    'show-image-title' => true
                ),
                'Miscellaneous' => array(
                    'link-to-product-page' => true
                )
            ),
            'product' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Image type' => array(
                    'thumb-image' => false
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
            ),
            'category' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
                'Miscellaneous' => array(
                    'link-to-product-page' => false
                )
            ),
            'manufacturer' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
                'Miscellaneous' => array(
                    'link-to-product-page' => false
                )
            ),
            'newproductpage' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
                'Miscellaneous' => array(
                    'link-to-product-page' => false
                )
            ),
            'blocknewproducts' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Image type' => array(
                    'thumb-image' => false
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
                'Miscellaneous' => array(
                    'link-to-product-page' => false
                )
            ),
            'blocknewproducts_home' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Image type' => array(
                    'thumb-image' => false
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
                'Miscellaneous' => array(
                    'link-to-product-page' => false
                )
            ),
            'bestsellerspage' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
                'Miscellaneous' => array(
                    'link-to-product-page' => false
                )
            ),
            'blockbestsellers' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Image type' => array(
                    'thumb-image' => false
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
                'Miscellaneous' => array(
                    'max-number-of-products' => true,
                    'link-to-product-page' => false
                )
            ),
            'blockbestsellers_home' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Image type' => array(
                    'thumb-image' => false
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
                'Miscellaneous' => array(
                    'max-number-of-products' => true,
                    'link-to-product-page' => false
                )
            ),
            'specialspage' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
                'Miscellaneous' => array(
                    'link-to-product-page' => false
                )
            ),
            'blockspecials' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Image type' => array(
                    'thumb-image' => false
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
                'Miscellaneous' => array(
                    'link-to-product-page' => false
                )
            ),
            'blockspecials_home' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Image type' => array(
                    'thumb-image' => false
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
                'Miscellaneous' => array(
                    'link-to-product-page' => false
                )
            ),
            'blockviewed' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Image type' => array(
                    'thumb-image' => false
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
                'Miscellaneous' => array(
                    'link-to-product-page' => false
                )
            ),
            'homefeatured' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Image type' => array(
                    'thumb-image' => false
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
                'Miscellaneous' => array(
                    'link-to-product-page' => false
                )
            ),
            'homeslideshow' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Slideshow images' => array(
                ),
                'Image type' => array(
                    'thumb-image' => false
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
            ),
            'search' => array(
                'Enable effect' => array(
                    'enable-effect' => true
                ),
                'Scroll' => array(
                    'width' => false,
                    'height' => false,
                    'orientation' => false,
                    'mode' => false,
                    'items' => false,
                    'speed' => false,
                    'autoplay' => false,
                    'loop' => false,
                    'step' => false,
                    'arrows' => false,
                    'pagination' => false,
                    'easing' => false,
                    'scrollOnWheel' => false,
                    'lazy-load' => false,
                    'scroll-extra-styles' => false,
                    'show-image-title' => false
                ),
                'Miscellaneous' => array(
                    'link-to-product-page' => false
                )
            )
        );
        if ($this->isPrestaShop16x) {
            unset($map['category'], $map['manufacturer'], $map['newproductpage'], $map['bestsellerspage'], $map['specialspage'], $map['search']);
        }
        if (!$this->isPrestaShop16x) {
            unset($map['blockbestsellers_home'], $map['blocknewproducts_home'], $map['blockspecials_home']);
        }
        if ($this->isPrestaShop17x) {
            unset($map['blocknewproducts'], $map['manufacturer'], $map['blockspecials'], $map['blockbestsellers'], $map['blockviewed']);
        }
        return $map;
    }

    public function gebugVars($smarty = null)
    {
        if ($smarty === null) {
            $smarty = &$GLOBALS['smarty'];
        }
        $result = array();
        $vars = $smarty->{$this->getTemplateVars}();
        if (is_array($vars)) {
            foreach ($vars as $key => $value) {
                $result[$key] = gettype($value);
            }
        } else {
            $result = gettype($vars);
        }
        return $result;
    }
}
