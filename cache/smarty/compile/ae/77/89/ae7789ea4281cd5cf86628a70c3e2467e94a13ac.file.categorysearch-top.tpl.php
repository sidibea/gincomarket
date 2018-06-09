<?php /* Smarty version Smarty-3.1.19, created on 2017-04-30 16:44:55
         compiled from "/home/abdouhanne/www/pr/modules/categorysearch/categorysearch-top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:87574991859061487da2583-55804195%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae7789ea4281cd5cf86628a70c3e2467e94a13ac' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/categorysearch/categorysearch-top.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '87574991859061487da2583-55804195',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'hook_mobile' => 0,
    'link' => 0,
    'search_query' => 0,
    'search_category' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59061487dc9838_40613316',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59061487dc9838_40613316')) {function content_59061487dc9838_40613316($_smarty_tpl) {?><!-- block seach mobile -->
<?php if (isset($_smarty_tpl->tpl_vars['hook_mobile']->value)) {?>
<div class="input_search" data-role="fieldcontain">
	<form method="get" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('search',true), ENT_QUOTES, 'UTF-8', true);?>
" id="searchbox">
		<input type="hidden" name="controller" value="search" />
		<input type="hidden" name="orderby" value="position" />
		<input type="hidden" name="orderway" value="desc" />
		<input class="search_query" type="search" id="search_query_top" name="search_query" placeholder="<?php echo smartyTranslate(array('s'=>'Search','mod'=>'categorysearch'),$_smarty_tpl);?>
" value="<?php echo stripslashes(htmlspecialchars($_smarty_tpl->tpl_vars['search_query']->value, ENT_QUOTES, 'UTF-8', true));?>
" />
	</form>
</div>
<?php } else { ?>
<!-- Block search module TOP -->

<div id="search_block_top" class="clearfix">
<form id="searchbox" method="get" action="<?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getModuleLink('categorysearch','catesearch',array(),true));?>
" >
        <input type="hidden" name="fc" value="module" />
        <input type="hidden" name="module" value="categorysearch" />
		<input type="hidden" name="controller" value="catesearch" />
		<input type="hidden" name="orderby" value="position" />
		<input type="hidden" name="orderway" value="desc" />
        <select id="search_category" name="search_category" class="form-control">
            <option value="all"><?php echo smartyTranslate(array('s'=>'All Categories','mod'=>'categorysearch'),$_smarty_tpl);?>
</option>
            <?php echo $_smarty_tpl->tpl_vars['search_category']->value;?>

        </select>
		<input class="search_query form-control" type="text" id="search_query_top" name="search_query" placeholder="<?php echo smartyTranslate(array('s'=>'Enter Your Keyword...','mod'=>'categorysearch'),$_smarty_tpl);?>
" value="<?php echo stripslashes(mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['search_query']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8'));?>
" />
		<button type="submit" name="submit_search" class="btn btn-default button-search">
			<span><?php echo smartyTranslate(array('s'=>'Search','mod'=>'categorysearch'),$_smarty_tpl);?>
</span>
		</button>
	</form>
</div>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['self']->value)."/categorysearch-instantsearch.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?>
<!-- /Block search module TOP -->
<?php }} ?>
