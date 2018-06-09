<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:53:41
         compiled from "/home/abdouhanne/www/pr/themes/supershop/product-sort-view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8654903505901f7e58ee512-47803790%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0074eae64df0c324ea06f0daecc18f5730ccf0d7' => 
    array (
      0 => '/home/abdouhanne/www/pr/themes/supershop/product-sort-view.tpl',
      1 => 1492385466,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8654903505901f7e58ee512-47803790',
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
  'unifunc' => 'content_5901f7e58fa492_10150968',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f7e58fa492_10150968')) {function content_5901f7e58fa492_10150968($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['orderby']->value)&&isset($_smarty_tpl->tpl_vars['orderway']->value)) {?>
<ul class="display hidden-xs">
	
    <li class="view_as_grid"><a rel="nofollow" href="#" title="<?php echo smartyTranslate(array('s'=>'Grid'),$_smarty_tpl);?>
"><i class="icon-th-large"></i><?php echo smartyTranslate(array('s'=>'Grid'),$_smarty_tpl);?>
</a></li>
    <li class="view_as_list"><a rel="nofollow" href="#" title="<?php echo smartyTranslate(array('s'=>'List'),$_smarty_tpl);?>
"><i class="icon-th-list"></i><?php echo smartyTranslate(array('s'=>'List'),$_smarty_tpl);?>
</a></li>
</ul>
<?php }?><?php }} ?>
