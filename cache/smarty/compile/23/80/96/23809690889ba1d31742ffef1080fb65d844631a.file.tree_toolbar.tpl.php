<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 15:21:00
         compiled from "/home/abdouhanne/www/pr/admin230brwew5/themes/default/template/controllers/products/helpers/tree/tree_toolbar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:186653762059020c5cd24259-13491212%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '23809690889ba1d31742ffef1080fb65d844631a' => 
    array (
      0 => '/home/abdouhanne/www/pr/admin230brwew5/themes/default/template/controllers/products/helpers/tree/tree_toolbar.tpl',
      1 => 1492378653,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '186653762059020c5cd24259-13491212',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'actions' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59020c5cd3e770_98337730',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59020c5cd3e770_98337730')) {function content_59020c5cd3e770_98337730($_smarty_tpl) {?>
<div class="tree-actions pull-right">
	<?php if (isset($_smarty_tpl->tpl_vars['actions']->value)) {?>
	<?php  $_smarty_tpl->tpl_vars['action'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['action']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['actions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['action']->key => $_smarty_tpl->tpl_vars['action']->value) {
$_smarty_tpl->tpl_vars['action']->_loop = true;
?>
		<?php echo $_smarty_tpl->tpl_vars['action']->value->render();?>

	<?php } ?>
	<?php }?>
</div><?php }} ?>
