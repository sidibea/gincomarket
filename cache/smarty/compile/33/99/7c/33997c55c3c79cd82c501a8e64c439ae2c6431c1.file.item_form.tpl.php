<?php /* Smarty version Smarty-3.1.19, created on 2018-06-06 16:15:04
         compiled from "/home/abdouhanne/www/modules/advancetopmenu/views/templates/admin/item_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8271440645b1808889e4c13-84367071%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33997c55c3c79cd82c501a8e64c439ae2c6431c1' => 
    array (
      0 => '/home/abdouhanne/www/modules/advancetopmenu/views/templates/admin/item_form.tpl',
      1 => 1493588696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8271440645b1808889e4c13-84367071',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'postAction' => 0,
    'item' => 0,
    'langguages' => 0,
    'lang' => 0,
    'lang_ul' => 0,
    'link_text' => 0,
    'default_link_option' => 0,
    'absoluteUrl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b180888acf260_48486297',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b180888acf260_48486297')) {function content_5b180888acf260_48486297($_smarty_tpl) {?><div class="item-container">
      <form method="post" action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" enctype="multipart/form-data" class="item-form defaultForm  form-horizontal">
        <input type="hidden" name="item_id" value="<?php if (isset($_smarty_tpl->tpl_vars['item']->value->id_item)) {?><?php echo $_smarty_tpl->tpl_vars['item']->value->id_item;?>
<?php }?>"/>
        <input type="hidden" name="block_id" value="<?php if (isset($_smarty_tpl->tpl_vars['item']->value->id_block)) {?><?php echo $_smarty_tpl->tpl_vars['item']->value->id_block;?>
<?php }?>"/>
		<div class="well">
            <div class="item-field form-group">
				<label class="control-label col-lg-3">Type</label>
				<div class="col-lg-9">
                    <div class="form-group">
			            <div class="col-lg-9">
			                <select class="form-control fixed-width-lg" name="linktype" id="linktype" >
        						<option <?php if (isset($_smarty_tpl->tpl_vars['item']->value->type)&&$_smarty_tpl->tpl_vars['item']->value->type=='link') {?>selected="selected"<?php }?> value="link">Link</option>
        						<option <?php if (isset($_smarty_tpl->tpl_vars['item']->value->type)&&$_smarty_tpl->tpl_vars['item']->value->type=='img') {?>selected="selected"<?php }?> value="img">Image</option>
        						<option <?php if (isset($_smarty_tpl->tpl_vars['item']->value->type)&&$_smarty_tpl->tpl_vars['item']->value->type=='html') {?>selected="selected"<?php }?> value="html">Custom html</option>
        					</select>
			            </div>
						<div class="col-lg-2">
						</div>	
                     </div>                     					
				</div>
			</div>
			<div class="title item-field form-group">
				<label id="title_lb" class="control-label col-lg-3 ">Title</label>
                <div class="col-lg-9">
                    <div class="form-group">
                        <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['langguages']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value) {
$_smarty_tpl->tpl_vars['lang']->_loop = true;
?>
                            <div class="translatable-field lang-<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['lang']->value['id_lang'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['langguages']->value['default_lang']!=$_smarty_tpl->tpl_vars['lang']->value['id_lang']) {?>style="display:none"<?php }?>>
    				            <div class="col-lg-9">
    				                <input class="form-control" type="text" id="item_title" name="item_title_<?php echo $_smarty_tpl->tpl_vars['lang']->value['id_lang'];?>
" value="<?php if (isset($_smarty_tpl->tpl_vars['item']->value->title[$_smarty_tpl->tpl_vars['lang']->value['id_lang']])) {?><?php echo $_smarty_tpl->tpl_vars['item']->value->title[$_smarty_tpl->tpl_vars['lang']->value['id_lang']];?>
<?php }?>"/>
    				            </div>
    							<div class="col-lg-2">
    								<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
    									<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['lang']->value['iso_code'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

    									<i class="icon-caret-down"></i>
    								</button>
    								<?php echo $_smarty_tpl->tpl_vars['lang_ul']->value;?>

    							</div>
    						</div>
						  <?php } ?>	
                     </div>                     					
				</div>
			</div>
            <div id="linkContainer" class="link_detail">
                <div class="item-field form-group">
    				<label class="control-label col-lg-3 ">Icon</label>
    				<div class="col-lg-9">
                        <div class="form-group">
                            <div class="col-lg-9">
            					<input class="form-control" type="text" name="item_icon" value="<?php if (isset($_smarty_tpl->tpl_vars['item']->value->icon)) {?><?php echo $_smarty_tpl->tpl_vars['item']->value->icon;?>
<?php }?>"/>
                                <p class="help-block newline">
                                <?php echo smartyTranslate(array('s'=>'Ex: "icon-camera". ','mod'=>'advancetopmenu'),$_smarty_tpl);?>

                                <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/3.2.1/icons/"><?php echo smartyTranslate(array('s'=>'The complete set of 361 icons in Font Awesome 3.2.1','mod'=>'advancetopmenu'),$_smarty_tpl);?>
</a></p>
                            </div>
                            <div class="col-lg-2">
                            </div>
                        </div>
    				</div>
                    	
    			</div>
            </div>
            <div id="link_field" class="link_detail">
                <div class="item-field form-group">
    				<label class="control-label col-lg-3 ">Custom Link</label>
    				<div class="col-lg-9">
                        <div class="form-group">
                            <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['langguages']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value) {
$_smarty_tpl->tpl_vars['lang']->_loop = true;
?>
                                <div class="translatable-field lang-<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['lang']->value['id_lang'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['langguages']->value['default_lang']!=$_smarty_tpl->tpl_vars['lang']->value['id_lang']) {?>style="display:none"<?php }?>>
        				            <div class="col-lg-9">
                                        <input class="form-control" type="text" id="link_text" placeholder="http://" name="link" value="<?php if (isset($_smarty_tpl->tpl_vars['link_text']->value[$_smarty_tpl->tpl_vars['lang']->value['id_lang']])) {?><?php echo $_smarty_tpl->tpl_vars['link_text']->value[$_smarty_tpl->tpl_vars['lang']->value['id_lang']];?>
<?php }?>"/>
        				            </div>
        							<div class="col-lg-2">
                                        <p class="help-block"><?php echo smartyTranslate(array('s'=>'or','mod'=>'advancetopmenu'),$_smarty_tpl);?>
</p>
        							</div>
        						</div>
    						  <?php } ?>
                              <input type="hidden" name="link_value" id="link_value" value="<?php if (isset($_smarty_tpl->tpl_vars['item']->value->link)) {?><?php echo $_smarty_tpl->tpl_vars['item']->value->link;?>
<?php }?>"/>
                            </div>
                        </div>                                                            
    				</div>                  
    			</div>
                <div class="item-field form-group">
    				<label class="control-label col-lg-3 ">Prestashop Link</label>
    				<div class="col-lg-9">
                        <div class="form-group">
                            <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['langguages']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value) {
$_smarty_tpl->tpl_vars['lang']->_loop = true;
?>
                            <div class="translatable-field lang-<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['lang']->value['id_lang'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['langguages']->value['default_lang']!=$_smarty_tpl->tpl_vars['lang']->value['id_lang']) {?>style="display:none"<?php }?>>
    				            <div class="col-lg-9">
                                    <select class="form-control fixed-width-lg link_select" name="link_select" id="link_select_<?php echo $_smarty_tpl->tpl_vars['lang']->value['id_lang'];?>
" >
                                        <option selected="selected">--</option>
                						<?php echo $_smarty_tpl->tpl_vars['default_link_option']->value[$_smarty_tpl->tpl_vars['lang']->value['id_lang']];?>

                					</select>
    				            </div>
    							<div class="col-lg-2">
    							</div>
    						</div>
						  <?php } ?>
                        </div>                                                            
    				</div>                  
                </div>

            <div id="imgContainer" class="link_detail">
    			<div class="image item-field form-group">
    				<label class="control-label col-lg-3">Image</label>
    				<div class="col-lg-9">
                        <div class="form-group">
                            <div class="col-lg-9">
                                <?php if (isset($_smarty_tpl->tpl_vars['item']->value->icon)&&isset($_smarty_tpl->tpl_vars['item']->value->type)&&$_smarty_tpl->tpl_vars['item']->value->type=='img') {?>
                                    <img class="img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['absoluteUrl']->value;?>
img/<?php echo $_smarty_tpl->tpl_vars['item']->value->icon;?>
" alt="" />
                                <?php }?>
            					<input type="file" name="item_img" />
                                <input type="hidden" name="old_img" value="<?php if (isset($_smarty_tpl->tpl_vars['item']->value->icon)) {?><?php echo $_smarty_tpl->tpl_vars['item']->value->icon;?>
<?php }?>"/>
                            </div>
                            <div class="col-lg-2">
                            </div>
                        </div>
					</div>                    
    			</div>
            </div>
            <div id="htmlContainer" class="link_detail">
                <div class="html item-field form-group">
    				<label class="control-label col-lg-3">HTML</label>
    				<div class="col-lg-9">
                        <div class="form-group">
                        <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['langguages']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value) {
$_smarty_tpl->tpl_vars['lang']->_loop = true;
?>
                            <div class="translatable-field lang-<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['lang']->value['id_lang'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['langguages']->value['default_lang']!=$_smarty_tpl->tpl_vars['lang']->value['id_lang']) {?>style="display:none"<?php }?>>
    				            <div class="col-lg-9">
    				                <textarea class="rte" name="item_html_<?php echo $_smarty_tpl->tpl_vars['lang']->value['id_lang'];?>
" style="margin-bottom:10px; height:300px;" ><?php if (isset($_smarty_tpl->tpl_vars['item']->value->text[$_smarty_tpl->tpl_vars['lang']->value['id_lang']])) {?><?php echo $_smarty_tpl->tpl_vars['item']->value->text[$_smarty_tpl->tpl_vars['lang']->value['id_lang']];?>
<?php }?></textarea>
    				            </div>
    							<div class="col-lg-2">
    								<button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">
    									<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['lang']->value['iso_code'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

    									<i class="icon-caret-down"></i>
    								</button>
    								<?php echo $_smarty_tpl->tpl_vars['lang_ul']->value;?>

    							</div>
    						</div>
						  <?php } ?>	
                     </div> 
    				</div>
    			</div>
            </div>
            <div class="item-field form-group">
				<label class="control-label col-lg-3 ">class</label>
				<div class="col-lg-9">
                    <div class="form-group">
                        <div class="col-lg-9">
        					<input type="text" id="custom_class_text" name="custom_class_text" value="<?php if (isset($_smarty_tpl->tpl_vars['item']->value->class)) {?><?php echo $_smarty_tpl->tpl_vars['item']->value->class;?>
<?php }?>"/>
                            <input type="hidden" name="custom_class" value="<?php if (isset($_smarty_tpl->tpl_vars['item']->value->class)) {?><?php echo $_smarty_tpl->tpl_vars['item']->value->class;?>
<?php }?>" id="custom_class"/>
                        </div>
                        <div class="col-lg-2">
                            <p class="help-block"><?php echo smartyTranslate(array('s'=>'or','mod'=>'advancetopmenu'),$_smarty_tpl);?>
</p>
                        </div>
                    </div>
				</div>
                
			</div>
            <div class="item-field form-group">
				<label class="control-label col-lg-3 ">Defined class</label>
				<div class="col-lg-9">
                    <div class="form-group">
                        <div class="col-lg-9">
        					<select class="form-control fixed-width-lg" name="custom_class_select" id="custom_class_select">
                                <option selected="selected">--</option>
        						<option value="group_header">Group header</option>
        						<option value="line">Line</option>
        					</select>
                        </div>
                    </div>
				</div>
            </div>
            <div class="item-field form-group ">
                    <label for="active" class="control-label col-lg-3">Active</label>
                    <div class="col-lg-9">
                        <div class="form-group">
                            <div class="col-lg-9">
                                <span class="switch prestashop-switch fixed-width-lg">
                                    <input type="radio" name="active" id="active_on" <?php if (isset($_smarty_tpl->tpl_vars['item']->value->active)&&$_smarty_tpl->tpl_vars['item']->value->active==1) {?>checked="checked"<?php }?> value="1"/>
                                    <label for="active_on">Yes</label>
                                    <input type="radio" name="active" id="active_off" <?php if (isset($_smarty_tpl->tpl_vars['item']->value->active)&&$_smarty_tpl->tpl_vars['item']->value->active==0||!isset($_smarty_tpl->tpl_vars['item']->value->active)) {?>checked="checked"<?php }?> value="0" />
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
				<div class="col-lg-9 col-lg-offset-3">
					<input type="hidden" name="updateItem" value=""/>
					<a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="btn btn-default button-new-item-cancel"><i class="icon-remove"></i> Cancel</a>
					<button type="submit" name="submitnewItem" class="button-new-item-save btn btn-default" onclick="this.form.submit();"><i class="icon-save"></i> Save</button>
				</div>
			</div>
		</div>
	</form>
</div>
<?php }} ?>
