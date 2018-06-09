<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

require_once dirname(__FILE__).'/hsabstractpaypalcommon.php';
class PaypalInstantCheckoutOrderConfirmModuleFrontController extends PaypalInstantCheckoutHsAbstractPaypalCommonModuleFrontController
{
    /**
     * @var Order
     */
    protected $order;
    
    /**
     * Show warning of the order is not created
     * @var boolean
     */
    protected $show_warning_payment_status = true;
    
    /**
     * @see FrontController::init()
     */
    public function init()
    {
        parent::init();
        // $this->display_column_left = false;
        $id_cart = (int)Tools::getValue('id_cart', 0);
        $cart = new Cart($id_cart);
        if (Validate::isLoadedObject($cart)) {
            $id_order =  (int)Order::getOrderByCartId($id_cart);
            $this->order = new Order($id_order);
            if (Validate::isLoadedObject($this->order)) {
                $this->show_warning_payment_status = false;
            }
            if ((int)$this->context->customer->id !== (int)$cart->id_customer) {
                $customer = new Customer($cart->id_customer);
                if (Validate::isLoadedObject($customer)) {
                    $this->context->customer = $customer;
                    $this->updateContext();
                }
            }
        }
    }
     /**
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        parent::initContent();
        $this->context->smarty->assign(array(
            'is_guest' => $this->context->customer->isGuest(),
            'show_warning_payment_status' => $this->show_warning_payment_status,
            'is_confirm_address' => Configuration::get('PAYPAL_CONFIRM_ADDRESS'),
            'confirm_address_link' => $this->context->link->getModuleLink($this->module->name, 'ppaddress', array('id_address' => $this->order->id_address_delivery)),
            'guest_tracking_link' => $this->context->link->getPageLink('guest-tracking', null, null, array('id_order' => $this->order->reference, 'email' => $this->context->customer->email)),
            'order_history_link' => $this->context->link->getPageLink('history'),
            'order' => $this->order,
        ));
        
        if ($this->context->customer->isGuest()) {
            $this->context->customer->mylogout();
        }
        $this->setTemplate('order-confirm.tpl');
    }
   
    public function setMedia()
    {
        parent::setMedia();
        $this->context->controller->addCss($this->module->getCssPath() . 'order_confirm.css');
    }
    
    protected function initTranslations()
    {
        parent::initTranslations();
        $source = basename(__FILE__, '.php');
        $currency = new Currency($this->order->id_currency);
        $total_pay = 0;
        $id_order = 0;
        if (Validate::isLoadedObject($this->order)) {
            $total_pay = $this->order->getOrdersTotalPaid();
            $id_order = (int)$this->order->id;
        }
        $formated_total_pay = Tools::displayPrice($total_pay, $currency, false);
        $id_order_formatted = sprintf('#%06d', $id_order);
        $contact_link = $this->context->link->getPageLink('contact', true);
        $this->i18n = array(
            'order_reference' => str_replace(array('[strong]', '[/strong]'), array('<strong>', '</strong>'), sprintf($this->module->l('Order reference: [strong]%s[/strong]', $source), $this->order->reference)),
            'payment_method' => str_replace(array('[strong]', '[/strong]'), array('<strong>', '</strong>'), sprintf($this->module->l('Payment method: [strong]%s[/strong]', $source), $this->order->payment)),
            'payment_amount' => str_replace(array('[span]', '[/span]', '[strong]', '[/strong]'), array('<span class="price">', '</span>', '<strong>', '</strong>'), sprintf($this->module->l('Payment amount: [span][strong]%s[/strong][/span]', $source), $formated_total_pay)),
            'for_any_questions_or_for_further_information_please_contact_our' => str_replace(array('[label]', '[/label]'), array('<a class="paypal_link" href="'.$contact_link.'">', '</a>'), $this->module->l('For any questions or for further information, please contact our [label]customer service department[/label].', $source)),
            'your_order_id_is' => sprintf($this->module->l('Your order ID is %s.', $source), $id_order_formatted) ,
        );
        $this->context->smarty->assign(array(
            'paypal_instant_checkout_i18n' => $this->i18n
        ));
    }
}
