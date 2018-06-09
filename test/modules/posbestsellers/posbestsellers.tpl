{if count($best_sellers) > 0 && $best_sellers != null}
	<div class="col-xs-12">
	<div class="pos_bestseller">
		<div class="title_block">
			<h3>{l s='BESTSELLER' mod='posbestsellers'}</h3>
			<div class="navi">
				<a class="prevtab"><i class="icon-chevron-left"></i></a>
				<a class="nexttab"><i class="icon-chevron-right"></i></a>
			</div>
		</div>
		<div class="block_content">
		<div class="row_edited">
			<div class="bestsellerSlide">
				{foreach from=$best_sellers item=product name=myLoop}
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
										href="{$product.link|escape:'html':'UTF-8'}">
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
	</div>
	</div>
	<script>
		$(document).ready(function() {
			var bestsellerSlide = $(".bestsellerSlide");
			bestsellerSlide.owlCarousel({
				items : 5,
				itemsDesktop : [1199,4],
				itemsDesktopSmall : [991,3],
				itemsTablet: [767,2],
				itemsMobile : [480,1],
				autoPlay :  false,
				stopOnHover: false,
				addClassActive: true,
			});

			// Custom Navigation Events
			$(".pos_bestseller .nexttab").click(function(){
				bestsellerSlide.trigger('owl.next');})
			$(".pos_bestseller .prevtab").click(function(){
				bestsellerSlide.trigger('owl.prev');})
		});
	</script>
{/if}