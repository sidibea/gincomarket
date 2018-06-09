{capture name=path}<a href="{$link->getPageLink('my-account', true)}">{l s='My Account' mod='agilemultipleseller'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='My Seller Account'  mod='agilemultipleseller'}{/capture}
<div id="agile">
<h1>{l s='My Seller Account' mod='agilemultipleseller'}</h1>
{include file="$agilemultipleseller_views./templates/front/seller_tabs.tpl"}
<br />
{include file="$tpl_dir./errors.tpl"}
<script type="text/javascript">
	var base_dir = "{$base_dir_ssl}";
	var id_product = {$id_product};
</script>
{if isset($isSeller) AND $isSeller AND ($id_product>0 OR !$is_list_limited)}
    {include file="$agilemultipleseller_views./templates/front/products/product_top.tpl"}
	<div  class="row" {if $hasOwnerShip}{else}style="display:none;"{/if}>
		{include file="$agilemultipleseller_views/templates/front/products/product_nav.tpl"}
		<form id="product_form" name="product" action="{$link->getModuleLink('agilemultipleseller', 'sellerproductdetail', ['id_product'=>$id_product,'product_menu'=>$product_menu], true)}" 
		enctype="multipart/form-data" method="post" class="form-horizontal agile-col-md-9 agile-col-lg-10 agile-col-xl-10">
		{if $product_menu == 1}
        {include file="$agilemultipleseller_views./templates/front/products/informations.tpl"}
        {else if $product_menu == 2}
        {include file="$agilemultipleseller_views./templates/front/products/images.tpl"}
        {else if $product_menu == 3}
        {include file="$agilemultipleseller_views./templates/front/products/features.tpl"}
        {else if $product_menu == 4}
        {include file="$agilemultipleseller_views./templates/front/products/associations.tpl"}
        {else if $product_menu == 5}
        {include file="$agilemultipleseller_views./templates/front/products/prices.tpl"}
        {else if $product_menu == 6}
        {include file="$agilemultipleseller_views./templates/front/products/quantites.tpl"}
        {else if $product_menu == 7}
        {include file="$agilemultipleseller_views./templates/front/products/combinations.tpl"}
        {else if $product_menu == 8}
        {include file="$agilemultipleseller_views./templates/front/products/virtualproduct.tpl"}
        {else if $product_menu == 9}
        {include file="$agilemultipleseller_views./templates/front/products/shipping.tpl"}
        {else if $product_menu == 10}
        {include file="$agilemultipleseller_views./templates/front/products/attachments.tpl"}
		{/if}

		</form>
	</div>
    <br />
{/if}

</div>
{include file="$agilemultipleseller_views./templates/front/seller_footer.tpl"}
