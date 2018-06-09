<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:46:29
         compiled from "/home/abdouhanne/www/themes/supershop/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19205129685b1a5e85c5fff1-35268207%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0afdfad567c47bd096568de554e5c48a41d7162f' => 
    array (
      0 => '/home/abdouhanne/www/themes/supershop/index.tpl',
      1 => 1508792506,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19205129685b1a5e85c5fff1-35268207',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'HOOK_HOME_TAB_CONTENT' => 0,
    'HOOK_HOME_TAB' => 0,
    'HOOK_HOME' => 0,
    'current_option' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1a5e85c7c040_46261671',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5e85c7c040_46261671')) {function content_5b1a5e85c7c040_46261671($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars["current_option"] = new Smarty_variable(Configuration::get('OVIC_CURRENT_OPTION'), null, 0);?>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayHomeTopContent'),$_smarty_tpl);?>

<?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)) {?>
    <?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value)) {?>
        <ul id="home-popular-tabs" class="nav nav-tabs clearfix">
			<?php echo $_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value;?>

		</ul>
	<?php }?>
	<div class="tab-content"><?php echo $_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value;?>
</div>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_HOME']->value)) {?>
	<div class="clearfix<?php if (isset($_smarty_tpl->tpl_vars['current_option']->value)&&$_smarty_tpl->tpl_vars['current_option']->value==3) {?> clearBoth<?php }?>"><?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>
</div>
<?php }?>
<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayHomeBottomContent'),$_smarty_tpl);?>
<?php }} ?>
