<?php /* Smarty version Smarty-3.1.19, created on 2018-06-04 05:42:46
         compiled from "/home/abdouhanne/www/pr/themes/supershop/modules/revsliderprestashop/views/templates/front/revolution_slider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18720524105b14d1562a3020-10470017%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '18720524105b14d1562a3020-10470017',
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
  'unifunc' => 'content_5b14d15634cfa9_10925930',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b14d15634cfa9_10925930')) {function content_5b14d15634cfa9_10925930($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars["current_option"] = new Smarty_variable(Configuration::get('OVIC_CURRENT_OPTION'), null, 0);?>
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
