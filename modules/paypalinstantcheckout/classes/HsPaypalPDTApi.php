<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

require_once dirname(__FILE__) . '/HsPaypalApi.php';

class HsPaypalPDTApi extends HsPaypalApi
{
    /**
     *
     * @param array $params
     * <pre>
     * array(
     *  [transaction_id] => string
     * )
     * @return string
     */
    protected function buildRequest(array $params)
    {
        return 'cmd=_notify-synch&tx=' . Tools::strtoupper($params['transaction_id']) . '&at=' . $this->identify_key;
    }
    
    /**
     * @param array $response
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
     * )</pre>
     */
    public function formatResponse(array $response)
    {
        $pdt_response = array('success' => false, 'paypal_response' => array());
        if (strcmp($response[0], 'SUCCESS') == 0) {
            $pdt_response['success'] = true;
            for ($i = 1; $i < count($response); ++$i) {
                if (isset($response[$i]) && $response[$i] != '') {
                    list($key, $val) = explode('=', $response[$i]);
                    $pdt_response['paypal_response'][urldecode($key)] = urldecode($val);
                }
            }
        }
        return $pdt_response;
    }
}
