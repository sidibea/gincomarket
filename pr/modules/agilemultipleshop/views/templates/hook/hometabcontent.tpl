{*
This source file is subject to the Software License Agreement that is bundled with this 
package in the file license.txt, or you can get it here
http://addons-modules.com/en/content/3-terms-and-conditions-of-use

@copyright  2009-2014 Addons-Modules.com
*}
<ul id="shopbysellerlocation" class="block products_block clearfix tab-pane">
	<table width="100%">
	<tr>
		<td width="15%">
			<h4 class="title_block"><a href="{$link->getAgileSellersLink('all')}" title="{l s='Shop by Seller' mod='agilemultipleshop'}">{l s='Shop by Seller' mod='agilemultipleshop'}</a></h4>
		</td>
		<td width="15%">
			<h4 class="title_block">
				{if $location_level == "country" }
					<a href="{$link->getSellerLocationLink('', $location_level)}" title="{l s='Shop by Country' mod='agilemultipleshop'}">{l s='Shop by Country' mod='agilemultipleshop'}</a>
				{elseif $location_level == "state"}
					<a href="{$link->getSellerLocationLink('', $location_level)}" title="{l s='Shop by State' mod='agilemultipleshop'}">{l s='Shop by State' mod='agilemultipleshop'}</a>
				{elseif $location_level == "city"}
					<a href="{$link->getSellerLocationLink('', $location_level)}" title="{l s='Shop by City' mod='agilemultipleshop'}">{l s='Shop by City' mod='agilemultipleshop'}</a>
				{elseif $location_level == "sellertype"}
					<a href="{$link->getSellerLocationLink('', $location_level)}" title="{l s='Shop by Seller Type' mod='agilemultipleshop'}">{l s='Shop by Seller Type' mod='agilemultipleshop'}</a>
				{elseif $location_level == "custom"}
					<a href="{$link->getSellerLocationLink('', $location_level)}" title="{l s='Shop by' mod='agilemultipleshop'}&nbsp;{$location_custom_name}">{l s='Shop by' mod='agilemultipleshop'}&nbsp;{$location_custom_name}</a>
				{/if}
			</h4>
		</td>
	</tr>
	<tr>
		<td valign="top" width="15%">
			<div class="block_content list-block">
			{if $asp_sellers !== false}
				<ul>
					{foreach from=$asp_sellers item=asc_seller}
						<li><a href="{$link->getAgileSellerLink($asc_seller.id_seller,$asc_seller.company)}" title="{$asc_seller.company}">{$asc_seller.company}</a></li>
					{/foreach}
				</ul>
			{else}
				<p>{l s='No sellers at this time' mod='agilemultipleshop'}</p>
			{/if}
			</div>
		</td>
		<td valign="top" width="15%">
			<div class="block_content list-block">
				{if $seller_locations4block !== false}
					<ul class="block_content">
					{foreach from=$seller_locations4block item=location}
						<li><a href="{$link->getSellerLocationLink($location.id, $location_level)}" title="{$location.name}">{$location.name}</a></li>
					{/foreach}
					</ul>
				{else}
					<p>{l s='No seller found in this location' mod='agilemultipleshop'}</p>
				{/if}
			</div>
		</td>
	</tr>
	</table>
</ul>
