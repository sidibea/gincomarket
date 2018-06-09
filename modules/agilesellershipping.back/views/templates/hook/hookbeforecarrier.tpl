{if $products_without_carrier_nbr >0}
<div class="alert alert-warning">
	<p>{l s='There are no carriers available which can deliver the following products to your address:' mod='agilesellershipping'}</p>
	{foreach from=$products_without_carrier item=product}
	<p><b>{$product.product_name}</b></p>
	{/foreach}
</div>
<br>
{/if}
