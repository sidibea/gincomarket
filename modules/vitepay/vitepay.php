<?php
/**
 * validation.php
 *
 * Copyright (c) 2011 VitePay (Pty) Ltd
 *
 * LICENSE:
 *
 * This payment module is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published
 * by the Free Software Foundation; either version 3 of the License, or (at
 * your option) any later version.
 *
 * This payment module is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser General Public
 * License for more details.
 *
 * @author    Cheick Tall<cheick.tall@vitepay.com>
 * @version    1.0
 * @date       07/07/2015
 *
 * @copyright 2015 VitePay (Pty) Ltd
 * @license   http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link       http://www.vitepay.com
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class VitePay extends PaymentModule
{
    const LEFT_COLUMN = 0;
    const RIGHT_COLUMN = 1;
    const FOOTER = 2;
    const DISABLE = -1;
    #const SANDBOX_MERCHANT_KEY = '46f0cd694581a';
    #const SANDBOX_MERCHANT_ID = '10000100';

    public function __construct()
    {
        $this->name = 'vitepay';
        $this->tab = 'payments_gateways';
        $this->version = '1.0.0';
        $this->currencies = true;
        $this->currencies_mode = 'radio';
        $this->module_key = "fbc406a3a3b4bffe580a5922cde8c1ce";

        parent::__construct();

        $this->author = 'VitePay';
        $this->page = basename(__FILE__, '.php');

        $this->displayName = $this->l('VitePay');
        $this->description = $this->l('Acceptez les paiements Orange Money de manière rapide et sécurisée.');
        $this->confirmUninstall = $this->l('Souhaitez-vous supprimer vos informations de connexion ?');
        // Retrocompatibility
        $this->initContext();


        /* For 1.4.3 and less compatibility */
        $updateConfig = array(
            'PS_OS_CHEQUE' => 1,
            'PS_OS_PAYMENT' => 2,
            'PS_OS_PREPARATION' => 3,
            'PS_OS_SHIPPING' => 4,
            'PS_OS_DELIVERED' => 5,
            'PS_OS_CANCELED' => 6,
            'PS_OS_REFUND' => 7,
            'PS_OS_ERROR' => 8,
            'PS_OS_OUTOFSTOCK' => 9,
            'PS_OS_BANKWIRE' => 10,
            'PS_OS_PAYPAL' => 11,
            'PS_OS_WS_PAYMENT' => 12
        );
        foreach ($updateConfig as $u => $v) {
            if (!Configuration::get($u) || (int)Configuration::get($u) < 1) {
                if (defined('_' . $u . '_') && (int)constant('_' . $u . '_') > 0) {
                    Configuration::updateValue($u, constant('_' . $u . '_'));
                } else {
                    Configuration::updateValue($u, $v);
                }
            }
        }

    }

    private function initContext()
    {
        if (class_exists('Context')) {
            $this->context = Context::getContext();
        } else {
            global $smarty, $cookie;
            $this->context = new StdClass();
            $this->context->smarty = $smarty;
            $this->context->cookie = $cookie;
        }
    }

    public function install()
    {
        unlink(dirname(__FILE__) . '/../../cache/class_index.php');
        if (!parent::install()
            or !$this->registerHook('payment')
            or !$this->registerHook('paymentReturn')
            or !Configuration::updateValue('VITEPAY_API_ID', '')
            or !Configuration::updateValue('VITEPAY_API_KEY', '')
            or !Configuration::updateValue('VITEPAY_LOGS', '1')
            or !Configuration::updateValue('VITEPAY_MODE', 'test')
            or !Configuration::updateValue('VITEPAY_PAYNOW_TEXT', 'Pay Now With')
            or !Configuration::updateValue('VITEPAY_PAYNOW_LOGO', 'on')
            or !Configuration::updateValue('VITEPAY_PAYNOW_ALIGN', 'right')
            or !Configuration::updateValue('VITEPAY_API_SIGNATURE', '')
            or !Configuration::updateValue('VITEPAY_LOCALE', 'Fr')
            or !Configuration::updateValue('VITEPAY_CURRENCY', 'XOF')
            or !Configuration::updateValue('VITEPAY_COUNTRY', 'ML')
        ) {
            return false;
        }


        return true;
    }

    // Retrocompatibility 1.4/1.5

    public function uninstall()
    {
        unlink(dirname(__FILE__) . '/../../cache/class_index.php');
        return (parent::uninstall()
            and Configuration::deleteByName('VITEPAY_API_ID')
            and Configuration::deleteByName('VITEPAY_API_KEY')
            and Configuration::deleteByName('VITEPAY_MODE')
            and Configuration::deleteByName('VITEPAY_LOGS')
            and Configuration::deleteByName('VITEPAY_PAYNOW_TEXT')
            and Configuration::deleteByName('VITEPAY_PAYNOW_LOGO')
            and Configuration::deleteByName('VITEPAY_PAYNOW_ALIGN')
            and Configuration::deleteByName('VITEPAY_API_SIGNATURE')
            and Configuration::deleteByName('VITEPAY_LOCALE', 'Fr')
            and Configuration::deleteByName('VITEPAY_CURRENCY', 'XOF')
            and Configuration::deleteByName('VITEPAY_COUNTRY', 'ML')
        );

    }

    public function getContent()
    {
        //global $cookie;
        $errors = array();
        $html = '<div style="width:550px">
            <p style="text-align:center;"><a href="https://www.vitepay.com" target="_blank"><img src="' . __PS_BASE_URI__ . 'modules/vitepay/views/img/secure_logo.png" alt="VitePay" boreder="0" /></a></p><br />';


        /* Update configuration variables */
        if (Tools::isSubmit('submitVitepay')) {
            if ($paynow_text = Tools::getValue('vitepay_paynow_text')) {
                Configuration::updateValue('VITEPAY_PAYNOW_TEXT', $paynow_text);
            }

            if ($paynow_logo = Tools::getValue('vitepay_paynow_logo')) {
                Configuration::updateValue('VITEPAY_PAYNOW_LOGO', $paynow_logo);
            }
            if ($paynow_align = Tools::getValue('vitepay_paynow_align')) {
                Configuration::updateValue('VITEPAY_PAYNOW_ALIGN', $paynow_align);
            }
            #if ($passPhrase = Tools::getValue('vitepay_api_signature')) {
            #    Configuration::updateValue('VITEPAY_API_SIGNATURE', $passPhrase);
            #}
            if ($passPhrase = Tools::getValue('vitepay_locale')) {
                Configuration::updateValue('VITEPAY_LOCALE', $passPhrase);
            }
            if ($passPhrase = Tools::getValue('vitepay_country')) {
                Configuration::updateValue('VITEPAY_COUNTRY', $passPhrase);
            }
            if ($passPhrase = Tools::getValue('vitepay_currency')) {
                Configuration::updateValue('VITEPAY_CURRENCY', $passPhrase);
            }

            $mode = (Tools::getValue('vitepay_mode') == 'live' ? 'live' : 'test');
            Configuration::updateValue('VITEPAY_MODE', $mode);
            //if( $mode != 'test' )
            //{
            if (($api_id = Tools::getValue('vitepay_api_id')) and preg_match('/[a-zA-Z0-9]/', $api_id)) {
                Configuration::updateValue('VITEPAY_API_ID', $api_id);
            } else {
                $errors[] = '<div class="warning warn"><h3>' . $this->l('API ID seems to be wrong') . '</h3></div>';
            }

            if (($api_key = Tools::getValue('vitepay_api_key')) and preg_match('/[a-zA-Z0-9]/', $api_key)) {
                Configuration::updateValue('VITEPAY_API_KEY', $api_key);
            } else {
                $errors[] = '<div class="warning warn"><h3>' . $this->l('API key seems to be wrong') . '</h3></div>';
            }

            if (!sizeof($errors)) {
                //Tools::redirectAdmin(
                //$currentIndex.'&configure=vitepay&token='.Tools::getValue( 'token' ) .'&conf=4'
                //);
            }

            //}
            if (Tools::getValue('vitepay_logs')) {
                Configuration::updateValue('VITEPAY_LOGS', 1);
            } else {
                Configuration::updateValue('VITEPAY_LOGS', 0);
            }
            foreach (array('displayLeftColumn', 'displayRightColumn', 'displayFooter') as $hookName) {
                if ($this->isRegisteredInHook($hookName)) {
                    $this->unregisterHook($hookName);
                }
            }
            if (Tools::getValue('logo_position') == self::LEFT_COLUMN) {
                $this->registerHook('displayLeftColumn');
            } elseif (Tools::getValue('logo_position') == self::RIGHT_COLUMN) {
                $this->registerHook('displayRightColumn');
            } elseif (Tools::getValue('logo_position') == self::FOOTER) {
                $this->registerHook('displayFooter');
            }
            if (method_exists('Tools', 'clearSmartyCache')) {
                Tools::clearSmartyCache();
            }

        }


        /* Display errors */
        if (sizeof($errors)) {
            $html .= '<ul style="color: red; font-weight: bold; margin-bottom: 30px; width: 506px; background: #FFDFDF; border: 1px dashed #BBB; padding: 10px;">';
            foreach ($errors as $error) {
                $html .= '<li>' . $error . '</li>';
            }
            $html .= '</ul>';
        }


        $blockPositionList = array(
            self::DISABLE => $this->l('Disable'),
            self::LEFT_COLUMN => $this->l('Left Column'),
            self::RIGHT_COLUMN => $this->l('Right Column'),
            self::FOOTER => $this->l('Footer'));

        if ($this->isRegisteredInHook('displayLeftColumn')) {
            $currentLogoBlockPosition = self::LEFT_COLUMN;
        } elseif ($this->isRegisteredInHook('displayRightColumn')) {
            $currentLogoBlockPosition = self::RIGHT_COLUMN;
        } elseif ($this->isRegisteredInHook('displayFooter')) {
            $currentLogoBlockPosition = self::FOOTER;
        } else {
            $currentLogoBlockPosition = -1;
        }


        /* Display settings form */
        $html .= '
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
          <fieldset>
          <legend><img src="' . __PS_BASE_URI__ . 'modules/vitepay/views/img/logo.gif" />' . $this->l('Settings') . '</legend>
            <p>' . $this->l('Utiliser le mode test pour tester le service et le mode live quand vous etes pret a commencer. Rappelez-vous de configurer API_key, API_secret et API_signature pour le mode live.') . '</p>
            <label>
              ' . $this->l('Mode') . '
            </label>
            <div class="margin-form" style="width:110px;">
              <select name="vitepay_mode">
                <option value="live"' . (Configuration::get('VITEPAY_MODE') == 'live' ? ' selected="selected"' : '') . '>' . $this->l('Live') . '&nbsp;&nbsp;</option>
                <option value="test"' . (Configuration::get('VITEPAY_MODE') == 'test' ? ' selected="selected"' : '') . '>' . $this->l('Test') . '&nbsp;&nbsp;</option>
              </select>
            </div>
            <p>' . $this->l('Vous trouverez vos informations d accès sur votre compte Vitepay https://store.vitepay.com/merchants.') . '</p>
            <label>
              ' . $this->l('API Key') . '
            </label>
            <div class="margin-form">
              <input type="text" name="vitepay_api_id" value="' . Tools::getValue('vitepay_api_id', Configuration::get('VITEPAY_API_ID')) . '" />
            </div>
            <label>
              ' . $this->l('API Secret') . '
            </label>
            <div class="margin-form">
              <input type="text" name="vitepay_api_key" value="' . trim(Tools::getValue('vitepay_api_key', Configuration::get('VITEPAY_API_KEY'))) . '" />
            </div>
            <p>' . $this->l('Indiquer le pays, la langue et la monnaie utilisés sur le site :') . '</p>' .
            '<label>
              ' . $this->l('Langue (Fr pour le français)') . '
            </label>
            <div class="margin-form">
              <input type="text" name="vitepay_locale" value="' . trim(Tools::getValue('vitepay_locale', Configuration::get('VITEPAY_LOCALE'))) . '" />
            </div>
            <label>
              ' . $this->l('Pays (ML pour la Mali)') . '
            </label>
            <div class="margin-form">
              <input type="text" name="vitepay_country" value="' . trim(Tools::getValue('vitepay_country', Configuration::get('VITEPAY_COUNTRY'))) . '" />
            </div>
            <label>
              ' . $this->l('Devise (XOF pour le CFA)') . '
            </label>
            <div class="margin-form">
              <input type="text" name="vitepay_currency" value="' . trim(Tools::getValue('vitepay_currency', Configuration::get('VITEPAY_CURRENCY'))) . '" />
            </div>
            <p>' . $this->l('Emplacement du fichier de LOG pour les transactions : ') . ' ' . __PS_BASE_URI__ . 'modules/vitepay/vitepay.log. ' . $this->l('Si il est activé rappellez vous de le sécuriser grace a un fichier .htaccess dans le meme repertoire. Si non tout le monde pourra y accedder.') . '</p>
            <label>
              ' . $this->l('Debug') . '
            </label>
            <div class="margin-form" style="margin-top:5px">
              <input type="checkbox" name="vitepay_logs"' . (Tools::getValue('vitepay_logs', Configuration::get('VITEPAY_LOGS')) ? ' checked="checked"' : '') . ' />
            </div>
            <p>' . $this->l('Au moment de payer le client verra les configurations suivantes :') . '</p>
            <label>&nbsp;</label>
            <div class="margin-form" style="margin-top:5px">
                ' . Configuration::get('VITEPAY_PAYNOW_TEXT');

        if (Configuration::get('VITEPAY_PAYNOW_LOGO') == 'on') {
            $html .= '<img align="' . Configuration::get('VITEPAY_PAYNOW_ALIGN') . '" alt="Payez avec VitePay" title="Payez avec VitePay" src="' . __PS_BASE_URI__ . 'modules/vitepay/views/img/vitepay.png">';
        }
        $html .= '</div>
            <label>
            ' . $this->l('PayNow Text') . '
            </label>
            <div class="margin-form" style="margin-top:5px">
                <input type="text" name="vitepay_paynow_text" value="' . Configuration::get('VITEPAY_PAYNOW_TEXT') . '">
            </div>
            <label>
            ' . $this->l('PayNow Logo') . '
            </label>
            <div class="margin-form" style="margin-top:5px">
                <input type="radio" name="vitepay_paynow_logo" value="off" ' . (Configuration::get('VITEPAY_PAYNOW_LOGO') == 'off' ? ' checked="checked"' : '') . '"> &nbsp; ' . $this->l('None') . '<br>
                <input type="radio" name="vitepay_paynow_logo" value="on" ' . (Configuration::get('VITEPAY_PAYNOW_LOGO') == 'on' ? ' checked="checked"' : '') . '"> &nbsp; <img src="' . __PS_BASE_URI__ . 'modules/vitepay/views/img/vitepay.png">
            </div>
            <label>
            ' . $this->l('PayNow Logo Align') . '
            </label>
            <div class="margin-form" style="margin-top:5px">
                <input type="radio" name="vitepay_paynow_align" value="left" ' . (Configuration::get('VITEPAY_PAYNOW_ALIGN') == 'left' ? ' checked="checked"' : '') . '"> &nbsp; ' . $this->l('Left') . '<br>
                <input type="radio" name="vitepay_paynow_align" value="right" ' . (Configuration::get('VITEPAY_PAYNOW_ALIGN') == 'right' ? ' checked="checked"' : '') . '"> &nbsp; ' . $this->l('Right') . '
            </div>
            <p>' . $this->l('Ou souhaitez-vous voir le Logo de paiement sécurisé Orange_Money sur votre site?') . '</p>
            <label>
            ' . $this->l('Choisissez la position du logo :') . '
            <label>
            <div class="margin-form" style="margin-bottom:18px;width:110px;">
                  <select name="logo_position">';
        foreach ($blockPositionList as $position => $translation) {
            $selected = ($currentLogoBlockPosition == $position) ? 'selected="selected"' : '';
            $html .= '<option value="' . $position . '" ' . $selected . '>' . $translation . '</option>';
        }
        $html .= '</select></div>

            <div style="float:right;"><input type="submit" name="submitVitepay" class="button" value="' . $this->l('   Save   ') . '" /></div><div class="clear"></div>
          </fieldset>
        </form>
        <br /><br />
        <fieldset>
          <legend><img src="../img/admin/warning.gif" />' . $this->l('Information') . '</legend>
          <p>- ' . $this->l('Vous devez absolument configurer API_key, API_secret pour utiliser VITEPAY en mode production .') . '</p>
          <p>- ' . $this->l('Tout paiement envoyé a Vitepay sera au préalable convertie automatiquement en XOF(CFA) avant soumission. Veuillez utiliser le système de devise prestashop.') . '<p>
          <p>- ' . $this->l('Il est possible de definir une mise à jour automatique des taux de change en utilisant crontab. Vous devez simplement creer un cron job avec le lien "currency update" disponible en bas de "Currencies" section.') . '<p>
        </fieldset>
        </div>';

        return $html;
    }

    public function hookDisplayRightColumn($params)
    {
        return $this->_displayLogoBlock(self::RIGHT_COLUMN);
    }

    private function _displayLogoBlock($position)
    {
        return '<div style="text-align:center;"><a href="https://www.vitepay.com" target="_blank" title="Paiement sécurisé VitePay"><img src="' . __PS_BASE_URI__ . 'modules/vitepay/views/img/secure_logo.png" width="150" /></a></div>';
    }

    public function hookDisplayLeftColumn($params)
    {
        return $this->_displayLogoBlock(self::LEFT_COLUMN);
    }

    public function hookDisplayFooter($params)
    {
        $html = '<section id="vitepay_footer_link" class="footer-block col-xs-12 col-sm-2">        
        <div style="text-align:center;"><a href="https://www.vitepay.com" target="_blank" title="Paiement sécurisé VitePay"><img src="' . __PS_BASE_URI__ . 'modules/vitepay/views/img/secure_logo.png"  /></a></div>
        </section>';
        return $html;
    }

    public function hookPayment($params)
    {
        //global $cookie, $cart;

        if (!$this->active) {
            return;
        }

        // Buyer details
        $customer = new Customer((int)($this->context->cart->id_customer));

        $toCurrency = new Currency(Currency::getIdByIsoCode('XOF'));
        $fromCurrency = new Currency((int)$this->context->currency->id);

        //$cart = new Cart(Context::getContext()->cart->id);

        $total = $this->context->cart->getOrderTotal();

        $pfAmount = Tools::convertPriceFull($total, $fromCurrency, $toCurrency);

        $data = array();

        $currency = $this->getCurrency((int)$this->context->cart->id_currency);
        if ($this->context->cart->id_currency != $currency->id) {
            // If VitePay currency differs from local currency
            $this->context->cart->id_currency = (int)$currency->id;
            $this->context->currency->id = (int)$this->context->cart->id_currency;
            $this->context->cart->update();
        }

        $amout_100 = number_format(sprintf("%01.2f", $pfAmount), 2, '.', '') * 100;
        $currency_code = Configuration::get('VITEPAY_CURRENCY');
        $api_secret = Configuration::get('VITEPAY_API_KEY');
        $callback_url = Tools::getHttpHost(true) . __PS_BASE_URI__ . 'modules/vitepay/validation.php?vp_request=true';
        $upped = Tools::strtoupper($this->context->cart->id.";$amout_100;$currency_code;$callback_url;$api_secret");
        $hash = SHA1($upped);

        // Use appropriate merchant identifiers
        // Live
        if (Configuration::get('VITEPAY_MODE') == 'live') {
            $data['info']['api_key'] = Configuration::get('VITEPAY_API_ID');
            $data['info']['hash'] = $hash;
            $data['vitepay_url'] = 'https://api.vitepay.com/v1/prod/payments';
        } else {
            // Sandbox
            $data['info']['api_key'] = Configuration::get('VITEPAY_API_ID');
            $data['info']['hash'] = $hash;
            $data['vitepay_url'] = 'https://api.vitepay.com/v1/sandbox/payments';
            #$data['vitepay_url'] = 'http://postcatcher.in/catchers/559a6e4361acf303000012a8';
            #$data['vitepay_url'] = 'http://requestb.in/1ldtpvp1';
        }
        $data['vitepay_paynow_text'] = Configuration::get('VITEPAY_PAYNOW_TEXT');
        $data['vitepay_paynow_logo'] = Configuration::get('VITEPAY_PAYNOW_LOGO');
        $data['vitepay_paynow_align'] = Configuration::get('VITEPAY_PAYNOW_ALIGN');
        // Create URLs
        /*$data['info']['payment[return_url]'] = $this->context->link->getPageLink(
            'order-confirmation',
            null,
            null,
            'key=' . $this->context->cart->secure_key . '&id_cart=' .
            (int)($this->context->cart->id) . '&id_module=' . (int)($this->id)
        );*/
        $data['info']['payment[return_url]'] = Tools::getHttpHost(true) . __PS_BASE_URI__
            . "/index.php?controller=order-confirmation";
        $data['info']['payment[cancel_url]'] = Tools::getHttpHost(true) . __PS_BASE_URI__;
        $data['info']['payment[decline_url]'] = Tools::getHttpHost(true) . __PS_BASE_URI__
            . "/index.php?controller=order-confirmation";
        $data['info']['payment[callback_url]'] = $callback_url;

        $data['info']['payment[language_code]'] = Configuration::get('VITEPAY_LOCALE');
        $data['info']['payment[currency_code]'] = Configuration::get('VITEPAY_CURRENCY');
        $data['info']['payment[country_code]'] = Configuration::get('VITEPAY_COUNTRY');
        $data['info']['payment[order_id]'] = $this->context->cart->id;
        $data['info']['payment[amount_100]'] = number_format(sprintf("%01.2f", $pfAmount), 2, '.', '') * 100;
        $data['info']['payment[description]'] = Configuration::get(
                'PS_SHOP_NAME'
            ) . ' purchase, Cart Item ID #' . $this->context->cart->id;
        $data['info']['payment[buyer_ip_adress]'] = $_SERVER['REMOTE_ADDR'];
        $data['info']['payment[email]'] = $customer->email;
        $data['info']['payment[p_type]'] = "Orange_Money";
        $data['info']['redirect'] = "1";


        $pfOutput = '';
        // Create output string
        foreach (($data['info']) as $key => $val) {
            $pfOutput .= $key . '=' . urlencode(trim($val)) . '&';
        }
        $passPhrase = Configuration::get('VITEPAY_API_SIGNATURE');

        if (empty($passPhrase) || Configuration::get('VITEPAY_MODE') != 'live') {
            $pfOutput = Tools::substr($pfOutput, 0, -1);
        } else {
            $pfOutput = $pfOutput . "passphrase=" . urlencode($passPhrase);
        }

        $data['info']['signature'] = md5($pfOutput);

        $this->context->smarty->assign('data', $data);

        return $this->display(__FILE__, '/views/templates/front/vitepay.tpl');
    }

    public function hookPaymentReturn($params)
    {
        if (!$this->active) {
            return;
        }
        $test = __FILE__;

        return $this->display($test, 'vitepay_success.tpl');

    }
}
