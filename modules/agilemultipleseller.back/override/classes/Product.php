<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
class Product extends ProductCore
{
	public function getDefaultCategory()	
	{		
		$default_category = Db::getInstance()->getValue('
					SELECT product_shop.`id_category_default`
					FROM `'._DB_PREFIX_.'product` p
					'.Shop::addSqlAssociation('product', 'p').'
					WHERE p.`id_product` = '.(int)$this->id);

		if (!$default_category)
			return Context::getContext()->shop->id_category;
		else
			return $default_category;
	}	
	
	public static function getProducts($id_lang, $start, $limit, $orderBy, $orderWay, $id_category = false,    $only_active = false, Context $context = null)
	{
		$agile_sql_parts = AgileSellerManager::getAdditionalSqlForProducts("p", true);
		if(Module::isInstalled('agilesellerlistoptions') &&  empty($orderby))$orderby = 'position2';

		if(empty($agile_sql_parts['joins']) OR empty($agile_sql_parts['wheres']))
			parent::getProducts($id_lang, $start, $limit, $orderBy, $orderWay, $id_category, $only_active);

		
		if (!Validate::isOrderBy($orderBy) OR !Validate::isOrderWay($orderWay))
			die (Tools::displayError());
		if ($orderBy == 'id_product' OR	$orderBy == 'price' OR	$orderBy == 'date_add')
			$orderByPrefix = 'p';
		elseif ($orderBy == 'name')
			$orderByPrefix = 'pl';
		elseif ($orderBy == 'position')
			$orderByPrefix = 'c';

		$sql = '
		SELECT p.*, pl.* , t.`rate` AS tax_rate, m.`name` AS manufacturer_name, s.`name` AS supplier_name
		' . $agile_sql_parts['selects'] . '
		FROM `'._DB_PREFIX_.'product` p
		' . $agile_sql_parts['joins'] . '
		LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product`)
		LEFT JOIN `'._DB_PREFIX_.'tax_rule` tr ON (p.`id_tax_rules_group` = tr.`id_tax_rules_group`
		   AND tr.`id_country` = '.(_PS_VERSION_ > '1.5' ?  (int)Context::getContext()->country->id : (int)Country::getDefaultCountryId()) .'
		   AND tr.`id_state` = 0)
	    LEFT JOIN `'._DB_PREFIX_.'tax` t ON (t.`id_tax` = tr.`id_tax`)
		LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
		LEFT JOIN `'._DB_PREFIX_.'supplier` s ON (s.`id_supplier` = p.`id_supplier`)'.
			($id_category ? 'LEFT JOIN `'._DB_PREFIX_.'category_product` c ON (c.`id_product` = p.`id_product`)' : '').'
		WHERE pl.`id_lang` = '.(int)($id_lang).
			($id_category ? ' AND c.`id_category` = '.(int)($id_category) : '').
			$agile_sql_parts['wheres'] .
			($only_active ? ' AND p.`active` = 1' : '').'
		ORDER BY '.(isset($orderByPrefix) ? pSQL($orderByPrefix).'.' : '').'`'.pSQL($orderBy).'` '.pSQL($orderWay).
			($limit > 0 ? ' LIMIT '.(int)($start).','.(int)($limit) : '');

		$finalResults = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
		
		if ($orderBy == 'price')
			Tools::orderbyPrice($finalResults,$orderWay);
		
		$finalResults = AgileSellerManager::prepareSellerRattingInfo($finalResults);
		return $finalResults;
		
	}
	
	
	public static function getNewProducts($id_lang, $pageNumber = 0, $nbProducts = 10, $count = false, $orderBy = NULL, $orderWay = NULL, Context $context = null)
	{
		global $cookie;
		
		if($context == null)$context = Context::getContext();

		$agile_sql_parts = AgileSellerManager::getAdditionalSqlForProducts("p", true);
		if(Module::isInstalled('agilesellerlistoptions') &&  empty($orderby))$orderby = 'position2';
		
		if(empty($agile_sql_parts['joins']) OR empty($agile_sql_parts['wheres']))
			parent::getNewProducts($id_lang, $pageNumber, $nbProducts, $count, $orderBy, $orderWay);
		
		$front = true;
		if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
			$front = false;
	
		if ($pageNumber < 0) $pageNumber = 0;
		if ($nbProducts < 1) $nbProducts = 10;
		if (empty($orderBy) || $orderBy == 'position') $orderBy = 'date_add';
		if (empty($orderWay)) $orderWay = 'DESC';
		if ($orderBy == 'id_product' OR $orderBy == 'price' OR $orderBy == 'date_add')
			$orderByPrefix = 'p';
		elseif ($orderBy == 'name')
			$orderByPrefix = 'pl';
		if (!Validate::isOrderBy($orderBy) OR !Validate::isOrderWay($orderWay))
			die(Tools::displayError());

		$groups = FrontController::getCurrentCustomerGroups();
		$sqlGroups = (count($groups) ? 'IN ('.implode(',', $groups).')' : '= 1');

		if ($count)
		{
			$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
			SELECT COUNT(p.`id_product`) AS nb
			FROM `'._DB_PREFIX_.'product` p
				'.Shop::addSqlAssociation('product', 'p').'
			    '. $agile_sql_parts['joins']. '
			WHERE product_shop.`active` = 1
			AND DATEDIFF(p.`date_add`, DATE_SUB(NOW(), INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY)) > 0
			' . $agile_sql_parts['wheres']. '
			'.($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '').'
			AND p.`id_product` IN (
				SELECT cp.`id_product`
				FROM `'._DB_PREFIX_.'category_group` cg
				LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_category` = cg.`id_category`)
				WHERE cg.`id_group` '.$sqlGroups.'
			)');
			return (int)($result['nb']);
		}

		$sql = '
		SELECT p.*, pl.`description`, pl.`description_short`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, p.`ean13`, p.`upc`,
			i.`id_image`, il.`legend`, t.`rate`, m.`name` AS manufacturer_name, DATEDIFF(p.`date_add`, DATE_SUB(NOW(), INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY)) > 0 AS new,
			(p.`price` * ((100 + (t.`rate`))/100)) AS orderprice, pa.id_product_attribute
			' . $agile_sql_parts['selects'] . '
		FROM `'._DB_PREFIX_.'product` p
				'.Shop::addSqlAssociation('product', 'p').'
			    '. $agile_sql_parts['joins']. '
		LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.(int)($id_lang).')
		LEFT OUTER JOIN `'._DB_PREFIX_.'product_attribute` pa ON (p.`id_product` = pa.`id_product` AND `default_on` = 1)
		LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
		LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)($id_lang).')
		LEFT JOIN `'._DB_PREFIX_.'tax_rule` tr ON (p.`id_tax_rules_group` = tr.`id_tax_rules_group`
		   AND tr.`id_country` = '.(_PS_VERSION_ > '1.5' ?  (int)Context::getContext()->country->id : (int)Country::getDefaultCountryId()).'
		   AND tr.`id_state` = 0)
	    LEFT JOIN `'._DB_PREFIX_.'tax` t ON (t.`id_tax` = tr.`id_tax`)
		LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
		WHERE product_shop.`active` = 1
			' . $agile_sql_parts['wheres']. '
		AND DATEDIFF(p.`date_add`, DATE_SUB(NOW(), INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY)) > 0
		'.($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '').'
		AND p.`id_product` IN (
			SELECT cp.`id_product`
			FROM `'._DB_PREFIX_.'category_group` cg
			LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_category` = cg.`id_category`)
			WHERE cg.`id_group` '.$sqlGroups.'
		)
		ORDER BY '.(isset($orderByPrefix) ? pSQL($orderByPrefix).'.' : '').'`'.pSQL($orderBy).'` '.pSQL($orderWay).'
		LIMIT '.(int)($pageNumber * $nbProducts).', '.(int)($nbProducts);

		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);

		if ($orderBy == 'price')
			Tools::orderbyPrice($result, $orderWay);
		if (!$result)
			return false;

		$productsIds = array();
		foreach ($result as $row)
			$productsIds[] = $row['id_product'];
				
		$finalResults = Product::getProductsProperties((int)$id_lang, $result);
		$finalResults = AgileSellerManager::prepareSellerRattingInfo($finalResults);
		return $finalResults;
		
	}

	
	public static function getPricesDrop($id_lang, $page_number = 0, $nb_products = 10, $count = false,
		$order_by = null, $order_way = null, $beginning = false, $ending = false, Context $context = null)
	{
		if (!Validate::isBool($count))
			die(Tools::displayError());

		if (!$context) $context = Context::getContext();
		
		$agile_sql_parts = AgileSellerManager::getAdditionalSqlForProducts("p", true);
		if(Module::isInstalled('agilesellerlistoptions') &&  empty($orderby))$orderby = 'position2';

		if(empty($agile_sql_parts['joins']) OR empty($agile_sql_parts['wheres']))
			parent::getPricesDrop($id_lang, $page_number, $nb_products, $count,$order_by, $order_way, $beginning, $ending , $context);				
		
		if ($page_number < 0) $page_number = 0;
		if ($nb_products < 1) $nb_products = 10;
		if (empty($order_by) || $order_by == 'position') $order_by = 'price';
		if (empty($order_way)) $order_way = 'DESC';
		if ($order_by == 'id_product' || $order_by == 'price' || $order_by == 'date_add'  || $order_by == 'date_upd')
			$order_by_prefix = 'p';
		else if ($order_by == 'name')
			$order_by_prefix = 'pl';
		if (!Validate::isOrderBy($order_by) || !Validate::isOrderWay($order_way))
			die (Tools::displayError());
		$current_date = date('Y-m-d H:i:s');
		$ids_product = Product::_getProductIdByDate((!$beginning ? $current_date : $beginning), (!$ending ? $current_date : $ending), $context);

		$tab_id_product = array();
		foreach ($ids_product as $product)
			if (is_array($product))
				$tab_id_product[] = (int)$product['id_product'];
			else
				$tab_id_product[] = (int)$product;

		$front = true;
		if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
			$front = false;

		$groups = FrontController::getCurrentCustomerGroups();
		$sql_groups = (count($groups) ? 'IN ('.implode(',', $groups).')' : '= 1');

		if ($count)
		{
			$sql = 'SELECT COUNT(DISTINCT p.`id_product`) AS nb
					FROM `'._DB_PREFIX_.'product` p
					' . $agile_sql_parts['joins'] . '
					'.Shop::addSqlAssociation('product', 'p').'
					WHERE product_shop.`active` = 1
						AND product_shop.`show_price` = 1
						' . $agile_sql_parts['wheres'] . '
						'.($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '').'
						'.((!$beginning && !$ending) ? 'AND p.`id_product` IN('.((is_array($tab_id_product) && count($tab_id_product)) ? implode(', ', $tab_id_product) : 0).')' : '').'
						AND p.`id_product` IN (
							SELECT cp.`id_product`
							FROM `'._DB_PREFIX_.'category_group` cg
							LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_category` = cg.`id_category`)
							WHERE cg.`id_group` '.$sql_groups.'
						)';
			$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
			return (int)$result['nb'];
		}
		if (strpos($order_by, '.') > 0)
		{
			$order_by = explode('.', $order_by);
			$order_by = pSQL($order_by[0]).'.`'.pSQL($order_by[1]).'`';
		}
		$sql = 'SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, pl.`description`, pl.`description_short`, MAX(product_attribute_shop.id_product_attribute) id_product_attribute,
					pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`,
					pl.`name`, MAX(image_shop.`id_image`) id_image, il.`legend`, m.`name` AS manufacturer_name,
					DATEDIFF(
						p.`date_add`,
						DATE_SUB(
							NOW(),
							INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY
						)
					) > 0 AS new
				' . $agile_sql_parts['selects'] . '
				FROM `'._DB_PREFIX_.'product` p
				'.Shop::addSqlAssociation('product', 'p').'
				' . $agile_sql_parts['joins'] . '
				LEFT JOIN '._DB_PREFIX_.'product_attribute pa ON (pa.id_product = p.id_product)
				'.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.default_on=1').'
				'.Product::sqlStock('p', 0, false, $context->shop).'
				LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (
					p.`id_product` = pl.`id_product`
					AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').'
				)
				LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product`)'.
			Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
				LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)$id_lang.')
				LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
				WHERE product_shop.`active` = 1
				AND product_shop.`show_price` = 1
				' . $agile_sql_parts['wheres'] . '
				'.($front ? ' AND p.`visibility` IN ("both", "catalog")' : '').'
				'.((!$beginning && !$ending) ? ' AND p.`id_product` IN ('.((is_array($tab_id_product) && count($tab_id_product)) ? implode(', ', $tab_id_product) : 0).')' : '').'
				AND p.`id_product` IN (
					SELECT cp.`id_product`
					FROM `'._DB_PREFIX_.'category_group` cg
					LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_category` = cg.`id_category`)
					WHERE cg.`id_group` '.$sql_groups.'
				)
				GROUP BY product_shop.id_product
				ORDER BY '.(isset($order_by_prefix) ? pSQL($order_by_prefix).'.' : '').pSQL($order_by).' '.pSQL($order_way).'
				LIMIT '.(int)($page_number * $nb_products).', '.(int)$nb_products;

		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

		if ($order_by == 'price')
			Tools::orderbyPrice($result, $order_way);

		if (!$result)
			return false;

		$finalResults = Product::getProductsProperties($id_lang, $result);
		$finalResults = AgileSellerManager::prepareSellerRattingInfo($finalResults);
		return $finalResults;
	}

	public static function getRandomSpecial($id_lang, $beginning = false, $ending = false, Context $context = null)
	{
		if(!Module::isInstalled('agilemultipleseller'))return parent::getRandomSpecial($id_lang, $beginning, $ending,  $context);

		$agile_sql_parts = AgileSellerManager::getAdditionalSqlForProducts("p", true);
		
		if (!$context)
			$context = Context::getContext();

		$front = true;
		if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
			$front = false;

		$current_date = date('Y-m-d H:i:s');
		$product_reductions = Product::_getProductIdByDate((!$beginning ? $current_date : $beginning), (!$ending ? $current_date : $ending), $context, true);

		if ($product_reductions)
		{
			$ids_product = ' AND (';
			foreach ($product_reductions as $product_reduction)
				$ids_product .= '( product_shop.`id_product` = '.(int)$product_reduction['id_product'].($product_reduction['id_product_attribute'] ? ' AND product_attribute_shop.`id_product_attribute`='.(int)$product_reduction['id_product_attribute'] :'').') OR';
			$ids_product = rtrim($ids_product, 'OR').')';

			$groups = FrontController::getCurrentCustomerGroups();
			$sql_groups = (count($groups) ? 'IN ('.implode(',', $groups).')' : '= 1');

						$sql = 'SELECT product_shop.id_product, MAX(product_attribute_shop.id_product_attribute) id_product_attribute
					FROM `'._DB_PREFIX_.'product` p
					'.Shop::addSqlAssociation('product', 'p').'
					LEFT JOIN  `'._DB_PREFIX_.'product_attribute` pa ON (product_shop.id_product = pa.id_product)
					'.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.default_on = 1').'
					' . $agile_sql_parts['joins'] . '
					WHERE product_shop.`active` = 1
						'.(($ids_product) ? $ids_product : '').'
						' . $agile_sql_parts['wheres'] . '
						AND p.`id_product` IN (
							SELECT cp.`id_product`
							FROM `'._DB_PREFIX_.'category_group` cg
							LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_category` = cg.`id_category`)
							WHERE cg.`id_group` '.$sql_groups.'
						)
					'.($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '').'
					GROUP BY product_shop.id_product
					ORDER BY RAND()';


			$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);

			if (!$id_product = $result['id_product'])
				return false;

			$sql = 'SELECT p.*, product_shop.*, stock.`out_of_stock` out_of_stock, pl.`description`, pl.`description_short`,
						pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`,
						p.`ean13`, p.`upc`, MAX(image_shop.`id_image`) id_image, il.`legend`,
						DATEDIFF(product_shop.`date_add`, DATE_SUB(NOW(),
						INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).'
							DAY)) > 0 AS new
					FROM `'._DB_PREFIX_.'product` p
					LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (
						p.`id_product` = pl.`id_product`
						AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').'
					)
					'.Shop::addSqlAssociation('product', 'p').'
					LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product`)'.
				Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
					LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)$id_lang.')
					'.Product::sqlStock('p', 0).'
					' . $agile_sql_parts['joins'] . '
					WHERE p.id_product = '.(int)$id_product.'
						' . $agile_sql_parts['wheres'] . '
					GROUP BY product_shop.id_product';

			$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
			if (!$row)
				return false;

			if ($result['id_product_attribute'])
				$row['id_product_attribute'] = $result['id_product_attribute'];
			return Product::getProductProperties($id_lang, $row);
		}
		else
			return false;
	}
	


	public function add($autodate = true, $nullValues = false)
	{
		$res = parent::add($autodate, $nullValues);

		if(Module::isInstalled('agilemultipleseller') AND $res)
		{
			require_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/agilemultipleseller.php");
			AgileMultipleSeller::sendNewProductEmail($this->id);
		}

		if(Module::isInstalled('agilesellerlistoptions') AND $res)
		{
			require_once(_PS_ROOT_DIR_ . "/modules/agilesellerlistoptions/agilesellerlistoptions.php");
			$aslo = new AgileSellerListOptions();
			$aslo->processProductExtenstions(array('product' => $this));
		}
		
		return $res;
	}
	
	public function update($null_values = false)
	{
		$res = parent::update($null_values);
		if(Module::isInstalled('agilesellerlistoptions') AND $res)
		{
			require_once(_PS_ROOT_DIR_ . "/modules/agilesellerlistoptions/agilesellerlistoptions.php");
			$aslo = new AgileSellerListOptions();
			$aslo->processProductExtenstions(array('product' => $this));
		}
		
		return $res;
	}
	
}
