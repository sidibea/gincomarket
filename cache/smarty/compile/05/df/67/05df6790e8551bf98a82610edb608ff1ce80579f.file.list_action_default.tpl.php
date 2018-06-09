<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 15:23:47
         compiled from "/home/abdouhanne/www/pr/admin230brwew5/themes/default/template/helpers/list/list_action_default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5649280759020d031a6f47-74419170%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '05df6790e8551bf98a82610edb608ff1ce80579f' => 
    array (
      0 => '/home/abdouhanne/www/pr/admin230brwew5/themes/default/template/helpers/list/list_action_default.tpl',
      1 => 1492378284,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5649280759020d031a6f47-74419170',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
    'name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59020d0321b7d3_52960328',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59020d0321b7d3_52960328')) {function content_59020d0321b7d3_52960328($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
"<?php if (isset($_smarty_tpl->tpl_vars['name']->value)) {?> name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php }?> class="default">
	<i class="icon-asterisk"></i> <?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a><?php }} ?>
