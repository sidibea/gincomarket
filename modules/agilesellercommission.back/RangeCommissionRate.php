<?php
///-build_id: 2017010213.5255
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2016 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
class RangeCommissionRate extends ObjectModel
{
    const       RATE_FOR_COMMISSION = 1;
    const       RATE_FOR_DEDUCTION = 2;

	public 		$id;
	
	public 		$id_seller;
	public 		$from_amount;
	public 		$to_amount;
	public 		$commission;
		public      $deduction_rate;
		public 		$date_add;
	


	public static $definition = array(
		'table' => 'commission_rate',
		'primary' => 'id_commission_rate',
		'multilang' => false,
		'multilang_shop' => false,
		'fields' => array(
			'id_seller' => 			array('type' => self::TYPE_INT, 'validate' => 'isFloat','required' => true),
			'from_amount' =>		array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat','size' => 12,'required' => true),
			'to_amount' =>			array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat','size' => 12,'required' => true),
			'commission' =>			array('type' => self::TYPE_FLOAT, 'validate' => 'isFloat','size' => 12,'required' => true),
			'deduction_rate' =>		array('type' => self::TYPE_FLOAT, 'validate' => 'isString'),
			'date_add' =>	 		array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
			),
		);

		
	public function getFields()   {    parent::validateFields();    if (isset($this->id))     $RB0D5D47F3D2E32A124C14253ABA3976A['id_commission_rate'] = (int)($this->id);    $RB0D5D47F3D2E32A124C14253ABA3976A['id_seller'] = intval($this->id_seller);    $RB0D5D47F3D2E32A124C14253ABA3976A['from_amount'] = floatval($this->from_amount);    $RB0D5D47F3D2E32A124C14253ABA3976A['to_amount'] = floatval($this->to_amount);    $RB0D5D47F3D2E32A124C14253ABA3976A['commission'] = floatval($this->commission);    $RB0D5D47F3D2E32A124C14253ABA3976A['deduction_rate'] = floatval($this->deduction_rate);    $RB0D5D47F3D2E32A124C14253ABA3976A['date_add'] = pSQL($this->date_add);    return $RB0D5D47F3D2E32A124C14253ABA3976A;   }                            public static function getRate($R95909C49377A2B4F24C79D29C629AF65,$R588DC754E96E565C700FFB5C95485643, $RDE154B6757DD72F5A15A86197BBC8874)      {            $R130D64A4AD653C91E0FD80DE8FEADC3A= 'SELECT commission,deduction_rate from `'._DB_PREFIX_.'commission_rate`             WHERE id_seller = '. $R95909C49377A2B4F24C79D29C629AF65 .'             AND  from_amount <= '. $R588DC754E96E565C700FFB5C95485643 .'              AND to_amount > '. $R588DC754E96E565C700FFB5C95485643 .'         ';          $R679E9B9234E2062F809DBD3325D37FB6 = Db::getInstance()->getRow($R130D64A4AD653C91E0FD80DE8FEADC3A);          if(!isset($R679E9B9234E2062F809DBD3325D37FB6['commission']))            {           $R130D64A4AD653C91E0FD80DE8FEADC3A= 'SELECT commission,deduction_rate from `'._DB_PREFIX_.'commission_rate`                 WHERE id_seller = 0                 AND  from_amount <= '. $R588DC754E96E565C700FFB5C95485643 .'                  AND to_amount > '. $R588DC754E96E565C700FFB5C95485643 .'             ';           $R679E9B9234E2062F809DBD3325D37FB6 = Db::getInstance()->getRow($R130D64A4AD653C91E0FD80DE8FEADC3A);          }               if(!isset($R679E9B9234E2062F809DBD3325D37FB6['commission']))            {           $R130D64A4AD653C91E0FD80DE8FEADC3A= 'SELECT commission,deduction_rate from `'._DB_PREFIX_.'commission_rate`                 WHERE id_seller = '. $R95909C49377A2B4F24C79D29C629AF65 .'                 ORDER BY to_amount DESC            ';           $R679E9B9234E2062F809DBD3325D37FB6 = Db::getInstance()->getRow($R130D64A4AD653C91E0FD80DE8FEADC3A);           if(!isset($R679E9B9234E2062F809DBD3325D37FB6['commission']))             {            $R130D64A4AD653C91E0FD80DE8FEADC3A= 'SELECT commission,deduction_rate from `'._DB_PREFIX_.'commission_rate`                  WHERE id_seller = 0                     ORDER BY to_amount DESC                  ';            $R679E9B9234E2062F809DBD3325D37FB6 = Db::getInstance()->getRow($R130D64A4AD653C91E0FD80DE8FEADC3A);           }          }                  if(isset($R679E9B9234E2062F809DBD3325D37FB6['commission']))           {              if($RDE154B6757DD72F5A15A86197BBC8874 == self::RATE_FOR_COMMISSION)                  return floatval($R679E9B9234E2062F809DBD3325D37FB6['commission']);              else                  return floatval($R679E9B9234E2062F809DBD3325D37FB6['deduction_rate']);          }          return 0;      }      }  