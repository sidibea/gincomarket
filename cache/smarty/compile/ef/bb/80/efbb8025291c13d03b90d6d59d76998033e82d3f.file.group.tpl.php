<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:51:20
         compiled from "/home/abdouhanne/www/modules/verticalmegamenus/views/templates/hook/group.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11164990445b1a5fa820e4f9-77600504%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'efbb8025291c13d03b90d6d59d76998033e82d3f' => 
    array (
      0 => '/home/abdouhanne/www/modules/verticalmegamenus/views/templates/hook/group.tpl',
      1 => 1493588696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11164990445b1a5fa820e4f9-77600504',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'verticalGroups' => 0,
    'groupWidth' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1a5fa821e982_92596472',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5fa821e982_92596472')) {function content_5b1a5fa821e982_92596472($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['verticalGroups']->value)&&$_smarty_tpl->tpl_vars['verticalGroups']->value) {?>
    <div class="dropdown-menu vertical-dropdown-menu">
        <div class="vertical-groups <?php echo $_smarty_tpl->tpl_vars['groupWidth']->value;?>
">
            <div class="clearfix">
                <?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['verticalGroups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->_loop = true;
?>
                    <div class="mega-group <?php echo $_smarty_tpl->tpl_vars['data']->value['width'];?>
">
                        <?php if ($_smarty_tpl->tpl_vars['data']->value['display_title']) {?><h4 class="mega-group-header"><span><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
</span></h4><?php }?>
                        <?php echo $_smarty_tpl->tpl_vars['data']->value['group_content'];?>

                    </div>                    
                <?php } ?>    
            </div>
        </div>
    </div>
<?php }?><?php }} ?>
