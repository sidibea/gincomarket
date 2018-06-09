<?php /* Smarty version Smarty-3.1.19, created on 2017-04-28 18:28:58
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/products/product_top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1712683391590389ea3bfe39-49599881%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c58548db9528312086650a6cc379c2bb431293f' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/products/product_top.tpl',
      1 => 1493122817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1712683391590389ea3bfe39-49599881',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
    'id_language' => 0,
    'link' => 0,
    'id_product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_590389ea3e73a2_63602923',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_590389ea3e73a2_63602923')) {function content_590389ea3e73a2_63602923($_smarty_tpl) {?><input type="hidden" name="id_product" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
" />
<div class="row">
  <h3>
    <span class="agile-pull-left">
      <?php echo smartyTranslate(array('s'=>'Product','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
 <span class="color-myaccount"><?php echo smartyTranslate(array('s'=>'#','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
<?php echo sprintf("%06d",$_smarty_tpl->tpl_vars['product']->value->id);?>
</span> - <?php echo $_smarty_tpl->tpl_vars['product']->value->name[$_smarty_tpl->tpl_vars['id_language']->value];?>

    </span>
    <span class="agile-pull-right">
      <a class="agile-btn agile-btn-default" href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellerproducts',array(),true);?>
">
        <i class="icon-th-list"></i><?php echo smartyTranslate(array('s'=>' Back to product list','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </a>
    </span>
  </h3>


  <h3 class="row agile-align-center">
    <?php if ($_smarty_tpl->tpl_vars['id_product']->value>0) {?>
    <?php } else { ?>
    <span>
      <h4><?php echo smartyTranslate(array('s'=>'Adding a new product - other menus will be available once you save the basic information','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</h4>
    </span>
    <?php }?>
  </h3>
</div><?php }} ?>
