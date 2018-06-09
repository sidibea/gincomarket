<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:39:20
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleshop/views/templates/hook/hookblocksellers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:688558045901f488674672-92007383%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '26745b0be0f09f61ef9418fa7bae228eb4850e48' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleshop/views/templates/hook/hookblocksellers.tpl',
      1 => 1493122873,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '688558045901f488674672-92007383',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'asp_sellers' => 0,
    'asp_sellers_block_style' => 0,
    'asc_seller' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5901f48869be47_23701840',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f48869be47_23701840')) {function content_5901f48869be47_23701840($_smarty_tpl) {?>
<script language="javascript" type="text/javascript">
<!--
    function shopbyseller_block_selectedchanged() {
        var url = $("#shop_by_seller_list").val();
        window.location.href = url;
    }
-->
</script>

<!-- MODULE Agile Multiple Shops -->
<div id="manufacturers_block_left" class="block blockmanufacturer">
	<h4><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAgileSellersLink('all');?>
" title="<?php echo smartyTranslate(array('s'=>'Shop by Seller','mod'=>'agilemultipleshop'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Shop by Seller','mod'=>'agilemultipleshop'),$_smarty_tpl);?>
</a></h4>
	<div class="block_content list-block">
	<?php if ($_smarty_tpl->tpl_vars['asp_sellers']->value!==false) {?>
		<?php if ($_smarty_tpl->tpl_vars['asp_sellers_block_style']->value==1) {?>
			<div class="form-group selector1">
				<select name="sellers" id="shop_by_seller_list" class="form-control" onchange="shopbyseller_block_selectedchanged()">
					<option value=""><?php echo smartyTranslate(array('s'=>'Please Choose','mod'=>'agilemultipleshop'),$_smarty_tpl);?>
</option>
					<?php  $_smarty_tpl->tpl_vars['asc_seller'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['asc_seller']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['asp_sellers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['asc_seller']->key => $_smarty_tpl->tpl_vars['asc_seller']->value) {
$_smarty_tpl->tpl_vars['asc_seller']->_loop = true;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAgileSellerLink($_smarty_tpl->tpl_vars['asc_seller']->value['id_seller'],$_smarty_tpl->tpl_vars['asc_seller']->value['company']);?>
"><?php echo $_smarty_tpl->tpl_vars['asc_seller']->value['company'];?>
</option>
					<?php } ?>
				</select>
			</div>
		<?php } else { ?>
			<ul>
				<?php  $_smarty_tpl->tpl_vars['asc_seller'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['asc_seller']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['asp_sellers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['asc_seller']->key => $_smarty_tpl->tpl_vars['asc_seller']->value) {
$_smarty_tpl->tpl_vars['asc_seller']->_loop = true;
?>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getAgileSellerLink($_smarty_tpl->tpl_vars['asc_seller']->value['id_seller'],$_smarty_tpl->tpl_vars['asc_seller']->value['company']);?>
" title="<?php echo $_smarty_tpl->tpl_vars['asc_seller']->value['company'];?>
"><?php echo $_smarty_tpl->tpl_vars['asc_seller']->value['company'];?>
</a></li>
				<?php } ?>
			</ul>
		<?php }?>
	<?php } else { ?>
		<p><?php echo smartyTranslate(array('s'=>'No sellers at this time','mod'=>'agilemultipleshop'),$_smarty_tpl);?>
</p>
	<?php }?>
	</div>
</div>
<!-- /MODULE Agile Sellers Products --><?php }} ?>
