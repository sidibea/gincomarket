<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:51:20
         compiled from "/home/abdouhanne/www/modules/ovicstoremap/views/templates/hook/ovicstoremap.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2151560035b1a5fa845a509-63796969%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f74b254856b6dcf0fa442766c66d97dc70e0a978' => 
    array (
      0 => '/home/abdouhanne/www/modules/ovicstoremap/views/templates/hook/ovicstoremap.tpl',
      1 => 1493588696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2151560035b1a5fa845a509-63796969',
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
  'unifunc' => 'content_5b1a5fa8461ac1_66932362',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5fa8461ac1_66932362')) {function content_5b1a5fa8461ac1_66932362($_smarty_tpl) {?><div id="map_canvas"></div>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('defaultLat'=>$_smarty_tpl->tpl_vars['defaultLat']->value),$_smarty_tpl);?>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('defaultLong'=>$_smarty_tpl->tpl_vars['defaultLong']->value),$_smarty_tpl);?>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('storeName'=>$_smarty_tpl->tpl_vars['storeName']->value),$_smarty_tpl);?>
<?php }} ?>
