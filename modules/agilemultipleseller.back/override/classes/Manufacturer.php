<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
class Manufacturer extends ManufacturerCore
{
	public static function getProducts($id_manufacturer, $id_lang, $p, $n, $orderBy = NULL, $orderWay = NULL, $getTotal = false, $active = true, $active_category = true, Context $context = NULL)
	{
		global $cookie;
		
		$agile_sql_parts = AgileSellerManager::getAdditionalSqlForProducts("p");

		if(empty($agile_sql_parts['joins']) OR empty($agile_sql_parts['wheres']))
            parent::getProducts($id_manufacturer, $id_lang, $p, $n, $orderBy, $orderWay, $getTotal, $active, $active_category);

	
		if ($p < 1) $p = 1;
	 	if (empty($orderBy) ||$orderBy == 'position') $orderBy = 'name';
	 	if (empty($orderWay)) $orderWay = 'ASC';

		if (!Validate::isOrderBy($orderBy) OR !Validate::isOrderWay($orderWay))
			die (Tools::displayError());
			
		$groups = FrontController::getCurrentCustomerGroups();
		$sqlGroups = (count($groups) ? 'IN ('.implode(',', $groups).')' : '= 1');

				if ($getTotal)
		{
			$sql = '
				SELECT p.`id_product`
				FROM `'._DB_PREFIX_.'product` p
			    '. $agile_sql_parts['joins']. '
				WHERE p.id_manufacturer = '.(int)($id_manufacturer)
				.($active ? ' AND p.`active` = 1' : '').'
    			'. $agile_sql_parts['wheres']. '
				AND p.`id_product` IN (
					SELECT cp.`id_product`
					FROM `'._DB_PREFIX_.'category_group` cg
					LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_category` = cg.`id_category`)'.
					($active_category ? ' INNER JOIN `'._DB_PREFIX_.'category` ca ON cp.`id_category` = ca.`id_category` AND ca.`active` = 1' : '').'
					WHERE cg.`id_group` '.$sqlGroups.'
				)';
			$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
			return (int)(sizeof($result));
		}
		$sql = '
		SELECT p.*, pa.`id_product_attribute`, pl.`description`, pl.`description_short`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, i.`id_image`, il.`legend`, m.`name` AS manufacturer_name, tl.`name` AS tax_name, t.`rate`, DATEDIFF(p.`date_add`, DATE_SUB(NOW(), INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY)) > 0 AS new,
			(p.`price` * ((100 + (t.`rate`))/100)) AS orderprice
			' . $agile_sql_parts['selects'] . '
		FROM `'._DB_PREFIX_.'product` p
			    '. $agile_sql_parts['joins']. '
		LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa ON (p.`id_product` = pa.`id_product` AND default_on = 1)
		LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.(int)($id_lang).')
		LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
		LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)($id_lang).')
		LEFT JOIN `'._DB_PREFIX_.'tax_rule` tr ON (p.`id_tax_rules_group` = tr.`id_tax_rules_group`
		                                           AND tr.`id_country` = '.(int)(_PS_VERSION_>'1.5' ? Context::getContext()->country->id :  Country::getDefaultCountryId()).'
	                                           	   AND tr.`id_state` = 0)
	    LEFT JOIN `'._DB_PREFIX_.'tax` t ON (t.`id_tax` = tr.`id_tax`)
		LEFT JOIN `'._DB_PREFIX_.'tax_lang` tl ON (t.`id_tax` = tl.`id_tax` AND tl.`id_lang` = '.(int)($id_lang).')
		LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON m.`id_manufacturer` = p.`id_manufacturer`
		WHERE p.`id_manufacturer` = '.(int)($id_manufacturer).($active ? ' AND p.`active` = 1' : '').'
			'. $agile_sql_parts['wheres']. '
		AND p.`id_product` IN (
					SELECT cp.`id_product`
					FROM `'._DB_PREFIX_.'category_group` cg
					LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_category` = cg.`id_category`)'.
					($active_category ? ' INNER JOIN `'._DB_PREFIX_.'category` ca ON cp.`id_category` = ca.`id_category` AND ca.`active` = 1' : '').'
					WHERE cg.`id_group` '.$sqlGroups.'
				)
		ORDER BY '.(($orderBy == 'id_product') ? 'p.' : '').'`'.pSQL($orderBy).'` '.pSQL($orderWay).'
		LIMIT '.(((int)($p) - 1) * (int)($n)).','.(int)($n);
		

		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($sql);
		if (!$result)
			return false;
		if ($orderBy == 'price')
			Tools::orderbyPrice($result, $orderWay);
		
		$finalResults = Product::getProductsProperties($id_lang, $result);
		$finalResults = AgileSellerManager::prepareSellerRattingInfo($finalResults);
		return $finalResults;
	}
}

