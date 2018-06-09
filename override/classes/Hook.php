<?php
/**
 * Page Cache powered by Jpresta (jpresta . com)
 *
 *    @author    Jpresta
 *    @copyright Jpresta
 *    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
 *               is permitted for one Prestashop instance only but you can install it on your test instances.
 */
class Hook extends HookCore
{
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
            if (file_exists(dirname(__FILE__).'/../../modules/pagecache/pagecache.php'))
            {
                require_once(dirname(__FILE__).'/../../modules/pagecache/pagecache.php');
                self::$_is_page_cache_active = Module::isEnabled('pagecache');
            } else {
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
    public static function exec($hook_name, $hook_args = array(), $id_module = null, $array_return = false, $check_exceptions = true, $use_push = false, $id_shop = null)
    {
        if (Tools::version_compare(_PS_VERSION_,'1.6','>=')) {
            return self::exec_16($hook_name, $hook_args, $id_module, $array_return, $check_exceptions, $use_push, $id_shop);
        } else {
            return self::exec_15($hook_name, $hook_args, $id_module, $array_return, $check_exceptions);
        }
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    private static function exec_15($hook_name, $hook_args = array(), $id_module = null, $array_return = false, $check_exceptions = true)
    {
        if (Tools::getIsset('ajax') || strcmp('moduleRoutes', $hook_name) == 0 || !self::_isPageCacheActive()) {
            return parent::exec($hook_name, $hook_args, $id_module, $array_return, $check_exceptions);
        }
        if (($id_module && !is_numeric($id_module)) || !Validate::isHookName($hook_name))
            throw new PrestaShopException('Invalid id_module or hook_name');
        if (!$module_list = Hook::getHookModuleExecList($hook_name))
            return '';
        if (!$id_hook = Hook::getIdByName($hook_name))
            return false;
        Hook::$executed_hooks[$id_hook] = $hook_name;
        $live_edit = false;
        $context = Context::getContext();
        if (!isset($hook_args['cookie']) || !$hook_args['cookie'])
            $hook_args['cookie'] = $context->cookie;
        if (!isset($hook_args['cart']) || !$hook_args['cart'])
            $hook_args['cart'] = $context->cart;
        $retro_hook_name = Hook::getRetroHookName($hook_name);
        $altern = 0;
        $output = '';
        foreach ($module_list as $array)
        {
            if ($id_module && $id_module != $array['id_module'])
                continue;
            if (!($moduleInstance = Module::getInstanceByName($array['module'])))
                continue;
            if ($check_exceptions)
            {
                $exceptions = $moduleInstance->getExceptions($array['id_hook']);
                $controller = Dispatcher::getInstance()->getController();
                if (in_array($controller, $exceptions))
                    continue;
                $matching_name = array(
                    'authentication' => 'auth',
                    'compare' => 'products-comparison',
                );
                if (isset($matching_name[$controller]) && in_array($matching_name[$controller], $exceptions))
                    continue;
                if (Validate::isLoadedObject($context->employee) && !$moduleInstance->getPermission('view', $context->employee))
                    continue;
            }
            $dyn_hook_infos = false;
            if (self::_isPageCacheActive()) {
                $dyn_hook_infos = PageCache::getDynamicHookInfos($hook_name, $array['module']);
                if (!Tools::getIsset('ajax') && $dyn_hook_infos !== false)
                {
                    $output .= '<div class="dynhook pc_'.$hook_name.'_'.$array['id_module'].'" data-hook="'.$hook_name.'" data-module="'.$array['id_module'].'">';
                    $output .= '<div class="loadingempty"></div>';
                }
            }
            if (!self::_isPageCacheActive() || !PageCache::canBeCached() || $dyn_hook_infos === false || !$dyn_hook_infos['empty_box']) {
            $hook_callable = is_callable(array($moduleInstance, 'hook'.$hook_name));
            $hook_retro_callable = is_callable(array($moduleInstance, 'hook'.$retro_hook_name));
            if (($hook_callable || $hook_retro_callable) && Module::preCall($moduleInstance->name))
            {
                $hook_args['altern'] = ++$altern;
                if ($hook_callable)
                    $display = $moduleInstance->{'hook'.$hook_name}($hook_args);
                elseif ($hook_retro_callable)
                    $display = $moduleInstance->{'hook'.$retro_hook_name}($hook_args);
                if (!$array_return && $array['live_edit'] && Tools::isSubmit('live_edit') && Tools::getValue('ad') && Tools::getValue('liveToken') == Tools::getAdminToken('AdminModulesPositions'.(int)Tab::getIdFromClassName('AdminModulesPositions').(int)Tools::getValue('id_employee')))
                {
                    $live_edit = true;
                    $output .= self::wrapLiveEdit($display, $moduleInstance, $array['id_hook']);
                }
                elseif ($array_return)
                    $output[] = $display;
                else
                    $output .= $display;
            }
            }
            if (self::_isPageCacheActive()) {
                if (!Tools::getIsset('ajax') && $dyn_hook_infos !== false)
                {
                    $output .= '</div>';
                }
            }
        }
        if ($array_return)
            return $output;
        else
            return ($live_edit ? '<script type="text/javascript">hooks_list.push(\''.$hook_name.'\');</script>
                <div id="'.$hook_name.'" class="dndHook" style="min-height:50px">' : '').$output.($live_edit ? '</div>' : '');// Return html string
    }
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    private static function exec_16($hook_name, $hook_args = array(), $id_module = null, $array_return = false, $check_exceptions = true, $use_push = false, $id_shop = null)
    {
        if (Tools::getIsset('ajax') || strcmp('moduleRoutes', $hook_name) == 0 || !self::_isPageCacheActive()) {
            return parent::exec($hook_name, $hook_args, $id_module, $array_return, $check_exceptions, $use_push = false, $id_shop = null);
        }
        static $disable_non_native_modules = null;
        if ($disable_non_native_modules === null)
            $disable_non_native_modules = (bool)Configuration::get('PS_DISABLE_NON_NATIVE_MODULE');
        if (($id_module && !is_numeric($id_module)) || !Validate::isHookName($hook_name))
            throw new PrestaShopException('Invalid id_module or hook_name');
        if (!$module_list = Hook::getHookModuleExecList($hook_name))
            return '';
        if (!$id_hook = Hook::getIdByName($hook_name))
            return false;
        Hook::$executed_hooks[$id_hook] = $hook_name;
        $live_edit = false;
        $context = Context::getContext();
        if (!isset($hook_args['cookie']) || !$hook_args['cookie'])
            $hook_args['cookie'] = $context->cookie;
        if (!isset($hook_args['cart']) || !$hook_args['cart'])
            $hook_args['cart'] = $context->cart;
        $retro_hook_name = Hook::getRetroHookName($hook_name);
        $altern = 0;
        $output = '';
        if ($disable_non_native_modules && !isset(Hook::$native_module))
            Hook::$native_module = Module::getNativeModuleList();
        $different_shop = false;
        if ($id_shop !== null && Validate::isUnsignedId($id_shop) && $id_shop != $context->shop->getContextShopID())
        {
            $old_context = $context->shop->getContext();
            $old_shop = clone $context->shop;
            $shop = new Shop((int)$id_shop);
            if (Validate::isLoadedObject($shop))
            {
                $context->shop = $shop;
                $context->shop->setContext(Shop::CONTEXT_SHOP, $shop->id);
                $different_shop = true;
            }
        }
        $since16011 = method_exists('Module', 'getExceptionsStatic');
        foreach ($module_list as $array)
        {
            if ($id_module && $id_module != $array['id_module'])
                continue;
            if ((bool)$disable_non_native_modules && Hook::$native_module && count(Hook::$native_module) && !in_array($array['module'], self::$native_module))
                continue;
            if (!$since16011) {
                if (!($moduleInstance = Module::getInstanceByName($array['module'])))
                    continue;
            }
            if ($check_exceptions)
            {
                if (!$since16011) {
                    $exceptions = $moduleInstance->getExceptions($array['id_hook']);
                } else {
                    $exceptions = Module::getExceptionsStatic($array['id_module'], $array['id_hook']);
                }
                $controller = Dispatcher::getInstance()->getController();
                $controller_obj = Context::getContext()->controller;
                if (isset($controller_obj->module) && Validate::isLoadedObject($controller_obj->module))
                    $controller = 'module-'.$controller_obj->module->name.'-'.$controller;
                if (in_array($controller, $exceptions))
                    continue;
                $matching_name = array(
                        'authentication' => 'auth',
                        'productscomparison' => 'compare'
                );
                if (isset($matching_name[$controller]) && in_array($matching_name[$controller], $exceptions))
                    continue;
                if (Validate::isLoadedObject($context->employee) && !Module::getPermissionStatic($array['id_module'], 'view', $context->employee))
                    continue;
            }
            if ($since16011) {
                if (!($moduleInstance = Module::getInstanceByName($array['module'])))
                    continue;
            }
            if ($use_push && !$moduleInstance->allow_push)
                continue;
            $dyn_hook_infos = false;
            if (self::_isPageCacheActive()) {
                $dyn_hook_infos = PageCache::getDynamicHookInfos($hook_name, $array['module']);
                if (!Tools::getIsset('ajax') && $dyn_hook_infos !== false)
                {
                    $output .= '<div class="dynhook pc_'.$hook_name.'_'.$array['id_module'].'" data-hook="'.$hook_name.'" data-module="'.$array['id_module'].'">';
                    $output .= '<div class="loadingempty"></div>';
                }
            }
            if (!self::_isPageCacheActive() || !PageCache::canBeCached() || $dyn_hook_infos === false || !$dyn_hook_infos['empty_box']) {
            $hook_callable = is_callable(array($moduleInstance, 'hook'.$hook_name));
            $hook_retro_callable = is_callable(array($moduleInstance, 'hook'.$retro_hook_name));
            if (($hook_callable || $hook_retro_callable) && Module::preCall($moduleInstance->name))
            {
                $hook_args['altern'] = ++$altern;
                if ($use_push && isset($moduleInstance->push_filename) && file_exists($moduleInstance->push_filename))
                    Tools::waitUntilFileIsModified($moduleInstance->push_filename, $moduleInstance->push_time_limit);
                if ($hook_callable)
                    $display = $moduleInstance->{'hook'.$hook_name}($hook_args);
                elseif ($hook_retro_callable)
                $display = $moduleInstance->{'hook'.$retro_hook_name}($hook_args);
                if (!$array_return && $array['live_edit'] && Tools::isSubmit('live_edit') && Tools::getValue('ad') && Tools::getValue('liveToken') == Tools::getAdminToken('AdminModulesPositions'.(int)Tab::getIdFromClassName('AdminModulesPositions').(int)Tools::getValue('id_employee')))
                {
                    $live_edit = true;
                    $output .= self::wrapLiveEdit($display, $moduleInstance, $array['id_hook']);
                }
                elseif ($array_return)
                    $output[$moduleInstance->name] = $display;
                else
                    $output .= $display;
            }
            }
            if (self::_isPageCacheActive()) {
                if (!Tools::getIsset('ajax') && $dyn_hook_infos !== false)
                {
                    $output .= '</div>';
                }
            }
        }
        if ($different_shop)
        {
            $context->shop = $old_shop;
            $context->shop->setContext($old_context, $shop->id);
        }
        if ($array_return)
            return $output;
        else
            return ($live_edit ? '<script type="text/javascript">hooks_list.push(\''.$hook_name.'\');</script>
                <div id="'.$hook_name.'" class="dndHook" style="min-height:50px">' : '').$output.($live_edit ? '</div>' : '');// Return html string
    }
}
