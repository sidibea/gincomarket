<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 18:09:49
         compiled from "/home/abdouhanne/www/pr/themes/supershop/store_infos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28438180590233ed4c7891-18911777%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a6d4775c388faa421f7b02ef88dda45c40dff0c' => 
    array (
      0 => '/home/abdouhanne/www/pr/themes/supershop/store_infos.tpl',
      1 => 1492385466,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28438180590233ed4c7891-18911777',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'days_datas' => 0,
    'one_day' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_590233ed4df7b2_98510145',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_590233ed4df7b2_98510145')) {function content_590233ed4df7b2_98510145($_smarty_tpl) {?>


	<?php  $_smarty_tpl->tpl_vars['one_day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['one_day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['days_datas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['one_day']->key => $_smarty_tpl->tpl_vars['one_day']->value) {
$_smarty_tpl->tpl_vars['one_day']->_loop = true;
?>
	<p>
		<strong class="dark"><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['one_day']->value['day']),$_smarty_tpl);?>
: </strong> &nbsp;<span><?php echo $_smarty_tpl->tpl_vars['one_day']->value['hours'];?>
</span>
	</p>
	<?php } ?>

<?php }} ?>
