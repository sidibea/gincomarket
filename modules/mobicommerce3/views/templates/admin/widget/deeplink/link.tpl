{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<div class="select-link">
    <div id="fieldset_0" class="panel">
        <div class="panel-heading">{l s='Link Type'}</div>
        <div class="form-wrapper bootstrap">
            <div class="form-group" style="overflow:hidden;">
                <label class="control-label col-lg-4">Select Link Type</label>
                <div class="col-lg-8 ">
                     <select onchange="selectlinktype()" id="popuplinktype">
                              <option value="0">{l s='Select'}</option>
                              <option value="product">{l s='Product Page'}</option>
                              <option value="category">{l s='Category Page'}</option>
                              <option value="cms">{l s='Cms Page'}</option>
                              <option value="phone">{l s='Phone Call'}</option>
                              <option value="email">{l s='Email'}</option>
                              <option value="external">{l s='External Webpage Link'}</option>
                      </select>
                </div>
            </div>
            <div id="deeplinkForm" style="display:none" class="panel widget-selected-content link-response-content" ></div>
            <div class="insert-button"><input type="button" class="btn btn-default" name="AddNew" value="Insert Link" onclick="return savedeeplink();"/></div>
        </div>
    </div>
</div>

		
       
<script type="text/javascript" data-cfasync="false">
var urlFordellpLinkData = "{$link->getAdminLink('MCManageApp')|addslashes}";
var bannerId = "{$bannerid}";
var cat = "{$cat}";
{literal}

   	function selectlinktype(){
	   var selectedlinktype = jQuery( "#popuplinktype option:selected" ).val();
	   var selectedlinktypevalue = "";
       lang_id = $('#languageSelected').val();        
	   if(selectedlinktype != 0){
		   jQuery('#mobi_loading_mask',parent.document).show();
		   
           $.ajax({    type: 'POST',
                        async: true,
                        cache: false,
                        data : {
                            'ajax' : "1",
                            'action' : 'getlinkData',
                            'lang_id' : lang_id,
                            'link_type':selectedlinktype,
                            'link_type_value':selectedlinktypevalue,
                            'cat':cat
                        },
                        "url": urlFordellpLinkData,
                        
                        success: function(response)
                                {
                                    jQuery('#mobi_loading_mask',parent.document).hide();
                    				jQuery('.link-response-content').html(response);
                                    jQuery("#deeplinkForm").show();
                                    
                                },
                        error: function(response, textStatus, errorThrown)
                        {
                            var json = response.responseText.evalJSON(true);
					        alert(json.error);
                        }
                    });

	   }else {
		   jQuery('.link-response-content').html('');
	   }
   	}


function savedeeplink() {
	   	var bannerid = bannerId;
	   	var bannerIndex = '#banner_row_link_'+bannerid;
        
        
       	var type = jQuery('#linktype').val();
	   	if(typeof type ==="undefined"){
			alert("Please Select Link Type");
			return true;
		}
	   	if(typeof type =="0"){
		   	alert("Please Select Link Type");
		   	return true;
	   	}
        if(type == 'category'){
		   	var typevalue =  jQuery("input[name=id_parent]:checked").val();
            
		   	if(typeof typevalue ==="undefined"){
			   	alert("sPlease Select On of Item");
			   	return true;
		   	}
	   	}
        else if (type == 'product' || type == 'cms') {
	       	var typevalue =  jQuery("input[name=radiochecked]:checked").val();
		   	if(typeof typevalue ==="undefined"){
			   	alert("Please Select On of Item");
			   	return true;
		   	}
		   	if(typeof typevalue ==""){
			   	alert("Please Select On of Item");
			   	return true;
		   	}
	   }else{
		   	var typevalue = jQuery('.linktypevalue').val();
		   	if(typeof typevalue === 'undefined'){
			    alert("Please Insert Value");
                return true;
		   	}
		   	if(! typevalue){
			   	alert("Please Insert Value");
               	return true;
		   	}
	   	}
        	   
	   	var link = type+'||'+typevalue;
	   	if(bannerid == 'linkURL'){
	   		jQuery("#image-map-iframe").contents().find("#linkURL").val(link);
	   		jQuery('#image-map-iframe')[0].contentWindow.updateSelectedLink();
	   	}
	   	else{
	   		jQuery(bannerIndex).val(link);
	   	}
	   $.fancybox.close();
   	}
{/literal}    
</script>           