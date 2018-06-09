<?php /* Smarty version Smarty-3.1.19, created on 2018-06-06 17:47:03
         compiled from "/home/abdouhanne/www/admin230brwew5/themes/default/template/helpers/list/list_action_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12815136405b181e17666161-41023253%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a15b6e4c3877c20cb4c015a37509dc0dd7876284' => 
    array (
      0 => '/home/abdouhanne/www/admin230brwew5/themes/default/template/helpers/list/list_action_view.tpl',
      1 => 1494086824,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12815136405b181e17666161-41023253',
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
  'unifunc' => 'content_5b181e1767c803_44861327',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b181e1767c803_44861327')) {function content_5b181e1767c803_44861327($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" >
	<i class="icon-search-plus"></i> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>

</a><?php }} ?>
