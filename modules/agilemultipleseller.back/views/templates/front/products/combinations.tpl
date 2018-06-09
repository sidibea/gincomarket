{*
*}


{if isset($product->id) && !$product->is_virtual}
<div id="product-combinations" class="panel product-tab">
	<script type="text/javascript">
		var msg_combination_1 = "{l s='Please choose an attribute' mod='agilemultipleseller'}";
		var msg_combination_2 = "{l s='Please choose a value' mod='agilemultipleseller'}";
		var msg_combination_3 = "{l s='You can only add one combination per type of attribute' mod='agilemultipleseller'}";
		var msg_new_combination = "{l s='New combination' mod='agilemultipleseller'}";
		var msg_cancel_combination = '{l s='Cancel combination'  mod='agilemultipleseller'}';
		var attrs = new Array();
		var modifyattributegroup = "{l s='Modify this attribute combination.' mod='agilemultipleseller' js=1}";
		attrs[0] = new Array(0, "---");
		{foreach from=$attributeJs key=idgrp item=group}
			attrs[{$idgrp}] = new Array(0
			, '---'
			{foreach from=$group key=idattr item=attrname}
				, "{$idattr}", "{$attrname|addslashes}"
			{/foreach}
			);
		{/foreach}
		$(document).ready(function(){
			populate_attrs();
			$(".datepicker").datepicker({
				prevText: '',
				nextText: '',
				dateFormat: 'yy-mm-dd'
			});
		});
	</script>

	<input type="hidden" name="submitted_tabs[]" value="Combinations" />
	<script type="text/javascript">
		{$combinationImagesJs}
	
        var noTax = {if $tax_exclude_taxe_option}true{else}false{/if};
		taxesArray = new Array ();
		taxesArray[0] = 0;
		{foreach $tax_rules_groups as $tax_rules_group}
			{if isset($taxesRatesByGroup[$tax_rules_group['id_tax_rules_group']])}
			taxesArray[{$tax_rules_group.id_tax_rules_group}] = {$taxesRatesByGroup[$tax_rules_group['id_tax_rules_group']]};
				{else}
			taxesArray[{$tax_rules_group.id_tax_rules_group}] = 0;
			{/if}
		{/foreach}
        
        
		var attrs = new Array();
		var modifyattributegroup = "{l s='Modify this attribute combination'  mod='agilemultipleseller' js=1}";
		attrs[0] = new Array(0, "---");
	    {foreach from=$attributeJs key=idgrp item=group}
		    attrs[{$idgrp}] = new Array(0
		    , '---'
		    {foreach from=$group key=idattr item=attrname}
			    , "{$idattr}", "{$attrname|addslashes}"
		    {/foreach}
		    );
	    {/foreach}
	    
	    
	    add_new_combination_form_visible = {if count($errors)>0}true{else}false{/if};
        ajax_products_url = "{$base_dir_ssl}modules/agilemultipleseller/ajax_products.php";
	    function toggle_add_new_combination_form()
	    {
			attr_selectall();
	        if(add_new_combination_form_visible)
	        {
	            $("#add_new_combination").hide();
	            $("#brnCancelNewComb").hide();
	            $("#submitCombinations").hide();
	            $("#btnAddNewComb").show();
	        }
	        else
	        {
	            $("#add_new_combination").show();
	            $("#brnCancelNewComb").show();
	            $("#submitCombinations").show();
	            $("#btnAddNewComb").hide();
	        }    
	        add_new_combination_form_visible = !add_new_combination_form_visible;    
	    }
	    
	    function delete_comb(id_product,id_product_attribute)
	    {
	        if(confirm("{l s='Are sure want to delete this combination?' mod='agilemultipleseller' js=1}"))
	        {
				doFrontAjax(ajax_products_url,
				        {
						    "action":"deleteProductAttribute",
						    "id_product":id_product,
						    "id_product_attribute":id_product_attribute,
						    "ajax" : 1 
						}, 
						function(data)
						{
                            data = $.parseJSON(data);
						    alert(data.message);
						    $("#tr_comb_" + id_product_attribute).remove();
						}
				);
	        }
	    }
	    	    
	    function set_default_comb(id_product, id_product_attribute)
	    {
			doFrontAjax(ajax_products_url,
			        {
					    "action":"defaultProductAttribute",
					    "id_product":id_product,
					    "id_product_attribute":id_product_attribute,
					    "ajax" : 1 
					}, 
					function(data)
					{
                        data = $.parseJSON(data);
					    alert(data.message);
                        $("img[id^='icon_default_']").show();
                        $("#icon_default_" + id_product_attribute).hide();
					}
			);
	    
	    }
	    
	    
		function edit_comb (id_product, id_product_attribute)
		{
			$.ajax({
				url: ajax_products_url,
				type: "POST",
				data: {
					"id_product":id_product,
					"id_product_attribute":id_product_attribute,
					ajax: true,
					action: 'editProductAttribute'
				},
				dataType: 'json',
				async: false,
				success: function(data) {
					// color the selected line
					add_new_combination_form_visible = false;
                    toggle_add_new_combination_form();
					$('#attribute_quantity').show();
					var wholesale_price = Math.abs(data[0]['wholesale_price']);
					var price = Math.abs(data[0]['price']);
					var weight = Math.abs(data[0]['weight']);
					var unit_impact = Math.abs(data[0]['unit_price_impact']);
					var reference = data[0]['reference'];
					var ean = data[0]['ean13'];
					var quantity = data[0]['quantity'];
					var image = false;
					var product_att_list = new Array();
					for(i=0;i<data.length;i++)
					{
						product_att_list.push(data[i]['group_name']+' : '+data[i]['attribute_name']);
						product_att_list.push(data[i]['id_attribute']);
					}

					var id_product_attribute = data[0]['id_product_attribute'];
					var default_attribute = data[0]['default_on'];
					var eco_tax = data[0]['ecotax'];
					var upc = data[0]['upc'];
					var minimal_quantity = data[0]['minimal_quantity'];
					var available_date = data[0]['available_date'];

					if (wholesale_price != 0 && wholesale_price > 0)
					{
						$("#attribute_wholesale_price_full").show();
						$("#attribute_wholesale_price_blank").hide();
					}
					else
					{
						$("#attribute_wholesale_price_full").hide();
						$("#attribute_wholesale_price_blank").show();
					}
					fillCombination(
						wholesale_price,
						price,
						weight,
						unit_impact,
						reference,
						ean,
						quantity,
						image,
						product_att_list,
						id_product_attribute,
						default_attribute,
						eco_tax,
						upc,
						minimal_quantity,
						available_date
					);
					calcImpactPriceTI();
				}
			});
		}
	    
	    
	function fillCombination(wholesale_price, price_impact, weight_impact, unit_impact, reference,
	ean, quantity, image, old_attr, id_product_attribute, default_attribute, eco_tax, upc, minimal_quantity, available_date)
	{
		var link = '';
		init_elems();
		$('#stock_mvt_attribute').show();
		$('#initial_stock_attribute').hide();
		$('#attribute_quantity').html(quantity);
		$('#attribute_quantity').show();
		$('#attr_qty_stock').show();

		$('#attribute_minimal_quantity').val(minimal_quantity);

		getE('attribute_reference').value = reference;

		getE('attribute_ean13').value = ean;
		getE('attribute_upc').value = upc;
		getE('attribute_wholesale_price').value = Math.abs(wholesale_price);
		getE('attribute_price').value = ps_round(Math.abs(price_impact), 2);
		getE('attribute_priceTEReal').value = Math.abs(price_impact);
		getE('attribute_weight').value = Math.abs(weight_impact);
		getE('attribute_unity').value = Math.abs(unit_impact);
		if ($('#attribute_ecotax').length != 0)
			getE('attribute_ecotax').value = eco_tax;

		if (default_attribute == 1)
			getE('attribute_default').checked = true;
		else
			getE('attribute_default').checked = false;

		if (price_impact < 0)
		{
			getE('attribute_price_impact').options[getE('attribute_price_impact').selectedIndex].value = -1;
			getE('attribute_price_impact').selectedIndex = 2;
		}
		else if (!price_impact)
		{
			getE('attribute_price_impact').options[getE('attribute_price_impact').selectedIndex].value = 0;
			getE('attribute_price_impact').selectedIndex = 0;
		}
		else if (price_impact > 0)
		{
			getE('attribute_price_impact').options[getE('attribute_price_impact').selectedIndex].value = 1;
			getE('attribute_price_impact').selectedIndex = 1;
		}
		if (weight_impact < 0)
		{
			getE('attribute_weight_impact').options[getE('attribute_weight_impact').selectedIndex].value = -1;
			getE('attribute_weight_impact').selectedIndex = 2;
		}
		else if (!weight_impact)
		{
			getE('attribute_weight_impact').options[getE('attribute_weight_impact').selectedIndex].value = 0;
			getE('attribute_weight_impact').selectedIndex = 0;
		}
		else if (weight_impact > 0)
		{
			getE('attribute_weight_impact').options[getE('attribute_weight_impact').selectedIndex].value = 1;
			getE('attribute_weight_impact').selectedIndex = 1;
		}
		if (unit_impact < 0)
		{
			getE('attribute_unit_impact').options[getE('attribute_unit_impact').selectedIndex].value = -1;
			getE('attribute_unit_impact').selectedIndex = 2;
		}
		else if (!unit_impact)
		{
			getE('attribute_unit_impact').options[getE('attribute_unit_impact').selectedIndex].value = 0;
			getE('attribute_unit_impact').selectedIndex = 0;
		}
		else if (unit_impact > 0)
		{
			getE('attribute_unit_impact').options[getE('attribute_unit_impact').selectedIndex].value = 1;
			getE('attribute_unit_impact').selectedIndex = 1;
		}

		$("#add_new_combination").show();

		/* Reset all combination images */
		combinationImages = $('#id_image_attr').find("input[id^=id_image_attr_]");
		combinationImages.each(function() {
			this.checked = false;
		});

		/* Check combination images */
		
		if (typeof(combination_images[id_product_attribute]) != 'undefined')
			for (i = 0; i < combination_images[id_product_attribute].length; i++)
				$('#id_image_attr_' + combination_images[id_product_attribute][i]).attr('checked', true);
	    
		check_impact();
		check_weight_impact();
		check_unit_impact();

		var elem = getE('product_att_list');

		for (var i = 0; i < old_attr.length; i++)
		{
			var opt = document.createElement('option');
			opt.text = old_attr[i++];
			opt.value = old_attr[i];
			try {
				elem.add(opt, null);
			}
			catch(ex) {
				elem.add(opt);
			}
		}
		getE('id_product_attribute').value = id_product_attribute;

		$('#available_date_attribute').val(available_date);
	}
	
	init_elems = function()
	{
		var impact = getE('attribute_price_impact');
		var impact2 = getE('attribute_weight_impact');
		var elem = getE('product_att_list');

		if (elem.length)
			for (i = elem.length - 1; i >= 0; i--)
				if (elem[i])
					elem.remove(i);

		$('input[name="id_image_attr[]"]').each(function (){
			$(this).attr('checked', false);
		});

		$('#attribute_default').attr('checked', false);

		getE('attribute_price_impact').selectedIndex = 0;
		getE('attribute_weight_impact').selectedIndex = 0;
		getE('attribute_unit_impact').selectedIndex = 0;
		$('#span_unit_impact').hide();
		$('#unity_third').html($('#unity_second').html());

		if ($('#unity').is())
			if ($('#unity').get(0).value.length > 0)
				$('#tr_unit_impact').show();
			else
				$('#tr_unit_impact').hide();
		try
		{
			if (impact.options[impact.selectedIndex].value == 0)
				$('#span_impact').hide();
			if (impact2.options[impact.selectedIndex].value == 0)
				getE('span_weight_impact').style.display = 'none';
		}
		catch (e)
		{
			$('#span_impact').hide();
			getE('span_weight_impact').style.display = 'none';
		}
	}


	function select_all()
	{
		$("#product_att_list option").attr("selected","selected");
	}
	    
	</script>
	<h3>{l s='Add or modify combinations for this product.' mod='agilemultipleseller'}</h3>
	<select name="id_tax_rules_group" id="id_tax_rules_group" style="display:none;">
	    <option value="{$id_tax_rules_group}"></option>
	</select>
	<input type="hidden" name="id_product_attribute" id="id_product_attribute" value="0"/>
	
	{if isset($display_multishop_checkboxes) && $display_multishop_checkboxes}
		<br />
        {include file="$agilemultipleseller_views./templates/front/multishop/check_fields.tpl"}
	{/if}
	<div class="separation"></div>

	<div id="add_new_combination" class="panel" style="display: {if count($errors)>0}{else}none;{/if}">
		<div class="form-group ">
			<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="attribute_group">{l s='Attribute:' mod='agilemultipleseller'}</label>
			<div class="agile-col-md-5 agile-col-lg-5 agile-col-xl-5">
				<select name="attribute_group" id="attribute_group" onchange="populate_attrs();">
				{if isset($attributes_groups)}
					{foreach from=$attributes_groups key=k item=attribute_group}
					<option value="{$attribute_group.id_attribute_group}">{$attribute_group.name|escape:'html':'UTF-8'}&nbsp;&nbsp;</option>
					{/foreach}
				{/if}
				</select>
			</div>
		</div>

		<div class="row ">
			<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="attribute">{l s='Value:' mod='agilemultipleseller'}</label>
			<div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
				<div class="form-group ">
					<div class="agile-col-md-8 agile-col-lg-8 agile-col-xl-8 agile-margin-left3px">
						<select name="attribute" id="attribute">
							<option value="0">-</option>
						</select>
					</div>
					<div class="agile-col-md-4 agile-col-lg-4 agile-col-xl-4">
						<button type="button" class="agile-btn agile-btn-default btn-block" onclick="add_attr();"><i class="icon-plus-sign-alt"></i>&nbsp;{l s='Add' mod='agilemultipleseller'}</button>
					</div>
				</div>
				<div class="form-group ">
					<div class="agile-col-md-8 agile-col-lg-8 agile-col-xl-8 agile-margin-left3px">
						<select id="product_att_list" name="attribute_combination_list[]" multiple="multiple" ></select>
					</div>
					<div class="agile-col-md-4 agile-col-lg-4 agile-col-xl-4">
						<button type="button" class="agile-btn agile-btn-default btn-block" onclick="del_attr()"><i class="icon-minus-sign-alt"></i>&nbsp;{l s='Delete' mod='agilemultipleseller'}</button>
					</div>
				</div>
			</div>
		</div>
		<hr />

		<div class="form-group ">
			<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="attribute_reference">
				<span class="label-tooltip" data-toggle="tooltip"
					title="{l s='Special characters allowed:' mod='agilemultipleseller'} .-_#">
					{l s='Reference:' mod='agilemultipleseller'}
				</span>
			</label>
			<div class="agile-col-md-5 agile-col-lg-5 agile-col-xl-5">
				<input type="text" id="attribute_reference" name="attribute_reference" value="" />
			</div>
		</div>
		<div class="form-group ">
			<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="attribute_ean13">
				{l s='EAN13:' mod='agilemultipleseller'}
			</label>
			<div class="agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				<input maxlength="13" type="text" id="attribute_ean13" name="attribute_ean13" value="" />
			</div>
		</div>
		<div class="form-group ">
			<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="attribute_upc">
				{l s='UPC:' mod='agilemultipleseller'}
			</label>
			<div class="agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				<input maxlength="12" type="text" id="attribute_upc" name="attribute_upc" value="" />
			</div>
		</div>
		<hr />

		<div class="form-group ">
			<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="attribute_wholesale_price">
				{include file="$agilemultipleseller_views/templates/front/multishop/checkbox.tpl" field="attribute_wholesale_price" type="default"}
				<span class="label-tooltip" data-toggle="tooltip"
					title="{l s='Leave blank if the price does not change' mod='agilemultipleseller'}">
					{l s='Wholesale price:' mod='agilemultipleseller'}
				</span>
			</label>
			<div class="input-group agile-col-md-2 agile-col-lg-2 agile-col-xl-2">
				<span class="input-group-addon">
					{if $currency->format % 2 != 0}{$currency->sign}{/if}
					{if $currency->format % 2 == 0}{$currency->sign}{/if}
				</span>
				<input type="text" name="attribute_wholesale_price" id="attribute_wholesale_price" value="" onKeyUp="if (isArrowKey(event)) return ;this.value = this.value.replace(/,/g, '.');" />
			</div>
			<span style="display:none;" id="attribute_wholesale_price_full">({l s='Overrides wholesale price on "Information" tab' mod='agilemultipleseller'})</span>
		</div>

		<div class="form-group ">
			<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="attribute_price_impact">
				{include file="$agilemultipleseller_views/templates/front/multishop/checkbox.tpl" field="attribute_price_impact" type="attribute_price_impact"}
				{l s='Impact on price:' mod='agilemultipleseller'}
			</label>
			<div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
				<div class="row">
					<div class="agile-col-md-4 agile-col-lg-4 agile-col-xl-4 agile-padding-left4" >
						<select name="attribute_price_impact" id="attribute_price_impact" onchange="check_impact(); calcImpactPriceTI();">
							<option value="0">{l s='None' mod='agilemultipleseller'}</option>
							<option value="1">{l s='Increase' mod='agilemultipleseller'}</option>
							<option value="-1">{l s='Reduction' mod='agilemultipleseller'}</option>
						</select>
					</div>
					<div id="span_impact" class="agile-col-md-8 agile-col-lg-8 agile-col-xl-8" style="display:none;">
						<div class="row">
							<label class="control-label agile-col-md-1 agile-col-lg-1 agile-col-xl-1" for="attribute_price">
								{l s='of' mod='agilemultipleseller'}			
							</label>
							<div class="input-group agile-col-md-4 agile-col-lg-4 agile-col-xl-4">
								<div class="input-group-addon">
									{if $currency->format % 2 != 0}{$currency->sign}{/if}
									{if $currency->format % 2 == 0}{$currency->sign}{/if}
									{if $country_display_tax_label}{l s='(tax excl.)' mod='agilemultipleseller'}{/if}
								</div>
								<input type="hidden"  id="attribute_priceTEReal" name="attribute_price" value="0.00" />
								<input type="text" id="attribute_price" value="0.00" onkeyup="$('#attribute_priceTEReal').val(this.value.replace(/,/g, '.')); if (isArrowKey(event)) return ;this.value = this.value.replace(/,/g, '.'); calcImpactPriceTI();"/>
							</div>
							<label class="control-label agile-col-md-1 agile-col-lg-1 agile-col-xl-1" for="attribute_priceTI">
								{l s='or' mod='agilemultipleseller'}
							</label>
							<div class="input-group agile-col-md-5 agile-col-lg-5 agile-col-xl-5">
								<div class="input-group-addon" {if $tax_exclude_option}style="display:none"{/if}>
									{if $currency->format % 2 != 0}{$currency->sign}{/if}
									{if $currency->format % 2 == 0} {$currency->sign}{/if}
									{l s='(tax incl.)' mod='agilemultipleseller'}
								</div>
								<input type="text" name="attribute_priceTI" id="attribute_priceTI" value="0.00" onkeyup="if (isArrowKey(event)) return ;this.value = this.value.replace(/,/g, '.'); calcImpactPriceTE();"/>
							</div>
						</div>
						<div class="row">
							<div class="alert">
								{l s='final product price will be set to' mod='agilemultipleseller'}
								{if $currency->format % 2 != 0}{$currency->sign}{/if}
								<span id="attribute_new_total_price">0.00</span>
								{if $currency->format % 2 == 0}{$currency->sign}{/if}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="attribute_weight_impact">
			{include file="$agilemultipleseller_views/templates/front/multishop/checkbox.tpl" field="attribute_weight_impact" type="attribute_weight_impact"}
			{l s='Impact on weight:' mod='agilemultipleseller'}
		</label>
		<div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
			<div class="row">
				<div class="agile-col-md-4 agile-col-lg-4 agile-col-xl-4 agile-padding-left4">
					<select name="attribute_weight_impact" id="attribute_weight_impact" onchange="check_weight_impact();">
						<option value="0">{l s='None' mod='agilemultipleseller'}</option>
						<option value="1">{l s='Increase' mod='agilemultipleseller'}</option>
						<option value="-1">{l s='Reduction' mod='agilemultipleseller'}</option>
					</select>
				</div>
				<div id="span_weight_impact" class="agile-col-md-8 agile-col-lg-8 agile-col-xl-8" style="display:none;">
					<div class="row">
						<label class="control-label agile-col-md-1 agile-col-lg-1 agile-col-xl-1" for="attribute_weight">
							{l s='of' mod='agilemultipleseller'}
						</label>
						<div class="input-group agile-col-md-5 agile-col-lg-5 agile-col-xl-5">
							<div class="input-group-addon">
								{$ps_weight_unit}
							</div>
							<input type="text" name="attribute_weight" id="attribute_weight" value="0.00" onKeyUp="if (isArrowKey(event)) return ;this.value = this.value.replace(/,/g, '.');" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="tr_unit_impact" class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="attribute_unit_impact">
			{include file="$agilemultipleseller_views/templates/front/multishop/checkbox.tpl" field="attribute_unit_impact" type="attribute_unit_impact"}
			{l s='Impact on unit price :'  mod='agilemultipleseller'}
		</label>
		<div class="agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<select name="attribute_unit_impact" id="attribute_unit_impact" onchange="check_unit_impact();">
				<option value="0">{l s='None'  mod='agilemultipleseller'}</option>
				<option value="1">{l s='Increase'  mod='agilemultipleseller'}</option>
				<option value="-1">{l s='Reduction' mod='agilemultipleseller'}</option>
			</select>
		</div>
		<div id="span_unit_impact" class="col-lg-6" style="display:none;">
			<div class="row">
				<label class="control-label agile-col-md-1 agile-col-lg-1 agile-col-xl-1" for="attribute_unity">
					{l s='of' mod='agilemultipleseller'}
				</label>
				<div class="input-group agile-col-md-5 agile-col-lg-5 agile-col-xl-5">
					<div class="input-group-addon">
						{if $currency->format % 2 != 0}{$currency->sign}{/if}
						{if $currency->format % 2 == 0}{$currency->sign}{/if}
						/ <span id="unity_third">{$field_value_unity}</span>	
					</div>
				<input type="text" name="attribute_unity" id="attribute_unity" value="0.00" onKeyUp="if (isArrowKey(event)) return ;this.value = this.value.replace(/,/g, '.');" />
				</div>
			</div>
		</div>
	</div>

	{if $ps_use_ecotax}
		<div class="form-group ">
			<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="attribute_ecotax">
				{include file="$agilemultipleseller_views/templates/front/multishop/checkbox.tpl" field="attribute_ecotax" type="default"}
				<span class="label-tooltip" data-toggle="tooltip"
					title="{l s='overrides Eco-tax in the "Information" tab'  mod='agilemultipleseller'}">
					{l s='Eco-tax (tax excl.):' mod='agilemultipleseller'}
				</span>
			</label>
			<div class="input-group agile-col-md-2 agile-col-lg-2 agile-col-xl-2">
				<div class="input-group-addon">		
					{if $currency->format % 2 != 0}{$currency->sign}{/if}
					{if $currency->format % 2 == 0} {$currency->sign}{/if}
				</div>
				<input type="text" name="attribute_ecotax" id="attribute_ecotax" value="0.00" onKeyUp="if (isArrowKey(event)) return ;this.value = this.value.replace(/,/g, '.');" />
			</div>
		</div>
	{/if}

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="attribute_minimal_quantity">
			{include file="$agilemultipleseller_views/templates/front/multishop/checkbox.tpl" field="attribute_minimal_quantity" type="default"}
			<span class="label-tooltip" data-toggle="tooltip"
				title="{l s='The minimum quantity to buy this product (set to 1 to disable this feature)' mod='agilemultipleseller'}">
				{l s='Minimum quantity:' mod='agilemultipleseller'}
			</span>
		</label>
		<div class="input-group agile-col-md-2 agile-col-lg-2 agile-col-xl-2">
			<div class="input-group-addon">&times;</div>
			<input maxlength="6" name="attribute_minimal_quantity" id="attribute_minimal_quantity" type="text" value="{$minimal_quantity}" />
		</div>
	</div>

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="available_date_attribute">
			{include file="$agilemultipleseller_views/templates/front/multishop/checkbox.tpl" field="available_date_attribute" type="default"}
			<span class="label-tooltip" data-toggle="tooltip"
				title="{l s='The available date when this product is out of stock.'  mod='agilemultipleseller'}">
				{l s='Available date:'  mod='agilemultipleseller'}
			</span>
		</label>
		<div class="input-group agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			<input class="datepicker" id="available_date_attribute" name="available_date_attribute" value="{$available_date}" type="text" />
			<div class="input-group-addon">
				<i class="icon-calendar-empty"></i>
			</div>
		</div>
	</div>
	<hr/>

	<div class="form-group ">
	<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3">{l s='Image:'  mod='agilemultipleseller'}</label>
		<div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
			<ul id="id_image_attrff" class="list-inline">
				{foreach from=$images key=k item=image}
					<li>
						<input type="checkbox" name="id_image_attr[]" value="{$image.id_image}" id="id_image_attr_{$image.id_image}" />
						<label for="id_image_attr_{$image.id_image}">
							<img src="{$smarty.const._THEME_PROD_DIR_}{$image.obj->getExistingImgPath()}-small_default.jpg" alt="{$image.legend|escape:'html':'UTF-8'}" title="{$image.legend|escape:'html':'UTF-8'}" />
						</label>
					</li>
				{/foreach}
			</ul>
		</div>
	</div>

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="attribute_default">
			{include file="$agilemultipleseller_views/templates/front/multishop/checkbox.tpl" field="attribute_default" type="attribute_default"}
			{l s='Default:'  mod='agilemultipleseller'}
		</label>
		<div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
			<p class="checkbox">
				<label for="attribute_default">
					<input type="checkbox" name="attribute_default" id="attribute_default" value="1" />
					{l s='Make this combination the default combination for this product' mod='agilemultipleseller'}
				</label>
			</p>
		</div>
	</div>

	</div>  <!-- End of add_new_combination -->
	<div class="panel-footer">
		<span id="ResetSpan">
			<button type="reset" name="brnCancelNewComb" id="brnCancelNewComb"  style="display:{if count($errors)>0}{else}none;{/if};" onclick="javascript:toggle_add_new_combination_form();" class="agile-btn agile-btn-default">
				<i class="icon-undo"></i>&nbsp;{l s='Cancel modification' mod='agilemultipleseller'}
			</button>
		</span>
		<span id="SaveSpan">
			<button type="submit" name="submitCombinations" id="submitCombinations"  style="display:{if count($errors)>0}{else}none;{/if};" class="agile-btn agile-btn-default">
				<i class="icon-save"></i>&nbsp;{l s='Save' mod='agilemultipleseller'}
			</button>
		</span>
		<span id="NewSpan">
			<button type="button" name="btnAddNewComb" id="btnAddNewComb" style="display:{if count($errors)==0}{else}none;{/if}" name="brnAddComb" onclick="javascript:toggle_add_new_combination_form()" value="{l s='New combination' mod='agilemultipleseller'}" />
				<i class="icon-plus-sign-alt"></i>&nbsp;{l s='New combination' mod='agilemultipleseller'}
			</button>
		</span>
	</div>
</div>  <!-- End of Panel -->
<br>
<div class="panel">
	<div class="table-responsive clearfix">
		<table id="combinations-list" class="table  configuration">
			<thead>
				<tr class="nodrag nodrop">
					<th class="center fixed-width-xs"></th>
					<th class=" left"><span class="title_box ">{l s='Attributes' mod='agilemultipleseller'}</span></th>
					<th class=" left"><span class="title_box ">{l s='Impact' mod='agilemultipleseller'}</span></th>
					<th class=" left"><span class="title_box ">{l s='Weight' mod='agilemultipleseller'}</span></th>
					<th class=" left"><span class="title_box ">{l s='Reference' mod='agilemultipleseller'}</span></th>
					<th class=" left"><span class="title_box ">{l s='EAN13' mod='agilemultipleseller'}</span></th>
					<th class=" left"><span class="title_box ">{l s='UPC' mod='agilemultipleseller'}</span></th>
					<th class=" left"><span class="title_box ">{l s='Actions' mod='agilemultipleseller'}</span></th>
				</tr>
			</thead>
            <tbody>
		    {foreach from=$combinationArray key=k item=comb}
				<tr id="tr_comb_{$k}" {if isset($comb.default_on) && $comb.default_on} highlighted{/if}  ">
					<td class="text-center"></td>
					<td class="left">{$k}-{$comb.attributes}</td>
					<td class="left">{$comb.price}</td>
					<td class="left">{$comb.weight}</td>
					<td class="left">{$comb.reference}</td>
					<td class="left">{$comb.ean13}</td>
					<td class="left">{$comb.upc}</td>
					<td class="left">
						<img src="{$base_dir_ssl}img/admin/edit.gif"  style="cursor:pointer;" onclick="edit_comb({$product->id},{$k})" title="{l s='Edit' mod='agilemultipleseller'}" />
						<img src="{$base_dir_ssl}img/admin/delete.gif"  style="cursor:pointer;" onclick="delete_comb({$product->id},{$k})" title="{l s='Delete' mod='agilemultipleseller'}"/>
						<img src="{$base_dir_ssl}img/admin/asterisk.gif" style="cursor:pointer;display:{if $comb.default_on}none;{/if}" id="icon_default_{$k}" onclick="set_default_comb({$product->id},{$k})" title="{l s='Default' mod='agilemultipleseller'}" />
					</td>
				</tr>
            {/foreach}	
	    </table>
	</div>
{elseif $product->is_virtual}
<div id="product-combinations" class="panel product-tab">
	<h3>{l s='Add or modify combinations for this product.' mod='agilemultipleseller'}</h3>
	<div id="error_edit_file" class="alert alert-danger">
		{l s='You cannot edit your file here because it is a virtual product. Please edit it in the Virtual Product tab' mod='agilemultipleseller'}
	</div>
</div>
{/if}
