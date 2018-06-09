<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:48:15
         compiled from "/home/abdouhanne/www/themes/supershop/product-sort-view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15106350835b1a5eefd9d069-62466093%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9040b439d6e36773bd9d61eff75f73b73d5beaa9' => 
    array (
      0 => '/home/abdouhanne/www/themes/supershop/product-sort-view.tpl',
      1 => 1493588700,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15106350835b1a5eefd9d069-62466093',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'orderby' => 0,
    'orderway' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1a5eefda7318_22672630',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5eefda7318_22672630')) {function content_5b1a5eefda7318_22672630($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['orderby']->value)&&isset($_smarty_tpl->tpl_vars['orderway']->value)) {?>
<ul class="display hidden-xs">
	
    <li class="view_as_grid"><a rel="nofollow" href="#" title="<?php echo smartyTranslate(array('s'=>'Grid'),$_smarty_tpl);?>
"><i class="icon-th-large"></i><?php echo smartyTranslate(array('s'=>'Grid'),$_smarty_tpl);?>
</a></li>
    <li class="view_as_list"><a rel="nofollow" href="#" title="<?php echo smartyTranslate(array('s'=>'List'),$_smarty_tpl);?>
"><i class="icon-th-list"></i><?php echo smartyTranslate(array('s'=>'List'),$_smarty_tpl);?>
</a></li>
</ul>
<?php }?><?php }} ?>
