{capture name=path}<a href="{$link->getPageLink('my-account.php')}">{l s='My Account' mod='agilemultipleseller'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='My Seller Account'  mod='agilemultipleseller'}{/capture}
<div id="agile">
<div class="panel">
<h1>{l s='My Seller Account' mod='agilemultipleseller'}</h1>
{include file="$tpl_dir./errors.tpl"}
        <script type="text/javascript">	
        var iso = "{$isoTinyMCE}";
        var pathCSS = '{$smarty.const._THEME_CSS_DIR_}';
        var ad = "{$ad}";

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
        		
        {include file="$agilemultipleseller_views./templates/front/seller_tabs.tpl"}

    <script type="text/javascript">
    idSelectedCountry = {if isset($smarty.post.id_state)}{$smarty.post.id_state|intval}{else}{if isset($sellerinfo->id_state)}{$sellerinfo->id_state|intval}{else}false{/if}{/if};
	{if isset($countries)}
		{addJsDef agileCountries=$countries}
	{/if}

    </script>

	<script language="javascript" type="text/javascript">
		function changeMyLanguage(field, fieldsString, id_language_new, iso_code)
		{
			changeLanguage(field, fieldsString, id_language_new, iso_code);
			$("img[id^='language_current_']").attr("src","{$base_dir}img/l/" + id_language_new + ".jpg");
		}
	</script>


{if isset($seller_exists) AND $seller_exists}
    <form action="{$link->getModuleLink('agilemultipleseller', 'sellerbusiness', [], true)}" enctype="multipart/form-data" method="post" class="form-horizontal std">
        <h3>{l s='Your business information' mod='agilemultipleseller'}</h3>
        <input type="hidden" name="token" value="{$token}" />
	{if $is_multiple_shop_installed}
		<div class="form-group">
		        <label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="id_sellertype1">
					<span>{l s='Primary Type' mod='agilemultipleseller'}</span>
				</label>
				<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<div class="row agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
						<select name="id_sellertype1" id="id_sellertype1">
							{foreach from=$sellertypes item=sellertype}
								<option value="{$sellertype['id_sellertype']}" {if $sellerinfo->id_sellertype1==$sellertype['id_sellertype']}selected{/if}>{$sellertype['name']}</option>
							{/foreach}
						</select>
					</div>
				</div>
			</div>
		<div class="form-group">
	            <label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="id_sellertype2">
					<span>{l s='Secondary Type' mod='agilemultipleseller'}</span>
				</label>
				<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<div class="row agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
						<select name="id_sellertype2" id="id_sellertype2">
							{foreach from=$sellertypes item=sellertype}
								<option value="{$sellertype['id_sellertype']}" {if $sellerinfo->id_sellertype2==$sellertype['id_sellertype']}selected{/if} >{$sellertype['name']}</option>
							{/foreach}
						</select>
					</div>
				</div>
		</div>
	{/if}
	<div class="form-group">
		<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required" for="company_{$current_id_lang}">
			<span>
				{l s='Company' mod='agilemultipleseller'}
			</span>
		</label>
		<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			{include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
				languages=$languages
				input_value=$sellerinfo->company
				input_name='company'
			}
		</div>
	</div>

	{if $is_multiple_shop_installed}

		<div class="form-group">
			<label for="shop_name" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				<span>{l s='Shop Name' mod='agilemultipleseller'}</span>
			</label>
			<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
						<input type="text" id="shop_name" name="shop_name" class="form-control" value="{if isset($smarty.post.shop_name)}{$smarty.post.shop_name}{else}{if isset($seller_shop->name)}{$seller_shop->name|escape:'htmlall':'UTF-8'}{/if}{/if}" class="form-control" />
					</div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="shop_url" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				<span>{l s='Shop full Url' mod='agilemultipleseller'}</span>
			</label>
			<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
						<input type="text" id="shop_url" name="shop_url" class="form-control" value="{$seller_shopurl->getURL()}" disabled=true class="form-control" />
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="virtual_uri" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				<span>{l s='Virtual Uri' mod='agilemultipleseller'}</span>
			</label>
			<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
						<input type="text" id="virtual_uri" name="virtual_uri"  class="form-control" value="{if isset($smarty.post.virtual_uri)}{$smarty.post.virtual_uri}{else}{if isset($seller_shopurl)}{$seller_shopurl->virtual_uri|escape:'htmlall':'UTF-8'}{/if}{/if}" class="form-control" />
					</div>
				</div>
			</div>
		</div>

		{*
		<div class="form-group">
			<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="meta_title_{$current_id_lang}">
				<span>
					{l s='Meta Title' mod='agilemultipleseller'}
				</span>
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				{include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
					languages=$languages
					input_value=$sellerinfo->meta_title
					input_name='meta_title'
				}
			</div>
		</div>


		<div class="form-group">
			<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="meta_tag_{$current_id_lang}">
				<span>
					{l s='Meta Tag' mod='agilemultipleseller'}
				</span>
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				{include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
					languages=$languages
					input_value=$sellerinfo->meta_keywords
					input_name='meta_keywords'
				}
			</div>
		</div>

		<div class="form-group">
			<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="meta_description_{$current_id_lang}">
				<span>
					{l s='Meta Description' mod='agilemultipleseller'}
				</span>
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				{include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
					languages=$languages
					input_value=$sellerinfo->meta_description
					input_name='meta_description'
				}
			</div>
		</div>
		*}

	{/if}

	<div class="form-group">
		<label for="seller_logo" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<span>{l s='Show Logo'  mod='agilemultipleseller'}</span>
		</label>
		{* The logo image is always use the orignal size of logo image, please use either width OR height to display size  *}
		<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<img src="{$sellerinfo->get_seller_logo_url()}" alt="{l s='Your Logo' mod='agilemultipleseller'}" class=:agile-col-xs-8 agile-col-sm-8 agile-col-md-8 agile-col-lg-8" title="{l s='Your Logo' mod='agilemultipleseller'}" id="seller_logo" name="seller_logo" />
				</div>
			</div>
		</div>
	</div>

	<div class="form-group">
      <label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 file_upload_label">
        <span class="label-tooltip" data-toggle="tooltip"
          title="{l s='Format:' mod='agilemultipleseller'} JPG, GIF, PNG.">
          {l s='Add a logo image'  mod='agilemultipleseller'}
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
		<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required" for="address1_{$current_id_lang}">
			<span>
				{l s='Address' mod='agilemultipleseller'}
			</span>
		</label>
		<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			{include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
				languages=$languages
				input_value=$sellerinfo->address1
				input_name='address1'
			}
		</div>
	</div>

	<div class="form-group">
		<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="address2_{$current_id_lang}">
			<span>
				{l s='Address (Line 2)' mod='agilemultipleseller'}
			</span>
		</label>
		<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			{include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
				languages=$languages
				input_value=$sellerinfo->address2
				input_name='address2'
			}
		</div>
	</div>

	<div class="form-group">
		<label for="postcode" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required">
			<span>{l s='Postal Code' mod='agilemultipleseller'}</span>
		</label>
		<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-5 agile-col-md-4 agile-col-lg-3">
					<input type="text" id="postcode" name="postcode" class="form-control" value="{if isset($smarty.post.postcode)}{$smarty.post.postcode}{else}{if isset($sellerinfo->postcode)}{$sellerinfo->postcode|escape:'htmlall':'UTF-8'}{/if}{/if}" onkeyup="$('#postcode').val($('#postcode').val().toUpperCase());" class="form-control" />
				</div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required" for="city_{$current_id_lang}">
			<span>
				{l s='City' mod='agilemultipleseller'}
			</span>
		</label>
		<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			{include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
				languages=$languages
				input_value=$sellerinfo->city
				input_name='city'
			}
		</div>
	</div>

	<div class="form-group">
		<label for="id_country" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required">
			<span>{l s='Country' mod='agilemultipleseller'}</span>
		</label>
		<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<select id="id_country" name="id_country">{$countries_list}</select>
				</div>
			</div>
		</div>
	</div>

	<div class="form-group id_state">
		<label for="id_state" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required">
			<span>{l s='State' mod='agilemultipleseller'}</span>
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
			<span>{l s='Phone' mod='agilemultipleseller'}</span>
		</label>
		<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<input type="text" id="phone" name="phone" class="form-control" value="{if isset($smarty.post.phone)}{$smarty.post.phone}{else}{if isset($sellerinfo->phone)}{$sellerinfo->phone|escape:'htmlall':'UTF-8'}{/if}{/if}" class="form-control" />
				</div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="fax" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<span>{l s='Fax' mod='agilemultipleseller'}</span>
		</label>
		<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<input type="text" id="fax" name="fax" class="form-control" value="{if isset($smarty.post.fax)}{$smarty.post.fax}{else}{if isset($sellerinfo->fax)}{$sellerinfo->fax|escape:'htmlall':'UTF-8'}{/if}{/if}" class="form-control" />
				</div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="dni" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<span>{l s='Identification' mod='agilemultipleseller'}</span>
		</label>
		<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<input type="text" id="dni" name="dni" class="form-control" value="{if isset($smarty.post.dni)}{$smarty.post.dni}{else}{if isset($sellerinfo->dni)}{$sellerinfo->dni|escape:'htmlall':'UTF-8'}{/if}{/if}" class="form-control" />
				</div>
			</div>
		</div>
	</div>

  {* description *}
  <div class="form-group">
    <label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="description_{$current_id_lang}">
      <span>
        {l s='Description' mod='agilemultipleseller'}
      </span>
    </label>
	<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
		{foreach $languages AS $language}
			<div style="display: {($language.id_lang == $current_id_lang)? 'block' : 'none'};" class="translatable-field lang-{$language.id_lang} row">
				<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<textarea class="rte" id="description_{$language.id_lang}" aria-hidden="true" name="description_{$language.id_lang}" cols="26" rows="13">{if isset($smarty.post.description[{$language.id_lang}])}{$smarty.post.description[{$language.id_lang}]}{else}{if isset($sellerinfo->description[{$language.id_lang}])}{$sellerinfo->description[{$language.id_lang}]|escape:'htmlall':'UTF-8'}{/if}{/if}</textarea>
				</div>
				<div class="agile-col-lg-2">
					<button type="button" class="agile-btn agile-btn-default agile-dropdown-toggle" tabindex="-1" data-toggle="agile-dropdown">
						{{$language.iso_code}}
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						{foreach $languages AS $language2}
							<li>
								<a href="javascript:hideOtherLanguage({$language2.id_lang});" tabindex="-1">{$language2.name}</a>
							</li>
						{/foreach}
					</ul>
				</div>
			</div>
		{/foreach}
	</div>
  </div>

	<div class="form-group">
		<label for="longitude" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<span>{l s='Longitude' mod='agilemultipleseller'}</span>
		</label>
		<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-5 agile-col-md-4 agile-col-lg-3 agile-col-xl-2">
					<input type="text" id="longitude" name="longitude" class="form-control" value="{if isset($smarty.post.longitude)}{$smarty.post.longitude}{else}{if isset($sellerinfo->longitude)}{$sellerinfo->longitude|escape:'htmlall':'UTF-8'}{/if}{/if}" />
				</div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="latitude" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<span>{l s='Latitude' mod='agilemultipleseller'}</span>
		</label>
		<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			<div class="row">
				<div class="agile-col-sm-5 agile-col-md-4 agile-col-lg-3 agile-col-xl-2">
					<input type="text" id="latitude" name="latitude" class="form-control" value="{if isset($smarty.post.latitude)}{$smarty.post.latitude}{else}{if isset($sellerinfo->latitude)}{$sellerinfo->latitude|escape:'htmlall':'UTF-8'}{/if}{/if}" />
				</div>
			</div>
		</div>
	</div>

	{for $i=1 to 10}
		{if $conf[sprintf("AGILE_MS_SELLER_TEXT%s",$i)]}
			{$field_name = sprintf("ams_custom_text%s",$i)}
			<div class="form-group">
				<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="{$field_name}_{$current_id_lang}">
					<span>
						{$custom_labels[$field_name]}
					</span>
				</label>
				<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					{include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
						languages=$languages
						input_value=$sellerinfo->{$field_name}
						input_name={$field_name}
					}
				</div>
			</div>
		{/if}
	{/for}  

	{for $i=1 to 2}
		{if $conf[sprintf("AGILE_MS_SELLER_HTML%s",$i)]}
			{$field_name = sprintf("ams_custom_html%s",$i)}
			<div class="form-group">
				<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="{$field_name}_{$current_id_lang}">
					  <span>
							{$custom_labels[$field_name]}
					  </span>
				</label>
				<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					{include file="$agilemultipleseller_views/templates/front/products/textarea_lang.tpl"
							languages=$languages
							input_name={$field_name}
							input_value=$sellerinfo->{$field_name}
							class="rte"
							max=400}
					</div>
				</div>
		{/if}
	{/for}  
	{for $i=1 to 10}
		{if $conf[sprintf("AGILE_MS_SELLER_NUMBER%s",$i)]}
			{$field_name = sprintf("ams_custom_number%s",$i)}
			<div class="form-group">
				<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="{$field_name}">
					<span>
						{$custom_labels[$field_name]}
					</span>
				</label>
				<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<div class="row">
						<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
							<input type="text" id="{$field_name}" name="{$field_name}" 
								value="{if isset($smarty.post[$field_name])}{$smarty.post[$field_name]}{else}{if isset($sellerinfo->{$field_name})}{$sellerinfo->{$field_name}|escape:'htmlall':'UTF-8'}{/if}{/if}" />
						</div>
					</div>
				</div>
			</div>
		{/if}
    {/for}  
	{for $i=1 to 5}
		{if $conf[sprintf("AGILE_MS_SELLER_DATE%s",$i)]}
			{$field_name = sprintf("ams_custom_date%s",$i)}
			<div class="form-group">
				<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="{$field_name}">
					<span>
						{$custom_labels[$field_name]}
					</span>
				</label>
				<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<div class="row">
						<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
							<input type="text" id="{$field_name}" name="{$field_name}" class="datepicker"
								value="{if isset($smarty.post[$field_name])}{$smarty.post[$field_name]}{else}{if isset($sellerinfo->{$field_name})}{$sellerinfo->{$field_name}|escape:'htmlall':'UTF-8'}{/if}{/if}" />
						</div>
					</div>
				</div>
			</div>
		{/if} 
    {/for}  

	<div class="form-group">
		<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<span>{l s='Map' mod='agilemultipleseller'}</span>
		</label>
		<div class=" agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
			<div class="row">
				<div class="agile-col-sm-12 agile-col-md-12 agile-col-lg-12 agile-col-xl-12">
					{include file="$agilemultipleseller_views./templates/googlemap.tpl"}
				</div>
			</div>
		</div>
	</div>

	<div>
		<input type="hidden" name="id_sellerinfo" value="{$sellerinfo->id|intval}" />
		<input type="hidden" name="id_customer" value="{$sellerinfo->id_customer|intval}" />
		{if isset($select_address)}<input type="hidden" name="select_address" value="{$select_address|intval}" />{/if}
	</div>	
	<div class="form-group agile-align-center">
		<span class="label-tooltip pull-right"> <sup>*</sup> {l s='Required field' mod='agilemultipleseller'}</span>
		<button type="submit" class="agile-btn agile-btn-default" name="submitSellerinfo" value="{l s='Save' mod='agilemultipleseller'}">
		<i class="icon-save"></i>&nbsp;<span>{l s='Save' mod='agilemultipleseller'}</span></button>
	</div>
</form>
{addJsDefL name='sellerbusiness_fileDefaultHtml'}{l s='No file selected' mod='agilemultipleseller' js=1}{/addJsDefL}
{addJsDefL name='sellerbusiness_fileButtonHtml'}{l s='Choose File' mod='agilemultipleseller' js=1}{/addJsDefL}


{*$default_language*}
<script type="text/javascript">
    hideOtherLanguage({$current_id_lang});
</script>


{/if}
</div> <!-- panel -->
</div> <!-- bootstrap -->
{include file="$agilemultipleseller_views./templates/front/seller_footer.tpl"}

