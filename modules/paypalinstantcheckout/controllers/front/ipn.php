<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

require_once dirname(__FILE__) . '/hsabstractpaypalconnection.php';

class PaypalInstantCheckoutIPNModuleFrontController extends PaypalInstantCheckoutHsAbstractPaypalConnectionModuleFrontController
{
    /**
     *
     * @var boolean
     */
    public $content_only = true;

    protected function doPostProcess()
    {
        $paypal_ipn_api = new HsPaypalIPNApi($this->mode, $this->identify_token);
        $ipn_request = $this->getIpnRequest();
        $paypal_custom_params = explode('_', Tools::getValue('custom'));
        if ($this->isReadyToGo($paypal_custom_params)) {
            $paypal_response = $paypal_ipn_api->formatResponse($paypal_ipn_api->getResponse($ipn_request));
            $this->module->setResponse($ipn_request);
            if ($paypal_response['success'] && $this->validateEmail($ipn_request['receiver_email'])) {
                $this->initCustomer();
                $id_product = $this->getProductId($paypal_custom_params);
                $this->module->setProductId($id_product);
                if (!$this->context->cart->OrderExists()) {
                    $this->updateCart();
                    $paypal_address = $this->module->getPayPalAddress();
                    $this->module->setPayPalIdAddress($paypal_address->id);
                    $id_order_state = $this->module->getIdOrderStateBasedOnPaypalPaymentStatus();
                    $order_message = $this->module->getOrderMessage();
                    $this->module->validateOrder($this->context->cart->id, $id_order_state, $this->module->paypal_response['mc_gross'], 'PayPal Instant Checkout', $order_message, null, null, false, $this->context->customer->secure_key);
                    $this->is_post_process_executed = true;
                }
            }
        }
    }

    protected function validateEmail($receiver_email)
    {
        return Validate::isEmail($receiver_email) && $receiver_email == HsPaypalInstantCheckOut::getPaypalAccount();
    }

    public function display()
    {
        //Important: we need to send back "OK" to PayPal
        if ($this->is_post_process_executed) {
            die('OK');
        }
    }

    /**
     *
     * @return array
     * <pre>
     * array(
     *      [mc_gross] => float
     *      [protection_eligibility] => string
     *      [address_status] => string
     *      [item_number1] => string
     *      [tax] => float
     *      [item_number2] =>string
     *      [payer_id] =>  string
     *      [address_street] => string
     *      [payment_date] => string
     *      [payment_status] => string
     *      [charset] => string
     *      [address_zip] => int
     *      [mc_shipping] => float
     *      [mc_handling] => float
     *      [first_name] => string
     *      [mc_fee] => float
     *      [address_country_code] => string
     *      [address_name] => string
     *      [custom] => string
     *      [payer_status] => string
     *      [business] => string
     *      [address_country] => string
     *      [num_cart_items] => int
     *      [mc_handling1] => float
     *      [mc_handling2] => float
     *      [address_city] => string
     *      [payer_email] => string
     *      [mc_shipping1] => float
     *      [mc_shipping2] => float
     *      [tax1] => float
     *      [tax2] => float
     *      [txn_id] => string
     *      [payment_type] => string
     *      [last_name] => string
     *      [address_state] => string
     *      [item_name1] => string
     *      [receiver_email] => string
     *      [item_name2] => string
     *      [payment_fee] => float
     *      [quantity1] => int
     *      [quantity2] => int
     *      [receiver_id] => string
     *      [txn_type] => string
     *      [mc_gross_1] => float
     *      [mc_currency] => string
     *      [mc_gross_2] => float
     *      [residence_country] => string
     *      [transaction_subject] => string
     *      [payment_gross] => float
     *  )
     */
    protected function getIpnRequest()
    {
        $ipn_parameters = explode('&', Tools::file_get_contents('php://input'));
        $paypal_ipn_request = array();

        foreach ($ipn_parameters as $parameter) {
            $values = explode('=', $parameter);
            if (count($values) == 2) {
                $paypal_ipn_request[$values[0]] = urldecode($values[1]);
            }
        }
        return $paypal_ipn_request;
    }

    /**
     *
     * @return boolean
     */
    protected function isCommunicationEnabled()
    {
        return Configuration::get('PAYPAL_COMMUNICATION_METHOD') == HsPaypalCommunicationMethod::IPN;
    }

    /**
     *
     * @return int
     */
    protected function getIdCart()
    {
        $paypal_custom_params = explode('_', Tools::getValue('custom'));
        return (int) $paypal_custom_params[0];
    }
}
