{*
* Page Cache powered by Jpresta (jpresta . com)
* 
*    @author    Jpresta
*    @copyright Jpresta
*    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
*               is permitted for one Prestashop instance only but you can install it on your test instances.
*}

<form id="pagecache_form_options" action="{$request_uri|escape:'html'}" method="post">
    <input type="hidden" name="submitModule" value="true"/>
    <input type="hidden" name="pctab" value="options"/>
    <fieldset>
        <div style="clear: both; padding-top:15px;">
            <label class="conf_title">{l s='No cache for logged in users' mod='pagecache'}</label>
            <div class="margin-form">
                <label class="t" for="pagecache_pagecache_skiplogged_on"><img src="../img/admin/enabled.gif" alt="{l s='Yes' mod='pagecache'}" title="{l s='Yes' mod='pagecache'}"></label>
                <input type="radio" name="pagecache_skiplogged" id="pagecache_pagecache_skiplogged_on" value="1" {if $pagecache_skiplogged}checked{/if}>
                <label class="t" for="pagecache_pagecache_skiplogged_on"> {l s='Yes' mod='pagecache'}</label>
                <label class="t" for="pagecache_pagecache_skiplogged_off"><img src="../img/admin/disabled.gif" alt="{l s='No' mod='pagecache'}" title="{l s='No' mod='pagecache'}" style="margin-left: 10px;"></label>
                <input type="radio" name="pagecache_skiplogged" id="pagecache_pagecache_skiplogged_off" value="0" {if !$pagecache_skiplogged}checked{/if}>
                <label class="t" for="pagecache_pagecache_skiplogged_off"> {l s='No' mod='pagecache'}</label>
                <p class="preference_description">{l s='Disable cache for visitors that are logged in' mod='pagecache'}</p>
            </div>
            <label class="conf_title">{l s='Normalize URLs' mod='pagecache'}</label>
            <div class="margin-form">
                <label class="t" for="pagecache_pagecache_normalize_urls_on"><img src="../img/admin/enabled.gif" alt="{l s='Yes' mod='pagecache'}" title="{l s='Yes' mod='pagecache'}"></label>
                <input type="radio" name="pagecache_normalize_urls" id="pagecache_pagecache_normalize_urls_on" value="1" {if $pagecache_normalize_urls}checked{/if}>
                <label class="t" for="pagecache_pagecache_normalize_urls_on"> {l s='Yes' mod='pagecache'}</label>
                <label class="t" for="pagecache_pagecache_normalize_urls_off"><img src="../img/admin/disabled.gif" alt="{l s='No' mod='pagecache'}" title="{l s='No' mod='pagecache'}" style="margin-left: 10px;"></label>
                <input type="radio" name="pagecache_normalize_urls" id="pagecache_pagecache_normalize_urls_off" value="0" {if !$pagecache_normalize_urls}checked{/if}>
                <label class="t" for="pagecache_pagecache_normalize_urls_off"> {l s='No' mod='pagecache'}</label>
                <p class="preference_description">{l s='Avoid same page linked with different URLs to use different cache. Should only be disabled when you have a lot of links in a page (> 500).' mod='pagecache'}</p>
            </div>
            <label class="conf_title">{l s='Enable logs' mod='pagecache'}</label>
            <div class="margin-form">
                <label class="t" for="pagecache_logs_debug"><img src="../img/admin/enabled.gif" alt="{l s='Debug' mod='pagecache'}" title="{l s='Debug' mod='pagecache'}"><img src="../img/admin/enabled.gif" alt="{l s='Yes' mod='pagecache'}" title="{l s='Yes' mod='pagecache'}"></label>
                <input type="radio" name="pagecache_logs" id="pagecache_logs_debug" value="2" {if $pagecache_logs == 2}checked{/if}>
                <label class="t" for="pagecache_logs_debug"> {l s='Debug' mod='pagecache'}</label>
                <label class="t" for="pagecache_logs_on"><img src="../img/admin/enabled.gif" alt="{l s='Info' mod='pagecache'}" title="{l s='Info' mod='pagecache'}"></label>
                <input type="radio" name="pagecache_logs" id="pagecache_logs_on" value="1" {if $pagecache_logs == 1}checked{/if}>
                <label class="t" for="pagecache_logs_on"> {l s='Info' mod='pagecache'}</label>
                <label class="t" for="pagecache_logs_off"><img src="../img/admin/disabled.gif" alt="{l s='None' mod='pagecache'}" title="{l s='None' mod='pagecache'}" style="margin-left: 10px;"></label>
                <input type="radio" name="pagecache_logs" id="pagecache_logs_off" value="0" {if $pagecache_logs == 0}checked{/if}>
                <label class="t" for="pagecache_logs_off"> {l s='None' mod='pagecache'}</label>
                <p class="preference_description">{l s='Logs informations into the Prestashop logger. You should only enable it to debug or understand how the cache works.' mod='pagecache'}</p>
            </div>
            <label class="conf_title">{l s='Ignored URL parameters' mod='pagecache'}</label>
            <div class="margin-form">
                <input type="text" name="pagecache_ignored_params" id="pagecache_ignored_params" value="{$pagecache_ignored_params|escape:'html'}" size="100">
                <p class="preference_description">{l s='URL parameters are used to identify a unique page content. Some URL parameters do not affect page content like tracking parameters for analytics (utm_source, utm_campaign, etc.) so we can ignore them. You can set a comma separated list of these parameters here.' mod='pagecache'}</p>
            </div>
            <label class="conf_title">{l s='Always display infos box' mod='pagecache'}</label>
            <div class="margin-form">
                <label class="t" for="pagecache_pagecache_always_infosbox_on"><img src="../img/admin/enabled.gif" alt="{l s='Yes' mod='pagecache'}" title="{l s='Yes' mod='pagecache'}"></label>
                <input type="radio" name="pagecache_always_infosbox" id="pagecache_pagecache_always_infosbox_on" value="1" {if $pagecache_always_infosbox}checked{/if}>
                <label class="t" for="pagecache_pagecache_always_infosbox_on"> {l s='Yes' mod='pagecache'}</label>
                <label class="t" for="pagecache_pagecache_always_infosbox_off"><img src="../img/admin/disabled.gif" alt="{l s='No' mod='pagecache'}" title="{l s='No' mod='pagecache'}" style="margin-left: 10px;"></label>
                <input type="radio" name="pagecache_always_infosbox" id="pagecache_pagecache_always_infosbox_off" value="0" {if !$pagecache_always_infosbox}checked{/if}>
                <label class="t" for="pagecache_pagecache_always_infosbox_off"> {l s='No' mod='pagecache'}</label>
                <p class="preference_description">{l s='Only used for demo' mod='pagecache'}</p>
            </div>
            <label class="conf_title">{l s='Create separate cache for desktop and mobile' mod='pagecache'}</label>
            <div class="margin-form">
                <label class="t" for="pagecache_pagecache_depend_on_device_auto_on"><img src="../img/admin/enabled.gif" alt="{l s='Yes' mod='pagecache'}" title="{l s='Yes' mod='pagecache'}"></label>
                <input type="radio" name="pagecache_depend_on_device_auto" id="pagecache_pagecache_depend_on_device_auto_on" value="1" {if $pagecache_depend_on_device_auto}checked{/if}>
                <label class="t" for="pagecache_pagecache_depend_on_device_auto_on"> {l s='Yes' mod='pagecache'}</label>
                <label class="t" for="pagecache_pagecache_depend_on_device_auto_off"><img src="../img/admin/disabled.gif" alt="{l s='No' mod='pagecache'}" title="{l s='No' mod='pagecache'}" style="margin-left: 10px;"></label>
                <input type="radio" name="pagecache_depend_on_device_auto" id="pagecache_pagecache_depend_on_device_auto_off" value="0" {if !$pagecache_depend_on_device_auto}checked{/if}>
                <label class="t" for="pagecache_pagecache_depend_on_device_auto_off"> {l s='No' mod='pagecache'}</label>
                <p class="preference_description">{l s='If you know that your mobile version is the same as the desktop version then you can disable this option' mod='pagecache'}</p>
            </div>
        </div>
        <div class="bootstrap">
            <button type="submit" value="1" id="submitModuleOptions" name="submitModuleOptions" class="btn btn-default pull-right">
                <i class="process-icon-save"></i> {l s='Save' mod='pagecache'}
            </button>
        </div>
    </fieldset>
</form>