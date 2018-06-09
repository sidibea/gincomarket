{*
* Page Cache powered by Jpresta (jpresta . com)
* 
*    @author    Jpresta
*    @copyright Jpresta
*    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
*               is permitted for one Prestashop instance only but you can install it on your test instances.
*}

<form id="pagecache_form_cron" action="{$request_uri|escape:'html'}" method="post">
    <input type="hidden" name="submitModule" value="true"/>
    <input type="hidden" name="pctab" value="cron"/>
    <fieldset>
        {if $avec_bootstrap}
            <div class="bootstrap"><div class="alert alert-info" style="display: block;">&nbsp;{l s='CRON jobs are scheduled tasks. Here you will find URLs that will allow you to refresh cache in scheduled tasks.' mod='pagecache'}</div></div>
        {else}
            <div class="hint clear" style="display: block;">&nbsp;{l s='CRON jobs are scheduled tasks. Here you will find URLs that will allow you to refresh cache in scheduled tasks.' mod='pagecache'}</div>
        {/if}
        <p>{l s='People who want to clear cache with a CRON job can use the following URLs (one per shop, returns 200 if OK, 404 if there is an error): ' mod='pagecache'}
            <ul>
            {foreach $cron_urls as $controller_name => $cron_url}
                <li>{$cron_url|escape:'javascript'}</li>
            {/foreach}
            </ul>
        </p>
        <p class="preference_description">{l s='To refresh cache of a specific product add "&product=<product\'s ids separated by commas>", for a category add "&category=<category\'s ids separated by commas>", for home page add "&index", etc.' mod='pagecache'}</p>
    </fieldset>
</form>