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

<script language="javascript" type="text/javascript">
    function changesellerlocation() {
        var url = $("#id_location").val();
        window.location.href = url;
    }
</script>

<H2>{l s='Shop By Location' mod='agilemultipleshop'}</H2>
<div>
	{if $seller_locations4page !== false}
		<div class="form-group selector1">
			<select name="id_location" id="id_location" style="width:170px;height:24px;margin:8px;padding:2px" onchange="changesellerlocation()">
				<option value="{$link->getSellerLocationLink('', "{$location_level4page}")}">{l s='All location' mod='agilemultipleshop'}</option>
				{foreach from=$seller_locations4page item=location}
					<option value="{$link->getSellerLocationLink($location.id, $location_level4page)}" {if isset($id_location) && $id_location == strtolower($location.id)}selected{/if}>{$location.name}</option>
				{/foreach}
			</select>
		</div>
	{else}
		<p>{l s='No sellers found in this location' mod='agilemultipleshop'}</p>
	{/if}
</div>

<div>
	{if $nb_products > 1}{l s='There are' mod='agilemultipleshop'} <span class="bold">{$nb_products} {l s='products.' mod='agilemultipleshop'}</span>{else}{l s='There is' mod='agilemultipleshop'} <span class="bold">{$nb_products} {l s='product.' mod='agilemultipleshop'}</span>{/if}
</div>

{if $products}
	<div class="content_sortPagiBar">
		<div class="sortPagiBar clearfix">
			{include file="$tpl_dir./product-sort.tpl"}
			{include file="$tpl_dir./product-compare.tpl"}
			{include file="$tpl_dir./nbr-product-page.tpl"}
		</div>
	</div>
    <div id="view_way" class="{if isset($warehouse_vars.product_view) && $warehouse_vars.product_view == 1}list_view{else} grid_view{/if}">               
				{include file="$tpl_dir./product-list.tpl" products=$products}
	</div>
	{include file="$tpl_dir./pagination.tpl"}

{/if}
