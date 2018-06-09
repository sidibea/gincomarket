<?php /* Smarty version Smarty-3.1.19, created on 2017-04-28 18:28:58
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/products/informations.tpl" */ ?>
<?php /*%%SmartyHeaderCode:224399623590389ea429f79-90053294%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0defecd0206fa73923d1756e4b9d5c0d8d46617e' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/products/informations.tpl',
      1 => 1493122817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '224399623590389ea429f79-90053294',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'isoTinyMCE' => 0,
    'theme_css_dir' => 0,
    'ad' => 0,
    'base_dir' => 0,
    'check_product_association_ajax' => 0,
    'id_language' => 0,
    'languages' => 0,
    'class_input_ajax' => 0,
    'product' => 0,
    'categories' => 0,
    'category' => 0,
    'is_agilesellerlistoptions_installed' => 0,
    'HOOK_PRODYCT_LIST_OPTIONS' => 0,
    'currency' => 0,
    'order_out_of_stock' => 0,
    'suppliers' => 0,
    'supplier' => 0,
    'manufacturers' => 0,
    'manufacturer' => 0,
    'language' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_590389ea607170_58453868',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_590389ea607170_58453868')) {function content_590389ea607170_58453868($_smarty_tpl) {?>    <script type="text/javascript">
      var iso = "<?php echo $_smarty_tpl->tpl_vars['isoTinyMCE']->value;?>
";
      var pathCSS = "<?php echo $_smarty_tpl->tpl_vars['theme_css_dir']->value;?>
";
      var ad = "<?php echo $_smarty_tpl->tpl_vars['ad']->value;?>
";
    </script>
	<script type="text/javascript">
    $(document).ready(function() {
    tinySetup(
    {
    selector: ".rte" ,
    toolbar1 : "code,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,|,blockquote,colorpicker,pasteword,|,bullist,numlist,|,outdent,indent,|,link,unlink,|,cleanup"
    });

    $("#available_for_order").click(function(){
    if ($(this).is(':checked'))
    {
    $('#show_price').attr('checked', 'checked');
    $('#show_price').attr('disabled', 'disabled');
    }
    else
    {
    $('#show_price').removeAttr('disabled');
    }
    });
    });

    function changeMyLanguage(field, fieldsString, id_language_new, iso_code)
    {
    changeLanguage(field, fieldsString, id_language_new, iso_code);
    $("img[id^='language_current_']").attr("src","<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
img/l/" + id_language_new + ".jpg");
    }
  </script>

<?php if (isset($_smarty_tpl->tpl_vars['check_product_association_ajax']->value)&&$_smarty_tpl->tpl_vars['check_product_association_ajax']->value) {?>
<?php $_smarty_tpl->tpl_vars['class_input_ajax'] = new Smarty_variable('check_product_name ', null, 0);?>
<?php } else { ?>
<?php $_smarty_tpl->tpl_vars['class_input_ajax'] = new Smarty_variable('', null, 0);?>
<?php }?>

<div id="product-informations" class="panel product-tab">
  <input type="hidden" name="submitted_tabs[]" value="Informations" />
  <h3 class="tab"><?php echo smartyTranslate(array('s'=>'Information','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</h3>
  
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required" for="name_<?php echo $_smarty_tpl->tpl_vars['id_language']->value;?>
">
      <span class="label-tooltip" data-toggle="tooltip"
				title="<?php echo smartyTranslate(array('s'=>'Invalid characters:','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
 &lt;&gt;;=#{}">
        <?php echo smartyTranslate(array('s'=>'Name:','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <?php ob_start();?><?php if (!$_smarty_tpl->tpl_vars['product']->value->id||Configuration::get('PS_FORCE_FRIENDLY_PRODUCT')) {?><?php echo "copy2friendlyUrl";?><?php }?><?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/input_text_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_class'=>((string)$_smarty_tpl->tpl_vars['class_input_ajax']->value).$_tmp1." updateCurrentText",'input_value'=>$_smarty_tpl->tpl_vars['product']->value->name,'input_name'=>'name'), 0);?>

    </div>
  </div>

  
  <div class="form-group" <?php if (empty($_smarty_tpl->tpl_vars['categories']->value)) {?> style="display:none;" <?php }?>>
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="id_category_default">
      <span>
          <?php echo smartyTranslate(array('s'=>'Category','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <select id="id_category_default" name="id_category_default">
            <?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['category']->value['id_category'];?>
" <?php if ($_smarty_tpl->tpl_vars['product']->value->id_category_default==$_smarty_tpl->tpl_vars['category']->value['id_category']) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
  </div>

  
  <div class="form-group" <?php if ($_smarty_tpl->tpl_vars['is_agilesellerlistoptions_installed']->value) {?><?php } else { ?>style="display:none;"<?php }?>>
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
      <span>
        <?php echo smartyTranslate(array('s'=>'List Options','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
 
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <?php echo $_smarty_tpl->tpl_vars['HOOK_PRODYCT_LIST_OPTIONS']->value;?>

        </div>
    </div>
  </div>

  
  
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="wholesale_price">
      <span>
        <?php echo smartyTranslate(array('s'=>'Wholesale Price','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <div class="input-group">
            <input type="text" name="wholesale_price" id="wholesale_price" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->wholesale_price;?>
" />
            <span class="input-group-addon">(<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
)</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="price">
      <span>
        <?php echo smartyTranslate(array('s'=>'Retail Price','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <div class="input-group">
            <input type="text" name="price" id="price" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->price;?>
" class="form-control"/>
            <span class="input-group-addon">(<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
)</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="quantity">
      <span>
        <?php echo smartyTranslate(array('s'=>'Quantity','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <input size="55" type="text" name="quantity" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->quantity;?>
" class="form-control" />
        </div>
      </div>
    </div>
  </div>

  
  <div class="form-group">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="out_of_stock">
        <?php echo smartyTranslate(array('s'=>'When out of stock','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </label>
      <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
        <p class="radio">
          <label for="out_of_stock_1" class="control-label">
            <input id="out_of_stock_1" type="radio" value="0" class="out_of_stock" name="out_of_stock" <?php if ($_smarty_tpl->tpl_vars['product']->value->out_of_stock==0) {?> checked <?php }?> >
            <?php echo smartyTranslate(array('s'=>'Deny orders','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

          </label>
        </p>
        <p class="radio">
          <label for="pack_product" class="control-label">
            <input id="out_of_stock_2" type="radio" value="1" class="out_of_stock" name="out_of_stock"  <?php if ($_smarty_tpl->tpl_vars['product']->value->out_of_stock==1) {?> checked <?php }?> >
                <?php echo smartyTranslate(array('s'=>'Allow orders','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
:
          </label>
        </p>
        <p class="radio">
          <label for="out_of_stock_3" class="control-label">
            <input id="out_of_stock_3" type="radio" value="2" class="out_of_stock" name="out_of_stock" <?php if ($_smarty_tpl->tpl_vars['product']->value->out_of_stock==2) {?> checked <?php }?>>
              <?php echo smartyTranslate(array('s'=>'Default','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
:
              <?php if ($_smarty_tpl->tpl_vars['order_out_of_stock']->value==1) {?>
              <?php echo smartyTranslate(array('s'=>'Allow orders','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

              <?php } else { ?>
              <?php echo smartyTranslate(array('s'=>'Deny orders','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

              <?php }?>
              <?php echo smartyTranslate(array('s'=>' as set in Preferences'),$_smarty_tpl);?>

            </label>
        </p>
          </div>
    </div>

  
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="price">
      <span>
        <?php echo smartyTranslate(array('s'=>'Additional shipping','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <div class="input-group">
            <input size="55" type="text" id="additional_shipping_cost" name="additional_shipping_cost" value="<?php echo smarty_modifier_htmlentitiesUTF8($_smarty_tpl->tpl_vars['product']->value->additional_shipping_cost);?>
" class="form-control" />
            <span class="input-group-addon">(<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
)</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="reference">
      <span class="label-tooltip" data-toggle="tooltip"
      title="<?php echo smartyTranslate(array('s'=>'Special characters allowed:'),$_smarty_tpl);?>
 .-_#\">
        <?php echo smartyTranslate(array('s'=>'Reference:','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <input size="55" type="text" id="reference" name="reference" value="<?php echo smarty_modifier_htmlentitiesUTF8($_smarty_tpl->tpl_vars['product']->value->reference);?>
" class="form-control" />
        </div>
      </div>
    </div>
  </div>

  
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="ean13">
      <span class="label-tooltip" data-toggle="tooltip"
        title="<?php echo smartyTranslate(array('s'=>'(Europe, Japan)','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
">
        <?php echo smartyTranslate(array('s'=>'EAN13 or JAN','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <input size="55" maxlength="13" type="text" id="ean13" name="ean13" value="<?php echo smarty_modifier_htmlentitiesUTF8($_smarty_tpl->tpl_vars['product']->value->ean13);?>
" class="form-control"  />
        </div>
      </div>
    </div>
    </div>

  
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="upc">
      <span class="label-tooltip" data-toggle="tooltip"
        title="<?php echo smartyTranslate(array('s'=>'(US, Canada)','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
">
        <?php echo smartyTranslate(array('s'=>'UPC','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <input size="55" maxlength="12" type="text" id="upc" name="upc" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->upc;?>
" class="form-control" />
        </div>
      </div>
    </div>
  </div>

  
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
      <?php echo smartyTranslate(array('s'=>'Status:','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

    </label>
    <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <p class="radio">
        <label for="active_on" class="control-label">
          <input type="radio" name="active" id="active_on" value="1" <?php if ($_smarty_tpl->tpl_vars['product']->value->active||!$_smarty_tpl->tpl_vars['product']->value->isAssociatedToShop()) {?>checked="checked" <?php }?> />
            <?php echo smartyTranslate(array('s'=>'Enabled','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

          </label>
      </p>
      <p class="radio">
        <label for="active_off" class="control-label">
          <input type="radio" name="active" id="active_off" value="0" <?php if (!$_smarty_tpl->tpl_vars['product']->value->active&&$_smarty_tpl->tpl_vars['product']->value->isAssociatedToShop()) {?>checked="checked"<?php }?> />
            <?php echo smartyTranslate(array('s'=>'Disabled','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

          </label>
      </p>
    </div>
  </div>

  
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="visibility">
      <?php echo smartyTranslate(array('s'=>'Visibility:','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <select name="visibility" id="visibility">
            <option value="both" <?php if ($_smarty_tpl->tpl_vars['product']->value->visibility=='both') {?>selected="selected"<?php }?> ><?php echo smartyTranslate(array('s'=>'Everywhere','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
            <option value="catalog" <?php if ($_smarty_tpl->tpl_vars['product']->value->visibility=='catalog') {?>selected="selected"<?php }?> ><?php echo smartyTranslate(array('s'=>'Catalog only','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
            <option value="search" <?php if ($_smarty_tpl->tpl_vars['product']->value->visibility=='search') {?>selected="selected"<?php }?> ><?php echo smartyTranslate(array('s'=>'Search only','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
            <option value="none" <?php if ($_smarty_tpl->tpl_vars['product']->value->visibility=='none') {?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Nowhere','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  
  <div id="product_options" class="form-group" <?php if (!$_smarty_tpl->tpl_vars['product']->value->active) {?>style="display:none"<?php }?> >
    <div class="col-lg-12">
      <div class="form-group">
        <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="available_for_order">
          <?php echo smartyTranslate(array('s'=>'Options','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

        </label>
        <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
          <div class="checkbox agile-padding-left20" >
            <input type="checkbox" name="available_for_order" id="available_for_order" value="1" class="comparator" <?php if ($_smarty_tpl->tpl_vars['product']->value->available_for_order) {?>checked<?php }?>  />
              <label for="available_for_order"><?php echo smartyTranslate(array('s'=>'available for order','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</label>
            </div>
          <div class="checkbox agile-padding-left20" >
            <input type="checkbox" name="show_price" id="show_price" value="1" class="comparator" <?php if ($_smarty_tpl->tpl_vars['product']->value->show_price) {?>checked="checked"<?php }?> <?php if ($_smarty_tpl->tpl_vars['product']->value->available_for_order) {?>disabled="disabled"<?php }?>/>
              <label for="show_price"><?php echo smartyTranslate(array('s'=>'show price','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</label>
            </div>
          <div class="checkbox agile-padding-left20" >
            <input type="checkbox" name="online_only" id="online_only" value="1" class="comparator" <?php if ($_smarty_tpl->tpl_vars['product']->value->online_only) {?>checked="checked"<?php }?> />
              <label for="online_only"><?php echo smartyTranslate(array('s'=>'online only (not sold in store)','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</label>
            </div>
        </div>
      </div>
    </div>
  </div>

    
    <div class="form-group">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="condition">
        <?php echo smartyTranslate(array('s'=>'Condition','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </label>
      <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
        <div class="row">
          <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
            <select name="condition" id="condition">
              <option value="new" <?php if ($_smarty_tpl->tpl_vars['product']->value->condition=='new') {?>selected="selected"<?php }?> ><?php echo smartyTranslate(array('s'=>'New','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
              <option value="used" <?php if ($_smarty_tpl->tpl_vars['product']->value->condition=='used') {?>selected="selected"<?php }?> ><?php echo smartyTranslate(array('s'=>'Used','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
              <option value="refurbished" <?php if ($_smarty_tpl->tpl_vars['product']->value->condition=='refurbished') {?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Refurbished','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    
    <div class="form-group">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="condition">
        <?php echo smartyTranslate(array('s'=>'Supplier','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </label>
      <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
        <div class="row">
          <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
            <select name="id_supplier" id="id_supplier">
              <option value="0"> -- </option>
              <?php  $_smarty_tpl->tpl_vars['supplier'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['supplier']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['suppliers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['supplier']->key => $_smarty_tpl->tpl_vars['supplier']->value) {
$_smarty_tpl->tpl_vars['supplier']->_loop = true;
?>
              <option value="<?php echo $_smarty_tpl->tpl_vars['supplier']->value['id_supplier'];?>
" <?php if ($_smarty_tpl->tpl_vars['product']->value->id_supplier==$_smarty_tpl->tpl_vars['supplier']->value['id_supplier']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['supplier']->value['name'];?>
</option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
    </div>

    
    <div class="form-group">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="condition">
        <?php echo smartyTranslate(array('s'=>'Manufacturer','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </label>
      <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
        <div class="row">
          <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
            <select name="id_manufacturer" id="id_manufacturer">
              <option value="0"> -- </option>
              <?php  $_smarty_tpl->tpl_vars['manufacturer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['manufacturer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['manufacturers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['manufacturer']->key => $_smarty_tpl->tpl_vars['manufacturer']->value) {
$_smarty_tpl->tpl_vars['manufacturer']->_loop = true;
?>
              <option value="<?php echo $_smarty_tpl->tpl_vars['manufacturer']->value['id_manufacturer'];?>
" <?php if ($_smarty_tpl->tpl_vars['product']->value->id_manufacturer==$_smarty_tpl->tpl_vars['manufacturer']->value['id_manufacturer']) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['manufacturer']->value['name'];?>
</option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
    </div>


<div class="form-group">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="description_short_<?php echo $_smarty_tpl->tpl_vars['id_language']->value;?>
">
        <span class="label-tooltip" data-toggle="tooltip"
          title="<?php echo smartyTranslate(array('s'=>'Appears in the product list(s), and on the top of the product page.','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
">
          <?php echo smartyTranslate(array('s'=>'Short description','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

        </span>
      </label>
    <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/textarea_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_name'=>'description_short','input_value'=>$_smarty_tpl->tpl_vars['product']->value->description_short,'default_row'=>10,'class'=>"rte",'max'=>400), 0);?>

    </div>
  </div>

  
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="description_<?php echo $_smarty_tpl->tpl_vars['id_language']->value;?>
">
      <span class="label-tooltip" data-toggle="tooltip"
        title="<?php echo smartyTranslate(array('s'=>'Appears in the body of the product page','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
">
        <?php echo smartyTranslate(array('s'=>'Description:','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
    <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/textarea_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_name'=>'description','input_value'=>$_smarty_tpl->tpl_vars['product']->value->description,'default_row'=>10,'class'=>"rte",'max'=>400), 0);?>

    </div>
  </div>

  
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="meta_keywords_<?php echo $_smarty_tpl->tpl_vars['id_language']->value;?>
">
      <span class="label-tooltip" data-toggle="tooltip"
        title="<?php echo smartyTranslate(array('s'=>'Tags separated by commas (e.g. dvd, dvd player, hifi)','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
 - <?php echo smartyTranslate(array('s'=>'Forbidden characters:','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
 !&lt;;&gt;;?=+#&quot;&deg;{}_$%">
        <?php echo smartyTranslate(array('s'=>'Meta Tags','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <?php ob_start();?><?php if (!$_smarty_tpl->tpl_vars['product']->value->id||Configuration::get('PS_FORCE_FRIENDLY_PRODUCT')) {?><?php echo "copy2friendlyUrl";?><?php }?><?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/input_text_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_class'=>((string)$_smarty_tpl->tpl_vars['class_input_ajax']->value).$_tmp2." updateCurrentText",'input_value'=>$_smarty_tpl->tpl_vars['product']->value->meta_keywords,'input_name'=>'meta_keywords'), 0);?>

    </div>
  </div>

  
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="meta_description_<?php echo $_smarty_tpl->tpl_vars['id_language']->value;?>
">
      <span>
        <?php echo smartyTranslate(array('s'=>'Meta Description','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <?php ob_start();?><?php if (!$_smarty_tpl->tpl_vars['product']->value->id||Configuration::get('PS_FORCE_FRIENDLY_PRODUCT')) {?><?php echo "copy2friendlyUrl";?><?php }?><?php $_tmp3=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/input_text_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_class'=>((string)$_smarty_tpl->tpl_vars['class_input_ajax']->value).$_tmp3." updateCurrentText",'input_value'=>$_smarty_tpl->tpl_vars['product']->value->meta_description,'input_name'=>'meta_description'), 0);?>

    </div>
  </div>

  
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="meta_title_<?php echo $_smarty_tpl->tpl_vars['id_language']->value;?>
">
      <span>
        <?php echo smartyTranslate(array('s'=>'Meta Title','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <?php ob_start();?><?php if (!$_smarty_tpl->tpl_vars['product']->value->id||Configuration::get('PS_FORCE_FRIENDLY_PRODUCT')) {?><?php echo "copy2friendlyUrl";?><?php }?><?php $_tmp4=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/input_text_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_class'=>((string)$_smarty_tpl->tpl_vars['class_input_ajax']->value).$_tmp4." updateCurrentText",'input_value'=>$_smarty_tpl->tpl_vars['product']->value->meta_title,'input_name'=>'meta_title'), 0);?>

    </div>
  </div>

  
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="link_rewrite_<?php echo $_smarty_tpl->tpl_vars['id_language']->value;?>
">
      <span class="label-tooltip" data-toggle="tooltip"
        title="<?php echo smartyTranslate(array('s'=>'Leave it empty if you want the system to generate one for you','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
">
        <?php echo smartyTranslate(array('s'=>'Friendly URL','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['agilemultipleseller_views']->value)."/templates/front/products/input_text_lang.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('languages'=>$_smarty_tpl->tpl_vars['languages']->value,'input_value'=>$_smarty_tpl->tpl_vars['product']->value->link_rewrite,'input_name'=>'link_rewrite'), 0);?>

    </div>
  </div>

<div class="form-group">
  <label class="control-label  agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="tags_<?php echo $_smarty_tpl->tpl_vars['id_language']->value;?>
">
    <span class="label-tooltip" data-toggle="tooltip"
      title="<?php echo smartyTranslate(array('s'=>'Each tag has to be followed by a comma. The following characters are forbidden: %s','sprintf'=>'!&lt;;&gt;;?=+#&quot;&deg;{}_$%','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
">
      <?php echo smartyTranslate(array('s'=>'Tags:','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

    </span>
  </label>
  <div class="agile-col-md-8 agile-col-lg-8 agile-col-xl-8">
    <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1) {?>
    <div class="row">
      <?php }?>
      <?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>
      
      <script type="text/javascript">
        $().ready(function () {
        var input_id = 'tags_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
';
        $('#'+input_id).tagify({delimiters: [13,44], addTagPrompt: '<?php echo smartyTranslate(array('s'=>'Add tag','mod'=>'agilemultipleseller','js'=>1),$_smarty_tpl);?>
'});
        $('#product_form').submit( function() {
        $(this).find('#'+input_id).val($('#'+input_id).tagify('serialize'));
        });
        });
      </script>
      
      <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1) {?>
      <div class="translatable-field lang-<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
">
        <div class="col-lg-9">
          <?php }?>
          <input type="text" id="tags_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="tagify updateCurrentText" name="tags_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" value="<?php echo smarty_modifier_htmlentitiesUTF8($_smarty_tpl->tpl_vars['product']->value->getTags($_smarty_tpl->tpl_vars['language']->value['id_lang'],true));?>
" />
          <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1) {?>
        </div>
        <div class="col-lg-2">
          <button type="button" class="agile-btn agile-btn-default agile-dropdown-toggle" data-toggle="agile-dropdown">
            <?php echo $_smarty_tpl->tpl_vars['language']->value['iso_code'];?>

            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>
            <li>
              <a href="javascript:hideOtherLanguage(<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
);"><?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
</a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <?php }?>
      <?php } ?>
      <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1) {?>
    </div>
    <?php }?>
  </div>
</div>

<div class="form-group agile-align-center">
    <button type="submit" class="agile-btn agile-btn-default" name="submitProduct" value="<?php echo smartyTranslate(array('s'=>'Save','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
">
    <i class="icon-save "></i>&nbsp;<span><?php echo smartyTranslate(array('s'=>'Save','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span></button >
   </div>
   
    <script type="text/javascript">
      hideOtherLanguage(<?php echo $_smarty_tpl->tpl_vars['id_language']->value;?>
);
    </script>

</div> <!-- product-informations -->

<?php }} ?>
