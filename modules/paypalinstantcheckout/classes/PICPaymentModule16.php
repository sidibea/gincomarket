<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

require_once dirname(__FILE__) . '/HsPaymentModule.php';

abstract class PICPaymentModule extends HsPaymentModule
{

    /**
     * Paypal response, see the detail on Paypal here: https://developer.paypal.com/docs/classic/ipn/integration-guide/IPNandPDTVariables/
     * @var array
     * <pre>
     * array (
     *  'mc_gross' => float,
     *  'protection_eligibility' => string,
     *  'address_status' => string,
     *  'item_number1' => string,
     *  'payer_id' => string,
     *  'tax' => float,
     *  'address_street' => float,
     *  'payment_date' => string, //'19:14:05 Dec 22, 2015 PST',
     *  'payment_status' => string,
     *  'charset' => string,
     *  'address_zip' => string,
     *  'mc_shipping' => float,
     *  'mc_handling' => float,
     *  'first_name' => string,
     *  'mc_fee' => float,
     *  'address_country_code' => string,
     *  'address_name' => string,
     *  'custom' => string,
     *  'payer_status' => string,
     *  'business' => string,
     *  'address_country' => string,
     *  'num_cart_items' => int,
     *  'mc_handling1' => float,
     *  'address_city' => string,
     *  'payer_email' => string,
     *  'mc_shipping1' => float,
     *  'tax1' => float,
     *  'contact_phone' => string,
     *  'txn_id' => string,
     *  'payment_type' => string,
     *  'payer_business_name' => string,
     *  'last_name' => string,
     *  'address_state' => string,
     *  'item_name1' => string,
     *  'receiver_email' => string,
     *  'payment_fee' => float,
     *  'quantity1' => int,
     *  'receiver_id' => string,
     *  'txn_type' => string,
     *  'mc_gross_1' => float,
     *  'mc_currency' => string,
     *  'residence_country' => string,
     *  'transaction_subject' => string,
     *  'payment_gross' => float
     * )
     */
    public $paypal_response;

    /**
     * Id Paypal Address
     * @var int
     */
    public $id_paypal_address;

    /**
     * Id Product
     * @var int
     */
    public $id_product = 0;

    /**
     *
     * @param Order $order
     * @param string|array $messages
     */
    protected function addOrderMessage(Order $order, $messages)
    {
        if (isset($messages) & !empty($messages)) {
            if (!is_array($messages)) {
                $messages = array($messages);
            }
            foreach ($messages as $message) {
                parent::addOrderMessage($order, $message);
            }
        }
    }

    /**
     *
     * @param Order $order
     * @param string $message
     */
    public function afterAddOrder(Order $order, $message)
    {
        $id_order_state_based_on_paid_amount = $this->getIdOrderStateBasedOnPaidAmount();
        if ($id_order_state_based_on_paid_amount == Configuration::get('PS_OS_ERROR') || $id_order_state_based_on_paid_amount == Configuration::get('PS_OS_CANCELED')) {
            PrestaShopLogger::addLog('PaymentModule::validateOrder - Order error', 3, null, 'Cart', (int) $this->context->cart->id, true);
        }
        $id_order_state = $this->getIdOrderStateBasedOnPaypalPaymentStatus();
        $this->resetCountryAfterCreateOrders();
        $this->registerPayment($order);
        CartRule::cleanCache();
        foreach ($this->order_details as $key => $order_detail) {
            $order = $this->current_orders[$key];
            $this->addOrderMessage($order, $message);
            $this->validateCartRulesAfterUse($order);
            $this->addCustomerMessage($order);
            $this->executeHookActionValidateOrder($order);
            if ($this->order_state->logable) {
                $this->addProductSale();
            }
            $this->addOrderHistory($id_order_state, $order, $order_detail);
            unset($order_detail);
            $this->updateAfterPayment($order);
            // make sure product list in new order to send email.
            $reload_order = $this->reloadOrder($order);
            $this->current_orders[$key] = $reload_order;
            if ($id_order_state != Configuration::get('PS_OS_ERROR') && $id_order_state != Configuration::get('PS_OS_CANCELED')) {
                if ($this->context->customer->id) {
                    $this->sendConfirmationEmail($reload_order);
                }
            }

            if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT')) {
                $this->updateShopStock($reload_order);
            }
            if (is_callable(array($reload_order, 'updateOrderDetailTax'))) {
                $reload_order->updateOrderDetailTax();
            }
        }
        if (isset($reload_order) && $reload_order->id) {
            // Use the last order as currentOrder
            $this->currentOrder = (int) $reload_order->id;
        }
    }

    /**
     * @see parent::verifyCountry()
     */
    protected function verifyCountry($id_country)
    {
        // Don't need to verify Country in PIC.
        // Sometimes, country pulled from Paypal account is not active in PrestaShop.
        // This prevents orders from being created.
        $id_country = (int) $id_country;
        return true;
    }

    abstract public function getIdOrderStateBasedOnPaypalPaymentStatus();

    abstract public function updateAfterPayment(Order $order);
}
