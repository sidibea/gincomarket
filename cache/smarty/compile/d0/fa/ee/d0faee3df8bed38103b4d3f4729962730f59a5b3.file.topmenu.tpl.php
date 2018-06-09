<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:51:25
         compiled from "/home/abdouhanne/www/themes/supershop/modules/advancetopmenu/views/templates/hook/topmenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4393924075b1a5fadb87b36-46122549%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0faee3df8bed38103b4d3f4729962730f59a5b3' => 
    array (
      0 => '/home/abdouhanne/www/themes/supershop/modules/advancetopmenu/views/templates/hook/topmenu.tpl',
      1 => 1493588702,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4393924075b1a5fadb87b36-46122549',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MENU' => 0,
    'current_option' => 0,
    'page_name' => 0,
    'mainitem' => 0,
    'sub' => 0,
    'block' => 0,
    'item' => 0,
    'absoluteUrl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1a5fadc0fd03_42912747',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5fadc0fd03_42912747')) {function content_5b1a5fadc0fd03_42912747($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars["current_option"] = new Smarty_variable(Configuration::get('OVIC_CURRENT_OPTION'), null, 0);?>
<?php if (isset($_smarty_tpl->tpl_vars['MENU']->value)) {?>
<?php if ($_smarty_tpl->tpl_vars['current_option']->value==3) {?>
    <div class="col-sm-9 alpha beta displayHomeTopMenu">
<?php } elseif ($_smarty_tpl->tpl_vars['current_option']->value==4) {?>
    <div class="col-sm-11 alpha beta displayHomeTopMenu">
<?php } else { ?>
    <?php if ($_smarty_tpl->tpl_vars['page_name']->value=='index') {?>
        <div class="col-sm-9 alpha beta displayHomeTopMenu">
    <?php } else { ?>
        <div class="col-sm-9 alpha beta" style="margin-left: -15px">
    <?php }?>
<?php }?>

<nav id="nav_topmenu" class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#topmenu">
            <span><?php echo smartyTranslate(array('s'=>'Toggle navigation'),$_smarty_tpl);?>
</span>
        </button>
        <a class="navbar-brand" href="#">Menu</a>
    </div>
    <div class="collapse navbar-collapse container" id="topmenu">
        <ul class="nav navbar-nav">
        <?php  $_smarty_tpl->tpl_vars['mainitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mainitem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MENU']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mainitem']->key => $_smarty_tpl->tpl_vars['mainitem']->value) {
$_smarty_tpl->tpl_vars['mainitem']->_loop = true;
?>
            <li class="level-1<?php if ($_smarty_tpl->tpl_vars['mainitem']->value['active']==1) {?> active<?php }?><?php if (isset($_smarty_tpl->tpl_vars['mainitem']->value['submenu'])) {?> dropdown<?php }?><?php if (preg_match_all('/[^\s]/u',$_smarty_tpl->tpl_vars['mainitem']->value['class'], $tmp)>0) {?> <?php echo $_smarty_tpl->tpl_vars['mainitem']->value['class'];?>
<?php }?>">
                <a href="<?php echo $_smarty_tpl->tpl_vars['mainitem']->value['link'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['mainitem']->value['submenu'])) {?> class="dropdown-toggle" <?php if ($_smarty_tpl->tpl_vars['mainitem']->value['active']) {?>data-toggle="dropdown"<?php }?><?php }?>><?php if (preg_match_all('/[^\s]/u',$_smarty_tpl->tpl_vars['mainitem']->value['icon'], $tmp)>0) {?><i class="<?php echo $_smarty_tpl->tpl_vars['mainitem']->value['icon'];?>
"></i><?php }?><?php echo $_smarty_tpl->tpl_vars['mainitem']->value['title'];?>
<?php if (isset($_smarty_tpl->tpl_vars['mainitem']->value['submenu'])) {?> <b class="caret"></b><?php }?></a>
                <?php if (isset($_smarty_tpl->tpl_vars['mainitem']->value['submenu'])) {?>
                    <?php $_smarty_tpl->tpl_vars['sub'] = new Smarty_variable($_smarty_tpl->tpl_vars['mainitem']->value['submenu'], null, 0);?>
                        <ul class="container-fluid <?php if (preg_match_all('/[^\s]/u',$_smarty_tpl->tpl_vars['sub']->value['class'], $tmp)>0) {?><?php echo $_smarty_tpl->tpl_vars['sub']->value['class'];?>
 <?php }?>dropdown-menu" role="menu" <?php if ($_smarty_tpl->tpl_vars['sub']->value['width']) {?>style="width:<?php echo $_smarty_tpl->tpl_vars['sub']->value['width'];?>
px"<?php }?>>
                        <?php if (isset($_smarty_tpl->tpl_vars['sub']->value['blocks'])&&count($_smarty_tpl->tpl_vars['sub']->value['blocks'])>0) {?>
                            <?php  $_smarty_tpl->tpl_vars['block'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['block']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sub']->value['blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['block']->key => $_smarty_tpl->tpl_vars['block']->value) {
$_smarty_tpl->tpl_vars['block']->_loop = true;
?>
                                <?php if (isset($_smarty_tpl->tpl_vars['block']->value['items'])&&count($_smarty_tpl->tpl_vars['block']->value['items'])>0) {?>
                                    <li class="block-container col-sm-<?php echo $_smarty_tpl->tpl_vars['block']->value['width'];?>
<?php if (preg_match_all('/[^\s]/u',$_smarty_tpl->tpl_vars['block']->value['class'], $tmp)>0) {?> <?php echo $_smarty_tpl->tpl_vars['block']->value['class'];?>
<?php }?>">
                                        <ul class="block">
                                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['block']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                            <li class="level-2 <?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>
_container <?php echo $_smarty_tpl->tpl_vars['item']->value['class'];?>
">
                                                <?php if ($_smarty_tpl->tpl_vars['item']->value['type']=='link') {?>
                                                    <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
"><?php if (preg_match_all('/[^\s]/u',$_smarty_tpl->tpl_vars['item']->value['icon'], $tmp)>0) {?><i class="<?php echo $_smarty_tpl->tpl_vars['item']->value['icon'];?>
"></i><?php }?><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</a>
                                                <?php } elseif ($_smarty_tpl->tpl_vars['item']->value['type']=='img'&&preg_match_all('/[^\s]/u',$_smarty_tpl->tpl_vars['item']->value['icon'], $tmp)>0) {?>
                                                    <a class="<?php echo $_smarty_tpl->tpl_vars['item']->value['class'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
">
                                                        <img alt="" src="<?php echo $_smarty_tpl->tpl_vars['absoluteUrl']->value;?>
img/<?php echo $_smarty_tpl->tpl_vars['item']->value['icon'];?>
" class="img-responsive" />
                                                    </a>
                                                <?php } elseif ($_smarty_tpl->tpl_vars['item']->value['type']=='html') {?>
                                                    <?php echo $_smarty_tpl->tpl_vars['item']->value['text'];?>

                                                <?php }?>
                                            </li>
                                        <?php } ?>
                                        </ul>
                                    </li>
                                <?php }?>
                            <?php } ?>
                        <?php }?>
                        </ul>
                <?php }?>
            </li>
        <?php } ?>
        </ul>
    </div>
</nav>
</div>
	<!--/ Menu -->
<?php }?><?php }} ?>
