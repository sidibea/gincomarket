<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:37:17
         compiled from "/home/abdouhanne/www/pr/modules/ovicblockcms/cmspos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1687003385901f40d929579-37474557%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc4e1d125f9f070db25af13abb4f72f189c2893c' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/ovicblockcms/cmspos.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1687003385901f40d929579-37474557',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cms_titles' => 0,
    'cms_title' => 0,
    'cms_page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5901f40d946c39_86532300',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f40d946c39_86532300')) {function content_5901f40d946c39_86532300($_smarty_tpl) {?><!-- Block CMS top -->
<?php if ($_smarty_tpl->tpl_vars['cms_titles']->value&&count($_smarty_tpl->tpl_vars['cms_titles']->value)>0) {?>
<div id="cms_pos">
    <?php  $_smarty_tpl->tpl_vars['cms_title'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cms_title']->_loop = false;
 $_smarty_tpl->tpl_vars['cms_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cms_titles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cms_title']->key => $_smarty_tpl->tpl_vars['cms_title']->value) {
$_smarty_tpl->tpl_vars['cms_title']->_loop = true;
 $_smarty_tpl->tpl_vars['cms_key']->value = $_smarty_tpl->tpl_vars['cms_title']->key;
?>
        <div class="list-block">
            <p class="header-toggle-call cms_title"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_title']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</p>
    		<ul class="header-toggle">
    			<?php  $_smarty_tpl->tpl_vars['cms_page'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cms_page']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cms_title']->value['cms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cms_page']->key => $_smarty_tpl->tpl_vars['cms_page']->value) {
$_smarty_tpl->tpl_vars['cms_page']->_loop = true;
?>
    				<?php if (isset($_smarty_tpl->tpl_vars['cms_page']->value['link'])) {?>
    					<li>
    						<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_page']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_page']->value['meta_title'], ENT_QUOTES, 'UTF-8', true);?>
">
    							<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_page']->value['meta_title'], ENT_QUOTES, 'UTF-8', true);?>

    						</a>
    					</li>
    				<?php }?>
    			<?php } ?>
    		</ul>
        </div>
    <?php } ?>
</div>
<?php }?>

<!-- /Block CMS top --><?php }} ?>
