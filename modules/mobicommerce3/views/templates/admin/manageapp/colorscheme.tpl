{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<input type="hidden" value="Colorscheme" name="process_action" />
<input type="hidden" value="" name="change_personalizer" id="change_personalizer" />

<div class="panel">
	<div class="panel-heading">
		{l s='Android'} 
	</div>
    
    <div class="form-group">
		<div class="col-lg-9 ">
            <strong>{l s='Personalize color scheme of the mobile app. You have to restart the app to get reflection of the new color scheme in the app.'}</strong>	
		</div>
	</div>
    
	<div class="form-wrapper">
      	{foreach $code_personalizer_parent key=option item=value}
      		{if $value->group == 'android'}
	          	<div class="form-group">
					<label class="control-label col-lg-3">
						<span data-html="true" data-toggle="tooltip" class="label-tooltip" data-original-title="{$value->description}">
							{$value->title} :
						</span>
					</label>
					<div class="col-lg-9">
						<div class="form-group">
							<div class="col-lg-8">
								<select name="personalizer[{$option}]" onchange="changePersonalizer();">
									{assign var="current_value" value=$code_personalizer_child->$option->current_value}
									{foreach $value->options->option item=value_options}
										<option value="{$value_options->value}" style="background-color: {$value_options->color}; color: {$value_options->textcolor}" {if (string)$value_options->value == $current_value}selected{/if}>{$value_options->label}</option>
									{/foreach}
								</select>
							</div>
						</div>
					</div>
				</div>
			{/if}
	 	{/foreach}  
    </div>
</div>

<div class="panel">
	<div class="panel-heading">
		{l s='iOS'} 
	</div>

	<div class="form-wrapper">
      	{foreach $code_personalizer_parent key=option item=value}
      		{if $value->group == 'ios'}
	          	<div class="form-group">
					<label class="control-label col-lg-3">
						<span data-html="true" data-toggle="tooltip" class="label-tooltip" data-original-title="{$value->description}">
							{$value->title} :
						</span>
					</label>
					<div class="col-lg-9">
						<div class="form-group">
							<div class="col-lg-8">
								<select name="personalizer[{$option}]" onchange="changePersonalizer();">
									{assign var="current_value" value=$code_personalizer_child->$option->current_value}
									{foreach $value->options->option item=value_options}
										<option value="{$value_options->value}" style="background-color: {$value_options->color}; color: {$value_options->textcolor}" {if (string)$value_options->value == $current_value}selected{/if}>{$value_options->label}</option>
									{/foreach}
								</select>
							</div>
						</div>
					</div>
				</div>
			{/if}
	 	{/foreach}  
    </div>

	<div class="panel-footer">
		<button class="btn btn-default pull-right" name="updateApp" value="btn_colorscheme" type="submit">
			<i class="process-icon-save"></i>
        	{l s='Save'}
        </button>
		<a onclick="window.history.back();" class="btn btn-default" href="{$link->getAdminLink('MCManageApp')}">
			<i class="process-icon-cancel"></i>
    		{l s='Cancel'}
		</a>
	</div>
</div>

<script type="text/javascript">
	function changePersonalizer() {
		jQuery('#change_personalizer').val('1');
	}
</script>