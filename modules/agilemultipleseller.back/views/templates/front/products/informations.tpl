    <script type="text/javascript">
      var iso = "{$isoTinyMCE}";
      var pathCSS = "{$theme_css_dir}";
      var ad = "{$ad}";
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
    $("img[id^='language_current_']").attr("src","{$base_dir}img/l/" + id_language_new + ".jpg");
    }
  </script>

{if isset($check_product_association_ajax) && $check_product_association_ajax}
{assign var=class_input_ajax value='check_product_name '}
{else}
{assign var=class_input_ajax value=''}
{/if}

<div id="product-informations" class="panel product-tab">
  <input type="hidden" name="submitted_tabs[]" value="Informations" />
  <h3 class="tab">{l s='Information' mod='agilemultipleseller'}</h3>
  {* Name *}
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required" for="name_{$id_language}">
      <span class="label-tooltip" data-toggle="tooltip"
				title="{l s='Invalid characters:' mod='agilemultipleseller'} &lt;&gt;;=#{}">
        {l s='Name:' mod='agilemultipleseller'}
      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      {include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
      languages=$languages
      input_class="{$class_input_ajax}{if !$product->id || Configuration::get('PS_FORCE_FRIENDLY_PRODUCT')}copy2friendlyUrl{/if} updateCurrentText"
      input_value=$product->name
      input_name='name'
      }
    </div>
  </div>

  {* Category *}
  <div class="form-group" {if empty($categories)} style="display:none;" {/if}>
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="id_category_default">
      <span>
          {l s='Category' mod='agilemultipleseller'}
      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <select id="id_category_default" name="id_category_default">
            {foreach $categories AS $category}
            <option value="{$category['id_category']}" {if $product->id_category_default == $category['id_category']}selected="selected"{/if}>{$category['name']}</option>
            {/foreach}
          </select>
        </div>
      </div>
    </div>
  </div>

  {* List Options *}
  <div class="form-group" {if $is_agilesellerlistoptions_installed}{else}style="display:none;"{/if}>
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
      <span>
        {l s='List Options' mod='agilemultipleseller'}
      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
 
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          {$HOOK_PRODYCT_LIST_OPTIONS}
        </div>
    </div>
  </div>

  {* global information section*}
  {* Wholesale Price *}
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="wholesale_price">
      <span>
        {l s='Wholesale Price' mod='agilemultipleseller'}
      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <div class="input-group">
            <input type="text" name="wholesale_price" id="wholesale_price" value="{$product->wholesale_price}" />
            <span class="input-group-addon">({$currency->sign})</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  {* Retail Price *}
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="price">
      <span>
        {l s='Retail Price' mod='agilemultipleseller'}
      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <div class="input-group">
            <input type="text" name="price" id="price" value="{$product->price}" class="form-control"/>
            <span class="input-group-addon">({$currency->sign})</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  {* Quantity *}
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="quantity">
      <span>
        {l s='Quantity' mod='agilemultipleseller'}
      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <input size="55" type="text" name="quantity" value="{$product->quantity}" class="form-control" />
        </div>
      </div>
    </div>
  </div>

  {* When out of stock *}
  <div class="form-group">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="out_of_stock">
        {l s='When out of stock' mod='agilemultipleseller'}
      </label>
      <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
        <p class="radio">
          <label for="out_of_stock_1" class="control-label">
            <input id="out_of_stock_1" type="radio" value="0" class="out_of_stock" name="out_of_stock" {if $product->out_of_stock == 0} checked {/if} >
            {l s='Deny orders' mod='agilemultipleseller'}
          </label>
        </p>
        <p class="radio">
          <label for="pack_product" class="control-label">
            <input id="out_of_stock_2" type="radio" value="1" class="out_of_stock" name="out_of_stock"  {if $product->out_of_stock == 1} checked {/if} >
                {l s='Allow orders' mod='agilemultipleseller'}:
          </label>
        </p>
        <p class="radio">
          <label for="out_of_stock_3" class="control-label">
            <input id="out_of_stock_3" type="radio" value="2" class="out_of_stock" name="out_of_stock" {if $product->out_of_stock == 2} checked {/if}>
              {l s='Default'  mod='agilemultipleseller'}:
              {if $order_out_of_stock == 1}
              {l s='Allow orders'  mod='agilemultipleseller'}
              {else}
              {l s='Deny orders'  mod='agilemultipleseller'}
              {/if}
              {l s=' as set in Preferences'}
            </label>
        </p>
          </div>
    </div>

  {* Additional shipping *}
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="price">
      <span>
        {l s='Additional shipping' mod='agilemultipleseller'}
      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <div class="input-group">
            <input size="55" type="text" id="additional_shipping_cost" name="additional_shipping_cost" value="{$product->additional_shipping_cost|htmlentitiesUTF8}" class="form-control" />
            <span class="input-group-addon">({$currency->sign})</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  {*Reference *}
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="reference">
      <span class="label-tooltip" data-toggle="tooltip"
      title="{l s='Special characters allowed:'} .-_#\">
        {l s='Reference:' mod='agilemultipleseller'}
      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <input size="55" type="text" id="reference" name="reference" value="{$product->reference|htmlentitiesUTF8}" class="form-control" />
        </div>
      </div>
    </div>
  </div>

  {* EAN13 or JAN *}
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="ean13">
      <span class="label-tooltip" data-toggle="tooltip"
        title="{l s='(Europe, Japan)' mod='agilemultipleseller'}">
        {l s='EAN13 or JAN' mod='agilemultipleseller'}
      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <input size="55" maxlength="13" type="text" id="ean13" name="ean13" value="{$product->ean13|htmlentitiesUTF8}" class="form-control"  />
        </div>
      </div>
    </div>
    </div>

  {* UPC *}
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="upc">
      <span class="label-tooltip" data-toggle="tooltip"
        title="{l s='(US, Canada)' mod='agilemultipleseller'}">
        {l s='UPC' mod='agilemultipleseller'}
      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <input size="55" maxlength="12" type="text" id="upc" name="upc" value="{$product->upc}" class="form-control" />
        </div>
      </div>
    </div>
  </div>

  {* status informations *}
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
      {l s='Status:' mod='agilemultipleseller'}
    </label>
    <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <p class="radio">
        <label for="active_on" class="control-label">
          <input type="radio" name="active" id="active_on" value="1" {if $product->active || !$product->isAssociatedToShop()}checked="checked" {/if} />
            {l s='Enabled' mod='agilemultipleseller'}
          </label>
      </p>
      <p class="radio">
        <label for="active_off" class="control-label">
          <input type="radio" name="active" id="active_off" value="0" {if !$product->active && $product->isAssociatedToShop()}checked="checked"{/if} />
            {l s='Disabled' mod='agilemultipleseller'}
          </label>
      </p>
    </div>
  </div>

  {* visibility *}
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="visibility">
      {l s='Visibility:' mod='agilemultipleseller'}
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      <div class="row">
        <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <select name="visibility" id="visibility">
            <option value="both" {if $product->visibility == 'both'}selected="selected"{/if} >{l s='Everywhere' mod='agilemultipleseller'}</option>
            <option value="catalog" {if $product->visibility == 'catalog'}selected="selected"{/if} >{l s='Catalog only' mod='agilemultipleseller'}</option>
            <option value="search" {if $product->visibility == 'search'}selected="selected"{/if} >{l s='Search only' mod='agilemultipleseller'}</option>
            <option value="none" {if $product->visibility == 'none'}selected="selected"{/if}>{l s='Nowhere' mod='agilemultipleseller'}</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  {* Options *}
  <div id="product_options" class="form-group" {if !$product->active}style="display:none"{/if} >
    <div class="col-lg-12">
      <div class="form-group">
        <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="available_for_order">
          {l s='Options' mod='agilemultipleseller'}
        </label>
        <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
          <div class="checkbox agile-padding-left20" >
            <input type="checkbox" name="available_for_order" id="available_for_order" value="1" class="comparator" {if $product->available_for_order}checked{/if}  />
              <label for="available_for_order">{l s='available for order' mod='agilemultipleseller'}</label>
            </div>
          <div class="checkbox agile-padding-left20" >
            <input type="checkbox" name="show_price" id="show_price" value="1" class="comparator" {if $product->show_price}checked="checked"{/if} {if $product->available_for_order}disabled="disabled"{/if}/>
              <label for="show_price">{l s='show price' mod='agilemultipleseller'}</label>
            </div>
          <div class="checkbox agile-padding-left20" >
            <input type="checkbox" name="online_only" id="online_only" value="1" class="comparator" {if $product->online_only}checked="checked"{/if} />
              <label for="online_only">{l s='online only (not sold in store)' mod='agilemultipleseller'}</label>
            </div>
        </div>
      </div>
    </div>
  </div>

    {* Condition *}
    <div class="form-group">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="condition">
        {l s='Condition' mod='agilemultipleseller'}
      </label>
      <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
        <div class="row">
          <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
            <select name="condition" id="condition">
              <option value="new" {if $product->condition == 'new'}selected="selected"{/if} >{l s='New' mod='agilemultipleseller'}</option>
              <option value="used" {if $product->condition == 'used'}selected="selected"{/if} >{l s='Used' mod='agilemultipleseller'}</option>
              <option value="refurbished" {if $product->condition == 'refurbished'}selected="selected"{/if}>{l s='Refurbished' mod='agilemultipleseller'}</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    {* Supplier *}
    <div class="form-group">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="condition">
        {l s='Supplier' mod='agilemultipleseller'}
      </label>
      <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
        <div class="row">
          <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
            <select name="id_supplier" id="id_supplier">
              <option value="0"> -- </option>
              {foreach $suppliers AS $supplier}
              <option value="{$supplier['id_supplier']}" {if $product->id_supplier == $supplier['id_supplier']}selected{/if}>{$supplier['name']}</option>
              {/foreach}
            </select>
          </div>
        </div>
      </div>
    </div>

    {* Manufacturer *}
    <div class="form-group">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="condition">
        {l s='Manufacturer' mod='agilemultipleseller'}
      </label>
      <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
        <div class="row">
          <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
            <select name="id_manufacturer" id="id_manufacturer">
              <option value="0"> -- </option>
              {foreach $manufacturers AS $manufacturer}
              <option value="{$manufacturer['id_manufacturer']}" {if $product->id_manufacturer == $manufacturer['id_manufacturer']}selected="selected"{/if}>{$manufacturer['name']}</option>
              {/foreach}
            </select>
          </div>
        </div>
      </div>
    </div>

{* Short description *}
<div class="form-group">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="description_short_{$id_language}">
        <span class="label-tooltip" data-toggle="tooltip"
          title="{l s='Appears in the product list(s), and on the top of the product page.' mod='agilemultipleseller'}">
          {l s='Short description' mod='agilemultipleseller'}
        </span>
      </label>
    <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      {include file="$agilemultipleseller_views/templates/front/products/textarea_lang.tpl"
        languages=$languages
        input_name='description_short'
        input_value=$product->description_short
        default_row=10
        class="rte"
        max=400}
    </div>
  </div>

  {* description *}
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="description_{$id_language}">
      <span class="label-tooltip" data-toggle="tooltip"
        title="{l s='Appears in the body of the product page' mod='agilemultipleseller'}">
        {l s='Description:' mod='agilemultipleseller'}
      </span>
    </label>
    <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      {include file="$agilemultipleseller_views/templates/front/products/textarea_lang.tpl"
        languages=$languages
        input_name='description'
        input_value=$product->description
        default_row=10
        class="rte"
        max=400}
    </div>
  </div>

  {* meta tags *}
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="meta_keywords_{$id_language}">
      <span class="label-tooltip" data-toggle="tooltip"
        title="{l s='Tags separated by commas (e.g. dvd, dvd player, hifi)' mod='agilemultipleseller'} - {l s='Forbidden characters:'  mod='agilemultipleseller'} !&lt;;&gt;;?=+#&quot;&deg;{}_$%">
        {l s='Meta Tags' mod='agilemultipleseller'}
      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      {include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
      languages=$languages
      input_class="{$class_input_ajax}{if !$product->id || Configuration::get('PS_FORCE_FRIENDLY_PRODUCT')}copy2friendlyUrl{/if} updateCurrentText"
      input_value=$product->meta_keywords
      input_name='meta_keywords'
      }
    </div>
  </div>

  {* Meta Description *}
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="meta_description_{$id_language}">
      <span>
        {l s='Meta Description' mod='agilemultipleseller'}
      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      {include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
      languages=$languages
      input_class="{$class_input_ajax}{if !$product->id || Configuration::get('PS_FORCE_FRIENDLY_PRODUCT')}copy2friendlyUrl{/if} updateCurrentText"
      input_value=$product->meta_description
      input_name='meta_description'
      }
    </div>
  </div>

  {* Meta Title *}
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="meta_title_{$id_language}">
      <span>
        {l s='Meta Title' mod='agilemultipleseller'}
      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      {include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
      languages=$languages
      input_class="{$class_input_ajax}{if !$product->id || Configuration::get('PS_FORCE_FRIENDLY_PRODUCT')}copy2friendlyUrl{/if} updateCurrentText"
      input_value=$product->meta_title
      input_name='meta_title'
      }
    </div>
  </div>

  {* friendly url *}
  <div class="form-group">
    <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="link_rewrite_{$id_language}">
      <span class="label-tooltip" data-toggle="tooltip"
        title="{l s='Leave it empty if you want the system to generate one for you' mod='agilemultipleseller'}">
        {l s='Friendly URL' mod='agilemultipleseller'}
      </span>
    </label>
    <div class="agile-col-md-7 agile-col-lg-5 agile-col-xl-5">
      {include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
      languages=$languages
      input_value=$product->link_rewrite
      input_name='link_rewrite'}
    </div>
  </div>
{* tags *}
<div class="form-group">
  <label class="control-label  agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="tags_{$id_language}">
    <span class="label-tooltip" data-toggle="tooltip"
      title="{l s='Each tag has to be followed by a comma. The following characters are forbidden: %s' sprintf='!&lt;;&gt;;?=+#&quot;&deg;{}_$%'  mod='agilemultipleseller'}">
      {l s='Tags:' mod='agilemultipleseller'}
    </span>
  </label>
  <div class="agile-col-md-8 agile-col-lg-8 agile-col-xl-8">
    {if $languages|count > 1}
    <div class="row">
      {/if}
      {foreach from=$languages item=language}
      {literal}
      <script type="text/javascript">
        $().ready(function () {
        var input_id = '{/literal}tags_{$language.id_lang}{literal}';
        $('#'+input_id).tagify({delimiters: [13,44], addTagPrompt: '{/literal}{l s='Add tag' mod='agilemultipleseller' js=1}{literal}'});
        $({/literal}'#product_form{literal}').submit( function() {
        $(this).find('#'+input_id).val($('#'+input_id).tagify('serialize'));
        });
        });
      </script>
      {/literal}
      {if $languages|count > 1}
      <div class="translatable-field lang-{$language.id_lang}">
        <div class="col-lg-9">
          {/if}
          <input type="text" id="tags_{$language.id_lang}" class="tagify updateCurrentText" name="tags_{$language.id_lang}" value="{$product->getTags($language.id_lang, true)|htmlentitiesUTF8}" />
          {if $languages|count > 1}
        </div>
        <div class="col-lg-2">
          <button type="button" class="agile-btn agile-btn-default agile-dropdown-toggle" data-toggle="agile-dropdown">
            {$language.iso_code}
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            {foreach from=$languages item=language}
            <li>
              <a href="javascript:hideOtherLanguage({$language.id_lang});">{$language.name}</a>
            </li>
            {/foreach}
          </ul>
        </div>
      </div>
      {/if}
      {/foreach}
      {if $languages|count > 1}
    </div>
    {/if}
  </div>
</div>

<div class="form-group agile-align-center">
    <button type="submit" class="agile-btn agile-btn-default" name="submitProduct" value="{l s='Save' mod='agilemultipleseller'}">
    <i class="icon-save "></i>&nbsp;<span>{l s='Save' mod='agilemultipleseller'}</span></button >
   </div>
   {*$default_language*}
    <script type="text/javascript">
      hideOtherLanguage({$id_language});
    </script>

</div> <!-- product-informations -->

