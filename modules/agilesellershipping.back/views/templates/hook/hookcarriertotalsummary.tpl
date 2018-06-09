{foreach from=$carriertotalsummary item=carriertotal}
<div class="row agile-sellers">
  <div class="agile-seller agile-col-xs-5 agile-col-sm-3 agile-col-md-3 agile-col-lg-2 agile-col-xl-2">
    {$carriertotal.seller_name}
  </div>
  <div class="agile-seller-carriers agile-col-xs-6  agile-col-sm-8 agile-col-md-8 agile-col-lg-9 agile-col-xl-9" >
    {foreach from=$carriertotal.details item=detail}
    <p class="agile-seller-carrier">
      <b>{$detail.carrier} - {$detail.total}{l s='(tax incl.)' mod='agilesellershipping'}</b>
    </p>
    <p class="agile-seller-carrier-product">
      {$detail.products}
    </p>
    {/foreach}
  </div>
</div>
{/foreach}
