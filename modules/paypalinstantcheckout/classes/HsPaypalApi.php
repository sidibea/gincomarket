<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

require_once dirname(__FILE__) . '/HsPaypalEnvironment.php';
require_once dirname(__FILE__) . '/HsPaypalCommunicationMethod.php';

abstract class HsPaypalApi
{
    /**
     * Paypal url
     * @var string
     */
    protected $url;
   
    /**
     * Identify key
     * @var string
     */
    protected $identify_key;
    
     /**
     *
     * @param int $mode
     * @param string $indentify_key
     */
    public function __construct($mode, $indentify_key)
    {
        $this->identify_key = $indentify_key;
        $this->url = ($mode == HsPaypalEnvironment::SANDBOX) ? HsPaypalEnvironment::SANDBOX_URL :  HsPaypalEnvironment::LIVE_URL;
    }
    
    /**
     *
     * @param array $params this is dynamic param, it depends on communication IPN or PDT
     * @return array
     * <pre>
     * array(
     *  [success] => boolean
     *  [paypal_response] => array(
     *      [mc_gross] => float
     *      [protection_eligibility] => string
     *      [address_status] => string
     *      [item_number1] => string
     *      [tax] => float
     *      [item_number2] =>string
     *      [payer_id] =>
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
     * )
     */
    public function getResponse(array $params)
    {
        $request = $this->buildRequest($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://' . $this->url . '/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $this->url"));
        $paypal_return = curl_exec($ch);
        curl_close($ch);
        return explode("\n", $paypal_return);
    }

    /**
     *
     * @param array $params
     */
    abstract protected function buildRequest(array $params);
    
    /**
     * @param array $response Response return form Paypal
     */
    abstract public function formatResponse(array $response);
}
