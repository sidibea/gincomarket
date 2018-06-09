{*
 This source file is subject to the Software License Agreement that is bundled with this 
 package in the file license.txt, or you can get it here
 http://addons-modules.com/en/content/3-terms-and-conditions-of-use

 @copyright  2009-2013 Addons-Modules.com
*}
<script>
$(document).ready(function() {
		$("#addCarrier").on('click', function() {
			$('#availableCarriers option:selected').each( function() {
	                $('#selectedCarriers').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
	            $(this).remove();
	        });
	        $('#selectedCarriers option').prop('selected', true);
		});

		$("#removeCarrier").on('click', function() {
			$('#selectedCarriers option:selected').each( function() {
	            $('#availableCarriers').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
	            $(this).remove();
	        });
			$('#selectedCarriers option').prop('selected', true);
		});
});

</script>

<div id="product-shipping" class="panel product-tab">
	<input type="hidden" name="submitted_tabs[]" value="Shipping" />
	<h3>{l s='Shipping' mod='agilemultipleseller'}</h3>

	{if isset($display_common_field) && $display_common_field}
		<div class="alert alert-info">{l s='Warning, if you change the value of fields with an orange bullet %s, the value will be changed for all other shops for this product' sprintf=$bullet_common_field mod='agilemultipleseller'}</div>
	{/if}

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="width">{$bullet_common_field} {l s='Width (package):' mod='agilemultipleseller'}</label>
		<div class="input-group agile-col-md-4 agile-col-lg-3 agile-col-xl-2">
			<span class="input-group-addon">{$ps_dimension_unit}</span>
			<input maxlength="14" id="width" name="width" type="text" value="{if $product->width>0}{$product->width}{/if}" onKeyUp="if (isArrowKey(event)) return ;this.value = this.value.replace(/,/g, '.');" />			
		</div>
	</div>

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="height">{$bullet_common_field} {l s='Height (package):' mod='agilemultipleseller'}</label>
		<div class="input-group agile-col-md-4 agile-col-lg-3 agile-col-xl-2">
			<span class="input-group-addon">{$ps_dimension_unit}</span>
			<input maxlength="14" id="height" name="height" type="text" value="{if $product->height>0}{$product->height}{/if}" onKeyUp="if (isArrowKey(event)) return ;this.value = this.value.replace(/,/g, '.');" />
		</div>
	</div>

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="depth">{$bullet_common_field} {l s='Depth (package):' mod='agilemultipleseller'}</label>
		<div class="input-group agile-col-md-4 agile-col-lg-3 agile-col-xl-2">
			<span class="input-group-addon">{$ps_dimension_unit}</span>
			<input maxlength="14" id="depth" name="depth" type="text" value="{if $product->depth>0}{$product->depth}{/if}" onKeyUp="if (isArrowKey(event)) return ;this.value = this.value.replace(/,/g, '.');" />
		</div>
	</div>

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="weight">{$bullet_common_field} {l s='Weight (package):' mod='agilemultipleseller'}</label>
		<div class="input-group agile-col-md-4 agile-col-lg-3 agile-col-xl-2">
			<span class="input-group-addon">{$ps_weight_unit}</span>
			<input maxlength="14" id="weight" name="weight" type="text" value="{if $product->weight>0}{$product->weight}{/if}" onKeyUp="if (isArrowKey(event)) return ;this.value = this.value.replace(/,/g, '.');" />
		</div>
	</div>

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="additional_shipping_cost">
			<span class="label-tooltip" data-toggle="tooltip"
				title="{l s='A carrier tax will be applied.' mod='agilemultipleseller'}">
				{l s='Additional shipping cost (per quantity):' mod='agilemultipleseller'}
			</span>
			
		</label>
		<div class="input-group agile-col-md-4 agile-col-lg-3 agile-col-xl-2">
			<span class="input-group-addon">{$currency->prefix}{$currency->suffix} {if $country_display_tax_label}({l s='tax excl.' mod='agilemultipleseller'}){/if}</span>
			<input type="text" id="additional_shipping_cost" name="additional_shipping_cost" onchange="this.value = this.value.replace(/,/g, '.');" value="{$product->additional_shipping_cost|htmlentities}" />
		</div>
	</div>

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="availableCarriers">{l s='Carriers:'  mod='agilemultipleseller'}</label>
		<div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
			<div class="form-control-static row">
				<div class="agile-agile-col-md-6 agile-col-lg-6 agile-col-xl-6 agile-padding-left4">
					<p>{l s='Available carriers'  mod='agilemultipleseller'}</p>
					<select multiple id="availableCarriers" name="availableCarriers">
						{foreach $carrier_list as $carrier}
							{if !isset($carrier.selected) || !$carrier.selected}
								<option value="{$carrier.id_reference}">{$carrier.name}</option>
							{/if}
						{/foreach}
					</select>
					<a href="#" id="addCarrier" class="agile-btn agile-btn-default btn-block">{l s='Add'  mod='agilemultipleseller'}&nbsp;<i class="icon-arrow-right"></i></a>
				</div>
				<div class="agile-agile-col-md-6 agile-col-lg-6 agile-col-xl-6">
					<p>{l s='Selected carriers' mod='agilemultipleseller'}</p>
					<select multiple id="selectedCarriers" name="carriers[]">
						{foreach $carrier_list as $carrier}
							{if isset($carrier.selected) && $carrier.selected}
								<option value="{$carrier.id_reference}">{$carrier.name}</option>
							{/if}
						{/foreach}
					</select>
					<a href="#" id="removeCarrier" class="agile-btn agile-btn-default btn-block"><i class="icon-arrow-left"></i>&nbsp;{l s='Remove' mod='agilemultipleseller'}</a>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group agile-align-center">
		<button type="submit" class="agile-btn agile-btn-default" name="submitShipping" value="{l s='Save' mod='agilemultipleseller'}">
		<i class="icon-save"></i>&nbsp;<span>{l s='Save' mod='agilemultipleseller'}</span></button >
   </div>
</div>
{* The selected carrier id in V1.5 is carriers_restriction *}
