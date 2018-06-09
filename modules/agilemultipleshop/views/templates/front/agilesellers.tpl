{*
  * @module Agile Seller Products  
  * @author Kinro Sho <shokinro@agileservex.com>
  * @copyright agileservex.com
  * @version 1.0
*}

{include file="$tpl_dir./errors.tpl"}
<script language="javascript" type="text/javascript">
	$(document).ready(function () {
		$('div.filter2 a').click(function() {
			jumptoagilesellerspage("{$base_dir_ssl}",$(this).attr("letter"), "{$loclevel}", {$parentid});
			return false;
		});

		$('div.filters select').change(function() {
			jumptoagilesellerspage("{$base_dir_ssl}","{$filter}", "{$loclevel}", {$parentid});
		});

	});
</script>
<h2>{l s='Seller List' mod='agilemultipleshop'}</h2>
<br>

<div class="filters">
	<div class="row">
		<div class="agile-col-xs-12 agile-col-sm-6 agile-col-md-4 clearfix">
			<label class="agile-col-xs-4 agile-col-sm-4 agile-col-md-4 agile-col-lg-3 agile-col-xl-3">{l s='Type:' mod='agilemultipleshop'}</label>
 			<select name="seller_type" id="seller_type" class="agile-col-xs-8 agile-col-sm-8 agile-col-md-8 agile-col-lg-6 agile-col-xl-8">
				<option value="0">{l s='- All Type-' mod='agilemultipleshop'}</option>
				{foreach from=$sellertypes item=sellertype}
					<option value="{$sellertype.id_sellertype}" {if $sellertype.id_sellertype ==$seller_type}selected{/if}>{$sellertype.name}</option>
				{/foreach}
			</select>
		 </div>
		<div class="agile-col-xs-12 agile-col-sm-6 agile-col-md-4 clearfix">
			<label class="agile-col-xs-4 agile-col-sm-4 agile-col-md-4 agile-col-lg-3 agile-col-xl-3">{l s='Location:' mod='agilemultipleshop'}</label>
 			<select name="seller_location" id="seller_location" class="agile-col-xs-8 agile-col-sm-8 agile-col-md-8 agile-col-lg-6 agile-col-xl-8">
				<option value="">{l s=' - All Locations-' mod='agilemultipleshop'}</option>
				{foreach from=$sellerlocs item=sellerloc}
					{if !empty({$sellerloc.name})}
					<option value="{$sellerloc.id}" {if $sellerloc.id == $seller_location}selected{/if}>{$sellerloc.name}</option>
					{/if}
				{/foreach}
			</select>
		</div>
	</div> <!-- row -->
</div>

<div class="filter2">
	<b>{l s='Name Filter' mod='agilemultipleshop'}</b>:&nbsp; {if strtoupper($filter)=='ALL'}<b>All</b>{else}<a href="{$link->getAgileSellersLink('all',NULL,{$loclevel})}" letter="all">All</a>{/if}
	{foreach from=$filters item=letter}
	&nbsp;
	{if $filter==$letter}<b>{strtoupper($letter)}</b>{else}<a href="{$link->getAgileSellersLink($letter,NULL,$loclevel)}" letter="{$letter}">{strtoupper($letter)}</a>{/if}
	{/foreach}
</div>


<div class="content_sortPagiBar">
	{if $selers_nb > 1}
	{include file="$tpl_dir./pagination.tpl"}
	{/if}
	<div class="sortPagiBar clearfix">
	<ul class="display">
		<li class="display-title"> {l s='View:' mod='agilemultipleshop'}</li>
		<li id="grid"><a rel="nofollow" href="#" title="{l s='Grid' mod='agilemultipleshop'}"><i class="icon-th-large"></i> {l s='Grid' mod='agilemultipleshop'}</a></li>
		<li id="list"><a rel="nofollow" href="#" title="{l s='List' mod='agilemultipleshop'}"><i class="icon-th-list"></i>{l s='List' mod='agilemultipleshop'}</a></li>
	</ul>
	{if $selers_nb > 0}
		{if $selers_nb > 1}
			<p class="alert alert-info agile-col-xs-8">{l s='There are' mod='agilemultipleshop'} {$selers_nb} {l s='sellers.' mod='agilemultipleshop'}</p>
		{else}
			<p class="alert alert-info agile-col-xs-8">{l s='There is' mod='agilemultipleshop'} {$selers_nb} {l s='seller.' mod='agilemultipleshop'}</p>
		{/if}
	{else}
		<p class="alert alert-warning agile-col-xs-8">{l s='There is no sellers found meets your search criteria.' mod='agilemultipleshop'}</p>
	{/if}
	{include file="$agilemultipleshop_tpl./nbr-per-page.tpl"}
	</div>
</div>


{*  List View Begin *}
<div id="listview" class="hidden">
    <table class="std">
	<tr>
	<th>{l s='Logo/Photo' mod='agilemultipleshop'}</th>
	<th>{l s='Description' mod='agilemultipleshop'}</th>
	</tr>
	{foreach from=$seller_list item=seller}
	{assign var=seller_link value=$link->getAgileSellerLink($seller.id_seller,$seller.company)}
	<tr>
		<td>
					<div class="logo">
           			<a href="{$seller_link}">
           			{* The logo image is always use the orignal size of logo image, please use either width OR height to display size  *}
   					<img src="{$seller.seller_logo_url}" width="120" title="Logo" alt="Logo" />
   					</a>
					</div>
		</td>
		<td>
					<h4><a href="{$seller_link}">{$seller.company}</a></h4>
					<span>{$seller.country}</span><br>
					<p class="description">
					{$seller.description}
					</p>
		</td>
	</tr>
	{/foreach}
    </table>
</div>
{* List View End *}
{* Grid View Begin *}

<div id="gridview" class="hidden">
	{if $selers_nb}
		<div class="block_content">
			{assign var='liHeight' value=250}
			{assign var='nbItemsPerLine' value=4}
			{assign var='nbLi' value=$seller_list|@count}
			{math equation="nbLi/nbItemsPerLine" nbLi=$nbLi nbItemsPerLine=$nbItemsPerLine assign=nbLines}
			{math equation="nbLines*liHeight" nbLines=$nbLines|ceil liHeight=$liHeight assign=ulHeight}
			<ul class="seller_list grid row ">
			{foreach from=$seller_list item=seller name=gridViewSellers}
				{assign var=seller_link value=$link->getAgileSellerLink($seller.id_seller,$seller.company)}
				{math equation="(total%perLine)" total=$smarty.foreach.gridViewSellers.total perLine=$nbItemsPerLine assign=totModulo}
				{if $totModulo == 0}{assign var='totModulo' value=$nbItemsPerLine}{/if}
				<li class="ajax_block_seller col-xs-12 col-sm-6 col-md-4 {if $smarty.foreach.gridViewSellers.first}first_item{elseif $smarty.foreach.gridViewSellers.last}last_item{else}item{/if} {if $smarty.foreach.gridViewSellers.iteration%$nbItemsPerLine == 0}last_item_of_line{elseif $smarty.foreach.gridViewSellers.iteration%$nbItemsPerLine == 1} {/if} {if $smarty.foreach.gridViewSellers.iteration > ($smarty.foreach.gridViewSellers.total - $totModulo)}last_line{/if}">
				<div class="seller-container">
					<span>{$seller.country}</span><br>
					<div class="seller-image-container">
					<a href="{$seller_link}" title="{$seller.company|escape:html:'UTF-8'}" class="product_image">
					<img src="{$seller.seller_logo_url}" height="{$homeSize.height}" width="{$homeSize.width}" alt="{$seller.company|escape:html:'UTF-8'}"  /></a>
					</div>
					<h5><a href="{$seller_link}" title="{$seller.company|truncate:50:'...'|escape:'htmlall':'UTF-8'}">{$seller.company|truncate:35:'...'|escape:'htmlall':'UTF-8'}</a></h5>
					<div class="product_desc" style="display:none;"><a href="" title="{l s='More' mod='homefeatured'}">{$seller.description|strip_tags|truncate:65:'...'}</a></div>
				</div>
				</li>
			{/foreach}
			</ul>
		</div>
	{/if}
</div>
{* Grid View End *}

<div class="content_sortPagiBar">
	{if $selers_nb > 1}
	{include file="$tpl_dir./pagination.tpl"}
	{/if}
	<div class="sortPagiBar clearfix">
		<ul class="display">
			<li class="display-title"> {l s='View:' mod='agilemultipleshop'}</li>
			<li id="grid"><a rel="nofollow" href="#" title="{l s='Grid' mod='agilemultipleshop'}"><i class="icon-th-large"></i> {l s='Grid' mod='agilemultipleshop'}</a></li>
			<li id="list"><a rel="nofollow" href="#" title="{l s='List' mod='agilemultipleshop'}"><i class="icon-th-list"></i>{l s='List' mod='agilemultipleshop'}</a></li>
		</ul>
		{if $selers_nb > 0}
			{if $selers_nb > 1}
				<p class="alert alert-info agile-col-xs-8">{l s='There are' mod='agilemultipleshop'} {$selers_nb} {l s='sellers.' mod='agilemultipleshop'}</p>
			{else}
				<p class="alert alert-info agile-col-xs-8">{l s='There is' mod='agilemultipleshop'} {$selers_nb} {l s='seller.' mod='agilemultipleshop'}</p>
			{/if}
		{else}
			<p class="alert alert-warning agile-col-xs-8">{l s='There is no sellers found meets your search criteria.' mod='agilemultipleshop'}</p>
		{/if}

		{include file="$agilemultipleshop_tpl./nbr-per-page.tpl"}

		<span style="float:right;display:none;">
			<input type="hidden" name="userview" id="userview" value="{$userview}">
			<img src="{$base_dir_ssl}modules/agilemultipleshop/img/grid.png" id="imggrid" value="grid" style="cursor:pointer" class="listgrid" title="{l s='Show in Grid View' mod='agilemultipleshop'}">&nbsp;
			<img src="{$base_dir_ssl}modules/agilemultipleshop/img/list.png" id="imglist" value="list" style="cursor:pointer" class="listgrid" title="{l s='Show in List View' mod='agilemultipleshop'}">
		</span>
	</div>
</div>
