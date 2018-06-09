{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<input type="hidden" value="GeneralSettings" name="process_action" />
<input type="hidden" value="{$app_code}" name="appcode" />
<div class="panel">
	<div class="panel-heading">
     	{l s='Push Notification'} 
	</div>
	<div class="form-wrapper">
        <div class="form-group">
			<label class="control-label col-lg-3"></label>		
			<div class="col-lg-9">
                <strong>{l s='For Android, push notifications are activated directly once your mobile app is ready. For iOS version, you need to provide us with UDID number, will generate certificate for activating push notifications. Once approved, it enables sending you push notifications for iOS app as well. '}</strong>	
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">
				{l s='Activate Push Notification'} :
     		</label>
			<div class="col-lg-9">
			    <input type="checkbox" {if isset($push_notification['active_push_notification']) && $push_notification['active_push_notification'] == 1}checked="checked"{/if} size="40" value="1" id="active_push_notification" name="pushnotification[active_push_notification]"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">
				<span title="" data-html="true" data-toggle="tooltip" class="label-tooltip" data-original-title="{l s='Please Make sure your 2195 port is open to send IOS push notifications.'}">
				{l s='Sandbox mode'} :
				</span>
			</label>
			<div class="col-lg-9">
                <input type="checkbox" {if isset($push_notification['sandboxmode']) && $push_notification['sandboxmode'] == 1}checked="checked"{/if} size="40"  value="1" id="sandboxmode" name="pushnotification[sandboxmode]"/>		
                <span>Please Make sure your 2195 port is open to send IOS push notifications.</span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">
				<span title="" data-html="true" data-toggle="tooltip" class="label-tooltip" data-original-title="{l s='Google API key created at google developer console'}">
					{l s='GCM API Key'} :
				</span>
			</label>
			<div class="col-lg-9">
    			<input type="text" size="40" class="" value="{$push_notification['android_key']}" id="android_key" name="pushnotification[android_key]">
			</div>		
	  	</div>
	 	<div class="form-group">
	      	<label class="control-label col-lg-3">
	      		<span title="" data-html="true" data-toggle="tooltip" class="label-tooltip" data-original-title="{l s='Google API project number created at google developer console.'}">
					{l s='Google API Project Number'} :
				</span>
			</label>
			<div class="col-lg-9">
    			<input type="text" size="40" class="" value="{$push_notification['android_sender_id']}" id="android_sender_id" name="pushnotification[android_sender_id]">
			</div>
		</div>
		<div class="form-group">
	  		<label class="control-label col-lg-3">
	  			<span title="" data-html="true" data-toggle="tooltip" class="label-tooltip" data-original-title="{l s='PEM file to send push notifications to iOS devices.'}">
					{l s='Upload iOS PEM file'} :
				</span>
	  		</label>
	  		<div class="col-lg-9">
				<div class="form-group">
            		<div class="col-sm-6">
        				<input type="file" class="hide" name="upload_iospem_file" id="upload_iospem_file"  />
        				<div class="dummyfile input-group">
        					<span class="input-group-addon"><i class="icon-file"></i></span>
        					<input type="text" readonly="" name="pushnotification[upload_iospem_file]" id="upload_iospem_file-name" value="{$push_notification['upload_iospem_file']}">
        					<span class="input-group-btn">
        						<button class="btn btn-default" name="submitAddAttachments" type="button" id="upload_iospem_file-selectbutton">
        							<i class="icon-folder-open"></i> {l s='Add file'}
                        		</button>
       			     		</span>
        				</div>
           			</div>
        		</div>
				<script type="text/javascript">
					$(document).ready(function(){
						$('#upload_iospem_file-selectbutton').click(function(e) {
							$('#upload_iospem_file').trigger('click');
						});

						$('#upload_iospem_file-name').click(function(e) {
							$('#upload_iospem_file').trigger('click');
						});

						$('#upload_iospem_file-name').on('dragenter', function(e) {
							e.stopPropagation();
							e.preventDefault();
						});

						$('#upload_iospem_file-name').on('dragover', function(e) {
							e.stopPropagation();
							e.preventDefault();
						});

						$('#upload_iospem_file-name').on('drop', function(e) {
							e.preventDefault();
							var files = e.originalEvent.dataTransfer.files;
							$('#upload_iospem_file')[0].files = files;
							$(this).val(files[0].name);
						});

						$('#upload_iospem_file').change(function(e) {
							if ($(this)[0].files !== undefined)
							{
								var files = $(this)[0].files;
								var name  = '';

								$.each(files, function(index, value) {
									name += value.name+', ';
								});

								$('#upload_iospem_file-name').val(name.slice(0, -2));
							}
							else // Internet Explorer 9 Compatibility
							{
								var name = $(this).val().split(/[\\/]/);
								$('#upload_iospem_file-name').val(name[name.length-1]);
							}
						});

						if (typeof upload_iospem_file_max_files !== 'undefined')
						{
							$('#upload_iospem_file').closest('form').on('submit', function(e) {
								if ($('#upload_iospem_file')[0].files.length > upload_iospem_file_max_files) {
									e.preventDefault();
									alert('You can upload a maximum of  files');
								}
							});
						}
					});
				</script>
    		</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">
				{l s='PEM Password'} :
			</label>
			<div class="col-lg-9">
				<div class="input-group fixed-width-lg">
					<span class="input-group-addon">
						<i class="icon-key"></i>
					</span>
					<input type="text" value="{$push_notification['pem_password']}" class="" name="pushnotification[pem_password]" id="pem_password">
				</div>
			</div>
		</div>
    </div>

	<div class="panel-heading" style="clear: both; margin-top: 20px;">
       {l s='Application Information'} 
	</div>
	<div class="form-wrapper">
        <div class="form-group">
			<label class="control-label col-lg-3">		
			</label>
			<div class="col-lg-9">
				<strong>{l s='The information shared here will be displayed on different social media platforms when someone share this app.'}</strong>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-lg-3">
				<span title="" data-html="true" data-toggle="tooltip" class="label-tooltip" data-original-title="{l s='This will your android app bundle identifier which will help user to redirect to play store app detail page.'}">
					{l s='Bundle ID'} :
				</span>
			</label>
			<div class="col-lg-9">
				<input type="text" name="app_info[bundle_id]" value="{$app_info['bundle_id']}" />
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-lg-3">
				<span title="" data-html="true" data-toggle="tooltip" class="label-tooltip" data-original-title="{l s='This will your iOS app id which will help user to redirect to itunes store app detail page.'}">
					{l s='iOS App ID'} :
				</span>
			</label>
			<div class="col-lg-9">
				<input type="text" name="app_info[iosappid]" value="{$app_info['iosappid']}">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-lg-3">
				{l s='App Name on Google Play Store'} :
			</label>
			<div class="col-lg-9">
				<input type="text" class="" value="{$app_info['android_appname']}" id="android_appname" name="app_info[android_appname]" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">
				{l s='App URL on Google Play Store'} :
			</label>
			<div class="col-lg-9">
				<input type="text" class="" value="{$app_info['android_appweburl']}" id="android_appweburl" name="app_info[android_appweburl]" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">
				{l s='App Name on Apple Store'} :
		   	</label>
			<div class="col-lg-9">
				<input type="text" size="40" class="" value="{$app_info['ios_appname']}" id="ios_appname" name="app_info[ios_appname]" />
		    </div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">
				{l s='App URL on Apple Store'} :
			</label>
			<div class="col-lg-9">
				<input type="text" size="40" class="" value="{$app_info['ios_appweburl']}" id="ios_appweburl" name="app_info[ios_appweburl]" />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">
				<span title="" data-html="true" data-toggle="tooltip" class="label-tooltip" data-original-title="{l s='This description will be used when soemone is sharing your app to any social media platform like Facebook, Google etc.'}">
					{l s='Application Description'} :
				</span>
			</label>
			<div class="col-lg-9">
				<textarea class=" textarea-autosize" id="app_description" name="app_info[app_description]" style="overflow: hidden; word-wrap: break-word; resize: none; height: 65px;">{$app_info['app_description']}</textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-3">
				{l s='Application Image'} :
			</label>
			<div class="col-lg-9">
				<div class="form-group">
                   	<div class="col-sm-6">
                   		<input type="file" class="hide" name="app_share_image" id="app_share_image">
                   		<div class="dummyfile input-group">
                   			<span class="input-group-addon"><i class="icon-file"></i></span>
                   			<input type="text" readonly="" name="app_info[app_share_image]" id="app_share_image-name" value="{$app_info['app_share_image']}" >
                   			<span class="input-group-btn">
                   				<button class="btn btn-default" name="submitAddAttachments" type="button" id="app_share_image-selectbutton">
                   					<i class="icon-folder-open"></i> {l s='Add file'}				
                                </button>
		               	    </span>
                  		</div>
                   	</div>
                </div>

                {if !empty($app_info['app_share_image'])}
                    <div class="form-group">
						<div id="image-images-thumbnails" class="col-lg-12">
							<div>
								<img class="imgm img-thumbnail" alt="" src="{$module_dir}media/mobi_commerce/{$app_code}/appinfo/{$app_info['app_share_image']}" width="150">
							</div>
						</div>
					</div>
				{/if}
				<script type="text/javascript">
					$(document).ready(function(){
						$('#app_share_image-selectbutton').click(function(e) {
							$('#app_share_image').trigger('click');
						});
						$('#app_share_image-name').click(function(e) {
							$('#app_share_image').trigger('click');
						});
						$('#app_share_image-name').on('dragenter', function(e) {
							e.stopPropagation();
							e.preventDefault();
						});
						$('#app_share_image-name').on('dragover', function(e) {
							e.stopPropagation();
							e.preventDefault();
						});
						$('#app_share_image-name').on('drop', function(e) {
							e.preventDefault();
							var files = e.originalEvent.dataTransfer.files;
							$('#app_share_image')[0].files = files;
							$(this).val(files[0].name);
						});
						$('#app_share_image').change(function(e) {
							if ($(this)[0].files !== undefined)
							{
								var files = $(this)[0].files;
								var name  = '';

								$.each(files, function(index, value) {
									name += value.name+', ';
								});
								$('#app_share_image-name').val(name.slice(0, -2));
							}
							else // Internet Explorer 9 Compatibility
							{
								var name = $(this).val().split(/[\\/]/);
								$('#app_share_image-name').val(name[name.length-1]);
							}
						});

						if (typeof app_share_image_max_files !== 'undefined')
						{
							$('#app_share_image').closest('form').on('submit', function(e) {
								if ($('#app_share_image')[0].files.length > app_share_image_max_files) {
									e.preventDefault();
									alert('You can upload a maximum of files');
								}
							});
						}
					});
				</script>
			</div>
		</div>
	</div>

    <div class="panel-footer">
		<button class="btn btn-default pull-right" name="updateApp" value="generalsettings" type="submit">
			<i class="process-icon-save"></i>{l s='Save'}
		</button>
		<a onclick="window.history.back();" class="btn btn-default" href="{$link->getAdminLink('MCManageApp')}">
			<i class="process-icon-cancel"></i>
            {l s='Cancel'}
		</a>
	</div>
</div>