<?php /* Smarty version Smarty-3.1.19, created on 2017-04-30 16:44:55
         compiled from "/home/abdouhanne/www/pr/modules/blockhtml/views/templates/hook/blockhtml.tpl" */ ?>
<?php /*%%SmartyHeaderCode:111738086259061487e099f1-85327365%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8775d295efb6b5160833aedc1278732d259335e' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/blockhtml/views/templates/hook/blockhtml.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '111738086259061487e099f1-85327365',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'item' => 0,
    'hook_position' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59061487e228f1_41371728',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59061487e228f1_41371728')) {function content_59061487e228f1_41371728($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['item']->value)&&!empty($_smarty_tpl->tpl_vars['item']->value)) {?>
<div id="blockhtml_<?php echo $_smarty_tpl->tpl_vars['hook_position']->value;?>
" class="clearfix clearBoth">
    <?php if (isset($_smarty_tpl->tpl_vars['item']->value['title'])&&preg_match_all('/[^\s]/u',$_smarty_tpl->tpl_vars['item']->value['title'], $tmp)>0) {?>
        <h1 class="block-title"><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</h1>
    <?php }?>
    <?php if (isset($_smarty_tpl->tpl_vars['item']->value['content'])) {?>
        <?php echo $_smarty_tpl->tpl_vars['item']->value['content'];?>

    <?php }?>
</div>
<?php }?><?php }} ?>
