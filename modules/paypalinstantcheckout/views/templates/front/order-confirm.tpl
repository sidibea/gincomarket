{*
* Paypal instant checkout for PrestaShop
*
* @author    PrestaMonster
* @copyright PrestaMonster
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

{capture name=path}{$hs_translation.order_confirmation|escape:'html':'UTF-8'}{/capture}
{include file="$tpl_dir./errors.tpl"}
<h1 class="page-heading">{$hs_translation.order_confirmation|escape:'html':'UTF-8'}</h1>
{if $show_warning_payment_status}
    <p class="alert alert-warning">{$hs_translation.it_might_take_a_few_minutes_for_being_validated_please_refresh_this_page_if_your_order_is_missing|escape:'html':'UTF-8'}</p>
{else}
    <p class="alert alert-success">{$hs_translation.your_order_on_is_completed|escape:'html':'UTF-8'}</p>
    <p> {$hs_translation.here_is_your_order_detail|escape:'html':'UTF-8'}</p>
    <p> - {$paypal_instant_checkout_i18n.order_reference|escape:'quotes':'UTF-8'}</p>  
    <p> - {$paypal_instant_checkout_i18n.payment_amount|escape:'quotes':'UTF-8'}</p>
    <p> - {$paypal_instant_checkout_i18n.payment_method|escape:'quotes':'UTF-8'}</p>
    <p>{$hs_translation.an_email_has_been_sent_to_you_with_this_information|escape:'html':'UTF-8'}
    {$paypal_instant_checkout_i18n.for_any_questions_or_for_further_information_please_contact_our|escape:'quotes':'UTF-8'}</p> <br />
    {if $is_guest}
        <p>{$paypal_instant_checkout_i18n.your_order_id_is|escape:'html':'UTF-8'} {$hs_translation.your_order_id_has_been_sent_via_email|escape:'html':'UTF-8'}</p>
        <ul class="footer_links clearfix">
            <li><a class="btn btn-default button button-small" href="{$guest_tracking_link|escape:'html':'UTF-8'}" title="{$hs_translation.follow_my_order|escape:'html':'UTF-8'}"><span><i class="icon-chevron-left"></i>{$hs_translation.follow_my_order|escape:'html':'UTF-8'}</span></a></li>
        </ul>
    {else}
        <ul class="footer_links clearfix">
            <li><a class="btn btn-default button button-small" href="{$order_history_link|escape:'html':'UTF-8'}" title="{$hs_translation.view_your_order_history|escape:'html':'UTF-8'}"><span><i class="icon-chevron-left"></i>{$hs_translation.view_your_order_history|escape:'html':'UTF-8'}</span></a></li>
            {if $is_confirm_address}
                <li><a class="btn btn-default button button-small" href="{$confirm_address_link|escape:'html':'UTF-8'}" title="{$hs_translation.update_your_address|escape:'html':'UTF-8'}"><span><i class="icon-chevron-left"></i>{$hs_translation.update_your_address|escape:'html':'UTF-8'}</span></a></li>
            {/if}
        </ul>
    {/if}
{/if}

