<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:37:16
         compiled from "/home/abdouhanne/www/pr/modules/groupcategory/views/templates/hook/banners.option1.default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12912846185901f40c570da9-07768556%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bab51c76917fd349aa2d54382db66dab1e320359' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/groupcategory/views/templates/hook/banners.option1.default.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12912846185901f40c570da9-07768556',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'banners' => 0,
    'banner' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5901f40c5906e6_25859872',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f40c5906e6_25859872')) {function content_5901f40c5906e6_25859872($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['banners']->value)&&count($_smarty_tpl->tpl_vars['banners']->value)>0) {?>
<div class="group-banners">
    <?php  $_smarty_tpl->tpl_vars['banner'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['banner']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['banners']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['banner']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value) {
$_smarty_tpl->tpl_vars['banner']->_loop = true;
 $_smarty_tpl->tpl_vars['banner']->index++;
 $_smarty_tpl->tpl_vars['banner']->first = $_smarty_tpl->tpl_vars['banner']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['ojb']['first'] = $_smarty_tpl->tpl_vars['banner']->first;
?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['ojb']['first']) {?> 
            <div  class="banner-item <?php echo $_smarty_tpl->tpl_vars['banner']->value['key'];?>
 tab-pane fade in active">
                <div class="inner">
                    <div class="banner-img">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['banner']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['banner']->value['title'];?>
">
                            <img alt="<?php echo $_smarty_tpl->tpl_vars['banner']->value['title'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['banner']->value['img'];?>
" />
                        </a>
                    </div>
                </div>
            </div>
        <?php } else { ?>
        	<div class="banner-item <?php echo $_smarty_tpl->tpl_vars['banner']->value['key'];?>
 tab-pane fade">
                <div class="inner">
                    <div class="banner-img">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['banner']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['banner']->value['title'];?>
">
                            <img alt="<?php echo $_smarty_tpl->tpl_vars['banner']->value['title'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['banner']->value['img'];?>
" />
                        </a>
                    </div>
                </div>
            </div>
        <?php }?>        
    <?php } ?>
</div>
<?php }?><?php }} ?>
