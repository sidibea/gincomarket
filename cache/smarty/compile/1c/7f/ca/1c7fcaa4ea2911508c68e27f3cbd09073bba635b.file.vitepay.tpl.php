<?php /* Smarty version Smarty-3.1.19, created on 2018-06-05 01:47:03
         compiled from "/home/abdouhanne/www/modules/vitepay//views/templates/front/vitepay.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19584277655b15eb97bd99d8-61814502%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c7fcaa4ea2911508c68e27f3cbd09073bba635b' => 
    array (
      0 => '/home/abdouhanne/www/modules/vitepay//views/templates/front/vitepay.tpl',
      1 => 1497278643,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19584277655b15eb97bd99d8-61814502',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'k' => 0,
    'v' => 0,
    'base_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b15eb97c02575_66562020',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b15eb97c02575_66562020')) {function content_5b15eb97c02575_66562020($_smarty_tpl) {?>

<div class='vitepayPayNow'>
    <form id='vitepayPayNow' action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['vitepay_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" method="post">
        <p class="payment_module">
            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                <input type="hidden" name="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['v']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" />
            <?php } ?>
            <a href='#' style="font-size:30px" onclick='document.getElementById("vitepayPayNow").submit();return false;'><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['vitepay_paynow_text'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

                <?php if ($_smarty_tpl->tpl_vars['data']->value['vitepay_paynow_logo']=='on') {?> <img align='<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['vitepay_paynow_align'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
' alt='Payer avec Vitepay' title='Payer avec vitepay' src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
modules/vitepay/views/img/vitepay.png"><?php }?></a>
        <noscript><input type="image" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
modules/vitepay/views/img/vitepay.png"></noscript>
        </p>
    </form>
</div>
<div class="clear"></div>
<?php }} ?>
