<?php
///-build_id: 2017010213.5255
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2016 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
class CategoryCommissionRate extends ObjectModel
{
	public 		$id;
	
	public 		$id_seller;
	public 		$id_category;
	public 		$commission;
	public 		$date_add;
	
	public static $definition = array(
		'table' => 'category_commission',
		'primary' => 'id_category_commission',
		'multilang' => false,
		'multilang_shop' => false,
		'fields' => array(
			'id_seller' => 		array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
			'id_category' => 	array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
			'commission' =>		array('type' => self::TYPE_FLOAT, 'validate' => 'isString'),
			'date_add' => 		array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
			),
		);


									public static function getCommissionRate($R95909C49377A2B4F24C79D29C629AF65, $R40095968F29813E02A981F327827F17B)   {    $R130D64A4AD653C91E0FD80DE8FEADC3A = 'SELECT id_category_default FROM ' . _DB_PREFIX_ . 'product WHERE id_product = ' . (int)$R40095968F29813E02A981F327827F17B;    $RF664E51958D748D9CA7C7C2D6C20EC0C = (int)Db::getInstance()->getValue($R130D64A4AD653C91E0FD80DE8FEADC3A);    $R30E38C1F8EC85F8EE8DF620FF3267157 = AgileHelper::getAllAncessors($RF664E51958D748D9CA7C7C2D6C20EC0C, array());    $R30E38C1F8EC85F8EE8DF620FF3267157[] = 0;    $R30E38C1F8EC85F8EE8DF620FF3267157[] = $RF664E51958D748D9CA7C7C2D6C20EC0C;         $R130D64A4AD653C91E0FD80DE8FEADC3A = 'SELECT commission       FROM  ' . _DB_PREFIX_ . 'category_commission cc       LEFT JOIN ' . _DB_PREFIX_ . 'category c ON cc.id_category = c.id_category      WHERE id_seller IN (0, ' . (int)$R95909C49377A2B4F24C79D29C629AF65 . ')        AND cc.id_category IN (' . implode(',', $R30E38C1F8EC85F8EE8DF620FF3267157) . ')      ORDER BY cc.id_seller DESC, c.level_depth DESC    ';           $R08331032AF766761F73862782421264A =(float)Db::getInstance()->getValue($R130D64A4AD653C91E0FD80DE8FEADC3A);        return $R08331032AF766761F73862782421264A;       }  }  