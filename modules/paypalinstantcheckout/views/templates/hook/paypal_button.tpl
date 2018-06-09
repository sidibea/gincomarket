{*
* Paypal instant checkout for PrestaShop
*
* @author    PrestaMonster
* @copyright PrestaMonster
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

<div class="pp-checkout-btn">
    {if !empty($button_images[$alt_image])}
        <a class="hs_paypal_img_btn page_check_out {$paypal_class_css|escape:'html':'UTF-8'}" href="{$paypal_action|escape:'quotes':'UTF-8'}" >
            <img src="{$img_ps_dir|escape:'quotes':'UTF-8'}{$button_images[$alt_image]|escape:'html':'UTF-8'}" title="{if !empty($paypal_tilte[$alt_title])}{$paypal_tilte[$alt_title]|escape:'html':'UTF-8'}{elseif !empty($paypal_tilte['PAYPAL_TEXT_DEFAULT_BUTTON'])}{$paypal_tilte['PAYPAL_TEXT_DEFAULT_BUTTON']|escape:'html':'UTF-8'}{/if}" />
        </a>
    {else}
        <a class="hs_paypal_btn page_check_out {$paypal_class_css|escape:'html':'UTF-8'}" alt="{if !empty($paypal_tilte[$alt_title])}{$paypal_tilte[$alt_title]|escape:'html':'UTF-8'}{else}{$paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"]|escape:'html':'UTF-8'}{/if}" href="{$paypal_action|escape:'quotes':'UTF-8'}" >
            {if !empty($paypal_tilte[$alt_title])}{$paypal_tilte[$alt_title]|escape:'html':'UTF-8'}{elseif !empty($paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"])}{$paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"]|escape:'html':'UTF-8'}{else}{$text_translation_of_button_paypal|escape:'quotes':'UTF-8'}{/if}
        </a>
    {/if}
</div>
<div style="clear:both"></div>

