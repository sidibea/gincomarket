<?php /* Smarty version Smarty-3.1.19, created on 2017-04-30 16:47:47
         compiled from "/home/abdouhanne/www/pr/modules/blockhtml/views/templates/admin/html_content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14885722615906153354cdb0-44154048%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '07b4e3bb4e45cfd9eb35c845126366e61af70771' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/blockhtml/views/templates/admin/html_content.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14885722615906153354cdb0-44154048',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'langguages' => 0,
    'lang' => 0,
    'item' => 0,
    'lang_ul' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59061533593090_70781956',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59061533593090_70781956')) {function content_59061533593090_70781956($_smarty_tpl) {?><div class="title item-field form-group">
	<label id="title_lb" class="control-label col-lg-2 ">Title</label>
    <div class="col-lg-10">
        <div class="form-group">
            <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['langguages']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value) {
$_smarty_tpl->tpl_vars['lang']->_loop = true;
?>
                <div class="translatable-field lang-<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['lang']->value['id_lang'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['langguages']->value['default_lang']!=$_smarty_tpl->tpl_vars['lang']->value['id_lang']) {?>style="display:none"<?php }?>>
		            <div class="col-lg-10">
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
<div class="html item-field form-group">
	<label class="control-label col-lg-2">HTML</label>
	<div class="col-lg-10">
        <div class="form-group">
        <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['langguages']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value) {
$_smarty_tpl->tpl_vars['lang']->_loop = true;
?>
            <div class="translatable-field lang-<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['lang']->value['id_lang'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['langguages']->value['default_lang']!=$_smarty_tpl->tpl_vars['lang']->value['id_lang']) {?>style="display:none"<?php }?>>
	            <div class="col-lg-10">
	                <textarea class="rte" name="item_html_<?php echo $_smarty_tpl->tpl_vars['lang']->value['id_lang'];?>
" style="margin-bottom:10px; height:300px;" ><?php if (isset($_smarty_tpl->tpl_vars['item']->value->content[$_smarty_tpl->tpl_vars['lang']->value['id_lang']])) {?><?php echo $_smarty_tpl->tpl_vars['item']->value->content[$_smarty_tpl->tpl_vars['lang']->value['id_lang']];?>
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
<div class="item-field form-group ">
    <label for="active" class="control-label col-lg-2">Active</label>
    <div class="col-lg-10">
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
</div><?php }} ?>
