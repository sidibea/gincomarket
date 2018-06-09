<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
class AdminProductsController extends AdminProductsControllerCore
{
    private $_approved_statuses;
    public function __construct()
	{
	    global $cookie;
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
    
	public function setMedia()
	{
		parent::setMedia();
		if(Module::isInstalled('agilesellerlistoptions'))
		{
			$this->addJS(array(
				_PS_ROOT_DIR_.'/modules/agilesellerlistoptions/js/listoptions.js'
				));
		}
	}
	
	public function initToolbar()
	{
		parent::initToolbar();
				if($this->is_seller)
		{
			unset($this->toolbar_btn['stats']);
		}
		
	}
	
	public function ajaxProcessProductManufacturers()
	{
		if(!Module::isInstalled('agilemultipleseller') || !$this->is_seller)
		{
			parent::ajaxProcessProductManufacturers();
			return;
		}

		$sql = 'SELECT id_manufacturer,name 
				FROM ' .  _DB_PREFIX_ . 'manufacturer m
					LEFT JOIN ' . _DB_PREFIX_ . 'object_owner oo ON (m.id_manufacturer = oo.id_object AND oo.entity=\'manufacturer\') 
				WHERE IFNULL(oo.id_owner,0) IN (0,' . (int)$this->context->cookie->id_employee . ')
				';
		
		$manufacturers = Db::getInstance()->ExecuteS($sql);
		$jsonArray = array();
		if ($manufacturers)
		{
			foreach ($manufacturers as $manufacturer)
			{
				$jsonArray[] = '{"optionValue": "'.(int)$manufacturer['id_manufacturer'].'", "optionDisplay": "'.htmlspecialchars(trim($manufacturer['name'])).'"}';
			}
		}

		die('['.implode(',', $jsonArray).']');
	}
	
	public function initContent()
	{
		$this->context->smarty->assign(array(
			'agilemultipleseller_isinstalled' => (Module::isInstalled('agilemultipleseller')?1:0),
			'agilesellerlistoptions_isinstalled' => (Module::isInstalled('agilesellerlistoptions')?1:0),
			'id_first_available_category' => AgileHelper::GetFirstAvailableCategory()
			));
	
		if(Module::isInstalled('agilemultipleseller'))
		{
			require_once(_PS_ROOT_DIR_ .'/modules/agilemultipleseller/agilemultipleseller.php');
			require_once(_PS_ROOT_DIR_ .'/modules/agilemultipleseller/SellerInfo.php');
			$this->context->smarty->assign(array(
	            'agilemultipleseller_hook' => _PS_ROOT_DIR_  . "/modules/agilemultipleseller/views/templates/hook/",
				'is_seller' => $this->is_seller,
				'id_seller' => AgileSellerManager::getObjectOwnerID($this->table, Tools::getValue('id_' . $this->table)),
				'sellers' => ($this->is_seller? null: AgileSellerManager::getSellersNV(true, $this->l('Public in store'))),
				'approveal_required' => intval(Configuration::get('AGILE_MS_PRODUCT_APPROVAL')),
				'approved' =>AgileMultipleSeller::is_list_approved(intval(Tools::getValue('id_product'))),
				'ajx_category_url' => AgileMultipleSeller::get_agile_ajax_categories_url()
				));
		}
		if(Module::isInstalled('agilesellerlistoptions'))
		{
			require_once(_PS_ROOT_DIR_ .'/modules/agilesellerlistoptions/agilesellerlistoptions.php');
			$aslo_module = new AgileSellerListOptions();
			$this->context->smarty->assign(array(
	            'agilesellerlistoptions_hook' => _PS_ROOT_DIR_  . "/modules/agilesellerlistoptions/views/templates/hook/",
				'HOOK_PRODYCT_LIST_OPTIONS' => $aslo_module->hookAgileAdminProductsFormTop(array('for_front'=>0,'id_product'=>Tools::getValue('id_' . $this->table)), $this->is_seller),
			));			
		}
		parent::initContent();
	}
	
	
	public function renderForm()
	{
		global $cookie;
		if(!intval(Tools::getValue('id_product')) AND $this->is_seller AND AgileSellerManager::limited_by_membership($cookie->id_employee))
		{
			$this->errors[] = Tools::displayError('You have not purchased membership yet or you have registered products more than limit allowed by your membership.');
			return;
		}
		
		return parent::renderForm() . $this->load_module_hooks();
	}
	
	private function load_module_hooks()
	{
		if($this->tab_display == 'VirtualProduct' AND Module::isInstalled('agilemediaplayer'))
		{
			require_once(_PS_ROOT_DIR_ . "/modules/agilemediaplayer/agilemediaplayer.php");
			return AgileMediaPlayer::jsForSampleUploader();
		}
	}
	
	public function postProcess()
	{
		if (Module::isInstalled('agilesellerlistoptions') && Tools::getValue('cancellistoptions') && !$this->is_seller)
		{
			require_once(_PS_ROOT_DIR_ .'/modules/agilesellerlistoptions/agilesellerlistoptions.php');
			AgileSellerListOptions::cancelListOptions(Tools::getValue('id_product'), Tools::getValue('cancellistoptions'));
			$redirecturl = "./index.php?controller=adminproducts&id_product=" . Tools::getValue('id_product') . "&updateproduct&token=" . Tools::getAdminTokenLite("AdminProducts");
			Tools::redirectAdmin($redirecturl);
			
		}
		if (Tools::isSubmit('submitBulkassigntoproduct') && !$this->is_seller)
		{
			if(isset($_POST[$this->table.'Box']))
			{
				$productids =  $_POST[$this->table.'Box'];
				foreach($productids AS $id)
				{
					if(intval($id)<=0)continue;
					AgileSellerManager::assignObjectOwner('product',$id, Tools::getValue("id_seller"));
				}
			}
			else
			{
				$this->errors[] = "No product was selected to assign.";
			}
			return;
		}

		parent::postProcess();
	}
	
	public function processAdd()
	{
		parent::processAdd();
		$this->processSellerExtensions();
		Hook::exec('actionProductAdd', array('product' => $this->object));
	}    

	public function processUpdate()
	{
		parent::processUpdate();
		$this->processSellerExtensions();
		Hook::exec('actionProductUpdate', array('product' => $this->object));
	}
	
	private function processSellerExtensions()
	{
		if(!$this->object)return;
		if(Module::isInstalled('agilemultipleseller'))
		{
			$approved = intval(Tools::getValue('approved'));
			
			if(intval(Configuration::get('AGILE_MS_PRODUCT_APPROVAL')) != 1)$approved = 1;
			$sql = 'UPDATE '._DB_PREFIX_.'product_owner SET approved=' . $approved . ' WHERE id_product=' . (int)$this->object->id;
			Db::getInstance()->Execute($sql); 
		}
		if(Module::isInstalled('agilesellerlistoptions'))
		{
			require_once(_PS_ROOT_DIR_ .'/modules/agilesellerlistoptions/agilesellerlistoptions.php');
			$aslo_module = new AgileSellerListOptions();
			$aslo_module->processProductExtenstions(array('product' => $this->object));
		}
		
	}
	
    
		protected function agilemultipleseller_list_override()
    {        
		global $cookie;
		if(!Module::isInstalled('agilemultipleseller'))return;
		
		parent::agilemultipleseller_list_override();
        $this->_approved_statuses = array('1' => $this->l('Yes'), '0' =>$this->l('No'));
		
				if(empty($this->_select) OR substr(trim($this->_select), -1) == "," )
		{
						$this->_select = $this->_select . 'IFNULL(ao.approved,0) AS approved';
		}
		else
		{
			$this->_select = $this->_select . ',IFNULL(ao.approved,0) AS approved';
		}

		if(Configuration::get('AGILE_MS_PRODUCT_APPROVAL') ==1)
			$this->fields_list['approved'] = array('title' => $this->l('Approved'), 'width' => 60,'type' => 'select','list' => $this->_approved_statuses, 'filter_key' => 'ao!approved');
		$this->fields_list['name']['width'] = 200;     }
    
	public function getList($id_lang, $orderBy = NULL,  $orderWay = NULL,  $start = 0, $limit = NULL, $id_lang_shop = false)
	{
		global $cookie;
		if(!$this->is_seller)
		{
			parent::getList($id_lang, $orderBy,  $orderWay,  $start = 0, $limit, $id_lang_shop);
		}
		else
		{
						parent::getList(intval($cookie->id_lang), !Tools::getValue($this->table.'Orderby') ? 'id_product' : NULL, !Tools::getValue($this->table.'Orderway') ? 'DESC' : NULL,  $start = 0, $limit, $id_lang_shop);
		}
        for($idx=0; $idx<count($this->_list) ;$idx++)
        {
            $approved = isset($this->_list[$idx]['approved'])?intval($this->_list[$idx]['approved']):0;
            $this->_list[$idx]['approved'] = $this->_approved_statuses[$approved];
        }
    }

	public function processDuplicate()
	{
		if(!Module::isInstalled('agilemultipleseller'))
		{
			parent::processDuplicate();
		} 
		else
		{
			if (Validate::isLoadedObject($product = new Product((int)Tools::getValue('id_product'))))
			{
				$id_product_old = $product->id;
				if (empty($product->price) && Shop::getContext() == Shop::CONTEXT_GROUP)
				{
					$shops = ShopGroup::getShopsFromGroup(Shop::getContextShopGroupID());
					foreach ($shops as $shop)
						if ($product->isAssociatedToShop($shop['id_shop']))
						{
							$product_price = new Product($id_product_old, false, null, $shop['id_shop']);
							$product->price = $product_price->price;
						}
				}
				unset($product->id);
				unset($product->id_product);
				$product->indexed = 0;
				$product->active = 0;
				if ($product->add()
				&& Category::duplicateProductCategories($id_product_old, $product->id)
				&& ($combination_images = Product::duplicateAttributes($id_product_old, $product->id)) !== false
				&& GroupReduction::duplicateReduction($id_product_old, $product->id)
				&& Product::duplicateAccessories($id_product_old, $product->id)
				&& Product::duplicateFeatures($id_product_old, $product->id)
				&& Product::duplicateSpecificPrices($id_product_old, $product->id)
				&& Pack::duplicate($id_product_old, $product->id)
				&& Product::duplicateCustomizationFields($id_product_old, $product->id)
				&& Product::duplicateTags($id_product_old, $product->id)
				&& Product::duplicateDownload($id_product_old, $product->id))
				{
					if ($product->hasAttributes())
						Product::updateDefaultAttribute($product->id);

										AgileSellerManager::assignObjectOwner('product',$product->id, AgileSellerManager::getObjectOwnerID('product', $id_product_old));

					if (!Tools::getValue('noimage') && !Image::duplicateProductImages($id_product_old, $product->id, $combination_images))
						$this->errors[] = Tools::displayError('An error occurred while copying images.');
					else
					{
						Hook::exec('actionProductAdd', array('product' => $product));
						if (in_array($product->visibility, array('both', 'search')) && Configuration::get('PS_SEARCH_INDEXATION'))
							Search::indexation(false, $product->id);
						$this->redirect_after = self::$currentIndex.(Tools::getIsset('id_category') ? '&id_category='.(int)Tools::getValue('id_category') : '').'&conf=19&token='.$this->token;
					}
				}
				else
					$this->errors[] = Tools::displayError('An error occurred while creating an object.');
			}
		}
	}
	
}

