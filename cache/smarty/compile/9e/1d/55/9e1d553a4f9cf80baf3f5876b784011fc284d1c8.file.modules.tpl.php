<?php /* Smarty version Smarty-3.1.19, created on 2018-06-06 15:32:34
         compiled from "/home/abdouhanne/www/modules/verticalmegamenus/views/templates/admin/modules.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7542280855b17fe92d5b729-06287241%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9e1d553a4f9cf80baf3f5876b784011fc284d1c8' => 
    array (
      0 => '/home/abdouhanne/www/modules/verticalmegamenus/views/templates/admin/modules.tpl',
      1 => 1493588696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7542280855b17fe92d5b729-06287241',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'listLeftModule' => 0,
    'secure_key' => 0,
    'baseModuleUrl' => 0,
    'ad' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b17fe92d746f3_50273759',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b17fe92d746f3_50273759')) {function content_5b17fe92d746f3_50273759($_smarty_tpl) {?><div class="col-md-3 col-lg-2">
    <div class="list-group" id="list-group">
        <a href="#list-module" class="list-group-item active"><?php echo smartyTranslate(array('s'=>'Module list','mod'=>'mengamenus'),$_smarty_tpl);?>
</a>
        <?php echo $_smarty_tpl->tpl_vars['listLeftModule']->value;?>
        
    </div>
</div>
<div class="col-md-9 col-lg-10">
    <div class="tab-content">
        <div id="list-module" class="tab-pane fade in active">            
            <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['list_module_tpl']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
            
        </div>
        <div id="item-module" class="tab-pane fade">
            <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['list_menu_tpl']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
            
        </div>        
    </div>
</div>
<div class="clearfix"></div>
<script type="text/javascript">
	$(document).on('focusin', function(e) {
        if ($(e.target).closest(".mce-window").length) {
    		e.stopImmediatePropagation();
    	}
    });
    var secure_key = "<?php echo $_smarty_tpl->tpl_vars['secure_key']->value;?>
";
    var baseModuleUrl = "<?php echo $_smarty_tpl->tpl_vars['baseModuleUrl']->value;?>
";
    var verticalModuleId = '0';
    var verticalMenuId = '0';
    var verticalGroupId = '0';
    var verticalGroupType = '';
    var iso = 'en';    
    var ad = "<?php echo $_smarty_tpl->tpl_vars['ad']->value;?>
";
    var moduleFormNew = '';
    var menuFormNew = '';
    var menuGroupFormNew = '';
    var menuItemFormNew = '';
</script><?php }} ?>
