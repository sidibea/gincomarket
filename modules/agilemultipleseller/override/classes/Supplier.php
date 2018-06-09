<?php
///-build_id: 2015031920.2559
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.

class Supplier extends SupplierCore
{
	
	public static function getProducts($id_supplier, $id_lang, $p, $n,
		$order_by = null, $order_way = null, $get_total = false, $active = true, $active_category = true)
	{
		$context = Context::getContext();
		$front = true;
		if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
			$front = false;

		$agile_sql_parts = AgileSellerManager::getAdditionalSqlForProducts("p");
		if(empty($agile_sql_parts['joins']) OR empty($agile_sql_parts['wheres']))
			parent::getProducts($id_supplier, $id_lang, $p, $n,$order_by , $order_way, $get_total, $active, $active_category);

		if ($p < 1) $p = 1;
		if (empty($order_by) || $order_by == 'position') $order_by = 'name';
		if (empty($order_way)) $order_way = 'ASC';

		if (!Validate::isOrderBy($order_by) || !Validate::isOrderWay($order_way))
			die (Tools::displayError());

		$groups = FrontController::getCurrentCustomerGroups();
		$sql_groups = (count($groups) ? 'IN ('.implode(',', $groups).')' : '= 1');

				if ($get_total)
		{
			$sql = '
				SELECT DISTINCT(ps.`id_product`)
				FROM `'._DB_PREFIX_.'product_supplier` ps
				JOIN `'._DB_PREFIX_.'product` p ON (ps.`id_product`= p.`id_product`)
				'.$agile_sql_parts['joins'].'
				'.Shop::addSqlAssociation('product', 'p').'
				WHERE ps.`id_supplier` = '.(int)$id_supplier.'
				'.$agile_sql_parts['wheres'].'
				AND ps.id_product_attribute = 0'.
				($active ? ' AND product_shop.`active` = 1' : '').'
				'.($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '').'
				AND p.`id_product` IN (
					SELECT cp.`id_product`
					FROM `'._DB_PREFIX_.'category_group` cg
					LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_category` = cg.`id_category`)'.
				($active_category ? ' INNER JOIN `'._DB_PREFIX_.'category` ca ON cp.`id_category` = ca.`id_category` AND ca.`active` = 1' : '').'
					WHERE cg.`id_group` '.$sql_groups.'
				)';
			$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
			return (int)count($result);
		}

		$nb_days_new_product = Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20;

		if (strpos('.', $order_by) > 0)
		{
			$order_by = explode('.', $order_by);
			$order_by = pSQL($order_by[0]).'.`'.pSQL($order_by[1]).'`';
		}
		$alias = '';
		if (in_array($order_by, array('price', 'date_add', 'date_upd')))
			$alias = 'product_shop.';
		elseif ($order_by == 'id_product')
			$alias = 'p.';
		elseif ($order_by == 'manufacturer_name')
		{
			$order_by = 'name';
			$alias = 'm.';
		}

		$sql = 'SELECT p.*, product_shop.*, stock.out_of_stock,
					IFNULL(stock.quantity, 0) as quantity,
					pl.`description`,
					pl.`description_short`,
					pl.`link_rewrite`,
					pl.`meta_description`,
					pl.`meta_keywords`,
					pl.`meta_title`,
					pl.`name`,
					MAX(image_shop.`id_image`) id_image,
					il.`legend`,
					s.`name` AS supplier_name,
					DATEDIFF(p.`date_add`, DATE_SUB(NOW(), INTERVAL '.($nb_days_new_product).' DAY)) > 0 AS new,
					m.`name` AS manufacturer_name
				'.$agile_sql_parts['selects'].'					
				FROM `'._DB_PREFIX_.'product` p
				'.$agile_sql_parts['joins'].'				
				'.Shop::addSqlAssociation('product', 'p').'
				JOIN `'._DB_PREFIX_.'product_supplier` ps ON (ps.id_product = p.id_product
					AND ps.id_product_attribute = 0)
				LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product`
					AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').')
				LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product`)'.
			Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
				LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image`
					AND il.`id_lang` = '.(int)$id_lang.')
				LEFT JOIN `'._DB_PREFIX_.'supplier` s ON s.`id_supplier` = p.`id_supplier`
				LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON m.`id_manufacturer` = p.`id_manufacturer`
				'.Product::sqlStock('p').'
				WHERE ps.`id_supplier` = '.(int)$id_supplier.
					($active ? ' AND product_shop.`active` = 1' : '').'
					'.($front ? ' AND product_shop.`visibility` IN ("both", "catalog")' : '').'
					'.$agile_sql_parts['wheres'].'					
					AND p.`id_product` IN (
						SELECT cp.`id_product`
						FROM `'._DB_PREFIX_.'category_group` cg
						LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_category` = cg.`id_category`)'.
			($active_category ? ' INNER JOIN `'._DB_PREFIX_.'category` ca ON cp.`id_category` = ca.`id_category` AND ca.`active` = 1' : '').'
						WHERE cg.`id_group` '.$sql_groups.'
					)
				GROUP BY product_shop.id_product
				ORDER BY '.$alias.pSQL($order_by).' '.pSQL($order_way).'
				LIMIT '.(((int)$p - 1) * (int)$n).','.(int)$n;

		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

		if (!$result)
			return false;

		if ($order_by == 'price')
			Tools::orderbyPrice($result, $order_way);

		$finalResults = Product::getProductsProperties($id_lang, $result);
		$finalResults = AgileSellerManager::prepareSellerRattingInfo($finalResults);				
		return $finalResults;
	}

	public function getProductsLite($id_lang)
	{
		$context = Context::getContext();
		$front = true;
		if (!in_array($context->controller->controller_type, array('front', 'modulefront')))
			$front = false;

		$agile_sql_parts = AgileSellerManager::getAdditionalSqlForProducts("p");
		if(empty($agile_sql_parts['joins']) OR empty($agile_sql_parts['wheres']))
			parent::getProductsLite($id_lang);

		$sql = '
			SELECT p.`id_product`,
				   pl.`name`
			FROM `'._DB_PREFIX_.'product` p
			'.Shop::addSqlAssociation('product', 'p').'
			LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (
				p.`id_product` = pl.`id_product`
				AND pl.`id_lang` = '.(int)$id_lang.'
			)
			INNER JOIN `'._DB_PREFIX_.'product_supplier` ps ON (
				ps.`id_product` = p.`id_product`
				AND ps.`id_supplier` = '.(int)$this->id.'
			)
			'.($front ? ' WHERE product_shop.`visibility` IN ("both", "catalog")' : '').'
			GROUP BY p.`id_product`';

		$finalResults = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);		
		$finalResults = AgileSellerManager::prepareSellerRattingInfo($finalResults);				
		return $finalResults;		
	}

}

