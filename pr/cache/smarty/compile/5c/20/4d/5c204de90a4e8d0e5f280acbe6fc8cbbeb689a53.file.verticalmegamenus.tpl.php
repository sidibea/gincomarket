<?php /* Smarty version Smarty-3.1.19, created on 2018-06-04 05:42:45
         compiled from "/home/abdouhanne/www/pr/themes/supershop/modules/verticalmegamenus/views/templates/hook/verticalmegamenus.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17602032705b14d155978f56-37994832%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5c204de90a4e8d0e5f280acbe6fc8cbbeb689a53' => 
    array (
      0 => '/home/abdouhanne/www/pr/themes/supershop/modules/verticalmegamenus/views/templates/hook/verticalmegamenus.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17602032705b14d155978f56-37994832',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'current_option' => 0,
    'verticalModules' => 0,
    'module' => 0,
    'page_name' => 0,
    'colvertical' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b14d155aab7e2_22157519',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b14d155aab7e2_22157519')) {function content_5b14d155aab7e2_22157519($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars["current_option"] = new Smarty_variable(Configuration::get('OVIC_CURRENT_OPTION'), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['current_option']->value==4) {?>
    <?php $_smarty_tpl->tpl_vars["colvertical"] = new Smarty_variable('col-sm-1', null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["colvertical"] = new Smarty_variable('col-sm-3', null, 0);?>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['verticalModules']->value)&&$_smarty_tpl->tpl_vars['verticalModules']->value) {?>
    <?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['verticalModules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->_loop = true;
?>
        <?php if ($_smarty_tpl->tpl_vars['module']->value['layout']=='default') {?>
            <?php if ($_smarty_tpl->tpl_vars['page_name']->value=='index') {?>
			    <div class="<?php echo $_smarty_tpl->tpl_vars['colvertical']->value;?>
 hidden-xs home-page">
                	<div class="box-vertical-megamenus">
            		    <div class="vertical-megamenus">			        
            		        <?php echo $_smarty_tpl->tpl_vars['module']->value['sections'];?>

            		    </div>
            		</div>
                </div>		
            <?php } else { ?>
    		    <div class="<?php echo $_smarty_tpl->tpl_vars['colvertical']->value;?>
 other-pages hidden-xs">
                    <div class="box-vertical-megamenus">
            		    <div class="vertical-megamenus">			        
            		        <?php echo $_smarty_tpl->tpl_vars['module']->value['sections'];?>

            		    </div>
            		</div>
                </div>
            <?php }?>
        <?php }?>
    <?php } ?>    
<?php }?><?php }} ?>
