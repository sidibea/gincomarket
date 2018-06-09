
		<center>
		<table style="border:dotted 2px blue; width:300px;height:200px;"><tr><td nowrap valign="center" align="center">
		<img src="{$base_dir_ssl}modules/agilepaypaladaptive/processing.gif" /><br /><br />
		{$redirect_text}
		</td></table>
		{if $doSubmit==0}
        <h3>{$error_title}</h3>
		<table>
			{foreach from=$payment_errors item=payment_error}
			    <tr><td>{$payment_error}</td></tr>
			{/foreach}
		</table>
		<br />
		<center><a href="{$link->getPageLink('order', true, NULL, 'step=0')}">{$cancel_text}</a></center>
		{/if}
		</center>
		<form action="{$paypal_url}" method="post" id="paypal_form" class="hidden">
		</form>
		<script type="text/javascript">
		    var doSubmit = {$doSubmit};
		    $(document).ready(function() {
		        if(doSubmit)$('#paypal_form').submit();
		    });
		</script>
