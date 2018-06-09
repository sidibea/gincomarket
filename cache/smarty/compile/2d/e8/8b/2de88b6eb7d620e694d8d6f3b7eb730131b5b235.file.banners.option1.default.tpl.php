<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:51:20
         compiled from "/home/abdouhanne/www/modules/groupcategory/views/templates/hook/banners.option1.default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10155448805b1a5fa8ee6f14-23776735%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2de88b6eb7d620e694d8d6f3b7eb730131b5b235' => 
    array (
      0 => '/home/abdouhanne/www/modules/groupcategory/views/templates/hook/banners.option1.default.tpl',
      1 => 1495566850,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10155448805b1a5fa8ee6f14-23776735',
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
  'unifunc' => 'content_5b1a5fa8f01c08_38129834',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5fa8f01c08_38129834')) {function content_5b1a5fa8f01c08_38129834($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['banners']->value)&&count($_smarty_tpl->tpl_vars['banners']->value)>0) {?>
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
