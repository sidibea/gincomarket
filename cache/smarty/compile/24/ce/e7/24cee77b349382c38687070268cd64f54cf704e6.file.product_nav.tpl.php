<?php /* Smarty version Smarty-3.1.19, created on 2017-04-28 18:28:58
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleseller/views//templates/front/products/product_nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1750559756590389ea3f0141-89312565%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '24cee77b349382c38687070268cd64f54cf704e6' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleseller/views//templates/front/products/product_nav.tpl',
      1 => 1493122817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1750559756590389ea3f0141-89312565',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product_menu' => 0,
    'id_product' => 0,
    'product_menus' => 0,
    'menu' => 0,
    'token' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_590389ea424963_99411443',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_590389ea424963_99411443')) {function content_590389ea424963_99411443($_smarty_tpl) {?>﻿<script type="text/javascript">
	var currentmenuid = <?php echo $_smarty_tpl->tpl_vars['product_menu']->value;?>
;
</script>
<?php if ($_smarty_tpl->tpl_vars['id_product']->value>0) {?>
	<div class="productTabs agile-col-md-3 agile-col-lg-2 agile-col-xl-2">
		<div class="list-group">
			<?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product_menus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value) {
$_smarty_tpl->tpl_vars['menu']->_loop = true;
?>
				<a class="list-group-item <?php if ($_smarty_tpl->tpl_vars['product_menu']->value==$_smarty_tpl->tpl_vars['menu']->value['id']) {?>active<?php }?>" id="link-<?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>
"
				href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellerproductdetail',array('id_product'=>$_smarty_tpl->tpl_vars['id_product']->value,'product_menu'=>$_smarty_tpl->tpl_vars['menu']->value['id'],'token'=>$_smarty_tpl->tpl_vars['token']->value),true);?>
"><?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>
</a>
			<?php } ?>
		</div>
	</div>
<?php }?><?php }} ?>
