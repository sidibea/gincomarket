<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.

class IndexController extends IndexControllerCore
{
	public $php_self = 'index';
	public $authRedirection = 'index';
	
	protected $seller;
	protected $seller_info;
	protected $id_seller;

	public function setMedia()
	{
		parent::setMedia();
		if(Module::isInstalled('agilemultipleshop') && Shop::$id_shop_owner>0)
		{		
			Context::getContext()->controller->addCSS(array(
					_PS_CSS_DIR_.'jquery.cluetip.css' => 'all',
					_MODULE_DIR_.'category.css' => 'all',
					_THEME_CSS_DIR_.'product_list.css' => 'all'));

			if (Configuration::get('PS_COMPARATOR_MAX_ITEM') > 0)
			{
				$this->addJS(_THEME_JS_DIR_.'products-comparison.js');
			}
		}
	}

	
	public function init()
	{
		if(Module::isInstalled('agilemultipleshop') && Shop::$id_shop_owner>0)
		{		
			$this->display_column_left = ((int)Configuration::get('ASP_HOME_COLUMN_LEFT') == 1);
			$this->display_column_right = ((int)Configuration::get('ASP_HOME_COLUMN_RIGHT') == 1);
		}
		
		parent::init();
		
		if(Module::isInstalled('agilemultipleshop') && Shop::$id_shop_owner>0)
		{		
			$this->productSort();
			
			require_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/agilemultipleseller.php");
			require_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/SellerInfo.php");
			require_once(_PS_ROOT_DIR_ . "/modules/agilemultipleshop/agilemultipleshop.php");

			$this->id_seller = (int)Tools::getValue('id_seller');
			if(_PS_VERSION_ > '1.5' AND $this->id_seller <=0)$this->id_seller = Shop::$id_shop_owner;
			if ($this->id_seller)
			{
				$this->seller = new Employee($this->id_seller);
				$this->seller_info = new SellerInfo(SellerInfo::getIdBSellerId($this->id_seller), self::$cookie->id_lang);
			}
		}
	}
	
	public function initContent()
	{
		parent::initContent();
		if(Module::isInstalled('agilemultipleshop') && Shop::$id_shop_owner>0)
		{		
			$this->processData();
			$this->setTemplate(_PS_ROOT_DIR_.'/modules/agilemultipleshop/views/templates/front/agileseller.tpl');
		}
	}
				
	public function processData()
	{
		
		if(Module::isInstalled('agilemultipleshop') && Shop::$id_shop_owner>0)
		{
			if (!Validate::isLoadedObject($this->seller))
				$this->errors[] = Tools::displayError('Seller does not exist');
			elseif (!$this->seller->active)
				self::$smarty->assign('seller', $this->seller);
			else
			{
				$rewrited_url = self::$link->getAgileSellerLink((int)$this->seller->id, $this->getSellerLinkRwrite());

				$this->seller_info->description = (_PS_VERSION_ > '1.5' ? Tools::nl2br($this->seller_info->description) : nl2br2($this->seller_info->description));

				self::$smarty->assign('seller', $this->seller);	
				self::$smarty->assign('seller_info', $this->seller_info);
				
				$sellermodule = new AgileMultipleSeller();
				$conf = Configuration::getMultiple($sellermodule->getCustomFields());
				$custom_labels = $sellermodule->getCustomLabels();
				self::$smarty->assign('conf', $conf);
				self::$smarty->assign('custom_labels', $custom_labels);
					
				$nbProducts = $this->getProducts(NULL, NULL, NULL, $this->orderBy, $this->orderWay, true);
				$this->pagination((int)$nbProducts);
				self::$smarty->assign('nb_products', (int)$nbProducts);
				$seller_products = $this->getProducts((int)(self::$cookie->id_lang), (int)($this->p), (int)($this->n), $this->orderBy, $this->orderWay);
				AgileHelper::AssignProductImgs($seller_products);

				$si_1531_later = version_compare(_PS_VERSION_, '1.5.3.1', ">=");
				
				$HOOK_SELLER_RATINGS = '';
				if(Module::isInstalled('agilesellerratings'))
				{
					require_once(_PS_ROOT_DIR_ . "/modules/agilesellerratings/agilesellerratings.php");
					$rmodule = new AgileSellerRatings();
					$HOOK_SELLER_RATINGS = $rmodule->getAverageRating($this->id_seller,  AgileSellerRatings::RATING_TYPE_SELLER);
				}

				self::$smarty->assign(array(
					'products' => (isset($seller_products) AND $seller_products) ? $seller_products : NULL,
					'id_seller' => (int)($this->seller->id),
					'path' => $this->seller_info->company,
					'agilesellerproducts_tpl' => _PS_ROOT_DIR_ . "/modules/agilesellerproducts/", 
					'agilemultipleshop_tpl'=>_PS_ROOT_DIR_ . "/modules/agilemultipleshop/",
					'add_prod_display' => Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY'),
					'categorySize' => Image::getSize(($si_1531_later? ImageType::getFormatedName('category') : 'category')),
					'mediumSize' => Image::getSize(($si_1531_later? ImageType::getFormatedName('medium') : 'medium')),
					'thumbSceneSize' => Image::getSize(($si_1531_later? ImageType::getFormatedName('thumb_scene') : 'thumb_scene')),
					'homeSize' => Image::getSize(($si_1531_later? ImageType::getFormatedName('home') : 'home')),
					'HOOK_SELLER_RATINGS' => $HOOK_SELLER_RATINGS,
					'page_name' => 'agileseller',
				));
				
				$ver = (int)str_replace(".","",_PS_VERSION_);
                if($ver <= 1430)
                {
                }
                else if($ver <= 1451)
                {
				    if (isset(self::$cookie->id_customer))
					    self::$smarty->assign('compareProducts', CompareProduct::getCustomerCompareProducts((int)self::$cookie->id_customer));			
				    elseif (isset(self::$cookie->id_guest))
					    self::$smarty->assign('compareProducts', CompareProduct::getGuestCompareProducts((int)self::$cookie->id_guest));
			    }
			    else
			    {
				    if (isset(self::$cookie->id_compare))
					    self::$smarty->assign('compareProducts', CompareProduct::getCompareProducts((int)self::$cookie->id_compare));
			    }
			}

			self::$smarty->assign(array(
				'allow_oosp' => (int)(Configuration::get('PS_ORDER_OUT_OF_STOCK')),
				'comparator_max_item' => (int)(Configuration::get('PS_COMPARATOR_MAX_ITEM')),
				'suppliers' => Supplier::getSuppliers()
			));
		}
	}


	protected function getSellerLinkRwrite()
	{
	    if(Validate::isLoadedObject($this->seller_info) AND !empty($this->seller_info->company))
	        return $this->seller_info->company;
        if(Validate::isLoadedObject($this->seller))
            return $this->seller->lastname + '-' +  Tools::link_rewrite($this->seller->firstname);
        return '';
	}
	
	
	protected function getProducts($id_lang, $p, $n, $orderBy = NULL, $orderWay = NULL, $getTotal = false, $active = true,$random = false, $randomNumberProducts = 1)
    {
        global $cookie, $smarty;

        $id_seller = $this->seller->id;

		if ($p < 1) $p = 1;
        if ($n <= 0)$n = 10;

		if (empty($orderBy))
			$orderBy = 'price';
		else
						$orderBy = strtolower($orderBy);

		if (empty($orderWay))
			$orderWay = 'ASC';
		if ($orderBy == 'id_product' OR	$orderBy == 'date_add')
			$orderByPrefix = 'p';
		elseif ($orderBy == 'name')
			$orderByPrefix = 'pl';
		elseif ($orderBy == 'manufacturer')
		{
			$orderByPrefix = 'm';
			$orderBy = 'name';
		}

		if ($orderBy == 'price')
			$orderBy = 'orderprice';

		if (!Validate::isBool($active) OR !Validate::isOrderBy($orderBy) OR !Validate::isOrderWay($orderWay))
			die (Tools::displayError());

		$agile_sql_parts = AgileSellerManager::getAdditionalSqlForProducts("p", true);

		if(Module::isInstalled('agilesellerlistoptions') &&  empty($orderby))$orderby = 'position2';

				if ($getTotal)
		{		
			$sql = '
			SELECT COUNT(po.`id_product`) AS total
			FROM `'._DB_PREFIX_.'product` p
			LEFT JOIN `'._DB_PREFIX_.'product_owner` po ON p.`id_product` = po.`id_product`
			' .  $agile_sql_parts['joins'] . '
			WHERE p.id_category_default>0 AND po.`id_owner` = '.(int)($this->seller->id) . '
			' .($active ? ' AND p.`active` = 1' : '') . '
			' . $agile_sql_parts['wheres'] . '
			';

			$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);

			return isset($result) ? $result['total'] : 0;
		}


        $sql = '
		        SELECT p.*, pa.`id_product_attribute`, pl.`description`, pl.`description_short`, pl.`available_now`, pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, i.`id_image`, il.`legend`, m.`name` AS manufacturer_name, tl.`name` AS tax_name, t.`rate`, cl.`name` AS category_default, DATEDIFF(p.`date_add`, DATE_SUB(NOW(), INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY)) > 0 AS new,
			        (p.`price` * IF(t.`rate`,((100 + (t.`rate`))/100),1)) AS orderprice
					' . $agile_sql_parts['selects'] . '
		        FROM `'._DB_PREFIX_.'product_owner` po
		        LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = po.`id_product`
		        LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa ON (p.`id_product` = pa.`id_product` AND default_on = 1)
		        LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (p.`id_category_default` = cl.`id_category` AND cl.`id_lang` = '.(int)($cookie->id_lang).')
		        LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.(int)($cookie->id_lang).')
		        LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
		        LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)($cookie->id_lang).')
		        LEFT JOIN `'._DB_PREFIX_.'tax_rule` tr ON (p.`id_tax_rules_group` = tr.`id_tax_rules_group`
		                                                   AND tr.`id_country` = '.(int)(_PS_VERSION_>'1.5' ? Context::getContext()->country->id :  Country::getDefaultCountryId()).'
	                                           	           AND tr.`id_state` = 0)
	            LEFT JOIN `'._DB_PREFIX_.'tax` t ON (t.`id_tax` = tr.`id_tax`)
		        LEFT JOIN `'._DB_PREFIX_.'tax_lang` tl ON (t.`id_tax` = tl.`id_tax` AND tl.`id_lang` = '.(int)($cookie->id_lang).')
		        LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON m.`id_manufacturer` = p.`id_manufacturer`
    			' .  $agile_sql_parts['joins'] . '
		        WHERE p.id_category_default>0 AND po.`id_owner` = '. $id_seller .'
        			' .($active ? ' AND p.`active` = 1' : '') . '
        			' . $agile_sql_parts['wheres'] . '
		        ';

		if ($random === true)
		{
			$sql .= ' ORDER BY RAND()';
			$sql .= ' LIMIT 0, '.(int)($randomNumberProducts);
		}
		else
		{
			$sql .= ' ORDER BY '.(isset($orderByPrefix) ? $orderByPrefix.'.' : '').'`'.pSQL($orderBy).'` '.pSQL($orderWay).'
			LIMIT '.(((int)($p) - 1) * (int)($n)).','.(int)($n);
		}

		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);

		if ($orderBy == 'orderprice')
			Tools::orderbyPrice($result, $orderWay);

		if (!$result)
			return false;

				$finalResults = Product::getProductsProperties($id_lang, $result);		
		$finalResults = AgileSellerManager::prepareSellerRattingInfo($finalResults);
		return $finalResults;
    }	
}

