<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:51:25
         compiled from "/home/abdouhanne/www/themes/supershop/modules/blockuserinfo/nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12126072615b1a5fad898103-17781727%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5909b8670d88d2962955db3e638873fd0027b482' => 
    array (
      0 => '/home/abdouhanne/www/themes/supershop/modules/blockuserinfo/nav.tpl',
      1 => 1508446323,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12126072615b1a5fad898103-17781727',
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
  'unifunc' => 'content_5b1a5fad8e6589_14364365',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5fad8e6589_14364365')) {function content_5b1a5fad8e6589_14364365($_smarty_tpl) {?><!-- Block user information module NAV  -->
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
            <?php echo smartyTranslate(array('s'=>'Mon compte','mod'=>'blockuserinfo'),$_smarty_tpl);?>

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
                    <?php echo smartyTranslate(array('s'=>'S\'identifier','mod'=>'blockuserinfo'),$_smarty_tpl);?>

        	    </a>
        <?php }?>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('products-comparison',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Mes comparaisons','mod'=>'blockuserinfo'),$_smarty_tpl);?>
">
            <?php echo smartyTranslate(array('s'=>'Comparer','mod'=>'blockuserinfo'),$_smarty_tpl);?>

        </a>
        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getModuleLink('blockwishlist','mywishlist',array(),true), ENT_QUOTES, 'UTF-8', true);?>
"  rel="nofollow" title="<?php echo smartyTranslate(array('s'=>'Ma liste de souhaits','mod'=>'blockuserinfo'),$_smarty_tpl);?>
">
            <?php echo smartyTranslate(array('s'=>'Mes souhaits','mod'=>'blockuserinfo'),$_smarty_tpl);?>

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
