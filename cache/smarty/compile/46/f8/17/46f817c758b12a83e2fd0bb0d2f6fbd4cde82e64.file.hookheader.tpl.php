<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:37:16
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleshop/views/templates/hook/hookheader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5186330675901f40ce48353-51926272%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46f817c758b12a83e2fd0bb0d2f6fbd4cde82e64' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleshop/views/templates/hook/hookheader.tpl',
      1 => 1493122873,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5186330675901f40ce48353-51926272',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'header_logo_mode' => 0,
    'base_dir_default' => 0,
    'base_dir' => 0,
    'HOOK_SELLER_HEADER_LOGO' => 0,
    'seller_logo_url' => 0,
    'id_shop_owner' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5901f40ce54a25_26657699',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f40ce54a25_26657699')) {function content_5901f40ce54a25_26657699($_smarty_tpl) {?>
<script language="javascript" type="text/javascript">
var header_logo_mode = <?php echo $_smarty_tpl->tpl_vars['header_logo_mode']->value;?>
;
var base_dir_default = "<?php echo $_smarty_tpl->tpl_vars['base_dir_default']->value;?>
";
var base_dir = "<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
";
var HOOK_SELLER_HEADER_LOGO = '<?php echo $_smarty_tpl->tpl_vars['HOOK_SELLER_HEADER_LOGO']->value;?>
';
var seller_logo_url = "<?php echo $_smarty_tpl->tpl_vars['seller_logo_url']->value;?>
";
var id_shop_owner = <?php echo $_smarty_tpl->tpl_vars['id_shop_owner']->value;?>
;

$('document').ready(function() {
	var seller_header_logo_id = $("a#seller_header_logo").attr("id");
	/** _agile_ alert(seller_header_logo_id); _agile_ **/

	var tag = $("#header_logo");
	if(!tag || !tag.is("a"))tag = $("#header_logo a");

	/** _agile_ main store logo only _agile_ **/
	if(header_logo_mode ==0)
	{
		tag.attr("href", base_dir_default);
	}
	/** _agile_ seller logo only _agile_ **/
	if(header_logo_mode ==1)
	{
		if(id_shop_owner>0)
		{
			tag.html('<img src="' + seller_logo_url + '" height="60">');
			tag.attr("href", base_dir);
		}
	}

	/** _agile_ both main store logo and seller logo _agile_ **/
	if(header_logo_mode ==2)
	{
		tag.attr("href", base_dir_default);
		/** _agile_ if HOOK is not found _agile_ **/
		if(seller_header_logo_id != 'seller_header_logo')
			$(HOOK_SELLER_HEADER_LOGO).insertAfter(tag);
	}
});
</script>
<?php }} ?>
