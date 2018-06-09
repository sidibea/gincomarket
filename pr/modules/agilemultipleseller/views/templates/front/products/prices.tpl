{*
ToDo: All CSS files should be removed from the template.
      They should be included from setmedia or hookheader
*}

{* BEGIN CUSTOMER AUTO-COMPLETE / TO REFACTO *}
<link href="{$base_dir_ssl}js/jquery/ui/themes/base/jquery.ui.theme.css" rel="stylesheet" type="text/css" media="all" />
<link href="{$base_dir_ssl}js/jquery/ui/themes/base/jquery.ui.slider.css" rel="stylesheet" type="text/css" media="all" />
<link href="{$base_dir_ssl}js/jquery/ui/themes/base/jquery.ui.datepicker.css" rel="stylesheet" type="text/css" media="all" />
<link href="{$base_dir_ssl}js/jquery/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css" media="all" />

<script type="text/javascript">
var Customer = new Object();
var product_url = '{$link->getAdminLink('AdminProducts', true)|addslashes}';
var ecotax_tax_excl = parseFloat({$ecotax_tax_excl});
var priceDisplayPrecision = {$smarty.const._PS_PRICE_DISPLAY_PRECISION_|intval};

$(document).ready(function () {
	Customer = {
		"hiddenField": jQuery('#id_customer'),
		"field": jQuery('#customer'),
		"container": jQuery('#customers'),
		"loader": jQuery('#customerLoader'),
		"init": function() {
			jQuery(Customer.field).typeWatch({
				"captureLength": 1,
				"highlight": true,
				"wait": 50,
				"callback": Customer.search
			}).focus(Customer.placeholderIn).blur(Customer.placeholderOut);
		},
		"placeholderIn": function() {
			if (this.value == '{l s='All customers'}') {
				this.value = '';
			}
		},
		"placeholderOut": function() {
			if (this.value == '') {
				this.value = '{l s='All customers'}';
			}
		},
		"search": function()
		{
			Customer.showLoader();
			jQuery.ajax({
				"type": "POST",
				"url":  "{$base_dir_ssl}modules/agilemultipleseller/ajax_agile_getcustomers.php",
				"async": true,
				"dataType": "json",
				"data": {
					"ajax": "1",
					"tab": "AgileProductCustomers",
					"action": "searchCustomers",
					"customer_search": Customer.field.val()
				},
				"success": Customer.success
			});
		},
		"success": function(result)
		{
			if(result.found) {
				var html = '<ul class="list-unstyled">';
				jQuery.each(result.customers, function() {
					html += '<li>'+this.firstname+' '+this.lastname+(this.birthday ? ' - '+this.birthday:'');
					html += ' - '+this.email;
					html += '<a onclick="Customer.select('+this.id_customer+', \''+this.firstname+' '+this.lastname+'\'); return false;" href="#" class="btn btn-default">{l s='Choose'}</a></li>';
				});
				html += '</ul>';
			}
			else
				html = '<div class="alert alert-warning">{l s='No customers found'}</div>';
			Customer.hideLoader();
			Customer.container.html(html);
			jQuery('.fancybox', Customer.container).fancybox();
		},
		"select": function(id_customer, fullname)
		{
			Customer.hiddenField.val(id_customer);
			Customer.field.val(fullname);
			Customer.container.empty();
			return false;
		},
		"showLoader": function() {
			Customer.loader.fadeIn();
		},
		"hideLoader": function() {
			Customer.loader.fadeOut();
		}
	};
	Customer.init();
});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		product_prices['0'] = $('#sp_current_ht_price').html();

		$('#id_product_attribute').change(function() {
			$('#sp_current_ht_price').html(product_prices[$('#id_product_attribute option:selected').val()]);
		});

		$('#leave_bprice').click(function() {
			if (this.checked)
				$('#sp_price').attr('disabled', 'disabled');
			else
				$('#sp_price').removeAttr('disabled');
		});

		$('.datepicker').datetimepicker({
			prevText: '',
			nextText: '',
			dateFormat: 'yy-mm-dd',

			// Define a custom regional settings in order to use PrestaShop translation tools
			currentText: '{l s='Now' mod='agilemultipleseller'}',
			closeText: '{l s='Done' mod='agilemultipleseller'}',
			ampm: false,
			amNames: ['AM', 'A'],
			pmNames: ['PM', 'P'],
			timeFormat: 'hh:mm:ss tt',
			timeSuffix: '',
			timeOnlyTitle: '{l s='Choose Time' mod='agilemultipleseller'}',
			timeText: '{l s='Time' mod='agilemultipleseller'}',
			hourText: '{l s='Hour' mod='agilemultipleseller'}',
			minuteText: '{l s='Minute' mod='agilemultipleseller'}',
		});

		calcPriceTI();
		unitPriceWithTax('unit');

	});
</script>

{* END CUSTOMER AUTO-COMPLETE / TO REFACTO *}
	<div id="product-prices" class="panel product-tab">
		<h3>{l s='Product price' mod='agilemultipleseller'}</h3>
		<div class="alert alert-info">
			{l s='You must enter either the pre-tax retail price, or the retail price with tax. The input field will be automatically calculated.' mod='agilemultipleseller'}
		</div>

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="wholesale_price">
			<span  class="label-tooltip" data-toggle="tooltip" title="{l s='The wholesale price at which you bought this product' mod='agilemultipleseller'}">
				{l s='Pre-tax wholesale price' mod='agilemultipleseller'}
			</span>
		</label>
		<div class="input-group agile-col-md-4 agile-col-lg-2 agile-col-xl-2">
			{if isset($currency->prefix) && $currency->prefix }<span class="input-group-addon">{$currency->prefix}</span>{/if}
			<input maxlength="14" name="wholesale_price" id="wholesale_price" value="{$product->wholesale_price|string_format:'%.2f'}" onchange="this.value = this.value.replace(/,/g, '.');" type="text">
			{if isset($currency->suffix) && $currency->suffix }<span class="input-group-addon">{$currency->suffix}</span>{/if}
		</div>
	</div>

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="priceTE">
			<span  class="label-tooltip" data-toggle="tooltip" title="{l s='The pre-tax retail price to sell this product' mod='agilemultipleseller'}">
				{l s='Pre-tax retail price' mod='agilemultipleseller'} 
			</span>
		</label>
		<div class="input-group agile-col-md-4 agile-col-lg-2 agile-col-xl-2">
			<input id="priceTEReal" name="price" value="{$product->price}" type="hidden">
			{if isset($currency->prefix) && $currency->prefix }<span class="input-group-addon">{$currency->prefix}</span>{/if}
			<input maxlength="14" id="priceTE" name="price_displayed" type="text" value="{$product->price|string_format:'%.2f'}" onchange="noComma('priceTE'); $('#priceTEReal').val(this.value);" onkeyup="$('#priceType').val('TE'); $('#priceTEReal').val(this.value.replace(/,/g, '.')); if (isArrowKey(event)) return; calcPriceTI();" />
			{if isset($currency->suffix) && $currency->suffix }<span class="input-group-addon">{$currency->suffix}</span>{/if}
		</div>
	</div>

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="id_tax_rules_group">
			{l s='Tax rule' mod='agilemultipleseller'}</label>
		</label>
		<div class="agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<script type="text/javascript">
				noTax = {if $tax_exclude_taxe_option}true{else}false{/if};
				taxesArray = new Array();
				{foreach $taxesRatesByGroup as $tax_by_group}
					taxesArray[{$tax_by_group.id_tax_rules_group}] = {$tax_by_group|json_encode};
				{/foreach}
				ecotaxTaxRate = {$ecotaxTaxRate / 100};
			</script>
			<select onChange="javascript:calcPrice(); unitPriceWithTax('unit');" name="id_tax_rules_group" id="id_tax_rules_group" {if $tax_exclude_taxe_option}disabled="disabled"{/if} >
				<option value="0">{l s='No Tax' mod='agilemultipleseller'}</option>
				{foreach from=$tax_rules_groups item=tax_rules_group}
					<option value="{$tax_rules_group.id_tax_rules_group}" {if $product->getIdTaxRulesGroup() == $tax_rules_group.id_tax_rules_group}selected="selected"{/if} >
					{$tax_rules_group['name']|htmlentitiesUTF8}
					</option>
				{/foreach}
			</select>
		</div>
	</div>

	<div class="form-group " {if !$ps_use_ecotax} style="display:none;"{/if}>
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="ecotax">
			<span class="label-tooltip" data-toggle="tooltip" title="{l s='already included in price' mod='agilemultipleseller'}">
				{l s='Eco-tax (tax incl.)' mod='agilemultipleseller'}
			</span>
		</label>
		<div class="input-group agile-col-md-6 agile-col-lg-4 agile-col-xl-3">
			{if isset($currency->prefix) && $currency->prefix }<span class="input-group-addon">{$currency->prefix}</span>{/if}
			<input maxlength="14" id="ecotax" name="ecotax" type="text" value="{$product->ecotax|string_format:'%.2f'}" onkeyup="$('#priceType').val('TI');if (isArrowKey(event))return; calcPriceTE(); this.value = this.value.replace(/,/g, '.'); if (parseInt(this.value) > getE('priceTE').value) this.value = getE('priceTE').value; if (isNaN(this.value)) this.value = 0;" />
			{if isset($currency->suffix) && $currency->suffix }<span class="input-group-addon">{$currency->suffix}</span>{/if}
			<span class="input-group-addon">({l s='already included in price' mod='agilemultipleseller'})</span>
		</div>
	</div>

	<div class="form-group " {if !$country_display_tax_label || $tax_exclude_taxe_option}style="display:none"{/if}>
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="priceTI">{l s='Retail price with tax' mod='agilemultipleseller'}</label>
		<div class="input-group agile-col-md-4 agile-col-lg-2 agile-col-xl-2">
			<input id="priceType" name="priceType" value="TE" type="hidden">
			{if isset($currency->prefix) && $currency->prefix }<span class="input-group-addon">{$currency->prefix}</span>{/if}
			<input maxlength="14" id="priceTI" type="text" value="" onchange="noComma('priceTI');" onkeyup="$('#priceType').val('TI');if (isArrowKey(event)) return;  calcPriceTE();" />
			{if isset($currency->suffix) && $currency->suffix }<span class="input-group-addon">{$currency->suffix}</span>{/if}
		</div>
	</div>

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="unit_price">
			<span data-original-title="e.g. per lb." class="label-tooltip" data-toggle="tooltip" title="{l s='e.g.  per lb' mod='agilemultipleseller'}">
			{l s='Unit price' mod='agilemultipleseller'}
			</span>
		</label>
		<div class="input-group agile-col-md-8 agile-col-lg-6 agile-col-xl-6">
			{if isset($currency->prefix) && $currency->prefix }<span class="input-group-addon">{$currency->prefix}</span>{/if}
			<input maxlength="14" id="unit_price" name="unit_price" type="text" value="{$unit_price|string_format:'%.2f'}"
				onkeyup="if (isArrowKey(event)) return ;this.value = this.value.replace(/,/g, '.'); unitPriceWithTax('unit');"/>
			{if isset($currency->suffix) && $currency->suffix }<span class="input-group-addon">{$currency->suffix}</span>{/if}
			<span class="input-group-addon">{l s='/'  mod='agilemultipleseller'}</span>
			<input type ="text" name="unity" id="unity" value="{$product->unity}">
			{if $ps_tax && $country_display_tax_label}
				<span class="input-group-addon">{l s='or' mod='agilemultipleseller'}
					{$currency->prefix}<span id="unit_price_with_tax">0.00</span>{$currency->suffix}
					{l s='/'} <span id="unity_second">{$product->unity}</span> {l s='with tax' mod='agilemultipleseller'}
				</span>
			{/if}
		</div>
	</div>

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="on_sale">
			{l s='On sale' mod='agilemultipleseller'}
		</label>
		<div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
			<div class="checkbox">
				<label class="control-label" for="on_sale">
					<input name="on_sale" id="on_sale" {if $product->on_sale}checked="checked"{/if} value="1" type="checkbox">
					{l s='Display "on sale" icon on product page and text on product listing' mod='agilemultipleseller'}
				</label>
			</div>
		</div>
	</div>

	<div class="form-group ">
		<div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9 col-lg-offset-3">
			<div class="alert alert-success">
				<strong>{l s='Final retail price' mod='agilemultipleseller'}</strong>
				<span {if !$ps_tax}style="display:none"{/if}>
					{$currency->prefix}	
					<span id="finalPrice"></span>
					{$currency->suffix}
					<span> ({l s='tax incl.' mod='agilemultipleseller'})</span>
				</span>
				<span {if $ps_tax}style="display:none;"{/if}>
					{if $country_display_tax_label}
						/
					{/if}
					{$currency->prefix}	
					<span id="finalPriceWithoutTax"></span>
					{$currency->suffix}
					{if $country_display_tax_label}({l s='tax excl.' mod='agilemultipleseller'}){/if}</span>
				</span>
			</div>
		</div>
	</div>
	<div class="agile-padding"></div>

{if isset($specificPriceModificationForm)}
<div id="agile" class="panel ">
	<h3>{l s='Specific prices' mod='agilemultipleseller'}</h3>
	<div class="alert alert-info">
		{l s='You can set specific prices for clients belonging to different groups, different countries, etc.' mod='agilemultipleseller'}
	</div>
	<div class="form-group ">
		<div class="col-lg-12">
			<a class="agile-btn bt-icon" href="#" id="show_specific_price">
				<i class="icon-plus-sign"></i>&nbsp;{l s='Add a new specific price' mod='agilemultipleseller'}
			</a>
			<a class="agile-btn bt-icon" href="#" id="hide_specific_price" style="display:none">
				<i class="icon-remove text-danger"></i>&nbsp;{l s='Cancel new specific price' mod='agilemultipleseller'}
			</a>
		</div>
	</div>
	<script type="text/javascript">
		var product_prices = new Array();
		{foreach from=$combinations item='combination'}
			product_prices['{$combination.id_product_attribute}'] = '{$combination.price}';
		{/foreach}
	</script>
	<div id="add_specific_price" class="well clearfix" style="display: none;">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label agile-col-md-4 agile-col-lg-2 agile-col-xl-2" for="spm_currency_0">{l s='For' mod='agilemultipleseller'}</label>
				<div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<div class="row">
						{if !$multi_shop}
							<input type="hidden" name="sp_id_shop" value="0" />
						{else}
							<div class="agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
								<select name="sp_id_shop">
									<option value="0">{l s='All shops' mod='agilemultipleseller'}</option>
									{foreach from=$shops item=shop}
										<option value="{$shop.id_shop}">{$shop.name|htmlentitiesUTF8}</option>
									{/foreach}
								</select>
							</div>
						{/if}

						<div class="agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
							<select name="sp_id_currency" id="spm_currency_0" onchange="changeCurrencySpecificPrice(0);">
								<option value="0">{l s='All currencies' mod='agilemultipleseller'}</option>
								{foreach from=$currencies item=curr}
									<option value="{$curr.id_currency}">{$curr.name|htmlentitiesUTF8}</option>
								{/foreach}
							</select>
						</div>

						<div class="agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
							<select name="sp_id_country" id="sp_id_country">
								<option value="0">{l s='All countries' mod='agilemultipleseller'}</option>
								{foreach from=$countries item=country}
									<option value="{$country.id_country}">{$country.name|htmlentitiesUTF8}</option>
								{/foreach}
							</select>
						</div>
						<div class="agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
							<select name="sp_id_group" id="sp_id_group">
								<option value="0">{l s='All groups' mod='agilemultipleseller'}</option>
								{foreach from=$groups item=group}
									<option value="{$group.id_group}">{$group.name}</option>
								{/foreach}
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group ">
				<label class="control-label agile-col-md-4 agile-col-lg-2 agile-col-xl-2" for="customer">{l s='Customer' mod='agilemultipleseller'}</label>
				<div class="agile-col-md-6 agile-col-lg-4 agile-col-xl-4">
					<input name="sp_id_customer" id="id_customer" value="0" type="hidden">
					<div class="input-group">
						<input type="text" name="customer" value="{l s='All customers' mod='agilemultipleseller'}" id="customer" autocomplete="off" />
						<span class="input-group-addon"><i class="icon-search"></i></span>
					</div>
				</div>
				<img src="{$base_dir_ssl}img/admin/field-loader.gif" id="customerLoader" alt="{l s='Loading...' mod='agilemultipleseller'}" style="display: none;">
			</div>
			<div class="form-group">
				<div class="col-lg-10 agile-col-md-offset-4 agile-col-lg-offset-2 agile-col-xl-offset-2">
					<div id="customers"></div>
				</div>
			</div>

			<div class="form-group ">
				<label class="control-label agile-col-md-4 agile-col-lg-2 agile-col-xl-2" for="sp_id_product_attribute">{l s='Combination' mod='agilemultipleseller'}</label>
				<div class="agile-col-md-6 agile-col-lg-4 agile-col-xl-4">
					<select id="sp_id_product_attribute" name="sp_id_product_attribute">
					    <option value="0">{l s='Apply to all combinations' mod='agilemultipleseller'}</option>
					    {foreach from=$combinations item='combination'}
						    <option value="{$combination.id_product_attribute}">{$combination.attributes}</option>
					    {/foreach}
					</select>
				</div>
			</div>

			
			<div class="form-group ">
			<label class="control-label agile-col-md-4 agile-col-lg-2 agile-col-xl-2" for="sp_from">{l s='Available' mod='agilemultipleseller'}</label>
				<div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<div class="row">
						<div class="agile-col-md-6 agile-col-lg-4 agile-col-xl-4">
							<div class="input-group">
								<span class="input-group-addon">{l s='from' mod='agilemultipleseller'}</span>
								<input class="datepicker" type="text" name="sp_from" value="" style="text-align: center" id="sp_from" />
								<span class="input-group-addon"><i class="icon-calendar-empty"></i></span>
							</div>
						</div>
						<div class="agile-col-md-6 agile-col-lg-4 agile-col-xl-4">
							<div class="input-group">
								<span class="input-group-addon">{l s='to' mod='agilemultipleseller'}</span>
								<input class="datepicker" type="text" name="sp_to" value="" style="text-align: center" id="sp_to" />
								<span class="input-group-addon"><i class="icon-calendar-empty"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group ">
				<label class="control-label agile-col-md-4 agile-col-lg-2 agile-col-xl-2" for="sp_from_quantity">{l s='Starting at' mod='agilemultipleseller'}</label>
				<div class="input-group agile-col-md-6 agile-col-lg-4 agile-col-xl-4">
					<span class="input-group-addon">{l s='unit' mod='agilemultipleseller'}</span>
					<input name="sp_from_quantity" id="sp_from_quantity" value="1" type="text">
				</div>
			</div>

			<div class="form-group ">
				<label class="control-label agile-col-md-4 agile-col-lg-2 agile-col-xl-2" for="sp_price">{l s='Product price' mod='agilemultipleseller'}</label>
				<div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
					<div class="row">
						<div class="input-group agile-col-md-6 agile-col-lg-4 agile-col-xl-4">
							{if isset($currency->prefix) && $currency->prefix} <span class="input-group-addon">{$currency->prefix}</span> {/if}
							<input disabled="disabled" name="sp_price" id="sp_price" value="{$product->price}" type="text">
							{if isset($currency->suffix) && $currency->suffix} <span class="input-group-addon">{$currency->suffix}</span> {/if}
						</div>
						<div class="agile-col-md-8 agile-col-lg-8 agile-col-xl-8">
							<p class="checkbox">
							<label for="leave_bprice">Leave base price</label>
							<input id="leave_bprice" value="1" checked name="leave_bprice" type="checkbox">
							</p>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group ">
				<label class="control-label agile-col-md-4 agile-col-lg-2 agile-col-xl-2" for="sp_reduction">{l s='Apply a discount of' mod='agilemultipleseller'}</label>
				<div class="agile-col-md-6 agile-col-lg-4 agile-col-xl-4">
					<div class="row">
						<div class="agile-col-md-6 agile-col-lg-6 agile-col-xl-6">
							<input name="sp_reduction" id="sp_reduction" value="0.00" type="text">
						</div>
						<div class="agile-col-md-6 agile-col-lg-6 agile-col-xl-6">
							<select name="sp_reduction_type" id="sp_reduction_type">
								<option selected="selected">---</option>
								<option value="amount">{l s='Amount' mod='agilemultipleseller'}</option>
								<option value="percentage">{l s='Percentage' mod='agilemultipleseller'}</option>
							</select>
						</div>
					</div>
				</div>
				<div class="agile-col-md-6 agile-col-lg-4 agile-col-xl-4">
					<p class="help-block">The discount is applied after the tax</p>
				</div>
			</div>

		</div> <!-- col-lg-12 -->
	</div>
	<div class="table-responsive clearfix">
		<table id="specific_prices_list" class="table  configuration">
			<thead>
				<tr>
					<th>{l s='Rule' mod='agilemultipleseller'}</th>
					<th>{l s='Combination' mod='agilemultipleseller'}</th>
					{if $multi_shop}<th>{l s='Shop' mod='agilemultipleseller'}</th>{/if}
					<th>{l s='Currency' mod='agilemultipleseller'}</th>
					<th>{l s='Country' mod='agilemultipleseller'}</th>
					<th>{l s='Group' mod='agilemultipleseller'}</th>
					<th>{l s='Customer' mod='agilemultipleseller'}</th>
					<th>{l s='Fixed' mod='agilemultipleseller'}</th>
					<th>{l s='Impact' mod='agilemultipleseller'}</th>
					<th>{l s='Period' mod='agilemultipleseller'}</th>
					<th>{l s='From (quantity)' mod='agilemultipleseller'}</th>
					<th>{l s='Action' mod='agilemultipleseller'}</th>
				</tr>
			</thead>
			<tbody>
			{$specificPriceModificationForm}
	</div>
<!-- the end tags have been generated inside php file -->
	{/if}
	<div class="form-group  agile-align-center">
		<button type="submit" class="agile-btn agile-btn-default" name="submitSpecificPrices" value="{l s='Save' mod='agilemultipleseller'}">
		<i class="icon-save "></i>&nbsp;<span>{l s='Save' mod='agilemultipleseller'}</span></button >
	</div>

