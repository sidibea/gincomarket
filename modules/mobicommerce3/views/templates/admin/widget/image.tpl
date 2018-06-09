{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

{$_htmlName = 'banner'}
{$_htmlId ="bannercontainer"}			
												
<div class="panel-heading">
	{l s='Image Widget'}
</div>
<input type="hidden" value="{$lang}" id="lang_id" name="widget[lang_id]" />  		
<input type="hidden" value="{$cat}" id="cat_id" name="widget[widget_category_id]" />		
<input type="hidden" value="image" id="widgetType" name="widgetType" />  		
<input type="hidden" value="widget_image" id="widgetCode" name="widgetCode" />
<input type="hidden" value="{$widget_id}" id="widget_id" name="widget_id" />    
            
            					
<div class="form-wrapper">
	<div class="form-group">
		<label class="control-label col-lg-3">
			{l s='Name'}*
		</label>
		<div class="col-lg-9 ">
			<input type="text" name="widget[name]" value="{$widgetDataArr['widget_label']}" class="input-text required-entry required">
		</div>
	</div>
	
    <div class="form-group">
		<label class="control-label col-lg-3">
			{l s='Title'}
		</label>
		<div class="col-lg-9 ">
			<input type="text" name="widget[widget_data][title]" value="{$widgetData['title']}" class="input-text ">
		</div>
	</div>
         
    <div class="form-group">
		<label class="control-label col-lg-3">
			{l s='Align Title'}
		</label>
		<div class="col-lg-9 ">
			<select name="widget[widget_data][title_align]">
		        <option value="center" {if isset($widgetData['title_align']) && $widgetData['title_align'] == "center"}selected="selected"{/if}>{l s='Center'}</option>
				<option value="left" {if isset($widgetData['title_align']) && $widgetData['title_align'] == "left"}selected="selected"{/if}>{l s='Left'}</option>
				<option value="right" {if isset($widgetData['title_align']) && $widgetData['title_align'] == "right"}selected="selected"{/if}>{l s='Right'}</option>
            </select>
		</div>
	</div>

    <div class="form-group">
		<label class="control-label col-lg-3">
			{l s='Upload Image'}*
		</label>
		<div class="col-lg-9 ">
			<input type="file" class="input-file image_uploader" name="widget_image">
			<input type="hidden" value="{$widget_image}" id="widget_image_hidden" name="widget_image_hidden">
			<br>
            <a class="widget_image_upload" onclick="return uploadimage()" style="cursor: pointer; text-decoration: none;">{l s='Upload Image'}</a>
		</div>
	</div>
         
	<div class="form-group">
		<label class="control-label col-lg-3">
			{l s='Status'}
		</label>
		<div class="col-lg-9 ">
			<select name="widget[enable]">
				<option value="0" {if isset($widgetDataArr['widget_status']) && $widgetDataArr['widget_status'] == 0}selected="selected"{/if}>{l s='No'}</option>
				<option value="1" {if isset($widgetDataArr['widget_status']) && $widgetDataArr['widget_status'] == 1}selected="selected"{/if}>{l s='Yes'}</option>
            </select>
		</div>
        <input type="hidden" name="widget[widget_data][mapcode]" value='{$mapcode}' id="mapcode">
	</div>

    <div class="fieldset">
    	<iframe id="image-map-iframe" class="image-map-iframe" height="100%" scrolling="yes" src="" style="width:100%; height:100%; background:white;-webkit-box-sizing:border-box; -moz-box-sizing:border-box; box-sizing:border-box; border:0; min-height: 500px;">
    	</iframe>
    </div>
</div><!-- /.form-wrapper -->
								
<script type="text/javascript" data-cfasync="false">
    var imageIframeURL = "{$link->getAdminLink('MCManageApp')|addslashes}";
    function uploadimage()
    {
        var file_data = jQuery('.image_uploader').prop('files')[0];
		if(file_data['name'] != '' && typeof file_data['name'] !== "undefined"){
			jQuery('#mobi_loading_mask').show();
			var form_data = new FormData();
			form_data.append('file', file_data);
			var form_key = "abcadb";
			form_data.append('isAjax', true);
			form_data.append('form_key',form_key);
            form_data.append('action',"uploadWidgetimage");
            form_data.append('cat',"{$cat}");
            form_data.append('id',"{$app->id}");
            form_data.append('ajax',"1");
            
			var aurl = "{$link->getAdminLink('MCManageApp')|addslashes}"; 
			jQuery.ajax({
				url: aurl,
				type: 'post',  
				contentType: false,
				processData: false,
				data: form_data,
				success: function(response){
                    //alert('success');
                    console.log(response);
					var iframe = jQuery(".image-map-iframe");
					var data = jQuery.parseJSON(response);
					var imgurl = data.image_url;
                    
					if( imgurl != ''){
						jQuery('#widget_image_hidden').val(imgurl);
						var src =imageIframeURL+"&action=imageMap&ajax=1&imageurl="+imgurl;
                        
						iframe.attr("src",src);
					}
				},
                error:function(){
                    
                }
			});
			jQuery('#mobi_loading_mask').hide();
		}
        
        return false;
    }

    function showPopup()
    {
    	var bannerid = 'linkURL';
    	var linkval = jQuery("#image-map-iframe").contents().find("#linkURL").val();
    	var cat = "";
    	sUrl ="{$link->getAdminLink('MCManageApp')|addslashes}"+"&action=linkwidget&deeplink=true&ajax=1&bannerid="+bannerid+"&link"+linkval+"&cat="+cat
        $.fancybox({
            width: 400,
            height: 400,
            autoSize: false,
            href: sUrl,
            type: 'ajax'
        });
    }

    var imgurl ="{$widget_image}";

    if(imgurl != ''){
    	var src =imageIframeURL+"&action=imageMap&ajax=1&imageurl="+imgurl+"&map_coords={$map_coords}&map_href={$map_href}";
        
    	var iframe = jQuery(".image-map-iframe");
    	iframe.attr("src",src);
    }
</script>    