{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

{$email = "abc@abc.com"}
<div class="entry-edit">
    <div class="entry-edit-head">
		<h4 class="icon-head head-edit-form fieldset-legend">{l s='Email'}</h4>
	</div>
	<div class="fieldset ">
		<div class="hor-scroll">
			<table class="form-list" cellspacing="0">
			    <tbody>
				    <tr>
						<input id="linktype" type="hidden" name="type" value="email">
					    <td class="label"><label for="website_id">{l s='Email Id'}</label></td>
						<td class="value">
							<input type="text" class="linktypevalue required-entry input-text validate-email" value="{$email}" name="value">
						</td>
				    </tr>
			    </tbody>
			</table>
		</div>
	</div>	
</div>