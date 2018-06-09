{*
*}
{extends file="helpers/view/view.tpl"}

{block name="override_tpl"}
<div>
	<table class="table" width="100%">
      <thead>
	  <tr>
      <th>{l s='ID' mod='agilepaypaladaptive'}</th>
      <th>{l s='Seller ID' mod='agilepaypaladaptive'}</th>
      <th>{l s='Seller Name' mod='agilepaypaladaptive'}</th>
      <th>{l s='Receiver Paypal Email' mod='agilepaypaladaptive'}</th>
      <th align="right">{l s='Amount' mod='agilepaypaladaptive'}</th>
      <th>{l s='Record Type' mod='agilepaypaladaptive'}</th>
      <th>{l s='Paypal TXN ID' mod='agilepaypaladaptive'}</th>
      <th>{l s='Status' mod='agilepaypaladaptive'}</th>
      <th>{l s='Date' mod='agilepaypaladaptive'}</th>
      </tr>
	  </thead>
	  {foreach from=$txn_details  item=txn_detail name=myLoop}
      <tr>
      <td>{$txn_detail.id_agilepaypaladaptive_txndetail}</td>
      <td>{if $txn_detail.id_seller==0}--{else}{$txn_detail.id_seller}{/if}</td>
      <td>{if $txn_detail.id_seller==0}{l s='Store' mod='agilepaypaladaptive'}{else}{$txn_detail.seller_name}{/if}</td>
      <td>{$txn_detail.receiver_email}</td>
      <td nowrap align="right">{displayPrice price=$txn_detail.amount no_utf8=false convert=false}</td>
      <td align="center">{$txn_detail.record_type}</td>
      <td>{$txn_detail.paypal_txnid}</td>
      <td>{$txn_detail.status}</td>
      <td>{$txn_detail.date_upd}</td>
      </tr>
      {/foreach}
	</table>
</div>
{/block}
