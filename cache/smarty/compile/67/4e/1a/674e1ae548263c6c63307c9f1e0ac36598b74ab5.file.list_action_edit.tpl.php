<?php /* Smarty version Smarty-3.1.19, created on 2018-06-07 11:47:22
         compiled from "/home/abdouhanne/www/admin230brwew5/themes/default/template/helpers/list/list_action_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5660099725b191b4a474b01-48371108%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '674e1ae548263c6c63307c9f1e0ac36598b74ab5' => 
    array (
      0 => '/home/abdouhanne/www/admin230brwew5/themes/default/template/helpers/list/list_action_edit.tpl',
      1 => 1494086824,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5660099725b191b4a474b01-48371108',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b191b4a47e955_14297484',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b191b4a47e955_14297484')) {function content_5b191b4a47e955_14297484($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="edit">
	<i class="icon-pencil"></i> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>

</a><?php }} ?>
