<div class="col-xs-12">
<div class="postabcategory1">
	<div class="mod_header">
		<h3>{l s='Popular categories' mod='postabcategory'}</h3>
		{foreach from=$productCates item=productCate name=postabcategory} 
			<div class="navi navi_{$productCate.id} tab1_{$productCate.id}">
				<a class="prevtab"><i class="icon-chevron-left"></i></a>
				<a class="nexttab"><i class="icon-chevron-right"></i></a>
			</div>
		{/foreach}	
	</div>
		<div class="title_block">
			<div class="tabs"> 
				{$count=0}
				{foreach from=$productCates item=productCate name=postabcategory}
					<div class="item {if $count==0} active {/if}" rel="tab1_{$productCate.id}">
						<h3 {if $productCate.html != ''}style="background-image:url('{$productCate.html}');"{/if}>
						
						{$productCate.name}
						</h3>
					</div>
					{$count= $count+1}
				{/foreach}	
			</div>
			<div class="navi_tab hidden">
				<a class="prevtab"><i class="icon-angle-left"></i></a>
				<a class="nexttab"><i class="icon-angle-right"></i></a>
			</div>
		</div>
		<div class="tab_container"> 
			{foreach from=$productCates item=productCate name=postabcategory} 
				<div class="row_edited">
					<div id="tab1_{$productCate.id}" class="tab_content">
						<div id="tab1_{$productCate.id}_in" class="tabSlide">
							{foreach from=$productCate.product item=product name=postabcategory}
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
						var posTabCategory{$productCate.id} = $(".postabcategory1 #tab1_{$productCate.id}_in");
						posTabCategory{$productCate.id}.owlCarousel({
							items : 5,
							itemsDesktop : [1199,4],
							itemsDesktopSmall : [991,3], 
							itemsTablet: [767,2], 
							itemsMobile : [480,1],
							autoPlay :  false,
							stopOnHover: false,
				addClassActive: true,
						});
						$(".postabcategory1 .navi_{$productCate.id} .nexttab").click(function(){
							posTabCategory{$productCate.id}.trigger('owl.next');})
						$(".postabcategory1 .navi_{$productCate.id} .prevtab").click(function(){
							posTabCategory{$productCate.id}.trigger('owl.prev');})
					});
				</script>
			{/foreach}	
		</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".postabcategory1 .tab_content").hide();
		$(".postabcategory1 .navi").hide();
		$(".postabcategory1 .tab_content:first").show(); 
		$(".postabcategory1 .navi:first").show(); 
		$(".postabcategory1 .title_block .tabs .item").click(function() {
			$(".postabcategory1 .title_block .tabs .item").removeClass("active");
			$(this).addClass("active");
			$(".postabcategory1 .tab_content").hide();
			$(".postabcategory1 .navi").hide();
			var activeTab = $(this).attr("rel"); 
			$(".postabcategory1 #"+activeTab).fadeIn(); 
			$(".postabcategory1 ."+activeTab).fadeIn(); 
		});
		
		var postab = $(".postabcategory1 .title_block .tabs");
		postab.owlCarousel({
			items : 6,
			itemsDesktop : [1199,4],
			itemsDesktopSmall : [991,3], 
			itemsTablet: [767,2], 
			itemsMobile : [480,1],
			autoPlay :  false,
			stopOnHover: false,
		});
		$(".postabcategory1 .navi_tab .nexttab").click(function(){
			postab.trigger('owl.next');})
		$(".postabcategory1 .navi_tab .prevtab").click(function(){
			postab.trigger('owl.prev');})
		
		if ($(window).width() >= 1200){
			$('.postabcategory1 .tab_container .item').hover(function(){
				$(this).find('.line1').addClass('animated fadeInDown');
				$(this).find('.line2').addClass('animated fadeInUp');
			},function(){
				$(this).find('.line1').removeClass('animated fadeInDown');
				$(this).find('.line2').removeClass('animated fadeInUp');
			});
		};
	});
</script>