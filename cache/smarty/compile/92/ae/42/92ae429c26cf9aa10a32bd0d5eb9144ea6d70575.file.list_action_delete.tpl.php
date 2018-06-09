<?php /* Smarty version Smarty-3.1.19, created on 2018-06-07 11:47:22
         compiled from "/home/abdouhanne/www/admin230brwew5/themes/default/template/helpers/list/list_action_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2281311325b191b4a493a28-01269578%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92ae429c26cf9aa10a32bd0d5eb9144ea6d70575' => 
    array (
      0 => '/home/abdouhanne/www/admin230brwew5/themes/default/template/helpers/list/list_action_delete.tpl',
      1 => 1494086824,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2281311325b191b4a493a28-01269578',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'confirm' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b191b4a4a5ff8_58829320',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b191b4a4a5ff8_58829320')) {function content_5b191b4a4a5ff8_58829320($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php if (isset($_smarty_tpl->tpl_vars['confirm']->value)) {?> onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['confirm']->value;?>
')){return true;}else{event.stopPropagation(); event.preventDefault();};"<?php }?> title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="delete">
	<i class="icon-trash"></i> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>

</a><?php }} ?>
