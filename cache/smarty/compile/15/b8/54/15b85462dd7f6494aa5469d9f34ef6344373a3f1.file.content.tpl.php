<?php /* Smarty version Smarty-3.1.19, created on 2018-06-07 13:59:21
         compiled from "/home/abdouhanne/www/admin230brwew5/themes/default/template/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3233649905b193a39e18ea6-44425011%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15b85462dd7f6494aa5469d9f34ef6344373a3f1' => 
    array (
      0 => '/home/abdouhanne/www/admin230brwew5/themes/default/template/content.tpl',
      1 => 1494086821,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3233649905b193a39e18ea6-44425011',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b193a39e1eca2_25229590',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b193a39e1eca2_25229590')) {function content_5b193a39e1eca2_25229590($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div><?php }} ?>
