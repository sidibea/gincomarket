<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:53:00
         compiled from "/home/abdouhanne/www/pr/modules/verticalmegamenus/views/templates/admin/list_module.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11121603965901f7bc5230b6-44597574%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4be1e2c99b3fc38e40cecca1a58e9a7c316a1eaa' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/verticalmegamenus/views/templates/admin/list_module.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11121603965901f7bc5230b6-44597574',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'listModule' => 0,
    'moduleForm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5901f7bc53f917_01884672',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f7bc53f917_01884672')) {function content_5901f7bc53f917_01884672($_smarty_tpl) {?><div class="panel">

    <div class="panel-heading">

    	<?php echo smartyTranslate(array('s'=>'List Modules','mod'=>'verticalmegamenus'),$_smarty_tpl);?>


		<span class="panel-heading-action">

            <a href="javascript:void(0)" onclick="showModal('modalModule', '')" class="list-toolbar-btn link-add"><span data-placement="left" data-html="true" data-original-title="Add New" class="label-tooltip" data-toggle="tooltip" title=""><i class="process-icon-new"></i></span></a>

		</span>

    </div>

    <div class="panel-body" style="padding:0">

        <div class="table-responsive">

            <table class="table" id="moduleList">

    			<thead>

    				<tr class="nodrag nodrop">

                        <th width="50" class="center"><?php echo smartyTranslate(array('s'=>'ID','mod'=>'verticalmegamenus'),$_smarty_tpl);?>
</th>

                        <th><?php echo smartyTranslate(array('s'=>'Name','mod'=>'verticalmegamenus'),$_smarty_tpl);?>
</th>

                        <th width="150" class="center"><?php echo smartyTranslate(array('s'=>'Position','mod'=>'verticalmegamenus'),$_smarty_tpl);?>
</th>

                        <th width="150" class="center"><?php echo smartyTranslate(array('s'=>'Layout','mod'=>'verticalmegamenus'),$_smarty_tpl);?>
</th>

                        <th width="100" class="center"><?php echo smartyTranslate(array('s'=>'Ordering','mod'=>'verticalmegamenus'),$_smarty_tpl);?>
</th>

                        <th width="50" class="center"><?php echo smartyTranslate(array('s'=>'Status','mod'=>'verticalmegamenus'),$_smarty_tpl);?>
</th>

                        <th class="center" width="50">#</th>

                    </tr>				

                </thead>

                <tbody><?php echo $_smarty_tpl->tpl_vars['listModule']->value;?>
</tbody>    

	       </table>            

        </div>        

    </div> 

</div>



<div id="modalModule" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <span class="modal-title"><i class="icon-cloud"></i><?php echo smartyTranslate(array('s'=>' Add or edit category','mod'=>'verticalmegamenus'),$_smarty_tpl);?>
</span>
            </div>
            <div class="modal-body form-horizontal" id="forgotBody">
                <form id="frmModule"><?php echo $_smarty_tpl->tpl_vars['moduleForm']->value;?>
</form>           
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-primary btnForgot" onclick="saveModule()"><i class="icon-save"></i> <?php echo smartyTranslate(array('s'=>'Save','mod'=>'verticalmegamenus'),$_smarty_tpl);?>
</button>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div><?php }} ?>
