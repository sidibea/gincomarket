{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<div class="panel">
	<div class="productTabs">
		<ul class="tab nav nav-tabs">
		  	{foreach $product_tabs key=numStep item=tab}
				<li class="tab-row">
					<a class="tab-page {if $sel_tab == $tab.name}active{/if}" id="cart_{$numStep}" data-item='{$numStep|strtolower}' href="javascript:displayCartRuleTab('{$numStep|strtolower}');" onclick="$('#sel_tab').val('{$tab.name|strtolower}')"><i class="icon-wrench"></i> {$tab.name}</a>
				</li>
  	        {/foreach}
		</ul>
	</div>
	<div id="widgetLang" class="panel">
		<form method="POST" action="" id="social_login" class="defaultForm form-horizontal MCLabels">
			{foreach $product_tabs key=numStep item=tab}
				<div id="cart_rule_{$numStep|strtolower}" class=" cart_rule_tab clearfix">
					<div class="panel">
						{if $numStep eq 'Facebook'}
							<div class="panel-heading">
								<i class="icon-facebook"></i>{l s='Facebook Login Configuration'}
							</div>
							<div class="form-wrapper">
								<div class="form-group">
									<label class="control-label col-lg-3">{l s='Facebook Login Active'}</label>
									<div class="col-lg-9">
										<select name="sociallogin[facebook][isactive]" class=" fixed-width-xl" id="sociallogin_facebook_isactive">
											<option value="0" {if  $mobi_fb_active == 0}selected="selected"{/if}>{l s='No'}</option>
											<option value="1" {if  $mobi_fb_active == 1}selected="selected"{/if}>{l s='Yes'}</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">{l s='Title'}</label>
									<div class="col-lg-4">
										<input type="text" name="sociallogin[facebook][title]" id="sociallogin_facebook_title" value="{$mobi_fb_title}">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">{l s='App ID'}</label>
									<div class="col-lg-4">
										<input type="text" name="sociallogin[facebook][appid]" id="sociallogin_facebook_appid" value="{$mobi_fb_appid}">
									</div>
								</div>								
								<div class="form-group">
									<label class="control-label col-lg-3">{l s='App Name'}</label>
									<div class="col-lg-4">
										<input type="text" name="sociallogin[facebook][appname]" id="sociallogin_facebook_appname" value="{$mobi_fb_appname}">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">{l s='Sort Order'}</label>
									<div class="col-lg-4">
										<input type="text" name="sociallogin[facebook][sortorder]" id="sociallogin_facebook_sortorder" value="{$mobi_fb_sortorder}">
									</div>
								</div>
							</div>
						{/if}

						{if $numStep eq 'Google'}
							<div class="panel-heading">
								<i class="icon-google"></i>{l s='Google Login Configuration'}
							</div>
							<div class="form-wrapper">
								<div class="form-group">
									<label class="control-label col-lg-3">{l s='Google Login Active'}</label>
									<div class="col-lg-9">
										<select name="sociallogin[google][isactive]" class=" fixed-width-xl" id="sociallogin_google_isactive">
											<option value="0" {if  $mobi_go_active == 0}selected="selected"{/if}>{l s='No'}</option>
											<option value="1" {if  $mobi_go_active == 1}selected="selected"{/if}>{l s='Yes'}</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">{l s='Title'}</label>
									<div class="col-lg-4">
										<input type="text" name="sociallogin[google][title]" id="sociallogin_google_title" value="{$mobi_go_title}">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">{l s='SHA1 Key'}</label>
									<div class="col-lg-4">
										<input type="text" name="sociallogin[google][sha1key]" id="sociallogin_google_sha1key" value="{$mobi_go_sha1key}">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">{l s='Client ID'}</label>
									<div class="col-lg-4">
										<input type="text" name="sociallogin[google][clientid]" id="sociallogin_google_clientid" value="{$mobi_go_clientid}">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-lg-3">{l s='Sort Order'}</label>
									<div class="col-lg-4">
										<input type="text" name="sociallogin[google][sortorder]" id="sociallogin_google_sortorder" value="{$mobi_go_sortorder}">
									</div>
								</div>
							</div>
						{/if}
					</div>
					<div class="panel-footer">
						<button class="btn btn-default pull-right" name="submitSocialLogins" value="1" type="submit" onclick="$('#sel_lab_tab').val('labels');">
							<i class="process-icon-save"></i>    {l s='Save'}   
						</button>
					</div>
				</div>
			{/foreach}
		</form>
	</div>
</div>
<script type="text/javascript" data-cfasync="false">  

    var currentFormtab = $('.tab li a').data('item');

	$('.cart_rule_tab').hide();
	$('.tab-row.active').removeClass('active');
	$('#cart_rule_'+ currentFormtab).show();
	$('#cart_rule_link_' + currentFormtab).parent().addClass('active');

	function displayCartRuleTab(tab)
	{
		$('.cart_rule_tab').hide();
		$('.tab-row .tab-page.active').removeClass('active');
		$('#cart_rule_' + tab).show();
		$('#cart_rule_link_' + tab).parent().addClass('active');
		$('.tab-page[data-item="'+tab+'"]').addClass('active');
		$('#currentFormTab').val(tab);
	}

    displayCartRuleTab('{$sel_tab|strtolower}');

    jQuery(document).ready(function(){
    	displayCartRuleTab('facebook');
    });
</script>