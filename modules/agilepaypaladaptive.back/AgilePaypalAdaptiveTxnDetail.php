<?php
///-build_id: 2016030721.4219
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.

if (!defined('_CAN_LOAD_FILES_') AND _PS_VERSION_ > '1.3.2')
	exit;

class AgilePaypalAdaptiveTxnDetail extends ObjectModel
{
        const   RECORD_TYPE_BUYER_PAY_STORE = 3;         const   RECORD_TYPE_BUYER_PAY_SELLER = 1;         const   RECORD_TYPE_BUYER_PAY_BOTH = 2;         const   RECORD_TYPE_SELLER_PAY_STORE = 101;       const   RECORD_TYPE_STORE_PAY_SELLER =102;         const   RECORD_TYPE_ORDER_CANCELLATION = -1; 
  	public 		$id;
	
	public 		$paykey;
	public 		$id_seller; 	public      $id_cart;
	public 		$receiver_email;
	public 		$amount;
	public      $id_currency;
	public 		$record_type;
	public      $is_primary;
	public      $status;
	public      $paypal_txnid;
	public 		$remark;

		public 		$date_add;
	
	protected 	$table = 'agilepaypaladaptive_txndetail';
	protected 	$identifier = 'id_agilepaypaladaptive_txndetail';

 	protected 	$fieldsRequired = array('paykey');
 	protected 	$fieldsSize = array();
	
	public function getFields()   {      if (isset($this->id))     $RB0D5D47F3D2E32A124C14253ABA3976A['id_agilepaypaladaptive_txndetail'] = (int)($this->id);    $RB0D5D47F3D2E32A124C14253ABA3976A['paykey'] = pSQL($this->paykey);    $RB0D5D47F3D2E32A124C14253ABA3976A['id_seller'] = intval($this->id_seller);    $RB0D5D47F3D2E32A124C14253ABA3976A['id_cart'] = intval($this->id_cart);    $RB0D5D47F3D2E32A124C14253ABA3976A['receiver_email'] = pSQL($this->receiver_email);    $RB0D5D47F3D2E32A124C14253ABA3976A['amount'] = floatval($this->amount);    $RB0D5D47F3D2E32A124C14253ABA3976A['id_currency'] = floatval($this->id_currency);    $RB0D5D47F3D2E32A124C14253ABA3976A['record_type'] = intval($this->record_type);    $RB0D5D47F3D2E32A124C14253ABA3976A['is_primary'] = intval($this->is_primary);    $RB0D5D47F3D2E32A124C14253ABA3976A['paypal_txnid'] = pSQL($this->paypal_txnid);    $RB0D5D47F3D2E32A124C14253ABA3976A['status'] = pSQL($this->status);    $RB0D5D47F3D2E32A124C14253ABA3976A['date_add'] = pSQL($this->date_add);    $RB0D5D47F3D2E32A124C14253ABA3976A['date_upd'] = pSQL($this->date_upd);    return $RB0D5D47F3D2E32A124C14253ABA3976A;   }         public static function getTxnDetailIDByCartSellerId($RF50CDD3F2AACFD3098534F1C052C25BE, $R95909C49377A2B4F24C79D29C629AF65)   {               $R130D64A4AD653C91E0FD80DE8FEADC3A = 'SELECT `id_agilepaypaladaptive_txndetail` FROM `' . _DB_PREFIX_ .'agilepaypaladaptive_txndetail` WHERE id_cart=' . $RF50CDD3F2AACFD3098534F1C052C25BE . ' AND id_seller=' . $R95909C49377A2B4F24C79D29C629AF65;       $RDADBDE6DA00922BBCB7461BF44AC8F34 = Db::getInstance()->getValue($R130D64A4AD653C91E0FD80DE8FEADC3A);        return intval($RDADBDE6DA00922BBCB7461BF44AC8F34);   }     public static function getTxnDetailIDPaykeyEmail($paykey, $RBD82866B17A3A09865E479224369ADE7)   {               $R130D64A4AD653C91E0FD80DE8FEADC3A = 'SELECT `id_agilepaypaladaptive_txndetail` FROM `' . _DB_PREFIX_ .'agilepaypaladaptive_txndetail` WHERE paykey=\'' . $paykey . '\' AND receiver_email=\'' . $RBD82866B17A3A09865E479224369ADE7 . '\'';       $RDADBDE6DA00922BBCB7461BF44AC8F34 = Db::getInstance()->getValue($R130D64A4AD653C91E0FD80DE8FEADC3A);        return intval($RDADBDE6DA00922BBCB7461BF44AC8F34);   }        public static function getTxnDetailsByPaykey($paykey)   {       $R130D64A4AD653C91E0FD80DE8FEADC3A = 'SELECT a.*,                    CONCAT(firstname, \' \', e.lastname) AS `seller_name`           FROM `' . _DB_PREFIX_ .'agilepaypaladaptive_txndetail` a               LEFT JOIN `' . _DB_PREFIX_ .'employee` e ON a.id_seller=e.id_employee           WHERE paykey=\'' . $paykey . '\'           ORDER BY a.is_primary DESC           ';       return Db::getInstance()->ExecuteS($R130D64A4AD653C91E0FD80DE8FEADC3A);    }     }  