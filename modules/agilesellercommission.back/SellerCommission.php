<?php
///-build_id: 2017010213.5255
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2016 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
class SellerCommission extends ObjectModel
{
    const   STATE_FLAG_COMMISSION = 1;
    const   STATE_FLAG_CANCELLATION = 2;
    const   RECORD_TYPE_BUYER_PAY_STORE = 3;         const   RECORD_TYPE_BUYER_PAY_SELLER = 1;         const   RECORD_TYPE_BUYER_PAY_BOTH = 2;         const   RECORD_TYPE_SELLER_PAY_STORE = 101;       const   RECORD_TYPE_STORE_PAY_SELLER =102;         const   RECORD_TYPE_ORDER_CANCELLATION = -1; 	const	RECORD_TYPE_SELLER_CREDIT = 101; 	const	RECORD_TYPE_SELLER_DEBIT = 102;  	
  	public 		$id;
	
	public 		$id_seller;
	public 		$id_order;
	public 		$sales_amount;
	public 		$base_commission;
	public 		$range_commission;

	public 		$deduction_amount;
	public 		$order_origin;
	public 		$id_currency;
	public 		$seller_sales;
	public 		$record_type;
	public 		$record_balance;
	public      $balance;
	public 		$payment_txn_id;
	public		$tokens_used=0;

	public      $memo;
		public 		$date_add;
	


	public static $definition = array(
		'table' => 'seller_commission',
		'primary' => 'id_seller_commission',
		'multilang' => false,
		'multilang_shop' => false,
		'fields' => array(
			'id_seller' => 			array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId','size' => 12,'required' => true),
			'id_order' =>	 		array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId','size' => 12,'required' => true),
			'sales_amount' =>		array('type' => self::TYPE_FLOAT, 'validate' => 'isString'),
			'base_commission' =>	array('type' => self::TYPE_FLOAT, 'validate' => 'isString','size' => 16,'required' => true),
			'range_commission' =>	array('type' => self::TYPE_FLOAT, 'validate' => 'isString','size' => 16,'required' => true),
			'deduction_amount' =>	array('type' => self::TYPE_FLOAT, 'validate' => 'isString'),

			'order_origin' =>	array('type' => self::TYPE_INT, 'validate' => 'isString'),
			'id_currency' =>	array('type' => self::TYPE_INT, 'validate' => 'isString'),
			'seller_sales' =>	array('type' => self::TYPE_FLOAT, 'validate' => 'isString'),
			'record_type' =>	array('type' => self::TYPE_INT, 'validate' => 'isString'),
			'record_balance' =>	array('type' => self::TYPE_FLOAT, 'validate' => 'isString'),
			'balance' =>		array('type' => self::TYPE_FLOAT, 'validate' => 'isString'),
			'payment_txn_id' =>	array('type' => self::TYPE_STRING, 'validate' => 'isString'),
			'tokens_used' =>	array('type' => self::TYPE_FLOAT, 'validate' => 'isString'),
			'memo' =>			array('type' => self::TYPE_STRING, 'validate' => 'isString'),
			'date_add' =>	 		array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
			),
		);

	
	public function getFields()   {      if (isset($this->id))     $RB0D5D47F3D2E32A124C14253ABA3976A['id_seller_commission'] = (int)($this->id);    $RB0D5D47F3D2E32A124C14253ABA3976A['id_seller'] = intval($this->id_seller);    $RB0D5D47F3D2E32A124C14253ABA3976A['id_order'] = intval($this->id_order);    $RB0D5D47F3D2E32A124C14253ABA3976A['sales_amount'] = floatval($this->sales_amount);    $RB0D5D47F3D2E32A124C14253ABA3976A['base_commission'] = floatval($this->base_commission);    $RB0D5D47F3D2E32A124C14253ABA3976A['deduction_amount'] = floatval($this->deduction_amount);    $RB0D5D47F3D2E32A124C14253ABA3976A['range_commission'] = floatval($this->range_commission);    $RB0D5D47F3D2E32A124C14253ABA3976A['order_origin'] = intval($this->order_origin);      $RB0D5D47F3D2E32A124C14253ABA3976A['id_currency'] = (int)$this->id_currency;    $RB0D5D47F3D2E32A124C14253ABA3976A['seller_sales'] = (float)$this->seller_sales;    $RB0D5D47F3D2E32A124C14253ABA3976A['record_balance'] = (float)$this->record_balance;    $RB0D5D47F3D2E32A124C14253ABA3976A['balance'] = (float)$this->balance;    $RB0D5D47F3D2E32A124C14253ABA3976A['record_type'] = (int)$this->record_type;    $RB0D5D47F3D2E32A124C14253ABA3976A['payment_txn_id'] = pSQL($this->payment_txn_id);    $RB0D5D47F3D2E32A124C14253ABA3976A['tokens_used'] = (float)$this->tokens_used;      $RB0D5D47F3D2E32A124C14253ABA3976A['memo'] = pSQL($this->memo);    $RB0D5D47F3D2E32A124C14253ABA3976A['date_add'] = pSQL($this->date_add);    return $RB0D5D47F3D2E32A124C14253ABA3976A;   }      public static function updateBalance($R95909C49377A2B4F24C79D29C629AF65,$R34CD0CD32ADCA6EF99053114A747410E)   {       $R130D64A4AD653C91E0FD80DE8FEADC3A = 'SELECT SUM(record_balance) as balance FROM `'._DB_PREFIX_.'seller_commission` WHERE id_seller=' . intval($R95909C49377A2B4F24C79D29C629AF65) . ' AND id_seller_commission<=' . intval($R34CD0CD32ADCA6EF99053114A747410E);       $RCC10F697B15DDBF453B97188A03BE2BD = (float)Db::getInstance()->getValue($R130D64A4AD653C91E0FD80DE8FEADC3A);                 $R130D64A4AD653C91E0FD80DE8FEADC3A = 'UPDATE`'._DB_PREFIX_.'seller_commission` SET balance=' . floatval($RCC10F697B15DDBF453B97188A03BE2BD) . ' WHERE id_seller=' . intval($R95909C49377A2B4F24C79D29C629AF65) . ' AND id_seller_commission=' . intval($R34CD0CD32ADCA6EF99053114A747410E);       Db::getInstance()->Execute($R130D64A4AD653C91E0FD80DE8FEADC3A);   }      public static function updateRecordType($RDE6D1531493DFC39BA2B390CA5A01256,$RBDF1E52780E67C6D25724A766C4FDB32,$R53E32B8E29E2609B74F8597A5E9BBF18)   {      $R95909C49377A2B4F24C79D29C629AF65 = AgileSellerManager::getObjectOwnerID('order', $RDE6D1531493DFC39BA2B390CA5A01256);    include_once(_PS_ROOT_DIR_ . "/modules/agilemultipleseller/SellerInfo.php");    $R555FF79BC5306B8F3228306002C66D23 = SellerInfo::get_seller_payment_collection($R95909C49377A2B4F24C79D29C629AF65);    if($R555FF79BC5306B8F3228306002C66D23 == 1)$RBDF1E52780E67C6D25724A766C4FDB32 = 3;           if($RBDF1E52780E67C6D25724A766C4FDB32 == self::RECORD_TYPE_BUYER_PAY_BOTH)              $RB990902A34E4F0653435FACC0D44F9FC = ' 0 + tokens_used ';    else if ($RBDF1E52780E67C6D25724A766C4FDB32 == self::RECORD_TYPE_BUYER_PAY_SELLER)              $RB990902A34E4F0653435FACC0D44F9FC = ' tokens_used - base_commission - range_commission ';          else              $RB990902A34E4F0653435FACC0D44F9FC = 'seller_sales';            $R130D64A4AD653C91E0FD80DE8FEADC3A = 'UPDATE `'._DB_PREFIX_.'seller_commission` SET               `record_type`=' . $RBDF1E52780E67C6D25724A766C4FDB32 . '              ,`payment_txn_id`=\'' . $R53E32B8E29E2609B74F8597A5E9BBF18 . '\'              ,`record_balance`=' . $RB990902A34E4F0653435FACC0D44F9FC . '               WHERE id_order=' . $RDE6D1531493DFC39BA2B390CA5A01256 . '              ';            Db::getInstance()->Execute($R130D64A4AD653C91E0FD80DE8FEADC3A);                    $R130D64A4AD653C91E0FD80DE8FEADC3A = 'SELECT id_seller, id_seller_commission FROM `'._DB_PREFIX_.'seller_commission` WHERE id_order=' . $RDE6D1531493DFC39BA2B390CA5A01256;          $RA5D419B9C8A65511C40A1A438A81737C = Db::getInstance()->ExecuteS($R130D64A4AD653C91E0FD80DE8FEADC3A);          foreach($RA5D419B9C8A65511C40A1A438A81737C AS $R0D2025D63125D005B85F4466C8BA1564)          {              self::updateBalance($R0D2025D63125D005B85F4466C8BA1564['id_seller'],$R0D2025D63125D005B85F4466C8BA1564['id_seller_commission']);          }   }      public static function getCommissionRecordID($RDE6D1531493DFC39BA2B390CA5A01256,$R95909C49377A2B4F24C79D29C629AF65)   {       $R130D64A4AD653C91E0FD80DE8FEADC3A= 'SELECT id_seller_commission from `'._DB_PREFIX_.'seller_commission`            WHERE id_seller = '. $R95909C49377A2B4F24C79D29C629AF65 .'            AND  id_order = '. $RDE6D1531493DFC39BA2B390CA5A01256 .'             AND  record_type in ( ' . self::RECORD_TYPE_BUYER_PAY_STORE . ',' . self::RECORD_TYPE_BUYER_PAY_SELLER . ',' . self::RECORD_TYPE_BUYER_PAY_BOTH . ')      ';          return (int)(Db::getInstance()->getValue($R130D64A4AD653C91E0FD80DE8FEADC3A));      }             public static function getRecordNb($R95909C49377A2B4F24C79D29C629AF65)      {       $R130D64A4AD653C91E0FD80DE8FEADC3A= 'SELECT count(*) as num from `'._DB_PREFIX_.'seller_commission`            WHERE id_seller = '. intval($R95909C49377A2B4F24C79D29C629AF65) .'      ';                $RDDA0718F3749E961E79C22CB935FE0DE = intval(Db::getInstance()->getValue($R130D64A4AD653C91E0FD80DE8FEADC3A));          return $RDDA0718F3749E961E79C22CB935FE0DE;      }      public static function getRecords($R95909C49377A2B4F24C79D29C629AF65, $p=1, $n=10, $RB81DFC1E4441111E15C502E9EA63560E='date_add', $R43714A11C76BECC904172B0223CFAD12='DESC')   {    if($p < 1) $p = 1;          if($n < 1) $n = 10;          if(empty($RB81DFC1E4441111E15C502E9EA63560E))$RB81DFC1E4441111E15C502E9EA63560E ='date_add';          if(empty($R43714A11C76BECC904172B0223CFAD12))$R43714A11C76BECC904172B0223CFAD12 ='DESC';         $R130D64A4AD653C91E0FD80DE8FEADC3A= 'SELECT * from `'._DB_PREFIX_.'seller_commission`            WHERE id_seller = '. intval($R95909C49377A2B4F24C79D29C629AF65) .'            ORDER BY ' . $RB81DFC1E4441111E15C502E9EA63560E . ' ' . $R43714A11C76BECC904172B0223CFAD12 . '      ';    $R130D64A4AD653C91E0FD80DE8FEADC3A .= ' LIMIT '.(((int)($p) - 1) * (int)($n)).','.(int)($n);              return Db::getInstance()->ExecuteS($R130D64A4AD653C91E0FD80DE8FEADC3A);      }       public static function addCreditMemoRecord($R95909C49377A2B4F24C79D29C629AF65, $RBDF1E52780E67C6D25724A766C4FDB32, $R68EAF33C4E51B47C7219F805B449C109, $RBAE26E5418D470B98B4288F224FCD429 ='', $R53E32B8E29E2609B74F8597A5E9BBF18 ='', $RDE6D1531493DFC39BA2B390CA5A01256 = 0)   {    if(!$R95909C49377A2B4F24C79D29C629AF65 OR (float)$R68EAF33C4E51B47C7219F805B449C109 ==0)return;       $currency = new Currency( Configuration::get('ASC_COMMISSION_CURRENCY'));    $R0B7C00CAFFBAA83B78870C2CD520EA74 = 1;    if($RBDF1E52780E67C6D25724A766C4FDB32 == SellerCommission::RECORD_TYPE_SELLER_DEBIT)$R0B7C00CAFFBAA83B78870C2CD520EA74 = -1;           $R08331032AF766761F73862782421264A = new SellerCommission();       $R08331032AF766761F73862782421264A->id = 0;       $R08331032AF766761F73862782421264A->id_seller = $R95909C49377A2B4F24C79D29C629AF65;       $R08331032AF766761F73862782421264A->id_currency = $currency->id;       $R08331032AF766761F73862782421264A->id_order = $RDE6D1531493DFC39BA2B390CA5A01256;       $R08331032AF766761F73862782421264A->sales_amount = 0;       $R08331032AF766761F73862782421264A->base_commission = 0;       $R08331032AF766761F73862782421264A->range_commission = 0;       $R08331032AF766761F73862782421264A->seller_sales = 0;       $R08331032AF766761F73862782421264A->payment_txn_id = $R53E32B8E29E2609B74F8597A5E9BBF18;       $R08331032AF766761F73862782421264A->memo = $RBAE26E5418D470B98B4288F224FCD429;      $R08331032AF766761F73862782421264A->record_type = $RBDF1E52780E67C6D25724A766C4FDB32;    $R08331032AF766761F73862782421264A->record_balance =  $R0B7C00CAFFBAA83B78870C2CD520EA74 * $R68EAF33C4E51B47C7219F805B449C109;          $R08331032AF766761F73862782421264A->balance = 0;           $R08331032AF766761F73862782421264A->save();                  SellerCommission::updateBalance($R95909C49377A2B4F24C79D29C629AF65,$R08331032AF766761F73862782421264A->id);     }     }  