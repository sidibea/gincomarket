<?php /* Smarty version Smarty-3.1.19, created on 2018-06-04 05:42:56
         compiled from "/home/abdouhanne/www/pr/modules/groupcategory/views/templates/hook/groupcategory.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18975994605b14d160ded0c0-00673514%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '18975994605b14d160ded0c0-00673514',
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
  'unifunc' => 'content_5b14d160e3da85_58043669',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b14d160e3da85_58043669')) {function content_5b14d160e3da85_58043669($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['groupCategoryModules']->value)&&$_smarty_tpl->tpl_vars['groupCategoryModules']->value) {?>
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
