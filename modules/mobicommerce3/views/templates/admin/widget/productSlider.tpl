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
	{l s='Product List Widget'}
</div>
<input type="hidden" value="{$lang}" id="lang_id" name="widget[lang_id]" />  		
<input type="hidden" value="{$cat}" id="cat_id" name="widget[widget_category_id]" />		
<input type="hidden" value="productSlider" id="widgetType" name="widgetType" />  	
<input type="hidden" value="widget_product_slider" id="widgetCode" name="widgetCode" />
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

    <!--
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
    -->
     
    <div class="form-group">
		<label class="control-label col-lg-3">
			{l s='Type'}
		</label>
		<div class="col-lg-9 ">
			<select name="widget[widget_data][type]">
				<option value="slider" {if isset($widgetData['type']) && $widgetData['type'] == "slider"}selected="selected"{/if}>{l s='Slider'}</option>
				<option value="list" {if isset($widgetData['type']) && $widgetData['type'] == "list"}selected="selected"{/if}>{l s='List'}</option>
				<option value="grid" {if isset($widgetData['type']) && $widgetData['type'] == "grid"}selected="selected"{/if}>{l s='Grid (Not Masonry)'}</option>
				<option value="image_view" {if isset($widgetData['type']) && $widgetData['type'] == "image_view"}selected="selected"{/if}>{l s='Large Image View'}</option>
           </select>
		</div>
	</div>

    <div class="form-group">
        <label class="control-label col-lg-3">
            {l s='Products to show on Widget Page'}
        </label>
        <div class="col-lg-9 ">
            <input type="text" name="widget[widget_data][maxItems]" value="{$widgetData['maxItems']}" class="input-text">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-lg-3">
            {l s='Maximum Number of products'}
        </label>
        <div class="col-lg-9 ">
            <input type="text" name="widget[widget_data][limit]" value="{$widgetData['limit']}" class="input-text">
        </div>
    </div>
     
    <div class="form-group">
		<label class="control-label col-lg-3">
		    {l s='Show Name'}
		</label>
        {assign var="show_name" value=1}
        {if isset($widgetData['show_name'])}
            {assign var="show_name" value=$widgetData['show_name']}
        {/if}
		<div class="col-lg-9 ">
            <span class="switch prestashop-switch fixed-width-lg">
				<input type="radio" id="show_name_on" name="widget[widget_data][show_name]" value="1" {if $show_name == 1}checked="checked"{/if} />
                <label class="radioCheck" for="show_name_on">{l s='Yes'}</label>
                <input type="radio" id="show_name_off" name="widget[widget_data][show_name]" value="0" {if $show_name == 0}checked="checked"{/if} />
                <label class="radioCheck" for="show_name_off">{l s='No'}</label>
                <a class="slide-button btn"></a>          
            </span>           
		</div>
    </div>
     
    <div class="form-group">
		<label class="control-label col-lg-3">
			{l s='Show Price'}
		</label>
        {assign var="show_price" value=1}
        {if isset($widgetData['show_price'])}
            {assign var="show_price" value=$widgetData['show_price']}
        {/if}
		<div class="col-lg-9 ">
            <span class="switch prestashop-switch fixed-width-lg">
				<input type="radio" id="show_price_on" name="widget[widget_data][show_price]" value="1" {if $show_price == 1}checked="checked"{/if}/>
                <label class="radioCheck" for="show_price_on">{l s='Yes'}</label>
                <input type="radio" id="show_price_off" name="widget[widget_data][show_price]" value="0" {if  $show_price == 0}checked="checked"{/if} />
                <label class="radioCheck" for="show_price_off">{l s='No'}</label>
                <a class="slide-button btn"></a>
            </span>
		</div>
    </div>
     
    <div class="form-group">
		<label class="control-label col-lg-3">
			{l s='Show Review'}
		</label>
        
        {assign var="show_review" value=1}
        {if isset($widgetData['show_price'])}
            {assign var="show_review" value=$widgetData['show_review']}
        {/if}
        
		<div class="col-lg-9 ">
            <span class="switch prestashop-switch fixed-width-lg">
				<input type="radio" id="show_review_on" name="widget[widget_data][show_review]" value="1" {if  $show_review == 1}checked="checked"{/if}/>
                <label class="radioCheck" for="show_review_on">{l s='Yes'}</label>
                <input type="radio" id="show_review_off" name="widget[widget_data][show_review]" value="0" {if  $show_review == 0}checked="checked"{/if}/>
                <label class="radioCheck" for="show_review_off">{l s='No'}</label>
                <a class="slide-button btn"></a>          
            </span>    
		</div>
	</div>
     
    <div class="form-group">
		<label class="control-label col-lg-3">
			{l s='Which Product you want to show'}
		</label>
        
		<div class="col-lg-9 ">
			<select id="productslider_type" onchange="toggleProductsList(this)" name="widget[widget_data][productslider_type]">
				<option>Select</option>
				<option value="selected" {if isset($widgetData['productslider_type']) && $widgetData['productslider_type'] == 'selected'}selected="selected"{/if}>{l s='Selected Products'}</option>
				<option value="newarrivals" {if isset($widgetData['productslider_type']) && $widgetData['productslider_type'] == 'newarrivals'}selected="selected"{/if}>{l s='New Arrivals'}</option>
				<option value="bestseller" {if isset($widgetData['productslider_type']) && $widgetData['productslider_type'] == 'bestseller'}selected="selected"{/if}>{l s='Best Seller'}</option>
				<option value="productviewed" {if isset($widgetData['productslider_type']) && $widgetData['productslider_type'] == 'productviewed'}selected="selected"{/if}>{l s='Product Viewed'}</option>
            </select>
            <div class="product-grid" >
            
            </div> 
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
            <input type="hidden" value='{$widgetData['products']|serialize}' class="selectedproducts" name="widget[widget_data][products]"/>
		</div>
	</div>
</div>
            
<script type="text/javascript" data-cfasync="false">
    var cat = "{$cat}";
    var urlProductListData = "{$link->getAdminLink('MCManageApp')|addslashes}";

    function toggleProductsList(e)
    {
        var widget_id_value = jQuery( "#widget_id" ).val();
    	var selectedwidget = jQuery( "#productslider_type" ).val();
    	lang_id = $('#languageSelected').val();
        if(selectedwidget == 'selected'){
            $.ajax({
                type: 'POST',
                async: true,
                cache: false,
                data : {
                    'ajax' : "1",
                    'action' : 'productgrid',
                    'lang_id' : lang_id,
                    'cat' : cat,
                    'widget_id':widget_id_value
                },
                "url": urlProductListData,
                
                success: function(response)
                {
                    jQuery('.product-grid').html(response);
                },
                error: function(msg, textStatus, errorThrown)
                {
                    alert(json.error);
                }
            });
    	}else{
    		jQuery('.product-grid').html('');
    	}
    }

    function saveProduct(productid)
    {
        var checked = '0';
        var productpos = jQuery("input[name='prod_position["+productid+"]']").val();
        if(jQuery("input[name='products["+productid+"]']").is(":checked"))
            checked = '1';
    	
        var checked_productsjson = jQuery('.selectedproducts').val();
        var current_grid_products = jQuery(".product_grid_checkbox").val();
        var current_grid_positions = jQuery(".product_grid_position").val();
       
    	jQuery('#mobi_loading_mask').hide();
    	lang_id = $('#languageSelected').val();
    	$.ajax({            
            type: 'POST',
            async: true,
            cache: false,
            data : {
                'ajax' : "1",
                'action' : 'checkproduct',
                'id' : 1,
                'lang_id' : lang_id,
                'productid':productid,
                'prod_position':productpos,
                'checked':checked,
                'checked_products':checked_productsjson,
            },
            "url": urlProductListData,
            
            success: function(response)
            {
                jQuery('.selectedproducts').val(response);
            },
            error: function(response)
            {
                alert(json.error);
            }
        });
    }

    function savePosition(e)
    {
        var productid = jQuery(e).attr('data-productid');
        var productpos = jQuery(e).val();
        var checked_productsjson = jQuery('.selectedproducts').val();
        lang_id = $('#languageSelected').val();
    	if(productid){
    		jQuery('#mobi_loading_mask').hide();
    		
            $.ajax({       
                type: 'POST',
                async: true,
                cache: false,
                data : {
                    'ajax' : "1",
                    'action' : 'saveprodposition',
                    'lang_id' : lang_id,
                    'productid':productid,
                    'prod_position':productpos,
                    'checked_products':checked_productsjson,
                },
                "url": urlProductListData,
                success: function(response)
                {
                    jQuery('.selectedproducts').val(response);
                },
                error: function(response)
                {
                    alert(json.error);
                }
            });
    	}
    }

    var selectedwidget = jQuery( "#productslider_type" ).val();
    	
    if(selectedwidget == 'selected')
    {
        toggleProductsList();
    }
    var widget_id = jQuery( "#widget_id" ).val();

    if(widget_id != '')
        savePosition();
</script>