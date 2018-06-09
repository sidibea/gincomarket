<?php /* Smarty version Smarty-3.1.19, created on 2018-06-06 16:16:40
         compiled from "/home/abdouhanne/www/modules/advancetopmenu/views/templates/admin/sub_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5214185025b1808e8a70276-93011327%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2ec5a2d8ed5ed77b634b468731c1d08f1b9ccb4e' => 
    array (
      0 => '/home/abdouhanne/www/modules/advancetopmenu/views/templates/admin/sub_form.tpl',
      1 => 1493588696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5214185025b1808e8a70276-93011327',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'form' => 0,
    'postAction' => 0,
    'submenu' => 0,
    'main_items' => 0,
    'menu_item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1808e8aba5c4_68992691',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1808e8aba5c4_68992691')) {function content_5b1808e8aba5c4_68992691($_smarty_tpl) {?><div class="panel">
	<div class="panel-heading">
		<?php echo $_smarty_tpl->tpl_vars['form']->value;?>
 <?php echo smartyTranslate(array('s'=>'Menu setting','mod'=>'advancetopmenu'),$_smarty_tpl);?>

    </div>
    <form method="post" action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" enctype="multipart/form-data" class="item-form defaultForm  form-horizontal">
        <input type="hidden" name="id_sub" value="<?php if (isset($_smarty_tpl->tpl_vars['submenu']->value->id_sub)) {?><?php echo $_smarty_tpl->tpl_vars['submenu']->value->id_sub;?>
<?php }?>"/>
		<div class="well">
            <div class="item-field form-group">
				<label class="control-label col-lg-3">Parent menu</label>
				<div class="col-lg-7">
					<select class="form-control fixed-width-lg" name="id_parent" id="id_parent" >
                        <?php if (count($_smarty_tpl->tpl_vars['main_items']->value)>0) {?>
                            <?php  $_smarty_tpl->tpl_vars['menu_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['main_items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu_item']->key => $_smarty_tpl->tpl_vars['menu_item']->value) {
$_smarty_tpl->tpl_vars['menu_item']->_loop = true;
?>
        						<option <?php if (isset($_smarty_tpl->tpl_vars['submenu']->value->id_parent)&&$_smarty_tpl->tpl_vars['submenu']->value->id_parent==$_smarty_tpl->tpl_vars['menu_item']->value['id_item']) {?>selected="selected"<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['menu_item']->value['id_item'];?>
"><?php echo $_smarty_tpl->tpl_vars['menu_item']->value['title'];?>
</option>
                            <?php } ?>
                        <?php }?>
					</select>
				</div>
			</div>
           <div class="item-field form-group">
				<label class="control-label col-lg-3 ">Width</label>
				<div class="col-lg-7">
					<input class="form-control" type="text" name="subwidth" value="<?php if (isset($_smarty_tpl->tpl_vars['submenu']->value->width)) {?><?php echo $_smarty_tpl->tpl_vars['submenu']->value->width;?>
<?php }?>"/>
                    <p class="help-block newline"><?php echo smartyTranslate(array('s'=>'(If empty, the global styles are used)','mod'=>'advancetopmenu'),$_smarty_tpl);?>
</p>
				</div>
                <p class="help-block"><?php echo smartyTranslate(array('s'=>'px','mod'=>'advancetopmenu'),$_smarty_tpl);?>
</p>

			</div>

            <div class="item-field form-group">
				<label class="control-label col-lg-3 ">class</label>
				<div class="col-lg-7">
					<input type="text" name="sub_class" value="<?php if (isset($_smarty_tpl->tpl_vars['submenu']->value->class)) {?><?php echo $_smarty_tpl->tpl_vars['submenu']->value->class;?>
<?php }?>"/>
				</div>
			</div>
            <div class="item-field form-group ">
                <label for="active" class="control-label col-lg-3">Active</label>
                <div class="col-lg-9">
                    <div class="form-group">
                        <div class="col-lg-9">
                            <span class="switch prestashop-switch fixed-width-lg">
                                <input type="radio" name="active" id="active_on" <?php if (isset($_smarty_tpl->tpl_vars['submenu']->value->active)&&$_smarty_tpl->tpl_vars['submenu']->value->active==1) {?>checked="checked"<?php }?> value="1"/>
                                <label for="active_on">Yes</label>
                                <input type="radio" name="active" id="active_off" <?php if (isset($_smarty_tpl->tpl_vars['submenu']->value->active)&&$_smarty_tpl->tpl_vars['submenu']->value->active==0||!isset($_smarty_tpl->tpl_vars['submenu']->value->active)) {?>checked="checked"<?php }?> value="0" />
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
					<button type="submit" name="submitnewsub" class="button-new-item-save btn btn-default pull-right" onclick="this.form.submit();"><i class="icon-save"></i> Save</button>
				</div>
			</div>
		</div>
	</form>
</div><?php }} ?>
