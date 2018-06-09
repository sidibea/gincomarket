{*
*}
{extends file="helpers/form/form.tpl"}

{block name="label"}
	{if $input.type == 'text_customer' && !isset($customer)}
		<label>{l s='Front Store Account (e-mail)' mod='agilemultipleseller'}</label>
	{elseif $input.type == 'text_seller' && !isset($seller)}
		<label>{l s='Back Office Account (e-mail)' mod='agilemultipleseller'}</label>
	{else}
		{$smarty.block.parent}
	{/if}
{/block}

{block name="field"}
	{if $input.type == 'google_map'}
		<div class="col-lg-9 ">
	    <script type="text/javascript">
			var is_multilang = 1; /** _agile__ will be used by googlemap.js _agile_ **/
		</script>
        {include file="./googlemap.tpl"}
		</div>
	{elseif $input.type == 'text_customer'}
		<div class="col-lg-9 ">
			<input type="text" size="33" name="email" value="{if isset($customer)}{$customer->email}{/if}" style="text-transform: lowercase;" />
			{if isset($customer)}
				<a style="display: block; padding-top: 4px;" href="?controller=AdminCustomers&id_customer={$customer->id}&viewcustomer&token={$tokenCustomer}">
				{l s='ID:' mod='agilemultipleseller'} {$customer->id}&nbsp;&nbsp;&nbsp;{l s='Name:' mod='agilemultipleseller'} {$customer->lastname} {$customer->firstname}
				</a>
			{/if}
			<input type="hidden" name="id_customer" value="{if isset($customer)}{$customer->id}{/if}" />	
			<p class="preference_description">
			{l s='Please enter the email address that the seller will use to log in to front store (a Front Store Customer account).' mod='agilemultipleseller'}
			{l s='You must log in to the front office to use front store features.' mod='agilemultipleseller'}
			</p>
		</div>
	{elseif $input.type == 'file'}
		<div class="col-lg-9 ">
   			{* The logo image is always use the orignal size of logo image, please use either width OR height to display size  *}
			<img src="{$logo_image_url}" width="120">
			<input type="file" name="logo">
		</div>
	{elseif $input.type == 'text_seller_employee'}
		<div class="col-lg-9 ">
			<input type="text" size="33" name="seller_employee_email" value="{if isset($seller_employee)}{$seller_employee->email}{/if}" style="text-transform: lowercase;" />
			{if isset($seller_employee)}
				<a style="display: block; padding-top: 4px;" href="?controller=AdminEmployees&id_employee={$seller_employee->id}&updateemployee&token={$tokenEmployee}">
				{l s='ID:' mod='agilemultipleseller'}{$seller_employee->id} {$seller_employee->lastname} &nbsp;&nbsp;{l s='Name:' mod='agilemultipleseller'} {$seller_employee->firstname}
				</a>
			{/if}
			<input type="hidden" name="id_seller" value="{if isset($seller_employee)}{$seller_employee->id}{else}{/if}" />
			<p class="preference_description">
			{l s='Please enter the email address that the seller will use to log in to the back office.' mod='agilemultipleseller'}
			{l s='You must log in to the back office and use the store\'s back office management features to manage seller data.' mod='agilemultipleseller'}
			{l s='Seller back office access permissions are controller by the profile "agilemultipleseller".  You can change permissions through the "Administration"->"Permissions" menu.' mod='agilemultipleseller'}
			</p>
		</div>
	{elseif $input.type == 'date'}
		<div class="col-lg-9 ">
			<input type="text" class="datepicker" name="{$input.name}"	value="{$sellerinfo_obj->$input.name}" />
		</div>
	{else}
		{$smarty.block.parent}
	{/if}
{/block}
