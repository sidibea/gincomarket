{*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade Agile Module to newer
* versions in the future. If you wish to customize Agile Module for your
* needs please contact us at http://addons-modules.com/contact-us.
*
* @module Agile Seller Products  
* @author Kinro Sho <shokinro@agileservex.com>
* @copyright agileservex.com
* @version 1.0
*}
{include file="$tpl_dir./errors.tpl"}

<h1>{l s='Product by country' mod='agilemultipleshop'}</h1>

<script language="javascript" type="text/javascript">
    function changecountry() {
        var url = $("#id_seller_country").val();
        window.location.href = url;
    }
</script>

<div>
	{if $seller_countries !== false}
		<div class="form-group selector1">
			<select name="id_seller_country" id="id_seller_country" class="form-control" onchange="changecountry()">
				<option value="{$link->getSellerCountryLink(0)}">{l s='All countries' mod='agilemultipleshop'}</option>
				{foreach from=$seller_countries item=seller_country}
					<option value="{$link->getSellerCountryLink($seller_country.id_country)}" {if isset($id_seller_country)}{if $id_seller_country==$seller_country.id_country}selected{/if}{/if}>{$seller_country.name}</option>
				{/foreach}
			</select>
		</div>
	{else}
		<p>{l s='No seller country information' mod='agilemultipleshop'}</p>
	{/if}
</div>

<div>
	{if $nb_products > 1}{l s='There are' mod='agilemultipleshop'} <span class="bold">{$nb_products} {l s='products.' mod='agilemultipleshop'}</span>{else}{l s='There is' mod='agilemultipleshop'} <span class="bold">{$nb_products} {l s='product.' mod='agilemultipleshop'}</span>{/if}
</div>

{if $products}
	<div class="content_sortPagiBar">
		{include file="$tpl_dir./pagination.tpl"}
		<div class="sortPagiBar clearfix">
			{include file="$tpl_dir./product-sort.tpl"}
			{include file="$tpl_dir./product-compare.tpl"}
			{include file="$tpl_dir./nbr-product-page.tpl"}
		</div>
	</div>
	{include file="$tpl_dir./product-list.tpl" products=$products}
	<div class="content_sortPagiBar">
		<div class="sortPagiBar clearfix">
			{include file="$tpl_dir./product-sort.tpl" paginationId='bottom'}
			{include file="$tpl_dir./product-compare.tpl" paginationId='bottom'}
			{include file="$tpl_dir./nbr-product-page.tpl" paginationId='bottom'}
		</div>
		{include file="$tpl_dir./pagination.tpl" paginationId='bottom'}
	</div>
{/if}
