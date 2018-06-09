<?php /* Smarty version Smarty-3.1.19, created on 2018-06-06 16:35:19
         compiled from "/home/abdouhanne/www/modules/advancetopmenu/views/templates/admin/main_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6510249825b180d477d0755-58453575%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a7c5187634c6cb196d16ed549da2e37bdd6a877' => 
    array (
      0 => '/home/abdouhanne/www/modules/advancetopmenu/views/templates/admin/main_form.tpl',
      1 => 1493588696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6510249825b180d477d0755-58453575',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'form' => 0,
    'postAction' => 0,
    'ajaxUrl' => 0,
    'list_items' => 0,
    'menu_item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b180d47812374_18880153',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b180d47812374_18880153')) {function content_5b180d47812374_18880153($_smarty_tpl) {?><div class="panel">
    <h3><i class="icon-list-ul"></i><?php echo $_smarty_tpl->tpl_vars['form']->value;?>
 <?php echo smartyTranslate(array('s'=>'Item','mod'=>'advancetopmenu'),$_smarty_tpl);?>

	<span class="panel-heading-action">
		<a class="list-toolbar-btn" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submit_edit_item&block=0">
			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Add <?php echo $_smarty_tpl->tpl_vars['form']->value;?>
 item" data-html="true">
				<i class="process-icon-new "></i>
			</span>
		</a>
	</span>
	</h3>
	
    <div class="main-container">
        <input type="hidden" id="ajaxUrl" name="ajaxUrl" value="<?php echo $_smarty_tpl->tpl_vars['ajaxUrl']->value;?>
"/>
        <form method="post" action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" enctype="multipart/form-data" class="item-form defaultForm  form-horizontal">
            <div class="table-responsive clearfix main_list">
                <ul class="list-unstyled<?php if (count($_smarty_tpl->tpl_vars['list_items']->value)>1) {?> sortable<?php }?>">
                <?php  $_smarty_tpl->tpl_vars['menu_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list_items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu_item']->key => $_smarty_tpl->tpl_vars['menu_item']->value) {
$_smarty_tpl->tpl_vars['menu_item']->_loop = true;
?>
                    <li class="main-item list-item">
                        <span class="hidden"><?php echo $_smarty_tpl->tpl_vars['menu_item']->value['id_item'];?>
</span>
                        <span class="item-name"><?php if ($_smarty_tpl->tpl_vars['menu_item']->value['icon']) {?><i class="<?php echo $_smarty_tpl->tpl_vars['menu_item']->value['icon'];?>
"></i><?php }?><?php echo $_smarty_tpl->tpl_vars['menu_item']->value['title'];?>
</span>
                        <span class="action-container">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['postAction']->value;?>
&changeactive&item_id=<?php echo $_smarty_tpl->tpl_vars['menu_item']->value['id_item'];?>
" data-toggle="tooltip" class="label-tooltip" data-html="true"
                                <?php if ($_smarty_tpl->tpl_vars['menu_item']->value['active']) {?>
                                    data-original-title="Active" >
                                    <img src="<?php echo @constant('_PS_ADMIN_IMG_');?>
ok.gif" alt="" /> 
                                <?php } else { ?>
                                    data-original-title="Dective" >
                                    <img src="<?php echo @constant('_PS_ADMIN_IMG_');?>
forbbiden.gif" alt="" />
                                <?php }?>
                            </a>
                            <a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submit_edit_item&block=<?php echo $_smarty_tpl->tpl_vars['menu_item']->value['id_block'];?>
&item_id=<?php echo $_smarty_tpl->tpl_vars['menu_item']->value['id_item'];?>
" class="edit_btn label-tooltip" data-toggle="tooltip" data-html="true" data-original-title="Edit"><i class="icon-edit"></i></a>
                            <a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submit_del_item&item_id=<?php echo $_smarty_tpl->tpl_vars['menu_item']->value['id_item'];?>
" class="edit_btn label-tooltip" data-toggle="tooltip" data-html="true" data-original-title="Delete" onclick="return confirm('Are you sure delete this main item (including it\'s submenu, submenu\'s blocks and block\'s items)')"><i class="icon-remove "></i></a>
                        </span>
                    </li>
                <?php } ?>
                </ul>
            </div>
        </form>
    </div>
</div><?php }} ?>
