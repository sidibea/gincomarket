<?php /* Smarty version Smarty-3.1.19, created on 2017-04-30 16:51:37
         compiled from "/home/abdouhanne/www/pr/modules/oviclayoutcontrol/views/templates/admin/layout_builder/new_popup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16653305906161950dd90-40748506%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e047d0cbff41fa3161055c9b04fad44dcd02163' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/oviclayoutcontrol/views/templates/admin/layout_builder/new_popup.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16653305906161950dd90-40748506',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'moduleOption' => 0,
    'hookname' => 0,
    'postUrl' => 0,
    'id_hook' => 0,
    'id_option' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5906161951fb74_51856894',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5906161951fb74_51856894')) {function content_5906161951fb74_51856894($_smarty_tpl) {?><div id="newmodule_popup" class="bootstrap popup_form">
        <div class="item-field form-group">
    		<label class="control-label">Module</label>
            <div class="form-group">
                <select class="form-control" name="moduleHook" id="moduleHook" >
                    <option>--</option>
					<?php echo $_smarty_tpl->tpl_vars['moduleOption']->value;?>

				</select>
             </div>
    	</div>
        <div class="item-field form-group">
    		<label class="control-label">Hook execute</label>
    		<div class="form-group">
                <select class="form-control" name="hookexec" id="hookexec" >
                    <option>--</option>
				</select>
    		</div>
    	</div>
        <div class="form-group">
    		<div class="center">
                
                <input type="hidden" name="hookname" id="hookname" value="<?php echo $_smarty_tpl->tpl_vars['hookname']->value;?>
"/>
                <input type="hidden" name="popupAjaxUrl" id="popupAjaxUrl" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postUrl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&ajax=1&id_hook=<?php echo $_smarty_tpl->tpl_vars['id_hook']->value;?>
&id_option=<?php echo $_smarty_tpl->tpl_vars['id_option']->value;?>
"/>
    			<button type="button" name="submitNewModuleHook" class="button-new-item-save btn btn-default" onclick="submitModuleHook($(this));"><i class="icon-save"></i> Save</button>
    		</div>
    	</div>
</div><?php }} ?>
