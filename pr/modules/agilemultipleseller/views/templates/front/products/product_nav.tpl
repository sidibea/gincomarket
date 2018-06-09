<script type="text/javascript">
	var currentmenuid = {$product_menu};
</script>
{if $id_product>0}
	<div class="productTabs agile-col-md-3 agile-col-lg-2 agile-col-xl-2">
		<div class="list-group">
			{foreach from=$product_menus item=menu}
				<a class="list-group-item {if $product_menu==$menu.id}active{/if}" id="link-{$menu.name}"
				href="{$link->getModuleLink('agilemultipleseller', 'sellerproductdetail'
				, ['id_product'=>$id_product,'product_menu'=>$menu.id,'token'=>$token], true)}">{$menu.name}</a>
			{/foreach}
		</div>
	</div>
{/if}