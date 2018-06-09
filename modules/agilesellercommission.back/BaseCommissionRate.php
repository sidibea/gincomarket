<?php
///-build_id: 2017010213.5255
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2016 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
class BaseCommissionRate extends ObjectModel
{
	public 		$id;
	
	public 		$id_seller;
	public 		$base_commission;
		public 		$date_add;
	


	public static $definition = array(
		'table' => 'base_commission',
		'primary' => 'id_base_commission',
		'multilang' => false,
		'multilang_shop' => false,
		'fields' => array(
			'id_seller' => 			array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId','required' => true),
			'base_commission' => 	array('type' => self::TYPE_FLOAT, 'validate' => 'isString','required' => true),
			'date_add' => 			array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
			),
		);
	

 	
	public function getFields()   {      if (isset($this->id))     $RB0D5D47F3D2E32A124C14253ABA3976A['id_base_commission'] = (int)($this->id);    $RB0D5D47F3D2E32A124C14253ABA3976A['id_seller'] = pSQL($this->id_seller);    $RB0D5D47F3D2E32A124C14253ABA3976A['base_commission'] = pSQL($this->base_commission);    $RB0D5D47F3D2E32A124C14253ABA3976A['date_add'] = pSQL($this->date_add);    return $RB0D5D47F3D2E32A124C14253ABA3976A;   }        public static function getBaseCommissionRate($R95909C49377A2B4F24C79D29C629AF65)   {                   $R130D64A4AD653C91E0FD80DE8FEADC3A= 'SELECT base_commission from `'._DB_PREFIX_.'base_commission`             WHERE id_seller = '. $R95909C49377A2B4F24C79D29C629AF65 .' OR id_seller=0             ORDER BY id_seller DESC        ';          $R679E9B9234E2062F809DBD3325D37FB6 = Db::getInstance()->getRow($R130D64A4AD653C91E0FD80DE8FEADC3A);          if(isset($R679E9B9234E2062F809DBD3325D37FB6['base_commission']) AND floatval($R679E9B9234E2062F809DBD3325D37FB6['base_commission'])>0)return floatval($R679E9B9234E2062F809DBD3325D37FB6['base_commission']);                      return 0;   }        }  