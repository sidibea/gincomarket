<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:37:16
         compiled from "/home/abdouhanne/www/pr/modules/groupcategory/views/templates/hook/groupcategory.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17483918245901f40c807392-28269986%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e0c5d7c192760bc88bc6f6918a75f67a47a74b1a' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/groupcategory/views/templates/hook/groupcategory.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17483918245901f40c807392-28269986',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'groupCategoryModules' => 0,
    'module' => 0,
    'comparator_max_item' => 0,
    'compared_products' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5901f40c817861_35190196',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f40c817861_35190196')) {function content_5901f40c817861_35190196($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['groupCategoryModules']->value)&&$_smarty_tpl->tpl_vars['groupCategoryModules']->value) {?>
    <?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groupCategoryModules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->_loop = true;
?>
        <?php echo $_smarty_tpl->tpl_vars['module']->value['content'];?>

    <?php } ?>    
<?php }?>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('comparator_max_item'=>$_smarty_tpl->tpl_vars['comparator_max_item']->value),$_smarty_tpl);?>

<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('comparedProductsIds'=>$_smarty_tpl->tpl_vars['compared_products']->value),$_smarty_tpl);?>
<?php }} ?>
