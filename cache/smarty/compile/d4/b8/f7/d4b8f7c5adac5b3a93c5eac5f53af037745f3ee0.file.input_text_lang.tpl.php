<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 00:16:49
         compiled from "/home/abdouhanne/www/modules/agilemultipleseller/views//templates/front/products/input_text_lang.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12424138105b19caf1b0f797-12415006%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd4b8f7c5adac5b3a93c5eac5f53af037745f3ee0' => 
    array (
      0 => '/home/abdouhanne/www/modules/agilemultipleseller/views//templates/front/products/input_text_lang.tpl',
      1 => 1495227186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12424138105b19caf1b0f797-12415006',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'languages' => 0,
    'language' => 0,
    'maxchar' => 0,
    'input_name' => 0,
    'input_class' => 0,
    'input_value' => 0,
    'maxlength' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b19caf1cf4621_41951543',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b19caf1cf4621_41951543')) {function content_5b19caf1cf4621_41951543($_smarty_tpl) {?>

<?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>
	<div class="translatable-field row lang-<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
">
		<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
			<?php if (isset($_smarty_tpl->tpl_vars['maxchar']->value)) {?>
			<div class="input-group">
				<span id="<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
_counter" class="input-group-addon">
					<span class="text-count-down"><?php echo $_smarty_tpl->tpl_vars['maxchar']->value;?>
</span>
				</span>
				<?php }?>
				<input type="text"
				id="<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
"
				<?php if (isset($_smarty_tpl->tpl_vars['input_class']->value)) {?>class="<?php echo $_smarty_tpl->tpl_vars['input_class']->value;?>
"<?php }?>
				name="<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
"
				value="<?php echo (($tmp = @smarty_modifier_htmlentitiesUTF8($_smarty_tpl->tpl_vars['input_value']->value[$_smarty_tpl->tpl_vars['language']->value['id_lang']]))===null||$tmp==='' ? '' : $tmp);?>
"
				onkeyup="if (isArrowKey(event)) return ;updateFriendlyURL();"
				onblur="updateLinkRewrite();"
				<?php if (isset($_smarty_tpl->tpl_vars['maxchar']->value)) {?> data-maxchar="<?php echo $_smarty_tpl->tpl_vars['maxchar']->value;?>
"<?php }?>
				<?php if (isset($_smarty_tpl->tpl_vars['maxlength']->value)) {?> maxlength="<?php echo $_smarty_tpl->tpl_vars['maxlength']->value;?>
"<?php }?> />
				<?php if (isset($_smarty_tpl->tpl_vars['maxchar']->value)) {?>
			</div>
			<?php }?>
		</div>
	<?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1) {?>
		<div class="agile-col-sm-2 agile-col-md-2 agile-col-lg-2 agile-col-xl-2">
			<button type="button" class="agile-btn agile-btn-default agile-dropdown-toggle" data-toggle="agile-dropdown" tabindex="-1">
				<?php echo $_smarty_tpl->tpl_vars['language']->value['iso_code'];?>

				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>
				<li>
					<a href="javascript:hideOtherLanguage(<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
);"><?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
</a>
				</li>
				<?php } ?>
			</ul>
		</div>
	<?php }?>
	</div>
<?php } ?>
<?php if (isset($_smarty_tpl->tpl_vars['maxchar']->value)) {?>
<script type="text/javascript">
function countDown($source, $target) {
	var max = $source.attr("data-maxchar");
	$target.html(max-$source.val().length);

	$source.keyup(function(){
		$target.html(max-$source.val().length);
	});
}

$(document).ready(function(){
<?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>
	countDown($("#<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
"), $("#<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
_counter"));
<?php } ?>
});
</script>
<?php }?>
<?php }} ?>
