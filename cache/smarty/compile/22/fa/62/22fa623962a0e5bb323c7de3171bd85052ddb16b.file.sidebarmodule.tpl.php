<?php /* Smarty version Smarty-3.1.19, created on 2017-04-30 17:00:43
         compiled from "/home/abdouhanne/www/pr/modules/oviclayoutcontrol/views/templates/admin/layout_setting/sidebarmodule.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9020050715906183b186314-04598800%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22fa623962a0e5bb323c7de3171bd85052ddb16b' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/oviclayoutcontrol/views/templates/admin/layout_setting/sidebarmodule.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9020050715906183b186314-04598800',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pagename' => 0,
    'postUrl' => 0,
    'pagemeta' => 0,
    'leftModule' => 0,
    'templatePath' => 0,
    'displayRight' => 0,
    'rightModule' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5906183b1c19c7_83195821',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5906183b1c19c7_83195821')) {function content_5906183b1c19c7_83195821($_smarty_tpl) {?><div id="sidebarModule" class="panel clearfix" >
    <h3><i class="icon-list-ul"></i>&nbsp;<?php echo $_smarty_tpl->tpl_vars['pagename']->value;?>
</h3>
    <input id="ajaxUrl" type="hidden" name="ajaxUrl" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postUrl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&ajax=1&pagemeta=<?php echo $_smarty_tpl->tpl_vars['pagemeta']->value;?>
" />
    <div class="panel col-sm-6">
        <h3><?php echo smartyTranslate(array('s'=>' displayLeftColumn','mod'=>'oviclayoutcontrol'),$_smarty_tpl);?>

            <span class="panel-heading-action">
        		<a class="list-toolbar-btn newmodulehook" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postUrl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&ajax=1&action=displayModulesHook&hookname=left&pagemeta=<?php echo $_smarty_tpl->tpl_vars['pagemeta']->value;?>
">
        			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Add new module" data-html="true">
        				<i class="process-icon-new "></i> <?php echo smartyTranslate(array('s'=>' Add new module','mod'=>'oviclayoutcontrol'),$_smarty_tpl);?>

        			</span>
        		</a>
        	</span>
        </h3>
        <div id="displayLeftColumn" class="hookContainer ui-sortable" data-hook="left">
            <?php if ($_smarty_tpl->tpl_vars['leftModule']->value&&count($_smarty_tpl->tpl_vars['leftModule']->value)>0) {?>
                <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['templatePath']->value)."layout_setting/modules.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('hookname'=>'left','pagemeta'=>$_smarty_tpl->tpl_vars['pagemeta']->value,'modules'=>$_smarty_tpl->tpl_vars['leftModule']->value,'dataname'=>"displayLeftColumnModules"), 0);?>

            <?php }?>
        </div>
    </div>
    <div class="panel col-sm-6<?php if (isset($_smarty_tpl->tpl_vars['displayRight']->value)&&!$_smarty_tpl->tpl_vars['displayRight']->value) {?> disabled<?php }?>">
        <h3><?php echo smartyTranslate(array('s'=>' displayRightColumn','mod'=>'oviclayoutcontrol'),$_smarty_tpl);?>

            <span class="panel-heading-action">
                <a class="list-toolbar-btn newmodulehook <?php if (isset($_smarty_tpl->tpl_vars['displayRight']->value)&&!$_smarty_tpl->tpl_vars['displayRight']->value) {?> btn disabled<?php }?>" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postUrl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&ajax=1&action=displayModulesHook&hookname=right&pagemeta=<?php echo $_smarty_tpl->tpl_vars['pagemeta']->value;?>
">
        			<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Add new module" data-html="true">
        				<i class="process-icon-new "></i> <?php echo smartyTranslate(array('s'=>' Add new module','mod'=>'oviclayoutcontrol'),$_smarty_tpl);?>

        			</span>
        		</a>
        	</span>
        </h3>
        <div id="displayRightColumn" class="hookContainer ui-sortable" data-hook="right">
            <?php if ($_smarty_tpl->tpl_vars['rightModule']->value&&count($_smarty_tpl->tpl_vars['rightModule']->value)>0) {?>
                <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['templatePath']->value)."layout_setting/modules.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('hookname'=>'right','pagemeta'=>$_smarty_tpl->tpl_vars['pagemeta']->value,'modules'=>$_smarty_tpl->tpl_vars['rightModule']->value,'dataname'=>"displayRightColumnModules"), 0);?>

            <?php }?>
        </div>
    </div>
    <div class="clearBoth"></div>
    <div class="panel-footer">
			<a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postUrl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&id_tab=2" class="btn btn-default">
				<i class="process-icon-back"></i> Back
			</a>
		</div>
</div>
<?php }} ?>
