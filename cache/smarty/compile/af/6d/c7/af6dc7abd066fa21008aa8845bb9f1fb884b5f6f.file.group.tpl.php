<?php /* Smarty version Smarty-3.1.19, created on 2017-04-30 21:07:43
         compiled from "/home/abdouhanne/www/pr/modules/groupcategory/views/templates/admin/group.tpl" */ ?>
<?php /*%%SmartyHeaderCode:748142345906521fb93ee1-53115953%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af6dc7abd066fa21008aa8845bb9f1fb884b5f6f' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/groupcategory/views/templates/admin/group.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '748142345906521fb93ee1-53115953',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'listGroup' => 0,
    'groupForm' => 0,
    'itemForm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5906521fbc4289_96047245',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5906521fbc4289_96047245')) {function content_5906521fbc4289_96047245($_smarty_tpl) {?><div class="panel">    <div class="panel-heading">    	<?php echo smartyTranslate(array('s'=>'List Group','mod'=>'groupcategory'),$_smarty_tpl);?>
<?php echo smartyTranslate(array('s'=>'Best Saller','mod'=>'groupcategory'),$_smarty_tpl);?>
		<span class="panel-heading-action">            <a href="javascript:void(0)" onclick="showModal('modalGroup', '')" class="list-toolbar-btn link-add"><i class="process-icon-new"></i></a>		</span>    </div>    <div class="panel-body" style="padding:0">        <div class="table-responsive">            <table class="table" id="groupList">    			<thead>    				<tr class="nodrag nodrop">                        <th width="50" class="center"><?php echo smartyTranslate(array('s'=>'ID','mod'=>'groupcategory'),$_smarty_tpl);?>
</th>                        <th><?php echo smartyTranslate(array('s'=>'Name','mod'=>'groupcategory'),$_smarty_tpl);?>
</th>                        <th><?php echo smartyTranslate(array('s'=>'Category','mod'=>'groupcategory'),$_smarty_tpl);?>
</th>                        <th><?php echo smartyTranslate(array('s'=>'Position ','mod'=>'groupcategory'),$_smarty_tpl);?>
</th>                        <th width="120" class="center"><?php echo smartyTranslate(array('s'=>'Style','mod'=>'groupcategory'),$_smarty_tpl);?>
</th>                        <th width="100" class="center"><?php echo smartyTranslate(array('s'=>'Ordering','mod'=>'groupcategory'),$_smarty_tpl);?>
</th>                        <th width="50" class="center"><?php echo smartyTranslate(array('s'=>'Status','mod'=>'groupcategory'),$_smarty_tpl);?>
</th>                        <th class="center" width="50">#</th>                    </tr>				                </thead>                <tbody><?php echo $_smarty_tpl->tpl_vars['listGroup']->value;?>
</tbody>    	       </table>                    </div>            </div> </div><div class="panel" id="panel-list-item" style="display: none">    <div class="panel-heading">    	<?php echo smartyTranslate(array('s'=>'Item in Group','mod'=>'groupcategory'),$_smarty_tpl);?>
&nbsp<span id="span-group-name"></span>		<span class="panel-heading-action">            <a href="javascript:void(0)" onclick="openAddItemModal()" class="list-toolbar-btn link-add"><i class="process-icon-new"></i></a>		</span>    </div>    <div class="panel-body" style="padding:0">        <div class="table-responsive">            <table class="table" id="itemList">    			<thead>    				<tr class="nodrag nodrop">                        <th width="50" class="center"><?php echo smartyTranslate(array('s'=>'ID','mod'=>'groupcategory'),$_smarty_tpl);?>
</th>                        <th><?php echo smartyTranslate(array('s'=>'Name','mod'=>'groupcategory'),$_smarty_tpl);?>
</th>                        <th width="250"><?php echo smartyTranslate(array('s'=>'Category','mod'=>'groupcategory'),$_smarty_tpl);?>
</th>                        <th width="100" class="center"><?php echo smartyTranslate(array('s'=>'Ordering','mod'=>'groupcategory'),$_smarty_tpl);?>
</th>                        <th width="50" class="center"><?php echo smartyTranslate(array('s'=>'Status','mod'=>'groupcategory'),$_smarty_tpl);?>
</th>                        <th class="center" width="50">#</th>                    </tr>				                </thead>                <tbody>                                    </tbody>    	       </table>                    </div>            </div> </div><!-- Modal --><div id="modalGroup" class="modal fade" tabindex="-1">    <div class="modal-dialog modal-lg">        <div class="modal-content">            <div class="modal-header">                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                <span class="modal-title"><i class="icon-cloud"></i><?php echo smartyTranslate(array('s'=>' Add or Edit Group','mod'=>'groupcategory'),$_smarty_tpl);?>
</span>            </div>            <div class="modal-body form-horizontal" id="forgotBody">                <form id="frmGroup">                	<div class="clearfix">                        <div class="groupcategory-tab-links text-center" id="tab-groups">                            <a href="#group-config" class="tab-item active"><?php echo smartyTranslate(array('s'=>'Group config','mod'=>"groupcategory"),$_smarty_tpl);?>
</a>                            <a href="#group-products-config" class="tab-item"><?php echo smartyTranslate(array('s'=>'Products config','mod'=>"groupcategory"),$_smarty_tpl);?>
</a>                                                               </div>                    </div>                         <div class="tab-content">                                                        <div id="group-config" class="tab-pane fade in active">                            <?php echo $_smarty_tpl->tpl_vars['groupForm']->value['config'];?>
                        </div>                        <div id="group-products-config" class="tab-pane fade">                            <?php echo $_smarty_tpl->tpl_vars['groupForm']->value['product_config'];?>
                                                   </div>                                            </div> 	                </form>            </div>            <div class="modal-footer">                                <button type="button" class="btn btn-primary btnForgot" onclick="saveGroup()"><i class="icon-save"></i> <?php echo smartyTranslate(array('s'=>'Save','mod'=>'groupcategory'),$_smarty_tpl);?>
</button>            </div>        </div>    </div></div><div id="modalItem" class="modal fade" tabindex="-1">    <div class="modal-dialog modal-lg">        <div class="modal-content">            <div class="modal-header">                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                <span class="modal-title"><i class="icon-cloud"></i><?php echo smartyTranslate(array('s'=>' Add or Edit Item','mod'=>'groupcategory'),$_smarty_tpl);?>
</span>            </div>            <div class="modal-body form-horizontal" id="forgotBody">                <form id="frmItem"><?php echo $_smarty_tpl->tpl_vars['itemForm']->value;?>
</form>                                         </div>            <div class="modal-footer">                                <button type="button" class="btn btn-primary btnForgot" onclick="saveItem()"><i class="icon-save"></i> <?php echo smartyTranslate(array('s'=>'Save','mod'=>'groupcategory'),$_smarty_tpl);?>
</button>            </div>        </div>    </div></div><div class="clearfix"></div><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['dialog_product']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['dialog_feature']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['dialog_manufacturer']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
