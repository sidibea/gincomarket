<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

require_once dirname(__FILE__) . '/hsabstractpaypalconnection.php';

class PaypalInstantCheckoutPDTModuleFrontController extends PaypalInstantCheckoutHsAbstractPaypalConnectionModuleFrontController
{
    /**
     * @see parent::postProcess()
     */
    public function postProcess()
    {
        parent::postProcess();
        $this->postProcessAfter();
    }

    protected function postProcessAfter()
    {
        if ($this->is_post_process_executed) {
            if ($this->module->isPrestashop17()) {
                $id_cart = (int) $this->context->cart->id;
                $cart = new Cart($id_cart);
                if (Validate::isLoadedObject($cart)) {
                    $id_order = (int) Order::getOrderByCartId($id_cart);
                    $this->order = new Order($id_order);
                    if (!Validate::isLoadedObject($this->order)) {
                        return $this->waitForVerify();
                    } else {
                        Tools::redirect('index.php?controller=order-confirmation&id_cart=' . $id_cart . '&id_module=' . (int) $this->module->id . '&id_order=' . $this->module->currentOrder . '&key=' . $this->context->customer->secure_key);
                    }
                }
            } else {
                Tools::redirect($this->context->link->getModuleLink($this->module->name, 'orderconfirm', array('id_cart' => $this->context->cart->id)));
            }
        } else {
            exit($this->module->i18n['oops_something_goes_wrong']);
        }
    }

    protected function waitForVerify()
    {
        return $this->setTemplate('module:' . $this->module->name . '/views/templates/front/waiting_verify.tpl');
    }

    protected function doPostProcess()
    {
        if ($this->isCommunicationEnabled()) {
            // PDT
            $this->is_post_process_executed = $this->doPostProcessPdt();
        } else {
            // IPN
            if ($this->context->cart->OrderExists()) {
                $this->is_post_process_executed = $this->doPostProcessIpn();
            } else {
                // Creating order is in progress by IPN
                $this->is_post_process_executed = true;
            }
        }
    }

    /**
     *
     * @return boolean
     */
    protected function isCommunicationEnabled()
    {
        return Configuration::get('PAYPAL_COMMUNICATION_METHOD') == HsPaypalCommunicationMethod::PDT;
    }

    protected function doPostProcessPdt()
    {
        $paypal_pdt_api = new HsPaypalPDTApi($this->mode, $this->identify_token);
        $paypal_custom_params = explode('_', Tools::getValue('cm'));
        $transaction_id = Tools::getValue('tx');
        if (!$this->isReadyToGo($paypal_custom_params)) {
            return false;
        }
        $paypal_response = $paypal_pdt_api->formatResponse($paypal_pdt_api->getResponse(array('transaction_id' => $transaction_id)));
        if (!$paypal_response['success']) {
            return false;
        }
        $this->module->setResponse($paypal_response['paypal_response']);
        $this->initCustomer();
        $this->updateContext();
        $id_product = $this->getProductId($paypal_custom_params);
        $this->module->setProductId($id_product);
        if (!$this->context->cart->OrderExists()) { // Avoid duplicate order
            $this->updateCart();
            $paypal_address = $this->module->getPayPalAddress();
            $this->module->setPayPalIdAddress($paypal_address->id);
            $id_order_state = $this->module->getIdOrderStateBasedOnPaypalPaymentStatus();
            $order_message = $this->module->getOrderMessage();
            $this->module->validateOrder($this->context->cart->id, $id_order_state, $this->module->paypal_response['mc_gross'], 'PayPal Instant Checkout', $order_message, null, null, false, $this->context->customer->secure_key);
        }
        return true;
    }

    protected function doPostProcessIpn()
    {
        $customer = new Customer((int) $this->context->cart->id_customer);
        if (Validate::isLoadedObject($customer)) {
            $this->context->customer = $customer;
            $this->updateContext();
        }
        return true;
    }

    /**
     *
     * @return int
     */
    protected function getIdCart()
    {
        $paypal_custom_params = explode('_', Tools::getValue('cm'));
        return (int) $paypal_custom_params[0];
    }
}
