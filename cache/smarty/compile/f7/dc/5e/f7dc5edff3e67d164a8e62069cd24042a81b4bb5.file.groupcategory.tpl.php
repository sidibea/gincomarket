<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:51:22
         compiled from "/home/abdouhanne/www/modules/groupcategory/views/templates/hook/groupcategory.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12216912915b1a5faa2c0ce7-88219472%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7dc5edff3e67d164a8e62069cd24042a81b4bb5' => 
    array (
      0 => '/home/abdouhanne/www/modules/groupcategory/views/templates/hook/groupcategory.tpl',
      1 => 1495566855,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12216912915b1a5faa2c0ce7-88219472',
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
  'unifunc' => 'content_5b1a5faa2ced05_67883859',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5faa2ced05_67883859')) {function content_5b1a5faa2ced05_67883859($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['groupCategoryModules']->value)&&$_smarty_tpl->tpl_vars['groupCategoryModules']->value) {?>
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
