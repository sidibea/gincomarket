<?php
class AdminCategoriesController extends AdminCategoriesControllerCore
{
    /*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:08
    * version: 3.0.6.2
    */
    public function __construct()
	{
		$id_seller_home = AgileSellerManager::get_current_logged_seller_home_category_id();
		$id_category = intval(Tools::getValue('id_category'));
		$id_parent = intval(Tools::getValue('id_parent'));
		if($id_seller_home > 0)
		{
			$url2sellerhome = "./index.php?controller=AdminCategories&id_category=" . $id_seller_home . "&viewcategory&token=" . Tools::getAdminTokenLite("AdminCategories");
			if( $id_category== 0 && $id_parent==0)
			{
				Tools::redirectAdmin($url2sellerhome);
			}
			if($id_category >0 && $id_category != $id_seller_home && !AgileHelper::isSuccessor($id_seller_home, $id_category))
			{
				Tools::redirectAdmin($url2sellerhome);
			}			
			if($id_parent >0 && $id_parent != $id_seller_home && !AgileHelper::isSuccessor($id_seller_home, $id_category))
			{
				Tools::redirectAdmin($url2sellerhome);
			}
		}
		parent::__construct();
		
		if(Module::isInstalled('agilemultipleseller'))
		{
			$this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items?')));
			if(!$this->is_seller)
				$this->bulk_actions['assignto'] = array('text' => $this->l('Assign to seller'), 'confirm' => $this->l('Assign selected items to the seller?'));
		}
		
		if(Module::isInstalled('agilemultipleseller'))
		{
			$this->agilemultipleseller_list_override();
		}
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:08
    * version: 3.0.6.2
    */
    public function initContent()
	{
		if(Module::isInstalled('agilemultipleseller'))
		{
			$this->context->smarty->assign(array(
				'sellers' => ($this->is_seller? null: AgileSellerManager::getSellersNV(true, $this->l('Public in store'))),
				));
		}
		parent::initContent();
	}
	
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:08
    * version: 3.0.6.2
    */
    public function initToolbar()
	{
		if(Module::isInstalled('agilemultipleseller') AND $this->is_seller AND intval(Configuration::get('AGILE_MS_EDIT_CATEGORY'))==0)return;
		parent::initToolbar();
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:08
    * version: 3.0.6.2
    */
    public function init()
	{
		parent::init();
		if(!Module::isInstalled('agilemultipleseller'))return;
				$id_owner = AgileSellerManager::getObjectOwnerID('category',Tools::getValue('id_category'));
		$this->context->smarty->assign(array(
			'show_assign_product_button' => ((!$this->is_seller AND $id_owner > 0)?1:0)
		));
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:08
    * version: 3.0.6.2
    */
    public function renderForm()
	{
		if($this->is_seller && (Tools::getIsset('updatecategory') || Tools::getIsset('addcategory')) && !(int)Configuration::get('AGILE_MS_EDIT_CATEGORY'))
		{
			$this->errors[]  = Tools::displayError('You do not have permission to add/edit category');
			return;
		}		
		return parent::renderForm();
	}
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:08
    * version: 3.0.6.2
    */
    protected function agilemultipleseller_list_override()
    {        
		global $cookie;
		
		if(!Module::isInstalled('agilemultipleseller'))return;	
		parent::agilemultipleseller_list_override();
		
		if($this->is_seller)
		{
			require_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/agilemultipleseller.php");
			$specialcid = AgileMultipleSeller::getSpecialCatrgoryIds();
			if(!empty($specialcid))
				$this->_where = $this->_where . ' AND a.id_category NOT IN (' . $specialcid . ')';
		}
	}
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:08
    * version: 3.0.6.2
    */
    public function postProcess()
	{
		if(Module::isInstalled('agilemultipleseller') AND isset($_POST['assign_all_products']) AND intval($_POST['assign_all_products']) ==1 AND !$this->is_seller)
		{
			AgileSellerManager::assign_all_products_under_category(Tools::getValue('id_category'));
			$this->confirmations[] = $this->l('You requested has been executed successfully.');
		}
		
		if (Tools::isSubmit('submitBulkassigntocategory') && !$this->is_seller)
		{
			if(isset($_POST[$this->table.'Box']))
			{
				$categoryids =  $_POST[$this->table.'Box'];
				foreach($categoryids AS $id)
				{
					if(intval($id)<=0)continue;
					AgileSellerManager::assignObjectOwner('category',$id, Tools::getValue("id_seller"));
				}
			}
			else
			{
				$this->errors[] = "No categories was selected to assign.";
			}
			return;
		}
		
		parent::postProcess();
	}
	
	
	/*
    * module: agilemultipleseller
    * date: 2017-05-22 04:42:08
    * version: 3.0.6.2
    */
    public function getList($id_lang, $orderBy = NULL,  $orderWay = NULL,  $start = 0, $limit = NULL, $id_lang_shop = false)
	{
				$this->fields_list['description']['filter_key'] = 'b!description';				
		parent::getList($id_lang, $orderBy, $orderWay, $start, $limit);
		if(Module::isInstalled('agilemultipleseller') AND $this->is_seller AND intval(Configuration::get('AGILE_MS_EDIT_CATEGORY'))==0)
		{
			$this->actions = array('view');	
			$this->bulk_actions = array();
		}
	}
	
}
