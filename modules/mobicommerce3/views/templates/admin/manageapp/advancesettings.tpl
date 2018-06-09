{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<input type="hidden" value="AdvanceSettings" name="process_action" />

<div class="panel">
	<div class="panel-heading">
       	{l s='Category Settings'} 
	</div>
	<div class="form-wrapper" >
        <div class="form-group">
			<div class="col-lg-9">
				<strong>{l s='Selected categories will be displayed in Category menu of the mobile app.'}</strong>
			</div>
	     </div>
        
        <div class="form-group">
			<label class="control-label col-lg-2">
				{l s='Categories To Show'}
			</label>
			<div class="col-lg-9">
				{$categories->render()}
			</div>
	     </div>
    </div>


	<div class="panel-heading" style="clear: both;margin-top: 20px;">
       	{l s='Image Settings'} 
	</div>
	<div class="form-wrapper" >
        <div class="form-group">
			<div class="col-lg-9">
				<strong>{l s='Define shape of the images you are using for the website/mobile app, image container in mobile app will be adjust according to defined shapes and make the app best suit according to your product line.'}</strong>
			</div>
	    </div>

	    <div class="form-group">
			<label class="control-label col-lg-3">{l s='Category Image Dimension : '}</label>
			<div class="col-lg-4">
				<div class="input-group">
					<input class="required-entry validate-number input-text" name="advancesettings[image][category_ratio_width]" value="{$advance_settings['image']['category_ratio_width']}" type="text">
					<span class="input-group-addon">:</span>
					<input class="required-entry validate-number input-text" name="advancesettings[image][category_ratio_height]" value="{$advance_settings['image']['category_ratio_height']}" type="text">
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Product Image Dimension : '}</label>
			<div class="col-lg-4">
				<div class="input-group">
					<input class="required-entry validate-number input-text" name="advancesettings[image][product_ratio_width]" value="{$advance_settings['image']['product_ratio_width']}" type="text">
					<span class="input-group-addon">:</span> 
					<input class="required-entry validate-number input-text" name="advancesettings[image][product_ratio_height]" value="{$advance_settings['image']['product_ratio_height']}" type="text">
				</div>
			</div>
		</div>
    </div>
    <div class="panel-heading" style="clear: both;margin-top: 20px;">
       	{l s='Miscellaneous Settings'} 
	</div>
	<div class="form-wrapper">        
        
        <div class="form-group">
			<div class="col-lg-9">
				<strong>{l s='Enable/disable module or features for the whole mobile app, disabled module will no longer available in the mobile app.'}</strong>
			</div>
	    </div>
        
        <div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable Rating Feature : '}</label>
		    <div class="col-lg-9">
			    <span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['miscellaneous']['enable_rating'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[miscellaneous][enable_rating]" id="misc_rating_on" />
					<label class="radioCheck" for="misc_rating_on">{l s='Yes'}</label>

					<input {if $advance_settings['miscellaneous']['enable_rating'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[miscellaneous][enable_rating]" id="misc_rating_off" />
					<label class="radioCheck" for="misc_rating_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
			    </span>
		    </div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable Wishlist Feature : '}</label>
		    <div class="col-lg-9">
			    <span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['miscellaneous']['enable_wishlist'] == 1 && $module_default_wishlist} checked="checked" {/if} type="radio" value="1" name="advancesettings[miscellaneous][enable_wishlist]" id="misc_wishlist_on" {if $module_default_wishlist}{else}disabled{/if} />
					<label class="radioCheck" for="misc_wishlist_on">{l s='Yes'}</label>

					<input {if $advance_settings['miscellaneous']['enable_wishlist'] == 0} checked="checked" {/if} {if $module_default_wishlist}{else}checked="checked"{/if} type="radio" value="0" name="advancesettings[miscellaneous][enable_wishlist]" id="misc_wishlist_off" {if $module_default_wishlist}{else}disabled{/if} />
					<label class="radioCheck" for="misc_wishlist_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
			    </span>
		    </div>
		</div>
		{if $module_default_wishlist}
		{else}
			<div class="form-group">
				<label class="control-label col-lg-3"></label>
				<div class="col-lg-9">
					<label class="control-label">{l s='In order to use wishlist feature, you need to install default blockwishlist module of prestashop'}</label>
				</div>
			</div>
		{/if}

		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable Social Media Sharing : '}</label>
		    <div class="col-lg-9">
			    <span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['miscellaneous']['enable_socialsharing'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[miscellaneous][enable_socialsharing]" id="misc_sharing_on" />
					<label class="radioCheck" for="misc_sharing_on">{l s='Yes'}</label>

					<input {if $advance_settings['miscellaneous']['enable_socialsharing'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[miscellaneous][enable_socialsharing]" id="misc_sharing_off" />
					<label class="radioCheck" for="misc_sharing_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
			    </span>
		    </div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable Discount Coupon : '}</label>
		    <div class="col-lg-9">
			    <span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['miscellaneous']['enable_discountcoupon'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[miscellaneous][enable_discountcoupon]" id="misc_coupon_on" />
					<label class="radioCheck" for="misc_coupon_on">{l s='Yes'}</label>

					<input {if $advance_settings['miscellaneous']['enable_discountcoupon'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[miscellaneous][enable_discountcoupon]" id="misc_coupon_off" />
					<label class="radioCheck" for="misc_coupon_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
			    </span>
		    </div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable Product Search Facility : '}</label>
		    <div class="col-lg-9">
			    <span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['miscellaneous']['enable_productsearch'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[miscellaneous][enable_productsearch]" id="misc_search_on" />
					<label class="radioCheck" for="misc_search_on">{l s='Yes'}</label>

					<input {if $advance_settings['miscellaneous']['enable_productsearch'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[miscellaneous][enable_productsearch]" id="misc_search_off" />
					<label class="radioCheck" for="misc_search_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
			    </span>
		    </div>
		</div>
                <div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable Scan QR Code : '}</label>
		    <div class="col-lg-9">
			    <span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['miscellaneous']['enable_qrcodescan'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[miscellaneous][enable_qrcodescan]" id="misc_qrcodescan_on" />
					<label class="radioCheck" for="misc_qrcodescan_on">{l s='Yes'}</label>

					<input {if $advance_settings['miscellaneous']['enable_qrcodescan'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[miscellaneous][enable_qrcodescan]" id="misc_qrcodescan_off" />
					<label class="radioCheck" for="misc_qrcodescan_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
			    </span>
		    </div>
		</div>
                <div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable NFC Scanner : '}</label>
		    <div class="col-lg-9">
			    <span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['miscellaneous']['enable_nfcscan'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[miscellaneous][enable_nfcscan]" id="misc_nfcscan_on" />
					<label class="radioCheck" for="misc_nfcscan_on">{l s='Yes'}</label>

					<input {if $advance_settings['miscellaneous']['enable_nfcscan'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[miscellaneous][enable_nfcscan]" id="misc_nfcscan_off" />
					<label class="radioCheck" for="misc_nfcscan_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
			    </span>
		    </div>
		</div>
		<div class="form-group" style="display: none">
			<label class="control-label col-lg-3">{l s='Enable Guest Checkout : '}</label>
		    <div class="col-lg-9">
			    <span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['miscellaneous']['enable_guestcheckout'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[miscellaneous][enable_guestcheckout]" id="misc_guestcheckout_on" />
					<label class="radioCheck" for="misc_guestcheckout_on">{l s='Yes'}</label>

					<input {if $advance_settings['miscellaneous']['enable_guestcheckout'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[miscellaneous][enable_guestcheckout]" id="misc_guestcheckout_off" />
					<label class="radioCheck" for="misc_guestcheckout_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
			    </span>
		    </div>
		</div>
		<div class="form-group" style="display: none">
			<label class="control-label col-lg-3">{l s='Enable Estimated Shipping Cost : '}</label>
		    <div class="col-lg-9">
			    <span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['miscellaneous']['enable_estimatedshippingcost'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[miscellaneous][enable_estimatedshippingcost]" id="misc_estimated_on" />
					<label class="radioCheck" for="misc_estimated_on">{l s='Yes'}</label>

					<input {if $advance_settings['miscellaneous']['enable_estimatedshippingcost'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[miscellaneous][enable_estimatedshippingcost]" id="misc_estimated_off" />
					<label class="radioCheck" for="misc_estimated_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
			    </span>
		    </div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Show Category Icon : '}</label>
		    <div class="col-lg-9">
			    <span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['miscellaneous']['enable_categoryicon'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[miscellaneous][enable_categoryicon]" id="misc_categoryicon_on" />
					<label class="radioCheck" for="misc_categoryicon_on">{l s='Yes'}</label>

					<input {if $advance_settings['miscellaneous']['enable_categoryicon'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[miscellaneous][enable_categoryicon]" id="misc_categoryicon_off" />
					<label class="radioCheck" for="misc_categoryicon_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
			    </span>
		    </div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable Category Widgets : '}</label>
		    <div class="col-lg-9">
			    <span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['miscellaneous']['enable_categorywidget'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[miscellaneous][enable_categorywidget]" id="misc_categorywidget_on" />
					<label class="radioCheck" for="misc_categorywidget_on">{l s='Yes'}</label>

					<input {if $advance_settings['miscellaneous']['enable_categorywidget'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[miscellaneous][enable_categorywidget]" id="misc_categorywidget_off" />
					<label class="radioCheck" for="misc_categorywidget_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
			    </span>
		    </div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable Social Login : '}</label>
		    <div class="col-lg-9">
			    <span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['miscellaneous']['enable_sociallogin'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[miscellaneous][enable_sociallogin]" id="misc_sociallogin_on" />
					<label class="radioCheck" for="misc_sociallogin_on">{l s='Yes'}</label>

					<input {if $advance_settings['miscellaneous']['enable_sociallogin'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[miscellaneous][enable_sociallogin]" id="misc_sociallogin_off" />
					<label class="radioCheck" for="misc_sociallogin_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
			    </span>
		    </div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Show Push in Preferences : '}</label>
		    <div class="col-lg-9">
			    <span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['miscellaneous']['show_push_in_preferences'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[miscellaneous][show_push_in_preferences]" id="misc_pushpreference_on" />
					<label class="radioCheck" for="misc_pushpreference_on">{l s='Yes'}</label>

					<input {if $advance_settings['miscellaneous']['show_push_in_preferences'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[miscellaneous][show_push_in_preferences]" id="misc_pushpreference_off" />
					<label class="radioCheck" for="misc_pushpreference_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
			    </span>
		    </div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s=' No of Sub-Category shown on left panel : '}</label>
		    <div class="col-lg-3">
				<input class="input-text" name="advancesettings[miscellaneous][show_max_subcategory]" value="{$advance_settings['miscellaneous']['show_max_subcategory']}" type="text">
		    </div>
		</div>
        
	</div>

	<div class="panel-heading" style="clear:both;margin-top:20px;">
       	{l s='Product Listing Settings'} 
	</div>							
	<div class="form-wrapper">
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Show Product Name : '}</label>
			<div class="col-lg-9">
				<span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['productlist']['showname'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[productlist][showname]" id="pl_showname_on" />
					<label class="radioCheck" for="pl_showname_on">{l s='Yes'}</label>

					<input {if $advance_settings['productlist']['showname'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[productlist][showname]" id="pl_showname_off" />
					<label class="radioCheck" for="pl_showname_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Show Product Price : '}</label>
			<div class="col-lg-9">
				<span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['productlist']['showprice'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[productlist][showprice]" id="pl_showprice_on" />
					<label class="radioCheck" for="pl_showprice_on">{l s='Yes'}</label>

					<input {if $advance_settings['productlist']['showprice'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[productlist][showprice]" id="pl_showprice_off" />
					<label class="radioCheck" for="pl_showprice_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Show Product Rating : '}</label>
			<div class="col-lg-9">
				<span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['productlist']['showrating'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[productlist][showrating]" id="pl_showrating_on" />
					<label class="radioCheck" for="pl_showrating_on">{l s='yes'}</label>

					<input {if $advance_settings['productlist']['showrating'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[productlist][showrating]" id="pl_showrating_off" />
					<label class="radioCheck" for="pl_showrating_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable Sort By option : '}</label>
			<div class="col-lg-9">
				<span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['productlist']['enablesort'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[productlist][enablesort]" id="pl_sort_on" />
					<label class="radioCheck" for="pl_sort_on">{l s='Yes'}</label>

					<input {if $advance_settings['productlist']['enablesort'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[productlist][enablesort]" id="pl_sort_off" />
					<label class="radioCheck" for="pl_sort_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Default Product Sorting : '}</label>
			<div class="col-lg-3">
				<select name="advancesettings[productlist][default_sorting]">
					<option value="popularity" {if $advance_settings['productlist']['default_sorting'] == 'popularity'} selected {/if}>{l s='Popularity'}</option>
					<option value="position" {if $advance_settings['productlist']['default_sorting'] == 'position'} selected {/if}>{l s='Position'}</option>
					<option value="price-h-l" {if $advance_settings['productlist']['default_sorting'] == 'price-h-l'} selected {/if}>{l s='Price - High-Low'}</option>
					<option value="price-l-h" {if $advance_settings['productlist']['default_sorting'] == 'price-l-h'} selected {/if}>{l s='Price - Low-High'}</option>
					<option value="rating-h-l" {if $advance_settings['productlist']['default_sorting'] == 'rating-h-l'} selected {/if}>{l s='Rating'}</option>
					<option value="name-a-z" {if $advance_settings['productlist']['default_sorting'] == 'name-a-z'} selected {/if}>{l s='Name A-Z'}</option>
					<option value="name-z-a" {if $advance_settings['productlist']['default_sorting'] == 'name-z-a'} selected {/if}>{l s='Name Z-A'}</option>
					<option value="newest" {if $advance_settings['productlist']['default_sorting'] == 'newest'} selected {/if}>{l s='Newest'}</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Default Product View : '}</label>
			<div class="col-lg-3">
				<select name="advancesettings[productlist][default_view]">
					<option value="list" {if $advance_settings['productlist']['default_view'] == 'list'} selected {/if}>{l s='List'}</option>
					<option value="grid" {if $advance_settings['productlist']['default_view'] == 'grid'} selected {/if}>{l s='Grid'}</option>
					<option value="full" {if $advance_settings['productlist']['default_view'] == 'full'} selected {/if}>{l s='Image'}</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable Change Product View : '}</label>
			<div class="col-lg-9">
				<span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['productlist']['enablechangeproductview'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[productlist][enablechangeproductview]" id="pl_changeview_on" />
					<label class="radioCheck" for="pl_changeview_on">{l s='Yes'}</label>

					<input {if $advance_settings['productlist']['enablechangeproductview'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[productlist][enablechangeproductview]" id="pl_changeview_off" />
					<label class="radioCheck" for="pl_changeview_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Persistent View : '}</label>
			<div class="col-lg-9">
				<span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['productlist']['persistent_view'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[productlist][persistent_view]" id="pl_persistent_on" />
					<label class="radioCheck" for="pl_persistent_on">{l s='Yes'}</label>

					<input {if $advance_settings['productlist']['persistent_view'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[productlist][persistent_view]" id="pl_persistent_off" />
					<label class="radioCheck" for="pl_persistent_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable Filter Option : '}</label>
			<div class="col-lg-9">
				<span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['productlist']['enablefilter'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[productlist][enablefilter]" id="pl_filter_on" />
					<label class="radioCheck" for="pl_filter_on">{l s='Yes'}</label>

					<input {if $advance_settings['productlist']['enablefilter'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[productlist][enablefilter]" id="pl_filter_off" />
					<label class="radioCheck" for="pl_filter_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable Masonry View : '}</label>
			<div class="col-lg-9">
				<span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['productlist']['enablemasonry'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[productlist][enablemasonry]" id="pl_masonry_on" />
					<label class="radioCheck" for="pl_masonry_on">{l s='Yes'}</label>

					<input {if $advance_settings['productlist']['enablemasonry'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[productlist][enablemasonry]" id="pl_masonry_off" />
					<label class="radioCheck" for="pl_masonry_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
				</span>
			</div>
		</div>
        
	</div>										
	<div class="panel-heading" style="clear:both;margin-top:20px;">
       	{l s='Product Detail Settings'} 
	</div>
	<div class="form-wrapper">
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable product Zoom : '}</label>
			<div class="col-lg-9">
				<span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['productdetail']['enable_productzoom'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[productdetail][enable_productzoom]" id="pd_zoom_on" />
					<label class="radioCheck" for="pd_zoom_on">{l s='Yes'}</label>

					<input {if $advance_settings['productdetail']['enable_productzoom'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[productdetail][enable_productzoom]" id="pd_zoom_off" />
					<label class="radioCheck" for="pd_zoom_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable Endless Slider : '}</label>
			<div class="col-lg-9">
				<span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['productdetail']['enable_endless_slider'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[productdetail][enable_endless_slider]" id="pd_slider_on" />
					<label class="radioCheck" for="pd_slider_on">{l s='Yes'}</label>

					<input {if $advance_settings['productdetail']['enable_endless_slider'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[productdetail][enable_endless_slider]" id="pd_slider_off" />
					<label class="radioCheck" for="pd_slider_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Enable Related Products : '}</label>
			<div class="col-lg-9">
				<span class="switch prestashop-switch fixed-width-lg">
					<input {if $advance_settings['productdetail']['enable_youmaylike_slider'] == 1} checked="checked" {/if} type="radio" value="1" name="advancesettings[productdetail][enable_youmaylike_slider]" id="pd_related_on" />
					<label class="radioCheck" for="pd_related_on">{l s='Yes'}</label>

					<input {if $advance_settings['productdetail']['enable_youmaylike_slider'] == 0} checked="checked" {/if} type="radio" value="0" name="advancesettings[productdetail][enable_youmaylike_slider]" id="pd_related_off" />
					<label class="radioCheck" for="pd_related_off">{l s='No'}</label>

					<a class="slide-button btn"></a>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Maximum Number of Related Products on Product Detail Page : '}</label>
			<div class="col-lg-3">
				<input class="input-text" type="text" name="advancesettings[productdetail][show_max_related_products]" value="{$advance_settings['productdetail']['show_max_related_products']}" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Select Attributes to show on Product Detail Page : '}</label>
			<div class="col-lg-3">
				<select name="advancesettings[productdetail][showattribute][]" multiple="multiple" class="select multiselect" size="10">
					{if $front_features}
						{foreach $front_features item=_attr}
							<option value="{$_attr['id_feature']}" {if (!isset($advance_settings['productdetail']['showattribute']))} selected {else if (!array_key_exists($_attr['id_feature'], $advance_settings['productdetail']['showattribute']))} selected {/if}>{$_attr['name']}</option>
						{/foreach}
					{/if}
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Select Attributes to show on Know More Screen (popup screen) : '}</label>
			<div class="col-lg-3">
				<select name="advancesettings[productdetail][showattribute_popup][]" multiple="multiple" class="select multiselect" size="10">
					{if $front_features}
						{foreach $front_features item=_attr}
							<option value="{$_attr['id_feature']}" {if (!isset($advance_settings['productdetail']['showattribute_popup']))} selected {else if (!array_key_exists($_attr['id_feature'], $advance_settings['productdetail']['showattribute_popup']))} selected {/if}>{$_attr['name']}</option>
						{/foreach}
					{/if}
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-lg-3">{l s='Maximum Number of Attributes on Product Detail Page : '}</label>
			<div class="col-lg-3">
				<input class="input-text" type="text" name="advancesettings[productdetail][show_max_attributes]" value="{$advance_settings['productdetail']['show_max_attributes']}" />
			</div>
		</div>       
    </div>

	<div class="panel-footer">
		<button class="btn btn-default pull-right" name="updateApp" value="advancesettings" type="submit">
			<i class="process-icon-save"></i>
            {l s='Save'}   
		</button>
		<a onclick="window.history.back();" class="btn btn-default" href="{$link->getAdminLink('MCManageApp')}">
			<i class="process-icon-cancel"></i>
        	{l s='Cancel'}
		</a>
	</div>					
</div>