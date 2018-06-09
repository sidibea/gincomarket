<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 03:42:39
         compiled from "/home/abdouhanne/www/modules/agilemultipleshop/views/templates/front/sellerlocation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10454989835b19fb2f3a3eb3-08334996%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '578fc83d36d61d1d1447c445df5803bdca8a923a' => 
    array (
      0 => '/home/abdouhanne/www/modules/agilemultipleshop/views/templates/front/sellerlocation.tpl',
      1 => 1495227207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10454989835b19fb2f3a3eb3-08334996',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'seller_locations4page' => 0,
    'location_level4page' => 0,
    'link' => 0,
    'location' => 0,
    'id_location' => 0,
    'nb_products' => 0,
    'products' => 0,
    'warehouse_vars' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b19fb2f3f2060_97445736',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b19fb2f3f2060_97445736')) {function content_5b19fb2f3f2060_97445736($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<script language="javascript" type="text/javascript">
    function changesellerlocation() {
        var url = $("#id_location").val();
        window.location.href = url;
    }
</script>

<H2><?php echo smartyTranslate(array('s'=>'Shop By Location','mod'=>'agilemultipleshop'),$_smarty_tpl);?>
</H2>
<div>
	<?php if ($_smarty_tpl->tpl_vars['seller_locations4page']->value!==false) {?>
		<div class="form-group selector1">
			<select name="id_location" id="id_location" style="width:170px;height:24px;margin:8px;padding:2px" onchange="changesellerlocation()">
				<option value="<?php echo $_smarty_tpl->tpl_vars['link']->value->getSellerLocationLink('',((string)$_smarty_tpl->tpl_vars['location_level4page']->value));?>
"><?php echo smartyTranslate(array('s'=>'All location','mod'=>'agilemultipleshop'),$_smarty_tpl);?>
</option>
				<?php  $_smarty_tpl->tpl_vars['location'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['location']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['seller_locations4page']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['location']->key => $_smarty_tpl->tpl_vars['location']->value) {
$_smarty_tpl->tpl_vars['location']->_loop = true;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['link']->value->getSellerLocationLink($_smarty_tpl->tpl_vars['location']->value['id'],$_smarty_tpl->tpl_vars['location_level4page']->value);?>
" <?php if (isset($_smarty_tpl->tpl_vars['id_location']->value)&&$_smarty_tpl->tpl_vars['id_location']->value==strtolower($_smarty_tpl->tpl_vars['location']->value['id'])) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['location']->value['name'];?>
</option>
				<?php } ?>
			</select>
		</div>
	<?php } else { ?>
		<p><?php echo smartyTranslate(array('s'=>'No sellers found in this location','mod'=>'agilemultipleshop'),$_smarty_tpl);?>
</p>
	<?php }?>
</div>

<div>
	<?php if ($_smarty_tpl->tpl_vars['nb_products']->value>1) {?><?php echo smartyTranslate(array('s'=>'There are','mod'=>'agilemultipleshop'),$_smarty_tpl);?>
 <span class="bold"><?php echo $_smarty_tpl->tpl_vars['nb_products']->value;?>
 <?php echo smartyTranslate(array('s'=>'products.','mod'=>'agilemultipleshop'),$_smarty_tpl);?>
</span><?php } else { ?><?php echo smartyTranslate(array('s'=>'There is','mod'=>'agilemultipleshop'),$_smarty_tpl);?>
 <span class="bold"><?php echo $_smarty_tpl->tpl_vars['nb_products']->value;?>
 <?php echo smartyTranslate(array('s'=>'product.','mod'=>'agilemultipleshop'),$_smarty_tpl);?>
</span><?php }?>
</div>

<?php if ($_smarty_tpl->tpl_vars['products']->value) {?>
	<div class="content_sortPagiBar">
		<div class="sortPagiBar clearfix">
			<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./product-sort.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

			<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./product-compare.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

			<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./nbr-product-page.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		</div>
	</div>
    <div id="view_way" class="<?php if (isset($_smarty_tpl->tpl_vars['warehouse_vars']->value['product_view'])&&$_smarty_tpl->tpl_vars['warehouse_vars']->value['product_view']==1) {?>list_view<?php } else { ?> grid_view<?php }?>">               
				<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./product-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('products'=>$_smarty_tpl->tpl_vars['products']->value), 0);?>

	</div>
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php }?>
<?php }} ?>
