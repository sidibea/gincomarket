<?php /* Smarty version Smarty-3.1.19, created on 2017-04-30 17:27:17
         compiled from "/home/abdouhanne/www/pr/modules/advancefooter/views/templates/admin/row_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:185633872359061e75908c25-16945018%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c19a3f9ea44a44c1c4b57843980276b656fd034' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/advancefooter/views/templates/admin/row_form.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '185633872359061e75908c25-16945018',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'postAction' => 0,
    'footer_row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59061e7593ca67_63241316',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59061e7593ca67_63241316')) {function content_59061e7593ca67_63241316($_smarty_tpl) {?><div class="panel">
	<div class="panel-heading">
		<?php echo smartyTranslate(array('s'=>'Row setting','mod'=>'advancefooter'),$_smarty_tpl);?>

    </div>
    <form method="post" action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" enctype="multipart/form-data" class="item-form defaultForm  form-horizontal">
        <input type="hidden" name="id_row" value="<?php if (isset($_smarty_tpl->tpl_vars['footer_row']->value->id_row)) {?><?php echo $_smarty_tpl->tpl_vars['footer_row']->value->id_row;?>
<?php }?>"/>
		<div class="well">
           <div class="item-field form-group">
				<label class="control-label col-lg-3 ">class</label>
				<div class="col-lg-7">
					<input type="text" name="row_class" value="<?php if (isset($_smarty_tpl->tpl_vars['footer_row']->value->rclass)) {?><?php echo $_smarty_tpl->tpl_vars['footer_row']->value->rclass;?>
<?php }?>"/>
				</div>
			</div>
            <div class="item-field form-group ">
                <label for="active" class="control-label col-lg-3">Active</label>
                <div class="col-lg-9">
                    <div class="form-group">
                        <div class="col-lg-9">
                            <span class="switch prestashop-switch fixed-width-lg">
                                <input type="radio" name="active" id="active_on" <?php if (isset($_smarty_tpl->tpl_vars['footer_row']->value->active)&&$_smarty_tpl->tpl_vars['footer_row']->value->active==1) {?>checked="checked"<?php }?> value="1"/>
                                <label for="active_on">Yes</label>
                                <input type="radio" name="active" id="active_off" <?php if (isset($_smarty_tpl->tpl_vars['footer_row']->value->active)&&$_smarty_tpl->tpl_vars['footer_row']->value->active==0||!isset($_smarty_tpl->tpl_vars['footer_row']->value->active)) {?>checked="checked"<?php }?> value="0" />
                                <label for="active_off">No</label>
                                <a class="slide-button btn"></a>
                            </span>
                        </div>
                        <div class="col-lg-2">
						</div>	
                    </div>
                </div>
            </div>
			<div class="form-group">
				<div class="col-lg-7 col-lg-offset-3">
					<input type="hidden" name="updateItem" value=""/>
					<a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="btn btn-default button-new-item-cancel"><i class="icon-remove"></i> Cancel</a>
					<button type="submit" name="submitnewrow" class="button-new-item-save btn btn-default pull-right" onclick="this.form.submit();"><i class="icon-save"></i> Save</button>
				</div>
			</div>
		</div>
	</form>
</div><?php }} ?>
