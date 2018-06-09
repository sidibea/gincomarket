{*
* Page Cache powered by Jpresta (jpresta . com)
* 
*    @author    Jpresta
*    @copyright Jpresta
*    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
*               is permitted for one Prestashop instance only but you can install it on your test instances.
*}

<form id="pagecache_form_diagnostic" action="{$request_uri|escape:'html'}" method="post">
    <input type="hidden" name="submitModule" value="true"/>
    <input type="hidden" name="pctab" value="diagnostic"/>
    <fieldset>
        {if $diagnostic_count == 0}
            <img src="../modules/{$module_name|escape:'html'}/views/img/check.png" alt="ok" width="24" height="24"/>{l s='Everything is good!' mod='pagecache'}
        {/if}
        {foreach $diagnostic['error'] as $diagMsg}
            {if $avec_bootstrap}
                <div class="bootstrap"><div class="alert alert-danger" style="display: block;">&nbsp;{$diagMsg['msg']|escape:'html'}.{if array_key_exists('link', $diagMsg)} <a href="{$diagMsg['link']}">{$diagMsg['link_title']|escape:'html'}.</a>{/if}</div></div>
            {else}
                <div class="error clear" style="display: block;">&nbsp;{$diagMsg['msg']|escape:'html'}.{if array_key_exists('link', $diagMsg)} <a href="{$diagMsg['link']}">{$diagMsg['link_title']|escape:'html'}.</a>{/if}</div>
            {/if}
        {/foreach}
        {foreach $diagnostic['warn'] as $diagMsg}
            {if $avec_bootstrap}
                <div class="bootstrap"><div class="alert alert-warning" style="display: block;">&nbsp;{$diagMsg['msg']|escape:'html'}.{if array_key_exists('link', $diagMsg)} <a href="{$diagMsg['link']}">{$diagMsg['link_title']|escape:'html'}.</a>{/if}</div></div>
            {else}
                <div class="warn clear" style="display: block;">&nbsp;{$diagMsg['msg']|escape:'html'}.{if array_key_exists('link', $diagMsg)} <a href="{$diagMsg['link']}">{$diagMsg['link_title']|escape:'html'}.</a>{/if}</div>
            {/if}
        {/foreach}
        {foreach $diagnostic['info'] as $diagMsg}
            {if $avec_bootstrap}
                <div class="bootstrap"><div class="alert alert-info" style="display: block;">&nbsp;{$diagMsg['msg']|escape:'html'}.{if array_key_exists('link', $diagMsg)} <a href="{$diagMsg['link']}">{$diagMsg['link_title']|escape:'html'}.</a>{/if}</div></div>
            {else}
                <div class="hint clear" style="display: block;">&nbsp;{$diagMsg['msg']|escape:'html'}.{if array_key_exists('link', $diagMsg)} <a href="{$diagMsg['link']}">{$diagMsg['link_title']|escape:'html'}.</a>{/if}</div>
            {/if}
        {/foreach}
    </fieldset>
</form>