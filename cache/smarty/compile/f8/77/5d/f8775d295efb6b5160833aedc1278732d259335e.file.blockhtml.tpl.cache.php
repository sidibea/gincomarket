<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:37:17
         compiled from "/home/abdouhanne/www/pr/modules/blockhtml/views/templates/hook/blockhtml.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10925301675901f40d34c7c5-74983529%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '10925301675901f40d34c7c5-74983529',
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
  'unifunc' => 'content_5901f40d36db71_94189833',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f40d36db71_94189833')) {function content_5901f40d36db71_94189833($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['item']->value)&&!empty($_smarty_tpl->tpl_vars['item']->value)) {?>
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
