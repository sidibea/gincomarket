<?php
///-build_id: 2016030721.4219
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2012 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
@session_start();


include_once(dirname(__FILE__).'/../../config/config.inc.php');
include_once(dirname(__FILE__).'/../../init.php');
include_once(dirname(__FILE__).'/agilepaypaladaptive.php');
include_once(dirname(__FILE__).'/AgilePaypalAdaptiveTxn.php');
include_once(dirname(__FILE__).'/AgilePaypalAdaptiveTxnDetail.php');
include_once(dirname(__FILE__).'/../agilesellercommission/SellerCommission.php');


require_once(dirname(__FILE__) . '/Lib/Config/Config.php');
require_once(dirname(__FILE__) . '/Lib/CallerService.php');
require_once(dirname(__FILE__) . '/Lib/NVP_SampleConstants.php');


$errors = '';
$module = new AgilePaypalAdaptive();

process_ipn();

if(!empty($errors))
{
    echo '<table><tr><td>Errors</td></tr>';
    foreach($errors AS $error)
    {
        echo '<tr><td>' . $error . '</td></tr>';
    }
    echo '</table>';
}

function process_ipn()
{
    global $errors,$module;


        $paykey = $_POST['pay_key'];
    if(empty($paykey))
    {
        $errors[] = 'Paykey is empty';
        return;
    }
        $ipn_status = $_POST['status'];
    if($ipn_status != 'COMPLETED' AND $ipn_status != 'PENDING')
    {
        $errors[] = 'IPN Status is not interested';
        return;
    }


        $request_array = array (
	    PaymentDetails::$payKey=> $paykey,
	    RequestEnvelope::$requestEnvelopeErrorLanguage=> 'en_US'
    );

    $nvpStr=http_build_query($request_array, '', '&');
    if(isset($_SESSION['curl_call_error']))unset($_SESSION['curl_call_error']);
    $resArray=hash_call($module->getPaypalServiceEndpoint(),"AdaptivePayments/PaymentDetails",$nvpStr);
    if(isset($_SESSION['curl_call_error']))
    {
        $errors[] = $_SESSION['curl_call_error'];
        return;
    }   

        $ack = strtoupper($resArray["responseEnvelope.ack"]);
    if($ack!="SUCCESS")
    {
	    foreach($resArray as $key => $value) $errors[] = "$key:$value<br />";
	    return;
    }
    

            
        update_apatxndetail_data($paykey,$resArray);
    if(!empty($errors))return;

    update_apatxn_data($paykey,$resArray);
    if(!empty($errors))return;
    
}

function update_apatxn_data($paykey, $resPaymentData)
{
    global $errors, $module;
        $apa_txn_id = intval(AgilePaypalAdaptiveTxn::getTxnByPaykey($paykey));
    if(!$apa_txn_id)
    {
        $errors[] = 'Transaction not found in database';
        return;
    }
    
    $apa_txn = new AgilePaypalAdaptiveTxn($apa_txn_id);
    if(!Validate::isLoadedObject($apa_txn))
    {
        $errors[] = 'Failed to load transaction from database';
        return;
    }
    $currencycode = $resPaymentData['currencyCode'];
    $currency = new Currency($apa_txn->id_currency);
    if($currency->iso_code != $currencycode)
    {
        $errors[] = 'Currency code does not match:' . $currency->iso_code . ' - '. $currencycode;
        return;
    }
    
    $txn_status =  $resPaymentData['status'];
    $senderemail =  $resPaymentData['senderEmail'];
    $token =  $resPaymentData['payKey'];
    
    if($token != $paykey)
    {
        $errors[] = 'Payment respone token does not macth';
        return;
    }
    if(empty($senderemail) OR empty($txn_status))
    {
        $errors[] = 'Invalid email address or status';
        return;
    }
    
    $apa_txn->payer_email = $senderemail;
    $apa_txn->status = $txn_status;
    $apa_txn->id_order = $id_order;
    $apa_txn->date_upd = date('Y-m-d H:i:s');
    $apa_txn->save();
    
    if($txn_status == 'COMPLETED' OR $txn_status == 'PENDING')
    {
        $theCart = new Cart($apa_txn->id_cart);
        if(!Validate::isLoadedObject($theCart))
        {
            $errors[] = 'Failed to load shopping cart informaiton from database';
            return;
        }
        
        $id_order_state = ($txn_status == 'COMPLETED'? _PS_OS_PAYMENT_ : _PS_OS_PAYPAL_);
                $real_paid_amount_in_cart_currency = $apa_txn->amount;
        if($theCart->id_currency != $apa_txn->id_currency)
        {
            $cart_currency = new Currency($theCart->id_currency);
            $paid_currency = new Currency($apa_txn->id_currency);
            if(!Validate::isLoadedObject($cart_currency) OR !Validate::isLoadedObject($paid_currency))
            {
                $errors[] = 'Currency error: currency informaiton not found.';
                return;
            }
            $real_paid_amount_in_cart_currency  = Tools::ps_round($apa_txn->amount * $cart_currency->conversion_rate / $paid_currency->conversion_rate,2);
        }
		$module->validateOrder($apa_txn->id_cart, $id_order_state, $real_paid_amount_in_cart_currency, $module->displayName, NULL, array('transaction_id' => $paykey), NULL, false, $theCart->secure_key);
		
        if($module->currentOrder>0)
        {
            $apa_txn->id_order = $module->currentOrder;
            $apa_txn->save();
            SellerCommission::updateRecordType($module->currentOrder, $apa_txn->paymode, $apa_txn->paykey);
        }
    }
}

function update_apatxndetail_data($paykey, $resPaymentData)
{
    global $errors, $module;
    if(empty($paykey) OR empty($resPaymentData))
    {
        $errors[] = 'Invalid payment data';
        return;
    }

    $counter = 0;
    for($idx = 0; $idx<=5;$idx++)
    {
        $txnid = $resPaymentData[parameter_key($idx,'transactionId')];
        $txnStatus = $resPaymentData[parameter_key($idx,'transactionStatus')];
        $receiver_email = $resPaymentData[parameter_key($idx,'receiver.email')];
        $amount = floatval($resPaymentData[parameter_key($idx,'receiver.amount')]);
        
        if(empty($txnid) AND empty($txnStatus) AND empty($receiver_email))continue;
        if(empty($txnid) OR empty($txnStatus) OR empty($receiver_email))
        {
            $errors[] = 'Invalid payment details data';
            return;
        }
        $receiver_primary = ($resPaymentData[parameter_key($idx,'.receiver.primary')] == 'true'? 1:0);
        $senderTxnId = $resPaymentData[parameter_key($idx,'senderTransactionId')];
        $senderTxnStatus = $resPaymentData[parameter_key($idx,'senderTransactionStatus')];
        $refundedAmount = $resPaymentData[parameter_key($idx,'refundedAmount')];
        $pendingRefund = $resPaymentData[parameter_key($idx,'pendingRefund')];

        $apa_txndetail = new AgilePaypalAdaptiveTxnDetail(AgilePaypalAdaptiveTxnDetail::getTxnDetailIDPaykeyEmail($paykey, $receiver_email));
        if(!Validate::isLoadedObject($apa_txndetail))
        {
            $errors[] = 'No matchd payment details record in database';
            return;        
        }
        if($amount != $apa_txndetail->amount)
        {
            $errors[] = 'Seller amount does not math between Paypal and DB';
            return;        
        }
        $apa_txndetail->status = $txnStatus;
        $apa_txndetail->paypal_txnid = $txnid;
        $apa_txndetail->date_upd = date('Y-m-d H:i:s');
        $apa_texndetail->remark = 'refunded amount:' . $refundedAmount . ' pendingRefund:' . $pendingRefund;

        $apa_txndetail->save();
    
        $counter++;
    }
}

function display_response($resArray)
{
    echo '<table><tr><td colspan="2"></td></tr>';
    foreach($resArray as $key => $value) 
        echo "<tr><td> $key:</td><td>$value</td></tr>";
    echo '</table>';
}

function parameter_key($idx, $field)
{
    return 'paymentInfoList.paymentInfo(' . $idx . ').' . $field;
}
function create_seller_commmission_record($apa_txn,$apa_txndetail)
{
    $currency_paid = new Currency($apa_txndetail['id_currency']);
    $currency_commission = new Currency(intval(Configuration::get('ASC_COMMISSION_CURRENCY')));
    $conversion_rate = $currency_commission->conversion_rate / $currency_paid->conversion_rate;

    $sql = 'SELECT id_seller_commission FROM `'._DB_PREFIX_.'seller_commission` WHERE payment_txn_id=\'' .  $apa_txndetail['paypal_txnid'] . '\'';
    $id_seller_commission = intval(Db::getInstance()->getValue($sql));
    if($id_seller_commission >0)
        $comm = new SellerCommission($id_seller_commission);
    else
        $comm = new SellerCommission();

    $comm->id_seller = $apa_txndetail['id_seller'];
    $comm->id_order = $apa_txn->id_order;
    $comm->id_currency = $currency_commission->id;
    $comm->sales_amount = 0;
    $comm->base_commission = 0;
    $comm->range_commission = 0;
    $comm->seller_sales = 0;
    $comm->record_type = SellerCommission::RECORD_TYPE_STORE_PAY_SELLER;
    $comm->record_balance = - $apa_txndetail['amount'] * $conversion_rate;

    $comm->payment_txn_id = $apa_txndetail['paypal_txnid'];
    $comm->memo = '';
    $comm->save();
    
    SellerCommission::updateBalance($comm->id_seller, $comm->id);
    
}

