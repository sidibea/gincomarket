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

if (!defined('MAGICTOOLBOX_SETTINGS_EDITOR_CLASS_LOADED')) {

    define('MAGICTOOLBOX_SETTINGS_EDITOR_CLASS_LOADED', true);

    class MagictoolboxSettingsEditorClass
    {

        public $profiles = array('default' => 'General params');
        public $profilesDescription = array('default' => 'These settings will apply on every page/section where you activate Magic Scroll&#8482;');//&#8482; => ™
        public $activeTab = 'default';
        public $core = null;/* Module Core Class */
        public $paramsMap = array();
        public $mandatoryParams = array();
        public $inputs = array();
        public $jsFiles = array();
        public $buttons = array();
        public $graphicsForValues = array(
            'Yes' => '<span class="mt-icon-check-mark"></span>',
            'No' => '<span class="mt-icon-remove-1"></span>',
        );
        public $pathToJS = '';
        public $action = '';
        public $resourcesURL = 'resources/';
        public $jsResourcesURL = '';
        public $cssResourcesURL = '';
        public $namePrefix = 'magictoolbox';
        public $pageTitle = 'Magic Scroll configuration';
        public $license = '';
        public $message = '';
        public $customSlideshowProfileId = 'homeslideshow';
        public $customSlideshowGroupTitle = 'Slideshow images';
        public $customSlideshowImagesData = array();
        public $languagesData = array();
        public $imageBaseUrl = '';
        public $isMagicScrollBundled = true;//NOTE: for modules of standard type

        public function __construct($pathToJS = '')
        {
            $this->pathToJS = $pathToJS;
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $license = Tools::getValue('magicscroll-license-key', false);
                $this->activeTab = Tools::getValue('magicscroll-active-tab', $this->activeTab);
                if (!empty($license) && $this->getLicenseType('magicscroll') == 'trial') {
                    $message = $this->processLicenseKey('magicscroll', $license);
                    if (!empty($message)) {
                        $this->message .= "<br/>{$message}<br/>";
                    }
                }
            }
        }

        public function processLicenseKey($tool, $license)
        {
            if (empty($this->pathToJS)) {
                return 'Undefined path to JS files';
            }
            if (preg_match('#[^\-\.0-9A-Za-z]#', $license)) {
                return 'Please enter the correct license key.';
            }
            $url = "https://www.magictoolbox.com/site/order/{$license}/{$tool}.js";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            $response = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($code == 200) {
                $result = file_put_contents($this->pathToJS.DIRECTORY_SEPARATOR."{$tool}.js", $response);
                //file_put_contents(dirname(__FILE__).DIRECTORY_SEPARATOR."{$tool}.license", $license);
                if ($result === false) {
                    return 'Can\'t store the license key.';
                }
                //return 'License successfully updated.';
                return '';
            } elseif ($code == 403) {
                return 'There was a problem with checking your license key. Please contact us.';
                //Download limit reached
                //Your license has been downloaded 10 times already.
                //If you wish to download your license again, please contact us.
            } else {
                return 'Please enter the valid license key.';
            }

        }

        public function setProfiles($profiles = array())
        {
            $this->profiles = $profiles;
        }

        public function addProfile($title, $key = '')
        {
            if (empty($key)) {
                $key = Tools::strtolower(preg_replace('#\s+#', '', $title));
            }
            $this->profiles[$key] = $title;
        }

        public function setActiveTab($tab)
        {
            $this->activeTab = $tab;
        }

        public function setParamsMap(&$map = null)
        {
            $this->paramsMap = &$map;
        }

        public function profileEnabled($profile)
        {
            if ($profile == $this->core->params->generalProfile) {
                return true;
            }
            return !$this->core->params->checkValue('enable-effect', 'No', $profile);
        }

        public function getValueForDisplay($value)
        {
            return isset($this->graphicsForValues[$value]) ? $this->graphicsForValues[$value] : $value;
        }

        public function isEnabledParam($id, $profile)
        {
            //return !$this->core->params->checkValue($id, $this->core->params->getValue($id, $this->core->params->generalProfile), $profile);
            return $this->core->params->paramExists($id, $profile, true);
        }

        public function getLicenseType($tool)
        {
            $license = 'trial';
            if (is_file($this->pathToJS.DIRECTORY_SEPARATOR.$tool.'.js')) {
                $contents = Tools::file_get_contents($this->pathToJS.DIRECTORY_SEPARATOR.$tool.'.js');
                if (strpos($contents, ' DEMO') === false) {
                    $license = 'commercial';
                }
            }
            return $license;
        }

        public function getFormAction()
        {
            return empty($this->action) ? htmlentities($_SERVER['REQUEST_URI']) : $this->action;
        }

        public function getName($profileId, $id)
        {
            return "{$this->namePrefix}[{$profileId}][{$id}]";
        }

        public function setInputValue($name, $value)
        {
            $this->inputs[$name] = $value;
        }

        public function getInputsHTML()
        {
            $html = '';
            foreach ($this->inputs as $name => $value) {
                $html .= "<input type=\"hidden\" name=\"{$name}\" value=\"{$value}\" />\n";
            }
            return $html;
        }

        public function addJSFile($url)
        {
            $this->jsFiles[] = $url;
        }

        public function getScripts()
        {
            $html = '';
            foreach ($this->jsFiles as $src) {
                $html .= "<script type=\"text/javascript\" src=\"{$src}\"></script>\n";
            }
            return $html;
        }

        public function loadJQuery($load = null)
        {
            static $_load = true;
            if ($load !== null) {
                $_load = $load;
            }
            return $_load;
        }

        public function jQueryNoConflictLevel($level = null)
        {
            //0 - not to call
            //1 - jQuery.noConflict();
            //2 - jQuery.noConflict(true);
            static $_level = 1;
            if ($level !== null) {
                $_level = $level;
            }
            return $_level;
        }

        public function showPageTitle($showPageTitle = null)
        {
            static $_showPageTitle = true;
            if ($showPageTitle !== null) {
                $_showPageTitle = $showPageTitle;
            }
            return $_showPageTitle;
        }

        public function setAdditionalButton($action, $value)
        {
            $this->buttons[$action] = $value;
        }

        public function getAdditionalButtons()
        {
            $html = '';
            foreach ($this->buttons as $action => $value) {
                $html .= "<input type=\"button\" class=\"mt-button mt-border-r-4px\" data-submit-action=\"{$action}\" value=\"{$value}\"/>\n";
            }
            return $html;
        }

        public function setResourcesURL($url, $type = '')
        {
            switch ($type) {
                case 'js':
                    $this->jsResourcesURL = $url;
                    break;
                case 'css':
                    $this->cssResourcesURL = $url;
                    break;
                default:
                    $this->resourcesURL = $url;
            }
        }

        public function getResourcesURL($type = '')
        {
            $url = $this->resourcesURL;
            switch ($type) {
                case 'js':
                    if (!empty($this->jsResourcesURL)) {
                        $url = $this->jsResourcesURL;
                    }
                    break;
                case 'css':
                    if (!empty($this->cssResourcesURL)) {
                        $url = $this->cssResourcesURL;
                    }
                    break;
            }
            return $url;
        }

        public function getCSS()
        {
            return '';
        }

        public function getHTML()
        {
            $params = & $this->core->params;

            //NOTE: change subtype for some params to display them like radio
            foreach ($params->getProfiles() as $profile) {
                foreach ($params->getParams($profile) as $id => $param) {
                    if ($params->getSubType($id, $profile) == 'select' && count($params->getValues($id, $profile)) < 6) {
                        $params->setSubType($id, 'radio', $profile);
                    }
                }
            }

            $license = $this->getLicenseType('magicscroll');
            $trial = ($license == 'trial');

            //NOTE: spike for prestashop validator
            $GLOBALS['magictoolbox_temp_settings'] = $this;
            $GLOBALS['magictoolbox_temp_trial'] = $trial;
            $GLOBALS['magictoolbox_temp_params'] = $params;
            ob_start();
            require(dirname(__FILE__).DIRECTORY_SEPARATOR.'magictoolbox.settings.editor.tpl.php');
            $html = ob_get_clean();
            unset($GLOBALS['magictoolbox_temp_settings']);
            unset($GLOBALS['magictoolbox_temp_trial']);
            unset($GLOBALS['magictoolbox_temp_params']);
            return $html;
        }
    }

}
