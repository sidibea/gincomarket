<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:35:09
         compiled from "/home/abdouhanne/www/modules/agilemultipleshop/views/templates/front/agileseller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6290990945b1a5bdd2648a7-17440677%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a77acfb5b5a9b72a3d2f895350b7efd69d03f3a' => 
    array (
      0 => '/home/abdouhanne/www/modules/agilemultipleshop/views/templates/front/agileseller.tpl',
      1 => 1495227207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6290990945b1a5bdd2648a7-17440677',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'seller_info' => 0,
    'HOOK_SELLER_RATINGS' => 0,
    'conf' => 0,
    'i' => 0,
    'field_name' => 0,
    'custom_labels' => 0,
    'nb_products' => 0,
    'products' => 0,
    'warehouse_vars' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1a5bddb29976_43351143',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5bddb29976_43351143')) {function content_5b1a5bddb29976_43351143($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<h1><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['seller_info']->value->company, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

</h1>

<div id="seller-block" class="box">
	<div class="row">
		<!-- seller logo-->        
		<div id="logo-block" class="col-xs-12 col-sm-3 col-md-2">
			<img src="<?php echo $_smarty_tpl->tpl_vars['seller_info']->value->get_seller_logo_url();?>
" title="Logo" alt="Logo" style="display:block;max-width:100%;height:auto;" />
		</div>
		<!-- end logo -->
		<div class="col-xs-12 col-sm-6 col-md-6">
			<?php if (empty($_smarty_tpl->tpl_vars['HOOK_SELLER_RATINGS']->value)) {?>
				<b><?php echo $_smarty_tpl->tpl_vars['seller_info']->value->company;?>
</b>
			<?php } else { ?>
				<?php echo $_smarty_tpl->tpl_vars['HOOK_SELLER_RATINGS']->value;?>

			<?php }?>
			<br />
			<?php echo $_smarty_tpl->tpl_vars['seller_info']->value->address1;?>
<br />
			<?php if ($_smarty_tpl->tpl_vars['seller_info']->value->address2) {?><?php echo $_smarty_tpl->tpl_vars['seller_info']->value->address2;?>
<br /><?php }?>
			<?php echo $_smarty_tpl->tpl_vars['seller_info']->value->city;?>
, <?php echo $_smarty_tpl->tpl_vars['seller_info']->value->state;?>
 <?php echo $_smarty_tpl->tpl_vars['seller_info']->value->postcode;?>
<br />
			<?php echo $_smarty_tpl->tpl_vars['seller_info']->value->country;?>
 <br /><br />
			<?php if (!empty($_smarty_tpl->tpl_vars['seller_info']->value->phone)) {?>
			<?php echo smartyTranslate(array('s'=>'Phone','mod'=>'agilemultipleshop'),$_smarty_tpl);?>
:<?php echo $_smarty_tpl->tpl_vars['seller_info']->value->phone;?>

			<?php }?>
			<p id="custmomized_fields">
			<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 10+1 - (1) : 1-(10)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
				<?php if (isset($_smarty_tpl->tpl_vars['conf']->value)&&$_smarty_tpl->tpl_vars['conf']->value[sprintf("AGILE_MS_SELLER_TEXT%s",$_smarty_tpl->tpl_vars['i']->value)]) {?>
				<?php $_smarty_tpl->tpl_vars['field_name'] = new Smarty_variable(sprintf("ams_custom_text%s",$_smarty_tpl->tpl_vars['i']->value), null, 0);?>
					<label for="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['custom_labels']->value[$_smarty_tpl->tpl_vars['field_name']->value];?>
:&nbsp;</label><?php echo $_smarty_tpl->tpl_vars['seller_info']->value->{$_smarty_tpl->tpl_vars['field_name']->value};?>
<br>
				<?php }?>
			<?php }} ?>
			<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 2+1 - (1) : 1-(2)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
				<?php if (isset($_smarty_tpl->tpl_vars['conf']->value)&&$_smarty_tpl->tpl_vars['conf']->value[sprintf("AGILE_MS_SELLER_HTML%s",$_smarty_tpl->tpl_vars['i']->value)]) {?>
				<?php $_smarty_tpl->tpl_vars['field_name'] = new Smarty_variable(sprintf("ams_custom_html%s",$_smarty_tpl->tpl_vars['i']->value), null, 0);?>
					<label for="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['custom_labels']->value[$_smarty_tpl->tpl_vars['field_name']->value];?>
:&nbsp;</label><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['seller_info']->value->{$_smarty_tpl->tpl_vars['field_name']->value});?>
<br>
				<?php }?>
			<?php }} ?>
			<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 10+1 - (1) : 1-(10)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
				<?php if (isset($_smarty_tpl->tpl_vars['conf']->value)&&$_smarty_tpl->tpl_vars['conf']->value[sprintf("AGILE_MS_SELLER_NUMBER%s",$_smarty_tpl->tpl_vars['i']->value)]) {?>
				<?php $_smarty_tpl->tpl_vars['field_name'] = new Smarty_variable(sprintf("ams_custom_number%s",$_smarty_tpl->tpl_vars['i']->value), null, 0);?>
					<label for="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['custom_labels']->value[$_smarty_tpl->tpl_vars['field_name']->value];?>
:&nbsp;</label><?php echo $_smarty_tpl->tpl_vars['seller_info']->value->{$_smarty_tpl->tpl_vars['field_name']->value};?>
<br>
				<?php }?>
			<?php }} ?>
			<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 5+1 - (1) : 1-(5)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
				<?php if (isset($_smarty_tpl->tpl_vars['conf']->value)&&$_smarty_tpl->tpl_vars['conf']->value[sprintf("AGILE_MS_SELLER_DATE%s",$_smarty_tpl->tpl_vars['i']->value)]) {?>
				<?php $_smarty_tpl->tpl_vars['field_name'] = new Smarty_variable(sprintf("ams_custom_date%s",$_smarty_tpl->tpl_vars['i']->value), null, 0);?>
					<label for="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['custom_labels']->value[$_smarty_tpl->tpl_vars['field_name']->value];?>
:&nbsp;</label><?php echo $_smarty_tpl->tpl_vars['seller_info']->value->{$_smarty_tpl->tpl_vars['field_name']->value};?>
<br>
				<?php }?>
			<?php }} ?>
			</p>
		</div>
	</div>
	<hr></hr>
	<div class="row">
		<span>&nbsp;&nbsp;<b><?php echo smartyTranslate(array('s'=>'description:','mod'=>'agilemultipleshop'),$_smarty_tpl);?>
</b>&nbsp;<?php echo $_smarty_tpl->tpl_vars['seller_info']->value->description;?>
</span>
	</div>
</div> <!-- End of Box -->


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

<script lang="javascript" type="text/javascript">
	$('document').ready( function() {
		$("#top_column").hide();
	});
</script>
<?php }} ?>
