{extends file='page.tpl'}

{block name='page_content'}

	{capture name=path}{l s='Commission Payment' mod='agilesellercommission'}{/capture}
	<h2>{l s='Commission Payment' mod='agilesellercommission'}</h2>
	<div>
	{if !empty($errors)}
		{l s='Payment cannot proceed becuase of errors. Please try again after resolve the error.' mod='agilesellercommission'}
	{else}
			<center>
			<table style="border:dotted 2px blue; width:300px;height:200px;"><tr><td nowrap valign="center" align="center">
			<img src="{$base_dir_ssl}modules/agilesellercommission/img/processing.gif" /><br /><br />
			{$redirect_text}<br /><br /><br />
			<a href="{$return_url}">{$cancel_text}</a><br />
			</td></table>
			</center>
			<form action="{$paypal_url}" method="post" id="paypal_form" class="hidden">
				<input type="hidden" name="upload" value="1" />
				<input type="hidden" name="address_override" value="{$address_override}" />
				<input type="hidden" name="country" value="{$country->iso_code}" />
				{if $state != NULL}
				<input type="hidden" name="state" value="{$state->iso_code}" />
				{/if}
				<input type="hidden" name="amount" value="{$total}" />
				<input type="hidden" name="email" value="{$payer_email}" />
				<input type="hidden" name="item_name_1" value="{$payment_name}" />
				<input type="hidden" name="amount_1" value="{$total}" />
				<input type="hidden" name="quantity_1" value="1" />
				<input type="hidden" name="business" value="{$business}" />
				<input type="hidden" name="receiver_email" value="{$business}" />
				<input type="hidden" name="cmd" value="_cart" />
				<input type="hidden" name="charset" value="utf-8" />
				<input type="hidden" name="currency_code" value="{$currency->iso_code}" />
				<input type="hidden" name="payer_id" value="S-{$payer_id}" />
				<input type="hidden" name="payer_email" value="{$payer_email}" />
				<input type="hidden" name="custom" value="{$id_seller}-{$txnid}" />
				<input type="hidden" name="invoice" value="{$invoice}-{$txnid}" />
				<input type="hidden" name="return" value="{$return_url}" />
				<input type="hidden" name="cancel_return" value="{$return_url}" />
				<input type="hidden" name="notify_url" value="{$base_dir_ssl}modules/agilesellercommission/payvalidation.php" />
				{if $header != NULL}
				<input type="hidden" name="cpp_header_image" value="{$header}" />
				{/if}
				<input type="hidden" name="rm" value="2" />
				<input type="hidden" name="bn" value="PRESTASHOP_WPS" />
				<input type="hidden" name="cbt" value="{$return_text}" />
			</form>
	{/if}
	</div>

{/block}

{block name='javascript_bottom'}
    {$smarty.block.parent}  

	<script type="text/javascript">
	{literal}
	$(document).ready(function() {
		$('#paypal_form').submit();
	});
	{/literal}
	</script>

{/block}

