<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 15:12:59
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/hook/customeraccount.tpl" */ ?>
<?php /*%%SmartyHeaderCode:155975062459020a7b9029d6-69642983%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd762f27332a137670dc98098912cf0b4b548fb9' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/hook/customeraccount.tpl',
      1 => 1493122817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '155975062459020a7b9029d6-69642983',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mysellerurl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59020a7b919eb6_06745342',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59020a7b919eb6_06745342')) {function content_59020a7b919eb6_06745342($_smarty_tpl) {?><li>
  <a href="<?php echo $_smarty_tpl->tpl_vars['mysellerurl']->value;?>
" title="<?php echo smartyTranslate(array('s'=>'My Seller Account','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
">
    <i class="icon-cog"></i>
    <span><?php echo smartyTranslate(array('s'=>'My Seller Account','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
  </a>
</li>
<?php }} ?>
