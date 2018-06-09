<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 10:35:13
         compiled from "/home/abdouhanne/www/themes/supershop/modules/blockbestsellers/blockbestsellers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20062705085b1a5be19e1149-00775083%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ecdb3216fae9cf246c9272971af3134e2c140b96' => 
    array (
      0 => '/home/abdouhanne/www/themes/supershop/modules/blockbestsellers/blockbestsellers.tpl',
      1 => 1493588701,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20062705085b1a5be19e1149-00775083',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'current_option' => 0,
    'link' => 0,
    'best_sellers' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b1a5be1d0a996_56360345',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b1a5be1d0a996_56360345')) {function content_5b1a5be1d0a996_56360345($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars["current_option"] = new Smarty_variable(Configuration::get('OVIC_CURRENT_OPTION'), null, 0);?>
<!-- MODULE Block best sellers -->
<div id="best-sellers_block_right" class="block products_block <?php if (isset($_smarty_tpl->tpl_vars['current_option']->value)&&$_smarty_tpl->tpl_vars['current_option']->value==2) {?>products_block_option2<?php }?><?php if (isset($_smarty_tpl->tpl_vars['current_option']->value)&&$_smarty_tpl->tpl_vars['current_option']->value==5) {?>products_block_option5<?php }?>">
	<?php if (isset($_smarty_tpl->tpl_vars['current_option']->value)&&$_smarty_tpl->tpl_vars['current_option']->value==2) {?>
        <h4 class="title_block_option2">
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('best-sales'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View a recently bought products','mod'=>'blockbestsellers'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'RECENTLY BOUGHT','mod'=>'blockbestsellers'),$_smarty_tpl);?>
</a>    
        </h4>
    <?php } elseif (isset($_smarty_tpl->tpl_vars['current_option']->value)&&$_smarty_tpl->tpl_vars['current_option']->value==5) {?>
        <h4 class="title_block_option5">
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('best-sales'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View a recently bought products','mod'=>'blockbestsellers'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'RECENTLY BOUGHT','mod'=>'blockbestsellers'),$_smarty_tpl);?>
</a>    
        </h4>
    <?php } else { ?>
    <h4 class="title_block">
    	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('best-sales'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'View a top sellers products','mod'=>'blockbestsellers'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Top sellers','mod'=>'blockbestsellers'),$_smarty_tpl);?>
</a>
    </h4>
    <?php }?>
	<div class="block_content">
	<?php if ($_smarty_tpl->tpl_vars['best_sellers']->value&&count($_smarty_tpl->tpl_vars['best_sellers']->value)>0) {?>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./product-list-home.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('products'=>$_smarty_tpl->tpl_vars['best_sellers']->value,'id'=>"best_sellers_block"), 0);?>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $("#best_sellers_block").owlCarousel({
                    loop:true,
                    margin:10,
                    nav:true,
                    responsive:{
                        0:{
                            items:1
                        }
                    }
                })
            });
        </script>
		<div class="lnk">
        	<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('best-sales'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'All best sellers','mod'=>'blockbestsellers'),$_smarty_tpl);?>
"  class="btn btn-default button button-small"><span><?php echo smartyTranslate(array('s'=>'All best sellers','mod'=>'blockbestsellers'),$_smarty_tpl);?>
<i class="icon-chevron-right right"></i></span></a>
        </div>
	<?php } else { ?>
		<p><?php echo smartyTranslate(array('s'=>'No best sellers at this time','mod'=>'blockbestsellers'),$_smarty_tpl);?>
</p>
	<?php }?>
	</div>
</div>
<!-- /MODULE Block best sellers --><?php }} ?>
