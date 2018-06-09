<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 15:13:12
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/sellersummary.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28926776759020a88334660-48581341%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6e32c661b29f97e3be22db2759a157b73f5e8d0' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/sellersummary.tpl',
      1 => 1493122817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28926776759020a88334660-48581341',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'navigationPipe' => 0,
    'base_dir_ssl' => 0,
    'membership_module_integrated' => 0,
    'seller_exists' => 0,
    'seller' => 0,
    'num_products' => 0,
    'num_orders' => 0,
    'totals_sold' => 0,
    'total' => 0,
    'is_seller_commission_installed' => 0,
    'comcurrency' => 0,
    'account_balance' => 0,
    'isSeller' => 0,
    'is_agileprepaidcredit_installed' => 0,
    'request_B2T' => 0,
    'paycommission_url' => 0,
    'token_balance' => 0,
    'request_T2B' => 0,
    'ams_custom_selllersummarybag' => 0,
    'id_cms_seller_terms' => 0,
    'link_terms' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59020a883ca4e9_62976691',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59020a883ca4e9_62976691')) {function content_59020a883ca4e9_62976691($_smarty_tpl) {?><?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account.php');?>
"><?php echo smartyTranslate(array('s'=>'My Account','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a><span class="navigation-pipe"><?php echo $_smarty_tpl->tpl_vars['navigationPipe']->value;?>
</span><?php echo smartyTranslate(array('s'=>'My Seller Account','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<div id="agile">
<h1><?php echo smartyTranslate(array('s'=>'My Seller Account','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</h1>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/seller_tabs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
/modules/agilemultipleseller/js/sellersummary.js"></script>

<script type="text/javascript">
	var membership_module_integrated = <?php echo $_smarty_tpl->tpl_vars['membership_module_integrated']->value;?>
;
    var msg = "<?php echo smartyTranslate(array('s'=>'You must agree on Seller Terms & Conditions','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
";
	var mymembership_url = "<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemembership','mymembership',array('content_only'=>1),true);?>
";

	$('document').ready(function() {		 $("a#seller_terms").fancybox({
	            'type' : 'iframe',
	            'width':600,
	            'height':600
	        });	
	});

</script>


<?php if (isset($_smarty_tpl->tpl_vars['seller_exists']->value)&&$_smarty_tpl->tpl_vars['seller_exists']->value) {?>
	<div class="panel">
		<h3><?php echo smartyTranslate(array('s'=>'Your account summary','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</h3>
		<form action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellersummary',array(),true);?>
" method="post" class="form-horizontal std" id="frmConvertingPayment">
			<div class="form-group">
				<label for="seller_status" class="control-label agile-col-xs-7 agile-col-sm-6 agile-col-md-3 agile-col-lg-2 agile-col-xl-2">
					<span><?php echo smartyTranslate(array('s'=>'Seller Account Status','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
				</label>
				<div class="agile-col-xs-4 agile-col-sm-6 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<span id="seller_status"><?php if ($_smarty_tpl->tpl_vars['seller']->value->active) {?><img src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
img/admin/enabled.gif" />&nbsp;&nbsp;<?php echo smartyTranslate(array('s'=>'Active','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
<?php } else { ?><img src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
img/admin/disabled.gif" />&nbsp;<?php echo smartyTranslate(array('s'=>'Inactive','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
<?php }?></span>
				</div>
			</div>
			<div class="form-group">
				<label for="products_stat" class="control-label agile-col-xs-7 agile-col-sm-6 agile-col-md-3 agile-col-lg-2 agile-col-xl-2">
					<span><?php echo smartyTranslate(array('s'=>'Products Listed','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
				</label>
				<div class="agile-col-xs-4 agile-col-sm-6 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<span id="products_stat"><?php echo $_smarty_tpl->tpl_vars['num_products']->value;?>
</span>
				</div>
			</div>
			<div class="form-group">
				<label for="orders_stat" class="control-label agile-col-xs-7 agile-col-sm-6 agile-col-md-3 agile-col-lg-2 agile-col-xl-2">
					<span><?php echo smartyTranslate(array('s'=>'Orders Received','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
				</label>
				<div class="agile-col-xs-4 agile-col-sm-6 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<span id="orders_stat"><?php echo $_smarty_tpl->tpl_vars['num_orders']->value;?>
</span>
				</div>
			</div>
			<div class="form-group">
				<label for="sales_stat" class="control-label agile-col-xs-7 agile-col-sm-6 agile-col-md-3 agile-col-lg-2 agile-col-xl-2">
					<span><?php echo smartyTranslate(array('s'=>'Total Amount Sold','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
				</label>
				<div class="agile-col-xs-4 agile-col-sm-6 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<table cellpadding="0" cellspacing="0">
			        <?php  $_smarty_tpl->tpl_vars['total'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['total']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['totals_sold']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['total']->key => $_smarty_tpl->tpl_vars['total']->value) {
$_smarty_tpl->tpl_vars['total']->_loop = true;
?>
					<tr><td align="right">
						<span id="sales_stat"><?php echo $_smarty_tpl->tpl_vars['total']->value['currency']->sign;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['total']->value['amount'];?>
</span>
					</td><td>
						<span>&nbsp;<?php echo smartyTranslate(array('s'=>'Sale received in ','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->tpl_vars['total']->value['currency']->name;?>
</span>
					</td></tr>
					<?php } ?>
					</table>
				</div>
			</div>

			<?php if ($_smarty_tpl->tpl_vars['is_seller_commission_installed']->value) {?>
				<div class="form-group">
					<label for="acct_baance"  class="control-label agile-col-xs-7 agile-col-sm-6 agile-col-md-3 agile-col-lg-2 agile-col-xl-2">
						<span><?php echo smartyTranslate(array('s'=>'Account Balance','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
					</label>
					<div class="agile-col-xs-4 agile-col-sm-6 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
						<span id="acct_baance"><?php echo $_smarty_tpl->tpl_vars['comcurrency']->value->sign;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['account_balance']->value;?>
</span>&nbsp;&nbsp;
						<?php if (isset($_smarty_tpl->tpl_vars['isSeller']->value)&&$_smarty_tpl->tpl_vars['isSeller']->value) {?>			
							<?php if ($_smarty_tpl->tpl_vars['account_balance']->value>0) {?>
								<?php if ($_smarty_tpl->tpl_vars['is_agileprepaidcredit_installed']->value) {?>
								<a id="show_messagebox" onclick="validate_message('B2T','<?php echo $_smarty_tpl->tpl_vars['request_B2T']->value;?>
')" class="button" href="#confirm_submit"><?php echo $_smarty_tpl->tpl_vars['request_B2T']->value;?>
</a>
								
								<input type="text" name="amount_to_convert" id="amount_to_convert" size="5" value="">
								<?php }?>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['account_balance']->value<0) {?>
								<span><?php echo smartyTranslate(array('s'=>'You owe store this amount.','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
&nbsp;</span>
								<span><a href="<?php echo $_smarty_tpl->tpl_vars['paycommission_url']->value;?>
"><?php echo smartyTranslate(array('s'=>'pay account balance now','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
&nbsp;<img src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
modules/agilesellercommission/img/pay.png"></a></span>
							<?php }?>
						<?php }?>
					</div>
				</div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['is_agileprepaidcredit_installed']->value) {?>
				<div class="form-group">
					<label for="tkn_baance"  class="control-label agile-col-xs-7 agile-col-sm-6 agile-col-md-3 agile-col-lg-2 agile-col-xl-2">
						<span><?php echo smartyTranslate(array('s'=>'Token Balance','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
					</label>
					<div class="agile-col-xs-4 agile-col-sm-6 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
						<span id="tkn_baance"><?php echo $_smarty_tpl->tpl_vars['token_balance']->value;?>
</span>&nbsp;&nbsp;
						<?php if (isset($_smarty_tpl->tpl_vars['isSeller']->value)&&$_smarty_tpl->tpl_vars['isSeller']->value) {?>			
							<?php if ($_smarty_tpl->tpl_vars['token_balance']->value>0) {?>
								<?php if ($_smarty_tpl->tpl_vars['is_seller_commission_installed']->value) {?>
								<a id="show_messagebox" onclick="validate_message('T2B','<?php echo $_smarty_tpl->tpl_vars['request_T2B']->value;?>
')" class="button" href="#confirm_submit"><?php echo $_smarty_tpl->tpl_vars['request_T2B']->value;?>
</a>
								<input type="text" name="tokens_to_convert" id="tokens_to_convert" size="5" value="">
								<?php }?>
							<?php }?>
						<?php }?>
						<div style="display:none">
							<input type="hidden" name="submitRequest" id="submitRequest" value="">
							<div id="confirm_submit">
								<span id="msg_comfirm"><img width="20" height="20" src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
modules/agilemultipleseller/images/icon-info.png">&nbsp;<?php echo smartyTranslate(array('s'=>'Are you sure want to perform ','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
<span id="msg_request_1">??2</span></span>
								<span id="msg_error"><img width="20" height="20" src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
modules/agilemultipleseller/images/icon-error.png">&nbsp;<?php echo smartyTranslate(array('s'=>'Please enter correct amount for ','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
<span id="msg_request_2">??1</span></span>
								<br><br><br>
								<center>
									<input type="button" class="button" name="btnYes" id="btnYes" onclick="fb_yesclick()" value="<?php echo smartyTranslate(array('s'=>'Yes','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
">&nbsp;
									<input type="button" class="button" name="btnNo" id="btnNo"  onclick="fb_noclick()" value="  <?php echo smartyTranslate(array('s'=>'No','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
 ">
									<input type="button" class="button" name="btnOK" id="btnOK" onclick="fb_okclick()" value="<?php echo smartyTranslate(array('s'=>'OK','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
">&nbsp;
								</center>
							</div>
						</div>
					</div>
				</div>
			<?php }?>

		</form>
		<?php if (isset($_smarty_tpl->tpl_vars['ams_custom_selllersummarybag']->value)&&$_smarty_tpl->tpl_vars['ams_custom_selllersummarybag']->value==1) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_custom']->value)."./selllersummarybag/sellersummarybag.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }?>
	</div>
<?php } else { ?>
	<form action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellersummary',array(),true);?>
" method="post" class="form-horizontal std" id="frmSellerSummary">
	<p>
		<?php echo smartyTranslate(array('s'=>'You do not yet have a seller account.','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

		<?php echo smartyTranslate(array('s'=>'Once you register for a seller account, you will be able to list your products in this store upon approval.','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

	</p>
	<br />
	<p>
		<?php echo smartyTranslate(array('s'=>'Do you want create a seller account now so that you can list your products for sale?','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

	</p>

	<?php if (isset($_smarty_tpl->tpl_vars['id_cms_seller_terms']->value)&&$_smarty_tpl->tpl_vars['id_cms_seller_terms']->value>0) {?>
		<div class="checkbox">
			<input type="checkbox" name="iagree" id="iagree"><?php echo smartyTranslate(array('s'=>'Yes, I have read and I agree on the Seller Terms & conditions, Please create a seller account for me','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

		</div>
		<br />
		<p class="clearfix">
				<span class="agile-term">
					<a href="<?php echo $_smarty_tpl->tpl_vars['link_terms']->value;?>
" id="seller_terms" name="seller_terms" class="iframe"><?php echo smartyTranslate(array('s'=>'Seller Terms & conditions(read)','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</a>
				</span>
		</p>
	<?php }?>
	<center>
		<input type="hidden" name="submitSellerAccount" id="submitSellerAccount" value="1">
		<input type="button" class="button" onclick="check_terms(<?php echo $_smarty_tpl->tpl_vars['id_cms_seller_terms']->value;?>
)" name="submitSellerAccount" value="<?php echo smartyTranslate(array('s'=>'Yes, Sign me up','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
" />
	</center>
	<br><br>
	</form>
<?php }?>


<fieldset id="fsMymembershipInfo" style="display:none;">
	<br><br>
	<div id="divMymembershipInfo"></div>
</fieldset>
</div>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/seller_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }} ?>
