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
	{l s='Category Widget'}
</div>
<input type="hidden" value="{$lang}" id="lang_id" name="widget[lang_id]" />
<input type="hidden" value="{$cat}" id="cat_id" name="widget[widget_category_id]" />
<input type="hidden" value="category" id="widgetType" name="widgetType" />
<input type="hidden" value="widget_category" id="widgetCode" name="widgetCode" />
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
			{l s='Layout'}
		</label>
		<div class="col-lg-9 ">
			<select name="widget[widget_data][cat_layout]">
				<option value="grid" {if isset($widgetData['cat_layout']) && $widgetData['cat_layout'] == "grid"}selected="selected"{/if}>{l s='Grid'}</option>
				<option value="list" {if isset($widgetData['cat_layout']) && $widgetData['cat_layout'] == "list"}selected="selected"{/if}>{l s='List'}</option>
				<option value="slider" {if isset($widgetData['cat_layout']) && $widgetData['cat_layout'] == "slider"}selected="selected"{/if}>{l s='Slider'}</option>
				<option value="banner" {if isset($widgetData['cat_layout']) && $widgetData['cat_layout'] == "banner"}selected="selected"{/if}>{l s='Banner'}</option>
			</select>		
		</div>
	</div>
    <div class="form-group">
		<label class="control-label col-lg-3">
			{l s='Force Navigate to Product List'}
		</label>
        {assign var="category_force_product_nav" value=1}
        {if isset($widgetData['category_force_product_nav'])}
        	{assign var="category_force_product_nav" value=$widgetData['category_force_product_nav']}
        {/if}                            
		<div class="col-lg-9 ">
            <span class="switch prestashop-switch fixed-width-lg">
				<input type="radio" id="category_force_product_nav_on" name="widget[widget_data][category_force_product_nav]" value="1" {if  $category_force_product_nav}checked="checked"{/if} />
                <label class="radioCheck" for="category_force_product_nav_on">{l s='Yes'}</label>
                <input type="radio" id="category_force_product_nav_off" name="widget[widget_data][category_force_product_nav]" value="0" {if  !$category_force_product_nav}checked="checked"{/if} />
                <label class="radioCheck" for="category_force_product_nav_off">{l s='No'}</label>
                <a class="slide-button btn"></a>          
         	</span>  
		</div>
	</div>           
    <div class="form-group">
		<label class="control-label col-lg-3">
			{l s='Show Thumbnail'}
		</label>
        {assign var="show_thumbnail" value=1}
        {if isset($widgetData['show_thumbnail'])}
        	{assign var="show_thumbnail" value=$widgetData['show_thumbnail']}
        {/if}
		<div class="col-lg-9 ">
            <span class="switch prestashop-switch fixed-width-lg">
				<input type="radio" id="show_thumbnail_on" name="widget[widget_data][show_thumbnail]" value="1" {if  $show_thumbnail == 1}checked="checked"{/if} />
                <label class="radioCheck" for="show_thumbnail_on">{l s='Yes'}</label>
                <input type="radio" id="show_thumbnail_off" name="widget[widget_data][show_thumbnail]" value="0" {if  $show_thumbnail == 0}checked="checked"{/if} />
                <label class="radioCheck" for="show_thumbnail_off">{l s='No'}</label>
                <a class="slide-button btn"></a>
            </span> 
            {l s='Only applicable to list view'}
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
                <input type="radio" id="show_name_on" name="widget[widget_data][show_name]" value="1" {if  $show_name == 1}checked="checked"{/if} />
                <label class="radioCheck" for="show_name_on">{l s='Yes'}</label>
                <input type="radio" id="show_name_off" name="widget[widget_data][show_name]" value="0" {if  $show_name == 0}checked="checked"{/if} />
                <label class="radioCheck" for="show_name_off">{l s='No'}</label>
                <a class="slide-button btn"></a>
             </span>
             {l s='Only applicable to grid and slider view'}
		</div>
	</div>
    <div class="form-group">
		<label class="control-label col-lg-3">
			{l s='Select Category'}
		</label>
		<div class="col-lg-9 ">
			{$categories->render()}
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-3">
			{l s='Status'}
		</label>
        {assign var="widget_status" value=1}
        {if isset($widgetDataArr['widget_status'])}
        	{assign var="widget_status" value=$widgetDataArr['widget_status']}   
        {/if}
		<div class="col-lg-9 ">
			<select name="widget[enable]">
				<option value="0" {if  $widget_status == 0}selected="selected"{/if}>{l s='No'}</option>
				<option value="1" {if  $widget_status == 1}selected="selected"{/if}>{l s='Yes'}</option>
            </select>
		</div>
	</div>										
</div><!-- /.form-wrapper -->