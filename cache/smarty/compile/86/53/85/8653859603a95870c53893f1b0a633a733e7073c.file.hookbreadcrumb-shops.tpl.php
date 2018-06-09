<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:37:16
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleshop/views/templates/hook/hookbreadcrumb-shops.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14031886505901f40ce2e648-67983388%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8653859603a95870c53893f1b0a633a733e7073c' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleshop/views/templates/hook/hookbreadcrumb-shops.tpl',
      1 => 1493122873,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14031886505901f40ce2e648-67983388',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_dir_default' => 0,
    'seller_shop' => 0,
    'isat_seller_home' => 0,
    'navigationPipe' => 0,
    'seller_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5901f40ce44e35_76133897',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f40ce44e35_76133897')) {function content_5901f40ce44e35_76133897($_smarty_tpl) {?><a href="<?php echo $_smarty_tpl->tpl_vars['base_dir_default']->value;?>
" title="<?php echo smartyTranslate(array('s'=>'Main Shop','mod'=>'agilemultipleshop'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Main Shop','mod'=>'agilemultipleshop'),$_smarty_tpl);?>
</a>
<?php if (isset($_smarty_tpl->tpl_vars['seller_shop']->value)&&$_smarty_tpl->tpl_vars['seller_shop']->value) {?>
	<?php if (isset($_smarty_tpl->tpl_vars['isat_seller_home']->value)&&$_smarty_tpl->tpl_vars['isat_seller_home']->value==0) {?>
		<span class="navigation-pipe"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['navigationPipe']->value, ENT_QUOTES, 'UTF-8', true);?>
</span>
		<a href="<?php echo $_smarty_tpl->tpl_vars['seller_shop']->value->getBaseURL();?>
"><?php echo $_smarty_tpl->tpl_vars['seller_name']->value;?>
</a>
	<?php }?>
<?php }?>
<?php }} ?>
