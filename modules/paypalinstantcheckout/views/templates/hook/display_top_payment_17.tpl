{*
* Paypal instant checkout for PrestaShop
*
* @author    PrestaMonster
* @copyright PrestaMonster
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

<div class="row">
    <div class="col-xs-12 col-md-12">
        <p class="payment_module">
            {if !empty($button_images[$alt_image])}
                <a href="{$link->getModuleLink('paypalinstantcheckout', 'form') nofilter}" >
                    <img src="{$img_ps_dir nofilter}{$button_images[$alt_image] nofilter}" title="{if !empty($paypal_tilte[$alt_title])}{$paypal_tilte[$alt_title]|escape:'html':'UTF-8'}{elseif !empty($paypal_tilte['PAYPAL_TEXT_DEFAULT_BUTTON'])}{$paypal_tilte['PAYPAL_TEXT_DEFAULT_BUTTON'] nofilter}{/if}" />
                </a>
            {else}
                <a href="{$link->getModuleLink('paypalinstantcheckout', 'form') nofilter}" title="{if !empty($paypal_tilte[$alt_title])}{$paypal_tilte[$alt_title] nofilter}{elseif !empty($paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"])}{$paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"] nofilter}{else}{$hs_translation.pay_instantly_with_paypal nofilter}{/if}">
                    <img src="{$img_paypal_path}paypal.png">
                    {if !empty($paypal_tilte[$alt_title])}{$paypal_tilte[$alt_title] nofilter}{elseif !empty($paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"])}{$paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"] nofilter}{else}{$text_translation_of_button_paypal nofilter} {$a_surcharge_of_will_be_added nofilter}{/if}
                </a>
            {/if}
        </p>
    </div>
</div>