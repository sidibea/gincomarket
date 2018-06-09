{extends file="helpers/form/form.tpl"}

{block name="field"}
	{if $input.name == 'email'}
		{$smarty.block.parent}
		{if isset($show_seller_options)}
		<div class="margin-form">
		<input type="checkbox" name="create_seller_account" id="create_seller_account" value="1" {if isset($id_sellerinfo) && $id_sellerinfo>0} checked disabled="disabled"{/if} />&nbsp;{l s='Create seller account'}
		{if isset($id_sellerinfo) && $id_sellerinfo>0}<a href="?tab=AdminSellerinfos&id_sellerinfo={$id_sellerinfo}&updatesellerinfo&&token={$tokenSellerinfo}">Seller Info</a>{/if}	
		</div>
		{/if}
	{else}
		{$smarty.block.parent}
	{/if}
{/block}

