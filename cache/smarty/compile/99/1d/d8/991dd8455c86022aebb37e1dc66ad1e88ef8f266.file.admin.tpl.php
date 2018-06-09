<?php /* Smarty version Smarty-3.1.19, created on 2018-06-06 16:35:19
         compiled from "/home/abdouhanne/www/modules/advancetopmenu/views/templates/admin/admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19628272305b180d476c72c0-04298585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '991dd8455c86022aebb37e1dc66ad1e88ef8f266' => 
    array (
      0 => '/home/abdouhanne/www/modules/advancetopmenu/views/templates/admin/admin.tpl',
      1 => 1493588696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19628272305b180d476c72c0-04298585',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'admin_tpl_path' => 0,
    'error' => 0,
    'confirmation' => 0,
    'form' => 0,
    'postAction' => 0,
    'supmenu' => 0,
    'sub' => 0,
    'totalwidth' => 0,
    'block' => 0,
    'menuitem' => 0,
    'imgpath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b180d477cab07_73957966',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b180d477cab07_73957966')) {function content_5b180d477cab07_73957966($_smarty_tpl) {?><div id="htmlcontent" class="panel">
    <div class="panel-heading"><i class="icon-cog"></i><?php echo smartyTranslate(array('s'=>' Main menu setting','mod'=>'advancetopmenu'),$_smarty_tpl);?>
</div>
    <?php if (isset($_smarty_tpl->tpl_vars['errors']->value)&&$_smarty_tpl->tpl_vars['errors']->value) {?>
        <?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['errors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['errors']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['errors']['index']++;
?>
            <?php ob_start();?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['admin_tpl_path']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ($_tmp1."messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"main".((string)$_smarty_tpl->getVariable('smarty')->value['foreach']['errors']['index']),'text'=>$_smarty_tpl->tpl_vars['error']->value,'class'=>'error'), 0);?>

        <?php } ?>
    <?php }?>
    <?php if (isset($_smarty_tpl->tpl_vars['confirmation']->value)&&$_smarty_tpl->tpl_vars['confirmation']->value) {?>
        <?php ob_start();?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['admin_tpl_path']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ($_tmp2."messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"main",'text'=>$_smarty_tpl->tpl_vars['confirmation']->value,'class'=>'conf'), 0);?>

    <?php }?>
    <!-- main item -->
    <?php if (isset($_smarty_tpl->tpl_vars['form']->value)) {?>
        <?php if ($_smarty_tpl->tpl_vars['form']->value=='block') {?>
            <?php ob_start();?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['admin_tpl_path']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php $_tmp3=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ($_tmp3."block_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php } else { ?>
            <?php ob_start();?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['admin_tpl_path']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php $_tmp4=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ($_tmp4."main_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php }?>
    <?php }?>
</div>
<div id="htmlcontent" class="panel">
    <h3><i class="icon-list-ul"></i><?php echo smartyTranslate(array('s'=>'Sub menu setting','mod'=>'advancetopmenu'),$_smarty_tpl);?>

	<span class="panel-heading-action">
		<a class="list-toolbar-btn" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submit_edit_sub">
			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Add sub menu" data-html="true">
				<i class="process-icon-new "></i>
			</span>
		</a>
	</span>
	</h3>
    <?php if (isset($_smarty_tpl->tpl_vars['supmenu']->value)&&count($_smarty_tpl->tpl_vars['supmenu']->value)>0) {?>
    <?php  $_smarty_tpl->tpl_vars['sub'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sub']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['supmenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sub']->key => $_smarty_tpl->tpl_vars['sub']->value) {
$_smarty_tpl->tpl_vars['sub']->_loop = true;
?>
    <div class="panel">
        <h3><i class="icon-list-ul"></i><?php echo $_smarty_tpl->tpl_vars['sub']->value['title'];?>
 <?php echo smartyTranslate(array('s'=>'\'s sub menu','mod'=>'advancetopmenu'),$_smarty_tpl);?>

            <span class="panel-heading-action status">
        		<a class="list-toolbar-btn" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&changestatus&id_sub=<?php echo $_smarty_tpl->tpl_vars['sub']->value['id_sub'];?>
">
        			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Change status" data-html="true">
        				<?php if ($_smarty_tpl->tpl_vars['sub']->value['active']) {?>
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
&submit_edit_sub&id_sub=<?php echo $_smarty_tpl->tpl_vars['sub']->value['id_sub'];?>
">
        			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Edit sub menu" data-html="true">
        				<i class="process-icon-edit "></i>
        			</span>
        		</a>
        	</span>
            <span class="panel-heading-action">
        		<a class="list-toolbar-btn" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submit_del_sub&id_sub=<?php echo $_smarty_tpl->tpl_vars['sub']->value['id_sub'];?>
" onclick="return confirm('Are you sure delete this submenu, including submenu\'s blocks and block\'s items?')">
        			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Delete sub menu" data-html="true">
        				<i class="process-icon-delete "></i>
        			</span>
        		</a>
        	</span>
       	</h3>
        <div class="form-group">
    		<a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submit_new_block&id_sub=<?php echo $_smarty_tpl->tpl_vars['sub']->value['id_sub'];?>
" class="btn btn-default btn-lg button-new-item"><i class="icon-plus-sign"></i> Add new column</a>
    	</div>

        <?php if (count($_smarty_tpl->tpl_vars['sub']->value['blocks'])>0) {?>
        <div class="main-container container-fluid <?php if (count($_smarty_tpl->tpl_vars['sub']->value['blocks'])>1) {?> list-unstyled sub_sortable<?php }?>">
        <?php $_smarty_tpl->tpl_vars['totalwidth'] = new Smarty_variable(0, null, 0);?>
        <?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['block']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sub']->value['blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['block']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['block']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value) {
$_smarty_tpl->tpl_vars['block']->_loop = true;
 $_smarty_tpl->tpl_vars['block']->iteration++;
 $_smarty_tpl->tpl_vars['block']->last = $_smarty_tpl->tpl_vars['block']->iteration === $_smarty_tpl->tpl_vars['block']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['blocks']['last'] = $_smarty_tpl->tpl_vars['block']->last;
?>			
            <?php $_smarty_tpl->tpl_vars['totalwidth'] = new Smarty_variable($_smarty_tpl->tpl_vars['totalwidth']->value+$_smarty_tpl->tpl_vars['block']->value['width'], null, 0);?>            
            <?php if ($_smarty_tpl->tpl_vars['totalwidth']->value>12&&!$_smarty_tpl->getVariable('smarty')->value['foreach']['blocks']['last']) {?>				
                <div class="clearfix"></div>                
                <?php $_smarty_tpl->tpl_vars['totalwidth'] = new Smarty_variable(0, null, 0);?>            
            <?php }?>
            <div class="col-sm-<?php echo $_smarty_tpl->tpl_vars['block']->value['width'];?>
 block-container block-<?php echo $_smarty_tpl->tpl_vars['sub']->value['id_sub'];?>
">
            <span class="hidden block_id"><?php echo $_smarty_tpl->tpl_vars['block']->value['id_block'];?>
</span>
            <h3 class="heading-panel">
                <span class="heading-action add">
            		<a class="list-toolbar-btn" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submit_edit_item&block=<?php echo $_smarty_tpl->tpl_vars['block']->value['id_block'];?>
">
                        <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Add new item" data-html="true">
            			<i class="process-icon-new "></i>
                        <?php echo smartyTranslate(array('s'=>'Add new item','mod'=>'advancetopmenu'),$_smarty_tpl);?>

                        </span>

            		</a>
            	</span>
            	<span class="heading-action edit">
            		<a class="list-toolbar-btn" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submit_new_block&id_sub=<?php echo $_smarty_tpl->tpl_vars['sub']->value['id_sub'];?>
&id_block=<?php echo $_smarty_tpl->tpl_vars['block']->value['id_block'];?>
">
            			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Edit this block setting" data-html="true">
            				<i class="process-icon-edit "></i>
            			</span>
            		</a>
            	</span>
                <span class="heading-action del">
            		<a class="list-toolbar-btn" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submit_del_block&id_block=<?php echo $_smarty_tpl->tpl_vars['block']->value['id_block'];?>
" onclick="return confirm('Are you sure delete this block, including all items of this block?')">
            			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Delete this block" data-html="true">
            				<i class="process-icon-delete "></i>
            			</span>
            		</a>
            	</span>
           	</h3>
            <?php if (count($_smarty_tpl->tpl_vars['block']->value['items'])>0) {?>
            <ul class="block-items list-unstyled<?php if (count($_smarty_tpl->tpl_vars['block']->value['items'])>1) {?> sortable<?php }?>">
                <?php  $_smarty_tpl->tpl_vars['menuitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menuitem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['block']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menuitem']->key => $_smarty_tpl->tpl_vars['menuitem']->value) {
$_smarty_tpl->tpl_vars['menuitem']->_loop = true;
?>
                    <li class="block-items-list-<?php echo $_smarty_tpl->tpl_vars['block']->value['id_block'];?>
 <?php echo $_smarty_tpl->tpl_vars['menuitem']->value['type'];?>
-container clearfix">
                        <span class="hidden"><?php echo $_smarty_tpl->tpl_vars['menuitem']->value['id_item'];?>
</span>
                        <?php if ($_smarty_tpl->tpl_vars['menuitem']->value['type']=='img'&&$_smarty_tpl->tpl_vars['menuitem']->value['icon']) {?>
                            <span class="imageContent"><img class="img-thumbnail img-responsive" src="<?php echo $_smarty_tpl->tpl_vars['imgpath']->value;?>
<?php echo $_smarty_tpl->tpl_vars['menuitem']->value['icon'];?>
" alt="" /></span>
                        <?php } elseif ($_smarty_tpl->tpl_vars['menuitem']->value['type']=='html') {?>
                            <span class="htmlContent">
                                <?php echo $_smarty_tpl->tpl_vars['menuitem']->value['text'];?>

                            </span>
                        <?php } else { ?>
                            <span class="item-name"><?php if ($_smarty_tpl->tpl_vars['menuitem']->value['icon']) {?><i class="<?php echo $_smarty_tpl->tpl_vars['menuitem']->value['icon'];?>
"></i><?php }?><?php echo $_smarty_tpl->tpl_vars['menuitem']->value['title'];?>
</span>
                        <?php }?>
                        <span class="action-container">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['postAction']->value;?>
&changeactive&item_id=<?php echo $_smarty_tpl->tpl_vars['menuitem']->value['id_item'];?>
" data-toggle="tooltip" class="label-tooltip" data-html="true"
                                    <?php if ($_smarty_tpl->tpl_vars['menuitem']->value['active']) {?>
                                        data-original-title="Actived" >
                                        <img src="<?php echo @constant('_PS_ADMIN_IMG_');?>
ok.gif" alt="" />
                                    <?php } else { ?>
                                        data-original-title="Deactived" >
                                        <img src="<?php echo @constant('_PS_ADMIN_IMG_');?>
forbbiden.gif" alt="" />
                                    <?php }?>
                                </a>
                            <a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submit_edit_item&block=<?php echo $_smarty_tpl->tpl_vars['menuitem']->value['id_block'];?>
&item_id=<?php echo $_smarty_tpl->tpl_vars['menuitem']->value['id_item'];?>
" data-toggle="tooltip" class="edit_btn label-tooltip" data-html="true" data-original-title="Edit item"><i class="icon-edit"></i></a>
                            <a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postAction']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&submit_del_item&item_id=<?php echo $_smarty_tpl->tpl_vars['menuitem']->value['id_item'];?>
" data-toggle="tooltip" class="edit_btn label-tooltip" data-html="true" data-original-title="Delete item" onclick="return confirm('Are you sure delete this Item?')"><i class="icon-remove "></i></a>
                        </span>

                    </li>
                <?php } ?>
            </ul>
            <?php }?>
            </div>
            
        <?php } ?>
        </div>
        <?php }?>
    </div>
    <?php } ?>
    <?php }?>
</div><?php }} ?>
