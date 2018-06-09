<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 15:21:01
         compiled from "/home/abdouhanne/www/pr/admin230brwew5/themes/default/template/helpers/list/list_action_preview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:157327811459020c5d2131e3-30955526%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '09989fb63f3cd6b783f24d09602629b41811907d' => 
    array (
      0 => '/home/abdouhanne/www/pr/admin230brwew5/themes/default/template/helpers/list/list_action_preview.tpl',
      1 => 1492378286,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157327811459020c5d2131e3-30955526',
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
  'unifunc' => 'content_59020c5d21be41_79916591',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59020c5d21be41_79916591')) {function content_59020c5d21be41_79916591($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" target="_blank">
	<i class="icon-eye"></i> <?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a>
<?php }} ?>
