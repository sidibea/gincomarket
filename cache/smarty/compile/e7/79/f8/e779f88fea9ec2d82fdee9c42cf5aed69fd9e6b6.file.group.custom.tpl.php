<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:37:15
         compiled from "/home/abdouhanne/www/pr/modules/verticalmegamenus/views/templates/hook/group.custom.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11807006605901f40beb2369-36932567%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e779f88fea9ec2d82fdee9c42cf5aed69fd9e6b6' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/verticalmegamenus/views/templates/hook/group.custom.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11807006605901f40beb2369-36932567',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'verticalCustoms' => 0,
    'data' => 0,
    'verticalCustomWidth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5901f40bed32b4_69525087',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f40bed32b4_69525087')) {function content_5901f40bed32b4_69525087($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['verticalCustoms']->value)&&$_smarty_tpl->tpl_vars['verticalCustoms']->value) {?>
    <div class="mega-custom-html">
        <?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['verticalCustoms']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->_loop = true;
?>
        
            <?php if ($_smarty_tpl->tpl_vars['data']->value['menuType']=='link') {?>
                <div class="item item-link <?php echo $_smarty_tpl->tpl_vars['verticalCustomWidth']->value;?>
"><div class="row"><a href="<?php echo $_smarty_tpl->tpl_vars['data']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
</a></div></div>
            <?php } else { ?>
                <?php if ($_smarty_tpl->tpl_vars['data']->value['menuType']=='image') {?>
                    <?php if ($_smarty_tpl->tpl_vars['data']->value['imageSrc']!='') {?>
                        <div class="item item-image <?php echo $_smarty_tpl->tpl_vars['verticalCustomWidth']->value;?>
"><div class="row"><a href="<?php echo $_smarty_tpl->tpl_vars['data']->value['link'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['data']->value['imageSrc'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
" /></a></div></div>
                    <?php }?>
                <?php } else { ?>
                    <div class="item item-html <?php echo $_smarty_tpl->tpl_vars['verticalCustomWidth']->value;?>
"><div class="row custom-text"><?php echo $_smarty_tpl->tpl_vars['data']->value['html'];?>
</div></div>
                <?php }?>    
            <?php }?>
        <?php } ?>    
    </div>
<?php }?><?php }} ?>
