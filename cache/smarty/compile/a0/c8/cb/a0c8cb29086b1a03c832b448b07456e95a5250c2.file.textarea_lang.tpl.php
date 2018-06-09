<?php /* Smarty version Smarty-3.1.19, created on 2017-04-28 18:28:58
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleseller/views//templates/front/products/textarea_lang.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2046382786590389ea6133e4-69163203%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0c8cb29086b1a03c832b448b07456e95a5250c2' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleseller/views//templates/front/products/textarea_lang.tpl',
      1 => 1493122817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2046382786590389ea6133e4-69163203',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'languages' => 0,
    'language' => 0,
    'input_name' => 0,
    'default_row' => 0,
    'autosize_js' => 0,
    'class' => 0,
    'input_value' => 0,
    'max' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_590389ea64c703_05048122',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_590389ea64c703_05048122')) {function content_590389ea64c703_05048122($_smarty_tpl) {?>

<?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>
<div class="translatable-field lang-<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
">
	<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
		<textarea
			id="<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
"
			name="<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
"
			<?php if (isset($_smarty_tpl->tpl_vars['default_row']->value)&&$_smarty_tpl->tpl_vars['default_row']->value>0) {?> row="<?php echo $_smarty_tpl->tpl_vars['default_row']->value;?>
" <?php }?>
			class="<?php if (isset($_smarty_tpl->tpl_vars['autosize_js']->value)) {?>textarea-autosize<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['class']->value;?>
<?php }?>"><?php if (isset($_smarty_tpl->tpl_vars['input_value']->value[$_smarty_tpl->tpl_vars['language']->value['id_lang']])) {?><?php echo smarty_modifier_htmlentitiesUTF8($_smarty_tpl->tpl_vars['input_value']->value[$_smarty_tpl->tpl_vars['language']->value['id_lang']]);?>
<?php }?></textarea>
	</div>
<?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1) {?>
	<div class="agile-col-sm-2 agile-col-md-2 agile-col-lg-2 agile-col-xl-2">
		<button type="button" class="agile-btn agile-btn-default agile-dropdown-toggle" data-toggle="agile-dropdown">
			<?php echo $_smarty_tpl->tpl_vars['language']->value['iso_code'];?>

			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu">
			<?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>
			<li><a href="javascript:hideOtherLanguage(<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
);"><?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
</a></li>
			<?php } ?>
		</ul>
	</div>
<?php }?>
</div>
<span class="counter" max="<?php if (isset($_smarty_tpl->tpl_vars['max']->value)) {?><?php echo $_smarty_tpl->tpl_vars['max']->value;?>
<?php } else { ?>none<?php }?>"></span>
<?php } ?>
<?php }} ?>
