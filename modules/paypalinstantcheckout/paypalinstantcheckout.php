<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once dirname(__FILE__) . '/classes/HsPaypalInstantCheckOut.php';
require_once dirname(__FILE__) . '/classes/HsPayPalAddress.php';
require_once dirname(__FILE__) . '/classes/HsPayPalAddressFormat.php';
require_once dirname(__FILE__) . '/classes/HsPayPalConstants.php';
require_once dirname(__FILE__) . '/classes/HsPayPalCountry.php';

if (version_compare(_PS_VERSION_, '1.6') === 1) {
    require_once dirname(__FILE__) . '/classes/PICPaymentModule16.php';
} else {
    require_once dirname(__FILE__) . '/classes/PICPaymentModule15.php';
}

class PayPalInstantCheckout extends PICPaymentModule
{

    /**
     * Live URL.
     * @var string
     */
    public $live_url = 'https://www.paypal.com/cgi-bin/webscr';

    /**
     * Sandbox URL.
     * @var string
     */
    public $sandbox_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

    /**
     * Content html of setting page.
     */
    protected $_html;

    /**
     * Set default price for dummy product Paypal fee.
     */
    const PRICE = 1000000000;

    /**
     *  Set default whole sale price for dummy product Paypal fee.
     */
    const WHOLESALE_PRICE = 1000000000;

    /**
     *  Set default quantity for dummy product Paypal fee.
     */
    const QTY = 100000;

    /**
     * Set default Paypal API rate.
     */
    const PAYPAL_API_RATE = 4.4;

    /**
     * Set default Paypal API fixed fee.
     */
    const PAYPAL_API_FIXED_FEE = 0.3;
    const CLASS_PARENT_TAB = 'AdminParentOrders';

    /**
     * Array configuration key using setting.
     *
     * @var key => type data
     */
    public $configuration_keys = array(
        'HS_PAYPAL_ACCOUNT' => 'isString',
        'PAYPAL_IDENTIFY_TOKEN' => 'isString',
        'PAYPAL_MODE' => 'isInt',
        'PAYPAL_GUEST_AS_CUSTOMER' => 'isInt',
        'PAYPAL_CONFIRM_ADDRESS' => 'isInt',
        'PAYPAL_DEFAULT_CARRIER' => 'isInt',
        'PAYPAL_OVERRIDE_EMAIL' => 'isInt',
        'PAYPAL_CONVERT_CURRENCY' => 'isInt',
        'HS_PAYPAL_FEE' => 'isInt',
        'HS_PAYPAL_STANDARD_RATE' => 'isString',
        'HS_PAYPAL_CUSTOM_RATE' => 'isFloat',
        'HS_PAYPAL_CUSTOM_FIXED_FEE' => 'isFloat',
        'PAYPAL_DEFAULT_ADDRESS' => 'isInt',
        'PAYPAL_POSTCODE_FORM' => 'isInt',
        'PAYPAL_COMMUNICATION_METHOD' => 'isString',
    );
    public $position_configuration_keys = array(
        'PAYPAL_POSITION_SHOPPING_CART' => 'isInt',
        'PAYPAL_POSITION_BLOCK_CART' => 'isInt',
        'PAYPAL_POSITION_ADDING_TO_CART' => 'isInt',
        'PAYPAL_POSITION_PRODUCT_PAGE' => 'isInt',
        'PAYPAL_POSITION_PAYMENT' => 'isInt',
        'PAYPAL_POSITION_SP_CART_FOOTER' => 'isInt',
        'PAYPAL_POSITION_CHECKOUT_PAGE' => 'isInt',
        'PAYPAL_POSITION_LIST_PAGE' => 'isInt',
    );
    public $text_configuration_keys = array(
        'PAYPAL_TEXT_DEFAULT_BUTTON' => 'isString',
        'PAYPAL_TEXT_SHOPPING_CART' => 'isString',
        'PAYPAL_TEXT_BLOCK_CART' => 'isString',
        'PAYPAL_TEXT_ADDING_TO_CART' => 'isString',
        'PAYPAL_TEXT_PRODUCT_PAGE' => 'isString',
        'PAYPAL_TEXT_PAYMENT' => 'isString',
        'PAYPAL_TEXT_SP_CART_FOOTER' => 'isString',
        'PAYPAL_TEXT_CHECKOUT_PAGE' => 'isString',
        'PAYPAL_TEXT_LIST_PAGE' => 'isString',
    );
    public $image_configuration_keys = array(
        'PAYPAL_IMAGE_DEFAULT_BUTTON' => 'isString',
        'PAYPAL_IMAGE_SHOPPING_CART' => 'isString',
        'PAYPAL_IMAGE_BLOCK_CART' => 'isString',
        'PAYPAL_IMAGE_ADDING_TO_CART' => 'isString',
        'PAYPAL_IMAGE_PRODUCT_PAGE' => 'isString',
        'PAYPAL_IMAGE_PAYMENT' => 'isString',
        'PAYPAL_IMAGE_SP_CART_FOOTER' => 'isString',
        'PAYPAL_IMAGE_CHECKOUT_PAGE' => 'isString',
    );

    /**
     * A list of supported images extensions.
     *
     * @var array
     */
    public $extensions_list = array('.gif', '.jpg', '.png');

    /**
     * Set max upload image size.
     *
     * @var int
     */
    public $max_image_size = 1048576;

    /**
     * A list of translatable texts.
     *
     * @var array
     */
    public $i18n = array();

    /**
     * Constant path css.
     */
    const PATH_CSS = 'views/css/';

    /**
     * Constant path js.
     */
    const PATH_JS = 'views/js/';

    public $pic_tabs = array();
    protected $show_warning_payment_status = true;

    /**
     * Construct.
     */
    public function __construct()
    {
        $this->name = 'paypalinstantcheckout';
        $this->tab = 'payments_gateways';
        $this->version = '1.9.2';
        $this->author = 'PrestaMonster';
        $this->bootstrap = true;
        parent::__construct();
        $this->module_key = '24657dff427c8912eb857bb85f25c2d0';
        $this->page = basename(__FILE__, '.php');
        $this->displayName = $this->l('Paypal Instant Checkout');
        $this->description = $this->l('Allow your customers to 1-click-checkout with Paypal from anywhere in your site');
        $this->configuration_keys = array_merge($this->configuration_keys, $this->position_configuration_keys);
        $this->initTranslations();

        $this->pic_tabs = array(
            'AdminPayPalInstantCheckoutPreferences' => array(
                'active' => true,
                'position' => 1,
                'name' => $this->displayName
            ),
            'AdminPayPal' => array(
                'active' => false,
                'position' => 2,
                'name' => $this->i18n['search_customer']
            )
        );

        foreach ($this->pic_tabs as $tab_class => $tab_option) {
            $tab_option['tab_class'] = $tab_class;
            $this->pic_tabs[$tab_class] = $tab_option;
        }
        if (!defined('_PS_CORE_IMG_DIR_')) {
            define('_PS_CORE_IMG_DIR_', _PS_ROOT_DIR_ . '/img/');
        }
        $this->upload_path = _PS_CORE_IMG_DIR_ . 'pic/';
    }

    /**
     * install module.
     *
     * @return bool
     */
    public function install()
    {
        $success = array(parent::install());
        $success[] = (array_sum($success) >= count($success)) && $this->registerHooks();
        $success[] = (array_sum($success) >= count($success)) && $this->installConfigs();

        $success[] = (array_sum($success) >= count($success)) && $this->addDummyProduct();
        $success[] = (array_sum($success) >= count($success)) && $this->createDummyCustomer();
        $success[] = (array_sum($success) >= count($success)) && $this->createDummyAddress();

        $success[] = (array_sum($success) >= count($success)) && $this->createImageDirectory();
        $success[] = (array_sum($success) >= count($success)) && $this->installTabs(($this->pic_tabs));

        return array_sum($success) >= count($success);
    }

    /**
     *
     * @return boolean
     */
    protected function registerHooks()
    {
        $success = array();
        $success[] = (array_sum($success) >= count($success)) && $this->registerHook('displayProductButtons');
        $success[] = (array_sum($success) >= count($success)) && $this->registerHook('displayHeader');
        $success[] = (array_sum($success) >= count($success)) && $this->registerHook('displayShoppingCartFooter');
        $success[] = (array_sum($success) >= count($success)) && $this->registerHook('displayBackOfficeHeader');
        if ($this->isPrestashop17()) {
            $success[] = (array_sum($success) >= count($success)) && $this->registerHook('paymentReturn');
            $success[] = (array_sum($success) >= count($success)) && $this->registerHook('displayExpressCheckout');
            $success[] = (array_sum($success) >= count($success)) && $this->registerHook('paymentOptions');
        } else {
            $success[] = (array_sum($success) >= count($success)) && $this->registerHook('displayShoppingCart');
            $success[] = (array_sum($success) >= count($success)) && $this->registerHook('displayPayment');
        }
        return array_sum($success) >= count($success);
    }

    /**
     * Open Preferences page.
     */
    public function getContent()
    {
        Tools::redirectAdmin($this->context->link->getAdminLink($this->pic_tabs['AdminPayPalInstantCheckoutPreferences']['tab_class']));
    }

    /**
     * Unstall module.
     *
     * @return bool
     */
    public function uninstall()
    {
        // delete configuration key
        foreach (array_keys($this->configuration_keys) as $config_key) {
            Configuration::deleteByName($config_key);
        }
        //delete default text value
        foreach (array_keys($this->text_configuration_keys) as $text_key) {
            Configuration::deleteByName($text_key);
        }

        $this->removeImageDirectory($this->upload_path);

        if (!parent::uninstall()) {
            return false;
        }

        if (!$this->uninstallTabs($this->name)) {
            return false;
        }

        return true;
    }

    /**
     * Get relative path to js files of module.
     *
     * @return string
     */
    public function getJsPath()
    {
        return $this->_path . self::PATH_JS;
    }

    /**
     * Get image.
     *
     * @param int    $id_lang
     * @param string $base
     *
     * @return string
     */
    public function getImage($id_lang = false, $base = null)
    {
        if (is_null($base)) {
            $base = '../modules/paypalinstantcheckout';
        }
        $dir = $base . '/views/img/';
        $img = $dir . $id_lang . '.png';
        if (!file_exists($img)) {
            $img = $dir . 'buy_pp.png';
        }

        return $img;
    }

    /**
     *
     * @return Currency
     */
    protected function findAGoodCurrency()
    {
        if (!$this->isDefaultCurrency($this->context->currency->id)) {
            $default_currency = Currency::getDefaultCurrency();
            if (HsPaypalInstantCheckOut::isSupportedCurrency($default_currency->iso_code)) {
                return $default_currency;
            }
        }
        $good_currency = new Currency();
        $available_currency_codes = $this->getAvailableCurrencyCodes();
        $paypal_supported_currencies = HsPaypalInstantCheckOut::getSupportedCurrencies();
        $supported_currencies = array_intersect($paypal_supported_currencies, $available_currency_codes);
        $supported_currency_code = array_shift($supported_currencies);
        if ($supported_currency_code) {
            $good_currency = new Currency(Currency::getIdByIsoCode($supported_currency_code));
        }
        return $good_currency;
    }

    protected function isDefaultCurrency($id_currency)
    {
        return $id_currency == Configuration::get('PS_CURRENCY_DEFAULT');
    }

    /**
     *
     * @return array
     * <pre>
     * array(
     *  string,// 3-character ISO-4217 code
     *  string,// 3-character ISO-4217 code
     *  ...
     * )
     */
    protected function getAvailableCurrencyCodes()
    {
        $currency_codes = array();
        $currencies = Currency::getCurrenciesByIdShop($this->context->shop->id);
        foreach ($currencies as $currency) {
            if ($currency['active']) {
                $currency_codes[] = $currency['iso_code'];
            }
        }
        return $currency_codes;
    }

    /**
     *
     * @return Currency
     */
    public function getTargetCurrency()
    {
        $target_currency = null;

        if (HsPaypalInstantCheckOut::isSupportedCurrency($this->context->currency->iso_code)) {
            $target_currency = $this->context->currency;
        } elseif (Configuration::get('PAYPAL_CONVERT_CURRENCY')) {
            $target_currency = $this->findAGoodCurrency();
        }
        return $target_currency;
    }

    protected function isCurrencyCompatibleWithPaypal()
    {
        $target_currency = $this->getTargetCurrency();
        return Validate::isLoadedObject($target_currency);
    }

    /**
     * Allow checkout with paypal in right product.
     *
     * @return string
     */
    public function hookDisplayRightColumnProduct()
    {
        if ((int) Configuration::get('PAYPAL_POSITION_PRODUCT_PAGE') === 0) {
            return;
        }

        if (!HsPaypalInstantCheckOut::getPaypalAccount()) {
            return;
        }

        if (!$this->isCurrencyCompatibleWithPaypal()) {
            return;
        }

        $id_product = (int) Tools::getValue('id_product');
        if (!$this->doesProductAvailableForOrder($id_product)) {
            return;
        }

        $this->assignInfoPaypal();
        $this->smarty->assign(array(
            'is_prestashop16' => $this->isPrestashop16(),
            'is_prestashop17' => $this->isPrestashop17(),
            'alt_title' => 'PAYPAL_TEXT_PRODUCT_PAGE',
            'alt_image' => 'PAYPAL_IMAGE_PRODUCT_PAGE',
        ));
        $template_override = _PS_THEME_DIR_ . 'modules/' . $this->name . '/views/templates/hook/display_right_column_product.tpl';
        if (file_exists($template_override)) {
            return $this->display(_PS_THEME_DIR_ . 'modules/' . $this->name, 'views/templates/hook/display_right_column_product.tpl');
        } else {
            return $this->display(__FILE__, 'display_right_column_product.tpl');
        }


        //return $this->display(__FILE__, $template);
    }

    /**
     *
     * @param int $id_product
     * @return boolean
     */
    protected function doesProductAvailableForOrder($id_product)
    {
        $result = true;
        $product = new Product($id_product);
        $quantity = Product::getQuantity($id_product);
        $allow_oosp = Product::isAvailableWhenOutOfStock($product->out_of_stock);
        $ps_catalog_mode = (bool) Configuration::get('PS_CATALOG_MODE') || (Group::isFeatureActive() && !(bool) Group::getCurrent()->show_prices);
        $restricted_country_mode = false;
        if (Configuration::get('PS_GEOLOCATION_BEHAVIOR') == _PS_GEOLOCATION_NO_ORDER_) {
            $restricted_country_mode = true;
        }
        if (($quantity <= 0 && !$allow_oosp) || !$product->available_for_order || $ps_catalog_mode || $restricted_country_mode) {
            $result = false;
        }
        return $result;
    }

    /**
     * Put Paypal button underneath button Add-to-basket.
     *
     * @return type
     */
    public function hookDisplayProductButtons()
    {
        return $this->hookDisplayRightColumnProduct();
    }

    /**
     * Show Paypal button at product footer.
     */
    public function hookDisplayFooterProduct()
    {
        return $this->hookDisplayRightColumnProduct();
    }

    /**
     * Allow checkout with paypal at shopping cart page.
     *
     * @param array $params
     *                      Array (
     *                      [delivery] => Address
     *                      [delivery_state] => String
     *                      [invoice] => Address
     *                      [invoice_state] => String
     *                      [formattedAddresses] => Array ( [delivery] => Array)
     *                      [products] => Array
     *                      [gift_products] => Array
     *                      [discounts] => Array
     *                      [cookie] => Cookie
     *                      [cart] => Cart
     *                      [altern] => int
     *                      )
     *
     * @return String
     */
    public function hookDisplayShoppingCart()
    {
        if ((int) Configuration::get('PAYPAL_POSITION_SHOPPING_CART') === 0) {
            return;
        }

        if (!HsPaypalInstantCheckOut::getPaypalAccount()) {
            return;
        }

        if (!$this->isCurrencyCompatibleWithPaypal()) {
            return;
        }

        $this->context->smarty->assign(array(
            'is_prestashop16' => (int) $this->isPrestashop16(),
            'alt_title' => 'PAYPAL_TEXT_SHOPPING_CART',
            'alt_image' => 'PAYPAL_IMAGE_SHOPPING_CART',
        ));
        $this->assignInfoPaypal();

        return $this->display(__FILE__, 'display_shopping_cart.tpl');
    }

    public function hookDisplayExpressCheckout()
    {
        return $this->hookDisplayShoppingCart();
    }

    /**
     * Allow checkout with paypal at footer shopping cart page.
     *
     * @return html
     */
    public function hookDisplayShoppingCartFooter()
    {
        if ((int) Configuration::get('PAYPAL_POSITION_SP_CART_FOOTER') === 0) {
            return;
        }

        if (!HsPaypalInstantCheckOut::getPaypalAccount()) {
            return;
        }

        if (!$this->isCurrencyCompatibleWithPaypal()) {
            return;
        }

        $this->context->smarty->assign(array(
            'is_prestashop16' => (int) $this->isPrestashop16(),
            'alt_title' => 'PAYPAL_TEXT_SP_CART_FOOTER',
            'alt_image' => 'PAYPAL_IMAGE_SP_CART_FOOTER',
            'is_prestashop17' => $this->isPrestashop17(),
        ));
        $this->assignInfoPaypal();

        return $this->display(__FILE__, 'display_shopping_cart.tpl');
    }

    /**
     * Hook header of website.
     *
     * @return html
     */
    public function hookDisplayHeader()
    {
        if (!$this->isCurrencyCompatibleWithPaypal()) {
            return;
        }

        $custom_list_text = Configuration::get('PAYPAL_TEXT_LIST_PAGE', $this->context->language->id);
        $st_paypalinstant = array(
            'title' => (!empty($custom_list_text)) ? $custom_list_text : '',
            'text' => (!empty($custom_list_text)) ? $custom_list_text : $this->i18n['pay_instantly_with_paypal_2'],
            'error' => $this->i18n['error'],
        );

        if ($this->isPrestashop17()) {
            $this->context->controller->registerStylesheet('modules-paypalinstantcheckout', 'modules/' . $this->name . '/views/css/paypalinstantcheckout.css', array('media' => 'all', 'priority' => 150));
            $this->context->controller->registerJavascript('modules-paypalinstantcheckout', 'modules/' . $this->name . '/views/js/paypalinstantcheckout.js', array('position' => 'bottom', 'priority' => 150));
            $template = 'paypal_list_button_17.tpl';
        } else {
            $this->context->controller->addCSS($this->getCssPath() . 'paypalinstantcheckout.css');
            $this->context->controller->addJS($this->_path . 'views/js/paypalinstantcheckout.js');
            $template = 'paypal_list_button.tpl';
        }
        $this->assignInfoPaypal();
        $paypal_instant_checkout_payment = array();
        // check one step checkout
        if (Configuration::get('PS_ORDER_PROCESS_TYPE') == 1) {
            if (empty($this->context->customer->id)) {
                $paypal_instant_checkout_payment = array('html' => $this->hookDisplayPaymentTop());
            }
        }
        $this->context->smarty->assign(array(
            'st_paypalinstant' => Tools::jsonEncode($st_paypalinstant),
            'display_postcode_form' => (bool) Configuration::get('PAYPAL_POSTCODE_FORM'),
            'url_ajax' => $this->context->link->getModuleLink($this->name, 'form', array(), true),
            'is_paypal_instant_button_list' => (int) Configuration::get('PAYPAL_POSITION_LIST_PAGE'),
            'is_prestashop16' => $this->isPrestashop16(),
            'is_prestashop17' => $this->isPrestashop17(),
            'is_one_step_check_out' => (int) Configuration::get('PS_ORDER_PROCESS_TYPE'),
            'button_positions' => Tools::jsonEncode($this->getButtonPositions()),
            'paypal_instant_checkout_payment' => Tools::jsonEncode($paypal_instant_checkout_payment),
            'paypal_labels' => $this->getLabels(),
        ));

        return $this->display($this->name . '.php', $template);
    }

    public function hookHeader()
    {
        return $this->hookDisplayHeader();
    }

    /**
     * hook into Back Office header position.
     *
     * @return assign template
     */
    public function hookDisplayBackOfficeHeader()
    {
        if (!($this->context->controller instanceof AdminPayPalInstantCheckoutPreferencesController)) {
            return;
        }
        // conditional show or hide option convert currency
        $available_currency_codes = $this->getAvailableCurrencyCodes();
        $paypal_supported_currencies = HsPaypalInstantCheckOut::getSupportedCurrencies();
        $supported_currency_codes = array_intersect($available_currency_codes, $paypal_supported_currencies);
        $unsupported_currency_codes = array_diff($available_currency_codes, $paypal_supported_currencies);
        $show_option_convert_currency = false;
        if (count($available_currency_codes) > 1 && count($supported_currency_codes) > 0 && count($unsupported_currency_codes) > 0) {
            $show_option_convert_currency = true;
        }
        $this->context->smarty->assign(array(
            'pp_guest_as_customer' => (int) Configuration::get('PAYPAL_GUEST_AS_CUSTOMER'),
            'is_prestashop_16' => (int) $this->isPrestashop16(),
            'is_prestashop_17' => (int) $this->isPrestashop17(),
            'show_option_convert_currency' => (bool) $show_option_convert_currency,
            'ps_guest_checkout_enabled' => (int) Configuration::get('PS_GUEST_CHECKOUT_ENABLED'),
            'customer_searching_url' => $this->context->link->getAdminLink('AdminPayPal'),
            'default_address' => (int) Configuration::get('PAYPAL_DEFAULT_ADDRESS')
        ));
        return $this->display($this->name . '.php', 'display_pp_backofficeheader.tpl');
    }

    /**
     * Insert default value of configuration.
     *
     * @return bool
     */
    protected function installConfigs()
    {
        $success = array();
        // general settings
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_CONFIRM_ADDRESS', 0);
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_GUEST_AS_CUSTOMER', 0);
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_POSTCODE_FORM', 0);
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_COMMUNICATION_METHOD', 'PDT');
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('HS_PAYPAL_FEE', 0);
        ;

        // Turn on / off Paypal positions
        $version_config_value = $this->isPrestashop17() ? 0 : 1;
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_POSITION_BLOCK_CART', $version_config_value);
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_POSITION_PRODUCT_PAGE', 1);
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_POSITION_PRODUCT_PAGE', 1);
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_POSITION_PAYMENT', 1);
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_POSITION_CHECKOUT_PAGE', $version_config_value);
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_POSITION_SP_CART_FOOTER', 0);
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_POSITION_SHOPPING_CART', 0);
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_POSITION_ADDING_TO_CART', 1);
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_POSITION_LIST_PAGE', 0);

        // Default label of Paypal buttons
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_TEXT_DEFAULT_BUTTON', '');
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_TEXT_BLOCK_CART', '');
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_TEXT_PRODUCT_PAGE', '');
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_TEXT_PAYMENT', '');
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_TEXT_CHECKOUT_PAGE', '');
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_TEXT_SP_CART_FOOTER', '');
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_TEXT_SHOPPING_CART', '');
        $success[] = (array_sum($success) >= count($success)) && Configuration::updateValue('PAYPAL_TEXT_ADDING_TO_CART', '');

        return array_sum($success) >= count($success);
    }

    public function hookPaymentReturn($params)
    {
        $paypalinstantcheckout17 = new PayPalInstantCheckoutNew();
        return $paypalinstantcheckout17->payPalPaymentReturn($params);
    }

    /**
     * Display paypal instant checkout in block payment.
     *
     * @return html
     */
    public function hookDisplayPaymentTop()
    {
        $this->assignInfoPaypal();
        if ((int) Configuration::get('PAYPAL_POSITION_PAYMENT') === 0) {
            return;
        }
        if (!HsPaypalInstantCheckOut::getPaypalAccount()) {
            return;
        }

        if (!$this->isCurrencyCompatibleWithPaypal()) {
            return;
        }

        $this->context->controller->addCss($this->getCssPath() . 'payment.css');
        $template = $this->isPrestashop16() ? 'display_top_payment_16.tpl' : 'display_top_payment_15.tpl';
        $paypal_fee = $this->getPayPalFee();
        $this->smarty->assign(array(
            'text_translation_of_button_paypal' => $this->getTextTranslationButtonPayPal(),
            'a_surcharge_of_will_be_added' => $paypal_fee > 0 ? sprintf($this->i18n['a_surcharge_of_will_be_added'], Tools::displayPrice($paypal_fee)) : '',
            'img_paypal_path' => $this->_path . 'views/img/',
            'is_prestashop_1611' => version_compare(_PS_VERSION_, '1.6.0.11', '>='),
            'alt_title' => 'PAYPAL_TEXT_PAYMENT',
            'alt_image' => 'PAYPAL_IMAGE_PAYMENT',
        ));

        return $this->display($this->name . '.php', $template);
    }

    /**
     * Get relative path to css files of module.
     *
     * @return string
     */
    public function getCssPath()
    {
        return $this->_path . self::PATH_CSS;
    }

    /**
     * Get relative path to css files of module.
     *
     * @return string
     */
    public function getImgPath()
    {
        return $this->_path . 'views/img/positions/';
    }

    public function getIconPath()
    {
        return $this->_path . 'views/img/';
    }

    /**
     * Get Paypal price.
     *
     * @return float
     */
    public function getPayPalFee()
    {
        $use_tax = Product::getTaxCalculationMethod($this->context->customer->id) ? false : true;
        $total_cart = $this->context->cart->getOrderTotal($use_tax);
        $paypal_fee = 0;
        if ((int) Configuration::get('HS_PAYPAL_FEE') == 1) {
            $paypal_rate = Configuration::get('HS_PAYPAL_STANDARD_RATE') == 'HS_PAYPAL_CUSTOM' ? Configuration::get('HS_PAYPAL_CUSTOM_RATE') : self::PAYPAL_API_RATE;
            $paypal_fixed = Configuration::get('HS_PAYPAL_STANDARD_RATE') == 'HS_PAYPAL_CUSTOM' ? Configuration::get('HS_PAYPAL_CUSTOM_FIXED_FEE') : self::PAYPAL_API_FIXED_FEE;
            $paypal_fee = (float) $paypal_fixed + (float) ($total_cart * $paypal_rate / 100);
        }

        return $paypal_fee;
    }

    /**
     * Get text translation of button PayPal.
     *
     * @return string
     */
    protected function getTextTranslationButtonPayPal()
    {
        $text_translation = $this->i18n['pay_instantly_with_paypal_2'];
        if (!(bool) $this->context->customer->isLogged()) {
            $text_translation = $this->i18n['pay_instantly_with_paypal_without_logging_in'];
        }

        return $text_translation;
    }

    /**
     * Display paypal instant checkout in block payment.
     *
     * @return html
     */
    public function hookDisplayPayment()
    {
        return $this->hookDisplayPaymentTop();
    }

    /**
     * Get button posotions.
     *
     * @return array
     */
    protected function getButtonPositions()
    {
        return Configuration::getMultiple(array_keys($this->position_configuration_keys));
    }

    /**
     * Assign information of paypal to view.
     */
    protected function assignInfoPaypal()
    {
        $this->smarty->assign(array(
            'paypal_tilte' => Configuration::getMultiple(array_keys($this->text_configuration_keys), $this->context->language->id),
            'paypal_image' => $this->context->link->getMediaLink(__PS_BASE_URI__ . $this->getImage((int) $this->context->language->id, 'modules/paypalinstantcheckout')),
            'paypal_action' => $this->context->link->getModuleLink($this->name, 'form', array(), true),
            'text_translation_of_button_paypal' => $this->getTextTranslationButtonPayPal(),
            'paypal_class_css' => $this->getClassCssButton(),
            'paypal_image_header' => $this->context->link->getMediaLink(__PS_BASE_URI__ . 'modules/paypalinstantcheckout/views/img/1_1.png'),
            'button_images' => $this->getButtonImages(),
        ));
    }

    /**
     * Get class css of button Paypal instant checkout.
     *
     * @return string
     */
    protected function getClassCssButton()
    {
        $class_css = '';
        if ((bool) $this->context->customer->isLogged() && $this->isPrestashop16()) {
            $class_css .= ' hs_paypal_btn_logged_16';
        } elseif ((bool) $this->context->customer->isLogged() && !$this->isPrestashop16()) {
            $class_css .= ' hs_paypal_btn_logged_15';
        } elseif ($this->isPrestashop16()) {
            $class_css .= ' hs_paypal_btn_16';
        } elseif (!$this->isPrestashop16()) {
            $class_css .= ' hs_paypal_btn_15';
        }

        return $class_css;
    }

    /**
     * Get target url of Paypal.
     *
     * @return string
     */
    public function getTargetUrl()
    {
        $paypal_mode = (int) Configuration::get('PAYPAL_MODE', 0);

        return $paypal_mode == 1 ? $this->live_url : $this->sandbox_url;
    }

    /**
     * Update the module to version x.
     *
     * @param float $version
     *
     * @return bool
     */
    public function upgrade($version)
    {
        $flag = true;
        switch ($version) {
            case '1.7.2':
                $flag = Configuration::updateValue('PAYPAL_GUEST_AS_CUSTOMER', 1);
                break;

            case '1.7.3':
                $flag = $this->createDummyCustomer() && Configuration::updateValue('PAYPAL_DEFAULT_CARRIER', (int) Configuration::get('PS_POS_DEFAULT_CARRIER'));
                break;

            case '1.7.6':
                $flag = $this->installTab(($this->pic_tabs['AdminPayPal'])) && $this->createDummyAddress();
                break;

            case '1.8':
                $flag = $this->removeTableText18();
                break;

            case '1.8.1':
                $flag = ($this->createImageDirectory() && Configuration::updateValue('PAYPAL_POSTCODE_FORM', 0) && $this->registerHook('displayHeader') && $this->upgradeTable181());
                break;

            case '1.8.2':
                $flag = Configuration::updateValue('PAYPAL_COMMUNICATION_METHOD', 'PDT');
                break;
            case '1.9.0':
                $flag = $this->installTab(($this->pic_tabs['AdminPayPalInstantCheckoutPreferences'])) && $this->registerHook('displayBackOfficeHeader');
                break;
            case '1.9.3':
                $flag = true;
                if ($this->isPrestashop17()) {
                    $flag = $this->registerHook('paymentReturn') && $this->registerHook('displayExpressCheckout') && $this->registerHook('paymentOptions');
                }
                break;

            default:
                break;
        }

        return $flag;
    }

    /**
     * Check current version of prestashop is 1.6 no not.
     *
     * @return bool
     */
    public function isPrestashop16()
    {
        return (int) version_compare(_PS_VERSION_, '1.6', '>=');
    }

    public function isPrestashop17()
    {
        return (int) version_compare(_PS_VERSION_, '1.7', '>=');
    }

    /**
     * All translatable texts which can be easy to use in Smarty or any module controllers
     * <br />
     * For example:<br />
     * - Smarty<br />
     * {$hs_i18n.text_1}<br />
     * - controller<br />
     * $this->module->i18n[text_1].
     */
    protected function initTranslations()
    {
        $source = basename(__FILE__, '.php');
        $shop_name = Configuration::get('PS_SHOP_NAME');
        $contact_link = $this->context->link->getPageLink('contact', true);
        $this->i18n = array(
            'a_preferred_communication_method_between_paypal_and_shop' => sprintf($this->l('A preferred communication method between PayPal and %s. PDT requires your customers to wait until being redirected back to %s. IPN requires nothing but creating orders at %s might not be done in real time.', $source), $shop_name, $shop_name, $shop_name),
            'a_surcharge_of_will_be_added' => $this->l('(A surcharge of %s will be added.)', $source),
            'additional_information' => $this->l('Additional information', $source),
            'address' => $this->l('Address', $source),
            'address_confirmation' => $this->l('Address confirmation?', $source),
            'address_line_2' => $this->l('Address (Line 2)', $source),
            'advanced' => $this->l('Advanced', $source),
            'along_with_proceed_to_checkout_button' => $this->l('Along with "Proceed to checkout" button', $source),
            'an_error_occurred_while_updating_currency' => $this->l('An error occurred while updating currency.', $source),
            'an_error_occurred_while_updating_specific_price' => $this->l('An error occurred while updating the specific price.', $source),
            'an_email_has_been_sent_to_you_with_this_information' => $this->l('An email has been sent to you with this information.', $source),
            'any_order_requires_an_associated_guest_account_or_customer_account' => $this->l('Any order requires an associated guest account or customer account. If a customer account is found based on Paypal email, this customer will be associated with the current order. Otherwise, Paypal Instant Checkout creates a new account based on your setting.', $source),
            'block_cart_at_header' => $this->l('Block cart at header', $source),
            'block_page' => $this->l('Block/page', $source),
            'button' => $this->l('Button:', $source),
            'button_title' => $this->l('CTA\'s label:', $source),
            'city' => $this->l('City', $source),
            'collect_payment' => $this->l('collect_payment', $source), // remove late
            'communication_method' => $this->l('Communication method', $source),
            'company' => $this->l('Company', $source),
            'configure' => $this->l('Configure', $source),
            'connect_to_paypal_api' => $this->l('Connect to Paypal API', $source),
            'convert_currency' => $this->l('Convert currency', $source),
            'country' => $this->l('Country', $source),
            'custom_fixed_fee' => $this->l('Custom fixed fee:', $source),
            'custom_paypal_fee' => $this->l('Custom Paypal fee', $source),
            'custom_standard_rate' => $this->l('Custom standard rate (%):', $source),
            'customer' => $this->l('Customer', $source),
            'customer_account' => $this->l('Customer account', $source),
            'default_address' => $this->l('Default address', $source),
            'default_button' => $this->l('Default button', $source),
            'default_carrier' => $this->l('Default carrier', $source),
            'default_customer' => $this->l('Default customer', $source),
            'delete_this_button' => $this->l('Delete this button', $source),
            'display_postcode_form' => $this->l('Display postcode form', $source),
            'dni_nif_nie' => $this->l('DNI / NIF / NIE', $source),
            'enable_paypal_instant_checkout_button_in_different_contexts' => $this->l('Enable Paypal Instant Checkout button in different contexts', $source),
            'enter_a_custom_text_or_leave_empty' => $this->l('Enter a custom text, or leave empty', $source),
            'enter_your_postcode' => $this->l('Enter your postcode', $source),
            'error' => $this->l('Error', $source),
            'fee_model' => $this->l('Fee model', $source),
            'finished' => $this->l('Finished', $source),
            'first_name' => $this->l('First name', $source),
            'follow_my_order' => $this->l('Follow my order', $source),
            'give_this_address_a_name_eg_address1_or_stushouse' => $this->l('Give this address a name. eg. "Address1" or "StusHouse"', $source),
            'guest' => $this->l('Guest', $source),
            'here_is_your_order_detail' => $this->l('Here is your order detail:', $source),
            'home_phone' => $this->l('Home phone', $source),
            'identification_number' => $this->l('Identification number', $source),
            'identify_token' => $this->l('Identify token', $source),
            'if_a_currency_is_not_supported_by_paypal_let_convert_to_a_supported_one' => $this->l('If a currency is not supported by Paypal, let\'s detect and convert to a supported one', $source),
            'invalid_postcode' => $this->l('Invalid postcode', $source),
            'invalid_product' => $this->l('invalid product.', $source),
            'it_might_take_a_few_minutes_for_being_validated_please_refresh_this_page_if_your_order_is_missing' => $this->l('It might take a few minutes for being validated. Please refresh this page if your order is missing.', $source),
            'last_name' => $this->l('Last name', $source),
            'list_pages' => $this->l('List pages (home, category, accessories, ...)', $source),
            'live' => $this->l('Live', $source),
            'mobile_phone' => $this->l('Mobile phone', $source),
            'mode' => $this->l('Mode', $source),
            'modify_address' => $this->l('Modify address', $source),
            'my_address' => $this->l('My address', $source),
            'new_address' => $this->l('New address', $source),
            'no' => $this->l('No', $source),
            'oops_something_goes_wrong' => $this->l('Oops! Something goes wrong. Please contact the shop owner.', $source),
            'or' => $this->l('Or', $source),
            'order_confirmation' => $this->l('Order confirmation', $source),
            'order_invalid_please_contact_our_customer_service' => $this->l('Order invalid, please contact our customer service.', $source),
            'order_reference' => $this->l('Order reference', $source),
            'override_email_after_return_of_payment' => $this->l('Sync customer data with Paypal data', $source),
            'pay_instantly_with_paypal' => $this->l('Pay instantly with Paypal', $source),
            'pay_instantly_with_paypal_2' => str_replace(array('[label]', '[/label]'), array('<label class="instantly">', '</label>'), $this->l('Pay [label]instantly[/label] with Paypal', $source)),
            'pay_instantly_with_paypal_without_logging_in' => str_replace(array('[label]', '[/label]', '[span]', '[/span]'), array('<label class="instantly">', '</label>', '<span>', '</span>'), $this->l('Pay [label]instantly[/label] with Paypal [span](without logging in)[/span]', $source)),
            'payment_amount' => $this->l('Payment amount'),
            'payment_page_step' => $this->l('Payment block|page', $source),
            'payment_method' => $this->l('Payment method'),
            'paypal_account' => $this->l('Paypal account', $source),
            'paypal_button' => $this->l('Paypal button', $source),
            'paypal_confirmation_screen' => $this->l('Paypal Confirmation Screen', $source),
            'paypal_fee' => $this->l('Paypal fee', $source),
            'paypal_fee_does_not_exist' => $this->l('Paypal fee does not exist.', $source),
            'paypal_fee_standard_rate_for_international_payments_fixed_fee' => $this->l('Paypal fee = Standard rate for international payments + Fixed fee (Selling is 4.4% + $0.3 per sale)'),
            'paypal_pending_reasons' => array(
                'address' => $this->l('Customer did not include a confirmed shipping address and your Payment Receiving Preferences is set such that you want to manually accept or deny each of these payments.', $source),
                'authorization' => $this->l('You set the payment action to Authorization and have not yet captured funds.', $source),
                'echeck' => $this->l('The payment is pending because it was made by an eCheck that has not yet cleared.', $source),
                'intl' => $this->l('You hold a non-U.S. account and do not have a withdrawal mechanism. You must manually accept or deny this payment from your Account Overview.', $source),
                'multi_currency' => $this->l('You do not have a balance in the currency sent, and you do not have your Payment Receiving Preferences set to automatically convert and accept this payment. You must manually accept or deny this payment.', $source),
                'other' => $this->l('Unknown, for more information, please contact PayPal customer service.', $source),
                'paymentreview' => $this->l('The payment is pending while it is reviewed by PayPal for risk.', $source),
                'regulatory_review' => $this->l('The payment is pending because PayPal is reviewing it for compliance with government regulations.', $source),
                'unilateral' => $this->l('The payment is pending because it was made to an email address that is not yet registered or confirmed.', $source),
                'upgrade' => $this->l('The payment is pending because it was made via credit card and you must upgrade your account to Business or Premier status before you can receive the funds.', $source),
                'verify' => $this->l('You are not yet verified, you have to verify your account before you can accept this payment.', $source),
            ),
            'please_assign_an_address_title_for_future_reference' => $this->l('Please assign an address title for future reference.', $source),
            'popup_shown_after_adding_to_basket' => $this->l('Popup shown after adding to basket', $source),
            'product_page' => $this->l('Product page', $source),
            'required_field' => $this->l('Required field', $source),
            'sandbox' => $this->l('Sandbox', $source),
            'save' => $this->l('Save', $source),
            'search_customer' => $this->l('Search Customer', $source),
            'search_for_customer' => $this->l('Search for customer', $source),
            'server_to_client' => $this->l('Server to client (PDT)', $source),
            'server_to_server' => $this->l('Server to server (IPN)', $source),
            'settings' => $this->l('Settings', $source),
            'settings_updated' => $this->l('Settings updated', $source),
            'shopping_cart_summary_footer' => $this->l('Shopping cart summary footer', $source),
            'shopping_cart_summary_page' => $this->l('Shopping cart summary page', $source),
            'state' => $this->l('State', $source),
            'submit' => $this->l('Submit', $source),
            'to_add_a_new_address_please_fill_out_the_form_below' => $this->l('To add a new address, please fill out the form below.', $source),
            'update_your_address' => $this->l('Update your address', $source),
            'upload_another_button' => $this->l('Upload another button', $source),
            'upload_your_own_button' => $this->l('Upload your own button', $source),
            'vat_number' => $this->l('VAT number', $source),
            'view' => $this->l('View', $source),
            'view_your_order_history' => $this->l('View your order history', $source),
            'wrong_paypal_account_id' => $this->l('Wrong Paypal account ID', $source),
            'yes' => $this->l('Yes', $source),
            'you_must_register_at_least_one_phone_number' => $this->l('You must register at least one phone number.', $source),
            'your_order_id_is' => $this->l('Your order ID is', $source),
            'your_address' => $this->l('Your address', $source),
            'your_addresses' => $this->l('Your addresses', $source),
            'your_order_id_has_been_sent_via_email' => $this->l('Your order ID has been sent via email.', $source),
            'your_order_on_is_completed' => sprintf($this->l('Your order on  %s is completed.', $source), $shop_name),
            'zip_postal_code' => $this->l('Zip/Postal code', $source),
            'for_any_questions_or_for_further_information_please_contact_our' => str_replace(array('[label]', '[/label]'), array('<a class="paypal_link" href="' . $contact_link . '">', '</a>'), $this->l('For any questions or for further information, please contact our [label]customer service department[/label].', $source)),
        );

        $this->context->smarty->assign('hs_translation', $this->i18n);
    }

    /**
     * Add dummy product for payment fee.
     *
     * @return bool
     */
    protected function addDummyProduct()
    {
        $product = new Product((int) Configuration::get('HS_ID_PRODUCT_PAYPAL_FEE'));
        if (Validate::isLoadedObject($product)) {
            return true;
        }

        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            $product->name[$lang['id_lang']] = $this->i18n['paypal_fee'];
            $product->link_rewrite[$lang['id_lang']] = Tools::link_rewrite($this->i18n['paypal_fee']);
        }
        $product->price = self::PRICE;
        $product->wholesale_price = self::WHOLESALE_PRICE;
        $product->active = 1;
        $product->visibility = 'catalog';

        if (!$product->add()) {
            return false;
        }

        StockAvailable::setQuantity((int) $product->id, 0, self::QTY);

        return Configuration::updateValue('HS_ID_PRODUCT_PAYPAL_FEE', (int) $product->id);
    }

    /**
     * send infomation to customer.
     *
     * @param Customer $customer
     *
     * @return bool
     */
    public function sendConfirmationMail(Customer $customer, $random_pass)
    {
        return Mail::Send($this->context->language->id, 'account', Mail::l('Welcome!'), array('{firstname}' => $customer->firstname, '{lastname}' => $customer->lastname, '{email}' => $customer->email, '{passwd}' => $random_pass,), $customer->email, $customer->firstname . ' ' . $customer->lastname);
    }

    /**
     *
     * @return Customer
     */
    public function getCustomer()
    {
        $customer = new Customer();
        if (!empty($this->paypal_response)) {
            // modify for ps 1.7
            //$customer_exists = Customer::customerExists($this->paypal_response['payer_email'], true);
            $customer_exists = $this->context->customer->isLogged() ? (int) $this->context->customer->id : (int) Customer::customerExists($this->paypal_response['payer_email'], true);
            if ($customer_exists) {
                $customer = new Customer($customer_exists);
            } else {
                $customer->lastname = $this->paypal_response['last_name'];
                $customer->firstname = $this->paypal_response['first_name'];
                $customer->email = $this->paypal_response['payer_email'];
                $ramdom_passwd = Tools::passwdGen(6);
                $customer->passwd = md5(_COOKIE_KEY_ . $ramdom_passwd);
                $customer->active = 1;

                if (Configuration::get('PS_GUEST_CHECKOUT_ENABLED')) {
                    if (!Configuration::get('PAYPAL_GUEST_AS_CUSTOMER')) {
                        $customer->is_guest = 1;
                    }
                }
                $customer->add();
                if (!$customer->is_guest) {
                    $this->sendConfirmationMail($customer, $ramdom_passwd);
                }
            }
        }
        return $customer;
    }

    /**
     *
     * @return int
     */
    public function getIdOrderStateBasedOnPaypalPaymentStatus()
    {
        switch (Tools::strtoupper($this->paypal_response['payment_status'])) {
            case 'COMPLETED':
                $id_order_state = Configuration::get('PS_OS_PAYMENT');
                break;

            case 'PENDING':
                $id_order_state = Configuration::get('PS_OS_PAYPAL');
                break;

            case 'REFUNDED':
                $id_order_state = Configuration::get('PS_OS_REFUND');
                break;

            default:
                $id_order_state = Configuration::get('PS_OS_ERROR');
                break;
        }

        return $id_order_state;
    }

    /**
     *
     * @return Address
     */
    public function getPayPalAddress()
    {
        $returned_paypal_address = new HsPayPalAddress();
        if (!empty($this->paypal_response)) {
            $current_addresses = $this->context->customer->getAddresses($this->context->language->id);
            $paypal_address = HsPayPalAddress::initPaypalAddress($this->paypal_response, $this->context->customer);
            if (!empty($current_addresses)) {
                foreach ($current_addresses as $current_address) {
                    if (HsPayPalAddress::compareAddresses($paypal_address, $current_address)) {
                        $returned_paypal_address = new HsPayPalAddress($current_address['id_address']);
                        break;
                    }
                }
            }

            if (!Validate::isLoadedObject($returned_paypal_address)) {
                $returned_paypal_address->hydrate($paypal_address, $this->context->language->id);
                $returned_paypal_address->add();
            }
        }

        return $returned_paypal_address;
    }

    /**
     * Create a dummy customer for Paypal Instant Checkout.
     *
     * @return bool
     */
    protected function createDummyCustomer()
    {
        $id_customer = Configuration::get('PAYPAL_DUMMY_CUSTOMER', 0);
        $customer = new Customer($id_customer);
        if (Validate::isLoadedObject($customer)) {
            return true;
        }

        $customer->email = Configuration::get('PS_SHOP_EMAIL');
        $customer->firstname = 'Paypal';
        $customer->lastname = 'Paypal';
        $customer->passwd = Tools::encrypt(Tools::passwdGen());
        $customer->id_gender = 1;
        $customer->active = 1;

        return $customer->save() & Configuration::updateValue('PAYPAL_DUMMY_CUSTOMER', (int) $customer->id);
    }

    /**
     * Create dummy address of dummy customer.
     *
     * @return bool
     */
    public function createDummyAddress()
    {
        $id_address = Configuration::get('PAYPAL_DEFAULT_ADDRESS', 0);
        $id_customer = Configuration::get('PAYPAL_DUMMY_CUSTOMER');
        $customer = new Customer($id_customer);
        $address = new Address($id_address);
        if (Validate::isLoadedObject($address) && Validate::isLoadedObject($customer)) {
            if ((int) $address->id_customer === (int) $customer->id) {
                return true;
            }
        }

        $address->id_customer = $customer->id;
        $address->id_country = Configuration::get('PS_COUNTRY_DEFAULT');
        $address->firstname = $customer->firstname;
        $address->lastname = $customer->lastname;
        $address->address1 = 'N/A';
        $address->city = 'N/A';
        $address->company = 'N/A';
        $address->address2 = 'N/A';
        $address->other = 'N/A';
        $address->phone_mobile = '000000000';
        $address->phone = '000000000';
        $address->alias = Tools::passwdGen(8, 'NO_NUMERIC');

        return $address->save() && Configuration::updateValue('PAYPAL_DEFAULT_ADDRESS', (int) $address->id);
    }

    /**
     * Install admin tab.
     *
     * @return boolean
     */
    public function installTabs()
    {
        $flag = true;
        if (self::CLASS_PARENT_TAB) {
            $id_parent = (int) Tab::getIdFromClassName(self::CLASS_PARENT_TAB); // get id parent tab
            if (!$id_parent) {
                // install parent tab
                $this->installModuleTab(self::CLASS_PARENT_TAB, $this->display_name, 0);
                $id_parent = (int) Tab::getIdFromClassName(self::CLASS_PARENT_TAB); // get id parent exit tab
                $this->updatePositionParentTab($id_parent);
            }
            if (isset($id_parent)) {
                foreach ($this->pic_tabs as $combination) {
                    $flag = $flag && (int) $this->installModuleTab($combination['tab_class'], $combination['name'], $id_parent, $combination['position'], $combination['active']);
                }
            }
        }

        return $flag;
    }

    /**
     * Install single new tab for new version.
     *
     * @param array $admin_tab
     *
     * @return boolean
     */
    public function installTab(array $admin_tab)
    {
        $id_parent = (int) Tab::getIdFromClassName(self::CLASS_PARENT_TAB);

        return $this->installModuleTab($admin_tab['tab_class'], $admin_tab['name'], $id_parent, $admin_tab['position'], $admin_tab['active']);
    }

    /**
     * Install an Admin Tab (menu).
     *
     * @param string $tab_class
     * @param string $tab_name
     * @param int    $id_tab_parent
     * @param int    $position
     * @return boolean
     */
    public function installModuleTab($tab_class, $tab_name, $id_tab_parent = -1, $position = 0, $active = 1)
    {
        $tab = new Tab();
        $name = array();
        foreach (Language::getLanguages(false) as $language) {
            $name[$language['id_lang']] = $tab_name;
        }
        $tab->name = $name;
        $tab->class_name = (string) $tab_class;
        $tab->module = $this->name;
        $tab->active = (int) $active;
        if ($id_tab_parent != null) {
            $tab->id_parent = (int) $id_tab_parent;
        }
        if ((int) $position > 0) {
            $tab->position = (int) $position;
        }

        return $tab->add(true);
    }

    /**
     * Uninstall all Admin Tabs (menu).
     *
     * @param string $module_name
     *
     * @return boolean
     */
    public function uninstallTabs($module_name)
    {
        $flag = true;
        $tabs = Tab::getCollectionFromModule($module_name);
        if (!empty($tabs)) {
            foreach ($tabs as $tab) {
                $flag = $flag && $tab->delete();
            }
        }

        return $flag;
    }

    /**
     * Move `text` from Database to configuration table.
     *
     * @return bool
     */
    public function removeTableText18()
    {
        $paypal_text_default_button_values = array();
        $existing_paypal_texts = Db::getInstance()->executeS('SELECT `text`, `id_lang` FROM `' . _DB_PREFIX_ . 'blmod_paypal_text`');
        $success = true;

        if (!empty($existing_paypal_texts)) {
            foreach ($existing_paypal_texts as $existing_paypal_text) {
                $paypal_text_default_button_values[$existing_paypal_text['id_lang']] = $existing_paypal_text['text'];
            }

            $success = Configuration::updateValue('PAYPAL_TEXT_DEFAULT_BUTTON', $paypal_text_default_button_values);
        }

        return $success && Db::getInstance()->execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'blmod_paypal_text`');
    }

    /**
     * Get labels of all or a specific button.
     *
     * @param string $button_name name of a button, usually a text configuration key of a Paypal position
     *
     * @return array / string
     */
    public function getLabels($button_name = null)
    {
        $labels = Configuration::getMultiple(array_keys($this->text_configuration_keys), $this->context->language->id);
        // If default label is empty, let's use the fixed label
        if (empty($labels['PAYPAL_TEXT_DEFAULT_BUTTON'])) {
            $labels['PAYPAL_TEXT_DEFAULT_BUTTON'] = $this->i18n['pay_instantly_with_paypal'];
        }

        // If a label is empty, let's use default label
        foreach ($labels as &$label) {
            if (empty($label)) {
                $label = $labels['PAYPAL_TEXT_DEFAULT_BUTTON'];
            }
        }
        if (empty($button_name)) {
            return $labels;
        } else {
            return isset($labels[$button_name]) ? $labels[$button_name] : null;
        }
    }

    /**
     * Get images for buttons.
     *
     * @return array
     */
    public function getButtonImages()
    {
        $existing_button_images = scandir($this->upload_path);
        $images = array();
        $default_image_button = 'PAYPAL_IMAGE_DEFAULT_BUTTON';
        foreach (array_keys($this->image_configuration_keys) as $image_key) {
            foreach ($existing_button_images as $existing_image) {
                foreach ($this->extensions_list as $image_type) {
                    if ($existing_image == $image_key . '_' . $this->context->language->id . $image_type) {
                        $images[$image_key] = 'pic/' . $image_key . '_' . $this->context->language->id . $image_type;
                    }
                }
                if (empty($images[$image_key])) {
                    foreach ($this->extensions_list as $image_type) {
                        if ($existing_image == $default_image_button . '_' . $this->context->language->id . $image_type) {
                            $images[$image_key] = 'pic/' . $default_image_button . '_' . $this->context->language->id . $image_type;
                        }
                    }
                }
            }
            if (empty($images[$image_key])) {
                $images[$image_key] = null;
            }
        }

        return $images;
    }

    /**
     * Get custom label of a position.
     *
     * @param string $position_key
     *
     * @return array
     *               <pre>
     *               array(
     *               'name' => string // configuration key
     *               'flag' => html // list of flags
     *               'labels' => array // a list of labels in multiple languages
     *               'image_name' => string // image key
     *               'image_link' => array // list of image links
     *               'image_text' => array // list of default value image buttons texts
     *               )
     */
    public function getPaypalButtonLabels($position_key)
    {
        $languages = Language::getLanguages();
        $default_language = (int) Configuration::get('PS_LANG_DEFAULT');
        $configuration_key = str_replace('POSITION', 'TEXT', $position_key);
        $image_key = str_replace('POSITION', 'IMAGE', $position_key);
        $image_text = array();
        $image_link = array();
        $existing_button_images = scandir($this->upload_path);
        foreach ($languages as $language) {
            foreach ($existing_button_images as $existing_image) {
                foreach ($this->extensions_list as $image_type) {
                    if ($image_key . '_' . $language['id_lang'] . $image_type == $existing_image) {
                        $image_text[$language['id_lang']] = $this->i18n['upload_another_button'];
                        $image_link[$language['id_lang']] = '../img/pic/' . $image_key . '_' . $language['id_lang'] . $image_type;
                    }
                }
            }
            if (empty($image_text[$language['id_lang']])) {
                $image_text[$language['id_lang']] = $this->i18n['upload_your_own_button'];
            }
        }

        return array(
            'name' => $configuration_key,
            'flag' => $this->displayFlags($languages, $default_language, $configuration_key . '¤img', $configuration_key, true),
            'labels' => Configuration::getInt($configuration_key),
            'image_name' => $image_key,
            'image_link' => $image_link,
            'image_text' => $image_text,
        );
    }

    /**
     * Create folder if not existing to store images for paypal custom buttons.
     *
     * @return bool
     */
    protected function createImageDirectory()
    {
        $success = true;
        if (!file_exists($this->upload_path)) {
            $success = mkdir($this->upload_path);
        }

        return $success;
    }

    /**
     * Update payment Update order total paid + Create invoice for Order.
     *
     * @param Order
     */
    public function updateAfterPayment(Order $order)
    {
        if (!Validate::isLoadedObject($order)) {
            return;
        }


        $id_paypal_address = (int) $this->id_paypal_address;

        if ($id_paypal_address) {
            $sql = 'UPDATE `' . _DB_PREFIX_ . 'cart_product`
					SET `id_address_delivery` = ' . (int) $id_paypal_address . '
					WHERE  `id_cart` = ' . (int) $order->id_cart;

            Db::getInstance()->execute($sql);
            $sql = 'UPDATE `' . _DB_PREFIX_ . 'customization`
					SET `id_address_delivery` = ' . (int) $id_paypal_address . '
					WHERE  `id_cart` = ' . (int) $order->id_cart;
            Db::getInstance()->execute($sql);

            $this->context->cart->id_address_delivery = $id_paypal_address;
            $this->context->cart->id_address_invoice = $id_paypal_address;
            $this->context->cart->update();

            $order->id_address_delivery = (int) $id_paypal_address;
            $order->id_address_invoice = (int) $id_paypal_address;
            $order->update();

            if ($order->hasInvoice()) {
                $this->updateOrderInvoiceAddress($id_paypal_address, $order);
            }
        }
        // unset current product in $this->context->cookie->paypal_product_cart
        if ($this->id_product) {
            HsPaypalInstantCheckOut::deleteCart((int) $this->id_product);
        }
    }

    /**
     * clone default address of customer.
     * @return Address
     */
    public function cloneDefaultAddress()
    {
        $default_address = new HsPayPalAddress();
        $paypal_default_address = new HsPayPalAddress((int) Configuration::get('PAYPAL_DEFAULT_ADDRESS'));
        $current_addresses = $this->context->customer->getAddresses($this->context->language->id);

        if (!empty($current_addresses)) {
            foreach ($current_addresses as $current_address) {
                if (HsPayPalAddress::compareAddresses(get_object_vars($paypal_default_address), $current_address)) {
                    $default_address = new HsPayPalAddress($current_address['id_address']);
                    break;
                }
            }
        }

        if (!Validate::isLoadedObject($default_address)) {
            unset($paypal_default_address->id);
            $paypal_default_address->id_customer = (int) $this->context->customer->id;
            if ($paypal_default_address->add()) {
                $default_address = $paypal_default_address;
            }
        }
        return $default_address;
    }

    /*
     * Remove images and image directory when uninstall module
     * @param $dir string name of image directory
     * @return bool
     */

    protected function removeImageDirectory($dir)
    {
        $img_files = array_diff(scandir($dir), array('.', '..'));
        foreach ($img_files as $img) {
            unlink("$dir/$img");
        }

        return rmdir($dir);
    }

    /**
     * Move paypal account from table blmod_paypal_user to table configuration and drop table blmod_paypal_user.
     *
     * @return bool
     */
    protected function upgradeTable181()
    {
        $flag = true;
        $paypal_account = Db::getInstance()->getValue('SELECT `id` FROM `' . _DB_PREFIX_ . 'blmod_paypal_user`');
        if ($paypal_account) {
            $flag = Configuration::updateValue('HS_PAYPAL_ACCOUNT', $paypal_account);
        }

        return $flag && Db::getInstance()->Execute('DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'blmod_paypal_user');
    }

    /**
     * @param int $id_address which return by PayPal
     * @param Order $order current order
     */
    protected function updateOrderInvoiceAddress($id_address, Order $order)
    {
        $order_invoices_collection = new PrestaShopCollection('OrderInvoice');
        $order_invoices_collection->where('id_order', '=', $order->id);
        $order_invoice = $order_invoices_collection->getFirst();
        $address = new Address($id_address);

        if (Validate::isLoadedObject($order_invoice) && Validate::isLoadedObject($address)) {
            $order_invoice->shop_address = AddressFormat::generateAddress($address, array(), '<br />', ' ');
            $invoiceAddressPatternRules = Tools::jsonDecode(Configuration::get('PS_INVCE_INVOICE_ADDR_RULES'), true);
            $order_invoice->invoice_address = AddressFormat::generateAddress($address, $invoiceAddressPatternRules, '<br />', ' ');
            $deliveryAddressPatternRules = Tools::jsonDecode(Configuration::get('PS_INVCE_DELIVERY_ADDR_RULES'), true);
            $order_invoice->delivery_address = AddressFormat::generateAddress($address, $deliveryAddressPatternRules, '<br />', ' ');
            $order_invoice->update();
        }
    }

    /**
     *
     * @param string $paypal_pending_reason reason return from paypal
     * @return string
     */
    protected function getPayPalPendingReasons($paypal_pending_reason)
    {
        return array_key_exists($paypal_pending_reason, $this->i18n['paypal_pending_reasons']) ? $this->i18n['paypal_pending_reasons'][$paypal_pending_reason] : '';
    }

    /**
     *
     * @return string
     */
    public function getOrderMessage()
    {
        $messages = array(Configuration::get('PAYPAL_COMMUNICATION_METHOD'));
        foreach ($this->paypal_response as $key => $value) {
            switch ($key) {
                case 'pending_reason':
                    $messages[] = "$key:" . $this->getPayPalPendingReasons($value);
                    break;
                default:
                    $messages[] = "$key:$value";
                    break;
            }
        }
        return implode("\n", $messages);
    }

    /**
     *
     * @return boolean
     */
    public function isDefaultCustomer()
    {
        return (int) $this->context->cart->id_customer === (int) Configuration::get('PAYPAL_DUMMY_CUSTOMER');
    }

    /**
     *
     * @param int $id_product
     */
    public function setProductId($id_product)
    {
        $this->id_product = (int) $id_product;
    }

    /**
     *
     * @param array $paypal_response
     * <pre>
     * array (
     *  [mc_gross] => float
     *  [protection_eligibility] => string
     *  [address_status] => string
     *  [item_number1] => string
     *  [tax] => float
     *  [item_number2] =>string
     *  [payer_id] =>  string
     *  [address_street] => string
     *  [payment_date] => string
     *  [payment_status] => string
     *  [charset] => string
     *  [address_zip] => int
     *  [mc_shipping] => float
     *  [mc_handling] => float
     *  [first_name] => string
     *  [mc_fee] => float
     *  [address_country_code] => string
     *  [address_name] => string
     *  [custom] => string
     *  [payer_status] => string
     *  [business] => string
     *  [address_country] => string
     *  [num_cart_items] => int
     *  [mc_handling1] => float
     *  [mc_handling2] => float
     *  [address_city] => string
     *  [payer_email] => string
     *  [mc_shipping1] => float
     *  [mc_shipping2] => float
     *  [tax1] => float
     *  [tax2] => float
     *  [txn_id] => string
     *  [payment_type] => string
     *  [last_name] => string
     *  [address_state] => string
     *  [item_name1] => string
     *  [receiver_email] => string
     *  [item_name2] => string
     *  [payment_fee] => float
     *  [quantity1] => int
     *  [quantity2] => int
     *  [receiver_id] => string
     *  [txn_type] => string
     *  [mc_gross_1] => float
     *  [mc_currency] => string
     *  [mc_gross_2] => float
     *  [residence_country] => string
     *  [transaction_subject] => string
     *  [payment_gross] => float
     *   </pre>
     *  )
     */
    public function setResponse(array $paypal_response)
    {
        $this->paypal_response = $paypal_response;
    }

    /**
     *
     * @param int $id_address
     */
    public function setPayPalIdAddress($id_address)
    {
        $this->id_paypal_address = (int) $id_address;
    }

    /**
     * @param array $params
     * @return html
     */
    public function hookPaymentOptions($params)
    {
        $paypalinstantcheckout17 = new PayPalInstantCheckoutNew();
        return $paypalinstantcheckout17->paypalExternalPaymentOptions($params);
    }
}
require_once(_PS_ROOT_DIR_ . '/modules/paypalinstantcheckout/paypalinstantcheckoutnew.php');
