<div class="col-xs-12">
<div class="product_tabs_slider">
	<div class="container">
		<div class="title_block">
			<h2>{l s='In Our store' mod='postabcategory'}</h2>
			<ul class="tabs"> 
				{$count=0}
				{foreach from=$productTabslider item=productTab name=posTabProduct}
					<li class="{if $count==0} active {/if}" rel="tab_{$productTab.id}">
						<h3>{$productTab.name}</h3>
					</li>
					{$count= $count+1}
				{/foreach}	
			</ul>
			{foreach from=$productTabslider item=productTab name=posTabProduct}
				<div class="navi navi_{$productTab.id} tab_{$productTab.id}">
					<a class="prevtab"><i class="icon-chevron-left"></i></a>
					<a class="nexttab"><i class="icon-chevron-right"></i></a>
				</div>
			{/foreach}	
		</div>
		<div class="tab_container"> 
			{foreach from=$productTabslider item=productTab name=posTabProduct}
				<div class="row_edited">
					<div id="tab_{$productTab.id}" class="tab_content">
						<div id="tab_{$productTab.id}_in" class="tabSlide">
							{foreach from=$productTab.productInfo item=product name=myLoop}
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
												<a 	title="{l s='Quick view' mod='postabcategory'}"
													class="quick-view"
													href="{$product.link|escape:'html':'UTF-8'}">
													<i class="icon-external-link"></i>{l s='Quick view' mod='postabcategory'}
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
														title="{l s='Add to compare' mod='postabcategory'}"
														data-id-product="{$product.id_product}">
														<i class="icon-signal"></i>
													</a>
													<a 	title="{l s='Add to wishlist' mod='postabcategory'}"
														class="addToWishlist wishlistProd_{$product.id_product|intval}"
														href="#"
														onclick="WishlistCart('wishlist_block_list', 'add', '{$product.id_product|intval}', false, 1); return false;">
														<i class="icon-heart"></i>
													</a>
													{if ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && $product.minimal_quantity <= 1 && $product.customizable != 2 && !$PS_CATALOG_MODE}
														{if ($product.allow_oosp || $product.quantity > 0)}
															{if isset($static_token)}
																<a class="exclusive ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$product.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='postabcategory'}" data-id-product="{$product.id_product|intval}">
																	<i class="icon-shopping-cart"></i>{l s='Add to cart' mod='postabcategory'}
																</a>
															{else}
																<a class="exclusive ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$product.id_product|intval}', false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='postabcategory'}" data-id-product="{$product.id_product|intval}">
																	<i class="icon-shopping-cart"></i>{l s='Add to cart' mod='postabcategory'}
																</a>
															{/if}
														{else}
															<span class="exclusive ajax_add_to_cart_button btn btn-default disabled">
																<i class="icon-shopping-cart"></i>{l s='Add to cart' mod='postabcategory'}
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
				<script type="text/javascript">
					$(document).ready(function() {
						var posTabProduct = $("#tab_{$productTab.id}_in");
						posTabProduct.owlCarousel({
							items : 5,
							itemsDesktop : [1199,4],
							itemsDesktopSmall : [991,3], 
							itemsTablet: [767,2], 
							itemsMobile : [480,1],
							autoPlay :  false,
							stopOnHover: false,
							addClassActive: true,
						});
						$(".navi_{$productTab.id} .nexttab").click(function(){
							posTabProduct.trigger('owl.next');})
						$(".navi_{$productTab.id} .prevtab").click(function(){
							posTabProduct.trigger('owl.prev');})
					});
				</script>
			{/foreach}	
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".product_tabs_slider .tab_content").hide();
		$(".product_tabs_slider .navi").hide();
		$(".product_tabs_slider .tab_content:first").show(); 
		$(".product_tabs_slider .navi:first").show(); 
		$(".product_tabs_slider ul.tabs li").click(function() {
			$(".product_tabs_slider ul.tabs li").removeClass("active");
			$(this).addClass("active");
			$(".product_tabs_slider .tab_content").hide();
			$(".product_tabs_slider .navi").hide();
			var activeTab = $(this).attr("rel"); 
			$(".product_tabs_slider #"+activeTab).fadeIn(); 
			$(".product_tabs_slider ."+activeTab).fadeIn(); 
		});
	});
</script>