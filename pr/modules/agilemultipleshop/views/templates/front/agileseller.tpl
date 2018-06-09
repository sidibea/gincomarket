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

<h1>{strip}
	{$seller_info->company|escape:'htmlall':'UTF-8'}
	{/strip}
</h1>

<div id="seller-block" class="box">
	<div class="row">
		<!-- seller logo-->        
		<div id="logo-block" class="col-xs-12 col-sm-3 col-md-2">
			<img src="{$seller_info->get_seller_logo_url()}" title="Logo" alt="Logo" style="display:block;max-width:100%;height:auto;" />
		</div>
		<!-- end logo -->
		<div class="col-xs-12 col-sm-6 col-md-6">
			{if empty($HOOK_SELLER_RATINGS)}
				<b>{$seller_info->company}</b>
			{else}
				{$HOOK_SELLER_RATINGS}
			{/if}
			<br />
			{$seller_info->address1}<br />
			{if $seller_info->address2}{$seller_info->address2}<br />{/if}
			{$seller_info->city}, {$seller_info->state} {$seller_info->postcode}<br />
			{$seller_info->country} <br /><br />
			{if !empty($seller_info->phone)}
			{l s='Phone' mod='agilemultipleshop'}:{$seller_info->phone}
			{/if}
			<p id="custmomized_fields">
			{for $i=1 to 10}
				{if isset($conf) and $conf[sprintf("AGILE_MS_SELLER_TEXT%s",$i)]}
				{$field_name = sprintf("ams_custom_text%s",$i)}
					<label for="{$field_name}">{$custom_labels[$field_name]}:&nbsp;</label>{$seller_info->{$field_name}}<br>
				{/if}
			{/for}
			{for $i=1 to 2}
				{if isset($conf) and $conf[sprintf("AGILE_MS_SELLER_HTML%s",$i)]}
				{$field_name = sprintf("ams_custom_html%s",$i)}
					<label for="{$field_name}">{$custom_labels[$field_name]}:&nbsp;</label>{$seller_info->{$field_name}|strip_tags}<br>
				{/if}
			{/for}
			{for $i=1 to 10}
				{if isset($conf) and $conf[sprintf("AGILE_MS_SELLER_NUMBER%s",$i)]}
				{$field_name = sprintf("ams_custom_number%s",$i)}
					<label for="{$field_name}">{$custom_labels[$field_name]}:&nbsp;</label>{$seller_info->{$field_name}}<br>
				{/if}
			{/for}
			{for $i=1 to 5}
				{if isset($conf) and $conf[sprintf("AGILE_MS_SELLER_DATE%s",$i)]}
				{$field_name = sprintf("ams_custom_date%s",$i)}
					<label for="{$field_name}">{$custom_labels[$field_name]}:&nbsp;</label>{$seller_info->{$field_name}}<br>
				{/if}
			{/for}
			</p>
		</div>
	</div>
	<hr></hr>
	<div class="row">
		<span>&nbsp;&nbsp;<b>{l s='description:' mod='agilemultipleshop'}</b>&nbsp;{$seller_info->description}</span>
	</div>
</div> <!-- End of Box -->


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

<script lang="javascript" type="text/javascript">
	$('document').ready( function() {
		$("#top_column").hide();
	});
</script>
