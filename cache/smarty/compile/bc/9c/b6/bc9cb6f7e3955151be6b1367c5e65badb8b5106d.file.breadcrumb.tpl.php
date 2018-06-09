<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:51:25
         compiled from "/home/abdouhanne/www/themes/supershop/breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12863783935b1a5fadc33bf5-57381407%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc9cb6f7e3955151be6b1367c5e65badb8b5106d' => 
    array (
      0 => '/home/abdouhanne/www/themes/supershop/breadcrumb.tpl',
      1 => 1493588700,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12863783935b1a5fadc33bf5-57381407',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'path' => 0,
    'breadcrumb_post' => 0,
    'breadcrumb_first' => 0,
    'breadcrumb_last' => 0,
    'base_dir' => 0,
    'category' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1a5fadc89c72_79623137',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5fadc89c72_79623137')) {function content_5b1a5fadc89c72_79623137($_smarty_tpl) {?>

<!-- Breadcrumb -->
<?php if (isset(Smarty::$_smarty_vars['capture']['path'])) {?><?php $_smarty_tpl->tpl_vars['path'] = new Smarty_variable(Smarty::$_smarty_vars['capture']['path'], null, 0);?><?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['path']->value)) {?>
<?php $_smarty_tpl->tpl_vars['breadcrumb_post'] = new Smarty_variable(strpos($_smarty_tpl->tpl_vars['path']->value,"</span>"), null, 0);?>
<?php if (($_smarty_tpl->tpl_vars['breadcrumb_post']->value>0)) {?>
    <?php $_smarty_tpl->tpl_vars['breadcrumb_first'] = new Smarty_variable(substr($_smarty_tpl->tpl_vars['path']->value,0,($_smarty_tpl->tpl_vars['breadcrumb_post']->value+7)), null, 0);?>
    <?php ob_start();?><?php echo substr($_smarty_tpl->tpl_vars['path']->value,($_smarty_tpl->tpl_vars['breadcrumb_post']->value+7));?>
<?php $_tmp6=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['breadcrumb_last'] = new Smarty_variable("<span class=\"navigation_page\">".$_tmp6."</span>", null, 0);?>
    <?php $_smarty_tpl->tpl_vars['path'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['breadcrumb_first']->value).((string)$_smarty_tpl->tpl_vars['breadcrumb_last']->value), null, 0);?>
<?php }?>
<?php }?>
<div class="breadcrumb clearfix">
	<a class="home" href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
" title="<?php echo smartyTranslate(array('s'=>'Return to Home'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Home'),$_smarty_tpl);?>
</a>
	<?php if (isset($_smarty_tpl->tpl_vars['path']->value)&&$_smarty_tpl->tpl_vars['path']->value) {?>
		<span class="navigation-pipe" <?php if (isset($_smarty_tpl->tpl_vars['category']->value)&&isset($_smarty_tpl->tpl_vars['category']->value->id_category)&&$_smarty_tpl->tpl_vars['category']->value->id_category==1) {?>style="display:none;"<?php }?>>&nbsp;</span>
		<?php if (!strpos($_smarty_tpl->tpl_vars['path']->value,'span')) {?>
			<span class="navigation_page"><?php echo $_smarty_tpl->tpl_vars['path']->value;?>
</span>
		<?php } else { ?>
			<?php echo $_smarty_tpl->tpl_vars['path']->value;?>

		<?php }?>
	<?php }?>
</div>
<?php if (isset($_GET['search_query'])&&isset($_GET['results'])&&$_GET['results']>1&&isset($_SERVER['HTTP_REFERER'])) {?>
<div class="pull-right">
	<strong>
		<a href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER'], ENT_QUOTES, 'UTF-8', true);?>
" name="back">
			<i class="icon-chevron-left left"></i> <?php echo smartyTranslate(array('s'=>'Back to Search results for "%s" (%d other results)','sprintf'=>array($_GET['search_query'],$_GET['results'])),$_smarty_tpl);?>

		</a>
	</strong>
</div>
<?php }?>
<!-- /Breadcrumb --><?php }} ?>
