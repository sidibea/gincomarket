{*
  * @module Agile Seller Products  
  * @author Kinro Sho <shokinro@agileservex.com>
  * @copyright agileservex.com
  * @version 1.0
*}

<script language="javascript" type="text/javascript">
<!--
    function shopbylocation_block_selectedchanged() {
        var url = $("#shop_by_location_list").val();
        window.location.href = url;
    }
-->
</script>

<div id="manufacturers_block_left" class="block blockmanufacturer">
	{if $location_level == "country" }
		<h4><a href="{$link->getSellerLocationLink('', $location_level)}" title="{l s='Shop by Country' mod='agilemultipleshop'}">{l s='Shop by Country' mod='agilemultipleshop'}</a></h4>
	{elseif $location_level == "state"}
		<h4><a href="{$link->getSellerLocationLink('', $location_level)}" title="{l s='Shop by State' mod='agilemultipleshop'}">{l s='Shop by State' mod='agilemultipleshop'}</a></h4>
	{elseif $location_level == "city"}
		<h4><a href="{$link->getSellerLocationLink('', $location_level)}" title="{l s='Shop by City' mod='agilemultipleshop'}">{l s='Shop by City' mod='agilemultipleshop'}</a></h4>
	{elseif $location_level == "sellertype"}
		<h4><a href="{$link->getSellerLocationLink('', $location_level)}" title="{l s='Shop by Seller Type' mod='agilemultipleshop'}">{l s='Shop by Seller Type' mod='agilemultipleshop'}</a></h4>
	{elseif $location_level == "custom"}
		<h4><a href="{$link->getSellerLocationLink('', $location_level)}" title="{l s='Shop by' mod='agilemultipleshop'}&nbsp;{$location_custom_name}">{l s='Shop by' mod='agilemultipleshop'}&nbsp;{$location_custom_name}</a></h4>
	{/if}
	<div class="block_content list-block">
        {if $seller_locations4block !== false}
			{if $asp_location_block_style ==1}
				<div class="form-group selector1">
					<select name="shop_by_location_list" id="shop_by_location_list"  class="form-control" onchange=" shopbylocation_block_selectedchanged()">
						<option value="0">{l s='Please select' mod='agilemultipleshop'}</option>
						{foreach from=$seller_locations4block item=location}
							<option value="{$link->getSellerLocationLink($location.id, $location_level)}">{$location.name}</option>
						{/foreach}
					</select>
				</div>
			{else}
				{foreach from=$seller_locations4block item=location}
					<ul class="block_content">
						<li><a href="{$link->getSellerLocationLink($location.id, $location_level)}" title="{$location.name}">{$location.name}</a></li>
					</ul>
				{/foreach}

			{/if}
        {else}
	        <p>{l s='No seller found in this location' mod='agilemultipleshop'}</p>
        {/if}

	</div>
</div>
<!-- /MODULE Agile Sellers Products -->

