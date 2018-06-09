<a href="{$base_dir_default}" title="{l s='Main Shop' mod='agilemultipleshop'}">{l s='Main Shop' mod='agilemultipleshop'}</a>
{if isset($seller_shop) AND $seller_shop}
	{if isset($isat_seller_home) && $isat_seller_home ==0}
		<span class="navigation-pipe">{$navigationPipe|escape:html:'UTF-8'}</span>
		<a href="{$seller_shop->getBaseURL()}">{$seller_name}</a>
	{/if}
{/if}
