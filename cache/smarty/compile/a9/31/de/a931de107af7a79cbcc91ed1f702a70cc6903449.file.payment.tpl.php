<?php /* Smarty version Smarty-3.1.19, created on 2018-06-05 01:47:03
         compiled from "/home/abdouhanne/www/modules/westernunion/views/templates/front/payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12780208045b15eb97ce3da8-69186550%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a931de107af7a79cbcc91ed1f702a70cc6903449' => 
    array (
      0 => '/home/abdouhanne/www/modules/westernunion/views/templates/front/payment.tpl',
      1 => 1494955155,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12780208045b15eb97ce3da8-69186550',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'this_path_ssl' => 0,
    'this_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b15eb97cf0035_58378905',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b15eb97cf0035_58378905')) {function content_5b15eb97cf0035_58378905($_smarty_tpl) {?><p class="payment_module">
	<a href="<?php echo $_smarty_tpl->tpl_vars['this_path_ssl']->value;?>
payment.php" title="<?php echo smartyTranslate(array('s'=>'Pay by WesternUnion','mod'=>'westernunion'),$_smarty_tpl);?>
">
		<img src="<?php echo $_smarty_tpl->tpl_vars['this_path']->value;?>
westernunion.jpg" alt="<?php echo smartyTranslate(array('s'=>'Pay by WesternUnion','mod'=>'westernunion'),$_smarty_tpl);?>
" />
		<?php echo smartyTranslate(array('s'=>'Pay by WesternUnion.','mod'=>'westernunion'),$_smarty_tpl);?>
	</a>
</p>
<?php }} ?>
