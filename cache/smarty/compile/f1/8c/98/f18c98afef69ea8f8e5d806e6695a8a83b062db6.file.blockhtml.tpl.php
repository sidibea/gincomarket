<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:51:24
         compiled from "/home/abdouhanne/www/modules/blockhtml/views/templates/hook/blockhtml.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2775476125b1a5face30781-48781452%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f18c98afef69ea8f8e5d806e6695a8a83b062db6' => 
    array (
      0 => '/home/abdouhanne/www/modules/blockhtml/views/templates/hook/blockhtml.tpl',
      1 => 1493588696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2775476125b1a5face30781-48781452',
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
  'unifunc' => 'content_5b1a5face47098_46814959',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5face47098_46814959')) {function content_5b1a5face47098_46814959($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['item']->value)&&!empty($_smarty_tpl->tpl_vars['item']->value)) {?>
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
