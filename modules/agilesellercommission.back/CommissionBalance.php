<?php
///-build_id: 2017010213.5255
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2016 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
class CommissionBalance extends ObjectModel
{
	public 		$id;
	
	public 		$id_seller;
	public 		$balance;
	


	public static $definition = array(
		'table' => '',
		'primary' => 'id_commission_balance',
		'multilang' => false,
		'multilang_shop' => false,
		'fields' => array(
			'id_seller' => 			array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId','required' => true),
			'balance' => 			array('type' => self::TYPE_FLOAT, 'validate' => 'isString','required' => true),
			),
		);

 	
	public function getFields()   {      if (isset($this->id))     $RB0D5D47F3D2E32A124C14253ABA3976A['id_commission_balance'] = (int)($this->id);    $RB0D5D47F3D2E32A124C14253ABA3976A['id_seller'] = pSQL($this->id_seller);    $RB0D5D47F3D2E32A124C14253ABA3976A['balance'] = pSQL($this->balance);    return $RB0D5D47F3D2E32A124C14253ABA3976A;   }        }  