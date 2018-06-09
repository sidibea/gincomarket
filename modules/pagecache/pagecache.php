<?php
/**
 * Page Cache powered by Jpresta (jpresta . com)
 *
 *    @author    Jpresta
 *    @copyright Jpresta
 *    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
 *               is permitted for one Prestashop instance only but you can install it on your test instances.
 */

if (!defined('_CAN_LOAD_FILES_'))
    exit;

require_once 'PageCacheURLNormalizer.php';
require_once 'PageCacheUtils.php';
require_once 'PageCacheCache.php';
require_once 'PageCacheCacheSimpleFS.php';
require_once 'PageCacheCacheMultiStore.php';
// ULTIMATE
require_once 'PageCacheCacheZipArchive.php';
// ULTIMATE£
require_once 'PageCacheDAO.php';
require_once 'http_build_url.php';

class PageCache extends Module
{

    const PAGECACHE_DIR = 'pagecache';
    const INSTALL_STEP_INSTALL = 1;
    const INSTALL_STEP_BUY_FROM = 2;
    const INSTALL_STEP_IN_ACTION = 3;
    const INSTALL_STEP_AUTOCONF = 4;
    const INSTALL_STEP_CART = 5;
    const INSTALL_STEP_LOGGED_IN = 6;
    const INSTALL_STEP_EU_COOKIE = 7;
    const INSTALL_STEP_VALIDATE = 8;
    const LAST_INSTALL_STEP = 9;
    const INSTALL_STEP_BACK_TO_TEST = self::INSTALL_STEP_BUY_FROM;

    public static $managed_controllers = array(
        'index',
        'category',
        'product',
        'cms',
        'newproducts',
        'bestsales',
        'supplier',
        'manufacturer',
        'contact',
        'pricesdrop',
        'sitemap');

    private static $default_dyn_hooks = array(
        'displayproducttabcontent',
        'displayrightcolumn',
        'displayleftcolumn',
        'displaytop',
        'displaynav',
        'displayproducttab',
        'actionproductoutofstock',
        'displayfooterproduct',
        'displayleftcolumnproduct',
        'displayhome',
        'displayfooter',
        'displaysidebarright',
        'displayrightbar');

    private static $default_dyn_modules = array(
        'blockuserinfo',
        'blockviewed',
        'blockmyaccount',
        'favoriteproducts',
        'blockwishlist',
        'blockviewed_mod',
        'stcompare',
        'ps_shoppingcart',
        'ps_customersignin'
    );

    private $contact_url, $rating_url;

    const AUTOCONF_PROTO = 'https://';
    const AUTOCONF_DOMAIN = 'autoconf.jpresta';
    const AUTOCONF_URL = '.com/autoconf.php';
    const JPRESTA_PROTO = 'http://';
    const JPRESTA_DOMAIN = 'jpresta';
    const DOC_PROTO = 'https://';
    const DOC_DOMAIN = 'docs.google';
    const DOC_URL_FR = '.com/document/d/18AboJ_CGq24Q7Y96NlaWTYwpfWwSSUcrRumhUfTOPdM/edit?usp=sharing';
    const DOC_URL_EN = '.com/document/d/1cMVk6zn2xb3B2PA3UvRsy8rHCCfjzU1fb05vWww9ia8/edit?usp=sharing';

    public function __construct()
    {
        $this->name = 'pagecache';
        $this->tab = 'administration';
        $this->version = '4.22';
        $this->author = 'JPresta.com';
        $this->author_address = '0x7951ec451376e076369022B91cb41B7824898C24';
        $this->module_key = 'e00d068863a4c8a3684e984f80756e61';
        $this->ps_versions_compliancy = array('min' => '1.5.2.0', 'max' => '1.7');

        parent::__construct();

        $this->displayName = $this->l('Page Cache Ultimate');
        $this->description = $this->l('Enable full page caching for home, categories, products, CMS and much more pages. Even with page caching you can enable some modules like \'viewed products\' or \'my account\' blocks to load dynamically in ajax. Go from seconds to few milliseconds of loading time!');

        // Check tokens
        $token_enabled = (int)(Configuration::get('PS_TOKEN_ENABLE')) == 1 ? true : false;
        if ($token_enabled) {
            $this->warning = $this->l('You must disable tokens in order for cached pages to do ajax call.');
        }
        // Check for bvkdispatcher module
        if (Module::isInstalled('bvkseodispatcher')) {
            $this->warning = $this->l('Module "SEO Pretty URL Module" (bvkseodispatcher) is not compatible with PageCache because it does not respect Prestashop standards. You have to choose between this module and PageCache.');
        }
        // Check for overrides (after an upgrade it is disabled)
        if (!self::isOverridesEnabled()) {
            $this->warning = $this->l('Overrides are disabled in Performances tab so PageCache is disabled.');
        }
    }

    public function install()
    {
        $install_ok = true;
        // Check buggy version 1.6.0.8
        if (Tools::version_compare(_PS_VERSION_,'1.6.0.8','=')) {
            // Check that a fix has been applied
            $moduleClass = Tools::file_get_contents(_PS_CLASS_DIR_ . 'module/Module.php');
            if (substr_count($moduleClass, '#^\s*<\?(?:php)?#') != 4) {
                $this->_errors[] = $this->l('Prestashop 1.6.0.8 has a bug (http://forge.prestashop.com/browse/PSCSX-2500) that must be fixed in order to install PageCache. Please upgrade your shop or apply a patch (replace 4 occurences of "#^\s*<\?(?:php)?\s#" by "#^\s*<\?(?:php)?#" in file ' . _PS_CLASS_DIR_ . 'module/Module.php).');
                $install_ok = false;
            }
        }
        // Check for pagecachestd or pagecache module
        if ($this->name !== 'pagecachestd' && Module::isInstalled('pagecachestd')) {
            $this->warning = $this->l('Module "Page Cache" (standard version) must be uninstalled or deleted to be able to install "Page Cache Ultimate".');
        }
        if ($this->name !== 'pagecache' && Module::isInstalled('pagecache')) {
            $this->warning = $this->l('Module "Page Cache Ultimate" is installed and offer more features than "Page Cache". You should keep it but if you really want the standard version, then uninstall the Ultimate version first.');
        }
        // Check for bvkdispatcher module
        if (Module::isInstalled('bvkseodispatcher')) {
            $this->_errors[] = $this->l('Module "SEO Pretty URL Module" (bvkseodispatcher) is not compatible with PageCache because it does not respect Prestashop standards. You have to choose between this module and PageCache.');
            $install_ok = false;
        }
        // Check for expresscache module
        if (Module::isInstalled('expresscache')) {
            $this->_errors[] = $this->l('Module "Express Cache" (expresscache) cannot be used with Page Cache because you can have only one HTML cache module. In order to install Page Cache you must uninstall Express Cache.');
            $install_ok = false;
        }
        if ($install_ok) {
            // Install module
            $install_ok = parent::install();
            if ($install_ok) {
                $install_ok = PageCacheDAO::createTables();
                $this->_setDefaultConfiguration();
                $this->patchSmartyConfigFront();
            } else {
                foreach (Tools::scandir($this->getLocalPath().'override', 'php', '', true) as $file) {
                    $class = basename($file, '.php');
                    if (Tools::version_compare(_PS_VERSION_,'1.6','>=')) {
                        if (PrestaShopAutoload::getInstance()->getClassPath($class.'Core')) {
                            $this->removeOverride($class);
                        }
                    } else {
                        if (Autoload::getInstance()->getClassPath($class.'Core')) {
                            $this->removeOverride($class);
                        }
                    }
                }
                // Retry after uninstalling overrides with our own method
                $install_ok = parent::install();
                if ($install_ok) {
                    $install_ok = PageCacheDAO::createTables();
                    if (!$install_ok) {
                        $this->_errors[] = $this->l('Cannot create tables for the module');
                    }
                    $this->_setDefaultConfiguration();
                }
                else {
                    $this->_errors[] = $this->l('Module::install method returned false for unknown reason');
                }
            }
        }
        // Display error if any
        if (!$install_ok && Tools::version_compare(_PS_VERSION_,'1.7','<')) {
            $this->_errors[] = $this->l('An error occured during PageCache installation. If you need help ask for support here: ' . $this->getContactUrl());
        }
        return (bool) $install_ok;
    }

    public static function getCache($id_shop = false) {
        $cacheInstance = null;
        if (!$id_shop) {
            $id_shop = Shop::getContextShopID();
        }
        if ($id_shop === null) {
            // Happens in back office when a group of shop is selected. Is used during hooks for cache refreshment.
            $ids_shops = Shop::getShops(true, Shop::getContextShopGroup(), true);
            $cacheInstance = new PageCacheCacheMultiStore();
            foreach ($ids_shops as $id_shop) {
                $cacheInstance->addCache(self::getCacheInstance($id_shop));
            }
        }
        else {
            $cacheInstance = self::getCacheInstance($id_shop);
        }
        return $cacheInstance;
    }

    private static function getCacheInstance($id_shop) {
        $cachedir = _PS_CACHE_DIR_ . self::PAGECACHE_DIR . '/' . $id_shop;
        // ULTIMATE
        $type = Configuration::get('pagecache_typecache', null, null, $id_shop);
        if (strcmp('zip', $type) === 0) {
            // If zip is set we already checked ZipArchive existance
            return new PageCacheCacheZipArchive($cachedir, Configuration::get('pagecache_logs', null, null, $id_shop) > 1);
        }
        // ULTIMATE£
        return new PageCacheCacheSimpleFS($cachedir, Configuration::get('pagecache_logs', null, null, $id_shop) > 1);
    }


    /**
     * Override Module::updateModuleTranslations()
     */
    public function updateModuleTranslations()
    {
        // Speeds up installation: do nothing because PageCache translation are not in Prestashop language pack
    }

    public function uninstall()
    {
        $this->clearCache();
        Configuration::deleteByName('pagecache_install_step');
        Configuration::deleteByName('pagecache_always_infosbox');
        Configuration::deleteByName('pagecache_debug');
        Configuration::deleteByName('pagecache_skiplogged');
        Configuration::deleteByName('pagecache_normalize_urls');
        Configuration::deleteByName('pagecache_logs');
        Configuration::deleteByName('pagecache_depend_on_device_auto');
        Configuration::deleteByName('pagecache_stats');
        Configuration::deleteByName('pagecache_show_stats');
        Configuration::deleteByName('pagecache_groups');
        Configuration::deleteByName('pagecache_cron_token');
        Configuration::deleteByName('pagecache_seller');
        Configuration::deleteByName('pagecache_ignored_params');
        Configuration::deleteByName('pagecache_dyn_hooks');
        Configuration::deleteByName('pagecache_dyn_widgets');
        Configuration::deleteByName('pagecache_typecache');
        foreach (self::$managed_controllers as $controller) {
            Configuration::deleteByName('pagecache_'.$controller);
            Configuration::deleteByName('pagecache_'.$controller.'_timeout');
            Configuration::deleteByName('pagecache_'.$controller.'_expires');
            Configuration::deleteByName('pagecache_'.$controller.'_u_bl');
            Configuration::deleteByName('pagecache_'.$controller.'_d_bl');
            Configuration::deleteByName('pagecache_'.$controller.'_a_mods');
            Configuration::deleteByName('pagecache_'.$controller.'_u_mods');
            Configuration::deleteByName('pagecache_'.$controller.'_d_mods');
        }
        Configuration::deleteByName('pagecache_product_home_u_bl');
        Configuration::deleteByName('pagecache_product_home_d_bl');
        Configuration::deleteByName('pagecache_product_home_a_mods');
        Configuration::deleteByName('pagecache_product_home_u_mods');
        Configuration::deleteByName('pagecache_product_home_d_mods');
        PageCacheDAO::dropTables();

        $ret = parent::uninstall();

        // Clean cache in case of a reset
        Cache::clean('Module::getModuleIdByName_'.pSQL($this->name));

        return $ret;
    }

    private function _setDefaultConfiguration($id_shop_group = null, $id_shop = null)
    {
        // Register hooks
        $this->registerHook('actionDispatcher');
        $this->registerHook('displayHeader');
        if (Tools::version_compare(_PS_VERSION_,'1.7','>')) {
            $this->registerHook('actionAjaxDieBefore');
        }
        elseif (Tools::version_compare(_PS_VERSION_,'1.6.0.12','>=')) {
            $this->registerHook('actionBeforeAjaxDie');
        }
        if (Tools::version_compare(_PS_VERSION_,'1.6','>')) {
            $hookHeaderId = Hook::getIdByName('Header');
            $this->updatePosition($hookHeaderId, 0, 1);
        }
        $this->registerHook('displayMobileHeader');
        $this->registerHook('displayBackOfficeHeader');
        $this->registerHook('actionCategoryAdd');
        $this->registerHook('actionCategoryUpdate');
        $this->registerHook('actionCategoryDelete');
        $this->registerHook('actionObjectCmsAddAfter');
        $this->registerHook('actionObjectCmsUpdateAfter');
        $this->registerHook('actionObjectCmsDeleteBefore');
        $this->registerHook('actionObjectStockAddAfter');
        $this->registerHook('actionObjectStockUpdateAfter');
        $this->registerHook('actionObjectStockDeleteBefore');
        $this->registerHook('actionObjectManufacturerAddAfter');
        $this->registerHook('actionObjectManufacturerUpdateAfter');
        $this->registerHook('actionObjectManufacturerDeleteBefore');
        $this->registerHook('actionObjectAddressAddAfter');
        $this->registerHook('actionObjectAddressUpdateAfter');
        $this->registerHook('actionObjectAddressDeleteBefore');
        $this->registerHook('actionAttributeSave');
        $this->registerHook('actionAttributeDelete');
        $this->registerHook('actionAttributeGroupDelete');
        $this->registerHook('actionAttributeGroupSave');
        $this->registerHook('actionFeatureSave');
        $this->registerHook('actionFeatureDelete');
        $this->registerHook('actionFeatureValueSave');
        $this->registerHook('actionFeatureValueDelete');
        $this->registerHook('actionProductAdd');
        $this->registerHook('actionProductSave');
        $this->registerHook('actionProductUpdate');
        $this->registerHook('actionObjectProductDeleteBefore');
        $this->registerHook('actionProductAttributeUpdate');
        $this->registerHook('actionProductAttributeDelete');
        $this->registerHook('actionUpdateQuantity');
        $this->registerHook('actionHtaccessCreate');
        $this->registerHook('actionAdminPerformanceControllerAfter');
        // New shop creation
        $this->registerHook('actionShopDataDuplication');
        // Add hook for specific prices
        $this->registerHook('actionObjectSpecificPriceAddAfter');
        $this->registerHook('actionObjectSpecificPriceUpdateAfter');
        $this->registerHook('actionObjectSpecificPriceDeleteBefore');
        // Hook called when images are changed
        $this->registerHook('actionObjectImageAddAfter');
        $this->registerHook('actionObjectImageUpdateAfter');
        $this->registerHook('actionObjectImageDeleteBefore');

        // Use backlink heuristic...
        Configuration::updateValue('pagecache_cms_u_bl', true, false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_cms_d_bl', true, false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_supplier_u_bl', true, false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_supplier_d_bl', true, false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_manufacturer_u_bl', true, false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_manufacturer_d_bl', true, false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_product_u_bl', true, false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_product_d_bl', true, false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_product_home_u_bl', true, false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_product_home_d_bl', true, false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_category_u_bl', true, false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_category_d_bl', true, false, $id_shop_group, $id_shop);

        // Default impacted modules
        Configuration::updateValue('pagecache_category_a_mods', 'blockcategories', false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_category_u_mods', 'blockcategories', false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_category_d_mods', 'blockcategories', false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_supplier_a_mods', 'blocksupplier', false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_supplier_u_mods', 'blocksupplier', false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_supplier_d_mods', 'blocksupplier', false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_manufacturer_a_mods', 'blockmanufacturer', false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_manufacturer_u_mods', 'blockmanufacturer', false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_manufacturer_d_mods', 'blockmanufacturer', false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_product_a_mods', 'blocknewproducts', false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_product_home_a_mods', 'homefeatured', false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_product_home_u_mods', 'homefeatured', false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_product_home_d_mods', 'homefeatured', false, $id_shop_group, $id_shop);
        Configuration::updateValue('pagecache_cms_a_mods', 'blockcms', false, $id_shop_group, $id_shop);

        // Enable cache on all managed_controllers and timeout = 3 days
        foreach (self::$managed_controllers as $controller) {
            Configuration::updateValue('pagecache_'.$controller, true, false, $id_shop_group, $id_shop);
            Configuration::updateValue('pagecache_'.$controller.'_timeout', 60 * 24 * 3, false, $id_shop_group, $id_shop);
        }

        // Set default dynamic hooks
        $pagecache_dyn_hooks = '';
        $module_list = Hook::getHookModuleExecList();
        foreach ($module_list as $hook_name => $modules) {
            foreach ($modules as $module) {
                if (in_array($hook_name, self::$default_dyn_hooks) && in_array($module['module'], self::$default_dyn_modules)) {
                    $pagecache_dyn_hooks .= $hook_name . '|' . $module['module'] . ',';
                }
                /** Special case: blockcart will be dynamic if ajax is disabled */
                elseif (in_array($hook_name, self::$default_dyn_hooks) && strcmp($module['module'], 'blockcart') == 0) {
                    if (!(int)(Configuration::get('PS_BLOCK_CART_AJAX'))) {
                        $pagecache_dyn_hooks .= $hook_name . '|' . $module['module'] . ',';
                    }
                }
            }
        }
        Configuration::updateValue('pagecache_dyn_hooks', $pagecache_dyn_hooks, false, $id_shop_group, $id_shop);

        // Set default javascript to execute (empty since autoconf)
        Configuration::updateValue('pagecache_cfgadvancedjs', '', false, $id_shop_group, $id_shop);

        // First install step is 0 (none)
        Configuration::updateValue('pagecache_install_step', 0, false, $id_shop_group, $id_shop);

        // Do not always display infos box by default
        Configuration::updateValue('pagecache_always_infosbox', false, false, $id_shop_group, $id_shop);

        // Not in production by default
        Configuration::updateValue('pagecache_debug', true, false, $id_shop_group, $id_shop);

        // Cache logged in users by default
        Configuration::updateValue('pagecache_skiplogged', false, false, $id_shop_group, $id_shop);

        // Normalize URLs by default
        Configuration::updateValue('pagecache_normalize_urls', true, false, $id_shop_group, $id_shop);

        // Disable logs by default
        Configuration::updateValue('pagecache_logs', false, false, $id_shop_group, $id_shop);

        // Auto detect mobile version
        Configuration::updateValue('pagecache_depend_on_device_auto', true, false, $id_shop_group, $id_shop);

        // Enable statistics by default
        Configuration::updateValue('pagecache_stats', true, false, $id_shop_group, $id_shop);

        // Enable standard cache system by default
        Configuration::updateValue('pagecache_typecache', 'std', false, $id_shop_group, $id_shop);

        // Default browser cache to 15 minutes
        foreach (self::$managed_controllers as $controller) {
            Configuration::updateValue('pagecache_'.$controller.'_expires', 15, false, $id_shop_group, $id_shop);
        }

        // Default ad tracking parameters
        Configuration::updateValue('pagecache_ignored_params', 'gclid,utm_campaign,utm_content,utm_medium,utm_source,utm_term,_openstat,cm_cat,cm_ite,cm_pla,cm_ven,owa_ad,owa_ad_type,owa_campaign,owa_medium,owa_source,pk_campaign,pk_kwd,WT.mc_t', false, $id_shop_group, $id_shop);

        // Generate CRON URL token
        if (!Configuration::get('pagecache_cron_token')) {
            Configuration::updateValue('pagecache_cron_token', self::generateRandomString(), false, $id_shop_group, $id_shop);
        }

        // Disable tokens on front
        Configuration::updateValue('PS_TOKEN_ENABLE', 0, false, $id_shop_group, $id_shop);
    }

    public function patchSmartyConfigFront() {
        if (Tools::version_compare(_PS_VERSION_,'1.7','>')) {
            // This modification has been accepted on github https://github.com/PrestaShop/PrestaShop/pull/8744
            $smartyFrontCongigFile = _PS_CONFIG_DIR_ . '/smartyfront.config.inc.php';
            $str = Tools::file_get_contents($smartyFrontCongigFile);
            if (strpos($str, "\$widget->renderWidget(null, \$params)") !== false) {
                file_put_contents($smartyFrontCongigFile . '.before_pagecache' , $str);
                $str = str_replace("\$widget->renderWidget(null, \$params)", "Hook::coreRenderWidget(\$widget, null, \$params)", $str);
                file_put_contents($smartyFrontCongigFile, $str);
            }
        }
    }

    public function getContent()
    {
        $installedModules = Module::getModulesInstalled(0);
        $instances = array();
        foreach ($installedModules as $module) {
            if ($tmp_instance = Module::getInstanceById($module['id_module'])) {
                $instances[$tmp_instance->id] = $tmp_instance;
            }
        }
        $trigered_events = array(
            'pagecache_cms_a' => array('title' => $this->l('On new CMS'), 'desc' => $this->l(''), 'bl' => false),
            'pagecache_cms_u' => array('title' => $this->l('On CMS update'), 'desc' => $this->l(''), 'bl' => true),
            'pagecache_cms_d' => array('title' => $this->l('On CMS deletion'), 'desc' => $this->l(''), 'bl' => true),
            'pagecache_supplier_a' => array('title' => $this->l('On new supplier'), 'desc' => $this->l(''), 'bl' => false),
            'pagecache_supplier_u' => array('title' => $this->l('On supplier update'), 'desc' => $this->l(''), 'bl' => true),
            'pagecache_supplier_d' => array('title' => $this->l('On supplier deletion'), 'desc' => $this->l(''), 'bl' => true),
            'pagecache_manufacturer_a' => array('title' => $this->l('On new manufacturer'), 'desc' => $this->l(''), 'bl' => false),
            'pagecache_manufacturer_u' => array('title' => $this->l('On manufacturer update'), 'desc' => $this->l(''), 'bl' => true),
            'pagecache_manufacturer_d' => array('title' => $this->l('On manufacturer deletion'), 'desc' => $this->l(''), 'bl' => true),
            'pagecache_product_a' => array('title' => $this->l('On new product'), 'desc' => $this->l(''), 'bl' => false),
            'pagecache_product_u' => array('title' => $this->l('On product update'), 'desc' => $this->l(''), 'bl' => true),
            'pagecache_product_d' => array('title' => $this->l('On product deletion'), 'desc' => $this->l(''), 'bl' => true),
            'pagecache_product_home_a' => array('title' => $this->l('On new home featured product'), 'desc' => $this->l(''), 'bl' => false),
            'pagecache_product_home_u' => array('title' => $this->l('On home featured product update'), 'desc' => $this->l(''), 'bl' => true),
            'pagecache_product_home_d' => array('title' => $this->l('On home featured product deletion'), 'desc' => $this->l(''), 'bl' => true),
            'pagecache_category_a' => array('title' => $this->l('On new category'), 'desc' => $this->l(''), 'bl' => false),
            'pagecache_category_u' => array('title' => $this->l('On category update'), 'desc' => $this->l(''), 'bl' => true),
            'pagecache_category_d' => array('title' => $this->l('On category deletion'), 'desc' => $this->l(''), 'bl' => true)
            );

        $msg_errors = array();
        $msg_warnings = array();
        $msg_success = array();
        $msg_infos = array();

        // To display advanced options add URL parameter "adv"
        $advanced_mode = Tools::getIsset("adv");
        if (strstr($_SERVER['REQUEST_URI'], '#') !== false) {
            $advanced_mode_url = str_replace('#', '&adv#', $_SERVER['REQUEST_URI']);
        }
        else {
            $advanced_mode_url = $_SERVER['REQUEST_URI'] . '&adv';
        }

        // If we try to update the settings
        if (Tools::isSubmit('submitModule'))
        {
            if (_PS_MODE_DEMO_ && !$this->context->employee->isSuperAdmin()) {
                $msg_errors[] = $this->l('In DEMO mode you cannot modify the Page Cache configuration.');
            } else {
                //
                // Update Pages and timeouts
                //
                if (Tools::getIsset('submitModuleTimeouts')) {
                    foreach (self::$managed_controllers as $controller) {
                        $timeoutValue = (int) Tools::getValue('pagecache_'.$controller.'_timeout', 3);
                        if ($timeoutValue === 8) {
                            $timeoutValue = 14;
                        }
                        if ($timeoutValue === 9) {
                            $timeoutValue = 30;
                        }
                        if ($timeoutValue === 0) {
                            Configuration::updateValue('pagecache_'.$controller, false);
                            Configuration::updateValue('pagecache_'.$controller.'_timeout', 0);
                            Configuration::updateValue('pagecache_'.$controller.'_expires', 0);
                        } else {
                            Configuration::updateValue('pagecache_'.$controller, true);
                            if ($timeoutValue === 10) {
                                Configuration::updateValue('pagecache_'.$controller.'_timeout', -1);
                            }
                            else {
                                Configuration::updateValue('pagecache_'.$controller.'_timeout', $timeoutValue * 1440);
                            }
                            Configuration::updateValue('pagecache_'.$controller.'_expires', max(0, min(60, Tools::getValue('pagecache_'.$controller.'_expires', 15))));
                        }
                    }
                    $msg_success[] = $this->l('Pages and timeouts have been updated');
                }
                //
                // Action: Clear cache
                //
                elseif (Tools::getIsset('submitModuleClearCache')) {
                    $this->clearCache();
                    $msg_success[] = $this->l('Cache has been deleted');
                }
                //
                // Install steps
                //
                elseif (Tools::getIsset('pagecache_install_step')) {
                    // Disable tokens if requested
                    if (strcmp(Tools::getValue('pagecache_disable_tokens', 'false'), 'true') == 0) {
                        Configuration::updateValue('PS_TOKEN_ENABLE', 0);
                        $msg_success[] = $this->l('Tokens have been disabled');
                    }
                    if (Tools::getIsset('pagecache_seller')) {
                        Configuration::updateValue('pagecache_seller', Tools::getValue('pagecache_seller', 'jpresta'));
                    }
                    $pagecache_disable_loggedin = (int) Tools::getValue('pagecache_disable_loggedin', 0);
                    if ($pagecache_disable_loggedin != 0) {
                        // Enable / Disable cache for logged in users
                        Configuration::updateValue('pagecache_skiplogged', $pagecache_disable_loggedin > 0 ? true : false);
                    } else {
                        // New install step
                        Configuration::updateValue('pagecache_install_step', Tools::getValue('pagecache_install_step', self::INSTALL_STEP_BUY_FROM));
                        if (Tools::getValue('pagecache_install_step', self::INSTALL_STEP_BUY_FROM) < self::LAST_INSTALL_STEP) {
                            // Stay or go in test mode
                            Configuration::updateValue('pagecache_debug', 1);
                        } else {
                            // Go in production mode
                            Configuration::updateValue('pagecache_debug', 0);
                        }
                    }
                    if (strcmp(Tools::getValue('pagecache_autoconf', 'false'), 'true') == 0) {
                        $this->autoconf($msg_infos, $msg_warnings, $msg_errors);
                    }
                }
                //
                // Update dynamics hooks
                //
                elseif (Tools::getIsset('submitModuleDynhooks')) {
                    $pagecache_dyn_hooks = '';
                    $pagecache_dyn_widgets = '';
                    if (Tools::getValue('pagecache_hooks') !== false) {
                        $hooks = Tools::getValue('pagecache_hooks');
                        if (is_array($hooks)) {
                            foreach ($hooks as $value) {
                                list($hook_name, $module_name) = explode('|', $value);
                                $empty_box = (int) Tools::getValue('pagecache_hooks_empty_'.$hook_name.'_'.$module_name, 0);
                                $pagecache_dyn_hooks .=  $hook_name.'|'.$module_name.'|'.$empty_box.',';
                            }
                        } else {
                            list($hook_name, $module_name) = explode('|', $hooks);
                            $empty_box = (int) Tools::getValue('pagecache_hooks_empty_'.$hook_name.'_'.$module_name, 0);
                            $pagecache_dyn_hooks .=  $hook_name.'|'.$module_name.'|'.$empty_box.',';
                        }
                    }
                    if (Tools::getValue('pagecache_dynwidgets') !== false) {
                        $widgets = Tools::getValue('pagecache_dynwidgets');
                        if (is_array($widgets)) {
                            foreach ($widgets as $value) {
                                list($widget_name, $hook_name) = explode('|', $value);
                                $pagecache_dyn_widgets .=  Tools::strtolower($widget_name).'|'.Tools::strtolower($hook_name).',';
                            }
                        } else {
                            list($widget_name, $hook_name) = explode('|', $widgets);
                            $pagecache_dyn_widgets .=  Tools::strtolower($widget_name).'|'.Tools::strtolower($hook_name).',';
                        }
                    }
                    Configuration::updateValue('pagecache_dyn_hooks', $pagecache_dyn_hooks);
                    Configuration::updateValue('pagecache_dyn_widgets', $pagecache_dyn_widgets);
                    Configuration::updateValue('pagecache_cfgadvancedjs', trim(Tools::getValue('cfgadvancedjs', '')));
                    $msg_success[] = $this->l('Dynamics hooks and javascript to execute have been updated');
                }
                //
                // Statistics
                //
                elseif (Tools::getIsset('submitModuleResetStats')) {
                    // Reset statistics
                    $this->clearCacheAndStats();
                    $msg_success[] = $this->l('Statistics have been reset and cache has been deleted');
                }
                elseif (Tools::getIsset('submitModuleOnOffStats')) {
                    // Enable / disable statistics
                    Configuration::updateValue('pagecache_stats', !Configuration::get('pagecache_stats'));
                }
                //
                // Caching system
                //
                elseif (Tools::getIsset('submitModuleTypeCache')) {
                    $type = Tools::getValue('pagecache_typecache', 'std');
                    if (strcmp('zip', $type) === 0) {
                        if (!class_exists('ZipArchive')) {
                            $msg_errors[] = $this->l('ZipArchive is not available on your hosting; it must run at least PHP 5 >= 5.2.0, PHP 7, PECL zip >= 1.1.0');
                        }
                        else {
                            Configuration::updateValue('pagecache_typecache', 'zip');
                            $msg_success[] = $this->l('Now using "Zip archives" caching system. Cache has been cleared.');
                        }
                    }
                    else {
                        Configuration::updateValue('pagecache_typecache', 'std');
                        $msg_success[] = $this->l('Now using "Standard file system" caching system. Cache has been cleared.');
                    }
                    $this->clearCache();
                }
                //
                // Cache management
                //
                elseif (Tools::getIsset('submitModuleCacheManagement')) {
                    foreach (array_keys($trigered_events) as $key) {
                        Configuration::updateValue($key.'_mods', Tools::getValue($key.'_mods', ''));
                        Configuration::updateValue($key.'_bl', Tools::getValue($key.'_bl', false));
                    }
                    $msg_success[] = $this->l('Configuration updated');
                }
                //
                // Options
                //
                else {
                    Configuration::updateValue('pagecache_always_infosbox', Tools::getValue('pagecache_always_infosbox', false));
                    Configuration::updateValue('pagecache_skiplogged', Tools::getValue('pagecache_skiplogged', false));
                    Configuration::updateValue('pagecache_logs', Tools::getValue('pagecache_logs', false));
                    Configuration::updateValue('pagecache_normalize_urls', Tools::getValue('pagecache_normalize_urls', false));
                    Configuration::updateValue('pagecache_depend_on_device_auto', Tools::getValue('pagecache_depend_on_device_auto', true));
                    $ignored_params_str = '';
                    $ignored_params = explode(',', Tools::getValue('pagecache_ignored_params', ''));
                    foreach ($ignored_params as $ignored_param) {
                        $p = Tools::strtolower(trim($ignored_param));
                        if (!empty($p)) {
                            if (!empty($ignored_params_str)) {
                                $ignored_params_str .= ',';
                            }
                            $ignored_params_str .= $p;
                        }
                    }
                    Configuration::updateValue('pagecache_ignored_params', $ignored_params_str);
                    $msg_success[] = $this->l('Configuration updated');
                }
            }
        } else {
            foreach (self::$managed_controllers as $controller) {
                if (!Configuration::hasKey('pagecache_'.$controller, null, Shop::getContextShopGroupID(true), Shop::getContextShopID(true))) Configuration::updateValue('pagecache_'.$controller, true);
                if (!Configuration::hasKey('pagecache_'.$controller.'_timeout', null, Shop::getContextShopGroupID(true), Shop::getContextShopID(true))) Configuration::updateValue('pagecache_'.$controller.'_timeout', 60 * 24 * 1);
            }
            if (!Configuration::hasKey('pagecache_show_stats', null, Shop::getContextShopGroupID(true), Shop::getContextShopID(true))) Configuration::updateValue('pagecache_show_stats', true);
        }

        // Check errors or compatiblity problem
        $installErrors = $this->getInstallationErrors();
        if (!empty($installErrors)) {
            $msg_errors = array_merge($msg_errors, $installErrors);
            // Back to install step 1 and test mode to resolve errors
            Configuration::updateValue('pagecache_debug', true);
            Configuration::updateValue('pagecache_install_step', self::INSTALL_STEP_INSTALL);
        } else {
            $cur_step = (int) Configuration::get('pagecache_install_step');
            if ($cur_step <= 1) {
                // Validate step 1 because there is no error
                Configuration::updateValue('pagecache_install_step', self::INSTALL_STEP_BACK_TO_TEST);
            }
        }

        // Some Prestashop settings advises
        $advices = $this->getAdvices();
        $msg_warnings = array_merge($msg_warnings, $advices);

        $diagnostic = $this->getDiagnostic();

        // Variable for smarty
        $infos = array();
        $infos['avec_bootstrap'] = Tools::version_compare(_PS_VERSION_,'1.6','>=');
        $infos['module_name'] = $this->name;
        $infos['module_displayName'] = $this->displayName;
        $infos['module_version'] = $this->version;
        $infos['pctab'] = Tools::getValue('pctab', 'install');
        $infos['advanced_mode'] = $advanced_mode;
        $infos['advanced_mode_url'] = $advanced_mode_url;
        $infos['diagnostic_count'] = (int)$diagnostic['count'];
        $infos['diagnostic'] = $diagnostic;
        $infos['cur_step'] = (int) Configuration::get('pagecache_install_step');
        $infos['shop_link_debug'] = $this->context->link->getPageLink('index', null, null, 'dbgpagecache=1');
        $infos['shop_link_debug'] = preg_replace('/index(\.php)?$/', '', $infos['shop_link_debug']);
        $infos['jpresta_proto'] = self::JPRESTA_PROTO;
        $infos['jpresta_domain'] = self::JPRESTA_DOMAIN;
        $infos['doc_proto'] = self::DOC_PROTO;
        $infos['doc_domain'] = self::DOC_DOMAIN;
        $infos['doc_url_fr'] = self::DOC_URL_FR;
        $infos['doc_url_en'] = self::DOC_URL_EN;
        $infos['contact_url'] = $this->getContactUrl();
        $infos['rating_url'] = $this->getRatingUrl();
        $infos['request_uri'] = self::getServerValue('REQUEST_URI');
        $infos['INSTALL_STEP_AUTOCONF'] = self::INSTALL_STEP_AUTOCONF;
        $infos['INSTALL_STEP_BACK_TO_TEST'] = self::INSTALL_STEP_BACK_TO_TEST;
        $infos['INSTALL_STEP_BUY_FROM'] = self::INSTALL_STEP_BUY_FROM;
        $infos['INSTALL_STEP_CART'] = self::INSTALL_STEP_CART;
        $infos['INSTALL_STEP_EU_COOKIE'] = self::INSTALL_STEP_EU_COOKIE;
        $infos['INSTALL_STEP_IN_ACTION'] = self::INSTALL_STEP_IN_ACTION;
        $infos['INSTALL_STEP_INSTALL'] = self::INSTALL_STEP_INSTALL;
        $infos['INSTALL_STEP_LOGGED_IN'] = self::INSTALL_STEP_LOGGED_IN;
        $infos['INSTALL_STEP_VALIDATE'] = self::INSTALL_STEP_VALIDATE;
        $infos['stats'] = PageCacheDAO::getAllStats(Shop::getContextListShopID());
        $infos['cron_urls'] = $this->getCronClearCacheURL();
        $infos['pagecache_debug'] = Configuration::get('pagecache_debug');
        $infos['pagecache_seller'] = Configuration::get('pagecache_seller');
        $infos['pagecache_skiplogged'] = Configuration::get('pagecache_skiplogged');
        $infos['pagecache_typecache'] = Configuration::get('pagecache_typecache');
        $infos['pagecache_ignored_params'] = Configuration::get('pagecache_ignored_params');
        $infos['pagecache_logs'] = Configuration::get('pagecache_logs');
        $infos['pagecache_depend_on_device_auto'] = Configuration::get('pagecache_depend_on_device_auto');
        $infos['pagecache_stats'] = Configuration::get('pagecache_stats');
        $infos['pagecache_normalize_urls'] = Configuration::get('pagecache_normalize_urls');
        $infos['pagecache_always_infosbox'] = Configuration::get('pagecache_always_infosbox');
        $infos['pagecache_cfgadvancedjs'] = Configuration::get('pagecache_cfgadvancedjs');

        foreach (self::$managed_controllers as $controller) {
            // Expires
            $infos['managed_controllers'][$controller]['expires'] = Configuration::get('pagecache_'.$controller.'_expires');

            // Timeout
            $timeoutValue = (int) Configuration::get('pagecache_'.$controller.'_timeout');
            if ($timeoutValue === 14*1440) {
                $timeoutValue = 8;
            }
            elseif ($timeoutValue === 30*1440) {
                $timeoutValue = 9;
            }
            elseif ($timeoutValue === -1) {
                $timeoutValue = 10;
            }
            else {
                $timeoutValue = $timeoutValue / 1440;
            }
            $infos['managed_controllers'][$controller]['timeout'] = $timeoutValue;

            // Title
            switch ($controller) {
                case 'index':
                    $infos['managed_controllers'][$controller]['title'] = $this->l('Home page');
                    break;
                case 'category':
                    $infos['managed_controllers'][$controller]['title'] = $this->l('Category page');
                    break;
                case 'product':
                    $infos['managed_controllers'][$controller]['title'] = $this->l('Product page');
                    break;
                case 'cms':
                    $infos['managed_controllers'][$controller]['title'] = $this->l('CMS page');
                    break;
                case 'newproducts':
                    $infos['managed_controllers'][$controller]['title'] = $this->l('New products page');
                    break;
                case 'bestsales':
                    $infos['managed_controllers'][$controller]['title'] = $this->l('Best sales page');
                    break;
                case 'supplier':
                    $infos['managed_controllers'][$controller]['title'] = $this->l('Suppliers page');
                    break;
                case 'manufacturer':
                    $infos['managed_controllers'][$controller]['title'] = $this->l('Manufacturers page');
                    break;
                case 'contact':
                    $infos['managed_controllers'][$controller]['title'] = $this->l('Contact form page');
                    break;
                case 'pricesdrop':
                    $infos['managed_controllers'][$controller]['title'] = $this->l('Prices drop page');
                    break;
                case 'sitemap':
                    $infos['managed_controllers'][$controller]['title'] = $this->l('Sitemap page');
                    break;
                default:
                    $infos['managed_controllers'][$controller]['title'] = $this->l('Page for controller ' + $controller);
                    break;
            }
        }
        $this->prepareDatasForSpeedAnalyse($infos);

        $infos['widgets'] = array();
        $allModules = Module::getModulesInstalled();
        foreach ($allModules as $module) {
            $moduleInstance = Module::getInstanceById($module['id_module']);
            if ($moduleInstance instanceof PrestaShop\PrestaShop\Core\Module\WidgetInterface) {
                $infos['widgets'][$moduleInstance->name] = $moduleInstance->displayName;
            }
        }
        $infos['dynamic_widgets'] = self::getDynamicWidgets();
        $infos['module_list'] = Hook::getHookModuleExecList();
        $standardHooks = array(
            'displaytopcolumn', 'displaytop', 'displayrightcolumnproduct', 'displayrightcolumn', 'displayproducttabcontent', 'displayproducttab', 'displayproductbuttons',
            'displaynav', 'displayleftcolumnproduct', 'displayleftcolumn', 'displayhometabcontent', 'displayhometab', 'displayhome', 'displayfooterproduct',
            'displayfooter', 'displayfooterbefore', 'displaybanner', 'actionproductoutofstock', 'displayreassurance', 'displayafterbodyopeningtag', 'displaynav1',
            'displaynav2', 'displayproductbuttons', 'displaysearch'
        );
        $infos['standard_hooks'] = array_flip($standardHooks);
        $infos['dynamic_hooks'] = self::getDynamicHooks();
        foreach ($infos['module_list'] as $hook_name => &$modules) {
            $modules['is_standard'] = false;
            if (array_key_exists($hook_name, $infos['standard_hooks'])) {
                $modules['is_standard'] = true;
            }
            foreach ($modules as &$module) {
                if (strcmp($this->name, $module['module']) != 0 && is_array($module)) {
                    $module['dyn_is_checked'] = false;
                    $module['empty_option_checked'] = false;
                    if (isset($infos['dynamic_hooks'][$hook_name]) && isset($infos['dynamic_hooks'][$hook_name][$module['module']])) {
                        $module['dyn_is_checked'] = true;
                        if ($infos['dynamic_hooks'][$hook_name][$module['module']]['empty_box']) {
                            $module['empty_option_checked'] = true;
                        }
                    }
                    if (isset($instances[$module['id_module']])) {
                        $module['module_description'] = $instances[$module['id_module']]->description;
                        $module['module_display_name'] = $instances[$module['id_module']]->displayName;
                    }
                    else {
                        $module['module_description'] = ' ';
                        $module['module_display_name'] = $module['module'];
                    }
                }
            }
        }
        $infos['msg_success'] = $msg_success;
        $infos['msg_infos'] = $msg_infos;
        $infos['msg_warnings'] = $msg_warnings;
        $infos['msg_errors'] = $msg_errors;

        $this->context->smarty->assign($infos);
        return $this->context->smarty->fetch(_PS_MODULE_DIR_.basename(__FILE__, '.php').'/views/templates/admin/get-content.tpl');
    }


    public function hookDisplayBackOfficeHeader() {
        // Should be restricted to PageCache module
		if (method_exists($this->context->controller, 'addJQuery')) {
            $this->context->controller->addJquery();
            $this->context->controller->addJS($this->_path.'views/js/countUp.js');
            $this->context->controller->addJS($this->_path.'views/js/bootstrap-slider.js');
            $this->context->controller->addCSS($this->_path.'views/css/bootstrap-slider.min.css');
        }
    }

    public function hookDisplayHeader() {
        if (self::canBeCached() || self::isDisplayStats()) {
            // A bug in PS 1.6.0.6 insert jquery multiple times in CCC mode
            $already_inserted = false;
            $already_inserted_cooki = false;
            $already_inserted_cookie = false;
            foreach ($this->context->controller->js_files as $js_uri)
            {
                $already_inserted = $already_inserted || (strstr($js_uri, 'jquery-') !== false) || (strstr($js_uri, 'jquery.js') !== false);
                $already_inserted_cooki = $already_inserted_cooki || (strstr($js_uri, 'cooki-plugin') !== false);
                $already_inserted_cookie = $already_inserted_cookie || (strstr($js_uri, 'cookie-plugin') !== false);
            }
            if (!$already_inserted) {
                $this->context->controller->addJquery();
            }
            if (!$already_inserted_cooki) {
                $this->context->controller->addJqueryPlugin('cooki-plugin');
            }
            if (!$already_inserted_cookie) {
                $this->context->controller->addJqueryPlugin('cookie-plugin');
            }

            $this->context->controller->addJS($this->_path.'views/js/pagecache.js');
            if (self::isDisplayStats()) {
                $this->context->controller->addCSS($this->_path.'views/css/pagecache.css');
            }

            if (Tools::version_compare(_PS_VERSION_,'1.6','<=')) {
                // Make sure pagecache will be the first javascript to be loaded. This avoid
                // other javascript errors to block pagecache treatments. So we place it just after
                // jquery.
                $new_js_files = array();
                $pagecache_js_file = null;
                $jquery_js_files = array();
                foreach ($this->context->controller->js_files as $js_file) {
                    if (strstr($js_file, '/js/jquery/') !== false || strstr($js_file, 'jquery.js') !== false) {
                        $jquery_js_files[] = $js_file;
                    }
                    elseif (empty($pagecache_js_file) && strstr($js_file, 'pagecache.js') !== false) {
                        $pagecache_js_file = $js_file;
                    } else {
                        $new_js_files[] = $js_file;
                    }
                }
                if (!empty($pagecache_js_file)) {
                    array_unshift($new_js_files, $pagecache_js_file);
                }
                $jquery_js_files = array_reverse($jquery_js_files);
                foreach ($jquery_js_files as $jquery_js_file) {
                    array_unshift($new_js_files, $jquery_js_file);
                }
                $this->context->controller->js_files = $new_js_files;
            }


            // There is no escape method available to allow to display javascript code
            // so we cannot use a template
            $js = trim(Configuration::get('pagecache_cfgadvancedjs'));
            $dynJs = '<script type="text/javascript">
pcRunDynamicModulesJs = function() {
'; // Let the new line here!
            if (!empty($js)) {
                $dynJs .= $js;
            }
            $dynJs .= '
};</script>'; // Let the new line here!

            return $dynJs . $this->display(__FILE__, 'pagecache.tpl');
        }
        elseif (Configuration::get('pagecache_skiplogged') && Context::getContext()->customer->isLogged()) {
            // User want to disable cache for logged in users so we add a random URL parameter
            // to all links to disable previous cache done by browser
            return $this->display(__FILE__, 'pagecache-disablecache.tpl');
        } else {
            return '';
        }
    }

    public function hookdisplayMobileHeader() {
        $this->hookDisplayHeader();
    }

    public function hookActionShopDataDuplication($params) {
        //(int)$params['new_id_shop']
        //(int)$params['old_id_shop']
        $new_id_shop = (int)$params['new_id_shop'];
        $this->_setDefaultConfiguration(Shop::getGroupFromShop($new_id_shop), $new_id_shop);
    }

    public function hookActionDispatcher() {
        if (self::canBeCached())
        {
            // Remove cookie, cart and customer informations to cache
            // a 'standard' page

            // Write cookie if needed (language changed, etc.) before we remove it
            $this->context->cookie->write();

            $new_cookie = new Cookie('pc'.rand(), '', 1);
            $new_cookie->id_lang = $this->context->language->id;
            if (!isset($this->context->cookie->detect_language)) {
                unset($new_cookie->detect_language);
            }
            $new_cookie->id_currency = $this->context->cookie->id_currency;
            $new_cookie->no_mobile = $this->context->cookie->no_mobile;
            if (isset($this->context->cookie->iso_code_country)) {
                $new_cookie->iso_code_country = $this->context->cookie->iso_code_country;
            }
            // For autolanguagecurrency module
            if (isset($this->context->cookie->autolocation)) {
                $new_cookie->autolocation = $this->context->cookie->autolocation;
                $new_cookie->id_currency_by_location = $this->context->cookie->id_currency_by_location;
                $new_cookie->id_language_by_location = $this->context->cookie->id_language_by_location;
            }
            // For stthemeeditor module
            if (isset($this->context->cookie->st_category_columns_nbr)) {
                $new_cookie->st_category_columns_nbr = $this->context->cookie->st_category_columns_nbr;
            }

            if (isset($this->context->customer)) {
                $id_customer = (int)$this->context->customer->id;
                $new_cookie->pc_groups = implode(',', Customer::getGroupsStatic($id_customer));
                if ($id_customer === 0) {
                    $new_cookie->pc_group_default = (int)Configuration::get('PS_UNIDENTIFIED_GROUP');
                }
                else {
                    $new_cookie->pc_group_default = Customer::getDefaultGroupId($id_customer);
                }
                $new_cookie->pc_is_logged = $this->context->customer->isLogged();
                $new_cookie->pc_is_logged_guest = $this->context->customer->isLogged(true);
            }

            $country = self::getCountry($this->context);
            if ($country) {
                $this->context->country = $country;
                // Save it for pagecache so cache key can be the same before and after
                $new_cookie->pc_id_country = $country->id;
            }

            $this->context->cookie = $new_cookie;
            $this->context->cart = new Cart();
            $this->context->customer = new Customer();
            // Needed because some modules do Validate the id (Validate::isUnsignedId($id_customer))
            $this->context->customer->id = 0;
            // Needed for product specific price calculation
            if (isset($new_cookie->pc_group_default)) {
                $this->context->customer->id_default_group = (int) $new_cookie->pc_group_default;
            } else {
                $this->context->customer->id_default_group = (int) Configuration::get('PS_CUSTOMER_GROUP');
            }
        }
        elseif (self::isDisplayStats()) {
            // Also needed to display stats when cache is disabled (dbgpagecache=0)
            // Save it for pagecache so cache key can be the same before and after
            $country = self::getCountry($this->context);
            if ($country) {
                $this->context->cookie->pc_id_country = $country->id;
            }
        }
    }

    public function hookActionAjaxDieBefore($params) {
        if ($this->canBeCached()) {
            $this->cacheThis($params['value']);
        }
    }

    public function hookActionBeforeAjaxDie($params) {
        return $this->hookActionAjaxDieBefore($params);
    }

    public static function getDynamicHooks() {
        $hooksModules = array();
        $dyn_hooks = Configuration::get('pagecache_dyn_hooks', '');
        $hooks_modules = explode(',', $dyn_hooks);
        foreach ($hooks_modules as $hook_module) {
            if (!empty($hook_module))
            {
                list($hook, $module, $empty_box) = array_pad(explode('|', $hook_module), 3, 0);
                if (!isset($hooksModules[$hook])) {
                    $hooksModules[$hook] = array();
                }
                $hooksModules[$hook][$module] = array('empty_box' => $empty_box);
            }
        }
        return $hooksModules;
    }

    public static function getDynamicWidgets() {
        $dynWidgets = array();
        $dyn_widgets_cfg = Configuration::get('pagecache_dyn_widgets', '');
        $dyn_widgets = explode(',', $dyn_widgets_cfg);
        foreach ($dyn_widgets as $dyn_widget) {
            if (!empty($dyn_widget))
            {
                list($widget_name, $hook_name) = array_pad(explode('|', $dyn_widget), 2, 0);
                $widgetinstance = Module::getInstanceByName($widget_name);
                $dynWidgets[] = array('displayName' => $widgetinstance->displayName, 'name' => $widget_name, 'hook' => $hook_name);
            }
        }
        return $dynWidgets;
    }

    public static function isDynamicHooks($hook_name, $module) {
        $dyn_hooks = Configuration::get('pagecache_dyn_hooks', '');
        return strstr($dyn_hooks, Tools::strtolower($hook_name) . '|' . $module) !== false;
    }

    public static function getDynamicHookInfos($hook_name, $module) {
        if (!self::canBeCached()) {
            return false;
        }
        $dyn_hooks = Configuration::get('pagecache_dyn_hooks', '');
        $dyn_hook_part = strstr($dyn_hooks, Tools::strtolower($hook_name) . '|' . $module);
        if ($dyn_hook_part !== false) {
            $comma_pos = strpos($dyn_hook_part, ',');
            if ($comma_pos !== false) {
                $dyn_hook_part =  Tools::substr($dyn_hook_part, 0, $comma_pos);
            }
            $dyn_hook_part_array = array_pad(explode('|', $dyn_hook_part), 3, 0);
            $dyn_hook_part = array('empty_box' => $dyn_hook_part_array[2]);
        }
        return $dyn_hook_part;
    }

    public static function getHookCacheDirectives($module, $method) {
        $directives = array('wrapper' => false, 'content' => true);

        // Remove 'hook' prefix
        $hook_name = Tools::substr($method, 4);

        $infos = self::getDynamicHookInfos($hook_name, $module->name);
        if ($infos !== false) {
            $directives['wrapper'] = true;
            $directives['content'] = !$infos['empty_box'];
        }
        return $directives;
    }

    public static function getDynamicWidgetInfos($module_name, $hook_name) {
        if (!self::canBeCached()) {
            return false;
        }
        $dyn_widgets = Configuration::get('pagecache_dyn_widgets', '');
        $dyn_widget_part = strstr($dyn_widgets, Tools::strtolower($module_name) . '|' . Tools::strtolower($hook_name));
        if ($dyn_widget_part === false) {
            $dyn_widget_part = strstr($dyn_widgets, Tools::strtolower($module_name) . '|,');
        }
        if ($dyn_widget_part !== false) {
            $comma_pos = strpos($dyn_widget_part, ',');
            if ($comma_pos !== false) {
                $dyn_widget_part = Tools::substr($dyn_widget_part, 0, $comma_pos);
            }
            $dyn_widget_part_array = array_pad(explode('|', $dyn_widget_part), 3, 0);
            $dyn_widget_part = array('empty_box' => $dyn_widget_part_array[2]);
        }
        return $dyn_widget_part;
    }

    public static function getWidgetCacheDirectives($module, $hook_name) {
        $directives = array('wrapper' => false, 'content' => true);
        $infos = self::getDynamicWidgetInfos($module->name, $hook_name);
        if ($infos !== false) {
            $directives['wrapper'] = true;
            $directives['content'] = !$infos['empty_box'];
        }
        return $directives;
    }

    public static function canBeCached() {
        // static variable avoid computing the canBeCached multiple times
        static $canBeCached = null;
        if ($canBeCached == null) {
            if (Tools::getIsset('ajax') || Tools::getValue('fc') == 'module') {
                $canBeCached = false;
            }
            else {
                if (!Configuration::get('pagecache_debug') && !Configuration::get('pagecache_always_infosbox') && (Tools::getIsset('dbgpagecache') || Tools::getIsset('delpagecache'))) {
                    // Remove module's parameters in production mode to avoid them to be referenced in search engines
                    $url = self::getCurrentURL();
                    $url = preg_replace('/&?dbgpagecache=[0-1]?/', '', $url);
                    $url = preg_replace('/&?delpagecache=[0-1]?/', '', $url);
                    $url = str_replace('?&', '?', $url);
                    $url = preg_replace('/\?$/', '', $url);
                    header('Status: 301 Moved Permanently', false, 301);
                    Tools::redirect($url);
                }
                $controller = Dispatcher::getInstance()->getController();
                $canBeCached = strcmp(self::getServerValue('REQUEST_METHOD'), 'GET') == 0
                    && (Configuration::get('pagecache_'.$controller))
                    && !self::isGoingToBeRedirected()
                    && !self::isCustomizedProduct($controller)
                    && (!Configuration::get('pagecache_debug') || ((int)Tools::getValue('dbgpagecache', 0) == 1))
                    && ((int)(Configuration::get('PS_TOKEN_ENABLE')) != 1)
                    && self::isOverridesEnabled()
                    // Following are exceptions for logout action
                    && Tools::getValue('logout') === false && Tools::getValue('mylogout') === false
                    && (!Configuration::get('pagecache_skiplogged') || !Context::getContext()->customer->isLogged())
                ;
            }
        }
        return $canBeCached;
    }

    /**
     * Customization is not a module and therefore cannot be refreshed. The workaround is to disable
     * cache for these products
     * @param string $controller Controller name
     * @return boolean true if current page is a customized product
     */
    private static function isCustomizedProduct($controller) {
        if (strcmp($controller, 'product') != 0 || !Customization::isFeatureActive()) {
            return false;
        }
        if ($id_product = (int)Tools::getValue('id_product')) {
            $result = Db::getInstance()->executeS('
                SELECT `id_customization_field`, `type`, `required`
                FROM `'._DB_PREFIX_.'customization_field`
                WHERE `id_product` = '.(int)$id_product);
            return count($result) > 0;
        }
        return false;
    }

    /**
     * Do not cache if status code is not 200
     * @return boolean true if user will be redirected to an other page or if statuts is not 200
     */
    private static function isGoingToBeRedirected() {
        return self::isNotCode200() || self::isSSLRedirected() || self::isMaintenanceEnabled() || self::isRestrictedCountry();
    }

    private static function isNotCode200() {
        if (function_exists('http_response_code') && !defined('HHVM_VERSION')) {
            $code = http_response_code();
            if (!empty($code)) {
                if (http_response_code() !== 200) {
                    return true;
                }
            }
        }
        return false;
    }

    private static function isSSLRedirected() {
        return (Configuration::get('PS_SSL_ENABLED') && self::getServerValue('REQUEST_METHOD') != 'POST' && Configuration::get('PS_SSL_ENABLED_EVERYWHERE') && !Tools::usingSecureMode());
    }

    private static function isMaintenanceEnabled() {
        if (!(int)Configuration::get('PS_SHOP_ENABLE')) {
            if (!in_array(Tools::getRemoteAddr(), explode(',', Configuration::get('PS_MAINTENANCE_IP')))) {
                return true;
            }
        }
        return false;
    }

    private static function isRestrictedCountry() {
        $controller_instance = self::getControllerInstance();
        return $controller_instance->isRestrictedCountry();
    }

    private static function isOverridesEnabled() {
        return Tools::version_compare(_PS_VERSION_,'1.6','<') || ((int)(Configuration::get('PS_DISABLE_OVERRIDES')) != 1);
    }

    /**
     * return filepath to the cache if it is available, false otherwise
     */
    public static function displayCacheIfExists() {
        $cache = false;
        $can_be_cached = self::canBeCached();
        if ($can_be_cached) {
            // Before checking cache, lets check cache reffreshment triggers (specific prices)
            PageCacheDAO::triggerReffreshment();

            $controller = Dispatcher::getInstance()->getController();
            $cache_ttl = 60 * ((int)Configuration::get('pagecache_'.$controller.'_timeout'));
            $cache_key = self::getCacheKey();
            $cache_key = $cache_key[0];

            if (Tools::getIsset('delpagecache')) {
                self::getCache()->delete($cache_key);
            }

            $cache = self::getCache()->get($cache_key, $cache_ttl);
            if ($cache !== false && Configuration::get('pagecache_stats')) {
                PageCacheDAO::incrementCountHit($cache_key);
            }

            // Store cache used in a readable cookie (0=no cache; 1=server cache; 2=browser cache)
            if (self::isDisplayStats()) {
                $cache_type = 0; // no cache available
                if ($cache !== false) {
                    // Server cache
                    $cache_type = 1;
                }
                if (PHP_VERSION_ID <= 50200) /* PHP version > 5.2.0 */
                    setcookie('pc_type_' . $cache_key, $cache_type, time()+60*60*1, '/', null, 0);
                else
                    setcookie('pc_type_' . $cache_key, $cache_type, time()+60*60*1, '/', null, 0, false);
            }

            // Display the cached HTML if any
            if ($cache !== false) {
                // ULTIMATE
                $offset = 60 * Configuration::get('pagecache_'.$controller.'_expires', 0);
                if ($offset > 0) {
                    if (headers_sent()) {
                        Logger::addLog("PageCache | Cannot use browser cache because headers have already been sent", 3);
                    }
                    elseif (!PageCacheDAO::hasTriggerIn2H()) {
                        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $offset) . ' GMT');
                        header('Cache-Control: max-age='.$offset.', private');
                        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
                    }
                }
                // ULTIMATE£

                echo $cache;
                return true;
            }
            return $cache;
        }
        elseif (self::isDisplayStats()) {
            // Cache disabled
            $cache_key = self::getCacheKey();
            $cache_key = $cache_key[0];
            if (PHP_VERSION_ID <= 50200) /* PHP version > 5.2.0 */
                setcookie('pc_type_' . $cache_key, 3, time()+60*60*1, '/', null, 0);
            else
                setcookie('pc_type_' . $cache_key, 3, time()+60*60*1, '/', null, 0, false);
        }
        if (Configuration::get('pagecache_logs') > 1) {
            // Log debug
            $controller = Dispatcher::getInstance()->getController();
            $is_ajax = Tools::getIsset('ajax') ? 'true' : 'false';
            $is_get = strcmp(self::getServerValue('REQUEST_METHOD'), 'GET') == 0 ? 'true' : 'false';
            $ctrl_enabled = Configuration::get('pagecache_'.$controller) ? 'true' : 'false';
            $is_debug = Configuration::get('pagecache_debug') ? 'true' : 'false';
            $token_ok = (int)(Configuration::get('PS_TOKEN_ENABLE')) != 1 ? 'true' : 'false';
            $is_logout = Tools::getValue('logout') === false && Tools::getValue('mylogout') === false ? 'false' : 'true';
            $can_be_cached = $can_be_cached ? 'true' : 'false';
            $cache_ttl = 60 * ((int)Configuration::get('pagecache_'.$controller.'_timeout'));
            $cache_key = self::getCacheKey();
            $cache_key = $cache_key[1];
            $exists = '';
            $date_infos = '';
            Logger::addLog("PageCache | cache | !is_ajax($is_ajax) && is_get($is_get) && ctrl_enabled($ctrl_enabled) ".
                "&& !is_debug($is_debug) && token_ok($token_ok) && !is_logout($is_logout) = $can_be_cached ".
                "controller=$controller cache_ttl=$cache_ttl cache_key=$cache_key exists=$exists $date_infos", 1, null, null, null, true);
        }
        return $cache;
    }

    /**
     * Generates a key for the cache depending on URL, currency, user group, country, etc.
     * Return array[0]=hashed key array[1]=displayable key
     */
    public static function getCacheKey($url = null) {
        if (empty ( $url )) {
            $url = self::getCurrentURL ();
        }

        // Normalize the URL
        $normalized_url = self::normalizeUrl($url);

        // Remove HTML anchor
        $anchorPos = strpos($normalized_url, '#');
        if ($anchorPos !== FALSE) {
            $normalized_url = Tools::substr($normalized_url, 0, $anchorPos);
        }

        // Add some parameters to set currency or mobile version status
        $context = Context::getContext();
        $param_to_add = '&pc_cur=' . self::getCurrencyId($context);
        $param_to_add .= '&pc_groups=' . implode(',', self::getGroupsIds($context));
        $country = self::getCountry($context);
        if ($country) {
            $param_to_add .= '&pc_ctry=' . $country->iso_code . '-' . $country->id;
        }
        $country2 = self::getCountry2($context, $country);
        if ($country2) {
            $param_to_add .= '&pc_ctry2=' . $country2->iso_code . '-' . $country2->id;
        }
        if (self::isDependsOnDevice()) {
            if ($context->getMobileDevice() == true) {
                $param_to_add .= '&pc_mob=1';
            }
            if (method_exists($context, 'getDevice')) {
                $param_to_add .= '&pc_dev=' . $context->getDevice();
            }
        }

        // Check if shop is enable
        if (!(int)Configuration::get('PS_SHOP_ENABLE')) {
            $param_to_add .= '&pc_off=1';
        }

        // Strip ignored parameters (tracking data that do not change page content)
        // and sort them
        $ignored_params = explode ( ',', Configuration::get ( 'pagecache_ignored_params' ) );
        $ignored_params[] = 'delpagecache';
        $ignored_params[] = 'dbgpagecache';
        $ignored_params[] = 'cfgpagecache';
        $query_string = parse_url ( $normalized_url, PHP_URL_QUERY );
        $new_query_string = self::filterAndSortParams($query_string, $ignored_params);
        if ($new_query_string === '') {
            // Remove first '&'
            $new_query_string .= Tools::substr($param_to_add, 1);
        }
        else {
            $new_query_string .= $param_to_add;
        }
        $uri = http_build_url($normalized_url, array("query" => $new_query_string));

        return array(md5($uri), $uri);
    }

    private static function normalizeUrl($url) {
        $normalized_url = html_entity_decode($url);
        $un = new PageCacheURLNormalizer();
        $un->setUrl($normalized_url);
        $normalized_url = $un->normalize();
        return $normalized_url;
    }

    /**
     * Executes Hook::exec with correct hook name (for retro compatibility)
     * Only used in PS 1.7+
     * @param integer $id_module
     * @param string $hook_name
     * @param array $hook_args
     * @return string
     */
    public static function execHook($method, $hook_args = array(), $id_module) {
        $module = Module::getInstanceById($id_module);
        if ($module) {
            $hook_name = str_replace('hook', '', $method);
            if ($method === 'pcwidget') {
                return $module->renderWidget(null, $hook_args);
            }
            else {
                return Hook::exec($hook_name, $hook_args, $id_module);
            }
        }
        return '';
    }

    public static function getJsDef() {
        if (Tools::version_compare(_PS_VERSION_,'1.6','>')) {
            $context = Context::getContext();
            Media::addJsDef(array(
                'isLogged' => (bool)$context->customer->isLogged(),
                'isGuest' => (bool)$context->customer->isGuest(),
                'comparedProductsIds' => $context->smarty->getTemplateVars('compared_products'),
            ));
            $defs = Media::getJsDef();
            $defs['prestashop_pc'] = $defs['prestashop'];
            unset($defs['prestashop']);
            unset($defs['baseDir']);
            unset($defs['baseUrl']);
            return $defs;
        }
        return array();
    }

    public static function getCurrencyId($context) {
        $id_currency = -1;
        if (!isset($context->cookie->id_currency)) {
            $id_currency = (int)Configuration::get('PS_CURRENCY_DEFAULT');
        } else {
            $id_currency = $context->cookie->id_currency;
        }
        return $id_currency;
    }

    public static function getGroupsIds($context) {
        if (isset($context->cookie->pc_groups)) {
            // Use cookie set in dispatcher hook
            $groupsIds = explode(',', $context->cookie->pc_groups);
        }
        elseif (isset($context->customer)) {
            // Compute groups IDs like in dispatcher hook
            $groupsIds = Customer::getGroupsStatic((int)$context->customer->id);
        } else {
            $groupsIds = Customer::getGroupsStatic(0);
        }
        return $groupsIds;
    }

    public static function getCountry($context) {
        // static variable avoid computing the country multiple times
        static $current_country = null;
        if ($current_country == null) {
            $current_country = false;
            if (isset($context->cookie->pc_id_country)) {
                // We already computed the country
                $current_country = new Country($context->cookie->pc_id_country, $context->language->id);
            }
            elseif (isset($context->cart)) {
                if ($context->cart->{Configuration::get('PS_TAX_ADDRESS_TYPE')}) {
                    $infos = Address::getCountryAndState((int)($context->cart->{Configuration::get('PS_TAX_ADDRESS_TYPE')}));
                    $current_country = new Country((int)$infos['id_country'], $context->language->id);
                }
            }
            elseif ($context->cookie->id_customer) {
                $id_address = (int)(Address::getFirstCustomerAddressId($context->cookie->id_customer));
                if ($id_address) {
                    $infos = Address::getCountryAndState($id_address);
                    $current_country = new Country((int)$infos['id_country'], $context->language->id);
                }
            }
            elseif (Configuration::get('PS_GEOLOCATION_ENABLED')) {
                // Detect country now to get it right
                $controller_instance = self::getControllerInstance();
                if ($controller_instance !== false && method_exists($controller_instance, 'geolocationManagementPublic')) {
                    if (($newDefault = $controller_instance->geolocationManagementPublic($context->country)) && Validate::isLoadedObject($newDefault)) {
                        $context->country = $newDefault;
                    }
                    if (isset($context->country)) {
                        $current_country = $context->country;
                    }
                }
            }
        }
        return $current_country;
    }

    /**
     * Country 2 is used for specific prices and can be used for tax calculation so
     * we need to put it in the cache key
     * @param unknown $context
     * @param unknown $country1
     * @return Country or false
     */
    public static function getCountry2($context, $country1) {
        // static variable avoid computing the country2 multiple times
        static $current_country_2 = null;
        if ($current_country_2 == null) {
            $current_country_2 = false;
            if (method_exists('Tools', 'getCountry')) {
                $country2_id = Tools::getCountry();
                if ($country2_id) {
                    if (!$country1 || $country1->id != $country2_id) {
                        $current_country_2 = new Country((int)$country2_id, $context->language->id);
                    }
                }
            }
        }
        return $current_country_2;
    }

    private static function isDependsOnDevice() {
        static $depends_on_devices = null;
        if ($depends_on_devices == null) {
            if (Configuration::get("pagecache_depend_on_device_auto")) {
                // Check if some modules are restricted on some devices
                $count = (int) Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('SELECT COUNT(DISTINCT enable_device) FROM '._DB_PREFIX_.'module_shop');
                $depends_on_devices = (int)Configuration::get('PS_ALLOW_MOBILE_DEVICE') != 0 || $count > 1;
            }
            else {
                $depends_on_devices = false;
            }
        }
        return $depends_on_devices;
    }

    private static function getControllerInstance() {
        // static variable avoid computing the controller multiple times
        static $controller = null;
        if ($controller == null) {
            $controller = false;
            // Load controllers classes
            $controllers = Dispatcher::getControllers(array(_PS_FRONT_CONTROLLER_DIR_, _PS_OVERRIDE_DIR_.'controllers/front/'));
            $controllers['index'] = 'IndexController';
            // Get controller name
            $controller_name = Dispatcher::getInstance()->getController();
            if (isset($controllers[Tools::strtolower($controller_name)])) {
                // Create controller instance
                $controller_class = $controllers[Tools::strtolower($controller_name)];
                $context = Context::getContext();
                if ($context->controller) {
                    $controller = $context->controller;
                } else {
                    $controller = Controller::getController($controller_class);
                }
            }
        }
        return $controller;
    }

    public static function getCurrentURL() {
        $pageURL = 'http';
        $https = self::getServerValue('HTTPS');
        if (!empty($https) && $https !== 'off' || self::getServerValue('SERVER_PORT') == 443) {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if (self::getServerValue("SERVER_PORT") != "80") {
            $pageURL .= self::getServerValue("SERVER_NAME") . ":" . self::getServerValue("SERVER_PORT") . self::getServerValue("REQUEST_URI");
        } else {
            $pageURL .= self::getServerValue("SERVER_NAME") . self::getServerValue("REQUEST_URI");
        }
        return $pageURL;
    }

    public static function filterAndSortParams($query_string, $ignored_params) {
        $new_query_string = '';
        $keyvalues = explode('&', $query_string);
        sort($keyvalues);
        foreach ($keyvalues as $keyvalue) {
            if ($keyvalue !== '') {
                $key = '';
                $value = '';
                $current_key_value = explode('=', $keyvalue);
                if (count($current_key_value) > 0) {
                    $key = $current_key_value[0];
                }
                if (count($current_key_value) > 1) {
                    $value = $current_key_value[1];
                }
                if (!in_array($key, $ignored_params)) {
                    $new_query_string .= '&' . $key . '=' . $value;
                }
            }
        }
        if ($new_query_string !== '') {
            $new_query_string = Tools::substr($new_query_string, 1);
        }
        return $new_query_string;
    }

    public static function generateRandomString($length = 16) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; // length:36
        $final_rand = '';
        for($i = 0; $i < $length; $i ++) {
            $final_rand .= $chars [rand ( 0, Tools::strlen ( $chars ) - 1 )];
        }
        return $final_rand;
    }

    public function getCronClearCacheURL() {
        $urls = '';
        foreach (Shop::getContextListShopID() as $id_shop) {
            $shop_url = new ShopUrl($id_shop);
            $url = $shop_url->getURL();
            if (Tools::strlen($url) > 0) {
                $urls .= $shop_url->getURL() . '?fc=module&amp;module='.$this->name.'&amp;controller=clearcache&amp;token=' . Configuration::get('pagecache_cron_token');
            }
        }
        return $urls;
    }

    public static function cacheThis($html) {

        if (self::isNotCode200()) {
            return;
        }

        // Save the html into the cache
        $cache_key_array = self::getCacheKey();
        $cache_key = $cache_key_array[0];
        $cache_key_as_url = $cache_key_array[1];
        self::getCache()->set($cache_key, $html);

        // Parse this file to find all backlinks
        $backlinks = array();
        $shop_url = new ShopUrl(Shop::getContextShopID());
        $base = $shop_url->getURL();
        $links = PageCacheUtils::parseLinks($html, $base, self::$managed_controllers, '*PCIGN*', '**PCIGN**');
        foreach ($links as $link) {
            $linkCacheKey = self::getCacheKey($link);
            $linkCacheKey = $linkCacheKey[0];
            $backlinks[$linkCacheKey] = $linkCacheKey;
        }

        // Find all called modules
        $module_ids = array();
        foreach (Hook::$executed_hooks as $hook_name) {
            if (strcmp($hook_name, 'displayHeader') != 0) {
                $module_list = Hook::getHookModuleExecList($hook_name);
                foreach ($module_list as $array) {
                    $module_ids[$array['id_module']] = $array['id_module'];
                }
            }
        }

        // Insert in database
        $controller = Dispatcher::getInstance()->getController();
        $id_object = Tools::getValue('id_' . $controller, null);
        PageCacheDAO::insert(
            $cache_key_as_url,
            $cache_key,
            $controller,
            Shop::getContextShopID(),
            $id_object,
            $module_ids,
            $backlinks,
            Configuration::get('pagecache_logs'),
            Configuration::get('pagecache_stats'));
    }

    public static function preDisplayStats() {
        if (Tools::getIsset('ajax')) {
            // Skip useless work
            return array();
        }

        $infos = array();
        if (self::isDisplayStats()) {
            $context = Context::getContext();
            $currency = new Currency(self::getCurrencyId($context));
            $controller = Dispatcher::getInstance()->getController();
            if (in_array($controller, self::$managed_controllers)) {
                $country = self::getCountry($context);
                $country2 = self::getCountry2($context, $country);
                $infos['cacheable'] = self::canBeCached() ? 'true' : 'false';
                $timeoutValue = (int) Configuration::get('pagecache_'.$controller.'_timeout');
                if ($timeoutValue === 0) {
                    $timeoutValue = 'Disabled';
                }
                elseif ($timeoutValue === -1) {
                    $timeoutValue = 'Never';
                }
                else {
                    $timeoutValue = ($timeoutValue / 1440) . ' day(s)';
                }
                $expiresValue = (int) Configuration::get('pagecache_'.$controller.'_expires');
                if ($expiresValue === 0) {
                    $expiresValue = 'Disabled';
                }
                else {
                    $expiresValue = $expiresValue . ' minute(s)';
                }
                $infos['timeout_server'] = $timeoutValue;
                $infos['timeout_browser'] = $expiresValue;
                $infos['controller'] = $controller;
                $infos['currency'] = $currency->name;
                if ($country) {
                    if (is_array($country->name)) {
                        $infos['country'] = $country->name[$context->language->id];
                    }
                    else {
                        $infos['country'] = $country->name;
                    }
                } else {
                    $infos['country'] = '-';
                }
                if ($country2) {
                    if (is_array($country2->name)) {
                        $infos['country2'] = $country2->name[$context->language->id];
                    }
                    else {
                        $infos['country2'] = $country2->name;
                    }
                }
                else {
                    $infos['country2'] = '-';
                }
                $infos['cache_key'] = self::getCacheKey();
                $infos['cache_key'] = $infos['cache_key'][1];
            }
        }
        return $infos;
    }

    public static function displayStats($from_cache, $infos) {
        if (self::isDisplayStats()) {
            $controller = Dispatcher::getInstance()->getController();
            if (in_array($controller, self::$managed_controllers)) {
                // Prepare datas
                $cache_key_array = self::getCacheKey();
                $cache_key = $cache_key_array[0];
                $cache_key_as_url = $cache_key_array[1];
                $startTime = Dispatcher::getInstance()->page_cache_start_time;
                $infos['speed'] = number_format((microtime(true) - $startTime)*1000, 0, ',', ' ').' ms';
                $context = Context::getContext();
                $infos['groups'] = '';
                $groupsIds = self::getGroupsIds($context);
                foreach ($groupsIds as $groupId) {
                    if (((int)$groupId) > 0) {
                        $group = new Group($groupId);
                        $infos['groups'] = $infos['groups'].$group->name[$context->language->id].', ';
                    }
                }
                $infos['cookie_groups'] = $context->cookie->pc_groups;
                $infos['cookie_group_default'] = $context->cookie->pc_group_default;
                $infos['cache_key_after'] = $cache_key_as_url;
                $infos['from_cache'] = $from_cache;
                $stats = PageCacheDAO::getStats($cache_key);
                if ($stats['hit'] != -1) {
                    $infos['hit'] = $stats['hit'];
                    $infos['missed'] = $stats['missed'];
                    $infos['perfs'] = number_format((100*$stats['hit']/($stats['hit']+$stats['missed'])), 1).'%';
                } else {
                    $infos['hit'] = '-';
                    $infos['missed'] = '-';
                    $infos['perfs'] = '-';
                }
                $infos['pagehash'] = $cache_key;

                $infos['url_on_off'] = http_build_url(self::getCleanURL(), array("query" => 'dbgpagecache='.((int)Tools::getValue('dbgpagecache', 0) == 0 ? 1 : 0)), HTTP_URL_JOIN_QUERY);
                $infos['url_del'] = http_build_url(self::getCleanURL(), array("query" => 'dbgpagecache='.Tools::getValue('dbgpagecache', 0).'&delpagecache=1'), HTTP_URL_JOIN_QUERY);
                $infos['url_reload'] = http_build_url(self::getCleanURL(), array("query" => 'dbgpagecache='.Tools::getValue('dbgpagecache', 1)), HTTP_URL_JOIN_QUERY);
                $infos['url_close'] = self::getCleanURL();
                $infos['dbgpagecache'] = (int)Tools::getValue('dbgpagecache', 0);
                $infos['base_dir'] = _PS_BASE_URL_.__PS_BASE_URI__;

                // Display the box
                $context->smarty->assign($infos);
                $context->smarty->display(_PS_MODULE_DIR_.basename(__FILE__, '.php').'/views/templates/hook/pagecache-infos.tpl');
            }
        }
    }

    public static function getCleanURL($url = null)
    {
        if ($url == null) {
            $url = self::getCurrentURL();
        }
        $new_query = '';
        $query = parse_url($url, PHP_URL_QUERY);
        if ($query != null) {
            $query = html_entity_decode($query);
            $keyvals = explode('&', $query);
            foreach($keyvals as $keyval) {
                $x = explode('=', $keyval);
                if (strcmp($x[0], 'dbgpagecache') != 0 && strcmp($x[0], 'delpagecache') != 0) {
                    $new_query .= '&'.$x[0].'='.(count($x)>1 ? $x[1] : '');
                }
            }
        }
        $un = new PageCacheURLNormalizer();
        $un->setUrl (http_build_url($url, array("query" => $new_query), HTTP_URL_REPLACE));
        return $un->normalize();
    }

    public static function clearCache() {
        $startTime = microtime(true);
        // Delete cache of current shop(s)
        if (Shop::isFeatureActive()) {
            foreach (Shop::getContextListShopID() as $id_shop) {
                self::getCache($id_shop)->flush();
            }
        } else {
            self::getCache()->flush();
        }
        PageCacheDAO::clearAllCache();
        if (Configuration::get('pagecache_logs') > 0) {
            $msg = '';
            $stacks = debug_backtrace();
            for ($i = 0; $i < count($stacks); $i++) {
                if (array_key_exists('file', $stacks[$i])) {
                    $msg .= $stacks[$i]['function'] . '(' . basename($stacks[$i]['file']) . ':' . $stacks[$i]['line'] . ')';
                }
                else {
                    $msg .= $stacks[$i]['function'] . '(?)';
                }
                if ($i + 1 < count($stacks)) {
                    $msg .= ' < ';
                }
            }
            Logger::addLog("PageCache | clearCache | " . $msg . ' => ' . number_format(microtime(true) - $startTime, 3) . " second(s)", 1, null, null, null, true);
        }
    }

    public function clearCacheAndStats() {
        // Delete cache and stats of current shop(s)
        if (Shop::isFeatureActive()) {
            foreach (Shop::getContextListShopID() as $id_shop) {
                self::getCache($id_shop)->flush();
            }
            PageCacheDAO::resetCache(Shop::getContextListShopID());
        } else {
            self::getCache()->flush();
            PageCacheDAO::resetCache();
        }
    }

    private function _clearCacheModules($event, $action_origin='') {
        $mods = explode(' ', Configuration::get($event.'_mods'));
        foreach ($mods as $mod) {
            $module_name = trim($mod);
            if (Tools::strlen($mod) > 0) {
                PageCacheDAO::clearCacheOfModule($module_name, $action_origin, Configuration::get('pagecache_logs'));
            }
        }
    }

    public function hookActionAttributeDelete($params) {
        $this->hookActionAttributeSave($params);
    }

    public function hookActionAttributeSave($params) {
        if (isset($params['id_attribute'])) {
            $productsIds = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                SELECT DISTINCT pa.id_product
                FROM '._DB_PREFIX_.'product_attribute pa
                LEFT JOIN '._DB_PREFIX_.'product_attribute_combination pac ON (pac.id_product_attribute = pa.id_product_attribute)
                WHERE pac.id_attribute = '.(int)$params['id_attribute']
            );
            foreach ($productsIds as $productId) {
                PageCacheDAO::clearCacheOfObject('product', $productId['id_product'], Configuration::get('pagecache_product_u_bl'), 'hookActionAttributeSave', Configuration::get('pagecache_logs'));
            }
        }
        $this->_clearCacheModules('pagecache_product_u', 'hookActionAttributeSave');
    }

    public function hookActionAttributeGroupDelete($params) {
        $this->hookActionAttributeGroupSave($params);
    }

    public function hookActionAttributeGroupSave($params) {
        if (isset($params['id_attribute_group'])) {
            $productsIds = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                SELECT DISTINCT pa.id_product
                FROM '._DB_PREFIX_.'product_attribute pa
                LEFT JOIN '._DB_PREFIX_.'product_attribute_combination pac ON (pac.id_product_attribute = pa.id_product_attribute)
                LEFT JOIN '._DB_PREFIX_.'attribute a ON (a.id_attribute = pac.id_attribute)
                WHERE a.id_attribute_group = '.(int)$params['id_attribute_group']
            );
            foreach ($productsIds as $productId) {
                PageCacheDAO::clearCacheOfObject('product', $productId['id_product'], Configuration::get('pagecache_product_u_bl'), 'hookActionAttributeGroupSave', Configuration::get('pagecache_logs'));
            }
        }
        $this->_clearCacheModules('pagecache_product_u', 'hookActionAttributeGroupSave');
    }

    public function hookActionFeatureDelete($params) {
        $this->hookActionFeatureSave($params);
    }

    public function hookActionFeatureSave($params) {
        if (isset($params['id_feature'])) {
            $id_feature = $params['id_feature'];
            $productsIds = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                SELECT DISTINCT p.id_product
                FROM '._DB_PREFIX_.'product p
                LEFT JOIN '._DB_PREFIX_.'feature_product f ON (f.id_product = p.id_product)
                WHERE f.id_feature = '.(int)$id_feature
            );
            foreach ($productsIds as $productId) {
                PageCacheDAO::clearCacheOfObject('product', $productId['id_product'], Configuration::get('pagecache_product_u_bl'), 'hookActionFeatureSave', Configuration::get('pagecache_logs'));
            }
        }
        $this->_clearCacheModules('pagecache_product_u', 'hookActionFeatureSave');
    }

    public function hookActionFeatureValueDelete($params) {
        $this->hookActionFeatureValueSave($params);
    }

    public function hookActionFeatureValueSave($params) {
        if (isset($params['id_feature_value'])) {
            $id_feature_value = $params['id_feature_value'];
            $productsIds = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                SELECT DISTINCT p.id_product
                FROM '._DB_PREFIX_.'product p
                LEFT JOIN '._DB_PREFIX_.'feature_product fp ON (fp.id_product = p.id_product)
                WHERE fp.id_feature = '.(int)$id_feature_value
            );
            foreach ($productsIds as $productId) {
                PageCacheDAO::clearCacheOfObject('product', $productId['id_product'], Configuration::get('pagecache_product_u_bl'), 'hookActionFeatureValueSave', Configuration::get('pagecache_logs'));
            }
        }
        $this->_clearCacheModules('pagecache_product_u', 'hookActionFeatureValueSave');
    }

    public function hookActionObjectCmsAddAfter($params) {
        if (isset($params['object'])) {
            PageCacheDAO::clearCacheOfObject('cms', $params['object']->id, false, 'hookActionObjectCmsAddAfter', Configuration::get('pagecache_logs'));
        }
        $this->_clearCacheModules('pagecache_cms_a', 'hookActionObjectCmsAddAfter');
    }

    public function hookActionObjectCmsUpdateAfter($params) {
        if (isset($params['object'])) {
            PageCacheDAO::clearCacheOfObject('cms', $params['object']->id, Configuration::get('pagecache_cms_u_bl'), 'hookActionObjectCmsUpdateAfter', Configuration::get('pagecache_logs'));
        }
        $this->_clearCacheModules('pagecache_cms_u', 'hookActionObjectCmsUpdateAfter');
    }

    public function hookActionObjectCmsDeleteBefore($params) {
        if (isset($params['object'])) {
            PageCacheDAO::clearCacheOfObject('cms', $params['object']->id, Configuration::get('pagecache_cms_d_bl'), 'hookActionObjectCmsDeleteBefore', Configuration::get('pagecache_logs'));
        }
        $this->_clearCacheModules('pagecache_cms_d', 'hookActionObjectCmsDeleteBefore');
    }

    public function hookActionObjectManufacturerAddAfter($params) {
        if (isset($params['object'])) {
            PageCacheDAO::clearCacheOfObject('manufacturer', $params['object']->id, false, 'hookActionObjectManufacturerAddAfter', Configuration::get('pagecache_logs'));
        }
        $this->_clearCacheModules('pagecache_manufacturer_a', 'hookActionObjectManufacturerAddAfter');
    }

    public function hookActionObjectManufacturerUpdateAfter($params) {
        if (isset($params['object'])) {
            PageCacheDAO::clearCacheOfObject('manufacturer', $params['object']->id, Configuration::get('pagecache_manufacturer_u_bl'), 'hookActionObjectManufacturerUpdateAfter', Configuration::get('pagecache_logs'));
        }
        $this->_clearCacheModules('pagecache_manufacturer_u', 'hookActionObjectManufacturerUpdateAfter');
    }

    public function hookActionObjectManufacturerDeleteBefore($params) {
        if (isset($params['object'])) {
            PageCacheDAO::clearCacheOfObject('manufacturer', $params['object']->id, Configuration::get('pagecache_manufacturer_d_bl'), 'hookActionObjectManufacturerDeleteBefore', Configuration::get('pagecache_logs'));
        }
        $this->_clearCacheModules('pagecache_manufacturer_d', 'hookActionObjectManufacturerDeleteBefore');
    }

    public function hookActionObjectStockAddAfter($params) {
        if (isset($params['object'])) {
            PageCacheDAO::clearCacheOfObject('product', $params['object']->id_product, false, 'hookActionObjectStockAddAfter', Configuration::get('pagecache_logs'));
        }
        $this->_clearCacheModules('pagecache_product_a', 'hookActionObjectStockAddAfter');
    }

    public function hookActionObjectStockUpdateAfter($params) {
        if (isset($params['object'])) {
            PageCacheDAO::clearCacheOfObject('product', $params['object']->id_product, Configuration::get('pagecache_product_u_bl'), 'hookActionObjectStockUpdateAfter', Configuration::get('pagecache_logs'));
        }
        $this->_clearCacheModules('pagecache_product_u', 'hookActionObjectStockUpdateAfter');
    }

    public function hookActionObjectStockDeleteBefore($params) {
        if (isset($params['object'])) {
            PageCacheDAO::clearCacheOfObject('product', $params['object']->id_product, Configuration::get('pagecache_product_d_bl'), 'hookActionObjectStockDeleteBefore', Configuration::get('pagecache_logs'));
        }
        $this->_clearCacheModules('pagecache_product_d', 'hookActionObjectStockDeleteBefore');
    }

    public function hookActionObjectAddressAddAfter($params) {
        if (isset($params['object']) && !empty($params['object']->id_supplier)) {
            $this->_clearCacheModules('pagecache_supplier_a', 'hookActionObjectAddressAddAfter');
        }
    }

    public function hookActionObjectAddressUpdateAfter($params) {
        if (isset($params['object']) && !empty($params['object']->id_supplier)) {
            PageCacheDAO::clearCacheOfObject('supplier', $params['object']->id_supplier, Configuration::get('pagecache_supplier_u_bl'), 'hookActionObjectAddressUpdateAfter', Configuration::get('pagecache_logs'));
            $this->_clearCacheModules('pagecache_supplier_u', 'hookActionObjectAddressUpdateAfter');
        }
    }

    public function hookActionObjectAddressDeleteBefore($params) {
        if (isset($params['object']) && !empty($params['object']->id_supplier)) {
            PageCacheDAO::clearCacheOfObject('supplier', $params['object']->id_supplier, Configuration::get('pagecache_supplier_d_bl'), 'hookActionObjectAddressDeleteBefore', Configuration::get('pagecache_logs'));
            $this->_clearCacheModules('pagecache_supplier_d', 'hookActionObjectAddressDeleteBefore');
        }
    }

    public function hookActionProductAttributeDelete($params) {
        if (isset($params['id_product'])) {
            PageCacheDAO::clearCacheOfObject('product', $params['id_product'], Configuration::get('pagecache_product_u_bl'), 'hookActionProductAttributeDelete', Configuration::get('pagecache_logs'));
        }
        $this->_clearCacheModules('pagecache_product_u', 'hookActionProductAttributeDelete');
    }

    public function hookActionProductAttributeUpdate($params) {
        if (isset($params['id_product_attribute'])) {
            $productsIds = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                SELECT DISTINCT pa.id_product
                FROM '._DB_PREFIX_.'product_attribute pa
                WHERE pa.id_product_attribute = '.(int)$params['id_product_attribute']
            );
            foreach ($productsIds as $productId) {
                PageCacheDAO::clearCacheOfObject('product', $productId['id_product'], Configuration::get('pagecache_product_u_bl'), 'hookActionProductAttributeUpdate', Configuration::get('pagecache_logs'));
            }
        }
        $this->_clearCacheModules('pagecache_product_u', 'hookActionProductAttributeUpdate');
    }

    public function hookActionCategoryAdd($params) {
        if (isset($params['category'])) {
            PageCacheDAO::clearCacheOfObject('category', $params['category']->id, false, 'hookActionCategoryAdd', Configuration::get('pagecache_logs'));
            $this->_checkRootCategory($params['category']->id, 'a', 'hookActionCategoryAdd');
        }
        $this->_clearCacheModules('pagecache_category_a', 'hookActionCategoryAdd');
    }

    public function hookActionCategoryUpdate($params) {
        if (isset($params['category'])) {
            PageCacheDAO::clearCacheOfObject('category', $params['category']->id, Configuration::get('pagecache_category_u_bl'), 'hookActionCategoryUpdate', Configuration::get('pagecache_logs'));
            $this->_checkRootCategory($params['category']->id, 'u', 'hookActionCategoryUpdate');
        }
        $this->_clearCacheModules('pagecache_category_u', 'hookActionCategoryUpdate');
    }

    public function hookActionCategoryDelete($params) {
        if (isset($params['category'])) {
            PageCacheDAO::clearCacheOfObject('category', $params['category']->id, Configuration::get('pagecache_category_d_bl'), 'hookActionCategoryDelete', Configuration::get('pagecache_logs'));
            $this->_checkRootCategory($params['category']->id, 'd', 'hookActionCategoryDelete');
        }
        $this->_clearCacheModules('pagecache_category_d', 'hookActionCategoryDelete');
    }

    public function hookActionProductAdd($params) {
        if (!isset($params['product']) && isset($params['id_product'])) {
            $params['product'] = new Product($params['id_product']);
        }
        if (isset($params['product'])) {
            $product = $params['product'];
            // New products pages
            PageCacheDAO::clearCacheOfObject('new-products', null, false, 'hookActionProductAdd', Configuration::get('pagecache_logs'));
            // Categories of the new product
            $categoriesIds = $product->getCategories();
            foreach ($categoriesIds as $categoryId) {
                PageCacheDAO::clearCacheOfObject('category', $categoryId, false, 'hookActionProductAdd#'.$product->id, Configuration::get('pagecache_logs'));
                $this->_checkRootCategory($categoryId, 'a', 'hookActionProductAdd#'.$product->id);
            }
            // Supplier pages
            PageCacheDAO::clearCacheOfObject('supplier', $product->id_supplier, false, 'hookActionProductAdd#'.$product->id, Configuration::get('pagecache_logs'));
            // Manufacturer pages
            PageCacheDAO::clearCacheOfObject('manufacturer', $product->id_manufacturer, false, 'hookActionProductAdd#'.$product->id, Configuration::get('pagecache_logs'));
            // Modules attached to this hook
            $this->_clearCacheModules('pagecache_product_a', 'hookActionProductAdd#'.$product->id);
        }
    }

    public function hookActionProductUpdate($params) {
        if (!isset($params['product']) && isset($params['id_product'])) {
            $params['product'] = new Product($params['id_product']);
        }
        if (isset($params['product'])) {
            $product = $params['product'];
            if (method_exists($product, 'getFieldsToUpdate') && array_key_exists('active', $product->getFieldsToUpdate())) {
                if ($product->active) {
                    // Product is back, act like a new product
                    $this->hookActionProductAdd($params);
                }
                else {
                    // Product is disabled, act like a deletion
                    $this->onProductDelete($params['product']);
                }
            }
            else {
                // Product page
                PageCacheDAO::clearCacheOfObject('product', $params['product']->id, Configuration::get('pagecache_product_u_bl'), 'hookActionProductUpdate', Configuration::get('pagecache_logs'));
                // Categories of the new product
                $categoriesIds = $product->getCategories();
                foreach ($categoriesIds as $categoryId) {
                    PageCacheDAO::clearCacheOfObject('category', $categoryId, false, 'hookActionProductUpdate#'.$product->id, Configuration::get('pagecache_logs'));
                    $this->_checkRootCategory($categoryId, 'u', 'hookActionProductUpdate#'.$product->id);
                }
                // Supplier pages
                PageCacheDAO::clearCacheOfObject('supplier', $product->id_supplier, false, 'hookActionProductAdd#'.$product->id, Configuration::get('pagecache_logs'));
                // Manufacturer pages
                PageCacheDAO::clearCacheOfObject('manufacturer', $product->id_manufacturer, false, 'hookActionProductAdd#'.$product->id, Configuration::get('pagecache_logs'));
                // Modules attached to this hook
                $this->_clearCacheModules('pagecache_product_u', 'hookActionProductUpdate#'.$product->id);
            }
        }
    }

    public function hookActionProductSave($params) {
        $this->hookActionProductUpdate($params);
    }

    public function onProductDelete($product) {
        // Product page
        PageCacheDAO::clearCacheOfObject('product', $product->id, Configuration::get('pagecache_product_d_bl'), 'hookActionProductDelete', Configuration::get('pagecache_logs'));
        // Categories of the new product
        $categoriesIds = $product->getCategories();
        foreach ($categoriesIds as $categoryId) {
            PageCacheDAO::clearCacheOfObject('category', $categoryId, false, 'hookActionProductDelete#'.$product->id, Configuration::get('pagecache_logs'));
            $this->_checkRootCategory($categoryId, 'd', 'hookActionProductDelete#'.$product->id);
        }
        // Supplier pages
        PageCacheDAO::clearCacheOfObject('supplier', $product->id_supplier, false, 'hookActionProductAdd#'.$product->id, Configuration::get('pagecache_logs'));
        // Manufacturer pages
        PageCacheDAO::clearCacheOfObject('manufacturer', $product->id_manufacturer, false, 'hookActionProductAdd#'.$product->id, Configuration::get('pagecache_logs'));
        // Modules attached to this hook
        $this->_clearCacheModules('pagecache_product_d', 'hookActionProductDelete#'.$product->id);
    }

    public function hookActionObjectProductDeleteBefore($params) {
        if (isset($params['object'])) {
            $this->onProductDelete($params['object']);
        }
    }

    public function hookActionObjectSpecificPriceAddAfter($params) {
        if (isset($params['object'])) {
            $sp = $params['object'];
            PageCacheDAO::insertSpecificPrice($sp->id, $sp->id_product, $sp->from, $sp->to);
            $this->hookActionProductUpdate(array('id_product' => $params['object']->id_product));
        }
    }

    public function hookActionObjectSpecificPriceUpdateAfter($params) {
        if (isset($params['object'])) {
            $sp = $params['object'];
            PageCacheDAO::updateSpecificPrice($sp->id, $sp->id_product, $sp->from, $sp->to);
            $this->hookActionProductUpdate(array('id_product' => $params['object']->id_product));
        }
    }

    public function hookActionObjectSpecificPriceDeleteBefore($params) {
        if (isset($params['object'])) {
            $sp = $params['object'];
            PageCacheDAO::deleteSpecificPrice($sp->id);
            $this->hookActionProductUpdate(array('id_product' => $params['object']->id_product));
        }
    }

    public function hookActionObjectImageAddAfter($params) {
        if (isset($params['object'])) {
            $img = $params['object'];
            $this->hookActionProductUpdate(array('id_product' => $img->id_product));
        }
    }

    public function hookActionObjectImageUpdateAfter($params) {
        if (isset($params['object'])) {
            $img = $params['object'];
            $this->hookActionProductUpdate(array('id_product' => $img->id_product));
        }
    }

    public function hookActionObjectImageDeleteBefore($params) {
        if (isset($params['object'])) {
            $img = $params['object'];
            $this->hookActionProductUpdate(array('id_product' => $img->id_product));
        }
    }

    private function _checkRootCategory($id_category, $suffix, $origin_action='') {
        if ((bool)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('SELECT `id_shop` FROM `'._DB_PREFIX_.'shop` WHERE `id_category` = '.(int)$id_category)) {
            $this->_clearCacheModules('pagecache_product_home_'.$suffix, $origin_action);
        }
    }

    public function hookActionUpdateQuantity($params) {
        if (isset($params['id_product'])) {
            $product = new Product($params['id_product']);
            if (!$product->checkQty(1)) {
                // Out of stock, do like a product update
                PageCacheDAO::clearCacheOfObject('product', $params['id_product'], true, 'hookActionUpdateQuantity', Configuration::get('pagecache_logs'));
                $categoriesIds = $product->getCategories();
                foreach ($categoriesIds as $categoryId) {
                    PageCacheDAO::clearCacheOfObject('category', $categoryId, false, 'hookActionUpdateQuantity#'.$params['id_product'], Configuration::get('pagecache_logs'));
                    $this->_checkRootCategory($categoryId, 'd', 'hookActionUpdateQuantity#'.$params['id_product']);
                }
                $this->_clearCacheModules('pagecache_product_u', 'hookActionUpdateQuantity#'.$params['id_product']);
            } else {
                // Still in stock, just update product page
                PageCacheDAO::clearCacheOfObject('product', $params['id_product'], false, 'hookActionUpdateQuantity', Configuration::get('pagecache_logs'));
            }
        }
    }

    public function hookActionHtaccessCreate($params) {
        $this->clearCache();
    }

    public function hookActionAdminPerformanceControllerAfter($params)
    {
        $this->clearCache();
    }

    public function upgradeOverride($class_name) {
        // Avoid calling this method multiple times (or it will fail)
        static $already_done = array();
        if (array_key_exists($class_name, $already_done)) {
            return true;
        }
        $already_done[$class_name] = true;

        $reset_ok = true;
        if (Tools::version_compare(_PS_VERSION_,'1.6','>=')
            || (!class_exists($class_name . 'OverrideOriginal') && (!class_exists($class_name . 'OverrideOriginal_remove')))) {
            $reset_ok = $this->removeOverride($class_name) && $this->addOverride($class_name);
        }
        return $reset_ok;
    }

    private function getAdvices() {
        $warnings = array();

        // Check shop context (not group)
        if (Configuration::get('PS_MULTISHOP_FEATURE_ACTIVE')) {
            if (Shop::getcontext() !== Shop::CONTEXT_SHOP) {
                $warnings[] = $this->l('It is recommended to configure shops one after the other; please select a shop in the select list (top left) instead of a group of shops.');
            }
        }

        return $warnings;
    }

    private function getInstallationErrors() {
        $errors = array();

        // Check tokens
        $token_enabled = (int)(Configuration::get('PS_TOKEN_ENABLE')) == 1 ? true : false;
        if ($token_enabled) {
            $errors[] = $this->l('You must disable tokens in order for cached pages to do ajax call.').' <a href="#" onclick="$(\'#pagecache_disable_tokens\').val(\'true\');$(\'#pagecache_form_install\').submit();return false;">'.$this->l('Resolve this for me!').'</a>';
        }

        // Check for bvkdispatcher module
        if (Module::isInstalled('bvkseodispatcher')) {
            $errors[] = $this->l('Module "SEO Pretty URL Module" (bvkseodispatcher) is not compatible with PageCache because it does not respect Prestashop standards. You have to choose between this module and PageCache.');
        }

        // Check for overrides (after an upgrade it is disabled)
        if (!self::isOverridesEnabled()) {
            $errors[] = $this->l('Overrides are disabled in Performances tab so PageCache is disabled.');
        }

        return $errors;
    }

    /** @return bool true if infos block must be displayed on front end */
    private static function isDisplayStats() {
        if (Tools::getIsset('ajax') || strcmp(self::getServerValue('REQUEST_METHOD'), 'GET') != 0) {
            return false;
        }
        return Configuration::get('pagecache_always_infosbox')
            || (Configuration::get('pagecache_debug') && Tools::getIsset('dbgpagecache'));
    }

    private function getRatingUrl() {
        $seller = Configuration::get('pagecache_seller');
        if (isset($seller) && strcmp($seller, 'addons') === 0) {
            // Rating
            return 'https://addons.prestashop.com/'.Language::getIsoById($this->context->language->id).'/ratings.php';
        } else {
            // Rating
            return self::JPRESTA_PROTO . self::JPRESTA_DOMAIN . '.com/'.Language::getIsoById($this->context->language->id).'/home/1-page-cache.html#new_comment_form';
        }
    }

    private function getContactUrl() {
        $seller = Configuration::get('pagecache_seller');
        if (isset($seller) && strcmp($seller, 'addons') === 0) {
            // Contact URL
            if (strcmp('fr', Language::getIsoById($this->context->language->id)) == 0) {
                return 'https://addons.prestashop.com/fr/ecrire-au-developpeur?id_product=7939';
            }
            else {
                return 'https://addons.prestashop.com/en/write-to-developper?id_product=7939';
            }
        } else {
            // Contact URL
            if (strcmp('fr', Language::getIsoById($this->context->language->id)) == 0) {
                return self::JPRESTA_PROTO . self::JPRESTA_DOMAIN . '.com/fr/contactez-nous';
            }
            else {
                return self::JPRESTA_PROTO . self::JPRESTA_DOMAIN . '.com/en/contact-us';
            }
        }
    }

    /**
     * Used in case script is run with a command line
     * @param unknown $key Variable name
     * @return string Value of variable or empty string
     */
    private static function getServerValue($key) {
        if (array_key_exists($key, $_SERVER)) {
            return $_SERVER[$key];
        }
        return '';
    }

    private function prepareDatasForSpeedAnalyse(&$infos) {
        if (!method_exists($this, 'isEnabledForShopContext') || $this->isEnabledForShopContext($this->name)) {

            $controller_url = $this->context->link->getModuleLink(
                $this->name, 'pcspeedanalysis', array(
                    'token' => Configuration::get('pagecache_cron_token'),
                ));
            $https = self::getServerValue('HTTPS');
            if (!empty($https) && $https !== 'off' || self::getServerValue('SERVER_PORT') == 443) {
                $controller_url = str_replace("http://", "https://", $controller_url);
            }

            $params = 'nocache=' . time();
            $params_nocache = 'nocache=' . (time() + 1);
            if (Configuration::get('pagecache_debug')) {
                $params .= '&dbgpagecache=1';
            }
            $index_url = $this->context->link->getPageLink('index');
            $infos['url_home'] = $index_url . ((strpos($index_url, '?') !== FALSE) ? '&' . $params : '?' . $params);
            $infos['url_home_nocache'] = $index_url . ((strpos($index_url, '?') !== FALSE) ? '&' . $params_nocache : '?' . $params_nocache);
            $infos['url_home_ctrl'] = $controller_url . '&url=' . urlencode($infos['url_home']);
            $infos['url_home_nocache_ctrl'] = $controller_url . '&url=' . urlencode($infos['url_home_nocache']);

            // First active product
            $sql = 'SELECT *
                    FROM `' . _DB_PREFIX_ . 'product` p ' . Shop::addSqlAssociation('product', 'p') . '
                    WHERE p.`active` = 1';
            $row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
            if ($row) {
                $product_url = $this->context->link->getProductLink(Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql));
                $infos['url_product'] = $product_url . ((strpos($product_url, '?') !== FALSE) ? '&' . $params : '?' . $params);
                $infos['url_product_nocache'] = $product_url . ((strpos($product_url, '?') !== FALSE) ? '&' . $params_nocache : '?' . $params_nocache);
                $infos['url_product_ctrl'] = $controller_url . '&url=' . urlencode($infos['url_product']);
                $infos['url_product_nocache_ctrl'] = $controller_url . '&url=' . urlencode($infos['url_product_nocache']);
            }

            // Active category with most active products count
            $sql = 'SELECT p.id_category_default as id_category, sum(1)
                    FROM `' . _DB_PREFIX_ . 'product` p ' . Shop::addSqlAssociation('product', 'p') . '
                    LEFT JOIN `'._DB_PREFIX_.'category` c ON (c.`id_category` = p.`id_category_default`)' . Shop::addSqlAssociation('category', 'c') . '
                    WHERE p.`active` = 1 AND c.active = 1 GROUP BY 1 ORDER BY 2 DESC';
            $row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
            if ($row) {
                $category_url = $this->context->link->getCategoryLink((int) $row['id_category']);
                $infos['url_category'] = $category_url . ((strpos($category_url, '?') !== FALSE) ? '&' . $params : '?' . $params);
                $infos['url_category_nocache'] = $category_url . ((strpos($category_url, '?') !== FALSE) ? '&' . $params_nocache : '?' . $params_nocache);
                $infos['url_category_ctrl'] = $controller_url . '&url=' . urlencode($infos['url_category']);
                $infos['url_category_nocache_ctrl'] = $controller_url . '&url=' . urlencode($infos['url_category_nocache']);
            }
        }
    }

    /**
     * Return an array[info/warn/error][messages[]]
     */
    private function getDiagnostic() {
        $count = 0;
        $diagnostic = array();
        $diagnostic['info'] = array();
        $diagnostic['warn'] = array();
        $diagnostic['error'] = array();
        if ((int)Configuration::get('PS_SMARTY_CACHE') === 0) {
            $diagnostic['error'][$count] = array();
            $diagnostic['error'][$count]['msg'] = $this->l('You must enable smarty cache; keep it disabled only when developping or modifying your theme or a module');
            $diagnostic['error'][$count]['link'] = $this->context->link->getAdminLink('AdminPerformance');
            $diagnostic['error'][$count]['link_title'] = $this->l('Resolve this issue in Performances page');
            $count++;
        }
        elseif ((int)Configuration::get('PS_SMARTY_FORCE_COMPILE') === _PS_SMARTY_FORCE_COMPILE_) {
            $diagnostic['error'][$count] = array();
            $diagnostic['error'][$count]['msg'] = $this->l('You must not use "Force compilation"; keep it enabled only when developping or modifying your theme or a module');
            $diagnostic['error'][$count]['link'] = $this->context->link->getAdminLink('AdminPerformance');
            $diagnostic['error'][$count]['link_title'] = $this->l('Resolve this issue in Performances page');
            $count++;
        }
        if (!Configuration::get('PS_CSS_THEME_CACHE')) {
            $diagnostic['warn'][$count] = array();
            $diagnostic['warn'][$count]['msg'] = $this->l('You should enable smart cache (CCC) for CSS');
            $diagnostic['warn'][$count]['link'] = $this->context->link->getAdminLink('AdminPerformance');
            $diagnostic['warn'][$count]['link_title'] = $this->l('Resolve this issue in Performances page');
            $count++;
        }
        if (!Configuration::get('PS_JS_THEME_CACHE')) {
            $diagnostic['warn'][$count] = array();
            $diagnostic['warn'][$count]['msg'] = $this->l('You should enable smart cache (CCC) for Javascript');
            $diagnostic['warn'][$count]['link'] = $this->context->link->getAdminLink('AdminPerformance');
            $diagnostic['warn'][$count]['link_title'] = $this->l('Resolve this issue in Performances page');
            $count++;
        }
        if (Tools::version_compare(_PS_VERSION_,'1.7','<')) {
            if (!Configuration::get('PS_HTML_THEME_COMPRESSION')) {
                $diagnostic['warn'][$count] = array();
                $diagnostic['warn'][$count]['msg'] = $this->l('You should enable HTML compression');
                $diagnostic['warn'][$count]['link'] = $this->context->link->getAdminLink('AdminPerformance');
                $diagnostic['warn'][$count]['link_title'] = $this->l('Resolve this issue in Performances page');
                $count++;
            }
            if (!Configuration::get('PS_JS_HTML_THEME_COMPRESSION')) {
                $diagnostic['warn'][$count] = array();
                $diagnostic['warn'][$count]['msg'] = $this->l('You should enable Javascript compression in HTML');
                $diagnostic['warn'][$count]['link'] = $this->context->link->getAdminLink('AdminPerformance');
                $diagnostic['warn'][$count]['link_title'] = $this->l('Resolve this issue in Performances page');
                $count++;
            }
            if (!Configuration::get('PS_JS_DEFER')) {
                $diagnostic['warn'][$count] = array();
                $diagnostic['warn'][$count]['msg'] = $this->l('You should defer Javascript at the bottom of the page');
                $diagnostic['warn'][$count]['link'] = $this->context->link->getAdminLink('AdminPerformance');
                $diagnostic['warn'][$count]['link_title'] = $this->l('Resolve this issue in Performances page');
                $count++;
            }
        }
        if (!Configuration::get('PS_HTACCESS_CACHE_CONTROL')) {
            $diagnostic['error'][$count] = array();
            $diagnostic['error'][$count]['msg'] = $this->l('You must enable Apache optimisations in order for images to be cached by browsers');
            $diagnostic['error'][$count]['link'] = $this->context->link->getAdminLink('AdminPerformance');
            $diagnostic['error'][$count]['link_title'] = $this->l('Resolve this issue in Performances page');
            $count++;
        }
        if (_PS_CACHE_ENABLED_) {
            $diagnostic['info'][$count] = array();
            $diagnostic['info'][$count]['msg'] = $this->l('When using a caching system make sure that it is faster, do some tests because sometimes it\'s slower.');
            $count++;
        }
        $diagnostic['count'] = $count;
        return $diagnostic;
    }

    private function autoconf(&$msg_infos, &$msg_warnings, &$msg_errors) {
        $datas = array();
        $datas[] = '';
        $datas['pagecacheEdition'] = $this->name;
        $datas['pagecacheVersion'] = $this->version;
        $datas['prestashopVersion'] = _PS_VERSION_;
        $datas['shopUrl'] = $this->context->shop->getBaseURL();
        $datas['shopName'] = $this->context->shop->name;
        $datas['adminName'] = '';
        $datas['adminEmail'] = '';
        $admins = Employee::getEmployeesByProfile(_PS_ADMIN_PROFILE_, true);
        if (!empty($admins)) {
            $datas['adminName'] = $admins[0]['firstname'] . ' ' . $admins[0]['lastname'];
            $datas['adminEmail'] = $admins[0]['email'];
        }
        $datas['theme'] = array();
        if (isset($this->context->shop->theme)) {
            $datas['theme']['name'] = $this->context->shop->theme->get('name');
            $datas['theme']['displayName'] = $this->context->shop->theme->get('display_name');
            $datas['theme']['version'] = $this->context->shop->theme->get('version');
            $datas['theme']['author'] = $this->context->shop->theme->get('author.name');
        }
        else {
            $datas['theme']['name'] = $this->context->shop->theme_name;
            $datas['theme']['displayName'] = $this->context->shop->theme_name;
            $datas['theme']['version'] = 0;
            $datas['theme']['author'] = '';
        }
        $datas['modules'] = array();
        $modules = Module::getModulesInstalled();
        foreach ($modules as $module) {
            $moduleInstance = Module::getInstanceByName($module['name']);
            if ($moduleInstance !== false) {
                $datas['modules'][$module['name']] = array();
                $datas['modules'][$module['name']]['displayName'] = $moduleInstance->displayName;
                $datas['modules'][$module['name']]['version'] = $module['version'];
                $datas['modules'][$module['name']]['active'] = $module['active'];
                $datas['modules'][$module['name']]['author'] = $moduleInstance->author;
                $datas['modules'][$module['name']]['description'] = $moduleInstance->description;
            }
        }

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => Tools::jsonEncode($datas)
            )
        );
        $context  = stream_context_create($options);
        $result = Tools::file_get_contents(self::AUTOCONF_PROTO . self::AUTOCONF_DOMAIN . self::AUTOCONF_URL, false, $context);
        if ($result !== FALSE) {
            $conf = Tools::jsonDecode($result, true);
            if ($conf !== null) {
                // Javascript to execute
                Configuration::updateValue('pagecache_cfgadvancedjs', $conf['javascript']);
                // Cache for logged in visitors?
                if (array_key_exists('cacheForLoggedInUsers', $conf['options'])) {
                    Configuration::updateValue('pagecache_skiplogged', !empty($conf['options']['cacheForLoggedInUsers']) ? true : false);
                }
                else {
                    Configuration::updateValue('pagecache_skiplogged', false);
                }
                // Dynamic modules
                $pagecache_dyn_hooks = '';
                $pagecache_dyn_widgets = '';
                foreach ($conf['modules'] as $moduleName => $moduleConf) {
                    // Hooks
                    if (array_key_exists('hooks', $moduleConf) && is_array($moduleConf['hooks'])) {
                        foreach ($moduleConf['hooks'] as $hookName => $hookConf) {
                            if ($hookConf['dynamic']) {
                                $empty = array_key_exists('empty', $hookConf) && !empty($hookConf['empty']) ? 1 : 0;
                                $pagecache_dyn_hooks .= $hookName . '|' . $moduleName . '|' . $empty . ',';
                            }
                        }
                    }
                    // Widgets
                    if (array_key_exists('widgets', $moduleConf) && is_array($moduleConf['widgets'])) {
                        foreach ($moduleConf['widgets'] as $hookName => $hookConf) {
                            if ($hookConf['dynamic']) {
                                $pagecache_dyn_widgets .=  $moduleName . '|' . $hookName . ',';
                            }
                        }
                    }
                }
                Configuration::updateValue('pagecache_dyn_hooks', $pagecache_dyn_hooks);
                Configuration::updateValue('pagecache_dyn_widgets', $pagecache_dyn_widgets);
                // Messages
                foreach ($conf['messages'] as $message) {
                    if (array_key_exists('message', $message) && !empty($message['message']) && array_key_exists('type', $message) && !empty($message['type'])) {
                        if ($message['type'] === 'WARN') {
                            $msg_warnings[] = $message['message'];
                        }
                        elseif ($message['type'] === 'ERROR') {
                            $msg_infos[] = $message['message'];
                        }
                        elseif ($message['type'] === 'INFO') {
                            $msg_errors[] = $message['message'];
                        }
                    }
                }
            }
            // Ignore errors
        }
        // Ignore errors
    }

    /**
     * @deprecated Just needed when upgrading to 4.00, do not remove it
     */
    public static function getCacheFile() {
        return false;
    }
}
?>
