<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 15:13:12
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/seller_tabs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13609217159020a883d0404-21455742%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8aa2d7eb37de69aa79e03f61b877fa7cfb436179' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/seller_tabs.tpl',
      1 => 1493122817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13609217159020a883d0404-21455742',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'warnings' => 0,
    'warning' => 0,
    'seller_tab_id' => 0,
    'cfmmsg_flag' => 0,
    'base_dir' => 0,
    'seller_exists' => 0,
    'isSeller' => 0,
    'pay_options_link' => 0,
    'link' => 0,
    'is_seller_shipping_installed' => 0,
    'is_seller_commission_installed' => 0,
    'is_seller_messenger_installed' => 0,
    'is_seller_ratings_installed' => 0,
    'is_seller_listoptions_installed' => 0,
    'is_seller_tools_installed' => 0,
    'is_seller_pickupcenter_installed' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59020a884876d2_87022323',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59020a884876d2_87022323')) {function content_59020a884876d2_87022323($_smarty_tpl) {?>	<?php if (isset($_smarty_tpl->tpl_vars['warnings']->value)&&!empty($_smarty_tpl->tpl_vars['warnings']->value)) {?>
    <?php  $_smarty_tpl->tpl_vars['warning'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['warning']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warnings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['warning']->key => $_smarty_tpl->tpl_vars['warning']->value) {
$_smarty_tpl->tpl_vars['warning']->_loop = true;
?>
			<div class="alert alert-danger">
			<?php echo $_smarty_tpl->tpl_vars['warning']->value;?>
<br>
			</div>
		<?php } ?>
	<?php }?>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#nav-main").idTabs("idTab<?php echo $_smarty_tpl->tpl_vars['seller_tab_id']->value;?>
"); //make google map show first
			$(".showall").hide();

			$("#nav-mobile").html($("#nav-main").html());
			$("#nav-trigger span").click(function(){
			if ($("nav#nav-mobile ul").hasClass("expanded")) {
				$("nav#nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
				$(this).removeClass("open");
			} else {
				$("nav#nav-mobile ul").addClass("expanded").slideDown(250);
				$(this).addClass("open");
			}
    });
        });

    </script>
    <?php if (isset($_smarty_tpl->tpl_vars['cfmmsg_flag']->value)&&$_smarty_tpl->tpl_vars['cfmmsg_flag']->value==1) {?>
	<div style="margin:5px;padding:10px;border:solid green 1px;">
			<img src="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
/modules/agilemultipleseller/images/icon-ok.png" alt="<?php echo smartyTranslate(array('s'=>'Confirmation','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
" />&nbsp;<?php echo smartyTranslate(array('s'=>'Update successful.','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

	</div>
	<?php }?>
    <?php if ($_smarty_tpl->tpl_vars['seller_exists']->value&&!$_smarty_tpl->tpl_vars['isSeller']->value) {?>
	<div style="margin:5px;padding:10px;border:solid green 1px;">
			<img src="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
/modules/agilemultipleseller/images/icon-attention.png" height="20" alt="<?php echo smartyTranslate(array('s'=>'Attention','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
" />&nbsp;<?php echo smartyTranslate(array('s'=>'Your account is under approval or pending. Some functions are not available to you.','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

	</div>
	<?php }?>

    <?php if (isset($_smarty_tpl->tpl_vars['pay_options_link']->value)&&!empty($_smarty_tpl->tpl_vars['pay_options_link']->value)) {?><?php echo $_smarty_tpl->tpl_vars['pay_options_link']->value;?>
<?php }?>
    <nav id="nav-main" class="agile-nav">
		<ul class="idTabs idTabsShort clearfix">
			<li <?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==1) {?>class="current"<?php }?>><a id="seler_summary" href="<?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==1) {?>#idTab1<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellersummary',array(),true);?>
<?php }?>"><?php echo smartyTranslate(array('s'=>'Summary','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a></li>
			<?php if ($_smarty_tpl->tpl_vars['seller_exists']->value) {?>
				<li <?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==2) {?>class="current"<?php }?>><a id="seller_business" href="<?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==2) {?>#idTab2<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellerbusiness',array(),true);?>
<?php }?>"><?php echo smartyTranslate(array('s'=>'Business Info','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a></li>
				<li <?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==5) {?>class="current"<?php }?>><a id="seller_Payments" href="<?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==5) {?>#idTab5<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellerpayments',array(),true);?>
<?php }?>"><?php echo smartyTranslate(array('s'=>'Payment Info','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a></li>
				<?php if ($_smarty_tpl->tpl_vars['isSeller']->value) {?>
					<li <?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==3) {?>class="current"<?php }?>><a id="seller_products" href="<?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==3) {?>#idTab3<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellerproducts',array(),true);?>
<?php }?>"><?php echo smartyTranslate(array('s'=>'Products','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a></li>
					<li <?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==4) {?>class="current"<?php }?>><a id="seller_orders" href="<?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==4) {?>#idTab4<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellerorders',array(),true);?>
<?php }?>"><?php echo smartyTranslate(array('s'=>'Orders','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a></li>
					<?php if ($_smarty_tpl->tpl_vars['is_seller_shipping_installed']->value) {?>
					<li <?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==6) {?>class="current"<?php }?>><a id="seller_shipping" href="<?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==6) {?>#idTab6<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilesellershipping','sellercarriers',array(),true);?>
<?php }?>"><?php echo smartyTranslate(array('s'=>'Shipping','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a></li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['is_seller_commission_installed']->value) {?> 
					<li <?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==7) {?>class="current"<?php }?>><a id="seller_history" href="<?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==7) {?>#idTab6<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellerhistory',array(),true);?>
<?php }?>"><?php echo smartyTranslate(array('s'=>'Account History','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a></li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['is_seller_messenger_installed']->value) {?>
					<li <?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==8) {?>class="current"<?php }?>><a id="seller_messages" href="<?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==8) {?>#idTab8<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilesellermessenger','sellermessages',array(),true);?>
<?php }?>"><?php echo smartyTranslate(array('s'=>'Messages','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a></li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['is_seller_ratings_installed']->value) {?>
					<li <?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==9) {?>class="current"<?php }?>><a id="seller_ratings" href="<?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==9) {?>#idTab9<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilesellerratings','myreviews',array(),true);?>
<?php }?>"><?php echo smartyTranslate(array('s'=>'Feedback','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a></li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['is_seller_listoptions_installed']->value) {?>
					<li <?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==10) {?>class="current"<?php }?>><a id="seller_expiredproducts" href="<?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==10) {?>#idTab10<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilesellerlistoptions','expiredproducts',array(),true);?>
<?php }?>"><?php echo smartyTranslate(array('s'=>'Expired Products','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a></li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['is_seller_tools_installed']->value) {?>
					<li <?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==11) {?>class="current"<?php }?>><a id="seller_tools" href="<?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==11) {?>#idTab11<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilesellertools','sellertoollist',array(),true);?>
<?php }?>"><?php echo smartyTranslate(array('s'=>'Seller Tools','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a></li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['is_seller_pickupcenter_installed']->value) {?>
					<!-- Disable create pickup location in front page -->
					<!-- li><a id="seller_pickuplocations" href="<?php if ($_smarty_tpl->tpl_vars['seller_tab_id']->value==11) {?>#idTab11<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilepickupcenter','pickuplocations',array(),true);?>
<?php }?>"><?php echo smartyTranslate(array('s'=>'Locations','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a></li -->
					<?php }?>
				<?php }?>
			<?php }?>
		</ul>
	</nav>
	<div id="nav-trigger">
    <span><?php echo smartyTranslate(array('s'=>'My Account','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
	</div>
	<nav id="nav-mobile"></nav><?php }} ?>
