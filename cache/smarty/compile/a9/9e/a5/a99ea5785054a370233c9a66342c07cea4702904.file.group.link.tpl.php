<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:37:15
         compiled from "/home/abdouhanne/www/pr/modules/verticalmegamenus/views/templates/hook/group.link.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6538320055901f40be6d562-99560113%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a99ea5785054a370233c9a66342c07cea4702904' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/verticalmegamenus/views/templates/hook/group.link.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6538320055901f40be6d562-99560113',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'verticalLinks' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5901f40be92446_44369102',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f40be92446_44369102')) {function content_5901f40be92446_44369102($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['verticalLinks']->value)&&$_smarty_tpl->tpl_vars['verticalLinks']->value) {?>
    <ul class="group-link-default">
        <?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['verticalLinks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->_loop = true;
?>
        
            <?php if ($_smarty_tpl->tpl_vars['data']->value['menuType']=='link') {?>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['data']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
</a></li>
            <?php } else { ?>
                <?php if ($_smarty_tpl->tpl_vars['data']->value['menuType']=='image') {?>
                    <?php if ($_smarty_tpl->tpl_vars['data']->value['imageSrc']!='') {?>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['data']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['data']->value['imageSrc'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
" /></a></li>
                    <?php }?>
                <?php } else { ?>
                    <li>
                        <!-- <div class="custom-link"><a itemprop="url" href="<?php echo $_smarty_tpl->tpl_vars['data']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
</a></div> -->
                        <div class="custom-text"><?php echo $_smarty_tpl->tpl_vars['data']->value['html'];?>
</div>
                    </li>
                <?php }?>    
            <?php }?>
        <?php } ?>    
    </ul>
<?php }?><?php }} ?>
