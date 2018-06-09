{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<input type="hidden" value="CMSContents" name="process_action" />
<div class="panel">
	<div class="panel-heading">
	    {l s='Store Information'} 
	</div>
    
    <div class="form-group">
		<div class="col-lg-9">
			<strong>{l s='All fixed pages of your website like About Us, Contact Us, Social Media Links, Store Location and Address you can manage with few clicks from this page.'}</strong>
		</div>
	</div>
	<div class="form-wrapper">
        <div class="form-group">
		    <label class="control-label col-lg-3">
		      	{l s='Store Languages'}  :
			</label>
			<div class="col-lg-9">
				<select id="cmslanguageSelected" name="cmslanguageSelected">
                    {foreach $languages key=langIndex item=language}
                        <option {if isset($language['id_lang']) && $language['id_lang'] == $lang_selectd}selected="selected"{/if} value="{$language.id_lang}">{$language.name}</option>
                    {/foreach}
                </select>
			</div>
		</div>
		</div>
    
    <div class="form-wrapper">
        <div class="form-group">
			<label class="control-label col-lg-3 ">
     			{l s='Company Name'}
	    	</label>
			<div class="col-lg-9">
		         <input type="text" value="{$cms_settings['contact_information']['company_name']}" class="rte" id="company_name" name="cms_settings[contact_information][company_name]"/>
			</div>
		</div>
        <div class="form-group">
			<label class="control-label col-lg-3">
     			{l s='Address'}
	    	</label>
			<div class="col-lg-9">
		        <textarea class="rte autoload_rte" id="company_address" name="cms_settings[contact_information][company_address]">{$cms_settings['contact_information']['company_address']}</textarea>
			</div>
		</div>
        <div class="form-group">
			<label class="control-label col-lg-3">
     			{l s='Phone Number'}
	    	</label>
			<div class="col-lg-9">
		        <input type="text" value="{$cms_settings['contact_information']['phone_number']}" class="rte" id="phone_number" name="cms_settings[contact_information][phone_number]"/>
			</div>
		</div>
        <div class="form-group">
			<label class="control-label col-lg-3">
     		    {l s='Email Address'}
	    	</label>
			<div class="col-lg-9">
		        <input type="text" value="{$cms_settings['contact_information']['email_address']}" class="rte" id="email_address" name="cms_settings[contact_information][email_address]"/>
			</div>
		</div>
        <div class="form-group">
                <label class="control-label col-lg-3">
                        {l s='Menu Left Icon'} :
                </label>
                <div class="col-lg-9">
                    <div class="form-group">
                        <div class="col-sm-6">
                                <input type="file" class="hide" name="menu_icon" id="menu_icon" />
                                <div class="dummyfile input-group">
                                    <span class="input-group-addon"><i class="icon-file"></i></span>
                                    <input type="text" readonly="" name="cms_settings[contact_information][menu_icon]" id="menu_icon-name" value="{$cms_settings['contact_information']['menu_icon']}" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" name="submitAddAttachments" type="button" id="menu_icon-selectbutton">
                                            <i class="icon-folder-open"></i> {l s='Add file'}				
                                        </button>
                                    </span>
                                </div>
                        </div>
                    </div>

                    {if !empty($cms_settings['contact_information']['menu_icon'])}
                        <div class="form-group">
                            <div id="image-images-thumbnails" class="col-lg-12">
                                    <div>
                                            <img class="imgm img-thumbnail" alt="" src="{$module_dir}{$cms_settings['contact_information']['menu_icon']}" width="150">
                                    </div>
                            </div>
                        </div>
                    {/if}
                    
                    <script type="text/javascript">
                        $(document).ready(function(){
                                $('#menu_icon-selectbutton').click(function(e) {
                                        $('#menu_icon').trigger('click');
                                });
                                $('#menu_icon-name').click(function(e) {
                                        $('#menu_icon').trigger('click');
                                });
                                $('#menu_icon-name').on('dragenter', function(e) {
                                        e.stopPropagation();
                                        e.preventDefault();
                                });
                                $('#menu_icon-name').on('dragover', function(e) {
                                        e.stopPropagation();
                                        e.preventDefault();
                                });
                                $('#menu_icon-name').on('drop', function(e) {
                                        e.preventDefault();
                                        var files = e.originalEvent.dataTransfer.files;
                                        $('#menu_icon')[0].files = files;
                                        $(this).val(files[0].name);
                                });
                                $('#menu_icon').change(function(e) {
                                        if ($(this)[0].files !== undefined)
                                        {
                                                var files = $(this)[0].files;
                                                var name  = '';

                                                $.each(files, function(index, value) {
                                                        name += value.name+', ';
                                                });
                                                $('#menu_icon-name').val(name.slice(0, -2));
                                        }
                                        else // Internet Explorer 9 Compatibility
                                        {
                                                var name = $(this).val().split(/[\\/]/);
                                                $('#menu_icon-name').val(name[name.length-1]);
                                        }
                                });

                                if (typeof menu_icon_max_files !== 'undefined')
                                {
                                        $('#menu_icon').closest('form').on('submit', function(e) {
                                                if ($('#menu_icon')[0].files.length > menu_icon_max_files) {
                                                        e.preventDefault();
                                                        alert('You can upload a maximum of files');
                                                }
                                        });
                                }
                        });
                        </script>
                    </div>
		</div>     
		<div class="form-group">
			<label class="control-label col-lg-3">
     			{l s='Latitude'}
	    	</label>
			<div class="col-lg-9">
		        <input type="text" value="{$cms_settings['contact_information']['latitude']}" class="rte" id="latitude" name="cms_settings[contact_information][latitude]"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">
     			{l s='Longitude'}
	    	</label>
			<div class="col-lg-9">
		        <input type="text" value="{$cms_settings['contact_information']['longitude']}" class="rte" id="longitude" name="cms_settings[contact_information][longitude]"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">
     			{l s='Map Zoom Level'}
	    	</label>
			<div class="col-lg-9">
		        <input type="text" value="{$cms_settings['contact_information']['zoom_level']}" class="rte" id="zoom_level" name="cms_settings[contact_information][zoom_level]"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">
     			{l s='Map Pin Color'}
	    	</label>
			<div class="col-lg-9">
		        <input type="color" value="{$cms_settings['contact_information']['pin_color']}" class="rte" id="pin_color" name="cms_settings[contact_information][pin_color]"/>
			</div>
		</div>
		<div class="form-group">
			<script src="http://maps.google.com/maps/api/js"></script>
			<label class="control-label col-lg-3"></label>
			<div class="col-lg-9">
		        <div class="mobicommerce-map" id="mobicommerce-map">
                    <a href="javascript:void(0)" onclick="showmap()" id="click-show-map btn btn-link">{l s='Click here to preview on map'}</a>
                    <div id="notice-map"></div>
                    <div id="googleMap" style="display: none; height: 400px;width: 700px;margin-top: 20px;border: 1px solid;"></div>
                </div>
			</div>
		</div>
		
	</div>
	<div class="panel-heading" style="clear:both;margin-top:20px">
	  	{l s='Social Media URLs'} 
	</div>	
    <div class="form-wrapper">
        <label>{l s='If you have your social media accounts/pages, than activate respective social media plate form and Supply their URL. Activated plate form icons will be displayed on Info section page'}.</label>
        {foreach $social_icons key=_icon item=_property}
            <div class="form-group">
				<label class="control-label col-lg-3">
	                {$_icon} <img alt="{$_icon}" src="{$module_dir}views/img/admin/{$_property['img']}" />
		    	</label>
				<div class="col-lg-9">
					<div class="input-group">
						<span class="input-group-addon">
							<input type="checkbox" value="1" {if (isset($cms_settings['social_media'][$_icon]['checked']) && $cms_settings['social_media'][$_icon]['checked'] == '1')}checked {/if}  name="cms_settings[social_media][{$_icon}][checked]"/>
						</span>

						<input id="{$_icon}_url" class="validate-url" type="text" value="{if (isset($cms_settings['social_media'][$_icon]['url']))}{$cms_settings['social_media'][$_icon]['url']}{/if}" name="cms_settings[social_media][{$_icon}][url]" placeholder="{$_icon} URL"/>
					</div>
				</div>
			</div>
        {/foreach}   
    </div>

	<div class="panel-heading" style="clear:both;margin-top:20px">
	    {l s='CMS Pages'} 
	</div>
	<div class="form-wrapper">
		<label>{l s='Select all pages which you want to show activate or show in Mobile app and set their sequence/order number'}.</label>
        {$pageNumber=1}
        {$lang = 1}
        {$parrent = 1}
        {$cmsPages = $cms_settings['cms_pages']}
        <div class="form-wrapper">
        	{foreach from=CMS::getCMSPages($lang,$parrent,true) item=cmspages}
        		<div class="form-group">
					<label class="control-label col-lg-3">
						<a target="_blank" href="{$link->getCMSLink($cmspages.id_cms, $cmspages.link_rewrite)|escape:'htmlall':'UTF-8'}">
		                	{$cmspages.meta_title|escape:'htmlall':'UTF-8'}
		                </a>
			    	</label>
					<div class="col-lg-1">
						<div class="input-group">
							<span class="input-group-addon">
								<input {if isset($cmsPages['status'][$cmspages.id_cms])}checked="checked"{/if} id="cms_pages_{$cmspages.id_cms}" name="cms_settings[cms_pages][status][{$cmspages.id_cms}]" type="checkbox" value="{$cmspages.id_cms}" />
							</span>

							<input type="text" name="cms_settings[cms_pages][index][{$cmspages.id_cms}]" id="cms_pages_index_{$cmspages.id_cms}" value="{$cmsPages['index'][$cmspages.id_cms]}">
						</div>
					</div>
				</div>
        	{/foreach}
        </div>
	</div>
			
	<div class="panel-footer">
		<button class="btn btn-default pull-right" name="updateApp" value="cmscontents" type="submit">
			<i class="process-icon-save"></i>
            {l s='Save'}   
		</button>
		<a onclick="window.history.back();" class="btn btn-default" href="{$link->getAdminLink('MCManageApp')}">
			<i class="process-icon-cancel"></i>
			{l s='Cancel'}
		</a>
	</div>	
</div>

<script type="text/javascript">
	var map = null;
	var marker = null;
	var iso = '{$iso|addslashes}';
	var pathCSS = '{$smarty.const._THEME_CSS_DIR_|addslashes}';
	var ad = '{$ad|addslashes}';

	$(document).ready(function() {
		jQuery('#cmslanguageSelected').change(function(){   
		    fetchCMS();
		});

		if(typeof(tinySetup) != 'undefined'){
			tinySetup({
	    		editor_selector :"autoload_rte"
		   	});
		}
	});

	function fetchCMS()
	{
	    lang_id = $('#cmslanguageSelected').val();
	    window.location.href = "{$link->getAdminLink('MCManageApp')|addslashes}&id={$app->id}&updatemobicommerce_applications3&tab_display=CMSContents&lang="+lang_id;
	}

	function showmap(){
        jQuery('#googleMap').css('display','block');
        map_initialize();
    }
    {literal}
    function map_initialize(){
        var latitude = jQuery.trim(jQuery('#latitude').val());
        var longtitude = jQuery.trim(jQuery('#longitude').val());
        var zoom_value = jQuery.trim(jQuery('#zoom_level').val());
        var pin_color = jQuery.trim(jQuery('#pin_color').val());
        pin_color = pin_color.replace('#', '');

        if(latitude == '') latitude = '40.7128';
        if(longtitude == '') longtitude = '74.0059';
        if(zoom_value == '') zoom_value = '8';
        if(pin_color == '') pin_color = '009900';

        latitude = parseFloat(latitude);
        longtitude = parseFloat(longtitude);
        zoom_value = parseFloat(zoom_value);
        try{
            var mapCenter = {lat: latitude, lng: longtitude};
            if(map == null) {
                map = new google.maps.Map(document.getElementById('googleMap'), {
                    zoom: zoom_value,
                    center: mapCenter
                });

                marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                    position: mapCenter,
                    icon: new google.maps.MarkerImage("http://www.googlemapsmarkers.com/v1/"+pin_color+"/")
                });

                map.addListener('zoom_changed', function() {
                    jQuery('#zoom_level').val(map.getZoom())
                });

                google.maps.event.addListener(marker, 'dragend', function (event) {
                    jQuery('#latitude').val(event.latLng.lat());
                    jQuery('#longitude').val(event.latLng.lng());
                });
            }
            else {
                map.setCenter(mapCenter);
                marker.setPosition(mapCenter);
                map.setZoom(zoom_value);

                var _icon = new google.maps.MarkerImage("http://www.googlemapsmarkers.com/v1/"+pin_color+"/");
                marker.setIcon(_icon);
            }
        }
        catch(e) {}
    }
    {/literal}
</script>