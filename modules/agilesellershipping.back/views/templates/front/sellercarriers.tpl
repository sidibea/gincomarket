{capture name=path}<a href="{$link->getPageLink('my-account', true)}">{l s='My Account' mod='agilesellershipping'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='My Seller Account'  mod='agilesellershipping'}{/capture}

<h1>{l s='My Seller Account' mod='agilesellershipping'}</h1>
{include file="$tpl_dir./errors.tpl"}

{include file="$agilemultipleseller_views./templates/front/seller_tabs.tpl"}
{if isset($isSeller) AND $isSeller}
<div id="agile">
<div class="block-center clearfix" id="block-history">
    <div class="row">
		<a class="agile-btn agile-btn-default" href="{$link->getModuleLink('agilesellershipping', 'sellercarrierdetail', ['id_carrier' =>0], true)}" class="btn btn-primary">
				<i class="icon-plus-sign"></i> {l s='Add New' mod='agilesellershipping'}
			</a>
    </div>
    <br />
    {if $carriers && count($carriers)}
	<div class="table-responsive clearfix">
	{include file="$tpl_dir./pagination.tpl"}
    <table id="carrier-list" style="width:100%">
        <thead>
	        <tr style="background-color:lightgray">
		        <th class="first_item">{l s='ID' mod='agilesellershipping'}</th>
		        <th class="item">{l s='Name' mod='agilesellershipping'}</th>
				<th class="item">{l s='Logo' mod='agilesellershipping'}</th>
				<th class="item">{l s='Status' mod='agilesellershipping'}</th>
				<th class="item">{l s='Free Shipping' mod='agilesellershipping'}</th>
				<th class="item">{l s='Delay' mod='agilesellershipping'}</th>
				<th class="item">{l s='Type' mod='agilesellershipping'}</th>
				<th class="last_item" style="width:40px;"></th>
	        </tr>
        </thead>
        <tbody>
        {foreach from=$carriers item=carrier name=myLoop}
    	{assign var='detail_url' value=$link->getModuleLink('agilesellershipping', 'sellercarrierdetail', ['id_carrier' => $carrier.id_carrier], true)}
	        <tr class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if} {if $smarty.foreach.myLoop.index % 2}alternate_item{/if}">
		        <td width="50">
			        <a class="color-myaccount" href="{$detail_url}">{$carrier.id_carrier}</a>
		        </td>
		        <td><a href="{$detail_url}">{if $carrier.name != "0"}{$carrier.name}{else}{$shop_name}{/if}</a></td>
				<td align="center" valign="middle"><img src="{$content_dir|addslashes}img/s/{$carrier.id_carrier}.jpg" high="40" width ="40"/></td>
				<td align="center" valign="middle">
		            {if $carrier.active == 1}
		            <img src="{$content_dir|addslashes}img/admin/enabled.gif" />
		            {else}
		            <img src="{$content_dir|addslashes}img/admin/disabled.gif" />
		            {/if}
		        </td>
				<td align="center" valign="middle">
		            {if $carrier.is_free == 1}
		            <img src="{$content_dir|addslashes}img/admin/enabled.gif" />
		            {else}
		            <img src="{$content_dir|addslashes}img/admin/disabled.gif" />
		            {/if}
		        </td>
				<td>{$carrier.delay}</a></td>
				<td>
					{if $carrier.id_owner >0 }{l s='Private' mod='agilesellershipping'}{else}{l s='Public' mod='agilesellershipping'}{/if}
				</td>
				<td class="history_detail">
					{if $carrier.id_owner >0 }
					<a href="{$link->getModuleLink('agilesellershipping', 'sellercarriers', ['process' => 'delete', 'id_carrier'=>$carrier.id_carrier], true)}" onclick="if (confirm('Delete selected item?')){ return true; }else{ event.stopPropagation(); event.preventDefault();};"><img src="{$content_dir|addslashes}img/admin/delete.gif" /></a>
					{/if}
		        </td>
	        </tr>
        {/foreach}
        </tbody>
    </table>
	</div> <!-- end of table-responsive -->
    <div id="block-carrier-detail" class="hidden">&nbsp;</div>
    {else}
        <p class="warning">{l s='You do not have any carrier registered' mod='agilesellershipping'}</p>
    {/if}
</div>
</div> <!-- end of agile -->
{/if}
{include file="$agilemultipleseller_views./templates/front/seller_footer.tpl"}
