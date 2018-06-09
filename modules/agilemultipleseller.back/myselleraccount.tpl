{capture name=path}<a href="{$link->getPageLink('my-account', true)}">{l s='My Account' mod='agilemultipleseller'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='My Seller Account'  mod='agilemultipleseller'}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}

<h2>{l s='Your Seller Account' mod='agilemultipleseller'}</h2>

{include file="$tpl_dir./errors.tpl"}
<script type="text/javascript" language="javascript">
    function seller_login() 
    {ldelim}
        $("#seller_login_form").submit();
    {rdelim}
</script>
<fieldset>
    {if $isSeller}
    <form action="{$base_dir_ssl}{$admin_folder_name}/login_seller.php" id="seller_login_form" method="post">
    <input type="hidden" name="ams_seller_email" value="{$seller->email}" />
    <input type="hidden" name="ams_seller_token" value="{$sellertoken}" />
    </form>
    {/if}
    <form action="{$link->getMySellerAccountLink()}" method="post" class="std">
    {if $isSeller}
    	<p class="required">
    		<label for="seller_status">{l s='Seller account status' mod='agilemultipleseller'}</label>
    		<span id="seller_status">{if $seller->active}<img src="{$base_dir_ssl}img/admin/enabled.gif" />&nbsp;{l s='Active' mod='agilemultipleseller'}{else}<img src="{$base_dir_ssl}img/admin/disabled.gif" />&nbsp;{l s='Inactive' mod='agilemultipleseller'}{/if}</span>
        </p>
    	<p class="required">
    		<label for="products_stat">{l s='Products listed' mod='agilemultipleseller'}</label>
    		<span id="products_stat">{$num_products}</span>
        </p>
    	<p class="required">
    		<label for="orders_stat">{l s='Orders received' mod='agilemultipleseller'}</label>
    		<span id="orders_stat">{$num_orders}</span>
        </p>
    	<p class="required">
    		<label for="sales_stat">{l s='Total amount sold' mod='agilemultipleseller'}</label>
    		<span id="sales_stat">{$currency->sign}&nbsp;{$total_amount_sold}</span>
        </p>
        <p>
            <br />
            <br />
            <center>
            <a href="#" onclick="seller_login()">
            {l s='Please click here to access your seller account at back office.' mod='agilemultipleseller'}
            </a>
            </center>
            <br />
        </p>
    {else}
	    <p class="required">
        {if !$seller_exists}
	        {l s='You do not yet have a seller account.' mod='agilemultipleseller'}<br />
	        {l s='Once you register for a seller account, you will be able to list your products in this store upon approval.' mod='agilemultipleseller'}<br />
	    {else}
	        {l s='Thanks for signup an seller, your seller account is waiting for approval. Please come back to check again later.' mod='agilemultipleseller'}<br />
			{if isset($membership_module_integrated) && $membership_module_integrated==1}
		        {l s='Or your membership has been expired, please purchase or renew your membership.' mod='agilemultipleseller'}<br />
			{/if}
	    {/if}
        </p>
        {if !$seller_exists}
        <p>
	        {l s='Do you want create a seller account now so that you can list your products for sale?' mod='agilemultipleseller'}<br />
        </p>
 	    <p class="submit">
    	    <input type="submit" class="button" name="submitSellerAccount" value="{l s='Yes, Sign me up' mod='agilemultipleseller'}" />
        </p>
	    {/if}
    {/if}
    </form>
 </fieldset> 

<br><br>
<div style="display:{if $membership_module_integrated==0 OR !$isSeller}none;{/if}">
<script language="javascript" type="text/javascript">
var membership_module_integrated = {$membership_module_integrated};
$('document').ready(function() {
	if(membership_module_integrated>0)get_my_membership_info();
});

function get_my_membership_info() {
    $.ajax({
        url: "{$base_dir_ssl}"  + 'modules/agilemembership/mymembership.php?content_only=1',
		type: "POST",
        data: {
            ajax: true
        },
        success: function(data) 
		{
///alert(data);
			$("#divMymembershipInfo").html(data);
        }
    });
}

</script>
	<br><br>
	<div id="divMymembershipInfo"></div>
</div>


<ul class="footer_links">
	<li><a href="{$link->getPageLink('my-account', true)}"><img src="{$img_dir}icon/my-account.gif" alt="" class="icon" />{l s='Back to Your Account' mod='agilemultipleseller'}</a></li>
	<li><a href="{$base_dir_ssl}"><img src="{$img_dir}icon/home.gif" alt="" class="icon" /></a><a href="{$base_dir_ssl}">{l s='Home' mod='agilemultipleseller'}</a></li>
</ul>
