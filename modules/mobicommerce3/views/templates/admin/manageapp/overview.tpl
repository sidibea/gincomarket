{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<input type="hidden" value="{$app->id}" id="id" name="id">
<input type="hidden" value="Overview" name="process_action" />
<input type="hidden" value="{$app_code}" name="appcode" />
<input type="hidden" value="{{$app->app_key}}" name="appkey" />
<div class="panel">
    <div class="panel-heading">
        <i class="icon-html5"></i>
        {l s='App Details'} 
    </div>
    <div class="form-wrapper">
        <div class="form-group">
            <label class=" col-lg-3">{l s='App Name'} </label>
            <div class="col-lg-9 ">
                {$app->app_name}
    		</div>
        </div> 

        <div class="form-group">  
            <label class=" col-lg-3">{l s='App Key'} </label>   
            <div class="col-lg-9 ">
                {$app->app_key}
    		</div>
        </div>
         
        <div class="form-group">  
            <label class=" col-lg-3">{l s='MobiCommerce Version'} </label>  
            <div class="col-lg-9 ">
                {if ($app->app_mode == '001')}
    		 	    {l s='Professional'}
                {else}
    		 	    {l s='Enterprise'}
                {/if}
    		</div>
        </div>
        <div class="form-group">   
            <label class="col-lg-3">{l s='License Type'} </label>
            <div class="col-lg-9">
                {if ($app->app_mode == 'demo')}
                    <div class="col-lg-2">
                        {$app->app_mode} Version
                    </div>
                    <div class="col-lg-2">
    				    <button onclick="buynow.submit()" type="button" class="btn btn-default btn-block">
                            <i class="icon-shopping-cart"></i>
                            {l s='Buy Now'}
                        </button>
                    </div>
                {/if}
    		</div>
        </div>
        <div class="form-group">   
            <label class="col-lg-3">{l s='Created Date'} : </label>    
            <div class="col-lg-9 ">
                {date("d-m-Y", strtotime($app->created_time))}
    		</div>
        </div>
    </div>

    {if ($app->app_mode == 'demo')}
        <div class="panel-heading" style="clear: both;margin-top: 20px;">
            <i class="icon-html5"></i>
            {l s='Android App'} 
        </div>
        <div class="form-wrapper">
            <div class="form-group">
                <label class=" col-lg-3">{l s='Android App Status'}  </label>
                <div class="col-lg-9 ">
    		        {$app->android_status}
        		</div>
            </div>
             
            <div class="form-group">
                <label class=" col-lg-3">{l s='Download Android App'} </label>  
                <div class="col-lg-9 ">
                    {if (empty($app->android_url))}
                        {l s='Url will be Updated as soon as the app ready to download'}
                    {else}
                        {$app->android_url}
                        <a href="#emailmeandroiddemourl" class="fancybox btn btn-link">{l s='Email me this URL'}</a>
    				    <a class="fancybox btn btn-link" href="#android-demo-app-qrcode" >{l s='QR Code of this URL'}</a>
                        <div id="android-demo-app-qrcode" class="qr-code" style="display:none">
                            <div class="custom-overlay-close" onclick="closepopup(this)" style="display:none">X</div>
                            <img  src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl={$app->android_url}&choe=UTF-8"/>
    				    </div>

    				    <div id="emailmeandroiddemourl" class="emailmeparent" style="display:none;">
                            <div class="custom-overlay-close" onclick="closepopup(this)" style="display:none">X</div>
                            <input type="hidden" value="android" name="templatetype" class="templatetype"/>
                            <div class="label-email">{l s='Enter your Email Address'}</div></br>
                            <input type="text" class="emailid" name="emailid" value=""/></br>
                            <input type="hidden" name="url" class="app-url"  value="{$app->android_url}"/>
                            {l s='Android URL will be sent to this email address'}</br></br>
                            <a class="send-email" onclick="emailme(this)">{l s='Send Email'}</a>
    				    </div>
                    {/if}
        		</div>
            </div>
             
            {if (!empty($app->android_url))}
                <div class="form-group">  
                    <div class="col-lg-9 ">
                        <span>{l s='Open the above URL in your android phone browser, it will download the mobile app in your mobile device'}</span><br>
    					<span>{l s='If you have any mobicommerce demo app installed in your mobile device please uninstall that before installing a new mobicommerce demo app'}</span>     
            		</div>
                </div>
            {/if}
        </div>
    {/if}

    {if ($app->app_mode == 'live')}
        <div class="panel-heading" style="clear: both;margin-top: 20px;">
            <i class="icon-html5"></i>
            {l s='Android App Deliverables'} 
        </div>
        <div class="form-wrapper">
            <div class="form-group">
                <label class=" col-lg-3">{l s='Android Status'}  </label>
                <div class="col-lg-9 ">
    		        {$app->android_status}
        		</div>
            </div> 
             
            <div class="form-group">
                <label class=" col-lg-3">{l s='Download Android Deliverables'} : </label>
                <div class="col-lg-9 ">
                    {if (!empty($app->android_url))}                    
        		      {$app->android_url}
                        <a href="#emailmeandroiddemourl" class="fancybox">{l s='Email me this URL'}</a>
    				    <a class="fancybox" href="#android-demo-app-qrcode" >{l s='QR Code of this URL'}</a>
                        <div id="android-demo-app-qrcode" class="qr-code" style="display:none">
    				       <div class="custom-overlay-close" onclick="closepopup(this)" style="display:none">X</div>
    				       <img  src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl={$app->android_url}&choe=UTF-8"/>
    				    </div>

    				    <div id="emailmeandroiddemourl" class="emailmeparent" style="display:none;">
    				        <div class="custom-overlay-close" onclick="closepopup(this)" style="display:none">X</div>
                            <input type="hidden" value="android" name="templatetype" class="templatetype"/>
    				        <div class="label-email">{l s='Enter your Email Address'}</div></br>
    				        <input type="text" class="emailid" name="emailid" value=""/></br>
                            <input type="hidden" name="url" class="app-url"  value="{$app->android_url}"/>
                            {l s='Android URL will be sent to this email address'}</br></br>
                            <a class="send-email" onclick="emailme(this)">{l s='Send Email'}</a>
    				    </div>
                    {/if}
        		</div>
            </div>
             
            {if (!empty($app->android_url))}
                <div class="form-group">  
                    <div class="col-lg-9 ">
                        <span>{l s='Open the above URL in your android phone browser, it will download the mobile app in your mobile device'}</span><br>
    					<span>{l s='If you have any mobicommerce demo app installed in your mobile device please uninstall that before installing a new mobicommerce demo app'}</span>     
            		</div>
                </div>
            {/if}
        </div>
    {/if}
    <div class="panel-footer">
		<button class="btn btn-default pull-right" name="updateApp" value="overview" type="submit">
		<i class="process-icon-save"></i>    {l s='Save'}   
		</button>
			<a onclick="window.history.back();" class="btn btn-default" href="{$link->getAdminLink('MCManageApp')}">
		<i class="process-icon-cancel"></i>
        {l s='Cancel'}
		</a>
	</div>
</div>

<div class="custom-overlay fancybox-overlay" style="display:none"></div>

<script language="javascript">
    $(document).ready(function () {
        $('.fancybox').fancybox();
    });

    var urlEmail = "{$link->getAdminLink('MCManageApp')|addslashes}";
    function checkudid(udids)
    {
	   var validated = true;
	   var parseudids = udids.split(',');
       parseudids.each(function(key){
            if(key.length && key.trim().length != 40){
                validated = false;
            }
	   });
	   return validated;
    }
    
    function emailme(e)
	{
		var emailid = $(e).parents('.emailmeparent').find('.emailid').val();
		var appurl = $(e).parents('.emailmeparent').find('.app-url').val();
		var templatetype = $(e).parents('.emailmeparent').find('.templatetype').val();
		if(emailid == '')
        {
            alert('Please Insert Email Id First');
		}
        else
        {
			if(appurl !='')
			{
				if(IsEmail(emailid)) {
					$.ajax({
        				url: urlEmail,
        				type: 'POST',
                        async: true,
        				data : {
                            'ajax' : "1",
                            'action' : 'sendEmail',
                            'emailid' : emailid,
                            'appurl' : appurl,
                            'templatetype':templatetype
                        },
        				success: function(response){
                            if(response == 'success')
                            {
                                alert(response);
                                $.fancybox.close();
                            }
                            else
                            {
                                alert(response);   
                                $.fancybox.close();
                            }
        				}
        			}); 
				} 
				else
				{
					alert('Please Insert Valid Email Id!');
				}
			}
		}   
	}
</script>