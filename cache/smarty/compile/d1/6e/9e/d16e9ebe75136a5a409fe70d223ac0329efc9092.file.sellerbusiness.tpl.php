<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 15:13:17
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/sellerbusiness.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27125441659020a8d2b92b6-96296438%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd16e9ebe75136a5a409fe70d223ac0329efc9092' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/sellerbusiness.tpl',
      1 => 1493122817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27125441659020a8d2b92b6-96296438',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'link' => 0,
    'navigationPipe' => 0,
    'isoTinyMCE' => 0,
    'ad' => 0,
    'sellerinfo' => 0,
    'countries' => 0,
    'base_dir' => 0,
    'seller_exists' => 0,
    'token' => 0,
    'is_multiple_shop_installed' => 0,
    'sellertypes' => 0,
    'sellertype' => 0,
    'current_id_lang' => 0,
    'languages' => 0,
    'seller_shop' => 0,
    'seller_shopurl' => 0,
    'countries_list' => 0,
    'language' => 0,
    'language2' => 0,
    'i' => 0,
    'conf' => 0,
    'field_name' => 0,
    'custom_labels' => 0,
    'select_address' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59020a8d44a433_37241553',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59020a8d44a433_37241553')) {function content_59020a8d44a433_37241553($_smarty_tpl) {?><?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account.php');?>
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
<div class="panel">
<h1><?php echo smartyTranslate(array('s'=>'My Seller Account','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</h1>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <script type="text/javascript">	
        var iso = "<?php echo $_smarty_tpl->tpl_vars['isoTinyMCE']->value;?>
";
        var pathCSS = '<?php echo @constant('_THEME_CSS_DIR_');?>
';
        var ad = "<?php echo $_smarty_tpl->tpl_vars['ad']->value;?>
";

		var is_multilang = 1;
        </script>
		<script type="text/javascript">
			$(document).ready(function() {
				tinySetup(
				{
					selector: ".rte" ,
					toolbar1 : "code,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,|,blockquote,colorpicker,pasteword,|,bullist,numlist,|,outdent,indent,|,link,unlink,|,cleanup"
				});

				$('.datepicker').datepicker({
					prevText: '',
					nextText: '',
					dateFormat: 'yy-mm-dd',
				});

				$(".datepicker").on("blur", function(e) { $(this).datepicker("hide"); }); 
			});

		</script>
        		
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/seller_tabs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


    <script type="text/javascript">
    idSelectedCountry = <?php if (isset($_POST['id_state'])) {?><?php echo intval($_POST['id_state']);?>
<?php } else { ?><?php if (isset($_smarty_tpl->tpl_vars['sellerinfo']->value->id_state)) {?><?php echo intval($_smarty_tpl->tpl_vars['sellerinfo']->value->id_state);?>
<?php } else { ?>false<?php }?><?php }?>;
	<?php if (isset($_smarty_tpl->tpl_vars['countries']->value)) {?>
		<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('agileCountries'=>$_smarty_tpl->tpl_vars['countries']->value),$_smarty_tpl);?>

	<?php }?>

    </script>

	<script language="javascript" type="text/javascript">
		function changeMyLanguage(field, fieldsString, id_language_new, iso_code)
		{
			changeLanguage(field, fieldsString, id_language_new, iso_code);
			$("img[id^='language_current_']").attr("src","<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
img/l/" + id_language_new + ".jpg");
		}
	</script>


<?php if (isset($_smarty_tpl->tpl_vars['seller_exists']->value)&&$_smarty_tpl->tpl_vars['seller_exists']->value) {?>
    <form action="<?php echo $_smarty_tpl->tpl_vars['link']->value->getModuleLink('agilemultipleseller','sellerbusiness',array(),true);?>
" enctype="multipart/form-data" method="post" class="form-horizontal std">
        <h3><?php echo smartyTranslate(array('s'=>'Your business information','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</h3>
        <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
	<?php if ($_smarty_tpl->tpl_vars['is_multiple_shop_installed']->value) {?>
		<div class="form-group">
		        <label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="id_sellertype1">
					<span><?php echo smartyTranslate(array('s'=>'Primary Type','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
				</label>
				<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<div class="row agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
						<select name="id_sellertype1" id="id_sellertype1">
							<?php  $_smarty_tpl->tpl_vars['sellertype'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sellertype']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sellertypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sellertype']->key => $_smarty_tpl->tpl_vars['sellertype']->value) {
$_smarty_tpl->tpl_vars['sellertype']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['sellertype']->value['id_sellertype'];?>
" <?php if ($_smarty_tpl->tpl_vars['sellerinfo']->value->id_sellertype1==$_smarty_tpl->tpl_vars['sellertype']->value['id_sellertype']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['sellertype']->value['name'];?>
</option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
		<div class="form-group">
	            <label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="id_sellertype2">
					<span><?php echo smartyTranslate(array('s'=>'Secondary Type','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
				</label>
				<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<div class="row agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
						<select name="id_sellertype2" id="id_sellertype2">
							<?php  $_smarty_tpl->tpl_vars['sellertype'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sellertype']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sellertypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sellertype']->key => $_smarty_tpl->tpl_vars['sellertype']->value) {
$_smarty_tpl->tpl_vars['sellertype']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['sellertype']->value['id_sellertype'];?>
" <?php if ($_smarty_tpl->tpl_vars['sellerinfo']->value->id_sellertype2==$_smarty_tpl->tpl_vars['sellertype']->value['id_sellertype']) {?>selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['sellertype']->value['name'];?>
</option>
							<?php } ?>
						</select>
					</div>
				</div>
		</div>
	<?php }?>
	<div class="form-group">
		<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required" for="company_<?php echo $_smarty_tpl->tpl_vars['current_id_lang']->value;?>
">
			<span>
				<?php echo smartyTranslate(array('s'=>'Company','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

			</span>
		</label>
		<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/input_text_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_value'=>$_smarty_tpl->tpl_vars['sellerinfo']->value->company,'input_name'=>'company'), 0);?>

		</div>
	</div>

	<?php if ($_smarty_tpl->tpl_vars['is_multiple_shop_installed']->value) {?>

		<div class="form-group">
			<label for="shop_name" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				<span><?php echo smartyTranslate(array('s'=>'Shop Name','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
			</label>
			<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
						<input type="text" id="shop_name" name="shop_name" class="form-control" value="<?php if (isset($_POST['shop_name'])) {?><?php echo $_POST['shop_name'];?>
<?php } else { ?><?php if (isset($_smarty_tpl->tpl_vars['seller_shop']->value->name)) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['seller_shop']->value->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?><?php }?>" class="form-control" />
					</div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="shop_url" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				<span><?php echo smartyTranslate(array('s'=>'Shop full Url','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
			</label>
			<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
						<input type="text" id="shop_url" name="shop_url" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['seller_shopurl']->value->getURL();?>
" disabled=true class="form-control" />
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="virtual_uri" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				<span><?php echo smartyTranslate(array('s'=>'Virtual Uri','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
			</label>
			<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
						<input type="text" id="virtual_uri" name="virtual_uri"  class="form-control" value="<?php if (isset($_POST['virtual_uri'])) {?><?php echo $_POST['virtual_uri'];?>
<?php } else { ?><?php if (isset($_smarty_tpl->tpl_vars['seller_shopurl']->value)) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['seller_shopurl']->value->virtual_uri, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?><?php }?>" class="form-control" />
					</div>
				</div>
			</div>
		</div>

		

	<?php }?>

	<div class="form-group">
		<label for="seller_logo" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<span><?php echo smartyTranslate(array('s'=>'Show Logo','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
		</label>
		
		<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<img src="<?php echo $_smarty_tpl->tpl_vars['sellerinfo']->value->get_seller_logo_url();?>
" alt="<?php echo smartyTranslate(array('s'=>'Your Logo','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
" class=:agile-col-xs-8 agile-col-sm-8 agile-col-md-8 agile-col-lg-8" title="<?php echo smartyTranslate(array('s'=>'Your Logo','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
" id="seller_logo" name="seller_logo" />
				</div>
			</div>
		</div>
	</div>

	<div class="form-group">
      <label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 file_upload_label">
        <span class="label-tooltip" data-toggle="tooltip"
          title="<?php echo smartyTranslate(array('s'=>'Format:','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
 JPG, GIF, PNG.">
          <?php echo smartyTranslate(array('s'=>'Add a logo image','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

        </span>
      </label>
      <div class="agile-col-sm-9 agile-col-md-8 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-12 agile-col-md-12 agile-col-lg-9 agile-col-xl-9">
					<input type="file" name="logo" id="logo" class="form-control" />
				</div>
			</div>
      </div>
    </div>

	<div class="form-group">
		<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required" for="address1_<?php echo $_smarty_tpl->tpl_vars['current_id_lang']->value;?>
">
			<span>
				<?php echo smartyTranslate(array('s'=>'Address','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

			</span>
		</label>
		<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/input_text_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_value'=>$_smarty_tpl->tpl_vars['sellerinfo']->value->address1,'input_name'=>'address1'), 0);?>

		</div>
	</div>

	<div class="form-group">
		<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="address2_<?php echo $_smarty_tpl->tpl_vars['current_id_lang']->value;?>
">
			<span>
				<?php echo smartyTranslate(array('s'=>'Address (Line 2)','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

			</span>
		</label>
		<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/input_text_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_value'=>$_smarty_tpl->tpl_vars['sellerinfo']->value->address2,'input_name'=>'address2'), 0);?>

		</div>
	</div>

	<div class="form-group">
		<label for="postcode" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required">
			<span><?php echo smartyTranslate(array('s'=>'Postal Code','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
		</label>
		<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-5 agile-col-md-4 agile-col-lg-3">
					<input type="text" id="postcode" name="postcode" class="form-control" value="<?php if (isset($_POST['postcode'])) {?><?php echo $_POST['postcode'];?>
<?php } else { ?><?php if (isset($_smarty_tpl->tpl_vars['sellerinfo']->value->postcode)) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['sellerinfo']->value->postcode, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?><?php }?>" onkeyup="$('#postcode').val($('#postcode').val().toUpperCase());" class="form-control" />
				</div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required" for="city_<?php echo $_smarty_tpl->tpl_vars['current_id_lang']->value;?>
">
			<span>
				<?php echo smartyTranslate(array('s'=>'City','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

			</span>
		</label>
		<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/input_text_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_value'=>$_smarty_tpl->tpl_vars['sellerinfo']->value->city,'input_name'=>'city'), 0);?>

		</div>
	</div>

	<div class="form-group">
		<label for="id_country" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required">
			<span><?php echo smartyTranslate(array('s'=>'Country','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
		</label>
		<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<select id="id_country" name="id_country"><?php echo $_smarty_tpl->tpl_vars['countries_list']->value;?>
</select>
				</div>
			</div>
		</div>
	</div>

	<div class="form-group id_state">
		<label for="id_state" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required">
			<span><?php echo smartyTranslate(array('s'=>'State','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
		</label>
		<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<select name="id_state" id="id_state">
					</select>
				</div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="phone" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<span><?php echo smartyTranslate(array('s'=>'Phone','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
		</label>
		<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<input type="text" id="phone" name="phone" class="form-control" value="<?php if (isset($_POST['phone'])) {?><?php echo $_POST['phone'];?>
<?php } else { ?><?php if (isset($_smarty_tpl->tpl_vars['sellerinfo']->value->phone)) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['sellerinfo']->value->phone, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?><?php }?>" class="form-control" />
				</div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="fax" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<span><?php echo smartyTranslate(array('s'=>'Fax','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
		</label>
		<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<input type="text" id="fax" name="fax" class="form-control" value="<?php if (isset($_POST['fax'])) {?><?php echo $_POST['fax'];?>
<?php } else { ?><?php if (isset($_smarty_tpl->tpl_vars['sellerinfo']->value->fax)) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['sellerinfo']->value->fax, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?><?php }?>" class="form-control" />
				</div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="dni" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<span><?php echo smartyTranslate(array('s'=>'Identification','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
		</label>
		<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<input type="text" id="dni" name="dni" class="form-control" value="<?php if (isset($_POST['dni'])) {?><?php echo $_POST['dni'];?>
<?php } else { ?><?php if (isset($_smarty_tpl->tpl_vars['sellerinfo']->value->dni)) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['sellerinfo']->value->dni, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?><?php }?>" class="form-control" />
				</div>
			</div>
		</div>
	</div>

  
  <div class="form-group">
    <label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="description_<?php echo $_smarty_tpl->tpl_vars['current_id_lang']->value;?>
">
      <span>
        <?php echo smartyTranslate(array('s'=>'Description','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
	<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
		<?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>
			<div style="display: <?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang']==$_smarty_tpl->tpl_vars['current_id_lang']->value ? 'block' : 'none';?>
;" class="translatable-field lang-<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
 row">
				<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<textarea class="rte" id="description_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" aria-hidden="true" name="description_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" cols="26" rows="13"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
<?php $_tmp1=ob_get_clean();?><?php if (isset($_POST['description'][$_tmp1])) {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
<?php $_tmp2=ob_get_clean();?><?php echo $_POST['description'][$_tmp2];?>
<?php } else { ?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
<?php $_tmp3=ob_get_clean();?><?php if (isset($_smarty_tpl->tpl_vars['sellerinfo']->value->description[$_tmp3])) {?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
<?php $_tmp4=ob_get_clean();?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['sellerinfo']->value->description[$_tmp4], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?><?php }?></textarea>
				</div>
				<div class="agile-col-lg-2">
					<button type="button" class="agile-btn agile-btn-default agile-dropdown-toggle" tabindex="-1" data-toggle="agile-dropdown">
						<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['language']->value['iso_code'];?>
<?php $_tmp5=ob_get_clean();?><?php echo $_tmp5;?>

						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<?php  $_smarty_tpl->tpl_vars['language2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language2']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language2']->key => $_smarty_tpl->tpl_vars['language2']->value) {
$_smarty_tpl->tpl_vars['language2']->_loop = true;
?>
							<li>
								<a href="javascript:hideOtherLanguage(<?php echo $_smarty_tpl->tpl_vars['language2']->value['id_lang'];?>
);" tabindex="-1"><?php echo $_smarty_tpl->tpl_vars['language2']->value['name'];?>
</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		<?php } ?>
	</div>
  </div>

	<div class="form-group">
		<label for="longitude" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<span><?php echo smartyTranslate(array('s'=>'Longitude','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
		</label>
		<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-5 agile-col-md-4 agile-col-lg-3 agile-col-xl-2">
					<input type="text" id="longitude" name="longitude" class="form-control" value="<?php if (isset($_POST['longitude'])) {?><?php echo $_POST['longitude'];?>
<?php } else { ?><?php if (isset($_smarty_tpl->tpl_vars['sellerinfo']->value->longitude)) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['sellerinfo']->value->longitude, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?><?php }?>" />
				</div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="latitude" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<span><?php echo smartyTranslate(array('s'=>'Latitude','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
		</label>
		<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-5 agile-col-md-4 agile-col-lg-3 agile-col-xl-2">
					<input type="text" id="latitude" name="latitude" class="form-control" value="<?php if (isset($_POST['latitude'])) {?><?php echo $_POST['latitude'];?>
<?php } else { ?><?php if (isset($_smarty_tpl->tpl_vars['sellerinfo']->value->latitude)) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['sellerinfo']->value->latitude, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?><?php }?>" />
				</div>
			</div>
		</div>
	</div>

	<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 10+1 - (1) : 1-(10)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
		<?php if ($_smarty_tpl->tpl_vars['conf']->value[sprintf("AGILE_MS_SELLER_TEXT%s",$_smarty_tpl->tpl_vars['i']->value)]) {?>
			<?php $_smarty_tpl->tpl_vars['field_name'] = new Smarty_variable(sprintf("ams_custom_text%s",$_smarty_tpl->tpl_vars['i']->value), null, 0);?>
			<div class="form-group">
				<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['current_id_lang']->value;?>
">
					<span>
						<?php echo $_smarty_tpl->tpl_vars['custom_labels']->value[$_smarty_tpl->tpl_vars['field_name']->value];?>

					</span>
				</label>
				<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
<?php $_tmp6=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/input_text_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_value'=>$_smarty_tpl->tpl_vars['sellerinfo']->value->{$_smarty_tpl->tpl_vars['field_name']->value},'input_name'=>$_tmp6), 0);?>

				</div>
			</div>
		<?php }?>
	<?php }} ?>  

	<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 2+1 - (1) : 1-(2)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
		<?php if ($_smarty_tpl->tpl_vars['conf']->value[sprintf("AGILE_MS_SELLER_HTML%s",$_smarty_tpl->tpl_vars['i']->value)]) {?>
			<?php $_smarty_tpl->tpl_vars['field_name'] = new Smarty_variable(sprintf("ams_custom_html%s",$_smarty_tpl->tpl_vars['i']->value), null, 0);?>
			<div class="form-group">
				<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['current_id_lang']->value;?>
">
					  <span>
							<?php echo $_smarty_tpl->tpl_vars['custom_labels']->value[$_smarty_tpl->tpl_vars['field_name']->value];?>

					  </span>
				</label>
				<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
<?php $_tmp7=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/textarea_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_name'=>$_tmp7,'input_value'=>$_smarty_tpl->tpl_vars['sellerinfo']->value->{$_smarty_tpl->tpl_vars['field_name']->value},'class'=>"rte",'max'=>400), 0);?>

					</div>
				</div>
		<?php }?>
	<?php }} ?>  
	<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 10+1 - (1) : 1-(10)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
		<?php if ($_smarty_tpl->tpl_vars['conf']->value[sprintf("AGILE_MS_SELLER_NUMBER%s",$_smarty_tpl->tpl_vars['i']->value)]) {?>
			<?php $_smarty_tpl->tpl_vars['field_name'] = new Smarty_variable(sprintf("ams_custom_number%s",$_smarty_tpl->tpl_vars['i']->value), null, 0);?>
			<div class="form-group">
				<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
">
					<span>
						<?php echo $_smarty_tpl->tpl_vars['custom_labels']->value[$_smarty_tpl->tpl_vars['field_name']->value];?>

					</span>
				</label>
				<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<div class="row">
						<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
							<input type="text" id="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" 
								value="<?php if (isset($_POST[$_smarty_tpl->tpl_vars['field_name']->value])) {?><?php echo $_POST[$_smarty_tpl->tpl_vars['field_name']->value];?>
<?php } else { ?><?php if (isset($_smarty_tpl->tpl_vars['sellerinfo']->value->{$_smarty_tpl->tpl_vars['field_name']->value})) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['sellerinfo']->value->{$_smarty_tpl->tpl_vars['field_name']->value}, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?><?php }?>" />
						</div>
					</div>
				</div>
			</div>
		<?php }?>
    <?php }} ?>  
	<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 5+1 - (1) : 1-(5)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
		<?php if ($_smarty_tpl->tpl_vars['conf']->value[sprintf("AGILE_MS_SELLER_DATE%s",$_smarty_tpl->tpl_vars['i']->value)]) {?>
			<?php $_smarty_tpl->tpl_vars['field_name'] = new Smarty_variable(sprintf("ams_custom_date%s",$_smarty_tpl->tpl_vars['i']->value), null, 0);?>
			<div class="form-group">
				<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
">
					<span>
						<?php echo $_smarty_tpl->tpl_vars['custom_labels']->value[$_smarty_tpl->tpl_vars['field_name']->value];?>

					</span>
				</label>
				<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<div class="row">
						<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
							<input type="text" id="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['field_name']->value;?>
" class="datepicker"
								value="<?php if (isset($_POST[$_smarty_tpl->tpl_vars['field_name']->value])) {?><?php echo $_POST[$_smarty_tpl->tpl_vars['field_name']->value];?>
<?php } else { ?><?php if (isset($_smarty_tpl->tpl_vars['sellerinfo']->value->{$_smarty_tpl->tpl_vars['field_name']->value})) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['sellerinfo']->value->{$_smarty_tpl->tpl_vars['field_name']->value}, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?><?php }?>" />
						</div>
					</div>
				</div>
			</div>
		<?php }?> 
    <?php }} ?>  

	<div class="form-group">
		<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<span><?php echo smartyTranslate(array('s'=>'Map','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
		</label>
		<div class=" agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
			<div class="row">
				<div class="agile-col-sm-12 agile-col-md-12 agile-col-lg-12 agile-col-xl-12">
					<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/googlemap.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

				</div>
			</div>
		</div>
	</div>

	<div>
		<input type="hidden" name="id_sellerinfo" value="<?php echo intval($_smarty_tpl->tpl_vars['sellerinfo']->value->id);?>
" />
		<input type="hidden" name="id_customer" value="<?php echo intval($_smarty_tpl->tpl_vars['sellerinfo']->value->id_customer);?>
" />
		<?php if (isset($_smarty_tpl->tpl_vars['select_address']->value)) {?><input type="hidden" name="select_address" value="<?php echo intval($_smarty_tpl->tpl_vars['select_address']->value);?>
" /><?php }?>
	</div>	
	<div class="form-group agile-align-center">
		<span class="label-tooltip pull-right"> <sup>*</sup> <?php echo smartyTranslate(array('s'=>'Required field','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
		<button type="submit" class="agile-btn agile-btn-default" name="submitSellerinfo" value="<?php echo smartyTranslate(array('s'=>'Save','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
">
		<i class="icon-save"></i>&nbsp;<span><?php echo smartyTranslate(array('s'=>'Save','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span></button>
	</div>
</form>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'sellerbusiness_fileDefaultHtml')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'sellerbusiness_fileDefaultHtml'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'No file selected','mod'=>'agilemultipleseller','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'sellerbusiness_fileDefaultHtml'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('addJsDefL', array('name'=>'sellerbusiness_fileButtonHtml')); $_block_repeat=true; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'sellerbusiness_fileButtonHtml'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smartyTranslate(array('s'=>'Choose File','mod'=>'agilemultipleseller','js'=>1),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo $_smarty_tpl->smarty->registered_plugins['block']['addJsDefL'][0][0]->addJsDefL(array('name'=>'sellerbusiness_fileButtonHtml'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>




<script type="text/javascript">
    hideOtherLanguage(<?php echo $_smarty_tpl->tpl_vars['current_id_lang']->value;?>
);
</script>


<?php }?>
</div> <!-- panel -->
</div> <!-- bootstrap -->
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."./templates/front/seller_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php }} ?>
