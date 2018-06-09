<?php /* Smarty version Smarty-3.1.19, created on 2017-04-28 10:38:35
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/sellerproducts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:161190150959031bab2b1c95-56098365%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22e98535125ad86bf7b174b20da771cd76c36ccd' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/sellerproducts.tpl',
      1 => 1493122817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '161190150959031bab2b1c95-56098365',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'navigationPipe' => 0,
    'isSeller' => 0,
    'agile_orderby' => 0,
    'agile_orderway' => 0,
    'agile_filterby' => 0,
    'agile_filterval' => 0,
    'products' => 0,
    'is_apprpved_required' => 0,
    'product' => 0,
    'detail_url' => 0,
    'base_dir_ssl' => 0,
    'def_id_currency' => 0,
    'psize' => 0,
    'pnum' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59031bab388f98_40388895',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59031bab388f98_40388895')) {function content_59031bab388f98_40388895($_smarty_tpl) {?><?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true);?>
"><?php echo smartyTranslate(array('s'=>'My Account','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a><span class="navigation-pipe"><?php echo $_smarty_tpl->tpl_vars['navigationPipe']->value;?>
</span><?php echo smartyTranslate(array('s'=>'My Seller Account','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<h1><?php echo smartyTranslate(array('s'=>'My Seller Account','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</h1>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/seller_tabs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php if (isset($_smarty_tpl->tpl_vars['isSeller']->value)&&$_smarty_tpl->tpl_vars['isSeller']->value) {?>
<div id="agile">
<div class="block-center clearfix" id="block-history">
    <div class="row">
		<div class="agile-col-sm-2">
		<a class="agile-btn agile-btn-default" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellerproductdetail',array('id_product'=>0),true);?>
">
				<i class="icon-plus-sign"></i>&nbsp;<?php echo smartyTranslate(array('s'=>'Add New','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

		</a>
		</div>
		<div class="agile-col-sm-5">
			<div class="row">
				<div class="agile-col-sm-3">
					<?php echo smartyTranslate(array('s'=>'Order By:','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

				</div>
				<div class="agile-col-sm-6">
					<select name="agile_orderby" id="agile_orderby">
						<option value="p.id_product" <?php if ($_smarty_tpl->tpl_vars['agile_orderby']->value=='p.id_product') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'ID','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
						<option value="pl.name" <?php if ($_smarty_tpl->tpl_vars['agile_orderby']->value=='pl.name') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Product Name','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
						<option value="cl.name" <?php if ($_smarty_tpl->tpl_vars['agile_orderby']->value=='cl.name') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Category Name','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
						<option value="p.active" <?php if ($_smarty_tpl->tpl_vars['agile_orderby']->value=='p.active') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Enabled','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
						<option value="po.approved" <?php if ($_smarty_tpl->tpl_vars['agile_orderby']->value=='po.approved') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Approved','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
						<option value="p.date_add" <?php if ($_smarty_tpl->tpl_vars['agile_orderby']->value=='p.date_add') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Date Added','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
					</select>
				</div>
				<div class="agile-col-sm-3">
					<select id="agile_orderway"><?php echo $_smarty_tpl->tpl_vars['agile_orderway']->value;?>

						<option value="ASC" <?php if ($_smarty_tpl->tpl_vars['agile_orderway']->value=='ASC') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Ascending','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
						<option value="DESC" <?php if ($_smarty_tpl->tpl_vars['agile_orderway']->value=='DESC') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Descedning','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
					</select>
				</div>
			</div>
		</div>
		<div class="agile-col-sm-1"></div>

		<div class="agile-col-sm-4">
			<div class="row">
				<div class="agile-col-sm-3">
					<?php echo smartyTranslate(array('s'=>'Filter By','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

				</div>
				<div class="form-group agile-col-sm-5">
					<select name="agile_filterby" id="agile_filterby">
						<option value=""></option>
						<option value="p.id_product" <?php if ($_smarty_tpl->tpl_vars['agile_filterby']->value=='p.id_product') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'ID =','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
						<option value="pl.name" <?php if ($_smarty_tpl->tpl_vars['agile_filterby']->value=='pl.name') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Product Name like','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
						<option value="cl.name" <?php if ($_smarty_tpl->tpl_vars['agile_filterby']->value=='cl.name') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Category Name like','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
						<option value="p.active" <?php if ($_smarty_tpl->tpl_vars['agile_filterby']->value=='p.active') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Enabled =','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
						<option value="po.approved" <?php if ($_smarty_tpl->tpl_vars['agile_filterby']->value=='po.approved') {?>selected<?php }?>><?php echo smartyTranslate(array('s'=>'Approved =','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
					</select>
				</div>
				<div class="agile-col-sm-2">
					<input type="text" name="agile_filterval" id="agile_filterval" value="<?php echo $_smarty_tpl->tpl_vars['agile_filterval']->value;?>
">
				</div>
				<div class="agile-col-sm-2">
					<input type="button" name="btnGo" value="Go" onclick="goOnClick()">
				</div>

			</div>
		</div>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['products']->value&&count($_smarty_tpl->tpl_vars['products']->value)) {?>
	<div class="table-responsive clearfix">
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <table id="product-list" class="std">
        <thead>
	        <tr>
		        <th class="first_item" style="width:60px"><?php echo smartyTranslate(array('s'=>'ID','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</th>
		        <th class="item"><?php echo smartyTranslate(array('s'=>'Photo','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</th>
		        <th class="item"><?php echo smartyTranslate(array('s'=>'Name','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</th>
		        <th class="item"><?php echo smartyTranslate(array('s'=>'Category','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</th>
		        <th class="item"><?php echo smartyTranslate(array('s'=>'Base Price','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</th>
		        <th class="item"><?php echo smartyTranslate(array('s'=>'Final Price','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</th>
		        <th class="item"><?php echo smartyTranslate(array('s'=>'Quantity','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</th>
		        <th class="item" style="width:80px"><?php echo smartyTranslate(array('s'=>'Active','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</th>
		        <?php if ($_smarty_tpl->tpl_vars['is_apprpved_required']->value) {?>
		        <th class="item" style="width:80px"><?php echo smartyTranslate(array('s'=>'Approved','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</th>
		        <?php }?>
		        <th class="last_item" style="width:60px">&nbsp;</th>
	        </tr>
        </thead>
        <tbody>
        <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['product']->iteration=0;
 $_smarty_tpl->tpl_vars['product']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['product']->iteration++;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->first = $_smarty_tpl->tpl_vars['product']->index === 0;
 $_smarty_tpl->tpl_vars['product']->last = $_smarty_tpl->tpl_vars['product']->iteration === $_smarty_tpl->tpl_vars['product']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['first'] = $_smarty_tpl->tpl_vars['product']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['last'] = $_smarty_tpl->tpl_vars['product']->last;
?>
    	<?php $_smarty_tpl->tpl_vars['detail_url'] = new Smarty_variable($_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellerproductdetail',array('id_product'=>$_smarty_tpl->tpl_vars['product']->value['id_product']),true), null, 0);?>
	        <tr class="<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['first']) {?>first_item<?php } elseif ($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['last']) {?>last_item<?php } else { ?>item<?php }?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['index']%2) {?>alternate_item<?php }?>">
		        <td class="pointer left" onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['detail_url']->value;?>
'">
			        <a class="color-myaccount" href="<?php echo $_smarty_tpl->tpl_vars['detail_url']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
</a>
		        </td>
		        <td class="pointer left" onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['detail_url']->value;?>
'">
					<a href="<?php echo $_smarty_tpl->tpl_vars['detail_url']->value;?>
">
					<?php if ($_smarty_tpl->tpl_vars['product']->value['id_image']) {?>
						<img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['name'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'small_default');?>
" />
					<?php } else { ?>
						<img src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
img/c/en-default-medium.jpg" />
					<?php }?>
					</a>
					</td>
		        <td class="pointer left" onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['detail_url']->value;?>
'"><a href="<?php echo $_smarty_tpl->tpl_vars['detail_url']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</a></td>
		        <td class="pointer left" onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['detail_url']->value;?>
'"><?php echo $_smarty_tpl->tpl_vars['product']->value['name_category'];?>
</td>
		        <td class="pointer right" onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['detail_url']->value;?>
'"><span class="price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price'],'currency'=>$_smarty_tpl->tpl_vars['def_id_currency']->value,'no_utf8'=>false,'convert'=>false),$_smarty_tpl);?>
</span></td>
		        <td class="pointer right" onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['detail_url']->value;?>
'"><span class="price"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_final'],'currency'=>$_smarty_tpl->tpl_vars['def_id_currency']->value,'no_utf8'=>false,'convert'=>false),$_smarty_tpl);?>
</span></td>
		        <td class="pointer center" onclick="document.location = '<?php echo $_smarty_tpl->tpl_vars['detail_url']->value;?>
'"><?php echo $_smarty_tpl->tpl_vars['product']->value['sav_quantity'];?>
</td>
		        <td class="center">
		            <?php if ($_smarty_tpl->tpl_vars['product']->value['active']==1) {?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellerproducts',array('process'=>'inactive','id_product'=>$_smarty_tpl->tpl_vars['product']->value['id_product']),true);?>
" ><img src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
img/admin/enabled.gif" /></a>
		            <?php } else { ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellerproducts',array('process'=>'active','id_product'=>$_smarty_tpl->tpl_vars['product']->value['id_product']),true);?>
" ><img src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
img/admin/disabled.gif" /></a>
		            <?php }?>
		        </td>
		        <?php if ($_smarty_tpl->tpl_vars['is_apprpved_required']->value) {?>
		        <td align="center" valign="middle">
		            <?php if ($_smarty_tpl->tpl_vars['product']->value['approved']==1) {?>
		            <img src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
img/admin/enabled.gif" />
		            <?php } else { ?>
		            <img src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
img/admin/disabled.gif" />
		            <?php }?>
		        </td>
		        <?php }?>
		        <td class="center">
		        <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellerproducts',array('process'=>'delete','id_product'=>$_smarty_tpl->tpl_vars['product']->value['id_product']),true);?>
" onclick="if (confirm('Delete selected item?')){ return true; }else{ event.stopPropagation(); event.preventDefault();};"><img src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
img/admin/delete.gif" /></a>
		        </td>
	        </tr>
        <?php } ?>
        </tbody>
    </table>
	</div> <!-- table-responsive -->
    <div id="block-product-detail" class="hidden">&nbsp;</div>
    <?php } else { ?>
		<div class="row">
			<p class="alert alert-warning"><?php echo smartyTranslate(array('s'=>'You do not have any products registered','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</p>
		</div>
    <?php }?>
</div>
</div> 
<!-- agile -->
<?php }?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/seller_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<script type="text/javascript">
var listurl = "<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellerproducts',array('process'=>''),true);?>
";
var psize = <?php echo $_smarty_tpl->tpl_vars['psize']->value;?>
;
var pnum = <?php echo $_smarty_tpl->tpl_vars['pnum']->value;?>
;


function goOnClick()
{
	var url =  listurl + "&p=" + (pnum<=0?1:pnum) + "&n=" + psize +"&agile_orderby=" + $("#agile_orderby").val() + "&agile_orderway=" + $("#agile_orderway").val() + "&agile_filterby=" + $("#agile_filterby").val()  + "&agile_filterval=" + $("#agile_filterval").val();
	window.location.href = url;
}
</script><?php }} ?>
