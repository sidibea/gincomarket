<?php /* Smarty version Smarty-3.1.19, created on 2017-04-30 17:12:15
         compiled from "/home/abdouhanne/www/pr/themes/supershop/modules/smartbloghomelatestnews/views/templates/front/smartblog_latest_news.tpl" */ ?>
<?php /*%%SmartyHeaderCode:105592169159061aef30f580-25919582%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd06722c02167724bf4c417f512a92661395ff78e' => 
    array (
      0 => '/home/abdouhanne/www/pr/themes/supershop/modules/smartbloghomelatestnews/views/templates/front/smartblog_latest_news.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '105592169159061aef30f580-25919582',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'view_data' => 0,
    'current_option' => 0,
    'post' => 0,
    'options' => 0,
    'modules_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59061aef36fe11_95293671',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59061aef36fe11_95293671')) {function content_59061aef36fe11_95293671($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/abdouhanne/www/pr/tools/smarty/plugins/modifier.date_format.php';
?><?php if (isset($_smarty_tpl->tpl_vars['view_data']->value)&&!empty($_smarty_tpl->tpl_vars['view_data']->value)) {?>
<?php $_smarty_tpl->tpl_vars["current_option"] = new Smarty_variable(Configuration::get('OVIC_CURRENT_OPTION'), null, 0);?>
<!--Blogs slide-->
<?php if ($_smarty_tpl->tpl_vars['current_option']->value==3) {?>
<h2 class="title_block_option2 blog"><?php echo smartyTranslate(array('s'=>'NEW IN TODAY','mod'=>'smartbloghomelatestnews'),$_smarty_tpl);?>
</h2>
<?php } elseif ($_smarty_tpl->tpl_vars['current_option']->value==5) {?>
<h2 class="title_block_option5 blog"><?php echo smartyTranslate(array('s'=>'NEW IN TODAY','mod'=>'smartbloghomelatestnews'),$_smarty_tpl);?>
</h2>
<?php } else { ?>
<h2 class="title_block_option2 blog"><?php echo smartyTranslate(array('s'=>'THE LATEST POSTS FROM OUR BLOG','mod'=>'smartbloghomelatestnews'),$_smarty_tpl);?>
</h2>
<?php }?>

<div id="wrap_blog">
    <div id="home_blog" class="owl_wrap">
    <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['view_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
        <?php $_smarty_tpl->tpl_vars["options"] = new Smarty_variable(null, null, 0);?>
        <?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['id_post'] = $_smarty_tpl->tpl_vars['post']->value['id'];?>
        <?php $_smarty_tpl->createLocalArrayVariable('options', null, 0);
$_smarty_tpl->tpl_vars['options']->value['slug'] = $_smarty_tpl->tpl_vars['post']->value['link_rewrite'];?>
        <div class="slide_item block-content" >
            <div class="wrapper" >
                <div class="content">
                    <div class="blog-img">
                        <a href="<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['modules_dir']->value;?>
smartblog/images/<?php echo $_smarty_tpl->tpl_vars['post']->value['post_img'];?>
-home-default.jpg" alt="" />
                            <i class="fa fa-link"></i>
                        </a>
                    </div>
                    
                    <h3 class="content-title"><a href="<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a></h3>
                    <p class="post_by_info">
                        
                        <i class="fa fa-calendar-o"></i>&nbsp;<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value['date_added']);?>
&nbsp;&nbsp;|&nbsp;&nbsp;<i class="fa fa-comments-o"></i>&nbsp;0&nbsp;<?php echo smartyTranslate(array('s'=>'Comments','mod'=>'smartbloghomelatestnews'),$_smarty_tpl);?>

                    </p>
                    <p class="post_content_blog">
                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate(mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['short_description'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8'),125,"...");?>

                    </p>
                    <p class="readmore">
                        <a href="<?php echo smartblog::GetSmartBlogLink('smartblog_post',$_smarty_tpl->tpl_vars['options']->value);?>
"><?php echo smartyTranslate(array('s'=>'Read more','mod'=>'smartbloghomelatestnews'),$_smarty_tpl);?>
</a>
                    </p>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>
<?php }?>
</div>
<?php }} ?>
