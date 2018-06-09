{*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if count($categoryProducts) > 0 && $categoryProducts !== false}
<section class="blockproductscategory">
	<div class="title_block">
		<h3>
		{if $categoryProducts|@count == 1}
			{l s='%s other product in the same category:' sprintf=[$categoryProducts|@count] mod='productscategory'}
		{else}
			{l s='%s other products in the same category:' sprintf=[$categoryProducts|@count] mod='productscategory'}
		{/if}
		</h3>
		<div class="navi">
			<a class="prevtab"><i class="icon-chevron-left"></i></a>
			<a class="nexttab"><i class="icon-chevron-right"></i></a>
		</div>
	</div>
	<div class="block_content">
		<div class="row_edited">
		<div class="productscategory">
		{foreach from=$categoryProducts item='product' name=categoryProduct}
			{if $smarty.foreach.myLoop.index % 1 == 0 || $smarty.foreach.myLoop.first }
						<div class="item_out">
					{/if}
						<div class="item">
							<div class="home_tab_img">
								<a class="product_img_link"	href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url">
									<img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_default')|escape:'html'}"
									alt="{$product.legend|escape:'html':'UTF-8'}"
									class="img-responsive"/>
								</a>
								{if (!$PS_CATALOG_MODE && ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
									{if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}
										{if isset($product.specific_prices) && $product.specific_prices && isset($product.specific_prices.reduction) && $product.specific_prices.reduction > 0}
											{if $product.specific_prices.reduction_type == 'percentage'}
												<span class="price-percent-reduction">-{$product.specific_prices.reduction * 100}%</span>
											{/if}
										{/if}
									{/if}
								{/if}
								{if isset($quick_view) && $quick_view}
									<a 	title="{l s='Quick view' mod='posbestsellers'}"
										class="quick-view"
										href="{$product.link|escape:'html':'UTF-8'}"
										rel="{$product.link|escape:'html':'UTF-8'}">
										<i class="icon-external-link"></i>{l s='Quick view' mod='posbestsellers'}
									</a>
								{/if}
							</div>
							<div class="home_tab_info">
								<a class="product-name" href="{$product.link|escape:'html'}" title="{$product.name|truncate:50:'...'|escape:'htmlall':'UTF-8'}">
									{$product.name|escape:'htmlall':'UTF-8'}
								</a>
								<div class="comment_box">
									{hook h='displayProductListReviews' product=$product}
								</div>
								<div class="price-box">
									<meta itemprop="priceCurrency" content="{$priceDisplay}" />
									<span class="price">{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}</span>
									{if isset($product.specific_prices) && $product.specific_prices && isset($product.specific_prices.reduction) && $product.specific_prices.reduction > 0}
										<span class="old-price product-price hidden">
											{displayWtPrice p=$product.price_without_reduction}
										</span>
									{/if}
								</div>
								<div class="btn_content">
										<a class="add_to_compare" 
											href="{$product.link|escape:'html':'UTF-8'}" 
											title="{l s='Add to compare' mod='posbestsellers'}"
											data-id-product="{$product.id_product}">
											<i class="icon-signal"></i>
										</a>
										<a 	title="{l s='Add to wishlist' mod='posbestsellers'}"
											class="addToWishlist wishlistProd_{$product.id_product|intval}"
											href="#"
											onclick="WishlistCart('wishlist_block_list', 'add', '{$product.id_product|intval}', false, 1); return false;">
											<i class="icon-heart"></i>
										</a>
										{if ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && $product.minimal_quantity <= 1 && $product.customizable != 2 && !$PS_CATALOG_MODE}
											{if ($product.allow_oosp || $product.quantity > 0)}
												{if isset($static_token)}
													<a class="exclusive ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$product.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='posbestsellers'}" data-id-product="{$product.id_product|intval}">
														<i class="icon-shopping-cart"></i>{l s='Add to cart' mod='posbestsellers'}
													</a>
												{else}
													<a class="exclusive ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$product.id_product|intval}', false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='posbestsellers'}" data-id-product="{$product.id_product|intval}">
														<i class="icon-shopping-cart"></i>{l s='Add to cart' mod='posbestsellers'}
													</a>
												{/if}
											{else}
												<span class="exclusive ajax_add_to_cart_button btn btn-default disabled">
													<i class="icon-shopping-cart"></i>{l s='Add to cart' mod='posbestsellers'}
												</span>
											{/if}
										{/if}
								</div>
							</div>
						</div>
					{if $smarty.foreach.myLoop.iteration % 1 == 0 || $smarty.foreach.myLoop.last}
						</div>
					{/if}
		{/foreach}
		</div>
	</div>
	</div>
</section>
{/if}
