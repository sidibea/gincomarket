<?php /* Smarty version Smarty-3.1.19, created on 2017-04-30 16:44:55
         compiled from "/home/abdouhanne/www/pr/modules/groupcategory/views/templates/hook/product-list.option1.default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1108161431590614876be9f8-21802533%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e4954a770ebd90f7bc6462910878f49730b075da' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/groupcategory/views/templates/hook/product-list.option1.default.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1108161431590614876be9f8-21802533',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'products' => 0,
    'module_id' => 0,
    'feature' => 0,
    'item_id' => 0,
    'active' => 0,
    'product' => 0,
    'currency' => 0,
    'homeSize' => 0,
    'link' => 0,
    'PS_CATALOG_MODE' => 0,
    'restricted_country_mode' => 0,
    'priceDisplay' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59061487783c26_35445707',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59061487783c26_35445707')) {function content_59061487783c26_35445707($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['products']->value)&&count($_smarty_tpl->tpl_vars['products']->value)>0) {?>
	<div id="product-list-<?php echo $_smarty_tpl->tpl_vars['module_id']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['feature']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['item_id']->value;?>
" class="lazy-carousel check-active <?php if (isset($_smarty_tpl->tpl_vars['active']->value)&&$_smarty_tpl->tpl_vars['active']->value=='1') {?>active<?php }?> tab-content-<?php echo $_smarty_tpl->tpl_vars['module_id']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['feature']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['item_id']->value;?>
">
	<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>		
	    <div itemtype="http://schema.org/Product" itemscope="" class="group-category-product">
	        <?php if (isset($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction'])&&$_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction']) {?>
	            <?php if ($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction_type']=='percentage') {?>
	                <div class="saleoff-bg text-center"><div><?php echo $_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction']*100;?>
%</div><span><?php echo smartyTranslate(array('s'=>'OFF','mod'=>'groupcategory'),$_smarty_tpl);?>
</span></div>
	            <?php } else { ?>
	                <div class="saleoff-bg text-center"><div>-<?php echo intval($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction']);?>
</div><span><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</span></div>
	            
	            <?php }?>
	        <?php }?>
	        <div class="group-category-product-avatar avatar">
	            <a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
" itemprop="url">
	                <img class="owl-lazy img-responsive" src="http://placehold.it/<?php if (isset($_smarty_tpl->tpl_vars['homeSize']->value)) {?><?php echo $_smarty_tpl->tpl_vars['homeSize']->value['width'];?>
x<?php echo $_smarty_tpl->tpl_vars['homeSize']->value['height'];?>
<?php }?>" <?php if (isset($_smarty_tpl->tpl_vars['homeSize']->value)) {?> width="<?php echo $_smarty_tpl->tpl_vars['homeSize']->value['width'];?>
" height="<?php echo $_smarty_tpl->tpl_vars['homeSize']->value['height'];?>
"<?php }?> itemprop="image" title="<?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
" data-src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home_default'), ENT_QUOTES, 'UTF-8', true);?>
" />
	            </a>
	            <div class="main-quick-view">
	                <div class="div-quick-view">
	                    <a onclick="javascript: WishlistCart('wishlist_block_list', 'add', '<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
', false, 1); return false;" data-rel="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" href="javascript:void(0)" class="addToWishlist" title="<?php echo smartyTranslate(array('s'=>'Add to Wishlist','mod'=>'groupcategory'),$_smarty_tpl);?>
"><i class="icon-heart-empty"></i></a>
	                    <?php if (isset($_smarty_tpl->tpl_vars['product']->value['isCompare'])&&$_smarty_tpl->tpl_vars['product']->value['isCompare']=='1') {?>
	                    <a title="<?php echo smartyTranslate(array('s'=>'Add to Compare','mod'=>'groupcategory'),$_smarty_tpl);?>
" data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" class="add_to_compare compare-checked"><i class="icon-toggle-on"></i></a>
	                    <?php } else { ?>
	                    <a title="<?php echo smartyTranslate(array('s'=>'Add to Compare','mod'=>'groupcategory'),$_smarty_tpl);?>
" data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" class="add_to_compare"><i class="icon-toggle-on"></i></a>
	                    <?php }?>
	                    <a rel="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" title="<?php echo smartyTranslate(array('s'=>'Quick view'),$_smarty_tpl);?>
" href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" class="quick-view item-quick-view"><i class="icon-search"></i></a>
	                </div>
	                <?php if (!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
	                <div class="add-to-cart">
	                    <?php if ($_smarty_tpl->tpl_vars['product']->value['quantity']>0) {?>
	                        <a data-id-product="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" title="<?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'groupcategory'),$_smarty_tpl);?>
" rel="nofollow" href="javascript:void(0)" class="ajax_add_to_cart_button"><i class="icon-shopping-cart"></i>&nbsp;<span><?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'groupcategory'),$_smarty_tpl);?>
</span></a>
	                    <?php } else { ?>
	                        <a title="<?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'groupcategory'),$_smarty_tpl);?>
" rel="nofollow" href="javascript:void(0)" class="quantity-empty"><i class="icon-shopping-cart"></i>&nbsp;<span><?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'groupcategory'),$_smarty_tpl);?>
</span></a>
	                    <?php }?>
	                </div>
	                <?php }?>
	            </div>
	        </div>
	        <div class="mod-product-name">
	            <a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</a>
	        </div>
	        <?php if (!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
	        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="product-price">
				<?php if (isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price']&&!isset($_smarty_tpl->tpl_vars['restricted_country_mode']->value)) {?>
					<meta itemprop="priceCurrency" content="<?php echo $_smarty_tpl->tpl_vars['currency']->value->iso_code;?>
" />
					  <span itemprop="price" class="product-price-new">
							<?php if (!$_smarty_tpl->tpl_vars['priceDisplay']->value) {?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price']),$_smarty_tpl);?>
<?php } else { ?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_tax_exc']),$_smarty_tpl);?>
<?php }?>
					  </span>
					<?php if (isset($_smarty_tpl->tpl_vars['product']->value['specific_prices'])&&$_smarty_tpl->tpl_vars['product']->value['specific_prices']&&isset($_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction'])&&$_smarty_tpl->tpl_vars['product']->value['specific_prices']['reduction']>0) {?>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"old_price"),$_smarty_tpl);?>

						<span class="product-price-old">
							<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0][0]->displayWtPrice(array('p'=>$_smarty_tpl->tpl_vars['product']->value['price_without_reduction']),$_smarty_tpl);?>

						</span>
						<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayProductPriceBlock",'id_product'=>$_smarty_tpl->tpl_vars['product']->value['id_product'],'type'=>"old_price"),$_smarty_tpl);?>
										
					<?php }?>
	
					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"price"),$_smarty_tpl);?>

					<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayProductPriceBlock",'product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"unit_price"),$_smarty_tpl);?>

				<?php }?>
			</div>
	        <?php }?>
	        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayProductListReviews','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl);?>
        
    	</div>
	<?php } ?>
	</div>
<?php } else { ?>
	<div id="product-list-<?php echo $_smarty_tpl->tpl_vars['module_id']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['feature']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['item_id']->value;?>
" class="lazy-carousel check-active <?php if (isset($_smarty_tpl->tpl_vars['active']->value)&&$_smarty_tpl->tpl_vars['active']->value=='1') {?>active<?php }?> tab-content-<?php echo $_smarty_tpl->tpl_vars['module_id']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['feature']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['item_id']->value;?>
">
		<div style="padding: 60px 0"><?php echo smartyTranslate(array('s'=>'Sorry! There are no products','mod'=>'groupcategory'),$_smarty_tpl);?>
</div>		
	</div>
<?php }?>
<?php }} ?>
