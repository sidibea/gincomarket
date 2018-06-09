{capture name=path}<a href="{$link->getPageLink('my-account', true)}">{l s='My Account' mod='agilemultipleseller'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='My Seller Account'  mod='agilemultipleseller'}{/capture}

<h1>{l s='My Seller Account' mod='agilemultipleseller'}</h1>
{include file="$tpl_dir./errors.tpl"}

{include file="$agilemultipleseller_views./templates/front/seller_tabs.tpl"}
{if isset($isSeller) AND $isSeller}
<div id="agile">
<div class="block-center" id="block-history">
    {if $orders && count($orders)}
	{include file="$tpl_dir./pagination.tpl"}
	<div class="table-responsive clearfix">
    <table id="order-list" class="table">
        <thead>
	        <tr>
		        <th class="first_item">{l s='Order' mod='agilemultipleseller'}</th>
		        <th class="item">{l s='New' mod='agilemultipleseller'}</th>
		        <th class="item">{l s='Customer' mod='agilemultipleseller'}</th>
		        <th class="item">{l s='Date' mod='agilemultipleseller'}</th>
		        <th class="item">{l s='Total price' mod='agilemultipleseller'}</th>
		        <th class="item">{l s='Payment' mod='agilemultipleseller'}</th>
		        <th class="item">{l s='Status' mod='agilemultipleseller'}</th>
		        <th class="item">{l s='Invoice' mod='agilemultipleseller'}</th>
		        <th class="last_item" style="width:5px">&nbsp;</th>
	        </tr>
        </thead>
        <tbody>
        {foreach from=$orders item=order name=myLoop}
	        <tr class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if} {if $smarty.foreach.myLoop.index % 2}alternate_item{/if}">
		        <td class="history_link bold">
			        {if isset($order.invoice) && $order.invoice && isset($order.virtual) && $order.virtual}<img src="{$base_dir_ssl}//modules/agilemultipleseller/images//download_product.gif" class="icon" alt="{l s='Products to download' mod='agilemultipleseller'}" title="{l s='Products to download' mod='agilemultipleseller'}" />{/if}
			        <a class="color-myaccount" href="{$link->getModuleLink('agilemultipleseller', 'sellerorderdetail', ['id_order' => $order.id_order], true)}">{l s='#' mod='agilemultipleseller'}{$order.reference}</a>
		        </td>
		        <td>{if $order.new == 1}<img src="{$base_dir_ssl}//modules/agilemultipleseller/images/news-new.gif" />{/if}</td>
		        <td>{$order.customer}</td>
		        <td class="history_date bold">{dateFormat date=$order.date_add full=0}</td>
		        <td class="history_price"><span class="price">{displayPrice price=$order.total_paid currency=$order.id_currency no_utf8=false convert=false}</span></td>
		        <td class="history_method">{$order.payment|escape:'htmlall':'UTF-8'}</td>
		        <td class="history_state">{if isset($order.order_state)}{$order.order_state|escape:'htmlall':'UTF-8'}{/if}</td>
		        <td class="history_invoice">
		        {if (isset($order.invoice) && $order.invoice && isset($order.invoice_number) && $order.invoice_number) && isset($invoiceAllowed) && $invoiceAllowed == true}
			        <a href="{$link->getModuleLink('agilemultipleseller', 'sellerpdfinvoice', ['id_order' => $order.id_order], true)}" title="{l s='Invoice' mod='agilemultipleseller'}" target="pdf"><img src="{$base_dir_ssl}//modules/agilemultipleseller/images/pdf.gif" alt="{l s='Invoice'}" class="icon" /></a>
			        <a href="{$link->getModuleLink('agilemultipleseller', 'sellerpdfinvoice', ['id_order' => $order.id_order], true)}" title="{l s='Invoice' mod='agilemultipleseller'}" target="pdf">{l s='PDF' mod='agilemultipleseller'}</a>
		        {else}-{/if}
		        </td>
		        <td class="history_detail">
		        </td>
	        </tr>
        {/foreach}
        </tbody>
    </table>
	</div> <!-- responsive -->
    <div id="block-order-detail" class="hidden">&nbsp;</div>
    {else}
        <p class="alert alert-warning">{l s='You do not have any orders.' mod='agilemultipleseller'}</p>
    {/if}
</div> <!-- block-center -->
</div> <!-- agile -->
{/if}
{include file="$agilemultipleseller_views./templates/front/seller_footer.tpl"}

