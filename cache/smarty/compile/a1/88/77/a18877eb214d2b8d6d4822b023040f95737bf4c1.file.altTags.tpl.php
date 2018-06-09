<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 13:37:16
         compiled from "/home/abdouhanne/www/pr/modules/bablic/views/templates/front/altTags.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7372846065901f40ce5d7c3-83563979%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a18877eb214d2b8d6d4822b023040f95737bf4c1' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/bablic/views/templates/front/altTags.tpl',
      1 => 1493135872,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7372846065901f40ce5d7c3-83563979',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'version' => 0,
    'locales' => 0,
    'locale' => 0,
    'subdir' => 0,
    'folders_json' => 0,
    'subdir_base' => 0,
    'async' => 0,
    'snippet_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5901f40ce7f191_49612615',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5901f40ce7f191_49612615')) {function content_5901f40ce7f191_49612615($_smarty_tpl) {?>

<!-- start Bablic Head <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['version']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 -->
<?php  $_smarty_tpl->tpl_vars['locale'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['locale']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['locales']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['locale']->key => $_smarty_tpl->tpl_vars['locale']->value) {
$_smarty_tpl->tpl_vars['locale']->_loop = true;
?>
    <link rel="alternate" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['locale']->value[0], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" hreflang="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['locale']->value[1], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
<?php } ?>
<?php if ($_smarty_tpl->tpl_vars['subdir']->value==true) {?>
  <script>
    var bablic = {};
    bablic.localeURL = 'subdir';
    bablic.folders = <?php echo $_smarty_tpl->tpl_vars['folders_json']->value;?>
; 
    bablic.subDirBase = '<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['subdir_base']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
';
</script>
<?php }?>
<script data-cfasync="false"<?php if ($_smarty_tpl->tpl_vars['async']->value==true) {?> async<?php }?> src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['snippet_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"></script>
<!-- end Bablic Head -->
<?php }} ?>
