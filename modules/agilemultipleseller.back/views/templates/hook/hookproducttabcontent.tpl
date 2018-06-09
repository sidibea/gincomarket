<script type="text/javascript" src="{$module_dir}js/common.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="{$module_dir}js/googlemaps.js"></script>
<script type="text/javascript">
    var map;
    var geocoder = new google.maps.Geocoder();
    var markersArray = [];

   $(document).ready(function() 
   {ldelim}
        initializeMap({$sellerInfo->latitude},{$sellerInfo->longitude} , 12, "map_canvas");
        loc = new google.maps.LatLng({$sellerInfo->latitude}, {$sellerInfo->longitude});
        addMarker('0',loc);
    {rdelim}
    );



</script>
{if $isVertical==1}
<h3 class="idTabHrefShort page-product-heading">{l s='Seller Info/Map' mod='agilemultipleseller'}</h3>
{/if}
<div id="idTab19" class="rte">
  <div class="row">
		<div class="margin-form clearfix" style="float:left;margin-left:20px;">
            <h3>{$sellerInfo->company}</h3>
		    <table cellpadding="2" cellspacing="5">
		    <tr>
		    <td valign="top" align="middle" style="padding:10px;">				
				{if $show_seller_store_link==1}
					<a href="{$link->getAgileSellerLink($sellerInfo->id_seller,$sellerInfo->company)}" class="btn btn-default button button-small">
				{/if}
			    <img src="{$sellerInfo->get_seller_logo_url()}" width="120" />
				{if $show_seller_store_link==1}
					</a>
					<br>
				{/if}
				
				{if $show_seller_store_link==1}
					<br>
					<p><a href="{$link->getAgileSellerLink($sellerInfo->id_seller,$sellerInfo->company)}" class="btn btn-default button button-small">
						<span>{l s='Visit Seller Store' mod='agilemultipleseller'}</span>
						</a>
					</p>
				{/if}
		    </td>
	    
		    <td valign="top" style="padding:10px;">
		        <b>{l s='Address:' mod='agilemultipleseller'}</b><br />
		        	{$sellerInfo->address1}<br />
		        	{if $sellerInfo->address2}{$sellerInfo->address2}<br />{/if}
		        	{$sellerInfo->city}, {$sellerInfo->state} {$sellerInfo->postcode}<br />
		        	{$sellerInfo->country} <br /><br />
		        {if $sellerInfo->phone}

    		    <b>{l s='Phone:' mod='agilemultipleseller'}</b><br />{$sellerInfo->phone}<br />
		        {/if}
                <br />
		        {$sellerInfo->description}
		    </td>
		    </tr>
		    </table>
		</div>


		<div class="margin-form" style="float:right;">
    	    <div id="map_canvas" style="width:480px;height:250px;padding:0px;margin:0px;"></div>
		</div>
 </div>       
</div>
<script type="text/javascript">
	var goreviewtab = {$goreviewtab};///integration with agile product review
	function switchbacktomoreinfo()
	{
		if(goreviewtab !== 1)
		    $("#more_info_block ul").idTabs("idTab1"); 
	}

    $("#more_info_tabs").idTabs("idTab19"); //make google map show first
	setTimeout("switchbacktomoreinfo()",600);
</script>
