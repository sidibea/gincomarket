{*
* Paypal instant checkout for PrestaShop
*
* @author    PrestaMonster
* @copyright PrestaMonster
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

<div class="row">
    <div class="col-xs-12 {if !$is_prestashop_1611}col-md-6{/if}">
        <p class="payment_module">
            {if !empty($button_images[$alt_image])}
                <a href="{$link->getModuleLink('paypalinstantcheckout', 'form')|escape:'quotes':'UTF-8'}" >
                    <img src="{$img_ps_dir|escape:'quotes':'UTF-8'}{$button_images[$alt_image]|escape:'html':'UTF-8'}" title="{if !empty($paypal_tilte[$alt_title])}{$paypal_tilte[$alt_title]|escape:'html':'UTF-8'}{elseif !empty($paypal_tilte['PAYPAL_TEXT_DEFAULT_BUTTON'])}{$paypal_tilte['PAYPAL_TEXT_DEFAULT_BUTTON']|escape:'html':'UTF-8'}{/if}" />
                </a>
            {else}
                <a
                    class="paypal-instant-checkout"
                    href="{$link->getModuleLink('paypalinstantcheckout', 'form')|escape:'quotes':'UTF-8'}"
                    title="{if !empty($paypal_tilte[$alt_title])}{$paypal_tilte[$alt_title]|escape:'html':'UTF-8'}{elseif !empty($paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"])}{$paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"]|escape:'html':'UTF-8'}{else}{$hs_translation.pay_instantly_with_paypal|escape:'quotes':'UTF-8'}{/if}">
            {if !empty($paypal_tilte[$alt_title])}{$paypal_tilte[$alt_title]|escape:'html':'UTF-8'}{elseif !empty($paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"])}{$paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"]|escape:'html':'UTF-8'}{else}{$text_translation_of_button_paypal|escape:'quotes':'UTF-8'} {$a_surcharge_of_will_be_added|escape:'html':'UTF-8'}{/if}
        </a>
    {/if}
</p>
</div>
</div>