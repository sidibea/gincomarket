<script type="text/javascript">
  function validate_isNotNullorEmpty(s)
  {
  return s?true:false;
  }

</script>

{if isset($create_seller_checked)}
	<div class="required form-group">
		<label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="guest_email">
      <span>
        {l s='Email address' mod='agilemultipleseller'} <sup>*</sup></span>
		</label>
    <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <div class="row">
        <div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <input type="text" class="is_required validate" data-validate="isEmail" id="guest_email" name="guest_email" value="{if isset($smarty.post.guest_email)}{$smarty.post.guest_email}{/if}" />
        </div>
      </div>
    </div>
	</div>
	<div class="required form-group">
		<label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="firstname">
      {l s='First name' mod='agilemultipleseller'} <sup>*</sup>
		</label>
    <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <div class="row">
        <div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <input type="text" class="is_required validate" data-validate="isName" id="firstname" name="firstname" onblur="$('#customer_firstname').val($(this).val());" value="{if isset($smarty.post.firstname)}{$smarty.post.firstname}{/if}" />
          <input type="hidden" id="customer_firstname" name="customer_firstname" value="{if isset($smarty.post.firstname)}{$smarty.post.firstname}{/if}" />
        </div>
      </div>
    </div>
	</div>
	<div class="required form-group">
		<label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="lastname">
      {l s='Last name' mod='agilemultipleseller'} <sup>*</sup>
		</label>
    <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <div class="row">
        <div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
          <input type="text" class="is_required validate" data-validate="isName" id="lastname" name="lastname" onblur="$('#customer_lastname').val($(this).val());" value="{if isset($smarty.post.lastname)}{$smarty.post.lastname}{/if}" />
          <input type="hidden" id="customer_lastname" name="customer_lastname" value="{if isset($smarty.post.lastname)}{$smarty.post.lastname}{/if}" />
        </div>
      </div>
    </div>
	</div>
{/if}



{if in_array('company', $display_fields)}
<div class="form-group">
  <label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="company_{$id_language}">
    <span>
      {l s='Company' mod='agilemultipleseller'}<sup> *</sup>
    </span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    {include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
    languages=$languages
    input_value=$sellerinfo->company
    input_name='company'
    }
  </div>
</div>
{/if}

{if in_array('address1', $display_fields)}
<div class="form-group">
  <label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="address1_{$id_language}">
    <span>
      {l s='Address1' mod='agilemultipleseller'}
    </span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    {include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
    languages=$languages
    input_value=$sellerinfo->address1
    input_name='address1'
    }
  </div>
</div>
{/if}
{if in_array('address2', $display_fields)}
<div class="form-group">
  <label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="address2_{$id_language}">
    <span>
      {l s='Address2' mod='agilemultipleseller'}
    </span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    {include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
    languages=$languages
    input_value=$sellerinfo->address2
    input_name='address2'
    }
  </div>
</div>
{/if}
{if in_array('city', $display_fields)}
<div class="form-group">
  <label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="city_{$id_language}">
    <span>
      {l s='City' mod='agilemultipleseller'}
    </span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    {include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
    languages=$languages
    input_value=$sellerinfo->city
    input_name='city'
    }
  </div>
</div>
{/if}
{if in_array('postcode', $display_fields)}
<div class="form-group">
  <label for="postcode" class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="postcode">
    <span>{l s='Zip/Postal Code' mod='agilemultipleseller'}</span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    <div class="row agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <input name="postcode" id="postcode" value="{if isset($smarty.post.postcode)}{$smarty.post.postcode}{else}{$sellerinfo->postcode|escape:'htmlall':'UTF-8'}{/if}" type="text" />
    </div>
  </div>
</div>
{/if}
{if in_array('id_country', $display_fields)}
<div class="form-group">
  <label for="id_country" class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="id_country">
    <span>{l s='Country' mod='agilemultipleseller'}</span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    <div class="row agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <select name="id_country" id="id_country" class="agile-item-padding">
        {foreach from=$countries item=country}
		<option value="{$country.id_country}" {if isset($smarty.post.id_country)}{if $smarty.post.id_country == $country.id_country}selected="selected"{/if}{else}{if $sellerinfo->id_country == $country.id_country}selected="selected"{/if}{/if}>{$country.name|escape:'htmlall':'UTF-8'}</option>
        {/foreach}
      </select>
    </div>
  </div>
</div>
{/if}
{if in_array("id_state", $display_fields)}
<div class="form-group id_state">
  <label for="id_state" class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
    <span>{l s='State' mod='agilemultipleseller'}</span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    <div class="row agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <select name="id_state" id="id_state" class="agile-item-padding">
      </select>
    </div>
  </div>
</div>
{/if}
{if in_array('phone', $display_fields)}
<div class="form-group">
  <label for="phone" class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="phone">
    <span>{l s='Phone' mod='agilemultipleseller'}</span>
  </label>
  <div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
    <div class="row agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
      <input name="phone" id="phone" value="{if isset($smarty.post.phone)}{$smarty.post.phone}{else}{$sellerinfo->phone|escape:'htmlall':'UTF-8'}{/if}" type="text" class="agile-item-padding" />
		</div>
  </div>
</div>
{/if}
<table id="sellerinformation" name="sellerinformation" cellpadding="15" style="display: none;width: 80%;border:dotted 0px gray;"align="center">
  {$addtional_fields_html}
  <input type="hidden" name="signin" id="signin" value="1"/>
</table>
{*$default_language*}
<script type="text/javascript">
  hideOtherLanguage({$id_language});
</script>
