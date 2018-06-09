<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

require_once dirname(__FILE__).'/hsabstractpaypalcommon.php';
require_once dirname(__FILE__).'/../../classes/HsPaypalEnvironment.php';
require_once dirname(__FILE__).'/../../classes/HsPaypalCommunicationMethod.php';
require_once dirname(__FILE__).'/../../classes/HsPaypalIPNApi.php';
require_once dirname(__FILE__).'/../../classes/HsPaypalPDTApi.php';
abstract class PaypalInstantCheckoutHsAbstractPaypalConnectionModuleFrontController extends PaypalInstantCheckoutHsAbstractPaypalCommonModuleFrontController
{
    /**
     * Mode live site or test site
     * @var int
     */
    protected $mode;
    
    /**
     * Identify key
     * @var string
     */
    protected $identify_key;
    
    /**
     * Mark it to TRUE if post process is executed successfully
     * @var boolean
     */
    protected $is_post_process_executed = false;
    
    public function init()
    {
        parent::init();
        $this->mode = Configuration::get('PAYPAL_MODE');
        $this->identify_token = Configuration::get('PAYPAL_IDENTIFY_TOKEN');
        $this->initCart($this->getIdCart());
    }

    /**
     * @see parent::postProcess()
     */
    public function postProcess()
    {
        try {
            parent::postProcess();
            $this->doPostProcess();
        } catch (Exception $ex) {
            $logs = array();
            $logs[] = $this->module->displayName;
            $logs[] = $ex->getMessage();
            $logs[] = $ex->getTraceAsString();
            PrestaShopLogger::addLog(implode("\n", $logs));
        }
    }

    abstract protected function doPostProcess();
        
    /**
     *
     * @param int $id_cart
     */
    protected function initCart($id_cart)
    {
        $cart = new Cart($id_cart);
        if (Validate::isLoadedObject($cart)) {
            $this->context->cart = $cart;
        }
    }

    protected function initCustomer()
    {
        $customer = $this->module->getCustomer();
        $this->context->customer = $customer;
    }
    
    protected function updateCart()
    {
        if ($this->module->isDefaultCustomer()) {
            $this->context->cart->id_customer = (int) $this->context->customer->id;
            $address = $this->module->cloneDefaultAddress();
            $this->context->cart->id_address_delivery = $address->id;
            $this->context->cart->id_address_invoice = $address->id;
        }
        $this->context->cart->secure_key = $this->context->customer->secure_key;
        $this->context->cart->update();
    }
    
    /**
     *
     * @param array $params
     * <pre>
     * array (
     *  [0] => id_cart
     *  [1] => id_product
     *  [2] => id_carrier
     * )
     * @return boolean
     */
    protected function isReadyToGo(array $params)
    {
        $success = array($this->validateParams($params));
        $success[] = (array_sum($success) >= count($success)) && $this->isCommunicationEnabled();
        $success[] = (array_sum($success) >= count($success)) && $this->validateCart();
        $success[] = (array_sum($success) >= count($success)) && !$this->context->cart->OrderExists();
        return array_sum($success) >= count($success);
    }
    
    /**
     *
     * @param array $params
     * <pre>
     * array (
     *  [0] => id_cart
     *  [1] => id_product
     *  [2] => id_carrier
     * )
     * @return boolean
     */
    protected function validateParams(array $params)
    {
        return !(empty($params) || $params[0] == 0);
    }
    /**
     *
     * @return boolean
     */
    protected function validateCart()
    {
        return Validate::isLoadedObject($this->context->cart);
    }
    
    abstract protected function isCommunicationEnabled();
    
    /**
     *
     * @param array $params
     * <pre>
     * array (
     *  [0] => id_cart
     *  [1] => id_product
     *  [2] => id_carrier
     * )
     * @return int id_product
     */
    protected function getProductId(array $params)
    {
        return isset($params[1]) ? $params[1] : 0;
    }
    
    /**
     *
     * @return int
     */
    abstract protected function getIdCart();
}
