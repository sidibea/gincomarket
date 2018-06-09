<?php
class CmsController extends CmsControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    public function __construct()
	{
		parent::__construct();
		if(Module::isInstalled('agilemultipleseller'))
		{
			$seller_terms_id = (int)Tools::getValue('id_cms');
			if($seller_terms_id == (int)Configuration::get('AGILE_MS_SELLER_TERMS'))
			{
				$seller_terms = new CMS($seller_terms_id, $this->context->language->id);
				if (Configuration::get('PS_SSL_ENABLED') && Tools::getValue('content_only') &&  Validate::isLoadedObject($seller_terms))
					$this->ssl = true;		
			}
		}
	}
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:45
    * version: 4.22
    */
    public function displayAjax()
    {
        $this->initHeader();
        $result = array();
        $index = 0;
        do
        {
            $val = Tools::getValue('hook_' . $index);
            if ($val !== false)
            {
                list($hook_name, $id_module) = explode('|', $val);
                if (Validate::isHookName($hook_name)) {
                    $result[$hook_name . '_' . (int)$id_module] = Hook::exec($hook_name, array() , (int)$id_module);
                }
            }
            $index++;
        } while ($val !== false);
        if (Tools::version_compare(_PS_VERSION_,'1.6','>')) {
            Media::addJsDef(array(
                'isLogged' => (bool)$this->context->customer->isLogged(),
                'isGuest' => (bool)$this->context->customer->isGuest(),
                'comparedProductsIds' => $this->context->smarty->getTemplateVars('compared_products'),
            ));
            $defs = Media::getJsDef();
            unset($defs['baseDir']);
            unset($defs['baseUrl']);
            $this->context->smarty->assign(array(
                'js_def' => $defs,
            ));
            $result['js'] = $this->context->smarty->fetch(_PS_ALL_THEMES_DIR_.'javascript.tpl');
        }
        $this->context->cookie->write();
        header('Content-Type: application/json');
        header('Cache-Control: no-cache');
        header('X-Robots-Tag: noindex');
        die(Tools::jsonEncode($result));
    }
}
