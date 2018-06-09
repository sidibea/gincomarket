<?php
class Dispatcher extends DispatcherCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    protected function __construct()
	{
		if(Module::isInstalled('agilemultipleshop'))
		{
			include_once(_PS_ROOT_DIR_ ."/modules/agilemultipleshop/agilemultipleshop.php");
			$this->default_routes = array_merge($this->default_routes, AgileMultipleShop::get_rewrite_rules());			
		}
		if(Module::isInstalled('agileshowcasemanager'))
		{
			include_once(_PS_ROOT_DIR_ ."/modules/agileshowcasemanager/agileshowcasemanager.php");
			$this->default_routes = array_merge($this->default_routes, AgileShowcaseManager::get_rewrite_rules());			
		}
		
		parent::__construct();
	}	
	
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:06
    * version: 3.0.6.2
    */
    public function createUrl($route_id, $id_lang = null, array $params = array(), $force_routes = false, $anchor = '', $id_shop = null)
	{
		
		global $link;
		if($route_id =="agilesellers")
		{
			return $link->getAgileSellersLink(Tools::getValue('filter'),$id_lang, Tools::getValue('loclevel'), Tools::getValue('parentid'));
		}
		if($route_id =="sellerlocation")
		{
			return $link->getSellerLocationLink(Tools::getValue('$id_location'), Tools::getValue('location_level'), NULL, $id_lang);
		}
		if($route_id =="sellercountry")
		{
						return $link->getSellerCountryLink(Tools::getValue('id_seller_country'), NULL, $id_lang);
		}		
		
		return parent::createUrl($route_id, $id_lang, $params, $force_routes, $anchor);
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
    public $page_cache_start_time = -1;
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    private static function _isPageCacheActive()
    {
        if (self::$_is_page_cache_active == -1)
        {
            if (file_exists(dirname(__FILE__).'/../../modules/pagecache/pagecache.php'))
            {
                require_once(dirname(__FILE__).'/../../modules/pagecache/pagecache.php');
                self::$_is_page_cache_active = Module::isEnabled('pagecache');
            } else {
                Logger::addLog('Page cache has not been well uninstalled, please, remove manually the following functions in file '.__FILE__.': _isPageCacheActive(), dispatch(), dispatch_15() and dispatch_16(). If you need help contact our support.', 4);
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
    public function getControllerFromURL($url, $id_shop = null) {
        $controller = false;
        $is_fc_module = false;
        if (isset(Context::getContext()->shop) && $id_shop === null)
            $id_shop = (int)Context::getContext()->shop->id;
        $query = parse_url($url, PHP_URL_QUERY);
        if ($query) {
            $query = html_entity_decode($query);
            $keyvaluepairs = explode('&', $query);
            if ($keyvaluepairs !== false) {
                foreach($keyvaluepairs as $keyvaluepair) {
                    if (strstr($keyvaluepair, '=') !== false) {
                        list($key, $value) = explode('=', $keyvaluepair);
                        if (strcmp('controller', $key) === 0) {
                            $controller = $value;
                        }
                        elseif (strcmp('fc', $key) === 0) {
                            $is_fc_module = strcmp('module', $value) !== false;
                        }
                    }
                }
            }
        }
        if (!Validate::isControllerName($controller))
            $controller = false;
        if (!$controller && $this->use_routes) {
            $url_without_lang = $url;
            if (isset($this->routes[$id_shop][Context::getContext()->language->id])) {
                foreach ($this->routes[$id_shop][Context::getContext()->language->id] as $route) {
                    if (preg_match($route['regexp'], $url_without_lang, $m)) {
                        $controller = $route['controller'] ? $route['controller'] : false;
                        if (preg_match('#module-([a-z0-9_-]+)-([a-z0-9_]+)$#i', $controller, $m)) {
                            $controller = $m[2];
                        }
                        if ($is_fc_module)
                            $controller = false;
                        break;
                    }
                }
            }
            if (!$controller && Tools::strlen($url_without_lang) == 0) {
                $controller = 'index';
            }
            elseif ($controller == 'index' || preg_match('/^\/index.php(?:\?.*)?$/', $url_without_lang)) {
                if ($is_fc_module) {
                    $controller = false;
                }
            }
        }
        return $controller;
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    public function dispatch() {
        if (Tools::version_compare(_PS_VERSION_,'1.6','>=')) {
            $this->dispatch_16();
        } else {
            $this->dispatch_15();
        }
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    private function dispatch_15()
    {
        $this->getController();
        if (!$this->controller)
            $this->controller = $this->default_controller;
        $this->page_cache_start_time = microtime(true);
        if ($this->_isPageCacheActive())
        {
            $pre_display_html = PageCache::preDisplayStats();
            if (PageCache::displayCacheIfExists())
            {
                PageCache::displayStats(true, $pre_display_html);
                return;
            }
        }
        $controller_class = '';
        switch ($this->front_controller)
        {
            case self::FC_FRONT :
                $controllers = Dispatcher::getControllers(array(_PS_FRONT_CONTROLLER_DIR_, _PS_OVERRIDE_DIR_.'controllers/front/'));
                $controllers['index'] = 'IndexController';
                if (isset($controllers['auth']))
                    $controllers['authentication'] = $controllers['auth'];
                if (isset($controllers['compare']))
                    $controllers['productscomparison'] = $controllers['compare'];
                if (isset($controllers['contact']))
                    $controllers['contactform'] = $controllers['contact'];
                if (!isset($controllers[Tools::strtolower($this->controller)]))
                    $this->controller = $this->controller_not_found;
                $controller_class = $controllers[Tools::strtolower($this->controller)];
                $params_hook_action_dispatcher = array('controller_type' => self::FC_FRONT, 'controller_class' => $controller_class, 'is_module' => 0);
            break;
            case self::FC_MODULE :
                $module_name = Validate::isModuleName(Tools::getValue('module')) ? Tools::getValue('module') : '';
                $module = Module::getInstanceByName($module_name);
                $controller_class = 'PageNotFoundController';
                if (Validate::isLoadedObject($module) && $module->active)
                {
                    $controllers = Dispatcher::getControllers(_PS_MODULE_DIR_.$module_name.'/controllers/front/');
                    if (isset($controllers[Tools::strtolower($this->controller)]))
                    {
                        include_once(_PS_MODULE_DIR_.$module_name.'/controllers/front/'.$this->controller.'.php');
                        $controller_class = $module_name.$this->controller.'ModuleFrontController';
                    }
                }
                $params_hook_action_dispatcher = array('controller_type' => self::FC_FRONT, 'controller_class' => $controller_class, 'is_module' => 1);
            break;
            case self::FC_ADMIN :
                $tab = Tab::getInstanceFromClassName($this->controller);
                $retrocompatibility_admin_tab = null;
                if ($tab->module)
                {
                    if (file_exists(_PS_MODULE_DIR_.$tab->module.'/'.$tab->class_name.'.php'))
                        $retrocompatibility_admin_tab = _PS_MODULE_DIR_.$tab->module.'/'.$tab->class_name.'.php';
                    else
                    {
                        $controllers = Dispatcher::getControllers(_PS_MODULE_DIR_.$tab->module.'/controllers/admin/');
                        if (!isset($controllers[Tools::strtolower($this->controller)]))
                        {
                            $this->controller = $this->controller_not_found;
                            $controller_class = 'AdminNotFoundController';
                        }
                        else
                        {
                            include_once(_PS_MODULE_DIR_.$tab->module.'/controllers/admin/'.$controllers[Tools::strtolower($this->controller)].'.php');
                            $controller_class = $controllers[Tools::strtolower($this->controller)].(strpos($controllers[Tools::strtolower($this->controller)], 'Controller') ? '' : 'Controller');
                        }
                    }
                    $params_hook_action_dispatcher = array('controller_type' => self::FC_ADMIN, 'controller_class' => $controller_class, 'is_module' => 1);
                }
                else
                {
                    $controllers = Dispatcher::getControllers(array(_PS_ADMIN_DIR_.'/tabs/', _PS_ADMIN_CONTROLLER_DIR_, _PS_OVERRIDE_DIR_.'controllers/admin/'));
                    if (!isset($controllers[Tools::strtolower($this->controller)]))
                        $this->controller = $this->controller_not_found;
                    $controller_class = $controllers[Tools::strtolower($this->controller)];
                    $params_hook_action_dispatcher = array('controller_type' => self::FC_ADMIN, 'controller_class' => $controller_class, 'is_module' => 0);
                    if (file_exists(_PS_ADMIN_DIR_.'/tabs/'.$controller_class.'.php'))
                        $retrocompatibility_admin_tab = _PS_ADMIN_DIR_.'/tabs/'.$controller_class.'.php';
                }
                if ($retrocompatibility_admin_tab)
                {
                    include_once($retrocompatibility_admin_tab);
                    include_once(_PS_ADMIN_DIR_.'/functions.php');
                    runAdminTab($this->controller, !empty($_REQUEST['ajaxMode']));
                    return;
                }
            break;
            default :
                throw new PrestaShopException('Bad front controller chosen');
        }
        try
        {
            $controller = Controller::getController($controller_class);
            if (isset($params_hook_action_dispatcher))
                Hook::exec('actionDispatcher', $params_hook_action_dispatcher);
            $controller->run();
            if ($this->_isPageCacheActive())
            {
                PageCache::displayStats(false, $pre_display_html);
            }
        }
        catch (PrestaShopException $e)
        {
            $e->displayMessage();
        }
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    private function dispatch_16()
    {
        $controller_class = '';
        $this->getController();
        if (!$this->controller) {
            if (!method_exists($this, 'useDefaultController'))
                $this->controller = $this->default_controller;
            else
                $this->controller = $this->useDefaultController();
        }
        $this->page_cache_start_time = microtime(true);
        if ($this->_isPageCacheActive())
        {
            $pre_display_html = PageCache::preDisplayStats();
            if (PageCache::displayCacheIfExists())
            {
                PageCache::displayStats(true, $pre_display_html);
                return;
            }
        }
        switch ($this->front_controller)
        {
            case self::FC_FRONT :
                $controllers = Dispatcher::getControllers(array(_PS_FRONT_CONTROLLER_DIR_, _PS_OVERRIDE_DIR_.'controllers/front/'));
                $controllers['index'] = 'IndexController';
                if (isset($controllers['auth']))
                    $controllers['authentication'] = $controllers['auth'];
                if (isset($controllers['compare']))
                    $controllers['productscomparison'] = $controllers['compare'];
                if (isset($controllers['contact']))
                    $controllers['contactform'] = $controllers['contact'];
                if (!isset($controllers[Tools::strtolower($this->controller)]))
                    $this->controller = $this->controller_not_found;
                $controller_class = $controllers[Tools::strtolower($this->controller)];
                $params_hook_action_dispatcher = array('controller_type' => self::FC_FRONT, 'controller_class' => $controller_class, 'is_module' => 0);
                break;
            case self::FC_MODULE :
                $module_name = Validate::isModuleName(Tools::getValue('module')) ? Tools::getValue('module') : '';
                $module = Module::getInstanceByName($module_name);
                $controller_class = 'PageNotFoundController';
                if (Validate::isLoadedObject($module) && $module->active)
                {
                    $controllers = Dispatcher::getControllers(_PS_MODULE_DIR_.$module_name.'/controllers/front/');
                    if (isset($controllers[Tools::strtolower($this->controller)]))
                    {
                        include_once(_PS_MODULE_DIR_.$module_name.'/controllers/front/'.$this->controller.'.php');
                        $controller_class = $module_name.$this->controller.'ModuleFrontController';
                    }
                }
                $params_hook_action_dispatcher = array('controller_type' => self::FC_FRONT, 'controller_class' => $controller_class, 'is_module' => 1);
                break;
            case self::FC_ADMIN :
                if ($this->use_default_controller && !Tools::getValue('token') && Validate::isLoadedObject(Context::getContext()->employee) && Context::getContext()->employee->isLoggedBack())
                    Tools::redirectAdmin('index.php?controller='.$this->controller.'&token='.Tools::getAdminTokenLite($this->controller));
                $tab = Tab::getInstanceFromClassName($this->controller, Configuration::get('PS_LANG_DEFAULT'));
                $retrocompatibility_admin_tab = null;
                if ($tab->module)
                {
                    if (file_exists(_PS_MODULE_DIR_.$tab->module.'/'.$tab->class_name.'.php'))
                        $retrocompatibility_admin_tab = _PS_MODULE_DIR_.$tab->module.'/'.$tab->class_name.'.php';
                    else
                    {
                        $controllers = Dispatcher::getControllers(_PS_MODULE_DIR_.$tab->module.'/controllers/admin/');
                        if (!isset($controllers[Tools::strtolower($this->controller)]))
                        {
                            $this->controller = $this->controller_not_found;
                            $controller_class = 'AdminNotFoundController';
                        }
                        else
                        {
                            include_once(_PS_MODULE_DIR_.$tab->module.'/controllers/admin/'.$controllers[Tools::strtolower($this->controller)].'.php');
                            $controller_class = $controllers[Tools::strtolower($this->controller)].(strpos($controllers[Tools::strtolower($this->controller)], 'Controller') ? '' : 'Controller');
                        }
                    }
                    $params_hook_action_dispatcher = array('controller_type' => self::FC_ADMIN, 'controller_class' => $controller_class, 'is_module' => 1);
                }
                else
                {
                    $controllers = Dispatcher::getControllers(array(_PS_ADMIN_DIR_.'/tabs/', _PS_ADMIN_CONTROLLER_DIR_, _PS_OVERRIDE_DIR_.'controllers/admin/'));
                    if (!isset($controllers[Tools::strtolower($this->controller)]))
                    {
                        if (Validate::isLoadedObject($tab) && $tab->id_parent == 0 && ($tabs = Tab::getTabs(Context::getContext()->language->id, $tab->id)) && isset($tabs[0]))
                            Tools::redirectAdmin(Context::getContext()->link->getAdminLink($tabs[0]['class_name']));
                        $this->controller = $this->controller_not_found;
                    }
                    $controller_class = $controllers[Tools::strtolower($this->controller)];
                    $params_hook_action_dispatcher = array('controller_type' => self::FC_ADMIN, 'controller_class' => $controller_class, 'is_module' => 0);
                    if (file_exists(_PS_ADMIN_DIR_.'/tabs/'.$controller_class.'.php'))
                        $retrocompatibility_admin_tab = _PS_ADMIN_DIR_.'/tabs/'.$controller_class.'.php';
                }
                if ($retrocompatibility_admin_tab)
                {
                    include_once($retrocompatibility_admin_tab);
                    include_once(_PS_ADMIN_DIR_.'/functions.php');
                    runAdminTab($this->controller, !empty($_REQUEST['ajaxMode']));
                    return;
                }
                break;
            default :
                throw new PrestaShopException('Bad front controller chosen');
        }
        try
        {
            $controller = Controller::getController($controller_class);
            if (isset($params_hook_action_dispatcher))
                Hook::exec('actionDispatcher', $params_hook_action_dispatcher);
            $controller->run();
            if ($this->_isPageCacheActive())
            {
                PageCache::displayStats(false, $pre_display_html);
            }
        }
        catch (PrestaShopException $e)
        {
            $e->displayMessage();
        }
    }
}
