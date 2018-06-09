{*
* Paypal instant checkout for PrestaShop
*
* @author    PrestaMonster
* @copyright PrestaMonster
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

<div class="pp-checkout-btn">
    {if !empty($button_images[$alt_image])}
        <a class="hs_paypal_img_btn page_check_out {$paypal_class_css}" href="{$paypal_action nofilter}" >
            <img src="{$img_ps_dir nofilter}{$button_images[$alt_image]}" title="{if !empty($paypal_tilte[$alt_title])}{$paypal_tilte[$alt_title] nofilter}{elseif !empty($paypal_tilte['PAYPAL_TEXT_DEFAULT_BUTTON'])}{$paypal_tilte['PAYPAL_TEXT_DEFAULT_BUTTON'] nofilter}{/if}" />
        </a>
    {else}
        <a class="hs_paypal_btn page_check_out {$paypal_class_css}" alt="{if !empty($paypal_tilte[$alt_title])}{$paypal_tilte[$alt_title]}{else}{$paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"]}{/if}" href="{$paypal_action nofilter}" >
            {if !empty($paypal_tilte[$alt_title])}{$paypal_tilte[$alt_title]|escape:'html':'UTF-8'}{elseif !empty($paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"])}{$paypal_tilte["PAYPAL_TEXT_DEFAULT_BUTTON"] nofilter}{else}{$text_translation_of_button_paypal nofilter}{/if}
        </a>
    {/if}
</div>
<div style="clear:both"></div>

