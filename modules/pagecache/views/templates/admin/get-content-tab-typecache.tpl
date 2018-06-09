{*
* Page Cache powered by Jpresta (jpresta . com)
* 
*    @author    Jpresta
*    @copyright Jpresta
*    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
*               is permitted for one Prestashop instance only but you can install it on your test instances.
*}

<form id="pagecache_form_typecache" action="{$request_uri|escape:'html'}" method="post">
    <input type="hidden" name="submitModule" value="true"/>
    <input type="hidden" name="pctab" value="typecache"/>
    <fieldset>
        {if $avec_bootstrap}
            <div class="bootstrap"><div class="alert alert-info" style="display: block;">&nbsp;{l s='We provide 2 caching systems: "Standard file system" is fast but is consumming a lot of files on the disk, "Zip archives" is a bit slower but is consumming a few files (max 256) which are compressed with ZIP.' mod='pagecache'}</div></div>
        {else}
            <div class="hint clear" style="display: block;">&nbsp;{l s='We provide 2 caching systems: "Standard file system" is fast but is consumming a lot of files on the disk, "Zip archives" is a bit slower but is consumming a few files (max 256) which are compressed with ZIP.' mod='pagecache'}</div>
        {/if}
        <div style="clear: both; padding-top:15px;">
            <label class="conf_title">{l s='Choose one' mod='pagecache'}</label>
            <div class="margin-form">
                <select name="pagecache_typecache">
                    <option value="std" {if $pagecache_typecache != 'zip'}selected{/if}>{l s='Standard file system' mod='pagecache'}</option>
                    <option value="zip" {if $pagecache_typecache == 'zip'}selected{/if}>{l s='Zip archives' mod='pagecache'}</option>
                </select>
                <p class="preference_description">{l s='Choose how you want the cache to be stored' mod='pagecache'}</p>
            </div>
        </div>
        <div class="bootstrap">
            <button type="submit" value="1" id="submitModuleTypeCache" name="submitModuleTypeCache" class="btn btn-default pull-right">
                <i class="process-icon-save"></i> {l s='Save' mod='pagecache'}
            </button>
        </div>
    </fieldset>
</form>