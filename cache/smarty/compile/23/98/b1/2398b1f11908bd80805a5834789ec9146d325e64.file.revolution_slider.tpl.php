<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:37:16
         compiled from "/home/abdouhanne/www/pr/themes/supershop/modules/revsliderprestashop/views/templates/front/revolution_slider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8824511305901f40c355a61-05797718%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2398b1f11908bd80805a5834789ec9146d325e64' => 
    array (
      0 => '/home/abdouhanne/www/pr/themes/supershop/modules/revsliderprestashop/views/templates/front/revolution_slider.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8824511305901f40c355a61-05797718',
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
  'unifunc' => 'content_5901f40c36b110_03761442',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f40c36b110_03761442')) {function content_5901f40c36b110_03761442($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars["current_option"] = new Smarty_variable(Configuration::get('OVIC_CURRENT_OPTION'), null, 0);?>
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
