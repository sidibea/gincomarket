<div id="agile">
    <script language="javascript" type="text/javascript" >
      var is_at_order_opc = {$is_at_order_opc};
      var id_cart_sellershipping = {$id_cart_sellershipping};
      var base_dir_ssl = "{$base_dir_ssl}";
    </script>
    <script language="javascript" type="text/javascript" src="{$content_dir|addslashes}modules/agilesellershipping/js/agilesellershipping.js"></script>
       <div class="row" class="agile-shipping-intro">
        <legend>
          {l s='Shipping Carrier Selection' mod='agilesellershipping'}
        </legend>
        <p>{l s='1. You are able to choose a different shipping carrier for each product, however this will affect the total shipping fees.' mod='agilesellershipping'}</p>
        <p>{l s='2. If you choose the same available carrier for multiple products/items, it may reduce your shipping cost.' mod='agilesellershipping'}</p>
      </div>
      {foreach from=$cartproducts item=product name=productLoop}
      <div class="row box agile-shipping-main {if $smarty.foreach.myLoop.first}agile-first_row {elseif $smarty.foreach.myLoop.last}agile-last_row{else}agile-inner-row{/if}">
        <div class="agile-prod-image agile-col-md-3 agile-col-lg-2 agile-col-xl-2" >
          <a href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category)|escape:'htmlall':'UTF-8'}">
            <img src="{$link->getImageLink($product.link_rewrite, $product.id_image, $image_size)}" alt="{$product.name|escape:'htmlall':'UTF-8'}" {if isset($smallSize)} width="{$smallSize.width}" height="{$smallSize.height}" {/if} />
          </a>
        </div>
        <div class="agile-prod-desc agile-col-md-4 agile-col-lg-4 agile-col-xl-4" >
          <h5>
            <a class="agile-prod-name" href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category)|escape:'htmlall':'UTF-8'}">{$product.name|escape:'htmlall':'UTF-8'}</a>
          </h5>
          {l s='Quantity' mod='agilesellershipping'}:{$product.cart_quantity}<br>
            {if isset($product.attributes) && $product.attributes}<a href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category)|escape:'htmlall':'UTF-8'}">{$product.attributes|escape:'htmlall':'UTF-8'}</a>{/if}
          </div>
        <div class="agile-shipping-carrier agile-col-md-5 agile-col-lg-4 agile-col-xl-4" >
          <div class="agile-carrier-selection">
          <select style="display:{if $product.is_virtual}none{/if};" name="id_carrier_sellershipping_{$product.id_product}_{$product.id_product_attribute}" id="id_carrier_sellershipping_{$product.id_product}_{$product.id_product_attribute}" onchange="update_product_carrier({$id_cart_sellershipping},{$product.id_product},{$product.id_product_attribute})">
            {foreach from=$product.sellercarriers item=sellercarrier}
            <option value="{$sellercarrier.id_carrier}" {if $sellercarrier.id_carrier==$product.sellercarrier_selected}selected{/if}>{$sellercarrier.name}</option>
            {/foreach}
          </select>
          </div>
          {if $product.is_pickupcenter == 1}
          <div id="id_location_sellershipping_{$product.id_product}_{$product.id_product_attribute}" class="agile-pickup-selection">
            {if isset($product.pickupLocations) && $product.pickupLocations}
            <select id="id_pklocation_sellershipping_{$product.id_product}_{$product.id_product_attribute}"
              name="id_pklocation_sellershipping_{$product.id_product}_{$product.id_product_attribute}"
              onchange="update_product_location({$id_cart_sellershipping},{$product.id_product},{$product.id_product_attribute},{$product.id_carrier})">
              {foreach from=$product.pickupLocations item=pickupLocation}
              <option value="{$pickupLocation.id_location}" {if $pickupLocation.id_location==$product.id_location_selected}selected{/if}>{$pickupLocation.location}({$pickupLocation.address1})</option>
              {/foreach}
            </select>
            {else}
            <span style="color:red;">{l s='There is no pickup locatiion available' mod='agilesellershipping'}</span>
            {/if}
          </div>
          {/if}
          <p style="display:{if $product.is_virtual}{else}none{/if};">{l s='Free shipping - Virtual Product' mod='agilesellershipping'}</p>
        </div>
      </div>
      {/foreach}
       <div class="row clearfix">
        <legend>{l s='Shipping Summary' mod='agilesellershipping'}</legend>
	      <div id="sellershipping_totalsummary">
	      </div>
      </div>
</div>