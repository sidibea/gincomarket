<?php /* Smarty version Smarty-3.1.19, created on 2017-04-30 21:07:43
         compiled from "/home/abdouhanne/www/pr/modules/groupcategory/views/templates/admin/modules.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17783000825906521fb4b8a3-55138732%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b84e7f6e6bfa14eefa4f89212858c47d261d645f' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/groupcategory/views/templates/admin/modules.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17783000825906521fb4b8a3-55138732',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'secure_key' => 0,
    'baseModuleUrl' => 0,
    'currentUrl' => 0,
    'langId' => 0,
    'iso' => 0,
    'ad' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5906521fb766d9_49784095',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5906521fb766d9_49784095')) {function content_5906521fb766d9_49784095($_smarty_tpl) {?><div class="col-md-3 col-lg-2">    <div class="list-group" id="list-group">        <a href="#list-style" class="list-group-item active"><?php echo smartyTranslate(array('s'=>'List style','mod'=>'groupcategory'),$_smarty_tpl);?>
</a>        <a href="#module-groups" class="list-group-item"><?php echo smartyTranslate(array('s'=>'List group','mod'=>'groupcategory'),$_smarty_tpl);?>
</a>            </div></div><div class="col-md-9 col-lg-10">    <div class="tab-content">        <div id="list-style" class="tab-pane fade in active">                        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['style_tpl']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
                    </div>        <div id="module-groups" class="tab-pane fade">            <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['group_tpl']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
                    </div>            </div></div><div class="clearfix"></div><?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'lab_delete')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'lab_delete'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Delete','mod'=>'groupcategory','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'lab_delete'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'lab_disable')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'lab_disable'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Disable','mod'=>'groupcategory','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'lab_disable'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'lab_enable')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'lab_enable'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Enable','mod'=>'groupcategory','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'lab_enable'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<script type="text/javascript">	$(document).on('focusin', function(e) {        if ($(e.target).closest(".mce-window").length) {    		e.stopImmediatePropagation();    	}    });        var secure_key			= "<?php echo $_smarty_tpl->tpl_vars['secure_key']->value;?>
";    var baseModuleUrl 		= "<?php echo $_smarty_tpl->tpl_vars['baseModuleUrl']->value;?>
";    var currentUrl 			= "<?php echo $_smarty_tpl->tpl_vars['currentUrl']->value;?>
";    var currentLanguage 	= "<?php echo $_smarty_tpl->tpl_vars['langId']->value;?>
";           var groupId 			= '0';        var iso 				= '<?php echo $_smarty_tpl->tpl_vars['iso']->value;?>
';        var ad 					= "<?php echo $_smarty_tpl->tpl_vars['ad']->value;?>
";        var formNewRow 			= '';    var groupFormNew_config 		= '';        var groupFormNew_description 	= '';    var groupFormNew_products 		= '';    var itemFormNew	='';    var catGroupId = '0';</script><?php }} ?>
