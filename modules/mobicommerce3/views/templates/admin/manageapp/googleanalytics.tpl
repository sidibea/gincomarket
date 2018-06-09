{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<input type="hidden" value="GoogleAnalytics" name="process_action" />

<div class="form-group">
	<div class="col-lg-9">
	<strong>{l s='Configure google analytics to track results and keep records of how your app is performing.'}</strong>
   </div>
</div>

<div class="panel">
	<div class="panel-heading">
       	{l s='Android'} 
	</div>
	<div class="form-wrapper">
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable Android Analytics :'}</label>
			<div class="col-lg-3">
				<select name="analyticsSettings[android][status]">
					<option {if isset($analyticsSettings['android']['status']) && $analyticsSettings['android']['status'] == "1"}selected="selected"{/if} value="1">{l s='Yes'}</option>
					<option {if isset($analyticsSettings['android']['status']) && $analyticsSettings['android']['status'] == "0"}selected="selected"{/if} value="0">{l s='No'}</option>
				</select>
	       </div>
		</div>
	    <div class="form-group">
			<label class="control-label col-lg-3">
				{l s='Android Analytics Code'}  :
			</label>
			<div class="col-lg-3">
				<input type="text" class="" value="{$analyticsSettings['android']['code']}" name="analyticsSettings[android][code]">
	       </div>
		</div>  
	</div>

	<div class="panel-heading" style="clear:both;margin-top:20px;">
	   	{l s='iOS'}
	</div>
	<div class="form-wrapper">
	    <div class="form-group">
			<label class="control-label col-lg-3">
				{l s='Enable iOS Analytics'}  :
			</label>
			<div class="col-lg-3">
				<select name="analyticsSettings[ios][status]">
					<option {if isset($analyticsSettings['ios']['status']) && $analyticsSettings['ios']['status'] == "1"}selected="selected"{/if} value="1">{l s='Yes'}</option>
					<option {if isset($analyticsSettings['ios']['status']) && $analyticsSettings['ios']['status'] == "0"}selected="selected"{/if} value="0">{l s='No'}</option>
				</select>
	       </div>
		</div>
	    
	    <div class="form-group">
			<label class="control-label col-lg-3">
				{l s='iOS Analytics Code'}  :
			</label>
			<div class="col-lg-3">
				<input type="text" value="{$analyticsSettings['ios']['code']}" name="analyticsSettings[ios][code]">
	       </div>
		</div>
	</div>
	  					
	<div class="panel-footer">
		<button class="btn btn-default pull-right" name="updateApp" value="googleanalytics" type="submit">
		  <i class="process-icon-save"></i>
	        {l s='Save'}   
		</button>
		<a onclick="window.history.back();" class="btn btn-default" href="{$link->getAdminLink('MCManageApp')}">
			<i class="process-icon-cancel"></i>
	        {l s='Cancel'}
		</a>
	</div>
</div>