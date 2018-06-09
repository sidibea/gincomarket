<?php
///-build_id: 2016030721.4219
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
class AgilePaypalAdaptiveTxn extends ObjectModel
{
  	public 		$id;
	
	public 		$id_cart;
	public 		$id_order;
	public 		$paykey;
	public 		$paymode;
	public      $id_currency;
	public 		$status;
	public 		$amount;
	public 		$remark;
	public      $payer_email;

		public 		$date_add;
	public 		$date_udp;
	
	protected 	$table = 'agilepaypaladaptive_txn';
	protected 	$identifier = 'id_agilepaypaladaptive_txn';

 	protected 	$fieldsRequired = array('id_cart','pay_key');
 	protected 	$fieldsSize = array();
 		
	public function getFields()   {    if (isset($this->id))     $RB0D5D47F3D2E32A124C14253ABA3976A['id_agilepaypaladaptive_txn'] = (int)($this->id);    $RB0D5D47F3D2E32A124C14253ABA3976A['id_cart'] = intval($this->id_cart);    $RB0D5D47F3D2E32A124C14253ABA3976A['id_order'] = intval($this->id_order);    $RB0D5D47F3D2E32A124C14253ABA3976A['id_currency'] = intval($this->id_currency);    $RB0D5D47F3D2E32A124C14253ABA3976A['paykey'] = pSQL($this->paykey);    $RB0D5D47F3D2E32A124C14253ABA3976A['paymode'] = pSQL($this->paymode);    $RB0D5D47F3D2E32A124C14253ABA3976A['amount'] = floatval($this->amount);    $RB0D5D47F3D2E32A124C14253ABA3976A['status'] = $this->status;    $RB0D5D47F3D2E32A124C14253ABA3976A['payer_email'] = pSQL($this->payer_email);    $RB0D5D47F3D2E32A124C14253ABA3976A['remark'] = pSQL($this->remark);    $RB0D5D47F3D2E32A124C14253ABA3976A['date_add'] = pSQL($this->date_add);    $RB0D5D47F3D2E32A124C14253ABA3976A['date_upd'] = pSQL($this->date_upd);    return $RB0D5D47F3D2E32A124C14253ABA3976A;   }      public static function getTxnByCartId($RF50CDD3F2AACFD3098534F1C052C25BE)   {       if(!intval($RF50CDD3F2AACFD3098534F1C052C25BE))return 0;       $R130D64A4AD653C91E0FD80DE8FEADC3A = 'SELECT `id_agilepaypaladaptive_txn` FROM `' . _DB_PREFIX_ .'agilepaypaladaptive_txn` WHERE id_cart=' . intval($RF50CDD3F2AACFD3098534F1C052C25BE);       $RC0B91C945F317007CE0174BAC72E4286 = Db::getInstance()->getValue($R130D64A4AD653C91E0FD80DE8FEADC3A);        return intval($RC0B91C945F317007CE0174BAC72E4286);   }     public static function getTxnByPaykey($paykey)   {       $R130D64A4AD653C91E0FD80DE8FEADC3A = 'SELECT `id_agilepaypaladaptive_txn` FROM `' . _DB_PREFIX_ .'agilepaypaladaptive_txn` WHERE paykey=\'' . $paykey . '\'';       $RC0B91C945F317007CE0174BAC72E4286 = Db::getInstance()->getValue($R130D64A4AD653C91E0FD80DE8FEADC3A);        return intval($RC0B91C945F317007CE0174BAC72E4286);   }             }  