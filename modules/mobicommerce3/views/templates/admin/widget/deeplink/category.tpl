{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<div id="content" class="bootstrap" style="margin-left: 0px ! important; padding-top: 0px ! important;">
<div id="panel">
<div class="entry-edit">
    <div class="entry-edit-head">
		<h4 class="icon-head head-edit-form fieldset-legend">{l s='Category Link'}</h4>
	</div>
	<div class="fieldset ">
		<div class="hor-scroll">
			<table class="form-list" cellspacing="0">
			    <tbody>
					<input id="linktype" type="hidden" name="type" value="category">
					<tr>
					<td colspan="2"><div class="product-grid">{$categories->render()}</div></td>
					</tr>
			    </tbody>
			</table>
		</div>
	</div>		
</div>
</div>
</div>