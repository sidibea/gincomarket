{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<input type="hidden" value="HomePageWidgets" name="process_action" />
<input type="hidden" value="1" id="widgetAdd" name="widgetAdd">  
{if (count($languages)>=1)}
	<div class="panel-heading">
	    {l s='Select Language'} [{l s='Store View'}]
	</div>
	<div class="form-wrapper">
        <div class="form-group">
            <label class="control-label col-lg-2">
                {l s='Store Languages'}  :
            </label>
			<div class="col-lg-10 ">
				<select id="languageSelected" name="languageSelected">
                    {foreach $languages key=langIndex item=language}
                        <option value="{$language.id_lang}">{$language.name}</option>        
                    {/foreach}
                </select>
			</div>
		</div>
    </div><!-- /.form-wrapper -->
{/if}

<div id="widgetList">
</div>

<script type="text/javascript">
    $(document).ready(function() {
    	jQuery('#languageSelected').change(function(){   
            fetchWidgetList();
    	});

    	fetchWidgetList();

    	$("#addWidgetForm").validate();
    });

    function fetchWidgetList()
    {
        $('#widgetList').hide();
        $('#mobi_loading_mask').show();
        var lang_id = $('#languageSelected').val();
       
        $.ajax({
            type: 'POST',
            async: true,
            cache: false,
            data : {
                'ajax' : "1",
                'action' : 'listHomepageWidget',
                'id' : {$app->id},
                'lang_id' : lang_id,
            },
            "url": "{$link->getAdminLink('MCManageApp')|addslashes}",
            
            success: function(data)
            {
                $('#widgetList').html(data);
                $('#widgetList').show();
                $('#mobi_loading_mask').hide();
            },
            error: function(msg, textStatus, errorThrown)
            {
                jAlert("TECHNICAL ERROR:");
            }
        });
    }

    function addNewWidget()
    {
        $('#widgetList').hide();
        $('#mobi_loading_mask').show();
        var lang_id = $('#languageSelected').val();
       
        $.ajax({
            type: 'POST',
            async: true,
            cache: false,
            data : {
                'ajax' : "1",
                'action' : 'addHomepageWidget',
                'id' : {$app->id},
                'lang_id' : lang_id,
            },
            "url": "{$link->getAdminLink('MCManageApp')|addslashes}",
            
            success: function(data)
            {
                $('#widgetList').html(data);
                $('#widgetList').show();
                $('#mobi_loading_mask').hide();
            },
            error: function(msg, textStatus, errorThrown)
            {
                $('#mobi_loading_mask').hide();
                jAlert("TECHNICAL ERROR:");
            }
        });
    }

    function editWidget(widget_id)
    {
        $('#widgetList').hide();
        $('#mobi_loading_mask').show();
        var lang_id = $('#languageSelected').val();
       
        $.ajax({
            type: 'POST',
            async: true,
            cache: false,
            data : {
                'ajax' : "1",
                'action' : 'addHomepageWidget',
                'id' : {$app->id},
                'lang_id' : lang_id,
                'widget_id' : widget_id,
            },
            "url": "{$link->getAdminLink('MCManageApp')|addslashes}",
            
            success: function(data)
            {
                $('#widgetList').html(data);
                $('#widgetList').show();
                $('#mobi_loading_mask').hide();
            },
            error: function(msg, textStatus, errorThrown)
            {
                jAlert("TECHNICAL ERROR:");
            }
        });
    }

    function deleteWidget(widget_id)
    {
        var confirm_msg = confirm("Are you sure you want to delete this widget?");
        
        if(!confirm_msg)
        {
            return false;
        }

        $('#mobi_loading_mask').show();
        var lang_id = $('#languageSelected').val();
       
        $.ajax({
            type: 'POST',
            async: true,
            cache: false,
            data : {
                'ajax' : "1",
                'action' : 'deleteHomepageWidget',
                'id' : {$app->id},
                'lang_id' : lang_id,
                'widget_id' : widget_id,
            },
            "url": "{$link->getAdminLink('MCManageApp')|addslashes}",
            
            success: function(data)
            {
                $(".row_"+widget_id).fadeOut(500);
                $('#mobi_loading_mask').hide();
            },
            error: function(msg, textStatus, errorThrown)
            {
                jAlert("TECHNICAL ERROR:");
            }
        });
    }
</script>  