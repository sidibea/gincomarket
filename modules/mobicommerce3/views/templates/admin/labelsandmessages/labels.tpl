{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<input type="hidden" value="{$locale}" name="locale" />
<input type="hidden" value="{$lang}" name="lang_selectd" />
<div class="panel-heading">
	{l s='Label'}
</div>

<div class="form-wrapper">
	{foreach $labels key=_key item=_label}
		{if ($_label['mm_type'] == 'label')}
			<div class="form-group">
				<label class="control-label col-lg-3">
					{$_label['mm_label']}
				</label>
				<div class="col-lg-9">
					<input type="text" value="{$_label['mm_text']}" name="language_data[{$_key}]" class="required"/>
				</div>
			</div>
		{/if}
	{/foreach}
</div>