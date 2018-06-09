<?php /* Smarty version Smarty-3.1.19, created on 2018-06-04 05:42:59
         compiled from "/home/abdouhanne/www/pr/themes/supershop/modules/blockcontact/nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4622816605b14d163b133f5-34048301%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7734bcef6705950b3b8f1298c6187029717f1219' => 
    array (
      0 => '/home/abdouhanne/www/pr/themes/supershop/modules/blockcontact/nav.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4622816605b14d163b133f5-34048301',
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
  'unifunc' => 'content_5b14d163b95cc4_36620105',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b14d163b95cc4_36620105')) {function content_5b14d163b95cc4_36620105($_smarty_tpl) {?>
<div id="contact-link">
	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('contact',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Contact Us','mod'=>'blockcontact'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Contact us','mod'=>'blockcontact'),$_smarty_tpl);?>
</a>
</div>
<?php if ($_smarty_tpl->tpl_vars['telnumber']->value) {?>
	<span class="shop-phone">
		<i class="icon-phone"></i><?php echo smartyTranslate(array('s'=>'Call us now:','mod'=>'blockcontact'),$_smarty_tpl);?>
 <strong><?php echo $_smarty_tpl->tpl_vars['telnumber']->value;?>
</strong>
	</span>
<?php }?><?php }} ?>
