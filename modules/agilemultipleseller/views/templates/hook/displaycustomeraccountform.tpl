<script type="text/javascript" src="{$base_dir_ssl}modules/agilemultipleseller/js/AgileStatesManagement.js"></script>
<script type="text/javascript">
  idSelectedCountry = {if isset($smarty.post.id_state)}{$smarty.post.id_state|intval}{else}{if isset($sellerinfo->id_state)}{$sellerinfo->id_state|intval}{else}false{/if}{/if};
  {if isset($countries)}
      {addJsDef agileCountries=$countries}
  {/if}

  $(document).ready(function() {
    selleraccountsignup();

      $("a#seller_terms").fancybox({
         'type' : 'iframe',
         'width':600,
        'height':600
      });
  });

  function selleraccountsignup()
  {
    if($("input[id='seller_account_signup']").attr('checked') == 'checked')
    {
         $("#agile_fields").show();;
    } else
    {
        $("#agile_fields").hide();;
    }
  }
</script>
<div id="agile">
  <h3>{l s='Seller Account' mod='agilemultipleseller'}</h3>
  <div class="agile_padding" />
  <p>
    {l s='If you register for a seller account, you will be able to list your products for sale on this website.'  mod='agilemultipleseller'}
    {l s='You can also choose to create your seller account at a later time. You can register for your seller account at any time from My Account - My Seller Account page.'  mod='agilemultipleseller'}
  </p>
  <br />
  <script type="text/javascript" src="{$base_dir_ssl}js/admin.js"></script>
  {if !isset($create_seller_checked)}
  <div class="checkbox">
	  <input id="seller_account_signup" type="checkbox" name="seller_account_signup" value="1" {if isset($smarty.post.seller_account_signup)}{if $smarty.post.seller_account_signup == 1}checked{/if}{/if}
	   onChange="selleraccountsignup();"/> 
    <label for="seller_account_signup">
      {if isset($id_cms_seller_terms) AND $id_cms_seller_terms >0}
      {l s='Yes, I have read and I agree on the Seller Terms & conditions' mod='agilemultipleseller'},
      {/if}
      {l s='Please create a seller account for me' mod='agilemultipleseller'}
    </label>
  </div>
  {/if}
  {if isset($id_cms_seller_terms) AND $id_cms_seller_terms >0}
  <p class="clearfix">
    <span class="agile-term">
      <a href="{$link_terms}" id="seller_terms" class="iframe">{l s='Seller Terms & conditions(read)' mod='agilemultipleseller'}</a>
    </span>
  </p>
  {/if}
  <div class="agile-emptyrow"></div>
  <div class="account_creation" id="agile_fields" style="display:{if !isset($create_seller_checked)}none;{/if}">
    {$seller_sign_up_fields}
  </div>
</div>
