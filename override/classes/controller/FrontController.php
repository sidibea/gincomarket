<?php
class FrontController extends FrontControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:07
    * version: 3.0.6.2
    */
    public function initHeader()
	{
		parent::initHeader();
		
		if(Module::isInstalled('agilemultipleshop'))
		{
			include_once(_PS_ROOT_DIR_  . "/modules/agilemultipleshop/agilemultipleshop.php");
			AgileMultipleShop::init_shop_header();
			AgileMultipleShop::clear_blockcategory_cache();
		}
	}	
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    private static $_is_page_cache_active = -1;
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    private static function _isPageCacheActive()
    {
        if (self::$_is_page_cache_active == -1)
        {
            if (file_exists(dirname(__FILE__).'/../../../modules/pagecache/pagecache.php'))
            {
                require_once(dirname(__FILE__).'/../../../modules/pagecache/pagecache.php');
                self::$_is_page_cache_active = Module::isEnabled('pagecache');
            } else {
                Logger::addLog('Page cache has not been well uninstalled, please, remove manually the following functions in file '.__FILE__.': _isPageCacheActive(), smartyOutputContent(), smartyOutputContent_15() and smartyOutputContent_16(). If you need help contact our support.', 4);
                return false;
            }
        }
        return self::$_is_page_cache_active;
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    protected function smartyOutputContent($content)
    {
        if ($this->_isPageCacheActive() && PageCache::canBeCached() && !($this instanceof ModuleFrontControllerCore))
        {
            if (Tools::version_compare(_PS_VERSION_,'1.6','>='))
            {
                $this->smartyOutputContent_16($content);
            }
            else
            {
                $this->smartyOutputContent_15($content);
            }
        }
        else
        {
            return parent::smartyOutputContent($content);
        }
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    private function smartyOutputContent_15($content)
    {
        $html = $this->context->smarty->fetch($content);
        PageCache::cacheThis($html, $this->getLayout());
        echo $html;
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    private function smartyOutputContent_16($content)
    {
        $js_tag = 'js_def';
        $this->context->smarty->assign($js_tag, $js_tag);
        if (is_array($content))
            foreach ($content as $tpl)
                $html = $this->context->smarty->fetch($tpl);
        else
            $html = $this->context->smarty->fetch($content);
        $html = trim($html);
        if (method_exists('Media','deferInlineScripts') && $this->controller_type == 'front' && !empty($html) && $this->getLayout())
        {
            $live_edit_content = '';
            if (method_exists($this, 'useMobileTheme') && !$this->useMobileTheme() && $this->checkLiveEditAccess())
                $live_edit_content = $this->getLiveEditFooter();
             $dom_available = extension_loaded('dom') ? true : false;
            $defer = (bool)Configuration::get('PS_JS_DEFER') || Tools::version_compare(_PS_VERSION_,'1.6.0.6','<=');
             if ($defer && $dom_available)
                $html = Media::deferInlineScripts($html);
            $html = trim(str_replace(array('</body>', '</html>'), '', $html))."\n";
            $this->context->smarty->assign(array(
                $js_tag => Media::getJsDef(),
                'js_files' =>  $defer ? array_unique($this->js_files) : array(),
                'js_inline' => ($defer && $dom_available) ? Media::getInlineScript() : array()
            ));
            $javascript = $this->context->smarty->fetch(_PS_ALL_THEMES_DIR_.'javascript.tpl');
            $html = ($defer ? $html.$javascript : str_replace($js_tag, $javascript, $html)).$live_edit_content.((!isset($this->ajax) || ! $this->ajax) ? '</body></html>' : '');
        }
        PageCache::cacheThis($html, $this->getLayout());
        echo $html;
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    public function geolocationManagementPublic($default_country)
    {
        if (!in_array($_SERVER['SERVER_NAME'], array('localhost', '127.0.0.1'))) {
            if (@filemtime(_PS_GEOIP_DIR_._PS_GEOIP_CITY_FILE_)) {
                if (!isset($this->context->cookie->iso_code_country) || (isset($this->context->cookie->iso_code_country) && !in_array(Tools::strtoupper($this->context->cookie->iso_code_country), explode(';', Configuration::get('PS_ALLOWED_COUNTRIES'))))) {
                    include_once(_PS_GEOIP_DIR_.'geoipcity.inc');
                    $geoip_open_function = 'geoip_open';
                    $geoip_record_by_addr_function = 'geoip_record_by_addr';
                    $gi = $geoip_open_function(realpath(_PS_GEOIP_DIR_._PS_GEOIP_CITY_FILE_), GEOIP_STANDARD);
                    $record = $geoip_record_by_addr_function($gi, Tools::getRemoteAddr());
                    if (is_object($record)) {
                        $id_country = (int)Country::getByIso(Tools::strtoupper($record->country_code));
                        return new Country($id_country);
                    }
                }
            }
        }
        return $default_country;
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    public function isRestrictedCountry()
    {
        return $this->restrictedCountry;
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    public static function getCurrentCustomerGroups()
    {
        if (!is_array(self::$currentCustomerGroups))
        {
            if (!Group::isFeatureActive())
            {
                self::$currentCustomerGroups = array();
            }
            else
            {
                $context = Context::getContext();
                if (!isset($context->customer) || !$context->customer->id)
                {
                    self::$currentCustomerGroups = Customer::getGroupsStatic(null);
                }
                else
                {
                    self::$currentCustomerGroups = array();
                    $result = Db::getInstance()->executeS('SELECT id_group FROM '._DB_PREFIX_.'customer_group WHERE id_customer = '.(int)$context->customer->id);
                    foreach ($result as $row)
                        self::$currentCustomerGroups[] = $row['id_group'];
                }
            }
        }
        return self::$currentCustomerGroups;
    }
}
