<?php /* Smarty version Smarty-3.1.19, created on 2017-04-30 16:44:56
         compiled from "/home/abdouhanne/www/pr/modules/advancefooter/advfooter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11177785695906148804d8a9-48331655%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b550f45a66f81743c4b963d95cff8ca1023cfc63' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/advancefooter/advfooter.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11177785695906148804d8a9-48331655',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'footers' => 0,
    'row' => 0,
    'block' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59061488081029_83400637',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59061488081029_83400637')) {function content_59061488081029_83400637($_smarty_tpl) {?><!-- module advance footer by ovic-->
<?php if ($_smarty_tpl->tpl_vars['footers']->value) {?>
    <div id="advancefooter" class=" clearBoth clearfix container-fluid">
    <?php if (count($_smarty_tpl->tpl_vars['footers']->value)>0) {?>
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['footers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
            <div id="footer_row<?php echo $_smarty_tpl->tpl_vars['row']->value['id_row'];?>
" class="clearfix footer_row<?php if ((isset($_smarty_tpl->tpl_vars['row']->value['rclass']))) {?> <?php echo $_smarty_tpl->tpl_vars['row']->value['rclass'];?>
<?php }?>">
                <div class="container">
                   <div class="row">
                    <?php if (isset($_smarty_tpl->tpl_vars['row']->value['blocks'])&&count($_smarty_tpl->tpl_vars['row']->value['blocks'])>0) {?>
                        <?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['block']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['block']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value) {
$_smarty_tpl->tpl_vars['block']->_loop = true;
 $_smarty_tpl->tpl_vars['block']->iteration++;
?>
                            <div id="block_<?php echo $_smarty_tpl->tpl_vars['row']->value['id_row'];?>
_<?php echo $_smarty_tpl->tpl_vars['block']->iteration;?>
" class="<?php echo $_smarty_tpl->tpl_vars['block']->value['bclass'];?>
 advancefooter-block col-sm-<?php echo $_smarty_tpl->tpl_vars['block']->value['width'];?>
 col-sx-12 block_<?php echo $_smarty_tpl->tpl_vars['block']->iteration;?>
">
                                <?php if ($_smarty_tpl->tpl_vars['block']->value['display_title']&&$_smarty_tpl->tpl_vars['block']->value['title']) {?>
                                    <h2 class="block_title"><?php echo $_smarty_tpl->tpl_vars['block']->value['title'];?>
</h2>
                                <?php }?>
                                <?php if (isset($_smarty_tpl->tpl_vars['block']->value['items'])&&count($_smarty_tpl->tpl_vars['block']->value['items'])>0) {?>
                                    <ul>
                                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['block']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                            <li class="item <?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>
">
                                                <div class="item_wrapper">
                                                    <?php echo $_smarty_tpl->tpl_vars['item']->value['html'];?>

                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php }?>
                            </div>
                        <?php } ?>
                     <?php }?>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php }?>
    </div>
<?php }?>
<!-- /advance footer by ovic--><?php }} ?>
