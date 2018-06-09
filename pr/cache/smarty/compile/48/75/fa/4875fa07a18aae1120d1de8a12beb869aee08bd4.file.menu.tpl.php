<?php /* Smarty version Smarty-3.1.19, created on 2018-06-04 05:42:45
         compiled from "/home/abdouhanne/www/pr/modules/verticalmegamenus/views/templates/hook/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14281039615b14d155620043-59850317%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4875fa07a18aae1120d1de8a12beb869aee08bd4' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/verticalmegamenus/views/templates/hook/menu.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14281039615b14d155620043-59850317',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'moduleName' => 0,
    'moduleId' => 0,
    'verticalMenus' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b14d15583ae73_17994335',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b14d15583ae73_17994335')) {function content_5b14d15583ae73_17994335($_smarty_tpl) {?><h4 class="title"><?php echo $_smarty_tpl->tpl_vars['moduleName']->value;?>
<span data-target="#navbarCollapse-<?php echo $_smarty_tpl->tpl_vars['moduleId']->value;?>
" data-toggle="collapse" class="icon-reorder pull-right"></span></h4>
<div id="navbarCollapse-<?php echo $_smarty_tpl->tpl_vars['moduleId']->value;?>
" class="collapse vertical-menu-content">
    <ul class="megamenus-ul ">
        <?php if (isset($_smarty_tpl->tpl_vars['verticalMenus']->value)&&$_smarty_tpl->tpl_vars['verticalMenus']->value) {?>            
            <?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['verticalMenus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->_loop = true;
?>
                <?php if ($_smarty_tpl->tpl_vars['data']->value['group_content']) {?>
                    <?php if ($_smarty_tpl->tpl_vars['data']->value['iconPath']) {?>
                        <li class="parent dropdown">
                            <i class="icon-angle-down dropdown-toggle hidden-lg hidden-md hidden-sm pull-right" data-toggle="dropdown"></i>
                            <a class="parent vertical-parent " title="<?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['data']->value['link'];?>
" data-link="<?php echo $_smarty_tpl->tpl_vars['data']->value['link'];?>
" >
                                <img class="parent-icon" alt="<?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['data']->value['iconPath'];?>
" /><span><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
</span>
                            </a>
                            <?php echo $_smarty_tpl->tpl_vars['data']->value['group_content'];?>

                        </li>
                    <?php } else { ?>
                        <li class="parent dropdown">
                            <i class="icon-angle-down dropdown-toggle hidden-lg hidden-md hidden-sm pull-right" data-toggle="dropdown"></i>
                            <a class="parent vertical-parent no-icon" title="<?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['data']->value['link'];?>
" data-link="<?php echo $_smarty_tpl->tpl_vars['data']->value['link'];?>
" >
                                <span><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
</span>
                            </a>                        
                            <?php echo $_smarty_tpl->tpl_vars['data']->value['group_content'];?>

                        </li>
                    <?php }?>
                <?php } else { ?>
                    <?php if ($_smarty_tpl->tpl_vars['data']->value['iconPath']) {?>
                        <li class="dropdown">
                            <i class="icon-angle-down dropdown-toggle hidden-lg hidden-md hidden-sm pull-right" data-toggle="dropdown"></i>
                            <a class="parent" title="<?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['data']->value['link'];?>
" >
                                <img class="parent-icon" alt="<?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['data']->value['iconPath'];?>
" />
                                <span><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
</span>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="dropdown">
                            <i class="icon-angle-down dropdown-toggle hidden-lg hidden-md hidden-sm pull-right" data-toggle="dropdown"></i>
                            <a class="parent" title="<?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['data']->value['link'];?>
" >
                                <span><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
</span>
                            </a>
                        </li>
                    <?php }?>                    
                <?php }?>                    
            <?php } ?>    
               
        <?php }?>    
    </ul>
</div>
<?php }} ?>
