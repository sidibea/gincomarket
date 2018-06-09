{*
*}

{if isset($orderby) AND isset($orderway)}
<!-- Sort products -->
{if isset($smarty.get.id_seller) && $smarty.get.id_seller && isset($id_seller)}
	{assign var='request' value=$link->getAgileSellerLink($id_seller)}
{elseif isset($smarty.get.id_seller_country) && isset($id_seller_country)}
	{assign var='request' value=$link->getSellerCountryLink($id_seller_country)}
{else}
	{assign var='request' value=$link->getPaginationLink(false, false, false, true)}
{/if}
<script type="text/javascript">
//<![CDATA[
{literal}
$(document).ready(function()
{
	$('#selectPrductSort').change(function()
	{
		var requestSortProducts = '{/literal}{$request}{literal}';
		var splitData = $(this).val().split(':');
		document.location.href = requestSortProducts + ((requestSortProducts.indexOf('?') < 0) ? '?' : '&') + 'orderby=' + splitData[0] + '&orderway=' + splitData[1];
	});
});
//]]>
{/literal}
</script>
<form id="productsSortForm" action="{$request|escape:'htmlall':'UTF-8'}">
	<p class="select">
		<select id="selectPrductSort">
			<option value="{$orderbydefault|escape:'htmlall':'UTF-8'}:{$orderwaydefault|escape:'htmlall':'UTF-8'}" {if $orderby eq $orderbydefault}selected="selected"{/if}>{l s='--'}</option>
			{if !$PS_CATALOG_MODE}
				<option value="price:asc" {if $orderby eq 'price' AND $orderway eq 'asc'}selected="selected"{/if}>{l s='Price: Lowest to highest' mod='agilemultipleshop'}</option>
				<option value="price:desc" {if $orderby eq 'price' AND $orderway eq 'desc'}selected="selected"{/if}>{l s='Price:Price: Highest to lowest' mod='agilemultipleshop'}</option>
			{/if}
			<option value="name:asc" {if $orderby eq 'name' AND $orderway eq 'asc'}selected="selected"{/if}>{l s='Product Name: A to Z' mod='agilemultipleshop'}</option>
			<option value="name:desc" {if $orderby eq 'name' AND $orderway eq 'desc'}selected="selected"{/if}>{l s='Product Name: Z to A' mod='agilemultipleshop'}</option>
			{if !$PS_CATALOG_MODE}
				<option value="quantity:desc" {if $orderby eq 'quantity' AND $orderway eq 'desc'}selected="selected"{/if}>{l s='In-stock first' mod='agilemultipleshop'}</option>
			{/if}
		</select>
		<label for="selectPrductSort">{l s='Sort by' mod='agilemultipleshop'}</label>
	</p>
</form>
<!-- /Sort products -->
{/if}
