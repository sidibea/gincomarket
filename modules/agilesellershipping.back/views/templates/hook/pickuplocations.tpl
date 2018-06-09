{if isset($pickupLocations) AND $pickupLocations AND $id_location_selected > 0}
	<select id="id_pklocation_sellershipping_{$id_product}_{$id_product_attribute}"
		name="id_pklocation_sellershipping_{$id_product}_{$id_product_attribute}"
		onchange="update_product_location({$id_cart},{$id_product},{$id_product_attribute},{$id_carrier})">
		{foreach from=$pickupLocations item=pickuplocation}
			<option value="{$pickuplocation.id_location}" {if $pickuplocation.id_location==$id_location_selected}selected{/if}>{$pickuplocation.location}({$pickuplocation.address1})</option>
		{/foreach}
	</select>
{else}
	<span style="color:red;">{l s='There is no pickup locatiion available'}</span>
{/if}
