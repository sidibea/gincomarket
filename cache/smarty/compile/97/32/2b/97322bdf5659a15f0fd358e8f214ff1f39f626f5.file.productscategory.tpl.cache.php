<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:39:20
         compiled from "/home/abdouhanne/www/pr/themes/supershop/modules/productscategory/productscategory.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16340774775901f4886d1c73-49785965%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97322bdf5659a15f0fd358e8f214ff1f39f626f5' => 
    array (
      0 => '/home/abdouhanne/www/pr/themes/supershop/modules/productscategory/productscategory.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16340774775901f4886d1c73-49785965',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'categoryProducts' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5901f4886f0e56_68710539',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f4886f0e56_68710539')) {function content_5901f4886f0e56_68710539($_smarty_tpl) {?><?php if (count($_smarty_tpl->tpl_vars['categoryProducts']->value)>0&&$_smarty_tpl->tpl_vars['categoryProducts']->value!==false) {?>
<section class="page-product-box blockproductscategory">
	
    <h3 class="productscategory_h3 page-product-heading"><?php echo smartyTranslate(array('s'=>'Products In The Same Category','mod'=>'productscategory'),$_smarty_tpl);?>
</h3>        
	<div id="productscategory_list" class="clearfix">
	   <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./product-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('products'=>$_smarty_tpl->tpl_vars['categoryProducts']->value,'id'=>'productscategory_list_ul'), 0);?>

 	</div>
    <?php if (count($_smarty_tpl->tpl_vars['categoryProducts']->value)>4) {?><a id="productscategory_scroll_right" class="next_slide navigation_btn" title="<?php echo smartyTranslate(array('s'=>'Next','mod'=>'ovicproductscategory'),$_smarty_tpl);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s'=>'Next','mod'=>'ovicproductscategory'),$_smarty_tpl);?>
</a><?php }?>
    <?php if (count($_smarty_tpl->tpl_vars['categoryProducts']->value)>4) {?><a id="productscategory_scroll_left" class="prev_slide navigation_btn" title="<?php echo smartyTranslate(array('s'=>'Previous','mod'=>'ovicproductscategory'),$_smarty_tpl);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s'=>'Previous','mod'=>'ovicproductscategory'),$_smarty_tpl);?>
</a><?php }?>
</section>
<?php }?><?php }} ?>
