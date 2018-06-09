{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<span ><strong>{l s='Change the complete look and feel of the home page with widget system. Configure your images, banners, category and product slider directly from this widget page to give desired look and feel to home screen.'}</strong></span>

{if ($app->version_type == '002')}
	<div style="text-align:right;">
		<input type="button" class="btn btn-default"  name="AddNew" value="Add New Widget" onclick="return addNewWidget();"/>
	</div>
{/if}

<div class="table-responsive-row clearfix">
	<table class="table mobicommerce_applications widget_sortable_table">
		<thead>
			<tr class="nodrag nodrop">
			    <th class=" center">
				   	<span class="title_box active">
				       {l s='Widget Id'}
					</span>
				</th>
				<th class=" left">
				    <span class="title_box">
						{l s='Widget Name'}
					</span>
				</th>
				<th class=" left">
				    <span class="title_box">
						{l s='Widget Title'}
					</span>
				</th>
				<th class=" left">
				   	<span class="title_box">
						{l s='Widget Type'}
				   	</span>
				</th>
				<th class=" left">
					<span class="title_box">
						{l s='Status'}
					</span>
				</th>
				{if ($app->version_type == '002')}
					<th class=" left">
						<span class="title_box">
							{l s='Position'}
						</span>
					</th>
				{/if}
                <th class=" left">
					<span class="title_box">
						{l s='Action'}
					</span>
				</th>
				<th></th>
		  	</tr>
		</thead>

		<tbody>
			{assign var="widget_tabindex" value=100}
		    {foreach $widgetLists key=pageIndex item=widget}
		    	{assign var="widgetdata" value=$widget['widget_data']|unserialize}
				<tr class="row_{$widget['widget_id']} odd">
					<td class="pointer center">
						<i class="icon-sortable-move"></i>
					    {$widget['widget_id']}
			        </td>

					<td class="pointer left">
						{$widget['widget_label']}
				    </td>

				    <td class="pointer left">
						{$widgetdata['title']}
				    </td>
				
			    	<td class="pointer left">
			           	{if ($widget['widget_code']=="widget_image_slider")} 
			                {l s='Image Slider'}
			            {elseif ($widget['widget_code']=="widget_category")}
			                {l s='Category'}
			            {elseif ($widget['widget_code']=="widget_product_slider")}
			                {l s='Product List'}
			            {elseif ($widget['widget_code']=="widget_image")}
			                {l s='Image'}
			            {/if} 
			        </td>

					<td class="pointer">
			            {if ($widget['widget_status']=="1")}
			            	{l s='Enable'}
			            {else}
			            	{l s='Disable'}
			            {/if}
			        </td> 
			        
			        {if ($app->version_type == '002')}
				        <td class="pointer left">
				            <input style="width:40px" onchange="change_position({$widget['widget_id']},this)"  name="widget_position_list[{$widget['widget_id']}]" id="widget_position_{$widget['widget_id']}" value="{$widget['widget_position']}" tabindex="{$widget_tabindex}" />
						</td>
					{/if}
			        
			        <td class="pointer left">
						<a href="javascript:void(0);" onclick="return editWidget({$widget['widget_id']});">Edit</a>
						{if ($app->version_type == '002')}
						 	| <a href="javascript:void(0);" onclick="return deleteWidget({$widget['widget_id']});fetchWidgetList();"> Delete</a>
						{/if}
			        </td>
				</tr>
				{capture assign=widget_tabindex}{$widget_tabindex+1}{/capture}
		   	{/foreach}
		</tbody>
	</table>
</div>
<script type="text/javascript" data-cfasync="false">
	function change_position(widget_id,ele)
	{
		return;
	    $.ajax({
	        type: 'POST',
	        async: true,
	        cache: false,
	        data : {
	            'ajax' : "1",
	            'action' : 'changeWidgetPosition',
	            'widget_id' : widget_id,
	            'position' : ele.value,
	            'type' : "widget_home", 
	        },
	        "url": "{$link->getAdminLink('MCManageApp')|addslashes}",
	        
	        success: function(data)
	        {
	           
	        },
	        error: function(msg, textStatus, errorThrown)
	        {
	            jAlert("Network error in changing position, Please try again later");
	        }
	    });
	}

	$(function() {
		initWidgetSortable();
	});
</script>