{*
*}

<script type="text/javascript">
	var base_dir_ssl = "{$base_dir_ssl}";
</script>

<div id="product-associations" class="panel product-tab">
	<h3>{l s='Associations' mod='agilemultipleseller'}</h3>
	<div id="no_default_category" class="alert alert-info">
		{l s='Please select a default category.' mod='agilemultipleseller'}
	</div>

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="category_block">
			{l s='Associated categories' mod='agilemultipleseller'}	
		</label>
		<div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
			<div id="category_block"><div class="panel">{$category_tree}</div></div>
		</div>
	</div>

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="id_category_default">
			<span class="label-tooltip" data-toggle="tooltip" title="{l s='The default category is the category displayed by default.' mod='agilemultipleseller'}">
				{l s='Default category' mod='agilemultipleseller'}
			</span>
		</label>
		<div class="agile-col-md-5 agile-col-lg-5 agile-col-xl-5">
			<select id="id_category_default" name="id_category_default">
				{foreach from=$selected_cat item=cat}
					<option value="{$cat.id_category}" {if $id_category_default == $cat.id_category}selected="selected"{/if} >{$cat.name}</option>
				{/foreach}
			</select>
			{if $agile_ms_edit_category}
			<span> <input type="text" name="new_category" id="id_new_category">&nbsp;<== &nbsp;{l s='New subcategory under' mod='agilemultipleseller'}:&nbsp;</span>
			{/if}
		</div>
	</div>

	{if $feature_shop_active}
		<div class="form-group ">
			<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" >
				{l s='Shop association' mod='agilemultipleseller'}	
			</label>
			<div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
				<div id="feature_shop_active">{$displayAssoShop}</div>
			</div>
		</div>
	{/if}

	<div class="form-group ">
		<label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3" for="product_autocomplete_input">
			<span class="label-tooltip" data-toggle="tooltip"
			title="{l s='Begin typing the first letters of the product name, then select the product from the drop-down list.'  mod='agilemultipleseller'}{l s='(Do not forget to save the product afterward)' mod='agilemultipleseller'}">
			{l s='Accessories' mod='agilemultipleseller'}	
			</span>
		</label>
		<div class="agile-col-md-5 agile-col-lg-5 agile-col-xl-5">
			<input type="hidden" name="inputAccessories" id="inputAccessories" value="{foreach from=$accessories item=accessory}{$accessory.id_product}-{/foreach}" />
			<input type="hidden" name="nameAccessories" id="nameAccessories" value="{foreach from=$accessories item=accessory}{$accessory.name|htmlentitiesUTF8}¤{/foreach}" />
			<div id="ajax_choose_product">
				<div class="input-group">
					<input class="form-control" class="ac_input" autocomplete="off" type="text" value="" id="product_autocomplete_input" />
					<span class="input-group-addon"><i class="icon-search"></i></span>
				</div>
			</div>
			<div id="divAccessories">
				{* @todo : donot use 3 foreach, but assign var *}
				{foreach from=$accessories item=accessory}
					{$accessory.name|htmlentitiesUTF8}{if !empty($accessory.reference)}{$accessory.reference}{/if} 
					<span onclick="delAccessory({$accessory.id_product});" style="cursor: pointer;">
					<img src="{$base_dir_ssl}img/admin/delete.gif" class="middle" alt="" />
					</span><br />
				{/foreach}
			</div>
		</div>
	</div>
	<div class="agile-padding"> </div>
	<div class="panel-footer  agile-align-center" id="toolbar-footer">
		<button type="submit" class="agile-btn agile-btn-default" name="submitAssociations" value="{l s='Save' mod='agilemultipleseller'}">
		<i class="icon-save "></i>&nbsp;<span>{l s='Save' mod='agilemultipleseller'}</span></button >
	</div>
</div>

