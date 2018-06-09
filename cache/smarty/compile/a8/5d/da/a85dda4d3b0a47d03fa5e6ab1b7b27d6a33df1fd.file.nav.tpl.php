<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:51:25
         compiled from "/home/abdouhanne/www/themes/supershop/modules/blockcontact/nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13651847645b1a5fad881816-19937823%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a85dda4d3b0a47d03fa5e6ab1b7b27d6a33df1fd' => 
    array (
      0 => '/home/abdouhanne/www/themes/supershop/modules/blockcontact/nav.tpl',
      1 => 1508405273,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13651847645b1a5fad881816-19937823',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'telnumber' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1a5fad891702_53609142',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5fad891702_53609142')) {function content_5b1a5fad891702_53609142($_smarty_tpl) {?>
<div id="contact-link">
	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('contact',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Contact Us','mod'=>'blockcontact'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Contact us','mod'=>'blockcontact'),$_smarty_tpl);?>
</a>
</div>
<?php if ($_smarty_tpl->tpl_vars['telnumber']->value) {?>
	<span class="shop-phone">
		<i class="fa fa-phone"></i><?php echo smartyTranslate(array('s'=>'Call us now:','mod'=>'blockcontact'),$_smarty_tpl);?>
 <strong><?php echo $_smarty_tpl->tpl_vars['telnumber']->value;?>
</strong>
	</span>
<?php }?><?php }} ?>
