<?php /* Smarty version Smarty-3.1.19, created on 2017-04-30 17:00:43
         compiled from "/home/abdouhanne/www/pr/modules/oviclayoutcontrol/views/templates/admin/layout_setting/modules.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15146643575906183b1c9544-34696910%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca3736027a4186aa116de6348c26725315d92748' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/oviclayoutcontrol/views/templates/admin/layout_setting/modules.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15146643575906183b1c9544-34696910',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'modules' => 0,
    'dataname' => 0,
    'module' => 0,
    'moduleDir' => 0,
    'postUrl' => 0,
    'hookname' => 0,
    'pagemeta' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5906183b1f4bd0_53722997',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5906183b1f4bd0_53722997')) {function content_5906183b1f4bd0_53722997($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['modules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['module']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->_loop = true;
 $_smarty_tpl->tpl_vars['module']->iteration++;
?>
    <div id="module_<?php echo $_smarty_tpl->tpl_vars['module']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['module']->value['id_hookexecute'];?>
" class="moduleContainer label-tooltip<?php if ($_smarty_tpl->tpl_vars['module']->value['tab']=="analytics_stats") {?> disable_sort<?php }?>" data-module-byname="<?php echo $_smarty_tpl->tpl_vars['module']->value['name'];?>
-<?php echo $_smarty_tpl->tpl_vars['module']->value['hookexec_name'];?>
" data-module-info="module-<?php echo $_smarty_tpl->tpl_vars['module']->value['id'];?>
-<?php echo $_smarty_tpl->tpl_vars['module']->value['id_hookexecute'];?>
" data-html="true" data-toggle="tooltip" data-original-title="<?php echo $_smarty_tpl->tpl_vars['module']->value['description'];?>
">
        <span class="module-position"><?php echo $_smarty_tpl->tpl_vars['module']->iteration;?>
</span>
        <span class="module-icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['moduleDir']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['module']->value['name'];?>
/logo.gif" alt="<?php echo $_smarty_tpl->tpl_vars['module']->value['displayName'];?>
" />
        </span>
        <span class="module-name"><?php echo $_smarty_tpl->tpl_vars['module']->value['displayName'];?>
</span>
        <?php if ($_smarty_tpl->tpl_vars['module']->value['tab']!="analytics_stats") {?>
        <div class="module-action">
            <a href="#" onclick="if (confirm('Are you sure remove this module?')){
                return removeSideBarModule($(this));}else{ return false;};" title="Remove">
               <i class="icon-trash"></i><?php echo smartyTranslate(array('s'=>' Remove','mod'=>'oviclayoutcontrol'),$_smarty_tpl);?>

            </a>
            <a class="changeHook" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['postUrl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&ajax=1&action=displayChangeHook&hookcolumn=<?php echo $_smarty_tpl->tpl_vars['hookname']->value;?>
&pagemeta=<?php echo $_smarty_tpl->tpl_vars['pagemeta']->value;?>
" title="Edit" >
               <i class="icon-pencil"></i> <?php echo smartyTranslate(array('s'=>' Ovride hook','mod'=>'oviclayoutcontrol'),$_smarty_tpl);?>

            </a>
        </div>
        <?php }?>
    </div>
<?php } ?><?php }} ?>
