{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<div style="float:right; margin:0 0 35px 0;">
    <input type="button" class="btn btn-default" name="AddNew" value="Widget List" onclick="return fetchWidgetList();"/>
</div>

<input type="hidden" id="widget_id" value="{$widget_id}" />
<input type="hidden" id="widget_code" value="{$widget_code}" />
<div style="clear: both;"></div>
{if (empty($widget_id))}
    <div class="panel-heading">
        {l s='Select Home Page Widget'}
    </div>

    <div class="form-wrapper">
        <div class="form-group">
            <label class="control-label col-lg-2">
                {l s='Enable Wishlist Feature  :'}
            </label>
            <div class="col-lg-10 ">
                <select id="select_widget" class=" select" onchange="callwidget(this)" name="widget[selected_widget]">
                    <option value="">{l s='Select Widget'}</option>
                    <option value="widget_image_slider">{l s='Image Slider'}</option>
                    <option value="widget_category">{l s='Category'}</option>
                    <option value="widget_product_slider">{l s='Product List'}</option>
                    <option value="widget_image">{l s='Image'}</option>
                </select>
            </div>
        </div>									
    </div>
{/if}  
          
<div id="widgetaddForm" class="widget-selected-content" style="margin-top:15px; padding-top:35px;">
        
</div>
<div class="panel col-lg-12">
	<div class="panel-footer">
        <button class="btn btn-default pull-right" name="updateApp" value="1" type="submit">
            <i class="process-icon-save"></i>
            {l s='Save'}
        </button>
    	<a onclick="window.history.back();" class="btn btn-default" href="{$link->getAdminLink('MCManageApp')}">
            <i class="process-icon-cancel"></i>
            {l s='Cancel'}
    	</a>
    </div>
</div>

<script language="javascript" data-cfasync="false">
    function callwidget()
    {
        $('#widgetaddForm').hide();
        $('#widgetaddFormloading').show();
       
        lang_id = $('#languageSelected').val();
        cat = "{$cat}";
        var selectedwidget = jQuery( "#select_widget option:selected" ).val(); 
      
        var widget_code = jQuery( "#widget_code" ).val();
      
        if(widget_code != '')
            selectedwidget = widget_code;

        var widget_id = jQuery( "#widget_id" ).val();
        if(selectedwidget != 0){
            $.ajax({
                type: 'POST',
                async: true,
                cache: false,
                data : {
                    'ajax' : "1",
                    'action' : 'getHomepageWidgetForm',
                    'lang_id' : lang_id,
                    'widget_id' : widget_id,
                    'widget_code':selectedwidget,
                    'cat' : cat ,
                    'id' : '{$app->id}',
                },
                "url": "{$link->getAdminLink('MCManageApp')|addslashes}",
                
                success: function(data)
                {
                    $('#widgetaddForm').html(data);
                    $('#widgetaddForm').show();
                    $('#widgetaddFormloading').hide();
                },
                error: function(msg, textStatus, errorThrown)
                {
                    jAlert(msg);
                    jAlert(textStatus);
                    jAlert("TECHNICAL ERROR:");
                }
            });
        }
        else
        {
            jQuery('.widget-selected-content').html('');
        }
    }
</script>

{if isset($widget_id) && (!empty($widget_id))}
    <script type="text/javascript" data-cfasync="false">
        callwidget();
    </script>
{/if}
