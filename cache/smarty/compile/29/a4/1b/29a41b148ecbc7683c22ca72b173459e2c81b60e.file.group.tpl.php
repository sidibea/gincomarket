<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:37:15
         compiled from "/home/abdouhanne/www/pr/modules/verticalmegamenus/views/templates/hook/group.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21278561845901f40bed66c5-14908527%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '29a41b148ecbc7683c22ca72b173459e2c81b60e' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/verticalmegamenus/views/templates/hook/group.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21278561845901f40bed66c5-14908527',
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
  'unifunc' => 'content_5901f40bee85f0_16555591',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f40bee85f0_16555591')) {function content_5901f40bee85f0_16555591($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['verticalGroups']->value)&&$_smarty_tpl->tpl_vars['verticalGroups']->value) {?>
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
