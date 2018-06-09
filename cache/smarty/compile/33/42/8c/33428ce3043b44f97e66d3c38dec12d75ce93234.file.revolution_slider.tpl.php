<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:51:20
         compiled from "/home/abdouhanne/www/themes/supershop/modules/revsliderprestashop/views/templates/front/revolution_slider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7407212725b1a5fa849aa13-92616960%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33428ce3043b44f97e66d3c38dec12d75ce93234' => 
    array (
      0 => '/home/abdouhanne/www/themes/supershop/modules/revsliderprestashop/views/templates/front/revolution_slider.tpl',
      1 => 1493588701,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7407212725b1a5fa849aa13-92616960',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_name' => 0,
    'revhome' => 0,
    'current_option' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1a5fa84ab6d9_17645714',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5fa84ab6d9_17645714')) {function content_5b1a5fa84ab6d9_17645714($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars["current_option"] = new Smarty_variable(Configuration::get('OVIC_CURRENT_OPTION'), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['page_name']->value=='index'&&isset($_smarty_tpl->tpl_vars['revhome']->value)&&!empty($_smarty_tpl->tpl_vars['revhome']->value)) {?>
    <?php if ($_smarty_tpl->tpl_vars['current_option']->value==3) {?>
        <div class="row home-slider">
            <div class="col-sm-12 displayHomeSlider"><?php echo $_smarty_tpl->tpl_vars['revhome']->value;?>
</div>
        </div>
    <?php } else { ?>
        <div class="row home-slider">
            <div class="col-lg-3 col-md-3 home-slider-left"></div>
            <div class="col-lg-9 col-md-9 col-sm-12 displayHomeSlider"><?php echo $_smarty_tpl->tpl_vars['revhome']->value;?>
</div>
        </div>
    <?php }?>    
	
<?php } else { ?>
    <?php echo $_smarty_tpl->tpl_vars['revhome']->value;?>

<?php }?>
 <?php }} ?>
