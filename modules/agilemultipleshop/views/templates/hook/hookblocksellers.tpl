{*
  * @module Agile Multiple Shop/Store
  * @author Kinro Sho <shokinro@agileservex.com>
  * @copyright agileservex.com
  * @version 1.0
*}
<script language="javascript" type="text/javascript">
<!--
    function shopbyseller_block_selectedchanged() {
        var url = $("#shop_by_seller_list").val();
        window.location.href = url;
    }
-->
</script>

<!-- MODULE Agile Multiple Shops -->
<div id="manufacturers_block_left" class="block blockmanufacturer">
	<h4><a href="{$link->getAgileSellersLink('all')}" title="{l s='Shop by Seller' mod='agilemultipleshop'}">{l s='Shop by Seller' mod='agilemultipleshop'}</a></h4>
	<div class="block_content list-block">
	{if $asp_sellers !== false}
		{if $asp_sellers_block_style ==1}
			<div class="form-group selector1">
				<select name="sellers" id="shop_by_seller_list" class="form-control" onchange="shopbyseller_block_selectedchanged()">
					<option value="">{l s='Please Choose' mod='agilemultipleshop'}</option>
					{foreach from=$asp_sellers item=asc_seller}
						<option value="{$link->getAgileSellerLink($asc_seller.id_seller,$asc_seller.company)}">{$asc_seller.company}</option>
					{/foreach}
				</select>
			</div>
		{else}
			<ul>
				{foreach from=$asp_sellers item=asc_seller}
						<li><a href="{$link->getAgileSellerLink($asc_seller.id_seller,$asc_seller.company)}" title="{$asc_seller.company}">{$asc_seller.company}</a></li>
				{/foreach}
			</ul>
		{/if}
	{else}
		<p>{l s='No sellers at this time' mod='agilemultipleshop'}</p>
	{/if}
	</div>
</div>
<!-- /MODULE Agile Sellers Products -->