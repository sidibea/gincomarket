<?php /* Smarty version Smarty-3.1.19, created on 2018-06-04 05:42:45
         compiled from "/home/abdouhanne/www/pr/modules/ovicstoremap/views/templates/hook/ovicstoremap.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7538200605b14d155c90771-79318615%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f5c94371a95073b8682280e6fea0695df41be767' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/ovicstoremap/views/templates/hook/ovicstoremap.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7538200605b14d155c90771-79318615',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'defaultLat' => 0,
    'defaultLong' => 0,
    'storeName' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b14d155ca3ea8_49655468',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b14d155ca3ea8_49655468')) {function content_5b14d155ca3ea8_49655468($_smarty_tpl) {?><div id="map_canvas"></div>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('defaultLat'=>$_smarty_tpl->tpl_vars['defaultLat']->value),$_smarty_tpl);?>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('defaultLong'=>$_smarty_tpl->tpl_vars['defaultLong']->value),$_smarty_tpl);?>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('storeName'=>$_smarty_tpl->tpl_vars['storeName']->value),$_smarty_tpl);?>
<?php }} ?>
