<?php /* Smarty version Smarty-3.1.19, created on 2017-04-28 18:28:58
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/sellerproductdetail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1910940105590389ea3426c7-18460406%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8096e5679c167ae380b0b9383751506e8f3fd4f4' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/sellerproductdetail.tpl',
      1 => 1493122817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1910940105590389ea3426c7-18460406',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'navigationPipe' => 0,
    'base_dir_ssl' => 0,
    'id_product' => 0,
    'isSeller' => 0,
    'is_list_limited' => 0,
    'hasOwnerShip' => 0,
    'product_menu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_590389ea3ad606_65418943',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_590389ea3ad606_65418943')) {function content_590389ea3ad606_65418943($_smarty_tpl) {?><?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true);?>
"><?php echo smartyTranslate(array('s'=>'My Account','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a><span class="navigation-pipe"><?php echo $_smarty_tpl->tpl_vars['navigationPipe']->value;?>
</span><?php echo smartyTranslate(array('s'=>'My Seller Account','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<div id="agile">
<h1><?php echo smartyTranslate(array('s'=>'My Seller Account','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</h1>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/seller_tabs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<br />
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script type="text/javascript">
	var base_dir = "<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
";
	var id_product = <?php echo $_smarty_tpl->tpl_vars['id_product']->value;?>
;
</script>
<?php if (isset($_smarty_tpl->tpl_vars['isSeller']->value)&&$_smarty_tpl->tpl_vars['isSeller']->value&&($_smarty_tpl->tpl_vars['id_product']->value>0||!$_smarty_tpl->tpl_vars['is_list_limited']->value)) {?>
    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/products/product_top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div  class="row" <?php if ($_smarty_tpl->tpl_vars['hasOwnerShip']->value) {?><?php } else { ?>style="display:none;"<?php }?>>
		<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/product_nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<form id="product_form" name="product" action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellerproductdetail',array('id_product'=>$_smarty_tpl->tpl_vars['id_product']->value,'product_menu'=>$_smarty_tpl->tpl_vars['product_menu']->value),true);?>
" 
		enctype="multipart/form-data" method="post" class="form-horizontal agile-col-md-9 agile-col-lg-10 agile-col-xl-10">
		<?php if ($_smarty_tpl->tpl_vars['product_menu']->value==1) {?>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/products/informations.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php } elseif ($_smarty_tpl->tpl_vars['product_menu']->value==2) {?>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/products/images.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php } elseif ($_smarty_tpl->tpl_vars['product_menu']->value==3) {?>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/products/features.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php } elseif ($_smarty_tpl->tpl_vars['product_menu']->value==4) {?>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/products/associations.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php } elseif ($_smarty_tpl->tpl_vars['product_menu']->value==5) {?>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/products/prices.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php } elseif ($_smarty_tpl->tpl_vars['product_menu']->value==6) {?>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/products/quantites.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php } elseif ($_smarty_tpl->tpl_vars['product_menu']->value==7) {?>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/products/combinations.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php } elseif ($_smarty_tpl->tpl_vars['product_menu']->value==8) {?>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/products/virtualproduct.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php } elseif ($_smarty_tpl->tpl_vars['product_menu']->value==9) {?>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/products/shipping.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php } elseif ($_smarty_tpl->tpl_vars['product_menu']->value==10) {?>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/products/attachments.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php }?>

		</form>
	</div>
    <br />
<?php }?>

</div>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/seller_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
