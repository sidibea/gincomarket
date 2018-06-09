<!-- Block user information module NAV  -->
<div class="col-xs-12 col-sm-9">
	<div class="header_user_info">
		{if $is_logged}
			<a href="{$link->getPageLink('my-account', true)|escape:'html'}" title="{l s='View my customer account' mod='blockuserinfo'}" rel="nofollow">
				<i class="icon-user"></i>{l s='My Account' mod='blockuserinfo'}
			</a>
			<a href="{$link->getModuleLink('blockwishlist', 'mywishlist', array(), true)|escape:'html':'UTF-8'}" title="{l s='My wishlists' mod='blockuserinfo'}" rel="nofollow">
				<i class="icon-heart-o"></i>{l s='Wishlist' mod='blockuserinfo'}
			</a>
			<a class="logout" href="{$link->getPageLink('index', true, NULL, "mylogout")|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Log me out' mod='blockuserinfo'}">
				<i class="icon-key"></i>{l s='Sign out' mod='blockuserinfo'}
			</a>
		{else}
			<a class="login" href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Log in to your customer account' mod='blockuserinfo'}">
				<i class="icon-key"></i>{l s='Sign in' mod='blockuserinfo'}
			</a>
		{/if}
		<a href="{$link->getPageLink('products-comparison')|escape:'html':'UTF-8'}" title="{l s='Compare' mod='blockuserinfo'}" rel="nofollow" class="bt_compare{if isset($paginationId)}_{$paginationId}{/if}">
			<i class="icon-signal"></i>{l s='Compare' mod='blockuserinfo'}
		</a>
	</div>
</div>
<!-- /Block usmodule NAV -->
