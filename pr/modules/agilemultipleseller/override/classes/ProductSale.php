<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.

class ProductSale extends ProductSaleCore
{
	public static function getBestSales($id_lang, $page_number = 0, $nb_products = 10, $order_by = null, $order_way = null)
	{
		$agile_sql_parts = AgileSellerManager::getAdditionalSqlForProducts("p", true);
		
		if(empty($agile_sql_parts['joins']) OR empty($agile_sql_parts['wheres']))
			parent::getBestSales($id_lang, $page_number, $nb_products, $order_by, $order_way);
		
		
		if ($page_number < 0) $page_number = 0;
		if ($nb_products < 1) $nb_products = 10;
		
		$final_order_by = $order_by;
		if (empty($order_by) || $order_by == 'position' || $order_by = 'price') $order_by = 'sales';
		if (empty($order_way) || $order_by == 'sales') $order_way = 'DESC';
		
		$groups = FrontController::getCurrentCustomerGroups();
		$sql_groups = (count($groups) ? 'IN ('.implode(',', $groups).')' : '= 1');
		$interval = Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20;
		
		$sql = 'SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity,
                                        pl.`description`, pl.`description_short`, pl.`link_rewrite`, pl.`meta_description`,
                                        pl.`meta_keywords`, pl.`meta_title`, pl.`name`,
                                        m.`name` AS manufacturer_name, p.`id_manufacturer` as id_manufacturer,
                                        MAX(image_shop.`id_image`) id_image, il.`legend`,
                                        ps.`quantity` AS sales, t.`rate`, pl.`meta_keywords`, pl.`meta_title`, pl.`meta_description`,
                                        MAX(product_attribute_shop.id_product_attribute) id_product_attribute,
                                        IFNULL(pa.minimal_quantity, p.minimal_quantity) as minimal_quantity,
                                        DATEDIFF(p.`date_add`, DATE_SUB(NOW(),
                                        INTERVAL '.$interval.' DAY)) > 0 AS new
                                        ' . $agile_sql_parts['selects'] . '
                                FROM `'._DB_PREFIX_.'product_sale` ps
                                LEFT JOIN `'._DB_PREFIX_.'product` p ON ps.`id_product` = p.`id_product`
                                ' . $agile_sql_parts['joins'] . '
                                '. Shop::addSqlAssociation('product', 'p', false) .'
 
                                LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa
                                        ON (p.`id_product` = pa.`id_product`)
                                '.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
                                '.Product::sqlStock('p', 'product_attribute_shop', false, Context::getContext()->shop).'
 
                                LEFT JOIN `'._DB_PREFIX_.'product_lang` pl
                                        ON p.`id_product` = pl.`id_product`
                                        AND pl.`id_lang` = '.(int)$id_lang.  (_PS_VERSION_ > '1.5' ? Shop::addSqlRestrictionOnLang('pl'):'')  .'
                                LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product`)'.
			Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1') .'
                                LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)$id_lang.')
                                LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
                                LEFT JOIN `'._DB_PREFIX_.'tax_rule` tr ON (product_shop.`id_tax_rules_group` = tr.`id_tax_rules_group`)
                                        AND tr.`id_country` = '.( _PS_VERSION_ > '1.5' ? (int)Context::getContext()->country->id : Country::getDefaultCountryId()) .'
                                        AND tr.`id_state` = 0
                                LEFT JOIN `'._DB_PREFIX_.'tax` t ON (t.`id_tax` = tr.`id_tax`)
                                WHERE product_shop.`active` = 1
                                ' .$agile_sql_parts['wheres'] . '
                                        AND p.`id_product` IN (
                                                SELECT cp.`id_product`
                                                FROM `'._DB_PREFIX_.'category_group` cg
                                                LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_category` = cg.`id_category`)
                                                WHERE cg.`id_group` '.$sql_groups.'
                                        )
                                        AND ((image_shop.id_image IS NOT NULL OR i.id_image IS NULL) OR (image_shop.id_image IS NULL AND i.cover=1))
                                ORDER BY `'.pSQL($order_by).'` '.pSQL($order_way).'
                                LIMIT '.(int)($page_number * $nb_products).', '.(int)$nb_products;
		
		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
		
		if ($final_order_by == 'price')
			Tools::orderbyPrice($result, $order_way);
		if (!$result)
			return false;
		
		$finalResults = Product::getProductsProperties($id_lang, $result);
		$finalResults = AgileSellerManager::prepareSellerRattingInfo($finalResults);
		return $finalResults;
		
	}
	
	public static function getBestSalesLight($id_lang, $page_number = 0, $nb_products = 10, Context $context = null)
	{
		$agile_sql_parts = AgileSellerManager::getAdditionalSqlForProducts("p", true);
		
		if (!$context)
			$context = Context::getContext();
		if ($page_number < 0) $page_number = 0;
		if ($nb_products < 1) $nb_products = 10;
		
		$groups = FrontController::getCurrentCustomerGroups();
		$sql_groups = (count($groups) ? 'IN ('.implode(',', $groups).')' : '= 1');
		
		$sql = 'SELECT p.id_product, pl.`link_rewrite`, pl.`name`, pl.`description_short`, MAX(image_shop.`id_image`) id_image, il.`legend`,
                                        stock.out_of_stock,
                                        MAX(product_attribute_shop.id_product_attribute) id_product_attribute,
                                        p.available_for_order,
                                        p.customizable,
                                        product_shop.id_category_default,
                                        IFNULL(pa.minimal_quantity, p.minimal_quantity) as minimal_quantity,
                                        ps.`quantity` AS sales, p.`ean13`, p.`upc`, cl.`link_rewrite` AS category
                                        ' . $agile_sql_parts['selects'] . '
                                FROM `'._DB_PREFIX_.'product_sale` ps
                                LEFT JOIN `'._DB_PREFIX_.'product` p ON ps.`id_product` = p.`id_product`
                                ' . $agile_sql_parts['joins'] . '
                                '.Shop::addSqlAssociation('product', 'p').'
                               
                                LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa
                                        ON (p.`id_product` = pa.`id_product`)
                                '.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
                                '.Product::sqlStock('p', 'product_attribute_shop', false, $context->shop).'
                               
                                LEFT JOIN `'._DB_PREFIX_.'product_lang` pl
                                        ON p.`id_product` = pl.`id_product`
                                        AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').'
                                LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product`)'.
			Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
                                LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)$id_lang.')
                                LEFT JOIN `'._DB_PREFIX_.'category_lang` cl
                                        ON cl.`id_category` = product_shop.`id_category_default`
                                        AND cl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('cl').'
                                WHERE product_shop.`active` = 1
                                        ' .$agile_sql_parts['wheres'] . '
                                        AND p.`visibility` != \'none\'
                                        AND p.`id_product` IN (
                                                SELECT cp.`id_product`
                                                FROM `'._DB_PREFIX_.'category_group` cg
                                                LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_category` = cg.`id_category`)
                                                WHERE cg.`id_group` '.$sql_groups.'
                                        )
                                GROUP BY product_shop.id_product
                                ORDER BY sales DESC
                                LIMIT '.(int)($page_number * $nb_products).', '.(int)$nb_products;
		
		if (!$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql))
			return false;
		
		$result = Product::getProductsProperties($id_lang, $result);
		
		foreach ($result as &$row)
		{
			$row['link'] = $context->link->getProductLink($row['id_product'], $row['link_rewrite'], $row['category'], $row['ean13']);
			$row['id_image'] = Product::defineProductImage($row, $id_lang);
		}
		
		$result = AgileSellerManager::prepareSellerRattingInfo($result);               
		return $result;
	}
	
}