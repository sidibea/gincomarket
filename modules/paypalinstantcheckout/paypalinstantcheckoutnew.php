<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

use PrestaShop\PrestaShop\Core\Payment\PaymentOption;

if (!defined('_PS_VERSION_')) {
    exit;
}

class PayPalInstantCheckoutNew extends PayPalInstantCheckout
{
    /*
     * VERSION PS 1.7
     *
     */

    /**
     * @return PaymentOption
     */
    public function paypalExternalPaymentOptions($params)
    {
        if (!Validate::isLoadedObject($params['cart'])) {
            return;
        }
        if (!$this->active) {
            return;
        }

        if ((int) Configuration::get('PAYPAL_POSITION_PAYMENT') === 0) {
            return;
        }
        if (!HsPaypalInstantCheckOut::getPaypalAccount()) {
            return;
        }

        if (!$this->isCurrencyCompatibleWithPaypal()) {
            return;
        }
        $paypal_fee = $this->getPayPalFee();
        $this->smarty->assign(array(
            'text_translation_of_button_paypal' => $this->getTextTranslationButtonPayPal(),
            'a_surcharge_of_will_be_added' => $paypal_fee > 0 ? sprintf($this->i18n['a_surcharge_of_will_be_added'], Tools::displayPrice($paypal_fee)) : '',
            'img_paypal_path' => $this->_path . 'views/img/',
            'alt_title' => 'PAYPAL_TEXT_PAYMENT',
            'alt_image' => 'PAYPAL_IMAGE_PAYMENT',
        ));
        $textTranslation = str_replace('<label class="instantly">', '', $this->getTextTranslationButtonPayPal());
        $textTranslationButtonPayPal = str_replace('</label>', '', $textTranslation);
        $new_option = new PaymentOption();
        $new_option->setCallToActionText($textTranslationButtonPayPal)
                ->setAction($this->context->link->getModuleLink($this->name, 'form', array(), true))
                ->setAdditionalInformation($this->fetch('module:' . $this->name . '/views/templates/hook/display_top_payment_17.tpl'));
        $payment_options = array($new_option);
        return $payment_options;
    }

    public function payPalPaymentReturn($params)
    {
        $order = $params['order'];
        $currency = new Currency($order->id_currency);
        $total_pay = 0;
        $id_order = 0;
        if (Validate::isLoadedObject($order)) {
            $total_pay = $order->getOrdersTotalPaid();
            $id_order = (int) $order->id;
            $this->show_warning_payment_status = false;
        }
        $formated_total_pay = Tools::displayPrice($total_pay, $currency, false);
        $id_order_formatted = sprintf('#%06d', $id_order);
        $this->context->smarty->assign(array(
            'is_guest' => $this->context->customer->isGuest(),
            'order' => $order,
            'show_warning_payment_status' => $this->show_warning_payment_status,
            'is_confirm_address' => Configuration::get('PAYPAL_CONFIRM_ADDRESS'),
            'confirm_address_link' => $this->context->link->getModuleLink($this->name, 'ppaddress', array('id_address' => $order->id_address_delivery)),
            'guest_tracking_link' => $this->context->link->getPageLink('guest-tracking', null, null, array('id_order' => $order->reference, 'email' => $this->context->customer->email)),
            'order_history_link' => $this->context->link->getPageLink('history'),
            'formated_total_pay' => $formated_total_pay,
            'id_order_formatted' => $id_order_formatted,
        ));
        if ($this->context->customer->isGuest()) {
            $this->context->customer->mylogout();
        }
        return $this->fetch('module:' . $this->name . '/views/templates/hook/payment_return.tpl');
    }
}
