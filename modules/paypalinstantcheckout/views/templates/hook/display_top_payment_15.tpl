{*
* Paypal instant checkout for PrestaShop
*
* @author    PrestaMonster
* @copyright PrestaMonster
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

<p class="payment_module">
    <a  title="{$hs_translation.pay_instantly_with_paypal|escape:'html':'UTF-8'}" href="{$link->getModuleLink('paypalinstantcheckout', 'form')|escape:'quotes':'UTF-8'}">
        <img width="86" height="49" alt="{if !empty($paypal_tilte[$alt_title])}{$paypal_tilte[$alt_title]|escape:'html':'UTF-8'}{elseif !empty($paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"])}{$paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"]|escape:'html':'UTF-8'}{else}{$hs_translation.pay_instantly_with_paypal|escape:'html':'UTF-8'}{/if}" src="{$img_paypal_path|escape:'quotes':'UTF-8'}paypal.png">
{if !empty($paypal_tilte[$alt_title])}{$paypal_tilte[$alt_title]|escape:'html':'UTF-8'}{elseif !$paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"]}{$paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"]|escape:'html':'UTF-8'}{else}{$text_translation_of_button_paypal|escape:'quotes':'UTF-8'} {$a_surcharge_of_will_be_added|escape:'html':'UTF-8'}{/if}
</a>
</p>