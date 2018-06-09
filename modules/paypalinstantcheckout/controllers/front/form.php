<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

require_once dirname(__FILE__) . '/../../classes/HsPayPalSpecificPrice.php';

class PaypalInstantCheckoutFormModuleFrontController extends ModuleFrontController
{

    /**
     * assign value and status when process ajax.
     *
     * @var array
     */
    protected $json_data = array(
        'success' => false,
    );

    /**
     * id product in this case pay instantly in product page.
     *
     * @var int
     */
    protected $id_product;

    /**
     * id product attribute in this case pay instantly in product page.
     *
     * @var int
     */
    protected $id_product_attribute;
    protected $quantity;

    /**
     * check customer already login or not.
     *
     * @var bool
     */
    protected $is_logged = false;

    /**
     * construct.
     */
    public function __construct()
    {
        parent::__construct();
        $this->content_only = true;
        $this->display_header = false;
        $this->display_footer = false;
        //$this->display_column_left	 = false;
        //$this->display_column_right	 = false;
        $this->id_product = (int) Tools::getValue('id_product');
        $this->quantity = Tools::getValue('qty', 1);
        $id_product_attribute = (int) Tools::getValue('id_product_attribute', 0);
        if ($this->module->isPrestashop17() && !empty(Tools::getValue('group'))) {
            $id_product_attribute = (int) Product::getIdProductAttributesByIdAttributes($this->id_product, Tools::getValue('group'));
        }
        if ($id_product_attribute > 0) {
            $this->id_product_attribute = $id_product_attribute;
        } else {
            $this->id_product_attribute = Product::getDefaultAttribute($this->id_product, $this->quantity);
        }
    }

    /**
     * add jquery to view.
     *
     * @see parent::int
     */
    public function init()
    {
        parent::init();
        $this->addJquery();
    }

    /**
     * Get states by id country.
     */
    public function displayAjaxGetStateByIdCountry()
    {
        $id_country = Tools::getValue('id_country', 0);
        $states = State::getStatesByIdCountry($id_country);
        exit(Tools::jsonEncode($states));
    }

    /**
     * @see parent::postProcess()
     */
    public function postProcess()
    {
        if ($this->context->customer->isLogged()) {
            $this->is_logged = true;
        } elseif ((int) Configuration::get('PAYPAL_POSTCODE_FORM') === 0) {
            $this->is_logged = true;
        } elseif (Tools::isSubmit('submitPostCode')) {
            $this->is_logged = true;
            $this->updateDummyAddress();
        }
    }

    /**
     * Render view.
     *
     * @see parent::initContent
     */
    public function initContent()
    {
        if ($this->is_logged) {
            $this->displayHiddenForm();
        } else {
            $this->displayPostCode();
        }
    }

    /**
     * Display hidden form and auto submit to PayPal.
     */
    protected function displayHiddenForm()
    {
        $paypal_account = HsPaypalInstantCheckOut::getPaypalAccount();
        $paypal_cart = HsPaypalInstantCheckOut::getPaypalCart($this->context->cart, (int) $this->id_product, (int) $this->id_product_attribute, (int) $this->quantity);
        $target_currency = $this->module->getTargetCurrency();
        $refresh_cart = Validate::isLoadedObject($target_currency) && ($target_currency->id != $paypal_cart->id_currency);
        if (Validate::isLoadedObject($target_currency)) {
            $paypal_cart->id_currency = $target_currency->id;
            $this->context->currency = $target_currency; // update Context on fly to make sure we produce right price based on the new currency
        } else {
            $this->errors[] = Tools::displayError($this->module->i18n['an_error_occurred_while_updating_currency']);
        }

        if (Validate::isLoadedObject($this->context->customer)) {
            $id_customer = (int) $this->context->customer->id;
        } else {
            $id_customer = (int) Configuration::get('PAYPAL_DUMMY_CUSTOMER');
        }

        $id_customer = $this->context->customer->isLogged() ? (int) $this->context->customer->id : (int) Configuration::get('PAYPAL_DUMMY_CUSTOMER');
        $use_tax = !Product::getTaxCalculationMethod($id_customer);

        if (!$this->context->customer->isLogged()) {
            $id_address = (int) Configuration::get('PAYPAL_DEFAULT_ADDRESS');
            $paypal_cart->id_customer = $id_customer;
            $paypal_cart->id_address_delivery = $id_address;
            $paypal_cart->id_address_invoice = $id_address;
            $paypal_cart->autosetProductAddress();
        }
        $id_carrier = (int) Configuration::get('PAYPAL_DEFAULT_CARRIER');
        if ($paypal_cart->id_carrier == $id_carrier) {
            if ($paypal_cart->getOrderTotal(true, Cart::ONLY_SHIPPING, null, $id_carrier, null, false)) {
                $paypal_cart->id_carrier = $id_carrier;
            } else {
                $delivery_option = $paypal_cart->getDeliveryOption();
                if (!empty($delivery_option)) {
                    $paypal_cart->id_carrier = (int) str_replace(',', ' ', current($delivery_option));
                }
            }
        }

        $paypal_cart->update();
        // Add Paypal fee
        $paypal_fee = $this->module->getPayPalFee();
        if ($paypal_fee > 0) {
            $id_product_paypal_fee = (int) Configuration::get('HS_ID_PRODUCT_PAYPAL_FEE');
            $product_paypal_fee = new Product($id_product_paypal_fee);
            if (!Validate::isLoadedObject($product_paypal_fee)) {
                $this->errors[] = Tools::displayError($this->module->i18n['paypal_fee_does_not_exist']);
            }

            // create a new specific price
            if (!HsPayPalSpecificPrice::addSpecificPrice($id_product_paypal_fee, $paypal_fee, $this->context->currency->id)) {
                $this->errors[] = Tools::displayError($this->module->i18n['paypal_fee_does_not_exist']);
                $this->errors[] = Tools::displayError('an_error_occurred_while_updating_specific_price');
            }

            // add dummy product to cart
            if (!$this->context->cart->containsProduct((int) $id_product_paypal_fee)) {
                $this->context->cart->updateQty(1, (int) $id_product_paypal_fee);
            }
        }

        $products = $paypal_cart->getProducts($refresh_cart);
        $summary_details = $paypal_cart->getSummaryDetails();
        if (!$paypal_account || empty($products)) {
            if (Configuration::get('PS_ORDER_PROCESS_TYPE')) {
                Tools::redirect('order-opc');
            } else {
                Tools::redirect('order');
            }
        }

        foreach ($products as &$product) {
            $price = $use_tax ? $product['price_wt'] : $product['price'];
            $product['paypal_price'] = Tools::ps_round($price, 2); //Paypal only accepts up to 2 places of decimal number
        }
        $this->context->smarty->assign(array(
            'paypal_url' => $this->module->getTargetUrl(),
            'paypal_account' => $paypal_account,
            'paypal_shipping_cost' => $this->getShippingCost($use_tax, $paypal_cart),
            'paypal_cart_products' => $products,
            'paypal_cmd' => $this->id_product ? '_xclick' : '_cart', // checkout from product or cart
            'paypal_custom' => $paypal_cart->id . '_' . (int) $this->id_product . '_' . (int) $paypal_cart->id_carrier, // assign current id_cart, id_product, id_carrier
            'paypal_currency' => Tools::strtoupper(Validate::isLoadedObject($target_currency) ? $target_currency->iso_code : $this->context->currency->iso_code),
            'paypal_total_discounts' => $use_tax ? $summary_details['total_discounts'] : $summary_details['total_discounts_tax_exc'],
            'total_tax' => $use_tax ? 0 : $summary_details['total_tax'],
            'js_include' => $this->doesIncludeJavascript(),
            'paypal_return' => $this->context->link->getModuleLink($this->module->name, 'pdt', array()),
            'paypal_notify' => $this->context->link->getModuleLink($this->module->name, 'ipn', array()),
        ));
        if ($this->module->isPrestashop17()) {
            $jquery_file = 'js/jquery/jquery-1.11.0.min.js';
            if (file_exists($jquery_file)) {
                $jquery_file = __PS_BASE_URI__ . $jquery_file;
            } else {
                $jquery_file = Tools::getCurrentUrlProtocolPrefix() . 'ajax.googleapis.com/ajax/libs/jquery/' . _PS_JQUERY_VERSION_ . '/jquery.min.js';
            }
            $this->context->smarty->assign(array(
                'js_files' => $jquery_file,
            ));
            $this->setTemplate('module:' . $this->module->name . '/views/templates/front/payment_form.tpl');
        } else {
            $this->setTemplate('payment_form.tpl');
        }
    }

    /**
     * @param boolean $use_tax
     * @param Cart $paypal_cart
     * @return float
     */
    protected function getShippingCost($use_tax, $paypal_cart)
    {
        $cart_rules = $paypal_cart->getCartRules();

        if (empty($cart_rules)) {
            $shipping_cost = $paypal_cart->getOrderTotal($use_tax, Cart::ONLY_SHIPPING, null, $paypal_cart->id_carrier, false);
        } else {
            $is_free_shipping = false;
            foreach ($cart_rules as $cart_rule) {
                if ($cart_rule['free_shipping']) {
                    $is_free_shipping = true;
                }
            }
            if ($is_free_shipping) {
                $shipping_cost = 0;
            }
        }
        return $shipping_cost;
    }

    /**
     *  Display PostCode form allow customer to add country, state, postcode.
     */
    protected function displayPostCode()
    {
        $id_default_country = (int) Configuration::get('PS_COUNTRY_DEFAULT');
        // Generate countries list
        if (Configuration::get('PS_RESTRICT_DELIVERED_COUNTRIES')) {
            $countries = Carrier::getDeliveredCountries($this->context->language->id, true, true);
        } else {
            $countries = Country::getCountries($this->context->language->id, true);
        }

        // Assign vars
        $this->context->smarty->assign(array(
            'id_default_country' => $id_default_country,
            'url_ajax' => $this->context->link->getModuleLink($this->module->name, 'form', array('action' => 'getStateByIdCountry'), true),
            'url_submit_form' => $this->context->link->getModuleLink($this->module->name, 'form', array('id_product' => $this->id_product, 'id_product_attribute' => $this->id_product_attribute, 'qty' => $this->quantity), true),
            'countries' => $countries,
            'countries_json' => Tools::jsonEncode($countries),
            'js_include' => $this->doesIncludeJavascript(),
            'translate_postcode' => $this->module->i18n['zip_postal_code'],
            'translate_country' => $this->module->i18n['country'],
            'translate_state' => $this->module->i18n['state'],
            'translate_submit' => $this->module->i18n['submit'],
            'invalid_postcode' => $this->module->i18n['invalid_postcode'],
            'enter_your_postcode' => $this->module->i18n['enter_your_postcode'],
        ));
        if ($this->module->isPrestashop17()) {
            $jquery_file = 'js/jquery/jquery-1.11.0.min.js';
            if (file_exists($jquery_file)) {
                $jquery_file = __PS_BASE_URI__ . $jquery_file;
            } else {
                $jquery_file = Tools::getCurrentUrlProtocolPrefix() . 'ajax.googleapis.com/ajax/libs/jquery/' . _PS_JQUERY_VERSION_ . '/jquery.min.js';
            }
            $this->context->smarty->assign(array(
                'js_files' => array($jquery_file, _PS_JS_DIR_ . 'validate.js'),
            ));
            $this->setTemplate('module:' . $this->module->name . '/views/templates/front/postcode_17.tpl');
        } else {
            $this->addJS(_PS_JS_DIR_ . 'validate.js');
            $this->setTemplate('postcode.tpl');
        }
    }

    /**
     * Update country, state, postcode for dummy address.
     */
    protected function updateDummyAddress()
    {
        $id_country = Tools::getValue('id_country');
        $id_state = Tools::getValue('id_state');
        $postcode = Tools::getValue('postcode');
        $id_dummy_address = (int) Configuration::get('PAYPAL_DEFAULT_ADDRESS');
        $address = new Address($id_dummy_address);
        if (Validate::isLoadedObject($address)) {
            $address->id_country = $id_country;
            $address->id_state = $id_state;
            $address->postcode = $postcode;
            $address->update();
        }
    }

    /**
     * Check prestashop version which need to include jquery or not.
     *
     * @return bool
     */
    protected function doesIncludeJavascript()
    {
        $js_include = false;
        if (version_compare(_PS_VERSION_, '1.6.0.7', '>=') || version_compare(_PS_VERSION_, '1.6', '<')) {
            if (!(bool) Configuration::get('PS_JS_DEFER')) {
                $js_include = true;
            }
        }

        return $js_include;
    }

    /*
     * Add product to Paypal Instant
     */

    protected function displayAjaxAddProductToPaypalInstant()
    {
        $template_content_block = _PS_MODULE_DIR_ . $this->module->name . '/views/templates/front/payment_form.tpl';
        $this->json_data['urlPostcodePage'] = $this->context->link->getModuleLink($this->module->name, 'form', array('id_product' => $this->id_product, 'id_product_attribute' => $this->id_product_attribute), true);
        $this->json_data['contentBlock'] = $this->context->smarty->fetch($template_content_block);
        $this->json_data['success'] = true;
        exit(Tools::jsonEnCode($this->json_data));
    }
}
