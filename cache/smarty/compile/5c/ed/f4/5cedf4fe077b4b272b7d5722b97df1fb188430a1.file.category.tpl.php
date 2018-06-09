<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:48:15
         compiled from "/home/abdouhanne/www/themes/supershop/category.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18120205685b1a5eefd28b16-69261392%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5cedf4fe077b4b272b7d5722b97df1fb188430a1' => 
    array (
      0 => '/home/abdouhanne/www/themes/supershop/category.tpl',
      1 => 1493588700,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18120205685b1a5eefd28b16-69261392',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category' => 0,
    'HOOK_OVIC_CATEGORYSLIDER' => 0,
    'subcategories' => 0,
    'subcategory' => 0,
    'link' => 0,
    'products' => 0,
    'categoryNameComplement' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1a5eefd74349_82031913',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5eefd74349_82031913')) {function content_5b1a5eefd74349_82031913($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php if (isset($_smarty_tpl->tpl_vars['category']->value)) {?>
	<?php if ($_smarty_tpl->tpl_vars['category']->value->id&&$_smarty_tpl->tpl_vars['category']->value->active) {?>
        <?php echo $_smarty_tpl->tpl_vars['HOOK_OVIC_CATEGORYSLIDER']->value;?>

        <?php if ($_smarty_tpl->tpl_vars['category']->value->id_image) {?>
            
        <?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['subcategories']->value)) {?>
        
		<!-- Subcategories -->
		<div id="subcategories">
			<ul class="clearfix">
			<?php  $_smarty_tpl->tpl_vars['subcategory'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['subcategory']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['subcategories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['subcategory']->key => $_smarty_tpl->tpl_vars['subcategory']->value) {
$_smarty_tpl->tpl_vars['subcategory']->_loop = true;
?>
				<li>
					<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getCategoryLink($_smarty_tpl->tpl_vars['subcategory']->value['id_category'],$_smarty_tpl->tpl_vars['subcategory']->value['link_rewrite']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subcategory']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" ><?php echo $_smarty_tpl->tpl_vars['subcategory']->value['name'];?>
</a>
				</li>
			<?php } ?>
			</ul>
            <?php if ($_smarty_tpl->tpl_vars['category']->value->description) {?>
                <div id="category_description_full" class="unvisible rte"><?php echo $_smarty_tpl->tpl_vars['category']->value->description;?>
</div>            
            <?php }?>
		</div>
        
        <?php } else { ?>
            <?php if ($_smarty_tpl->tpl_vars['category']->value->description) {?>
            <div id="subcategories">                
                <div id="category_description_full" class="unvisible rte"><?php echo $_smarty_tpl->tpl_vars['category']->value->description;?>
</div>                            
    		</div>
            <?php }?>
		<?php }?>
        
        
        <div class="view-product-list">
            <h1 class="page-heading<?php if ((isset($_smarty_tpl->tpl_vars['subcategories']->value)&&!$_smarty_tpl->tpl_vars['products']->value)||(isset($_smarty_tpl->tpl_vars['subcategories']->value)&&$_smarty_tpl->tpl_vars['products']->value)||!isset($_smarty_tpl->tpl_vars['subcategories']->value)&&$_smarty_tpl->tpl_vars['products']->value) {?> product-listing<?php }?>"><span class="cat-name"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);?>
<?php if (isset($_smarty_tpl->tpl_vars['categoryNameComplement']->value)) {?>&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['categoryNameComplement']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php }?></span></h1>
            <?php echo $_smarty_tpl->getSubTemplate ("./product-sort-view.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        </div>
		<?php if ($_smarty_tpl->tpl_vars['products']->value) {?>
			<?php echo $_smarty_tpl->getSubTemplate ("./product-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('products'=>$_smarty_tpl->tpl_vars['products']->value), 0);?>

			<div class="content_sortPagiBar">
                <div class="sortPagiBar clearfix">
                    <?php echo $_smarty_tpl->getSubTemplate ("./product-compare.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                    <?php echo $_smarty_tpl->getSubTemplate ("./pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('paginationId'=>'bottom'), 0);?>

                    <?php echo $_smarty_tpl->getSubTemplate ("./nbr-product-page.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                    <?php echo $_smarty_tpl->getSubTemplate ("./product-sort.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('sortID'=>'bottom'), 0);?>

                    
                </div>
			</div>
		<?php } else { ?>
            <div class="warning"><?php echo smartyTranslate(array('s'=>'Sorry! There are no products in this category.'),$_smarty_tpl);?>
</div>
        <?php }?>
	<?php } elseif ($_smarty_tpl->tpl_vars['category']->value->id) {?>
		<p class="alert alert-warning"><?php echo smartyTranslate(array('s'=>'This category is currently unavailable.'),$_smarty_tpl);?>
</p>
	<?php }?>
<?php }?>
<?php }} ?>
