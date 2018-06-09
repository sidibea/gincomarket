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
	{l s='Image Slider Widget'}
</div>

<input type="hidden" value="{$lang}" id="lang_id" name="widget[lang_id]" />  		
<input type="hidden" value="{$cat}" id="cat_id" name="widget[widget_category_id]" />   
<input type="hidden" value="imageSlider" id="widgetType" name="widgetType" /> 
<input type="hidden" value="widget_image_slider" id="widgetCode" name="widgetCode" />
<input type="hidden" value="{$widget_id}" id="widget_id" name="widget_id" /> 
					
<div class="form-wrapper">
									
	<div class="form-group">
		<label class="control-label col-lg-3">
			{l s='Name'}*
		</label>
		<div class="col-lg-9 ">
			<input type="text" name="widget[name]" value="{$widgetDataArr['widget_label']}" class="input-text required">
		</div>
	</div>
	
    <div class="form-group">
		<label class="control-label col-lg-3">
			{l s='Title'}
		</label>
		<div class="col-lg-9 ">
			<input type="text" name="widget[widget_data][title]" value="{$widgetData['title']}" class="input-text">
		</div>
	</div>
                
    <div class="form-group">
        <label class="control-label col-lg-3">
                {l s='Autoplay Slider'}
        </label>
        <div class="col-lg-9 ">
            <select name="widget[widget_data][slide_auto_play]" id="widget_slider_type_select">
                <option value="0" {if isset($widgetData['slide_auto_play']) && $widgetData['slide_auto_play'] == "0"}selected="selected"{/if}>{l s='No'}</option>
                <option value="1" {if isset($widgetData['slide_auto_play']) && $widgetData['slide_auto_play'] == "1"}selected="selected"{/if}>{l s='Yes'}</option>
            </select>
        </div>
    </div>
    
    {if isset($widgetData['slide_auto_play']) && $widgetData['slide_auto_play'] == "1"}
        <div id="tr_for_autoplay_slider" class="form-group">
            <label class="control-label col-lg-3" for="slide_auto_play_interval">
                    {l s='Autoplay Interval(ms)'}*
            </label>
            <div class="col-lg-9 ">
                    <input type="text" id="slide_auto_play_interval" name="widget[widget_data][slide_auto_play_interval]" value="{$widgetData['slide_auto_play_interval']}" class="input-text required">
            </div>
        </div>
    {else}
        <div id="tr_for_autoplay_slider" class="form-group" style="display: none">
            <label class="control-label col-lg-3" for="slide_auto_play_interval">
                    {l s='Autoplay Interval(ms)'}*
            </label>
            <div class="col-lg-9 ">
                    <input type="text" id="slide_auto_play_interval" name="widget[widget_data][slide_auto_play_interval]" value="" class="input-text required">
            </div>
        </div>
    {/if}
     
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
			{l s='Slider Images'}
		</label>
		<div class="col-lg-9 ">
			<table cellspacing="0" id="banner_table" class="table border">
    			<colgroup><col></colgroup>
                <thead>
    				<tr class="headings">
    					<th>{l s='Image'}</th>									
    					<th>{l s='Position'}</th>	
    					<th>{l s='Status'}</th>	
    					<th>{l s='Link'}</th>	
    					<th>{l s='Action'}</th>					
    				</tr>
    			</thead>
    			<tbody id="bannercontainer_container">
                    
                </tbody>
    			<tfoot>
    				<tr>
    					<td>{l s='Recommended image width: 1080px'}</td>
    					<td class="a-right" colspan="4"><button onclick="return createProductImage('','','',1,'')" class="btn btn-default" type="button" title="{l s='Add Image'}" id="id_9c7b268a11abb70b1bd557225cfb6d01"><span><span><span>{l s='Add Image'}</span></span></span></button></td>
    				</tr>
    			</tfoot>
    		</table>

            <script type="text/javascript" data-cfasync="false">
                {literal}
                    var id = 1;
                    function createProductImage(image_name,image_url, position, status, link)
                    {
                        var status_checked = '';
                        if(status == '1')
                            status_checked = 'checked = "checked"';
                        
                        if(image_url != '')
                            var image_str = '<img id="banner_row_'+id+'_image" src="'+image_url+'" width="22px" height="22px" style="margin-left:5px;">';
                                   
                        var bannerRowTemplate = 
                           '<tr>'		
                            + '<input type="hidden" name="widget[widget_data][banners]['+id+'][banner_options]" id="banner_row_'+id+'_options" />'        
                    		+ '<td>'
                    			+'<input class="" type="file" name="banner['+id+']" id="banner_row_'+id+'_name"/>'
                    					+'<div class="store-pickup-image">'
                    						+ image_str
                    					+'</div>'
                    					+ '<input id="banner_row_'+id+'_url" type="hidden" name="widget[widget_data][banners]['+id+'][banner_url]" value="'+image_name+'">'
                    		+ '</td>'            
                            + '<td>'
                                 + '<input class="input-text" style="width:50px;" id="banner_row_'+id+'_position" type="text" name="widget[widget_data][banners]['+id+'][banner_position]" value="'+position+'">'
                            + '</td>' 
                    		+ '<td>'
                                 + '<input style="width:50px;" id="banner_row_'+id+'_status" type="checkbox" name="widget[widget_data][banners]['+id+'][banner_status]" '+status_checked+'>'
                            + '</td>' 
                    		+ '<td>'
                                 + '<input  style="width:50px;" id="banner_row_'+id+'_link" type="hidden">'
                                 + '<input style="width:125px;" id="banner_row_link_'+id+'" type="text" class="input-text" name="widget[widget_data][banners]['+id+'][banner_link]" readonly value="'+link+'"/>'
                    			 + '<a id="category_link" attr-bannerid ="'+id+'" href="javascript:void(0)"  value="Test popup dialog" onclick="showPopup(this);"><img src="../modules/mobicommerce3/views/img/admin/rule_chooser_trigger.gif" alt="" class="v-middle rule-chooser-trigger" alt="link" title="Select Link"></a>'
                            + '</td>' 
                    		+ '<td class="last">'
                    			+ '<input type="hidden" name="widget[widget_data][banners]['+id+'][banner_delete]" class="delete" value="0" id="banners_row_'+id+'_delete" />'
                    			+ '<button title="Delete" type="button" class="edit btn btn-default" id="banners_row_'+id+'_delete_button" onclick="return deleteProductImage(this);">'
                    				+ '<span>Delete</span>'
                    			+ '</button>'
                    		+ '</td>'
                            + '</tr>';   
                        $('#banner_table tr:last').after(bannerRowTemplate);
                        id++;
                    }
                    function deleteProductImage(PIid)
                    {
                       var par = $(PIid).parent().parent(); //tr
                        par.remove();
                    }
                {/literal}   

                var cat = "{$cat}";
                function showPopup(e) {
                	var bannerid = jQuery(e).attr("attr-bannerid");
                	var bannersel = "#banner_row_link_"+bannerid;
                	var linkval = jQuery(bannersel).val();
                	sUrl ="{$link->getAdminLink('MCManageApp')|addslashes}"+"&action=linkwidget&deeplink=true&ajax=1&bannerid="+bannerid+"&link"+linkval+"&cat="+cat
                    $.fancybox({
                        width: 400,
                        height: 400,
                        autoSize: false,
                        href: sUrl,
                        type: 'ajax'
                    });
                }

                function closePopup() {
                    Windows.close('popup_window1');
                }
                
                jQuery("#widget_slider_type_select").change(function (){
                    var OptionVal = this.value;
                    if(OptionVal == 1){
                        jQuery("#slide_auto_play_interval").addClass('required-entry');
                        jQuery("#tr_for_autoplay_slider").show();
                    } else {
                        jQuery("#slide_auto_play_interval").removeClass('required-entry');
                        jQuery("#tr_for_autoplay_slider").hide();
                    }
                });
            </script>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-lg-3">
            {l s='Slider Type'}
        </label>
        <div class="col-lg-9 ">
            <select name="widget[widget_data][slider_type]">
                <option value="sideview" {if isset($widgetData['slider_type']) && $widgetData['slider_type'] == 'sideview'}selected="selected"{/if}>{l s='Side View'}</option>
                <option value="dottedview" {if isset($widgetData['slider_type']) && $widgetData['slider_type'] == 'dottedview'}selected="selected"{/if}>{l s='Dotted View'}</option>
                <option value="swiperview" {if isset($widgetData['slider_type']) && $widgetData['slider_type'] == 'swiperview'}selected="selected"{/if}>{l s='Swiper View'}</option>
            </select>
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
    </div>
</div>

{foreach $widgetData['banners'] key=_key item=_banner}    
    <script type="text/javascript" data-cfasync="false">
        var image_name = "{$_banner['banner_url']}";
        //image_url = '{$path}'+image_name;
        image_url = image_name;
        
        var position = "{$_banner['banner_position']}";
        var status = "{$_banner['banner_status']}";
        var link = "{$_banner['banner_link']}";
        
        createProductImage(image_name, image_url, position, status, link);    
    </script>
{/foreach}