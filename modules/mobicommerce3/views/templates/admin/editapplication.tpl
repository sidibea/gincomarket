{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}


<div class="panel">
	<div class="productTabs">
		<ul class="tab nav nav-tabs">
		  	{foreach $product_tabs key=numStep item=tab}
				<li class="tab-row">
					<a class="tab-page {if $tab.selected}active{/if}" id="cart_{$numStep}" data-item='{$numStep|strtolower}' href="javascript:displayCartRuleTab('{$numStep|strtolower}');">
	                {$tab.name}</a>
				</li>
	  	    {/foreach}
		</ul>
	</div>
	<form enctype="multipart/form-data" method="post" class="defaultForm form-horizontal MCManageApp" id="mobicommerce_applications_form">
		{foreach $product_tabs key=numStep item=tab}
		    <div id="cart_rule_{$numStep|strtolower}" class="panel cart_rule_tab clearfix">
		      	{include file="$modulepath/views/templates/admin/manageapp/{$numStep|strtolower}.tpl"}
		    </div>
	    {/foreach}
	</form>

	<form target="_blank" name="buynow" action="{if $app->version_type == '001'} http://www.mobicommerce.net/mobiweb/index/addtocart{/if}{if $app->version_type == '002'}http://www.mobicommerce.net/mobiweb/index/addtocartbyoption{/if}" method="post">
		<input type="hidden" name="app_name" value="{$app->app_name}"/>
	    <input type="hidden" name="app_preview_code" value="{$app->app_key}"/>
	    <input type="hidden" name="app_code" value="{$app->app_code}"/>
	    {if $app->version_type == '001'}
	    	<input type="hidden" name="selectedapp" value="nativeapps"/>
	    {/if}
	    {if $app->version_type == '002'}
	    	<input type="hidden" name="selectedapp" value="nativeapps-widget"/>
	    	<input type="hidden" name="selectedoptions" value="nativeapps-widget">
	    {/if}
	    <input type="hidden" name="store_rooturl" value="http://{$http_host}/prestashop/index.php/"/>
	</form>
</div>
<div id="mobi_loading_mask">
    <p id="loading_mask_loader" class="loader"><img alt="Loading..." src="{$module_dir}views/img/admin/ajax-loader-tr.gif">
    <!--<br>Please wait...-->
    </p>
</div>
<script type="text/javascript">
    var currentFormtab = $('.tab li a').data('item');
	$('.cart_rule_tab').hide();
	$('.tab-row.active').removeClass('active');
	$('#cart_rule_'+ currentFormtab).show();
	$('#cart_rule_link_' + currentFormtab).parent().addClass('active');
	
	function displayCartRuleTab(tab)
	{
		$('.cart_rule_tab').hide();
		$('.tab-row .tab-page.active').removeClass('active');
		$('#cart_rule_' + tab).show();
		$('#cart_rule_link_' + tab).parent().addClass('active');
		$('.tab-page[data-item="'+tab+'"]').addClass('active');
		$('#currentFormTab').val(tab);
	}
    displayCartRuleTab("{$currentTab}");
</script>