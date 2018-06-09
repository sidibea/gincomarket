{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<input type="hidden" value="PushNotifications" name="process_action" />
<div id="fieldset_0" class="panel">
	<div class="panel-heading">
		{l s='Push Notifications'} 
	</div>
	<div class="form-wrapper">
        <div class="form-group">		
			<div class="col-lg-9">
            	{l s='Send push notifications to all app users. Enter the message and send to all customers using your app. Configure test message before sending to all customers on test devices and ensure that it is working fine and delivering correctly.'}
			</div>
		</div>
            
        <div class="form-group">
			<label class="control-label col-lg-3">
				{l s='Select Device Type'} :
			</label>
			<div class="col-lg-9">
				<select name="push_device_type">
					<option value="both">{l s='Both'}</option>
                    <option value="android">{l s='Android'}</option>
            		<option value="ios">{l s='iOS'}</option>
                </select>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-lg-3">
				{l s='Select Language'} :
			</label>
			<div class="col-lg-9">
				<select name="push_store_id">
					<option value="0">{l s='All'}</option>
					{foreach $languages item=_language}
						<option value="{$_language.id_lang}">{$_language.name}</option>
					{/foreach}
                </select>
			</div>
		</div>
            
        <div class="form-group">
			{l s='Send push notification to users. Enter the message and send to all users who are using the App'}.
        </div>
        <div class="form-group">
			<label class="control-label col-lg-3">
				{l s='Heading'} :
			</label>
			<div class="col-lg-9">
				<input type="text" id="pushheading" name="pushheading">
			</div>
		</div>
            
        <div class="form-group">
			<label class="control-label col-lg-3">
			    {l s='Message'} :
			</label>
			<div class="col-lg-9">
				<textarea class="textarea-autosize" id="pushnotifications" name="pushnotifications" style="overflow: hidden; word-wrap: break-word; resize: none; height: 65px;"></textarea>
			</div>
		</div>
            
		<div class="form-group">
			<label class="control-label col-lg-3">
			    {l s='Deeplink'} :
			</label>
			<div class="col-lg-9">
				<input id="banner_row_link_pushdeeplink" type="text" class="input-text" name="pushdeeplink" value="" readonly onclick="showPushPopup()" />
			</div>
		</div>
            
        <div class="form-group">
			<label class="control-label col-lg-3">
				{l s='Image'} :
			</label>
			<div class="col-lg-9">
				<input type="file" name="pushfile" accept="image/*" />
				<br />
				Recommended size: 512px(w) x 256px(h)<br />
                Image support for Android only
			</div>
		</div>
            
        <div class="form-group">
			<label class="control-label col-lg-3">
				{l s='Send To'} :
			</label>
			<div class="col-lg-9">
        		<select name="whom" onchange="changeWhom(this.value);">
        			<option value="all">{l s='All'}</option>
                    <option value="customer_group">{l s='Customer Group'}</option>
                    <option value="specific_customer">{l s='Specific Customer'}</option>
        		</select>
   			</div>
		</div>

		<input type="hidden" name="ids_customer_group" value="" />
		<input type="hidden" name="push_pagination_page" value="1" />
    	<input type="hidden" name="push_pagination_limit" value="10" />

		<div class="form-group" id="customer_group">
		 	<label class="control-label col-lg-3">&nbsp;</label>
			<div class="col-lg-9 grid">
        		
   			</div>
		</div>

		<input type="hidden" name="ids_customer" value="" />
		<div class="form-group" id="specific_customer">
			<label class="control-label col-lg-3">&nbsp;</label>
			<div class="col-lg-9 grid">

   			</div>
		</div>

		<div class="form-group" id="send_to_customer">
			<label class="control-label col-lg-3">
			</label>
			<div class="col-lg-9">
        		<div class="send_to_customer-grid">

				</div>
				<div class="send_to_customergroup-grid">

				</div>
   			</div>
		</div>
	</div>
  	
  	<div class="panel-footer">
  		<button class="btn btn-default pull-right" name="updateApp" value="pushnotifications" type="submit">
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
	$("#pushNotificationForm").validate({
	  	rules: {
	    	pushheading: "required",
	  	},
	  	messages: {
	    	pushheading: "Please specify your name",
	  	}
	});
	var cat = "";
	function showPushPopup(e)
	{
		var bannerid = 'pushdeeplink';
	    var linkval = '';
		sUrl ="{$link->getAdminLink('MCManageApp')|addslashes}"+"&action=linkwidget&deeplink=true&ajax=1&bannerid="+bannerid+"&link"+linkval+"&cat="+cat
	    $.fancybox({
	        width: 600,
	        height: 400,
	        autoSize: false,
	        href: sUrl,
	        type: 'ajax'
	    });
	}

	function closePopup()
	{
	    Windows.close('popup_window1');
	}

	function changeWhom(type)
	{
		$('#mobi_loading_mask').show();

		$('input[name=push_pagination_page]').val('1');
		if(type == 'customer_group')
		{
			ajaxCustomerGroup();
			$('.send_to_customergroup-grid').show();
            $('.send_to_customer-grid').hide();
        }
        else if(type == "specific_customer")
        {
            ajaxCustomer();
            $('.send_to_customergroup-grid').hide();
            $('.send_to_customer-grid').show();
        }
        else
        {
        	$('#mobi_loading_mask').hide();
            $('#specific_customer').hide();
            $('#customer_group').hide();
            $('.customer-grid').html('');
            $('.send_to_customergroup-grid').hide();
            $('.send_to_customer-grid').hide();
        }
        //$(".send_to_customer-grid").empty();
	}

	function filterCustomerGroup()
	{
		$('input[name=push_pagination_page]').val('1');
		ajaxCustomerGroup();
	}

	function ajaxCustomerGroup()
	{
		var lang_id = $('#languageSelected').val();
		var _filter_id = $('input[name=groupFilter_id_group]').val();
		var _filter_name = $('input[name=groupFilter_name]').val();
		var _ids_customer_group = $('input[name=ids_customer_group]').val();

		$.ajax({
			type: 'POST',
			async: true,
			cache: false,
			beforeSend: function() { $('#mobi_loading_mask').show(); },
			data : {
				'filter_id' : _filter_id,
				'filter_name' : _filter_name,
				'p' : $('input[name=push_pagination_page]').val(),
				'l' : $('input[name=push_pagination_limit]').val(),
				'ids_customer_group': _ids_customer_group,
				'ajax' : "1",
				'action' : 'getCustomerGroup',
				'lang_id' : lang_id,
			},
			"url": "{$link->getAdminLink('MCManageApp')|addslashes}",

			success: function(data)
			{
                $('#specific_customer').hide();
                $('#customer_group').show();
                $('#customer_group').find('.grid').html(data);

                var _p = $('input[name=push_pagination_page]').val();
                _p = parseInt(_p) + 1;
                $('input[name=push_pagination_page]').val(_p);
			},
			error: function(msg, textStatus, errorThrown)
			{
				jAlert("TECHNICAL ERROR:");
			},
			complete: function()
			{
				$('#mobi_loading_mask').hide();
			}
		});
	}

	function filterCustomer()
	{
		$('input[name=push_pagination_page]').val('1');
		ajaxCustomer();
	}

	function ajaxCustomer()
	{
		var lang_id = $('#languageSelected').val();
		var _filter_id = $('input[name=customerFilter_id]').val();
		var _filter_firstname = $('input[name=customerFilter_firstname]').val();
		var _filter_lastname = $('input[name=customerFilter_lastname]').val();
		var _filter_email = $('input[name=customerFilter_email]').val();
		var _ids_customer = $('input[name=ids_customer]').val();

		$.ajax({
			type: 'POST',
			async: true,
			cache: false,
			beforeSend: function() { $('#mobi_loading_mask').show(); },
			data : {
				'filter_id' : _filter_id,
				'filter_firstname' : _filter_firstname,
				'filter_lastname' : _filter_lastname,
				'filter_email' : _filter_email,
				'p' : $('input[name=push_pagination_page]').val(),
				'l' : $('input[name=push_pagination_limit]').val(),
				'ids_customer': _ids_customer,
				'ajax' : "1",
				'action' : 'getCustomer',
				'lang_id' : lang_id,
			},
			"url": "{$link->getAdminLink('MCManageApp')|addslashes}",

			success: function(data)
			{
                $('#specific_customer').show();
                $('#customer_group').hide();
                $('#specific_customer').find('.grid').html(data);

                var _p = $('input[name=push_pagination_page]').val();
                _p = parseInt(_p) + 1;
                $('input[name=push_pagination_page]').val(_p);
			},
			error: function(msg, textStatus, errorThrown)
			{
				jAlert("TECHNICAL ERROR:");
			},
			complete: function()
			{
				$('#mobi_loading_mask').hide();
			}
		});
	}

	function checkCustomerGroup(id)
	{
		var _value = $('input[name=ids_customer_group]').val();
		_value = _value.split(',');
		var _index = _value.indexOf(id);
		if(_index == -1)
		{
			_value.push(id);
			var _name = $('input[name=customergroup\\['+id+'\\]]').closest('tr').find('.customergroupgrid_name').html();
			$('.send_to_customergroup-grid').append('<span class="popOver popOver_'+id+'">'+_name+'<b onclick="checkCustomerGroup(\''+id+'\')">X</b></span>');
		}
		else
		{
			_value.splice(_index, 1);
			$('.send_to_customergroup-grid .popOver_'+id).remove();
			$('input[name=customergroup\\['+id+'\\]]').prop('checked', false);
		}
		$('input[name=ids_customer_group]').val(_value.toString());
	}

	function checkCustomer(id)
	{
		var _value = $('input[name=ids_customer]').val();
		_value = _value.split(',');
		var _index = _value.indexOf(id);
		if(_index == -1)
		{
			_value.push(id);
			var _name = $('input[name=customer\\['+id+'\\]]').closest('tr').find('.customergrid_firstname').html();
			$('.send_to_customer-grid').append('<span class="popOver popOver_'+id+'">'+_name+'<b onclick="checkCustomer(\''+id+'\')">X</b></span>');
		}
		else
		{
			_value.splice(_index, 1);
			$('.send_to_customer-grid .popOver_'+id).remove();
			$('input[name=customer\\['+id+'\\]]').prop('checked', false);
		}
		$('input[name=ids_customer]').val(_value.toString());
	}

	function pushPaginationCustomerGroup(p)
	{
		$('input[name=push_pagination_page]').val(p);
		ajaxCustomerGroup();
	}

	function pushPaginationCustomer(p)
	{
		$('input[name=push_pagination_page]').val(p);
		ajaxCustomer();
	}
</script>