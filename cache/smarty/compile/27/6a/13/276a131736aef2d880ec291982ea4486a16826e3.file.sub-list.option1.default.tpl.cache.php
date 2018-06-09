<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:37:16
         compiled from "/home/abdouhanne/www/pr/modules/groupcategory/views/templates/hook/sub-list.option1.default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9088597395901f40c5aaf44-05520026%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '276a131736aef2d880ec291982ea4486a16826e3' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/groupcategory/views/templates/hook/sub-list.option1.default.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9088597395901f40c5aaf44-05520026',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'items' => 0,
    'module_id' => 0,
    'sub' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5901f40c5bc835_85095672',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f40c5bc835_85095672')) {function content_5901f40c5bc835_85095672($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['items']->value)&&count($_smarty_tpl->tpl_vars['items']->value)>0) {?>
	<ul class="category-list">
	<?php  $_smarty_tpl->tpl_vars['sub'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sub']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sub']->key => $_smarty_tpl->tpl_vars['sub']->value) {
$_smarty_tpl->tpl_vars['sub']->_loop = true;
?>
	    <li class="category-list-item check-active"><a role="tab" data-toggle="tab" data-id="<?php echo $_smarty_tpl->tpl_vars['module_id']->value;?>
" href=".tab-content-<?php echo $_smarty_tpl->tpl_vars['module_id']->value;?>
-0-<?php echo $_smarty_tpl->tpl_vars['sub']->value['item_id'];?>
" class="tab-link"><?php echo $_smarty_tpl->tpl_vars['sub']->value['item_name'];?>
</a></li>
	<?php } ?>
	</ul>
<?php }?>
<?php }} ?>
