<?php /* Smarty version Smarty-3.1.19, created on 2018-06-04 05:43:01
         compiled from "/home/abdouhanne/www/pr/themes/supershop/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14716764725b14d165b96ea2-98060876%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '105a5416dcf2db75ed64c9652b66efb058fcdafb' => 
    array (
      0 => '/home/abdouhanne/www/pr/themes/supershop/footer.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14716764725b14d165b96ea2-98060876',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_only' => 0,
    'right_column_size' => 0,
    'HOOK_RIGHT_COLUMN' => 0,
    'page_name' => 0,
    'current_option' => 0,
    'HOOK_FOOTER' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b14d165c946d2_36602038',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b14d165c946d2_36602038')) {function content_5b14d165c946d2_36602038($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars["current_option"] = new Smarty_variable(Configuration::get('OVIC_CURRENT_OPTION'), null, 0);?>
<?php if (!isset($_smarty_tpl->tpl_vars['content_only']->value)||!$_smarty_tpl->tpl_vars['content_only']->value) {?>
					</div><!-- #center_column -->
					<?php if (isset($_smarty_tpl->tpl_vars['right_column_size']->value)&&!empty($_smarty_tpl->tpl_vars['right_column_size']->value)) {?>
						<div id="right_column" class="col-xs-12 col-sm-<?php echo intval($_smarty_tpl->tpl_vars['right_column_size']->value);?>
 column"><?php echo $_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value;?>
</div>
					<?php }?>
                    
					</div><!-- .row -->
                    <?php if ($_smarty_tpl->tpl_vars['page_name']->value=='index') {?>
                        <?php if (isset($_smarty_tpl->tpl_vars['current_option']->value)&&$_smarty_tpl->tpl_vars['current_option']->value==2) {?>
                            <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayHomeBottomColumn'),$_smarty_tpl);?>

                        <?php }?>
                        <?php if (isset($_smarty_tpl->tpl_vars['current_option']->value)&&$_smarty_tpl->tpl_vars['current_option']->value==5) {?>
                            <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayHomeBottomColumn'),$_smarty_tpl);?>

                        <?php }?>
                    <?php }?>    
                    <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayBottomColumn'),$_smarty_tpl);?>

				</div>
			</div>
			<?php if ($_smarty_tpl->tpl_vars['page_name']->value=='index') {?>
			<div class="group-categories-container">
				<div class="container">
                    <?php if (isset($_smarty_tpl->tpl_vars['current_option']->value)&&($_smarty_tpl->tpl_vars['current_option']->value==1||$_smarty_tpl->tpl_vars['current_option']->value==4)) {?>
                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayHomeBottomColumn'),$_smarty_tpl);?>

                    <?php }?>
				</div>				
			</div>
			<?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['HOOK_FOOTER']->value)) {?>
				<!-- Footer -->
				<div class="footer-container">
					<footer id="footer">
						<?php echo $_smarty_tpl->tpl_vars['HOOK_FOOTER']->value;?>

					</footer>
				</div><!-- #footer -->
			<?php }?>
            <a href="#" class="scroll_top" title="Scroll to Top"><?php echo smartyTranslate(array('s'=>'Scroll'),$_smarty_tpl);?>
</a>
		</div><!-- #page -->
<?php }?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./global.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	</body>
</html><?php }} ?>
