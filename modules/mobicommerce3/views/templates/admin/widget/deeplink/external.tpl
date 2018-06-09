{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

{$external_link_url = "www.google.com"}
<div class="entry-edit">
    <div class="entry-edit-head">
		<h4 class="icon-head head-edit-form fieldset-legend">{l s='External Link'}</h4>
	</div>
	<div class="fieldset ">
		<div class="hor-scroll">
			<table class="form-list" cellspacing="0">
			    <tbody>
				    <tr>
						<input id="linktype" type="hidden" name="type" value="external">
					    <td class="label"><label for="website_id">{l s='External Link'}</label></td>
						<td class="value">
							<input type="text" class="linktypevalue required-entry input-text required-entry" value="{$external_link_url}" name="value">
						</td>
				    </tr>
			    </tbody>
			</table>
		</div>
	</div>	
</div>