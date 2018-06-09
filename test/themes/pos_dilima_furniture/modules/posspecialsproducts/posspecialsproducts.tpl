{if count($products) > 0 && $products != null}
	<div {if $page_name == 'index'}class="col-xs-12 col-sm-3"{/if}>
	<div class="pos_special">
		<div class="title_block">
			<h3>{l s='sale off' mod='posspecialsproducts'}</h3>
			<div class="navi">
				<a class="prevtab"><i class="icon-chevron-left"></i></a>
				<a class="nexttab"><i class="icon-chevron-right"></i></a>
			</div>
		</div>
		<div class="block_content">
			<div class="specialSlide">
				{foreach from=$products item=product name=myLoop}
					{if $smarty.foreach.myLoop.index % 3 == 0 || $smarty.foreach.myLoop.first }
						<div class="item_out">
					{/if}
						<div class="item">
							<div class="home_tab_img">
								<a class="product_img_link"	href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url">
									<img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'medium_default')|escape:'html'}"
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
							</div>
							<div class="home_tab_info">
								<a class="product-name" href="{$product.link|escape:'html'}" title="{$product.name|truncate:50:'...'|escape:'htmlall':'UTF-8'}">
									{$product.name|truncate:30:'...'|escape:'htmlall':'UTF-8'}
								</a>
							</div>
						</div>
					{if $smarty.foreach.myLoop.iteration % 3 == 0 || $smarty.foreach.myLoop.last}
						</div>
					{/if}
				{/foreach}
			</div>
		</div>
	</div>
	</div>
	{if $page_name == 'index'}
	<script>
		$(document).ready(function() {
			var specialSlide = $(".specialSlide");
			specialSlide.owlCarousel({
				items : 2,
				itemsDesktop : [1199,2],
				itemsDesktopSmall : [991,1],
				itemsTablet: [767,2],
				itemsMobile : [480,1],
				autoPlay :  false,
				stopOnHover: false,
			});

			// Custom Navigation Events
			$(".pos_special .nexttab").click(function(){
				specialSlide.trigger('owl.next');})
			$(".pos_special .prevtab").click(function(){
				specialSlide.trigger('owl.prev');})
		});
	</script>
	{else}
	<script>
		$(document).ready(function() {
			var specialSlide = $(".specialSlide");
			specialSlide.owlCarousel({
				items : 2,
				itemsDesktop : [1199,2],
				itemsDesktopSmall : [991,1],
				itemsTablet: [767,2],
				itemsMobile : [480,1],
				autoPlay :  false,
				stopOnHover: false,
			});

			// Custom Navigation Events
			$(".pos_special .nexttab").click(function(){
				specialSlide.trigger('owl.next');})
			$(".pos_special .prevtab").click(function(){
				specialSlide.trigger('owl.prev');})
		});
	</script>
	{/if}
{/if}