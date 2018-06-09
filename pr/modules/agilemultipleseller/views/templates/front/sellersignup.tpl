<script type="text/javascript">	
    var iso = "{$isoTinyMCE}";
    var pathCSS = '{$smarty.const._THEME_CSS_DIR_}';
    var ad = "{$ad}";

	var is_multilang = 1;

    idSelectedCountry = {if isset($smarty.post.id_state)}{$smarty.post.id_state|intval}{else}{if isset($sellerinfo->id_state)}{$sellerinfo->id_state|intval}{else}false{/if}{/if};
	{if isset($countries)}
		{addJsDef agileCountries=$countries}
	{/if}


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

	    hideOtherLanguage({$current_id_lang});

	});

	function changeMyLanguage(field, fieldsString, id_language_new, iso_code)
	{
		changeLanguage(field, fieldsString, id_language_new, iso_code);
		$("img[id^='language_current_']").attr("src","{$base_dir}img/l/" + id_language_new + ".jpg");
	}
</script>

{capture name=path}{l s='Seller Signup'  mod='agilemultipleseller'}{/capture}
<div id="agile">
	<div class="panel">
		<h1>{l s='Seller Signup' mod='agilemultipleseller'}</h1>
		{include file="$tpl_dir./errors.tpl"}
		<form action="{$link->getModuleLink('agilemultipleseller', 'sellersignup', [], true)}" enctype="multipart/form-data" method="post" class="form-horizontal std">
			<input type="hidden" name="token" value="{$token}" />

			<h3>{l s='Your account information' mod='agilemultipleseller'}</h3>
			<div class="form-group">
				<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required" for="firstname">
					<span>
						{l s='First Name' mod='agilemultipleseller'}
					</span>
				</label>
				<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<div class="row">
						<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
							<input type="text" id="firstname" name="firstname" class="form-control" value="{if isset($smarty.post.firstname)}{$smarty.post.firstname}{else}{if isset($sellerinfo->firstname)}{$sellerinfo->firstname|escape:'htmlall':'UTF-8'}{/if}{/if}" class="form-control" />
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required" for="lastname">
					<span>
						{l s='Last Name' mod='agilemultipleseller'}
					</span>
				</label>
				<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<div class="row">
						<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
							<input type="text" id="lastname" name="lastname" class="form-control" value="{if isset($smarty.post.lastname)}{$smarty.post.lastname}{else}{if isset($sellerinfo->lastname)}{$sellerinfo->lastname|escape:'htmlall':'UTF-8'}{/if}{/if}" class="form-control" />
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required" for="email">
					<span>
						{l s='Email Address' mod='agilemultipleseller'}
					</span>
				</label>
				<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<div class="row">
						<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
							<input type="text" id="email" name="email" class="form-control" value="{if isset($smarty.post.email)}{$smarty.post.email}{else}{if isset($sellerinfo->email)}{$sellerinfo->email|escape:'htmlall':'UTF-8'}{/if}{/if}" class="form-control" />
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required" for="password">
					<span>
						{l s='Password' mod='agilemultipleseller'}
					</span>
				</label>
				<div class=" agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<div class="row">
						<div class="agile-col-sm-9 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
							<input type="password" class="is_required validate form-control" data-validate="isPasswd" name="passwd" id="passwd" />
						</div>
					</div>
				</div>
			</div>






			<h3>{l s='Your business information' mod='agilemultipleseller'}</h3>
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

			{* Begin of Google map by default -----------------
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
			End of Google map -------------------------------------- *}

			<div>
				<input type="hidden" name="id_sellerinfo" value="{$sellerinfo->id|intval}" />
				<input type="hidden" name="id_customer" value="{$sellerinfo->id_customer|intval}" />
				{if isset($select_address)}<input type="hidden" name="select_address" value="{$select_address|intval}" />{/if}
			</div>	
			<div class="form-group agile-align-center">
				<span class="label-tooltip pull-right"> <sup>*</sup> {l s='Required field' mod='agilemultipleseller'}</span>
				<button type="submit" class="agile-btn agile-btn-default" name="submitSellerinfo" value="{l s='Save' mod='agilemultipleseller'}">
				<i class="icon-save"></i>&nbsp;<span>{l s='Register' mod='agilemultipleseller'}</span></button>
			</div>
		</form>

		{addJsDefL name='sellerbusiness_fileDefaultHtml'}{l s='No file selected' mod='agilemultipleseller' js=1}{/addJsDefL}
		{addJsDefL name='sellerbusiness_fileButtonHtml'}{l s='Choose File' mod='agilemultipleseller' js=1}{/addJsDefL}

	</div> <!-- panel -->
</div> <!-- bootstrap -->

