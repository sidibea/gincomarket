<?php /* Smarty version Smarty-3.1.19, created on 2018-06-04 05:42:59
         compiled from "/home/abdouhanne/www/pr/themes/supershop/modules/blockuserinfo/nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2055698665b14d163c11a58-21312896%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f1b88d071505b63d8b5d7e28961b89d858b00d7d' => 
    array (
      0 => '/home/abdouhanne/www/pr/themes/supershop/modules/blockuserinfo/nav.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2055698665b14d163c11a58-21312896',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'is_logged' => 0,
    'link' => 0,
    'cookie' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b14d164002349_45688369',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b14d164002349_45688369')) {function content_5b14d164002349_45688369($_smarty_tpl) {?><!-- Block user information module NAV  -->
<div class="header_user_info">
    <?php if ($_smarty_tpl->tpl_vars['is_logged']->value) {?>
    		<a class="header-toggle-call"  href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View my customer account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="account" rel="nofollow"><span> <?php echo htmlspecialchars($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['truncate'][0][0]->smarty_modifier_truncate($_smarty_tpl->tpl_vars['cookie']->value->customer_lastname,10,''), ENT_QUOTES, 'UTF-8', true);?>
</span></a>
    <?php } else { ?>
            <a class="header-toggle-call login" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Log in to your customer account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
">
            <?php echo smartyTranslate(array('s'=>'My account','mod'=>'blockuserinfo'),$_smarty_tpl);?>

        </a>
    <?php }?>

    <div class="header-toggle">
        <?php if ($_smarty_tpl->tpl_vars['is_logged']->value) {?>
        		<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View my customer account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
" class="account" rel="nofollow"><?php echo smartyTranslate(array('s'=>'My account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
        <?php } else { ?>
                <a class="login" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
" rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Log in to your customer account','mod'=>'blockuserinfo'),$_smarty_tpl);?>
">
                    <?php echo smartyTranslate(array('s'=>'Login','mod'=>'blockuserinfo'),$_smarty_tpl);?>

        	    </a>
        <?php }?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('products-comparison',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'My compare','mod'=>'blockuserinfo'),$_smarty_tpl);?>
">
            <?php echo smartyTranslate(array('s'=>'Compare','mod'=>'blockuserinfo'),$_smarty_tpl);?>

        </a>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getModuleLink('blockwishlist','mywishlist',array(),true), ENT_QUOTES, 'UTF-8', true);?>
"  rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'My wishlists','mod'=>'blockuserinfo'),$_smarty_tpl);?>
">
            <?php echo smartyTranslate(array('s'=>'Wishlists','mod'=>'blockuserinfo'),$_smarty_tpl);?>

        </a>
        <?php if ($_smarty_tpl->tpl_vars['is_logged']->value) {?>
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('index',true,null,"mylogout"), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Sign out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Sign out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
        <?php }?>
    </div>
</div>

<!-- /Block usmodule NAV -->
<?php }} ?>
