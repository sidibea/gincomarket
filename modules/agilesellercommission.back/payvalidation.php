<?php
///-build_id: 2017010213.5255
/// This source file is subject to the Software License Agreement that is bundled with this 
/// package in the file license.txt, or you can get it here
/// http://addons-modules.com/en/content/3-terms-and-conditions-of-use
///
/// @copyright  2009-2016 Addons-Modules.com
///  If you need open code to customize or merge code with othe modules, please contact us.
include_once(dirname(__FILE__).'/../../config/config.inc.php');
include_once(dirname(__FILE__).'/../../init.php');
include_once(dirname(__FILE__).'/agilesellercommission.php');
include_once(dirname(__FILE__).'/SellerCommission.php');
include_once(dirname(__FILE__).'/../../modules/agilemultipleseller/agilemultipleseller.php');
include_once(dirname(__FILE__).'/../../modules/agilemultipleseller/SellerInfo.php');

$errors = '';
$result = false;
$asc_module = new AgileSellerCommission();

$params = 'cmd=_notify-validate';
foreach ($_POST AS $key => $value)
	$params .= '&'.$key.'='.urlencode(stripslashes($value));

$paypalServer = 'www.'.(Configuration::get('ASC_PAYPAL_SANDBOX') ? 'sandbox.' : '').'paypal.com';

if (function_exists('curl_exec'))
{
		$ch = curl_init('https://' . $paypalServer . '/cgi-bin/webscr');
    
	 	if (!$ch)
		$ch = curl_init('https://' . $paypalServer . '/cgi-bin/webscr/');
	
	if (!$ch)
		$errors .= $asc_module->getL('connect').' '.$asc_module->getL('curlmethodfailed');
	else
	{
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($ch, CURLOPT_SSLVERSION, defined('CURL_SSLVERSION_TLSv1_2') ? CURL_SSLVERSION_TLSv1_2 : 6);
		
		$result = curl_exec($ch);
		if ($result != 'VERIFIED')
		{
			curl_setopt($ch, CURLOPT_SSLVERSION, 3);
			$result = curl_exec($ch);
			if ($result != 'VERIFIED')
				$errors .= $paypal->getL('curlmethod').$result.' cURL error:'.curl_error($ch);
		}
		curl_close($ch);
	}
}
if($result != 'VERIFIED' OR !empty($errors))
{
    if (($fp = @fsockopen('ssl://' . $paypalServer, 443, $errno, $errstr, 30)) || ($fp = @fsockopen($paypalServer, 80, $errno, $errstr, 30)))
    {
	    	    $header = 'POST /cgi-bin/webscr HTTP/1.0'."\r\n" .
              'Host: '.$paypalServer."\r\n".
              'Content-Type: application/x-www-form-urlencoded'."\r\n".
              'Content-Length: '.Tools::strlen($params)."\r\n".
              'Connection: close'."\r\n\r\n";
	    fputs($fp, $header.$params);
     	
 	    $read = '';
 	    while (!feof($fp))
	    {
		    $reading = trim(fgets($fp, 1024));
		    $read .= $reading;
		    if (($reading == 'VERIFIED') || ($reading == 'INVALID'))
		    {
		 	    $result = $reading;
			    break;
		    }
 	    }
	    if ($result != 'VERIFIED')
		    $errors .= $asc_module->getL('socketmethod').$result;
	    fclose($fp);
    }
    else
	    $errors = $asc_module->getL('connect').$asc_module->getL('nomethod');
}



if ($result == 'VERIFIED') {
	if (!isset($_POST['mc_gross']))
		$errors .= $asc_module->getL('mc_gross').'<br />';
	if (!isset($_POST['payment_status']))
		$errors .= $asc_module->getL('payment_status').'<br />';
	elseif ($_POST['payment_status'] != 'Completed')
		$errors .= $asc_module->getL('payment').$_POST['payment_status'].'<br />';
	if (!isset($_POST['custom']))
		$errors .= $asc_module->getL('custom').'<br />';
	if (!isset($_POST['txn_id']))
		$errors .= $asc_module->getL('txn_id').'<br />';
	if (!isset($_POST['invoice']))
		$errors .= $asc_module->getL('Invalid payment record type').'<br />';
    else if(intval($_POST['invoice']) != SellerCommission::RECORD_TYPE_STORE_PAY_SELLER AND intval($_POST['invoice'])!= SellerCommission::RECORD_TYPE_SELLER_PAY_STORE)
    	$errors .= $asc_module->getL('Invalid payment record type').'<br />';
	if (!isset($_POST['mc_currency']))
		$errors .= $asc_module->getL('mc_currency').'<br />';
	if (empty($errors))
	{
                $sql = 'SELECT id_seller_commission FROM `'._DB_PREFIX_.'seller_commission` WHERE payment_txn_id=\'' .  $_POST['txn_id'] . '\'';
        $id_seller_commission = intval(Db::getInstance()->getValue($sql));
        if($id_seller_commission >0)
            $comm = new SellerCommission($id_seller_commission);
        else
            $comm = new SellerCommission();
    
        $comm->id_seller = intval($_POST['custom']);
        $comm->id_order = 0;
        $comm->id_currency = intval(Configuration::get('ASC_COMMISSION_CURRENCY'));
        $comm->sales_amount = 0;
        $comm->base_commission = 0;
        $comm->range_commission = 0;
        $comm->seller_sales = 0;
        $comm->record_type = intval(Tools::getValue('invoice'));         if($comm->record_type == SellerCommission::RECORD_TYPE_STORE_PAY_SELLER)         {
            $comm->record_balance = - $_POST['mc_gross'];
        }
        else
        {
            $comm->record_balance = $_POST['mc_gross'];
        }

        $comm->payment_txn_id = $_POST['txn_id'];
        $comm->memo = $params;
        $comm->save();
        
        SellerCommission::updateBalance($comm->id_seller, $comm->id);
        	
	}
	else
	{
	}
} 
else {
	$errors .= $asc_module->getL('verified');
}

if(!empty($errors))
{
    echo '<div style="color:red">';
    foreach($errors AS $error)
    {
        echo $error;
    }
    echo '<div>';
}

