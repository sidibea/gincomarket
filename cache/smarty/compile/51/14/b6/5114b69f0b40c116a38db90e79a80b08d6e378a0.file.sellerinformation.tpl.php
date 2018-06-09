<?php /* Smarty version Smarty-3.1.19, created on 2018-06-08 00:16:49
         compiled from "/home/abdouhanne/www/modules/agilemultipleseller/views/templates/front/sellerinformation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13785602615b19caf153d367-70504758%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5114b69f0b40c116a38db90e79a80b08d6e378a0' => 
    array (
      0 => '/home/abdouhanne/www/modules/agilemultipleseller/views/templates/front/sellerinformation.tpl',
      1 => 1495227186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13785602615b19caf153d367-70504758',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'create_seller_checked' => 0,
    'display_fields' => 0,
    'id_language' => 0,
    'languages' => 0,
    'sellerinfo' => 0,
    'countries' => 0,
    'country' => 0,
    'addtional_fields_html' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b19caf1ae2804_63979028',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b19caf1ae2804_63979028')) {function content_5b19caf1ae2804_63979028($_smarty_tpl) {?><script type="text/javascript">
  function validate_isNotNullorEmpty(s)
  {
  return s?true:false;
  }

</script>

<?php if (isset($_smarty_tpl->tpl_vars['create_seller_checked']->value)) {?>
	<div class="required form-group">
		<label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="guest_email">
      <span>
        <?php echo smartyTranslate(array('s'=>'Email address','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
 <sup>*</sup></span>
		</label>
    <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <div class="row">
        <div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <input type="text" class="is_required validate" data-validate="isEmail" id="guest_email" name="guest_email" value="<?php if (isset($_POST['guest_email'])) {?><?php echo $_POST['guest_email'];?>
<?php }?>" />
        </div>
      </div>
    </div>
	</div>
	<div class="required form-group">
		<label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="firstname">
      <?php echo smartyTranslate(array('s'=>'First name','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
 <sup>*</sup>
		</label>
    <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <div class="row">
        <div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <input type="text" class="is_required validate" data-validate="isName" id="firstname" name="firstname" onblur="$('#customer_firstname').val($(this).val());" value="<?php if (isset($_POST['firstname'])) {?><?php echo $_POST['firstname'];?>
<?php }?>" />
          <input type="hidden" id="customer_firstname" name="customer_firstname" value="<?php if (isset($_POST['firstname'])) {?><?php echo $_POST['firstname'];?>
<?php }?>" />
        </div>
      </div>
    </div>
	</div>
	<div class="required form-group">
		<label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="lastname">
      <?php echo smartyTranslate(array('s'=>'Last name','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
 <sup>*</sup>
		</label>
    <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <div class="row">
        <div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <input type="text" class="is_required validate" data-validate="isName" id="lastname" name="lastname" onblur="$('#customer_lastname').val($(this).val());" value="<?php if (isset($_POST['lastname'])) {?><?php echo $_POST['lastname'];?>
<?php }?>" />
          <input type="hidden" id="customer_lastname" name="customer_lastname" value="<?php if (isset($_POST['lastname'])) {?><?php echo $_POST['lastname'];?>
<?php }?>" />
        </div>
      </div>
    </div>
	</div>
<?php }?>



<?php if (in_array('company',$_smarty_tpl->tpl_vars['display_fields']->value)) {?>
<div class="form-group">
  <label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="company_<?php echo $_smarty_tpl->tpl_vars['id_language']->value;?>
">
    <span>
      <?php echo smartyTranslate(array('s'=>'Company','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
<sup> *</sup>
    </span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/input_text_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_value'=>$_smarty_tpl->tpl_vars['sellerinfo']->value->company,'input_name'=>'company'), 0);?>

  </div>
</div>
<?php }?>

<?php if (in_array('address1',$_smarty_tpl->tpl_vars['display_fields']->value)) {?>
<div class="form-group">
  <label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="address1_<?php echo $_smarty_tpl->tpl_vars['id_language']->value;?>
">
    <span>
      <?php echo smartyTranslate(array('s'=>'Address1','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

    </span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/input_text_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_value'=>$_smarty_tpl->tpl_vars['sellerinfo']->value->address1,'input_name'=>'address1'), 0);?>

  </div>
</div>
<?php }?>
<?php if (in_array('address2',$_smarty_tpl->tpl_vars['display_fields']->value)) {?>
<div class="form-group">
  <label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="address2_<?php echo $_smarty_tpl->tpl_vars['id_language']->value;?>
">
    <span>
      <?php echo smartyTranslate(array('s'=>'Address2','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

    </span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/input_text_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_value'=>$_smarty_tpl->tpl_vars['sellerinfo']->value->address2,'input_name'=>'address2'), 0);?>

  </div>
</div>
<?php }?>
<?php if (in_array('city',$_smarty_tpl->tpl_vars['display_fields']->value)) {?>
<div class="form-group">
  <label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="city_<?php echo $_smarty_tpl->tpl_vars['id_language']->value;?>
">
    <span>
      <?php echo smartyTranslate(array('s'=>'City','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

    </span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/input_text_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_value'=>$_smarty_tpl->tpl_vars['sellerinfo']->value->city,'input_name'=>'city'), 0);?>

  </div>
</div>
<?php }?>
<?php if (in_array('postcode',$_smarty_tpl->tpl_vars['display_fields']->value)) {?>
<div class="form-group">
  <label for="postcode" class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="postcode">
    <span><?php echo smartyTranslate(array('s'=>'Zip/Postal Code','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    <div class="row agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <input name="postcode" id="postcode" value="<?php if (isset($_POST['postcode'])) {?><?php echo $_POST['postcode'];?>
<?php } else { ?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['sellerinfo']->value->postcode, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>" type="text" />
    </div>
  </div>
</div>
<?php }?>
<?php if (in_array('id_country',$_smarty_tpl->tpl_vars['display_fields']->value)) {?>
<div class="form-group">
  <label for="id_country" class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="id_country">
    <span><?php echo smartyTranslate(array('s'=>'Country','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    <div class="row agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <select name="id_country" id="id_country" class="agile-item-padding">
        <?php  $_smarty_tpl->tpl_vars['country'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['country']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['countries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['country']->key => $_smarty_tpl->tpl_vars['country']->value) {
$_smarty_tpl->tpl_vars['country']->_loop = true;
?>
		<option value="<?php echo $_smarty_tpl->tpl_vars['country']->value['id_country'];?>
" <?php if (isset($_POST['id_country'])) {?><?php if ($_POST['id_country']==$_smarty_tpl->tpl_vars['country']->value['id_country']) {?>selected="selected"<?php }?><?php } else { ?><?php if ($_smarty_tpl->tpl_vars['sellerinfo']->value->id_country==$_smarty_tpl->tpl_vars['country']->value['id_country']) {?>selected="selected"<?php }?><?php }?>><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['country']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</option>
        <?php } ?>
      </select>
    </div>
  </div>
</div>
<?php }?>
<?php if (in_array("id_state",$_smarty_tpl->tpl_vars['display_fields']->value)) {?>
<div class="form-group id_state">
  <label for="id_state" class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
    <span><?php echo smartyTranslate(array('s'=>'State','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    <div class="row agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <select name="id_state" id="id_state" class="agile-item-padding">
      </select>
    </div>
  </div>
</div>
<?php }?>
<?php if (in_array('phone',$_smarty_tpl->tpl_vars['display_fields']->value)) {?>
<div class="form-group">
  <label for="phone" class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="phone">
    <span><?php echo smartyTranslate(array('s'=>'Phone','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    <div class="row agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <input name="phone" id="phone" value="<?php if (isset($_POST['phone'])) {?><?php echo $_POST['phone'];?>
<?php } else { ?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['sellerinfo']->value->phone, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>" type="text" class="agile-item-padding" />
		</div>
  </div>
</div>
<?php }?>
<table id="sellerinformation" name="sellerinformation" cellpadding="15" style="display: none;width: 80%;border:dotted 0px gray;"align="center">
  <?php echo $_smarty_tpl->tpl_vars['addtional_fields_html']->value;?>

  <input type="hidden" name="signin" id="signin" value="1"/>
</table>

<script type="text/javascript">
  hideOtherLanguage(<?php echo $_smarty_tpl->tpl_vars['id_language']->value;?>
);
</script>
<?php }} ?>
