<?php
/**
 * validation.php
 *
 * Copyright (c) 2011 VitePay (Pty) Ltd
 *
 * LICENSE:
 *
 * This payment module is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published
 * by the Free Software Foundation; either version 3 of the License, or (at
 * your option) any later version.
 *
 * This payment module is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser General Public
 * License for more details.
 *
 * @author    Cheick Tall<cheick.tall@vitepay.com>
 * @version    1.0
 * @date       07/07/2015
 *
 * @copyright 2015 VitePay (Pty) Ltd
 * @license   http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link       http://www.vitepay.com
 */

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__) . '/vitepay.php');
//include(dirname(__FILE__) . '/vitepay_common.inc');


define('PF_SOFTWARE_NAME', 'PrestaShop');
define('PF_SOFTWARE_VER', Configuration::get('PS_INSTALL_VERSION'));
define('PF_MODULE_NAME', 'VitePay-Prestashop');
define('PF_MODULE_VER', '2.1.1');
define('PF_DEBUG', (Configuration::get('VITEPAY_LOGS')  ? true : false));

// Features
// - PHP
$pfFeatures = 'PHP '. phpversion() .';';

// - cURL
if (in_array('curl', get_loaded_extensions())) {
    define('PF_CURL', '');
    $pfVersion = curl_version();
    $pfFeatures .= ' curl '. $pfVersion['version'] .';';
} else {
    $pfFeatures .= ' nocurl;';
}
// Create user agrent
define(
'PF_USER_AGENT',
    PF_SOFTWARE_NAME .'/'. PF_SOFTWARE_VER .' ('. trim($pfFeatures) .') '. PF_MODULE_NAME .'/'. PF_MODULE_VER
);

// General Defines
define('PF_TIMEOUT', 15);
define('PF_EPSILON', 0.01);

// Messages
// Error
define('PF_ERR_AMOUNT_MISMATCH', 'Amount mismatch');
define('PF_ERR_BAD_ACCESS', 'Bad access of page');
define('PF_ERR_BAD_SOURCE_IP', 'Bad source IP address');
define('PF_ERR_CONNECT_FAILED', 'Failed to connect to VitePay');
define('PF_ERR_INVALID_SIGNATURE', 'Security signature mismatch');
define('PF_ERR_MERCHANT_ID_MISMATCH', 'Merchant ID mismatch');
define('PF_ERR_NO_SESSION', 'No saved session found for ITN transaction');
define('PF_ERR_ORDER_ID_MISSING_URL', 'Order ID not present in URL');
define('PF_ERR_ORDER_ID_MISMATCH', 'Order ID mismatch');
define('PF_ERR_ORDER_INVALID', 'This order ID is invalid');
define('PF_ERR_ORDER_NUMBER_MISMATCH', 'Order Number mismatch');
define('PF_ERR_ORDER_PROCESSED', 'This order has already been processed');
define('PF_ERR_PDT_FAIL', 'PDT query failed');
define('PF_ERR_PDT_TOKEN_MISSING', 'PDT token not present in URL');
define('PF_ERR_SESSIONID_MISMATCH', 'Session ID mismatch');
define('PF_ERR_UNKNOWN', 'Unkown error occurred');

// General
define('PF_MSG_OK', 'Payment was successful');
define('PF_MSG_FAILED', 'Payment has failed');
define(
'PF_MSG_PENDING',
    'The payment is pending. Please note, you will receive another Instant'.
    ' Transaction Notification when the payment status changes to'.
    ' "Completed", or "Failed"'
);


/**
 * pflog
 *
 * Log function for logging output.
 *
 * @author Jonathan Smit -- Original
 * @author Cheick Tall
 * @param $msg String Message to log
 * @param $close Boolean Whether to close the log file or not
 */
function pflog($msg = '', $close = false)
{
    static $fh = 0;
    //global $module;

    // Only log if debugging is enabled
    if (PF_DEBUG) {
        if ($close) {
            fclose($fh);
        } else {
            // If file doesn't exist, create it
            if (!$fh) {
                $pathinfo = pathinfo(__FILE__);
                $fh = fopen($pathinfo['dirname'] .'/vitepay.log', 'a+');
            }

            // If file was successfully created
            if ($fh) {
                $line = date('Y-m-d H:i:s') .' : '. $msg ."\n";

                fwrite($fh, $line);
            }
        }
    }
}

/**
 * pfGetData
 *
 * @author Cheick Tall
 */
function pfGetData()
{
    // Posted variables from ITN
    $pfData = $_POST;

    // Strip any slashes in data
    foreach ($pfData as $key => $val) {
        $pfData[$key] = Tools::stripslashes($val);
    }
    // Return "false" if no data was received
    if (sizeof($pfData) == 0) {
        return (false);
    } else {
        return($pfData);
    }
}

/**
 * pfValidSignature
 *
 * @author Cheick Tall
 */
function pfValidSignature($pfData = null, &$pfParamString = null, $pfPassphrase = null)
{

    $signature = false;
    // Check if  Order ID and authenticity is not null.
    if (isset($pfData['order_id']) && isset($pfData['authenticity'])) {

        // Recover Order and Authenticity values
        $vp_Order_ID = $pfData['order_id'];
        #$vp_Authenticity = $pfData['authenticity'];

        $order_id = $vp_Order_ID;

        if ($order_id != '') {

            $cart = new Cart($vp_Order_ID);

            $our_authenticity = sprintf(
                '%s;%s;%s;%s',
                $order_id,
                $cart->getOrderTotal(true) * 100,
                'XOF',
                $pfPassphrase
            );
            #$raw = sprintf('%s;%s;%s;%s', $order_id, $cart->getOrderTotal(true) * 100, 'XOF', $pfPassphrase);

            $our_authenticity = Tools::strtoupper(sha1($our_authenticity));
            #pflog('Ours = '. $our_authenticity);
            #pflog('Theirs = '. $pfData['authenticity'] );
            #pflog('raw = '. $raw);

            if ($our_authenticity == $pfData['authenticity']) {

                $signature = true;

            }
        }

    }

    $result = $signature;

    pflog('Signature = '. ($result ? 'valid' : 'invalid'));

    return($result);
}
// }}}
// {{{ pfValidIP
/**
 * pfValidIP
 *
 * @author Cheick Tall
 * @param $sourceIP String Source IP address
 */
function pfValidIP($sourceIP)
{
    // Variable initialization
    $validHosts = array(
        '*.vitepay.com',
        'api.vitepay.com',
        'store.vitepay.com'
    );

    $validIps = array();

    foreach ($validHosts as $pfHostname) {
        $ips = gethostbynamel($pfHostname);

        if ($ips !== false) {
            $validIps = array_merge($validIps, $ips);
        }
    }

    // Remove duplicates
    $validIps = array_unique($validIps);

    pflog("Valid IPs:\n". print_r($validIps, true));

    if (in_array($sourceIP, $validIps)) {
        return (true);
    } else {
        return(false);
    }
}
// }}}
// {{{ pfAmountsEqual
/**
 * pfAmountsEqual
 *
 * Checks to see whether the given amounts are equal using a proper floating
 * point comparison with an Epsilon which ensures that insignificant decimal
 * places are ignored in the comparison.
 *
 * eg. 100.00 is equal to 100.0001
 *
 * @author Cheick Tall
 * @param $amount1 Float 1st amount for comparison
 * @param $amount2 Float 2nd amount for comparison
 */
function pfAmountsEqual($amount1, $amount2)
{
    if (abs((float)($amount1) - (float)($amount2)) > PF_EPSILON) {
        return (false);
    } else {
        return (true);
    }
}

// Check if this is an ITN request
// Has to be done like this (as opposed to "exit" as processing needs
// to continue after this check.

if (Tools::getValue("vp_request") == 'true') {
    // Variable Initialization
    $pfError = false;
    $pfErrMsg = '';
    $pfDone = false;
    $pfData = array();
    $pfHost = (
    (Configuration::get(
            'PAYFAST_MODE'
        ) == 'live') ? 'https://api.vitepay.com/v1/prod' : 'https://api.vitepay.com/v1/sandbox'
    );
    $pfOrderId = '';
    $pfParamString = '';

    $vitepay = new VitePay();

    pflog('VitePay vp_request call received');

    //// Notify VitePay that information has been received
    if (!$pfError && !$pfDone) {
        header('HTTP/1.0 200 OK');
        flush();
    }

    //// Get data sent by VitePay
    if (!$pfError && !$pfDone) {
        pflog('Get posted data');

        pflog('VitePay Data: '. print_r($_POST, true));

        // Posted variables from ITN
        $pfData = pfGetData();

        pflog('VitePay Data: '. print_r($pfData, true));

        if ($pfData === false) {
            $pfError = true;
            $pfErrMsg = PF_ERR_BAD_ACCESS;
        }
    }

    //// Verify security signature
    if (!$pfError && !$pfDone) {
        pflog('Verify security signature');

        #$passPhrase = Configuration::get('PAYFAST_PASSPHRASE');
        $passPhrase = Configuration::get('VITEPAY_API_KEY');
        $pfPassPhrase = empty($passPhrase) ? null : $passPhrase;

        // If signature different, log for debugging
        if (!pfValidSignature($pfData, $pfParamString, $pfPassPhrase)) {
            $pfError = true;
            $pfErrMsg = PF_ERR_INVALID_SIGNATURE;
        }
    }
    /*
    //// Verify source IP (If not in debug mode)
    if (!$pfError && !$pfDone && !PF_DEBUG) {
        pflog('Verify source IP');

        if (!pfValidIP($_SERVER['REMOTE_ADDR'])) {
            $pfError = true;
            $pfErrMsg = PF_ERR_BAD_SOURCE_IP;
        }
    }
    */
    //// Get internal cart
    if (!$pfError && !$pfDone) {
        // Get order data
        $cart = new Cart((int) $pfData['order_id']);

        pflog("Purchase:\n". print_r($cart, true));
    }
    //// Check data against internal order
    if (!$pfError && !$pfDone) {
        // pflog('Check data against internal order');
        $fromCurrency = new Currency(Currency::getIdByIsoCode('XOF'));
        $toCurrency = new Currency((int)$cart->id_currency);

        $total = Tools::convertPriceFull($cart->getOrderTotal(), $fromCurrency, $toCurrency);

        // Check order amount
        if (strcasecmp($pfData['order_id'], $cart->id) != 0) {
            $pfError = true;
            $pfErrMsg = PF_ERR_SESSIONID_MISMATCH;
        }
    }

    $vendor_name = Configuration::get('PS_SHOP_NAME');
    $vendor_url = Tools::getShopDomain(true, true);

    //// Check status and update order
    if (!$pfError && !$pfDone) {
        pflog('Check status and update order');

        //$sessionid = $pfData['custom_str1'];
        $transaction_id = $pfData['order_id'];

        if (empty(Context::getContext()->link)) {
            Context::getContext()->link = new Link();
        }

        $vp_success = false;

        if ($pfData['success'] == 1) {


            pflog('- Complete');

            // Update the purchase status
            $vp_success = $vitepay->validateOrder(
                (int)$pfData['order_id'],
                _PS_OS_PAYMENT_,
                (float)$total,
                $vitepay->displayName,
                null,
                array('transaction_id' => $transaction_id),
                null,
                false,
                $cart->secure_key
            );
            pflog('debug:' . $vp_success );
            if ($vp_success == true) {echo json_encode(array("status"=>1, "message" => "OK"));}
            else {echo json_encode(array("status"=>0, "message" => $vp_success));}

        } elseif ($pfData['failure'] == 1) {


            pflog('- Failed');

            // If payment fails, delete the purchase log
            $vp_success = $vitepay->validateOrder(
                (int)$pfData['order_id'],
                _PS_OS_ERROR_,
                (float)$total,
                $vitepay->displayName,
                null,
                array('transaction_id' => $transaction_id),
                null,
                false,
                $cart->secure_key
            );
            pflog('debug:' . $vp_success );
            if ($vp_success == true) {echo json_encode(array("status"=>1, "message" => "KO"));}
            else {echo json_encode(array("status"=>0, "message" => $vp_success));}

        } else {

            pflog('- Pending');
            pflog('debug:' . $vp_success );
            echo json_encode(array("status"=>0, "error"=>"unknown status"));
        }


    }

    // If an error occurred
    if ($pfError) {
        pflog('Error occurred: '. $pfErrMsg);
    }

    // Close log
    pflog('', true);
    exit();
}
