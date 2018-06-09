<?php /* Smarty version Smarty-3.1.19, created on 2018-06-06 16:16:57
         compiled from "/home/abdouhanne/www/modules/advancetopmenu/views/templates/admin/block_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16242230815b1808f94157c0-58526843%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8529af5ee7fb391220afaed39a8decf0d7840c9e' => 
    array (
      0 => '/home/abdouhanne/www/modules/advancetopmenu/views/templates/admin/block_form.tpl',
      1 => 1493588696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16242230815b1808f94157c0-58526843',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'form' => 0,
    'postAction' => 0,
    'block' => 0,
    'foo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1808f944df06_74959639',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1808f944df06_74959639')) {function content_5b1808f944df06_74959639($_smarty_tpl) {?><div class="panel">
	<div class="panel-heading">
		<?php echo $_smarty_tpl->tpl_vars['form']->value;?>
 <?php echo smartyTranslate(array('s'=>' setting','mod'=>'advancetopmenu'),$_smarty_tpl);?>

    </div>
    <form method="post" action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" enctype="multipart/form-data" class="item-form defaultForm  form-horizontal">
        <input type="hidden" name="id_sub" value="<?php if (isset($_smarty_tpl->tpl_vars['block']->value->id_sub)) {?><?php echo $_smarty_tpl->tpl_vars['block']->value->id_sub;?>
<?php }?>"/>
        <input type="hidden" name="id_block" value="<?php if (isset($_smarty_tpl->tpl_vars['block']->value->id_block)) {?><?php echo $_smarty_tpl->tpl_vars['block']->value->id_block;?>
<?php }?>"/>
		<div class="well">
           <div class="item-field form-group">
				<label class="control-label col-lg-3 ">Block width</label>
				<div class="col-lg-7">
                    <select class="form-control fixed-width-lg" name="block_widh" id="block_widh" >
                    <?php $_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int) ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? 9+1 - (3) : 3-(9)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0) {
for ($_smarty_tpl->tpl_vars['foo']->value = 3, $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++) {
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration == 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration == $_smarty_tpl->tpl_vars['foo']->total;?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['block']->value->width)&&$_smarty_tpl->tpl_vars['block']->value->width==$_smarty_tpl->tpl_vars['foo']->value) {?>selected="selected"<?php }?>>col-sm-<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
</option>
                    <?php }} ?>
                    <option value="12" <?php if (isset($_smarty_tpl->tpl_vars['block']->value->width)&&$_smarty_tpl->tpl_vars['block']->value->width==12) {?>selected="selected"<?php }?>>col-sm-12</option>
                    </select>
				</div>
			</div>
            <div class="item-field form-group">
				<label class="control-label col-lg-3 ">class</label>
				<div class="col-lg-7">
					<input type="text" name="block_class" value="<?php if (isset($_smarty_tpl->tpl_vars['block']->value->class)) {?><?php echo $_smarty_tpl->tpl_vars['block']->value->class;?>
<?php }?>"/>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-7 col-lg-offset-3">
					<input type="hidden" name="updateItem" value=""/>
					<a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="btn btn-default button-new-item-cancel"><i class="icon-remove"></i> Cancel</a>
					<button type="submit" name="submitnewblock" class="button-new-item-save btn btn-default pull-right" onclick="this.form.submit();"><i class="icon-save"></i> Save</button>
				</div>
			</div>
		</div>
	</form>
</div><?php }} ?>
