{*
* Paypal instant checkout for PrestaShop
*
* @author    PrestaMonster
* @copyright PrestaMonster
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

{if !empty($js_include) && !empty($js_files)}
    {foreach from=$js_files item=js_uri}
        <script type="text/javascript" src="{$js_uri|escape:'html':'UTF-8'}"></script>
    {/foreach}
{/if}
<form  name="_xclick" action="{$paypal_url|escape:'html':'UTF-8'}" method="post">
    <input type="hidden" name="cmd" value="{$paypal_cmd|escape:'html':'UTF-8'}">
    <input type="hidden" name="business" value="{$paypal_account|escape:'html':'UTF-8'}">
    <input type="hidden" name="currency_code" value="{$paypal_currency|escape:'html':'UTF-8'}">
    {foreach from=$paypal_cart_products item=product key=k}
        {if ($paypal_cmd == '_cart')} {assign var=index value="_{$k+1|intval}"}  {else} {assign var=index value=""} {/if}
        <input type="hidden" name="item_name{$index|escape:'html':'UTF-8'}" value="{$product.name|escape:'htmlall':'UTF-8'}">
        <input type="hidden" name="item_number{$index|escape:'html':'UTF-8'}" value="{if $product.reference !=''}{$product.reference|escape:'html':'UTF-8'}{elseif $product.ean13 !=''}{$product.ean13|escape:'html':'UTF-8'} {elseif $product.upc !=''} {$product.upc|escape:'html':'UTF-8'}  {else}{$product.id_product|escape:'html':'UTF-8'}{/if}" />
        <input type="hidden" name="quantity{$index|escape:'html':'UTF-8'}" value="{$product.cart_quantity|escape:'html':'UTF-8'}" />
        <input type="hidden" name="amount{$index|escape:'html':'UTF-8'}" value="{$product.paypal_price|escape:'html':'UTF-8'}">
    {/foreach}
    <input type="hidden" name="return" value="{$paypal_return|escape:'html':'UTF-8'}">
    <input type="hidden" name="notify_url" value="{$paypal_notify|escape:'html':'UTF-8'}">
    <input type="hidden" name="custom" value="{$paypal_custom|escape:'html':'UTF-8'}">
    <input type="hidden" value="{$paypal_total_discounts|escape:'html':'UTF-8'}" name="discount_amount_cart" />
    <input type="hidden" name="{if ($paypal_cmd == '_cart')}tax_cart{else}tax{/if}" value="{$total_tax|escape:'html':'UTF-8'}" />
    {*add shipping_1 because if use shipping, the paypal can't understand for multiple items shipping*}
    <input type="hidden" name="{if ($paypal_cmd == '_cart')}shipping_1{else}shipping{/if}" value="{$paypal_shipping_cost|escape:'html':'UTF-8'}">
    <input type="hidden" name="upload" value="1">
    <input id="submit" type="submit" name="submit" style="display: none">
</form>
<script text="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#submit').click();
    });
</script>

