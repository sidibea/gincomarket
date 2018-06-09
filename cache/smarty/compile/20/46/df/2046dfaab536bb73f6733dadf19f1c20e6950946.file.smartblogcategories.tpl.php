<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:51:24
         compiled from "/home/abdouhanne/www/modules/smartblogcategories/views/templates/front/smartblogcategories.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11732930955b1a5fac35cff0-80628040%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2046dfaab536bb73f6733dadf19f1c20e6950946' => 
    array (
      0 => '/home/abdouhanne/www/modules/smartblogcategories/views/templates/front/smartblogcategories.tpl',
      1 => 1493588696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11732930955b1a5fac35cff0-80628040',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'categories' => 0,
    'category' => 0,
    'options' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1a5fac37d608_29063242',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5fac37d608_29063242')) {function content_5b1a5fac37d608_29063242($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['categories']->value)&&!empty($_smarty_tpl->tpl_vars['categories']->value)) {?>
<div id="category_blog_block_left"  class="block blogModule boxPlain">
  <h2 class='sdstitle_block'><a href="<?php echo smartblog::GetSmartBlogLink('smartblog_list');?>
"><?php echo smartyTranslate(array('s'=>'Blog Categories','mod'=>'smartblogcategories'),$_smarty_tpl);?>
</a></h2>
   <div class="block_content list-block">
         <ul>
	<?php  $_smarty_tpl->tpl_vars["category"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["category"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["category"]->key => $_smarty_tpl->tpl_vars["category"]->value) {
$_smarty_tpl->tpl_vars["category"]->_loop = true;
?>
            <?php $_smarty_tpl->tpl_vars["options"] = new Smarty_variable(null, null, 0);?>
            <?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['id_category'] = $_smarty_tpl->tpl_vars['category']->value['id_smart_blog_category'];?>
            <?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['slug'] = $_smarty_tpl->tpl_vars['category']->value['link_rewrite'];?>
                <li>
                    <a href="<?php echo smartblog::GetSmartBlogLink('smartblog_category',$_smarty_tpl->tpl_vars['options']->value);?>
">[<?php echo $_smarty_tpl->tpl_vars['category']->value['count'];?>
] <?php echo $_smarty_tpl->tpl_vars['category']->value['meta_title'];?>
</a>
                </li>
	<?php } ?>
        </ul>
   </div>
</div>
<?php }?><?php }} ?>
