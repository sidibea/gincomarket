<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 15:19:43
         compiled from "/home/abdouhanne/www/pr/modules/ovicstoremap/views/templates/admin/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:128500836959020c0f0ffb05-72787037%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88781a2a74266f90109257f778e4e86f35d7f6f5' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/ovicstoremap/views/templates/admin/main.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128500836959020c0f0ffb05-72787037',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'postAction' => 0,
    'langguages' => 0,
    'lang' => 0,
    'STORE_CONTACT_INFO' => 0,
    'lang_ul' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59020c0f124317_28934955',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59020c0f124317_28934955')) {function content_59020c0f124317_28934955($_smarty_tpl) {?><div class="panel">
    <h3><i class="icon-cogs"></i><?php echo smartyTranslate(array('s'=>' Setting','mod'=>'blocktestimonial'),$_smarty_tpl);?>

    </h3>
    <div class="main-container">
        <form method="post" action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" enctype="multipart/form-data" class="item-form defaultForm  form-horizontal">
    		<div class="well">
                <div class="html item-field form-group">
                	<label class="control-label col-lg-3">Description</label>
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
                	                <textarea class="rte" name="STORE_CONTACT_INFO_<?php echo $_smarty_tpl->tpl_vars['lang']->value['id_lang'];?>
" style="margin-bottom:10px; height:300px;" ><?php if (isset($_smarty_tpl->tpl_vars['STORE_CONTACT_INFO']->value[$_smarty_tpl->tpl_vars['lang']->value['id_lang']])) {?><?php echo $_smarty_tpl->tpl_vars['STORE_CONTACT_INFO']->value[$_smarty_tpl->tpl_vars['lang']->value['id_lang']];?>
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
                <div class="panel-footer">
				    <button type="submit" value="1" id="module_form_submit_btn" name="submitGlobal" class="btn btn-default pull-right">
						<i class="process-icon-save"></i> Save
				    </button>
				</div>
    		</div>
    	</form>
    </div>
</div><?php }} ?>
