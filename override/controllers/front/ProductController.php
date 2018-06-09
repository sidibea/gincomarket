<?php
class ProductController extends ProductControllerCore
{
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    public function init()
	{
		global $smarty;
		parent::init();
		if(Module::isInstalled('agilepricecomparison'))
		{
			$HOOK_AGILE_PRICE_COMPARISON = '';
			if(!intval(Configuration::get('AGILE_PC_USE_DEFAULT_HOOK')))
				$HOOK_AGILE_PRICE_COMPARISON = Module::hookExec('agilepricecomparison', array());
			$smarty->assign(array(	'HOOK_AGILE_PRICE_COMPARISON' => $HOOK_AGILE_PRICE_COMPARISON));
		}		
	}
	
		/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    public function preProcess()
	{
		if(!$this->listAllowed())
		{
			$this->errors[] = Tools::displayError('An error occurred while retrieving the product information');
		}
		parent::preProcess();
	}
	
	
		/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    public function initContent()
	{
		if(!$this->listAllowed())
		{
			$this->errors[] = Tools::displayError('An error occurred while retrieving the product information');
		}
		parent::initContent();
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:09
    * version: 3.0.6.2
    */
    private function listAllowed()
	{
		global $smarty;
		
	    if(Module::isInstalled('agilemultipleseller'))
	    {
			include_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/agilemultipleseller.php");
			include_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/SellerInfo.php");
	    
			$id_owner = AgileSellerManager::getObjectOwnerID('product',Tools::getValue('id_product'));
			$smarty->assign(
				array('id_seller' => $id_owner
			));
				if($id_owner > 0)
			{
				if(intval(Configuration::get('AGILE_MS_PRODUCT_APPROVAL'))==1)
				{
					$approved = AgileMultipleSeller::is_list_approved(Tools::getValue('id_product'));
					if($approved !=1)return false;
				}
								if(Module::isInstalled('agilesellerlistoptions'))
				{
					include_once(_PS_ROOT_DIR_ . "/modules/agilesellerlistoptions/agilesellerlistoptions.php");
					$listoption = AgileSellerListOptions::get_product_list_option(Tools::getValue('id_product'), AgileSellerListOptions::ASLO_OPTION_LIST);
					$liststatus = intval($listoption['status']);
					$aslo_list_prod_id = intval(Configuration::get('ASLO_PROD_FOR_OPTION' . AgileSellerListOptions::ASLO_OPTION_LIST));
					if($liststatus != AgileSellerListOptions::ASLO_STATUS_IN_EFFECT && $aslo_list_prod_id != AgileSellerListOptions::ASLO_ALWAYS_FREE)
    					return false;
				}
			}	
		}
		return true;		
	}
    /*
    * module: pagecache
    * date: 2018-05-31 11:39:46
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
                    $result[$hook_name . '_' . (int)$id_module] = Hook::exec($hook_name, array('product' => $this->product, 'category' => $this->category) , (int)$id_module);
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