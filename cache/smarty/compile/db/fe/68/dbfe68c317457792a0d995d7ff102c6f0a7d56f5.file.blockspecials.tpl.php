<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:35:12
         compiled from "/home/abdouhanne/www/themes/supershop/modules/blockspecials/blockspecials.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12109831235b1a5be04a8a94-35413820%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dbfe68c317457792a0d995d7ff102c6f0a7d56f5' => 
    array (
      0 => '/home/abdouhanne/www/themes/supershop/modules/blockspecials/blockspecials.tpl',
      1 => 1493588702,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12109831235b1a5be04a8a94-35413820',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'current_option' => 0,
    'link' => 0,
    'special' => 0,
    'PS_CATALOG_MODE' => 0,
    'priceDisplay' => 0,
    'specific_prices' => 0,
    'priceWithoutReduction_tax_excl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1a5be0d85844_19254948',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5be0d85844_19254948')) {function content_5b1a5be0d85844_19254948($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/abdouhanne/www/tools/smarty/plugins/modifier.date_format.php';
?>

<!-- MODULE Block specials -->
<?php $_smarty_tpl->tpl_vars["current_option"] = new Smarty_variable(Configuration::get('OVIC_CURRENT_OPTION'), null, 0);?>
<div id="special_block_right" class="block<?php if (isset($_smarty_tpl->tpl_vars['current_option']->value)&&$_smarty_tpl->tpl_vars['current_option']->value==2) {?> products_block_option2<?php }?><?php if (isset($_smarty_tpl->tpl_vars['current_option']->value)&&$_smarty_tpl->tpl_vars['current_option']->value==5) {?> products_block_option5<?php }?>">
    <?php if (isset($_smarty_tpl->tpl_vars['current_option']->value)&&$_smarty_tpl->tpl_vars['current_option']->value==2) {?>
        <h4 class="title_block_option2">
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('prices-drop'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Special Product','mod'=>'blockspecials'),$_smarty_tpl);?>
">
                <?php echo smartyTranslate(array('s'=>'Special Product','mod'=>'blockspecials'),$_smarty_tpl);?>

            </a>
        </h4>
    <?php } elseif (($_smarty_tpl->tpl_vars['current_option']->value)&&$_smarty_tpl->tpl_vars['current_option']->value==5) {?>
        <h4 class="title_block_option5">
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('prices-drop'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Special Product','mod'=>'blockspecials'),$_smarty_tpl);?>
">
                <?php echo smartyTranslate(array('s'=>'Special Product','mod'=>'blockspecials'),$_smarty_tpl);?>

            </a>
        </h4>
    <?php } else { ?>
	<p class="title_block">
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('prices-drop'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Specials','mod'=>'blockspecials'),$_smarty_tpl);?>
">
            <?php echo smartyTranslate(array('s'=>'Specials','mod'=>'blockspecials'),$_smarty_tpl);?>

        </a>
    </p>
    <?php }?>
	<div class="products-block">
    <?php if ($_smarty_tpl->tpl_vars['special']->value) {?>
        <?php if (isset($_smarty_tpl->tpl_vars['current_option']->value)&&($_smarty_tpl->tpl_vars['current_option']->value==2||$_smarty_tpl->tpl_vars['current_option']->value==5)) {?>
            <ul class="product_list grid">
        <?php } else { ?>
            <ul>
        <?php }?>
        	<li class="clearfix">
            	<div class="product-container" itemscope itemtype="http://schema.org/Product">
                    <div class="left-block">
    					<div class="product-image-container">
    						<a class="product_img_link"	href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['special']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['special']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" itemprop="url">
                                <img class="replace-2x img-responsive" 
                                    src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['special']->value['link_rewrite'],$_smarty_tpl->tpl_vars['special']->value['id_image'],'home_default'), ENT_QUOTES, 'UTF-8', true);?>
" 
                                    alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['special']->value['legend'], ENT_QUOTES, 'UTF-8', true);?>
" 
                                    title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['special']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" />
                            </a>
                        </div>
                    </div>    
                    <div class="right-block">
                        <h5>
                            <a class="product-name" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['special']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['special']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
">
                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['special']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

                            </a>
                        </h5>
                        <div class="content_price">
                        	<?php if (!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
                            	<span class="price product-price">
                                    <?php if (!$_smarty_tpl->tpl_vars['priceDisplay']->value) {?>
                                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0][0]->displayWtPrice(array('p'=>$_smarty_tpl->tpl_vars['special']->value['price']),$_smarty_tpl);?>
<?php } else { ?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0][0]->displayWtPrice(array('p'=>$_smarty_tpl->tpl_vars['special']->value['price_tax_exc']),$_smarty_tpl);?>

                                    <?php }?>
                                </span>
                                 <?php if ($_smarty_tpl->tpl_vars['special']->value['specific_prices']) {?>
                                    <?php $_smarty_tpl->tpl_vars['specific_prices'] = new Smarty_variable($_smarty_tpl->tpl_vars['special']->value['specific_prices'], null, 0);?>
                                    <?php if ($_smarty_tpl->tpl_vars['specific_prices']->value['reduction_type']=='percentage'&&($_smarty_tpl->tpl_vars['specific_prices']->value['from']==$_smarty_tpl->tpl_vars['specific_prices']->value['to']||(smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S')<=$_smarty_tpl->tpl_vars['specific_prices']->value['to']&&smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S')>=$_smarty_tpl->tpl_vars['specific_prices']->value['from']))) {?>
                                        <span class="price-percent-reduction">-<?php echo $_smarty_tpl->tpl_vars['specific_prices']->value['reduction']*floatval(100);?>
%<span><?php echo smartyTranslate(array('s'=>'OFF','mod'=>'blockspecials'),$_smarty_tpl);?>
</span></span>
                                    <?php }?>
                                <?php }?>
                                 <span class="old-price product-price">
                                    <?php if (!$_smarty_tpl->tpl_vars['priceDisplay']->value) {?>
                                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0][0]->displayWtPrice(array('p'=>$_smarty_tpl->tpl_vars['special']->value['price_without_reduction']),$_smarty_tpl);?>
<?php } else { ?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayWtPrice'][0][0]->displayWtPrice(array('p'=>$_smarty_tpl->tpl_vars['priceWithoutReduction_tax_excl']->value),$_smarty_tpl);?>

                                    <?php }?>
                                </span>
                            <?php }?>
                        </div>
                    </div>
                    </div>
            </li>
		</ul>
        <?php if (isset($_smarty_tpl->tpl_vars['current_option']->value)&&($_smarty_tpl->tpl_vars['current_option']->value==2||$_smarty_tpl->tpl_vars['current_option']->value==5)) {?>
        
        <?php } else { ?>
            <div>
    			<a 
                class="btn btn-default button button-small" 
                href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('prices-drop'), ENT_QUOTES, 'UTF-8', true);?>
" 
                title="<?php echo smartyTranslate(array('s'=>'All specials','mod'=>'blockspecials'),$_smarty_tpl);?>
">
                    <span><?php echo smartyTranslate(array('s'=>'All specials','mod'=>'blockspecials'),$_smarty_tpl);?>
<i class="icon-chevron-right right"></i></span>
                </a>
    		</div>
        <?php }?>
		
        
    <?php } else { ?>
		<div><?php echo smartyTranslate(array('s'=>'No specials at this time.','mod'=>'blockspecials'),$_smarty_tpl);?>
</div>
    <?php }?>
	</div>
</div>
<!-- /MODULE Block specials --><?php }} ?>
