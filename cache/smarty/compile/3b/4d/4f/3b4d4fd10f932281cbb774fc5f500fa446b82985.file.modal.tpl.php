<?php /* Smarty version Smarty-3.1.19, created on 2018-06-07 15:34:35
         compiled from "/home/abdouhanne/www/admin230brwew5/themes/default/template/helpers/modules_list/modal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5488089465b19508b625390-57068863%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b4d4fd10f932281cbb774fc5f500fa446b82985' => 
    array (
      0 => '/home/abdouhanne/www/admin230brwew5/themes/default/template/helpers/modules_list/modal.tpl',
      1 => 1494086824,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5488089465b19508b625390-57068863',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b19508b628cf0_19643402',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b19508b628cf0_19643402')) {function content_5b19508b628cf0_19643402($_smarty_tpl) {?><div class="modal fade" id="modules_list_container">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title"><?php echo smartyTranslate(array('s'=>'Recommended Modules and Services'),$_smarty_tpl);?>
</h3>
			</div>
			<div class="modal-body">
				<div id="modules_list_container_tab_modal" style="display:none;"></div>
				<div id="modules_list_loader"><i class="icon-refresh icon-spin"></i></div>
			</div>
		</div>
	</div>
</div>
<?php }} ?>
