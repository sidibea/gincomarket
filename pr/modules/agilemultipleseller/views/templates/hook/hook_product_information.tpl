	{if !$is_seller OR $approveal_required}<div class="separation"></div>{/if}
		{if $is_seller}
			<div class="form-group" stryle="display:none;">	
				<label class="control-label col-lg-3" for="id_seller">
				</label>
				<div class="col-lg-3">
					<input type="hidden" name="id_seller" value="$id_seller">
				</div>
			</div>
		{else}
			<div class="form-group">	
				<label class="control-label col-lg-3" for="id_seller">
					{l s='Seller' mod='agilemultipleseller'}
				</label>
				<div class="col-lg-3">
					<select name="id_seller" id="id_seller">
						{foreach from=$sellers item=seller}
							<option value="{$seller['id_seller']}" {if $id_seller== $seller['id_seller']}selected{/if}>{$seller['id_seller']} - {$seller['name']}</option>
						{/foreach}
					</select>
				</div>
			</div>
		{/if}
		{if $approveal_required}
			<div class="form-group">
				<label class="control-label col-lg-3" for="approved">
					<span class="label-tooltip" data-toggle="tooltip" title="" data-original-title="{l s='Indicates whether this product is approved for listing.  This field appears if [Listing Approval Required] is configured.' mod='agilemultipleseller'}">
						{l s='Listing Approved' mod='agilemultipleseller'}
					</span>
				</label>							
				<div class="col-lg-3">
					{if $is_seller}
						<input type="hidden" name="approved" id="approved" value="{if $approved}1{else}0{/if}" />
						<input type="checkbox" name="approved" id="approved" value="1" {if $approved}checked{/if} disabled="true"  />
					{else}
						<input type="checkbox" name="approved" id="approved" value="1" {if $approved}checked{/if} />
					{/if}
				</div>
			</div>
		{/if}
