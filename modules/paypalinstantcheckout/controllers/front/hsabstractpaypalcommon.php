<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

class PaypalInstantCheckoutHsAbstractPaypalCommonModuleFrontController extends ModuleFrontController
{
    /**
     * contain all lang messages.
     */
    public $i18n = array();
    
    /**
     * @see parent::initContent()
     */
    public function initContent()
    {
        parent::initContent();
        $this->initTranslations();
    }
    
    /**
     * Initinalize all translations.
     */
    protected function initTranslations()
    {
    }
    
    protected function updateContext()
    {
        $this->context->cookie->id_customer = (int) $this->context->customer->id;
        $this->context->cookie->customer_lastname = $this->context->customer->lastname;
        $this->context->cookie->customer_firstname = $this->context->customer->firstname;
        $this->context->cookie->passwd = $this->context->customer->passwd;
        $this->context->cookie->logged = 1;
        if (!Configuration::get('PS_REGISTRATION_PROCESS_TYPE')) {
            $this->context->cookie->account_created = 1;
        }
        $this->context->cookie->email = $this->context->customer->email;
        $this->context->cookie->is_guest = $this->context->customer->is_guest;
    }
}
