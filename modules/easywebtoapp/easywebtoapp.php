<?php
/**
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2015 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Easywebtoapp extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'easywebtoapp';
        $this->tab = 'mobile';
        $this->version = '1.0.2';
        $this->author = 'AppNotch';
        $this->need_instance = 0;
        $this->module_key = '370270a7c0b0c6552118bad4ca092b1c';
        $this->ps_versions_compliancy = array('min' => '1.3', 'max' => _PS_VERSION_);

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Easy Web to App');
        $this->description =
        $this->
        l('Convert Your PrestaShop Web Store into Android & Apple iOS Native App with powerful AppNotch features.');

        $this->confirmUninstall = $this->l('');
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        Configuration::updateValue('EASYWEBTOAPP_LIVE_MODE', false);

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader');
    }

    public function uninstall()
    {
        Configuration::deleteByName('EASYWEBTOAPP_LIVE_MODE');

        return parent::uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submitEasywebtoappModule')) == true) {
            $this->postProcess();
        }
        
        $email=Configuration::get('EASYWEBTOAPP_ACCOUNT_EMAIL', '');
        $url=Configuration::get('EASYWEBTOAPP_ACCOUNT_URL', '');
        $app_baseurl='http://app.appnotch.com/partner/prestashop/home/';
        $app_url=rawurlencode($app_baseurl.'?email='.$email.'&url='.$url.'&appname=My PrestaShop');
        $tpl_array=array('app_url' => $app_url,
                'email' => $email,
                'url' => $url);
        $this->context->smarty->assign($tpl_array, $this->_path);

        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');

        return $output.$this->renderForm();
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitEasywebtoappModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ),
                
                'input' => array(
                        'col' => 4,
                        'type' => 'text',
                        'desc' => $this->l('Enter your store url'),
                        'label' => $this->l('Url'),
                ),
                'input' => array(
                    array(
                        'col' => 4,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-envelope"></i>',
                        'desc' => $this->l('Your email address'),
                        'name' => 'EASYWEBTOAPP_ACCOUNT_EMAIL',
                        'label' => $this->l('Email'),
                        'readonly'=>'readonly',
                    ),
                    array(
                        'col' => 4,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-link"></i>',
                        'desc' => $this->l('Your store url'),
                        'name' => 'EASYWEBTOAPP_ACCOUNT_URL',
                        'label' => $this->l('Url'),
                        'readonly'=>'readonly',
                    ),
                    ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        $admin_email=$this->context->employee->email;
        $app_url=$this->context->link->getPageLink('index', true);
        if (Configuration::get('EASYWEBTOAPP_ACCOUNT_EMAIL', '')!='') {
            $admin_email=Configuration::get('EASYWEBTOAPP_ACCOUNT_EMAIL', '');
        }
        if (Configuration::get('EASYWEBTOAPP_ACCOUNT_URL', '')!='') {
            $app_url=Configuration::get('EASYWEBTOAPP_ACCOUNT_URL', '');
        }
        return array(
            'EASYWEBTOAPP_LIVE_MODE' => Configuration::get('EASYWEBTOAPP_LIVE_MODE', true),
            'EASYWEBTOAPP_ACCOUNT_EMAIL' =>$admin_email,
            'EASYWEBTOAPP_ACCOUNT_URL' => $app_url,
        );
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }
}
