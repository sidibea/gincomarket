{capture name=path}<a href="{$link->getPageLink('my-account', true)}">{l s='My Account' mod='agilemultipleseller'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='My Seller Account'  mod='agilemultipleseller'}{/capture}

<h1>{l s='My Seller Account' mod='agilemultipleseller'}</h1>
{include file="$tpl_dir./errors.tpl"}

{include file="$agilemultipleseller_views./templates/front/seller_tabs.tpl"}

{if isset($seller_exists) AND $seller_exists}
<div id="agile">
<form action="{$link->getModuleLink('agilemultipleseller', 'sellerpayments', [], true)}" method="post" class="std" id="add_adress">
	<fieldset class="agile-seller-payment">
		<legend><strong></strng>{l s='Your Paypal Account' mod='agilemultipleseller'}</strong></legend>
	    <input type="hidden"  name="id_paymentinfo_paypal" value="{$paymentinfo_paypal->id}" />
		<div class="checkbox">
			<input type="checkbox" id="paypal_in_use" name ="paypal_in_use"  alt="if you want to use this payment type." value="1" {if $paymentinfo_paypal->in_use eq 1}checked="checked"{/if} />
			<label for="paypal_in_use">{l s='In Use' mod='agilemultipleseller'}</label>
		</div>
		<div class="form-group">
			<label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-2 agile-col-xl-2" for="paypal_email">
				<span>{l s='Paypal Account Email' mod='agilemultipleseller'}</span>
			</label>
			<div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
				<input type="text" id="paypal_email" size="80" name="paypal_email" value="{if isset($smarty.post.paypal_email)}{$smarty.post.paypal_email}{else}{if isset($paymentinfo_paypal->info1)}{$paymentinfo_paypal->info1|escape:'htmlall':'UTF-8'}{/if}{/if}" />
			</div>
		</div>
	</fieldset>
    <br>

	<fieldset class="agile-seller-payment" style="display:{if isset($is_agileagilecashondelivery_installed) && $is_agileagilecashondelivery_installed}{else}none{/if};">
		<legend><strong></strng>{l s='Your Cash On Delivery' mod='agilemultipleseller'}</strong></legend>
	    <input type="hidden"  name="id_paymentinfo_cod" value="{$paymentinfo_cod->id}" />
		<div class="checkbox">
			<input type="checkbox" id="cod_in_use" name ="cod_in_use"  alt="if you want to use this payment type." value="1" {if $paymentinfo_cod->in_use eq 1}checked="checked"{/if} />
			<label for="cod_in_use">{l s='In Use' mod='agilemultipleseller'}</label>
		</div>
		<div class="form-group">
			<label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-2 agile-col-xl-2" for="agilecashondelivery_notes">
				<span>{l s='Notes at order' mod='agilemultipleseller'}</span>
			</label>
			<div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
				<input type="text" id="cod_notes" size="80" name="cod_notes" value="{if isset($smarty.post.cod_notes)}{$smarty.post.cod_notes}{else}{if isset($paymentinfo_cod->info1)}{$paymentinfo_cod->info1|escape:'htmlall':'UTF-8'}{/if}{/if}" />
			</div>
		</div>
	</fieldset>
    <br>

	<fieldset class="agile-seller-payment" style="display:{if $is_agilegooglecheckout_installed}{else}none{/if};">
		<legend><strong></strng>{l s='Your Google Checkout Account' mod='agilemultipleseller'}</strong></legend>
	    <input type="hidden" name="id_paymentinfo_gcheckout" value="{$paymentinfo_gcheckout->id}" />
		<div class="checkbox">
		    <input type="checkbox" id="gcheckout_in_use" name ="gcheckout_in_use" tip="if you want to use this payment type." value="1" {if $paymentinfo_gcheckout->in_use eq 1}checked="checked"{/if} />
			<label for="gcheckout_in_use">{l s='In Use' mod='agilemultipleseller'}</label>
		</div>
		<div class="form-group">
			<label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-2 agile-col-xl-2" for="gcheckout_merchant_id">
				<span>{l s='Google Checkout Account' mod='agilemultipleseller'}</span>
			</label>
			<div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
				<input type="text"  name="gcheckout_merchant_id"  size="80" value="{if isset($smarty.post.gcheckout_merchant_id)}{$smarty.post.gcheckout_merchant_id}{else}{if isset($paymentinfo_gcheckout->info1)}{$paymentinfo_gcheckout->info1|escape:'htmlall':'UTF-8'}{/if}{/if}" />
			</div>
		</div>
 		<div class="form-group">
			<label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-2 agile-col-xl-2" for="gcheckout_key">
				<span>{l s='Google API Key' mod='agilemultipleseller'}</span>
			</label>
			<div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
		        <input type="text" name="gcheckout_key" value="{if isset($smarty.post.gcheckout_key)}{$smarty.post.gcheckout_key}{else}{if isset($paymentinfo_gcheckout->info2)}{$paymentinfo_gcheckout->info2|escape:'htmlall':'UTF-8'}{/if}{/if}" />
			</div>
		</div>
	</fieldset>
    <br>
	<fieldset class="agile-seller-payment" style="display:{if $is_agilebankwire_installed}{else}none{/if};">
		<legend><strong></strng>{l s='Your Bank Account' mod='agilemultipleseller'}</strong></legend>
	    <input type="hidden" name="id_paymentinfo_bankwire" value="{$paymentinfo_bankwire->id}" />
		<div class="checkbox">
		        <input type="checkbox" id="bankwire_in_use" name ="bankwire_in_use" tip="if you want to use this payment type." value="1" {if $paymentinfo_bankwire->in_use eq 1}checked="checked"{/if} />
			<label for="bankwire_in_use">{l s='In Use' mod='agilemultipleseller'}</label>
		</div>
 		<div class="form-group">
			<label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-2 agile-col-xl-2" for="bankwire_accountowner">
				<span>{l s='Bank Account Owner' mod='agilemultipleseller'}</span>
			</label>
			<div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
		        <input type="text" name="bankwire_accountowner"  size="80" value="{if isset($smarty.post.bankwire_accountowner)}{$smarty.post.bankwire_accountowner}{else}{if isset($paymentinfo_bankwire->info1)}{$paymentinfo_bankwire->info1|escape:'htmlall':'UTF-8'}{/if}{/if}" />
			</div>
		</div>
 		<div class="form-group">
			<label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-2 agile-col-xl-2" for="bankwire_accountdetails">
				<span>{l s='Bank Account Details' mod='agilemultipleseller'}</span>
			</label>
			<div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
		        <textarea rows="3"  name="bankwire_accountdetails">{if isset($smarty.post.bankwire_accountdetails)}{$smarty.post.bankwire_accountdetails}{else}{if isset($paymentinfo_bankwire->info2)}{$paymentinfo_bankwire->info2|escape:'htmlall':'UTF-8'}{/if}{/if}</textarea>
			</div>
		</div>
 		<div class="form-group">
			<label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-2 agile-col-xl-2" for="bankwire_bankaddress">
				<span>{l s='Bank Address' mod='agilemultipleseller'}</span>
			</label>
			<div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
		        <textarea rows="3" name="bankwire_bankaddress">{if isset($smarty.post.bankwire_bankaddress)}{$smarty.post.bankwire_bankaddress}{else}{if isset($paymentinfo_bankwire->info3)}{$paymentinfo_bankwire->info3|escape:'htmlall':'UTF-8'}{/if}{/if}</textarea>
			</div>
		</div>
	</fieldset>
    <br>
	<fieldset class="agile-seller-payment" style=";display:{if $is_agilepaybycheque_installed}{else}none{/if};">
		<legend><strong></strng>{l s='Your Check Account' mod='agilemultipleseller'}</strong></legend>
	    <input type="hidden" name="id_paymentinfo_agilepaybycheque" value="{$paymentinfo_agilepaybycheque->id}" />
		<div class="checkbox">
		        <input type="checkbox" id="agilepaybycheque_in_use" name ="agilepaybycheque_in_use" tip="if you want to use this payment type." value="1" {if $paymentinfo_agilepaybycheque->in_use eq 1}checked="checked"{/if} />
			<label for="agilepaybycheque_in_use">{l s='In Use' mod='agilemultipleseller'}</label>
		</div>
 		<div class="form-group">
			<label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-2 agile-col-xl-2" for="agilepaybycheque_address">
				<span>{l s='To the order of' mod='agilemultipleseller'}</span>
			</label>
			<div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
		        <input type="text" name="agilepaybycheque_paytoname" value="{if isset($smarty.post.agilepaybycheque_paytoname)}{$smarty.post.agilepaybycheque_paytoname}{else}{if isset($paymentinfo_agilepaybycheque->info1)}{$paymentinfo_agilepaybycheque->info1|escape:'htmlall':'UTF-8'}{/if}{/if}" />
			</div>
		</div>
 		<div class="form-group">
			<label class="control-label agile-col-sm-4 agile-col-md-3 agile-col-lg-2 agile-col-xl-2" for="agilepaybycheque_address">
				<span>{l s='Address' mod='agilemultipleseller'}</span>
			</label>
			<div class="agile-col-sm-8 agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
		        <input type="text" name="agilepaybycheque_address" value="{if isset($smarty.post.agilepaybycheque_address)}{$smarty.post.agilepaybycheque_address}{else}{if isset($paymentinfo_agilepaybycheque->info2)}{$paymentinfo_agilepaybycheque->info2|escape:'htmlall':'UTF-8'}{/if}{/if}" />
			</div>
		</div>
	</fieldset>
    <br>
	<p class="submit2">
		<center>
		    <input type="hidden" name="id_sellerinfo" value="{$sellerinfo->id|intval}" />
			<button type="submit" class="agile-btn agile-btn-default" name="submitSellerinfo" id="submitSellerinfo" value="{l s='Save' mod='agilemultipleseller'}">
			<i class="icon-save"></i>&nbsp;<span>{l s='Save' mod='agilemultipleseller'}</span></button >
		</center>
	</p>
</form> 
</div>
{/if}
{include file="$agilemultipleseller_views./templates/front/seller_footer.tpl"}
