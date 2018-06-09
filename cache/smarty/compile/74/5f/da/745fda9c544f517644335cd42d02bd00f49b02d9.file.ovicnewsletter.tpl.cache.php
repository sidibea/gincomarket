<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:53:20
         compiled from "/home/abdouhanne/www/pr/modules/ovicnewsletter/ovicnewsletter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12859005825901f7d0812ac9-55481199%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '745fda9c544f517644335cd42d02bd00f49b02d9' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/ovicnewsletter/ovicnewsletter.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12859005825901f7d0812ac9-55481199',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'newsletter_setting' => 0,
    'ovicNewsletterUrl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5901f7d0833fe9_33999961',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f7d0833fe9_33999961')) {function content_5901f7d0833fe9_33999961($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['newsletter_setting']->value) {?>
<div id="overlay" style="display: block;" onclick="closeDialog()"></div>
<?php if ($_smarty_tpl->tpl_vars['newsletter_setting']->value['background']!='') {?>
<div class="ovicnewsletter" style="background-image: url(<?php echo $_smarty_tpl->tpl_vars['newsletter_setting']->value['background'];?>
);">
<?php } else { ?>
<div class="ovicnewsletter">
<?php }?>
    <div class="inner">
        <div class="ovicnewsletter-close"><a href="javascript:void(0)" onclick="closeDialog()"><img src="<?php echo $_smarty_tpl->tpl_vars['ovicNewsletterUrl']->value;?>
/images/icon-close.png" /> </a></div>
        <div class="clearfix newsletter-content">
            <?php echo $_smarty_tpl->tpl_vars['newsletter_setting']->value['content'];?>

        </div>
        <div class="newsletter-form">
            <div id="regisNewsletterMessage"></div>
			<div class="" >
				<div class="clearfix">
					<input class="input-email" id="input-email" id="" type="text" name="email" size="18" placeholder="<?php echo smartyTranslate(array('s'=>'Enter your email...','mod'=>'blocknewsletter'),$_smarty_tpl);?>
" value="" />                    
					<a onclick="regisNewsletter()" name="submitNewsletter" class="btn btn-default button"><?php echo smartyTranslate(array('s'=>"Subscribe"),$_smarty_tpl);?>
</a>
				</div>
                <div style="margin-top:15px">                    
                    <div class="checkbox" style="margin-bottom:0"><label><input id="persistent" name="persistent" type="checkbox" value="1"><?php echo smartyTranslate(array('s'=>" Do not show this popup again",'mod'=>"ovicnewsletter"),$_smarty_tpl);?>
</label></div>
                </div>
				                    
			</div>
    		
        </div>
    </div>    
</div>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'regisNewsletterMessage')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'regisNewsletterMessage'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'You have just subscribled successfully!','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'regisNewsletterMessage'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'enterEmail')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'enterEmail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Enter your email please!','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'enterEmail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?>
<script type="text/javascript">
    var ovicNewsletterUrl = "<?php echo $_smarty_tpl->tpl_vars['ovicNewsletterUrl']->value;?>
";
</script><?php }} ?>
