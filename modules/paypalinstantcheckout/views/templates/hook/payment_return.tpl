{*
* Paypal instant checkout for PrestaShop
*
* @author    PrestaMonster
* @copyright PrestaMonster
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

{capture name=path}{$hs_translation.order_confirmation}{/capture}
 <h1 class="page-heading">{$hs_translation.order_confirmation}</h1>
 {if $show_warning_payment_status}
     <p class="alert alert-warning">{$hs_translation.it_might_take_a_few_minutes_for_being_validated_please_refresh_this_page_if_your_order_is_missing}</p>
 {else}
     <p class="alert alert-success">{$hs_translation.your_order_on_is_completed}</p>
     <p> {$hs_translation.here_is_your_order_detail}</p>
     <p> - {$hs_translation.order_reference}<strong> {$order->reference}</strong></p>
     <p> - {$hs_translation.payment_method}<strong> {$order->payment}</strong></p>
     <p> - {$hs_translation.payment_amount}<span class="price"><strong> {$formated_total_pay}</strong></span></p>
     <p>{$hs_translation.an_email_has_been_sent_to_you_with_this_information nofilter}
     {$hs_translation.for_any_questions_or_for_further_information_please_contact_our nofilter}</p> <br />
     {if $is_guest}
        <p> - {$hs_translation.your_order_id_is} {$id_order_formatted}. {$hs_translation.your_order_id_has_been_sent_via_email}</p>
         <ul class="footer_links clearfix">
             <li><a class="btn btn-primary button button-small" href="{$guest_tracking_link}" title="{$hs_translation.follow_my_order}"><span><i class="icon-chevron-left"></i>{$hs_translation.follow_my_order}</span></a></li>
         </ul>
     {else}
         <ul class="footer_links clearfix">
             <li><a class="btn btn-primary button button-small" href="{$order_history_link}" title="{$hs_translation.view_your_order_history}"><span><i class="icon-chevron-left"></i>{$hs_translation.view_your_order_history}</span></a></li>
         </ul>
     {/if}
 {/if}



