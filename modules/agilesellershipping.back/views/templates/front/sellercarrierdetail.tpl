{capture name=path}<a href="{$link->getPageLink('my-account', true)}">{l s='My Account' mod='agilesellershipping'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='My Seller Account'  mod='agilesellershipping'}{/capture}
<div id="agile">
<h1>{l s='My Seller Account' mod='agilesellershipping'}</h1>
{include file="$agilemultipleseller_views./templates/front/seller_tabs.tpl"}
{include file="$tpl_dir./errors.tpl"}
<script type="text/javascript">
	var id_carrier = {$id_carrier};
	
	function shippingchange()
	{
		if($("input[id='is_free_on']").attr('checked') == 'checked')
		{
			$('div.shipping_panel').hide();
			$('div.submitNext').hide();
			$('div.submitSave').show();
		} else
		{
			$('div.submitNext').show();
			$('div.submitSave').hide();
			$('div.shipping_panel').show();
		}
	}

	$('document').ready(function() {
		shippingchange();
		$(":input").focus(function(){
			/** _agile_ alert("??"); _agile_ **/
		});
	});
	
</script>
{if isset($isSeller) AND $isSeller AND ($hasOwnerShip OR $isSharedCarrier)}
 	<div class="row">
		<h3><span class="agile-pull-right">
		<a  class="agile-btn agile-btn-default" href="{$link->getModuleLink('agilesellershipping', 'sellercarriers', ['process' =>'carriers'], true)}">
		<i class="icon-th-list"></i>{l s=' Back to list ' mod='agilesellershipping'}
		</a>
		</span></h3>
	</div>
    <form action="{$link->getModuleLink('agilesellershipping', 'sellercarrierdetail', ['process' =>'carrierdetail','id_carrier'=>$id_carrier], true)}" enctype="multipart/form-data" method="post" class="std">
	<div id="fieldset_carrier" class="panel">
		<div class="form-group ">
			<label for="name" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required">
				{l s='Company' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
						<input type="text" name="name" id="name" value="{$carrier->name}" size="25" />
						<p class="help-block">
						  <p><sup>*</sup>{l s='Allowed characters: letters, spaces and ().-' mod='agilesellershipping'}</p>
						  <p>{l s='The carrier\'s name will be displayed during checkout.For in-store pickup, enter 0 to replace the carrier name with your shop name.' mod='agilesellershipping'}</p>
						</p>
					</div>
				</div>
			</div>
		</div>

		{if $logo_set}
			<div class="form-group ">
				<label for="carrier_logo" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3""></label>
				<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<div class="row">
						<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
							<img name="carrier_logo" src="{$content_dir|addslashes}img/s/{$id_carrier}.jpg" />
						</div>
					</div>
				</div>
			</div>
		{/if}

		<div class="form-group ">
			<label for="logo" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3" ">
				{l s='Logo' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
						<input type="file" name="logo" value="" size="40"/><input id="logo" name="logo" value="" type="hidden">
						<p class="help-block">
							<p>{l s='Upload a logo from your computer (.gif, .jpg, .jpeg or .png)' mod='agilesellershipping'}</p>
						</p>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3 required" for="delay_{$default_language}">
				{l s='Transit time' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				{include file="$agilemultipleseller_views/templates/front/products/input_text_lang.tpl"
					languages=$languages
					input_value=$carrier->delay
					input_name='delay'
				}
				<p class="help-block">
					<p>{l s='Estimated delivery time, displayed during checkout' mod='agilesellershipping'}</p>
				</p>
			</div>
		</div>

		<div class="form-group ">
			<label for="grade" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				{l s='Speed Grade' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
						<input type="text" name="grade" id="grade" value="{$carrier->grade}" size="1" />
						<p class="help-block">
						  <p>{l s='0 for a longest shipping delay,9 for the shortest shipping delay.' mod='agilesellershipping'}</p>
						</p>
					</div>
				</div>
			</div>
		</div>
							
		<div class="form-group ">
			<label for="url" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				{l s='Tracking URL' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
						<input type="text" name="url" id="url" value="{$carrier->url}" size="40" />
						<p class="help-block">
						  <p>{l s='Delivery tracking URL; type \'@\' where the tracking number will appear, it will be automatically replaced by the tracking number' mod='agilesellershipping'}</p>
						</p>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group ">
			<label for="groupBox[]" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
			{l s='Group access' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
						{foreach $groups AS $group}
						<div class="checkbox">
							<label>
								<input type="checkbox" name="groupBox[]" id="group_{$group.id_group}" class="groupBox" value="{$group.id_group}" {if in_array($group.id_group, $carrier_groups_ids) || ($carrier->id == 0 && $isCarrierInitial ==1) || (isset($smarty.post.groupBox) && in_array($group.id_group, $smarty.post.groupBox))}checked="checked"{/if} />
							{$group.name}(Id:{$group.id_group})
							</label>
						</div>
						{/foreach}
						<p class="help-block">
							{l s='Mark all groups for which you want to give access to this carrier' mod='agilesellershipping'}	
						</p>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group ">
			<label for="active" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				{l s='Status' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
						<div class="radio" >
							<label>
								<input type="radio" name="active" id="active" value="1" {if $carrier->active}checked="checked" {/if} />
								{l s='Enabled' mod='agilesellershipping'}
							</label>
						</div>
						<div class="radio" >
							<label>
								<input type="radio" name="active" id="inactive" value="0" {if !$carrier->active}checked="checked"{/if} />
								{l s='Disabled' mod='agilesellershipping'}
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group ">
			<label for="is_free" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				{l s='Apply shipping cost' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
						<div class="radio">
							<label>
								<input type="radio" name="is_free" id="is_free_on" value="1" {if $carrier->is_free}checked="checked" {/if} />
								{l s='Do not apply' mod='agilesellershipping'}
							</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="agile-col-sm-12 agile-col-md-12 agile-col-lg-12 agile-col-xl-12">
						<div class="radio">
							<label>
							<input type="radio" name="is_free" id="is_free_off" value="0" {if !$carrier->is_free}checked="checked"{/if} />
							{l s='Apply both regular shipping cost and product-specific additional shipping costs' mod='agilesellershipping'}
							</label>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					$("input[name='is_free']").change(function(){
						shippingchange();
					});
				</script>
			</div>
		</div>

		<div class="form-group shipping_panel">
			<label for="id_tax_rules_group" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				{l s='Tax' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
						<select name="id_tax_rules_group" id="id_tax_rules_group">
							{foreach $taxes AS $tax}
								<option value="{$tax['id_tax_rules_group']}" {if $carrier->getIdTaxRulesGroup() == $tax['id_tax_rules_group']}selected="selected"{/if}>{$tax['name']}</option>
							{/foreach}
						</select>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group shipping_panel">
			<label for="shipping_handling" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				{l s='Shipping & handling' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
						<div class="radio">
							<label>
								<input type="radio" name="shipping_handling" id="shipping_handling_on" value="1" {if $carrier->shipping_handling}checked="checked" {/if} />
								{l s='Include the shpping & handling costs in carrier price' mod='agilesellershipping'}
							</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="agile-col-sm-12 agile-col-md-12 agile-col-lg-12 agile-col-xl-12">
						<div class="radio">
							<label>
							<input type="radio" name="shipping_handling" id="shipping_handling_off" value="0" {if !$carrier->shipping_handling}checked="checked"{/if} />
							{l s='Exclude the shpping & handling costs in carrier price' mod='agilesellershipping'}
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group ">
			<label for="shipping_method" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				{l s='Billing' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
			 	{foreach $billings AS $billing}
				<div class="row">
					<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
						<div class="radio">
							<label>
								<input type="radio" name="shipping_method" id="{$billing.id}" value="{intval($billing.value)}" {if $carrier->shipping_method == intval($billing['value'])}checked="checked"{/if} />
								{$billing.label}
							</label>
						</div>
					</div>
				</div>
				{/foreach}	
			</div>
		</div>

		<div class="form-group ">
			<label for="range_behavior" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				{l s='Out-of-range behavior' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
						<select name="range_behavior" id="range_behavior">
							{foreach $range_behaviors AS $range_behavior}
								<option value="{$range_behavior['id']}" {if $carrier->range_behavior == $range_behavior['id']}selected="selected"{/if}>{$range_behavior['name']}</option>
							{/foreach}
						</select>
						<p class="help-block">
							{l s='Out-of-range behavior when none is defined (e.g. when a customer\'s cart weight is greater than the highest range limit)' mod='agilesellershipping'}	
						</p>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group ">
			<label for="max_height" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				{l s='Maximum package height (in)' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
						<input type="text" name="max_height" id="max_height" value="{$carrier->max_height}" size="10" />
						<p class="help-block">
						  <p>{l s='Maximum height managed by this carrier. Set the value to 0 or leave this field blank to ignore. The value must be an integer.' mod='agilesellershipping'}</p>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group ">
			<label for="max_width" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				{l s='Maximum package width (in)' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
						<input type="text" name="max_width" id="max_width" value="{$carrier->max_width}" size="10"	/>
						<p class="help-block">
						  <p>{l s='Maximum width managed by this carrier. Set the value to 0, or leave this field blank to ignore. The value must be an integer.' mod='agilesellershipping'}</p>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group ">
			<label for="max_depth" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				{l s='Maximum package depth (in)' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
						<input type="text" name="max_depth" id="max_depth" value="{$carrier->max_depth}" size="10"	/>
						<p class="help-block">
						  <p>{l s='Maximum depth managed by this carrier. Set the value to 0 or leave this field blank to ignore. The value must be an integer.' mod='agilesellershipping'}</p>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group ">
			<label for="max_weight" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				{l s='Maximum package weight (kg)' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
				<div class="row">
					<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
						<input type="text" name="max_weight" id="max_weight" value="{$carrier->max_weight}" size="10" />
						<p class="help-block">
						  <p>{l s='Maximum weight managed by this carrier. Set the value to 0 or leave this field blank to ignore.' mod='agilesellershipping'}</p>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group ">
			<label class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
				{l s='Zone' mod='agilesellershipping'}
			</label>
			<div class="agile-col-sm-8 agile-col-md-8 agile-col-lg-8 agile-col-xl-8">
				<div class="row">
					<div class="agile-zone-section agile-col-sm-12 agile-col-md-12 agile-col-lg-12 agile-col-xl-12">
						{foreach $zones AS $zone}	
						<div class="checkbox agile-zone-item">
							<label>
							    <input type="checkbox" name="zone_{$zone.id_zone}" id="zone_{$zone.id_zone}"  class="comparator" {if in_array($zone.id_zone, $zone_ids)}checked="checked"{/if} />&nbsp;{$zone.name}
							</label>
						</div>
						{/foreach}
						<div class="clearfix"></div>
						<p class="help-block">
							{l s='The zones in which this carrier is to be used' mod='agilesellershipping'}	
						</p>
					</div>
				</div>
			</div>
		</div>

		<!--  agilecashondelivery  -->        {if $enableCashOnDelivery == true}
			<div class="form-group ">
				<label for="active" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
					{l s='Cod Status' mod='agilesellershipping'}
				</label>
				<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<div class="row">
						<div class="agile-col-sm-10 agile-col-md-10 agile-col-lg-10 agile-col-xl-10">
							<div class="radio" >
								<label>
									<input type="radio" name="COD_support" id="COD_support_on" value="1" {if $support_cod}checked="checked" {/if} />
									{l s='Enabled' mod='agilesellershipping'}
								</label>
							</div>
							<div class="radio" >
								<label>
									<input type="radio" name="COD_support" id="COD_support_off" value="0" {if !$support_cod}checked="checked"{/if} />
									{l s='Disabled' mod='agilesellershipping'}
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
            <div class="form-group ">
				<label for="active" class="control-label agile-col-sm-3 agile-col-md-3 agile-col-lg-3 agile-col-xl-3">
					{l s='' mod='agilesellershipping'}
				</label>
				<div class="agile-col-sm-7 agile-col-md-7 agile-col-lg-7 agile-col-xl-7">
					<input type="hidden" id="configureCodSettings" value="{$base_url}">				</div>
			</div>
        {/if}
        <!--  agilecashondeliveryend  -->		


		{*$default_language*}
		<script type="text/javascript">
			hideOtherLanguage({$default_language});
		</script>

		{if $hasOwnerShip}
		<div class="form-group agile-align-center">
			<div class="submitSave clearfix">
				<button type="submit" class="agile-btn agile-btn-default" name="submitAdd" value="{l s='Save' mod='agilesellershipping'}">
				<i class="icon-save"></i> <span>{l s='Save' mod='agilesellershipping'}</span></button>
			</div>
			<div class="submitNext clearfix">
				<button type="submit" class="agile-btn agile-btn-default" name="submitNext" value="{l s='Save & Price Setting' mod='agilesellershipping'}">
				<i class="icon-save"></i> <span>{l s='Save & Price Setting' mod='agilesellershipping'}</span></button>
			</div>
		</div>
		{else}
		<div class="alert alert-warning">
			{l s='This is a shared carrier, you do not have permission to edit it.' mod='agilesellershipping'}
			<a style="color:blue;text-decoration:underline;" href="{$link->getModuleLink('agilesellershipping', 'sellercarrierranges', ['process' =>'carrierdetail','id_carrier'=>$id_carrier], true)}">{l s='See Shipping Fee Details' mod='agilesellershipping'}</a>
		</div>
		{/if}
																	
	</div> <!-- End of panel -->
	</form>
{/if} 
</div> <!-- end of agile -->
{include file="$agilemultipleseller_views./templates/front/seller_footer.tpl"}

