<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:51:24
         compiled from "/home/abdouhanne/www/modules/smartblogarchive/views/templates/front/smartblogarchive.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5566162635b1a5fac3999d5-21567778%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ad3d90a13e65d6447fcf962bed06625c85824db' => 
    array (
      0 => '/home/abdouhanne/www/modules/smartblogarchive/views/templates/front/smartblogarchive.tpl',
      1 => 1493588695,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5566162635b1a5fac3999d5-21567778',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'archives' => 0,
    'archive' => 0,
    'months' => 0,
    'linkurl' => 0,
    'monthname' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1a5fac3eb439_88236891',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5fac3eb439_88236891')) {function content_5b1a5fac3eb439_88236891($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['archives']->value)&&!empty($_smarty_tpl->tpl_vars['archives']->value)) {?>
<div id="smartblogarchive"  class="block blogModule boxPlain">
    <h2 class='sdstitle_block'><a href="<?php echo smartblog::GetSmartBlogLink('smartblog_archive');?>
"><?php echo smartyTranslate(array('s'=>'Blog Archive','mod'=>'smartblogarchive'),$_smarty_tpl);?>
</a></h2>
   <div class="block_content list-block">
         <ul>
	<?php  $_smarty_tpl->tpl_vars["archive"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["archive"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['archives']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["archive"]->key => $_smarty_tpl->tpl_vars["archive"]->value) {
$_smarty_tpl->tpl_vars["archive"]->_loop = true;
?>
                <?php  $_smarty_tpl->tpl_vars["months"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["months"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['archive']->value['month']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["months"]->key => $_smarty_tpl->tpl_vars["months"]->value) {
$_smarty_tpl->tpl_vars["months"]->_loop = true;
?>
                    <?php $_smarty_tpl->tpl_vars["linkurl"] = new Smarty_variable(null, null, 0);?>
                            <?php $_smarty_tpl->createLocalArrayVariable('linkurl', null, 0);
$_smarty_tpl->tpl_vars['linkurl']->value['year'] = $_smarty_tpl->tpl_vars['archive']->value['year'];?>
                        <?php $_smarty_tpl->createLocalArrayVariable('linkurl', null, 0);
$_smarty_tpl->tpl_vars['linkurl']->value['month'] = $_smarty_tpl->tpl_vars['months']->value['month'];?>
                        <?php $_smarty_tpl->tpl_vars["monthname"] = new Smarty_variable(null, null, 0);?>
                        <?php if ($_smarty_tpl->tpl_vars['months']->value['month']==1) {?><?php $_smarty_tpl->tpl_vars['monthname'] = new Smarty_variable('January', null, 0);?><?php } elseif ($_smarty_tpl->tpl_vars['months']->value['month']==2) {?><?php $_smarty_tpl->tpl_vars['monthname'] = new Smarty_variable('February', null, 0);?><?php } elseif ($_smarty_tpl->tpl_vars['months']->value['month']==3) {?>
                        <?php $_smarty_tpl->tpl_vars['monthname'] = new Smarty_variable('March', null, 0);?> <?php } elseif ($_smarty_tpl->tpl_vars['months']->value['month']==4) {?> <?php $_smarty_tpl->tpl_vars['monthname'] = new Smarty_variable('Aprill', null, 0);?><?php } elseif ($_smarty_tpl->tpl_vars['months']->value['month']==5) {?><?php $_smarty_tpl->tpl_vars['monthname'] = new Smarty_variable('May', null, 0);?>
                        <?php } elseif ($_smarty_tpl->tpl_vars['months']->value['month']==6) {?><?php $_smarty_tpl->tpl_vars['monthname'] = new Smarty_variable('June', null, 0);?><?php } elseif ($_smarty_tpl->tpl_vars['months']->value['month']==7) {?><?php $_smarty_tpl->tpl_vars['monthname'] = new Smarty_variable('July', null, 0);?> <?php } elseif ($_smarty_tpl->tpl_vars['months']->value['month']==8) {?>
                        <?php $_smarty_tpl->tpl_vars['monthname'] = new Smarty_variable('August', null, 0);?> <?php } elseif ($_smarty_tpl->tpl_vars['months']->value['month']==9) {?><?php $_smarty_tpl->tpl_vars['monthname'] = new Smarty_variable('September', null, 0);?><?php } elseif ($_smarty_tpl->tpl_vars['months']->value['month']==10) {?> <?php $_smarty_tpl->tpl_vars['monthname'] = new Smarty_variable('October', null, 0);?>
                        <?php } elseif ($_smarty_tpl->tpl_vars['months']->value['month']==11) {?><?php $_smarty_tpl->tpl_vars['monthname'] = new Smarty_variable('November', null, 0);?><?php } elseif ($_smarty_tpl->tpl_vars['months']->value['month']==12) {?> <?php $_smarty_tpl->tpl_vars['monthname'] = new Smarty_variable('December', null, 0);?><?php }?>
    <li>
		  <a href="<?php echo smartblog::GetSmartBlogLink('smartblog_month',$_smarty_tpl->tpl_vars['linkurl']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['monthname']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['archive']->value['year'];?>
</a>
		</li>
                <?php } ?>
	<?php } ?>
        </ul>
   </div>
</div>
<?php }?><?php }} ?>
