<?php
/**
 * Paypal Instant Checkout for PrestaShop.
 *
 * @author    PrestaMonster
 * @copyright PrestaMonster
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

/**
 * Controller of admin page - Point Of Sale (Abstract)
 */
class AdminPayPalInstantCheckoutPreferencesController extends ModuleAdminController
{
    /**
     * @var array
     * <pre>
     * array(
     *  string,// path/to/js/file
     *  string
     *  ...
     * )
     */
    protected $module_media_js = array(
        'paypalinstantcheckout_preferences.js',
        'guest_as_customer.js',
        'search_customer.js',
        'paypal_admin_settings.js',
        'tooltipster/jquery.tooltipster.min.js',
    );
    
    protected $module_media_css = array(
        'tooltipster/tooltipster.css' => 'all',
        'tooltipster/themes/tooltipster-pic.css' => 'all'
    );

    /**
     * @var array
     * <pre>
     * array(
     *  string,// jQuery plugin name
     *  string,
     *  ...
     * )
     */
    protected $jquery_plugins = array();
    
    /**
     * @var array
     * <pre>
     * array(
     *  string,// Name of jQuery component
     *  string,
     *  ...
     * )
     */
    protected $jquery_ui_components = array('ui.autocomplete');
    /**
     * @see parent::__construct()
     */
    public function __construct()
    {
        $this->bootstrap = true;
        parent::__construct();
        if (Tools::isSubmit('removeImage')) {
            $this->deleteExistingButtonImages(Tools::getValue('image_id'));
        }
        $this->fields_options = array(
            'paypal_account' => array(
                'title' => $this->module->displayName . ' - V' . $this->module->version,
                'image' => $this->module->getIconPath() . 'paypal_icon.png',
                'class' => 'configuration-tab configuration_fieldset_paypal_account',
                'tabTitle' => $this->module->i18n['paypal_account'],
                'fields' => $this->generateAccountConfigFields(),
                'submit' => array(
                    'title' => $this->module->i18n['save'],
                ),
            ),
            'paypal_button' => array(
                'title' => $this->module->displayName . ' - V' . $this->module->version,
                'image' => $this->module->getIconPath() . 'paypal_icon.png',
                'class' => 'configuration-tab configuration_fieldset_paypal_button',
                'tabTitle' => $this->module->i18n['paypal_button'],
                'fields' => $this->generateButtonsConfigFields(),
                'submit' => array(
                    'title' => $this->module->i18n['save'],
                ),
            ),
            'advanced' => array(
                'title' => $this->module->displayName . ' - V' . $this->module->version,
                'image' => $this->module->getIconPath() . 'paypal_icon.png',
                'class' => 'configuration-tab configuration_fieldset_advanced',
                'tabTitle' => $this->module->i18n['advanced'],
                'fields' => $this->generateAdvancedConfigFields(),
                'submit' => array(
                    'title' => $this->module->i18n['save'],
                ),
            )

        );
    }
    
    /**
     * @see parent::initContent()
     */
    public function initContent()
    {
        $this->context->smarty->assign(array(
            'admin_base_url' => __PS_BASE_URI__.basename(_PS_ADMIN_DIR_),
            'is_prestashop16' => (int) $this->module->isPrestashop16(),
        ));
        parent::initContent();
    }
    
    protected function reformatGroupOptions($group_options)
    {
        foreach ($group_options as $key => &$options) {
            $options['key'] = $key;
            $options['value'] = !empty($options['value']) ? $options['value'] : Configuration::get($key, 0);
        }

        return $group_options;
    }


    protected function generateAccountConfigFields()
    {
        return array(
            'HS_PAYPAL_ACCOUNT' => array(
                'title' => $this->module->i18n['paypal_account'],
                'type' => 'text',
                'class' => 'paypal_text',
                'size' => '80',
                'validation' => 'isEmail',
            ),
            'PAYPAL_IDENTIFY_TOKEN' => array(
                'title' => $this->module->i18n['identify_token'],
                'type' => 'text',
                'size' => '80',
                'class' => 'paypal_text',
            ),
            'PAYPAL_MODE' => array(
                'title' => $this->module->i18n['mode'],
                'type' => 'paypal_mode',
                'value' => (int) Configuration::get('PAYPAL_MODE')
            ),
            'HS_PAYPAL_FEE' => array(
                'title' => $this->module->i18n['paypal_fee'],
                'validation' => 'isBool',
                'type' => 'bool',
                'desc' => $this->module->i18n['paypal_fee_standard_rate_for_international_payments_fixed_fee'],
            ),
            'HS_PAYPAL_STANDARD_RATE' => array(
                'title' => $this->module->i18n['fee_model'],
                'type' => 'select',
                'list' => $this->getPayPalFees(),
                'identifier' => 'value',
            ),
            'HS_PAYPAL_CUSTOM_RATE' => array(
                'title' => $this->module->i18n['custom_standard_rate'],
                'type' => 'text',
                'class' => 'fixed-width-xxl',
            ),
            'HS_PAYPAL_CUSTOM_FIXED_FEE' => array(
                'title' => $this->module->i18n['custom_fixed_fee'],
                'type' => 'text',
                'class' => 'fixed-width-xxl',
            ),
            'PAYPAL_CURRENT_FORM_TAB' => array(
                'type' => 'hidden',
                'value' => 'paypal_account',
            ),
        );
    }

    /**
     *
     * @return array
     */
    protected function getPayPalFees()
    {
        return array(
            array(
                'value' => 'HS_PAYPAL_API',
                'name' => $this->module->i18n['connect_to_paypal_api']
            ),
            array(
                'value' => 'HS_PAYPAL_CUSTOM',
                'name' => $this->module->i18n['custom_paypal_fee']
            ),
        );
    }
    

    /**
     * Define again array order states.
     *
     * @return array
     *               array(<pre>
     *               [0] => array(
     *               'value' => int,
     *               'name' => string
     *               )
     *               ...
     *               )</pre>
     */
    protected function getCarriers()
    {
        $carriers = Carrier::getCarriers((int) $this->context->language->id, true, false, false, null, Carrier::ALL_CARRIERS);
        $list_carriers = array();
        $i = 0;
        foreach ($carriers as $carrier) {
            $list_carriers[$i]['value'] = $carrier['id_carrier'];
            $list_carriers[$i]['name'] = $carrier['name'];
            ++$i;
        }

        return $list_carriers;
    }
    
    protected function generateButtonsConfigFields()
    {
        return array(
            'paypal_buttons' => array(
                'title' => $this->module->i18n['enable_paypal_instant_checkout_button_in_different_contexts'],
                'type' => 'paypal_buttons',
                'button_positions_data' => $this->getPaypalButtonPositions(),
            )
        );
    }
    
    /**
     * @see parent::renderOptions()
     * @return html
     */
    public function renderOptions()
    {
        $this->fields_options['paypal_button']['fields']['paypal_buttons']['button_positions_data'] = $this->getPaypalButtonPositions();
        return parent::renderOptions();
    }
    
    /**
     * Get group checkbox position paypal button.
     *
     * @return html
     */
    protected function getPaypalButtonPositions()
    {
        $languages = Language::getLanguages();
        $default_language = (int) Configuration::get('PS_LANG_DEFAULT');
        $button_positions = array();
        //get default text values
        $button_positions['PAYPAL_POSITION_DEFAULT_BUTTON'] = array('title' => $this->module->i18n['default_button']) + $this->getPaypalButtonLabels('PAYPAL_POSITION_DEFAULT_BUTTON');
        $button_positions['PAYPAL_POSITION_PRODUCT_PAGE'] = array('title' => $this->module->i18n['product_page']) + $this->getPaypalButtonLabels('PAYPAL_POSITION_PRODUCT_PAGE');
        if ($this->module->isPrestashop16()) {
            $button_positions['PAYPAL_POSITION_ADDING_TO_CART'] = array('title' => $this->module->i18n['popup_shown_after_adding_to_basket']) + $this->getPaypalButtonLabels('PAYPAL_POSITION_ADDING_TO_CART');
        }
        $button_positions['PAYPAL_POSITION_SHOPPING_CART'] = array('title' => $this->module->i18n['shopping_cart_summary_page']) + $this->getPaypalButtonLabels('PAYPAL_POSITION_SHOPPING_CART');
        $button_positions['PAYPAL_POSITION_SP_CART_FOOTER'] = array('title' => $this->module->i18n['shopping_cart_summary_footer']) + $this->getPaypalButtonLabels('PAYPAL_POSITION_SP_CART_FOOTER');
        if (!$this->module->isPrestashop17()) {
            $button_positions['PAYPAL_POSITION_BLOCK_CART'] = array('title' => $this->module->i18n['block_cart_at_header']) + $this->getPaypalButtonLabels('PAYPAL_POSITION_BLOCK_CART');
            $button_positions['PAYPAL_POSITION_CHECKOUT_PAGE'] = array('title' => $this->module->i18n['along_with_proceed_to_checkout_button']) + $this->getPaypalButtonLabels('PAYPAL_POSITION_CHECKOUT_PAGE');
            $button_positions['PAYPAL_POSITION_LIST_PAGE'] = array('title' => $this->module->i18n['list_pages']) + $this->getPaypalButtonLabels('PAYPAL_POSITION_LIST_PAGE');
        }
        $button_positions['PAYPAL_POSITION_PAYMENT'] = array('title' => $this->module->i18n['payment_page_step']) + $this->getPaypalButtonLabels('PAYPAL_POSITION_PAYMENT');
        $button_position_values = array();
        // get configuration key
        foreach (array_keys($this->module->configuration_keys) as $config_key) {
            $button_position_values[$config_key] = Configuration::get($config_key);
        }
        $path_img = $this->module->getImgPath();
        if ($this->module->isPrestashop17()) {
            $path_img = $path_img.'17/';
        }
        return array(
            'button_positions' => $button_positions,
            'placeholder' => $this->module->i18n['enter_a_custom_text_or_leave_empty'],
            'languages' => $languages,
            'default_lang' => $default_language,
            'button_position_values' => $button_position_values,
            'path_img' => $path_img,
            'postAction' => $this->getConfigurationLink(),
            'delete_title' => $this->module->i18n['delete_this_button'],
        );
    }
    
    /**
     * Create a configuration Link.
     *
     * @return string
     */
    protected function getConfigurationLink()
    {
        return $this->context->link->getAdminLink($this->module->pic_tabs['AdminPayPalInstantCheckoutPreferences']['tab_class']);
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
    protected function getPaypalButtonLabels($position_key)
    {
        $languages = Language::getLanguages();
        $default_language = (int) Configuration::get('PS_LANG_DEFAULT');
        $configuration_key = str_replace('POSITION', 'TEXT', $position_key);
        $image_key = str_replace('POSITION', 'IMAGE', $position_key);
        $image_text = array();
        $image_link = array();
        $existing_button_images = scandir($this->module->upload_path);
        foreach ($languages as $language) {
            foreach ($existing_button_images as $existing_image) {
                foreach ($this->module->extensions_list as $image_type) {
                    if ($image_key . '_' . $language['id_lang'] . $image_type == $existing_image) {
                        $image_text[$language['id_lang']] = $this->module->i18n['upload_another_button'];
                        $image_link[$language['id_lang']] = '../img/pic/' . $image_key . '_' . $language['id_lang'] . $image_type;
                    }
                }
            }
            if (empty($image_text[$language['id_lang']])) {
                $image_text[$language['id_lang']] = $this->module->i18n['upload_your_own_button'];
            }
        }

        return array(
            'name' => $configuration_key,
            'flag' => $this->module->displayFlags($languages, $default_language, $configuration_key . '¤img', $configuration_key, true),
            'labels' => Configuration::getInt($configuration_key),
            'image_name' => $image_key,
            'image_link' => $image_link,
            'image_text' => $image_text,
        );
    }
    protected function generateAdvancedConfigFields()
    {
        $customer = new Customer((int) Configuration::get('PAYPAL_DUMMY_CUSTOMER'));
        return array(
            'PAYPAL_DEFAULT_CARRIER' => array(
                'title' => $this->module->i18n['default_carrier'],
                'type' => 'paypal_default_carrier',
                'list_carriers' => $this->getCarriers(),
                'default_carrier' => (int) Configuration::get('PAYPAL_DEFAULT_CARRIER'),
                'identifier' => 'value',
                'view_carrier_url' => $this->context->link->getAdminLink('AdminCarrierWizard').'&id_carrier='
            ),
            'PAYPAL_DEFAULT_CUSTOMER' => array(
                'title' => $this->module->i18n['default_customer'],
                'type' => 'paypal_default_customer',
                'customer' => $customer,
                'view_default_customer_url' => $this->context->link->getAdminLink('AdminCustomers').'&viewcustomer&id_customer='.$customer->id
            ),
            'PAYPAL_DEFAULT_ADDRESS' => array(
                'title' => $this->module->i18n['default_address'],
                'type' => 'paypal_default_address',
                'list_addresses' => $customer->getAddresses((int) $this->context->language->id),
                'default_address' => (int) Configuration::get('PAYPAL_DEFAULT_ADDRESS'),
                'view_default_address_url' => $this->context->link->getAdminLink('AdminAddresses').'&updateaddress&id_address='
            ),
            'PAYPAL_GUEST_AS_CUSTOMER' => array(
                    'title' => $this->module->i18n['customer_account'],
                    'validation' => 'isBool',
                    'type' => 'bool',
                    'desc' => $this->module->i18n['any_order_requires_an_associated_guest_account_or_customer_account']
            ),
            'PAYPAL_CONFIRM_ADDRESS' => array(
                'title' => $this->module->i18n['address_confirmation'],
                'validation' => 'isBool',
                'type' => 'bool',
                'class' => 'confirm-address',
            ),
            'PAYPAL_POSTCODE_FORM' => array(
                'title' => $this->module->i18n['display_postcode_form'],
                'validation' => 'isBool',
                'type' => 'bool',
            ),
            'PAYPAL_COMMUNICATION_METHOD' => array(
                'title' => $this->module->i18n['communication_method'],
                'type' => 'select',
                'list' => $this->getPayPalCommunicationMethod(),
                'identifier' => 'value',
                'desc' => $this->module->i18n['a_preferred_communication_method_between_paypal_and_shop']
            ),
            'PAYPAL_CONVERT_CURRENCY' => array(
                    'title' => $this->module->i18n['convert_currency'],
                    'validation' => 'isBool',
                    'type' => 'bool',
                    'desc' => $this->module->i18n['if_a_currency_is_not_supported_by_paypal_let_convert_to_a_supported_one']
            ),
        );
    }
    
    /**
     *
     * @return array
     */
    protected function getPayPalCommunicationMethod()
    {
        return array(
            array(
                'value' => 'PDT',
                'name' => $this->module->i18n['server_to_client']
            ),
            array(
                'value' => 'IPN',
                'name' => $this->module->i18n['server_to_server']
            ),
        );
    }

    /**
     * Update field paypal mode
     */
    public function updateOptionPaypalMode()
    {
        $value = (int)Tools::getValue('PAYPAL_MODE', 0);
        Configuration::updateValue('PAYPAL_MODE', $value);
        $this->fields_options['paypal_account']['fields']['PAYPAL_MODE']['value'] = $value;
    }
    
    /**
     * Update field paypal mode
     */
    public function updateOptionPaypalButtons()
    {
        $languages = Language::getLanguages();
        $success = array();
        // update configuration key
        foreach ($this->module->position_configuration_keys as $config_name => $config_validate) {
            $config_validate = $config_validate;
            if (Validate::$config_validate(Tools::getValue($config_name))) {
                Configuration::updateValue($config_name, Tools::getValue($config_name, 0));
            }
        }

        //update text configuration key values custom text fields
        foreach (array_keys($this->module->text_configuration_keys) as $text_key) {
            $text_values = array();
            foreach ($languages as $language) {
                $text_values[$language['id_lang']] = htmlspecialchars(Tools::getValue($text_key . '_' . $language['id_lang'], ''), ENT_QUOTES);
            }
            $success[] = Configuration::updateValue($text_key, $text_values);
        }

        $success[] = $this->uploadPaypalImageButton();

        if (array_sum($success) == count($success)) {
            $this->module->displayConfirmation($this->module->i18n['settings_updated']);
        } elseif (!$success) {
            $this->module->displayError($this->module->i18n['error']);
        }
    }
    
    /**
     * Upload images for paypal buttons.
     *
     * @return bool
     */
    protected function uploadPaypalImageButton()
    {
        $languages = Language::getLanguages();
        $success = true;
        foreach (array_keys($this->module->image_configuration_keys) as $image_key) {
            foreach ($languages as $language) {
                if (!empty($_FILES[$image_key . '_' . $language['id_lang']]['tmp_name'])) {
                    $image = $_FILES[$image_key . '_' . $language['id_lang']];
                    if (is_array($image) && (ImageManager::validateUpload($image, $this->module->max_image_size) === false)) {
                        $this->deleteExistingButtonImages($image_key . '_' . $language['id_lang']);
                        $pathinfo = pathinfo($image['name']);
                        $img_name = $this->module->upload_path . $image_key . '_' . $language['id_lang'] . '.' . $pathinfo['extension'];
                        if (move_uploaded_file($image['tmp_name'], $img_name)) {
                            $success = true;
                        } else {
                            $success = false;
                            break 2;
                        }
                    }
                }
            }
        }
        return $success;
    }
    
    /**
     * Delete exists image when add new image for Paypal Button.
     *
     * @param $image string name of image
     */
    protected function deleteExistingButtonImages($image)
    {
        if (file_exists($this->module->upload_path)) {
            $old_button_images = scandir($this->module->upload_path);
            foreach ($old_button_images as $old_button_image) {
                foreach ($this->module->extensions_list as $extension) {
                    $file_name = $image . $extension;
                    if ($image != '' && $file_name == $old_button_image) {
                        unlink($this->module->upload_path . $file_name);
                    }
                }
            }
        }
    }
    
    /**
     * Update field default carrier
     */
    public function updateOptionPaypalDefaultCarrier()
    {
        $default_carrier = (int)Tools::getValue('PAYPAL_DEFAULT_CARRIER', 0);
        Configuration::updateValue('PAYPAL_DEFAULT_CARRIER', $default_carrier);
        $this->fields_options['advanced']['fields']['PAYPAL_DEFAULT_CARRIER']['default_carrier'] = $default_carrier;
    }
    
    /**
     * Update field default address
     */
    public function updateOptionPaypalDefaultAddress()
    {
        $default_address = (int)Tools::getValue('PAYPAL_DEFAULT_ADDRESS', 0);
        Configuration::updateValue('PAYPAL_DEFAULT_ADDRESS', $default_address);
        $this->fields_options['advanced']['fields']['PAYPAL_DEFAULT_ADDRESS']['default_address'] = $default_address;
    }

    /**
     * Set Media file include when controller called.
     */
    public function setMedia()
    {
        if ($this->module->isPrestashop16()) {
            $this->module_media_css['preferencespage_16.css'] = 'all';
        } else {
            $this->module_media_css['preferencespage_15.css'] = 'all';
        }
        parent::setMedia();
        if (!empty($this->jquery_plugins)) {
            $this->addJqueryPlugin($this->jquery_plugins);
        }
        if (!empty($this->jquery_ui_components)) {
            $this->addJqueryUI($this->jquery_ui_components);
        }
        
        $js_files = $css_files = array();
        // Js files
        if (!empty($this->module_media_js) && is_array($this->module_media_js)) {
            foreach ($this->module_media_js as $js_file) {
                $js_files[] = (Validate::isAbsoluteUrl($js_file) ? '' : $this->module->getJsPath()) . $js_file;
            }
            $this->addJS($js_files);
        }
        // Css files
        if (!empty($this->module_media_css) && is_array($this->module_media_css)) {
            foreach ($this->module_media_css as $css_file => $media_type) {
                $css_files[(Validate::isAbsoluteUrl($css_file) ? '' : $this->module->getCssPath()) . $css_file] = $media_type;
            }
            $this->addCSS($css_files);
        }
    }
}
