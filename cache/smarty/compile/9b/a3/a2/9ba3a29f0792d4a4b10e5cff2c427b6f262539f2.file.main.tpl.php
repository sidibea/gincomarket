<?php /* Smarty version Smarty-3.1.19, created on 2017-04-30 17:26:25
         compiled from "/home/abdouhanne/www/pr/modules/advancefooter/views/templates/admin/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:197528016959061e41b96e20-07135306%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ba3a29f0792d4a4b10e5cff2c427b6f262539f2' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/advancefooter/views/templates/admin/main.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197528016959061e41b96e20-07135306',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ajaxUrl' => 0,
    'postAction' => 0,
    'footer_data' => 0,
    'row' => 0,
    'block_obj' => 0,
    'langguages' => 0,
    'lang' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59061e41c246d0_08349076',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59061e41c246d0_08349076')) {function content_59061e41c246d0_08349076($_smarty_tpl) {?><input type="hidden" id="ajaxUrl" name="ajaxUrl" value="<?php echo $_smarty_tpl->tpl_vars['ajaxUrl']->value;?>
"/>
<div class="panel" >
    <h3><i class="icon-list-ul"></i><?php echo smartyTranslate(array('s'=>' Footer Configuration','mod'=>'advancefooter'),$_smarty_tpl);?>

	<span class="panel-heading-action">
		<a class="list-toolbar-btn" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submitRow">
			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Add new row" data-html="true">
				<i class="process-icon-new "></i>
			</span>
		</a>
	</span>
	</h3>
    <?php if (isset($_smarty_tpl->tpl_vars['footer_data']->value)&&count($_smarty_tpl->tpl_vars['footer_data']->value)>0) {?>
        <div class="row_sortable">
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['footer_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['footer']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['footer']['iteration']++;
?>
            <div class="panel row_container">
                <span class="hidden row_id"><?php echo $_smarty_tpl->tpl_vars['row']->value['id_row'];?>
</span>
                <h3><i class="icon-list-ul"></i><?php echo smartyTranslate(array('s'=>' Footer row ','mod'=>'advancefooter'),$_smarty_tpl);?>
<span class="row_postition"><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['footer']['iteration'];?>
</span>
                    <span class="panel-heading-action status">
                		<a class="list-toolbar-btn" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&changestatus&id_row=<?php echo $_smarty_tpl->tpl_vars['row']->value['id_row'];?>
">
                			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Change status" data-html="true">
                				<?php if ($_smarty_tpl->tpl_vars['row']->value['active']) {?>
                                    <img src="<?php echo @constant('_PS_ADMIN_IMG_');?>
ok.gif" alt="" />
                                <?php } else { ?>
                                    <img src="<?php echo @constant('_PS_ADMIN_IMG_');?>
forbbiden.gif" alt="" />
                                <?php }?>
                			</span>
                		</a>
                	</span>
                    <span class="panel-heading-action edit">
                		<a class="list-toolbar-btn" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submitRow&id_row=<?php echo $_smarty_tpl->tpl_vars['row']->value['id_row'];?>
">
                			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Edit row" data-html="true">
                				<i class="process-icon-edit "></i>
                			</span>
                		</a>
                	</span>
                    <span class="panel-heading-action">
                		<a class="list-toolbar-btn" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submit_del_row&id_row=<?php echo $_smarty_tpl->tpl_vars['row']->value['id_row'];?>
" onclick="return confirm('Are you sure delete this row, including row\'s blocks and block\'s items?')">
                			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Delete row" data-html="true">
                				<i class="process-icon-delete "></i>
                			</span>
                		</a>
                	</span>
                </h3>
                <div class="form-group">
            		<a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submitBlock&block_row=<?php echo $_smarty_tpl->tpl_vars['row']->value['id_row'];?>
&addblock=1" class="btn btn-default btn-lg button-new-item"><i class="icon-plus-sign"></i> Add new block</a>
            	</div>
                <?php if (count($_smarty_tpl->tpl_vars['row']->value['blocks'])>0) {?>
                    <div class="main-container container-fluid blocksortable">
                    <?php  $_smarty_tpl->tpl_vars['block_obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['block_obj']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['block_obj']->key => $_smarty_tpl->tpl_vars['block_obj']->value) {
$_smarty_tpl->tpl_vars['block_obj']->_loop = true;
?>
                       <div class="col-sm-<?php echo $_smarty_tpl->tpl_vars['block_obj']->value['width'];?>
 block-container blocksort_<?php echo $_smarty_tpl->tpl_vars['row']->value['id_row'];?>
">
                       <span class="hidden block_id"><?php echo $_smarty_tpl->tpl_vars['block_obj']->value['id'];?>
</span>
                        <h3 class="heading-panel">
                            <span class="heading-action add">
                        		<a class="list-toolbar-btn" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submitItem&block_id=<?php echo $_smarty_tpl->tpl_vars['block_obj']->value['id'];?>
">
                                    <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Add new item" data-html="true">
                        			<i class="process-icon-new "></i>
                                    <?php echo smartyTranslate(array('s'=>'Add new item','mod'=>'advancetopmenu'),$_smarty_tpl);?>

                                    </span>

                        		</a>
                        	</span>
                            <span class="heading-action edit">
                        		<a class="list-toolbar-btn" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submitBlock&&block_row=<?php echo $_smarty_tpl->tpl_vars['row']->value['id_row'];?>
&id_block=<?php echo $_smarty_tpl->tpl_vars['block_obj']->value['id'];?>
">
                        			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Edit this block setting" data-html="true">
                        				<i class="process-icon-edit "></i>
                        			</span>
                        		</a>
                        	</span>
                            <span class="heading-action del">
                        		<a class="list-toolbar-btn" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submitRemoveBlock&id_block=<?php echo $_smarty_tpl->tpl_vars['block_obj']->value['id'];?>
&block_row=<?php echo $_smarty_tpl->tpl_vars['block_obj']->value['id_row'];?>
" onclick="return confirm('Are you sure delete this block (including all items of this block)')">
                        			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Delete this block" data-html="true">
                        				<i class="process-icon-delete "></i>
                        			</span>
                        		</a>
                        	</span>
                       	</h3>

                        <?php if (count($_smarty_tpl->tpl_vars['block_obj']->value['items'])>0) {?>
                            <?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['langguages']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value) {
$_smarty_tpl->tpl_vars['lang']->_loop = true;
?>
                                <div class="translatable-field lang-<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['lang']->value['id_lang'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['langguages']->value['default_lang']!=$_smarty_tpl->tpl_vars['lang']->value['id_lang']) {?>style="display:none"<?php }?>>
                                    <table class="table">
                                        <thead>
                                            <th width="40%">Title</th>
                                            <th width="40%">Type</th>
                                            <th width="20%">Action</th>
                                        </thead>
                                        <tbody class="item_sortable">
                                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['block_obj']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                                <tr class="item_<?php echo $_smarty_tpl->tpl_vars['block_obj']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['lang']->value['id_lang'];?>
">
                                                    <td>
                                                        <span class="hidden item_id"><?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
</span>
                                                        <?php if (isset($_smarty_tpl->tpl_vars['item']->value->title[$_smarty_tpl->tpl_vars['lang']->value['id_lang']])) {?><?php echo $_smarty_tpl->tpl_vars['item']->value->title[$_smarty_tpl->tpl_vars['lang']->value['id_lang']];?>
<?php }?>
                                                    </td>
                                                    <td><?php echo $_smarty_tpl->tpl_vars['item']->value->itemtype;?>
</td>
                                                    <td style="text-align:right;">
                                                        <a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submitItem&block_id=<?php echo $_smarty_tpl->tpl_vars['block_obj']->value['id'];?>
&id_item=<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
" class="edit_btn" title="Edit" ><i class="icon-edit"></i></a>
                                                        <a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&removeitem=1&id_item=<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
" class="edit_btn" title="Delete" onclick="return confirm('Are you sure delete this Item?')"><i class="icon-remove "></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
        						</div>
    	                    <?php } ?>
                        <?php }?>
                        </div>
                    <?php } ?>
                    </div>
                <?php }?>
            </div>
        <?php } ?>
        </div>
    <?php }?><?php }} ?>
