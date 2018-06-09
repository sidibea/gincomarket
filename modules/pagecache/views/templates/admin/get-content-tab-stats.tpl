{*
* Page Cache powered by Jpresta (jpresta . com)
* 
*    @author    Jpresta
*    @copyright Jpresta
*    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
*               is permitted for one Prestashop instance only but you can install it on your test instances.
*}

<form id="pagecache_form_stats" action="{$request_uri|escape:'html'}" method="post">
    <input type="hidden" name="submitModule" value="true"/>
    <input type="hidden" name="pctab" value="stats"/>
    <fieldset class="cachemanagement">
        {if $avec_bootstrap}
            <div class="bootstrap"><div class="alert alert-info" style="display: block;">&nbsp;{l s='This table shows you the 100 most viewed pages. You can see how many times the cache is used (hit) and how many times the cache is built (missed).' mod='pagecache'}</div></div>
        {else}
            <div class="hint clear" style="display: block;">&nbsp;{l s='This table shows you the 100 most viewed pages. You can see how many times the cache is used (hit) and how many times the cache is built (missed).' mod='pagecache'}</div>
        {/if}

        <div class="bootstrap">
            <button type="submit" value="1" id="submitModuleOnOffStats" name="submitModuleOnOffStats" class="btn btn-default">
                <i class="process-icon-off" style="color:{if $pagecache_stats}red{else}rgb(139, 201, 84){/if}"></i> {if $pagecache_stats}{l s='Disable statistics' mod='pagecache'}{else}{l s='Enable statistics' mod='pagecache'}{/if}
            </button>
            {if $pagecache_stats}
                <button type="submit" value="1" id="submitModuleResetStats" name="submitModuleResetStats" class="btn btn-default">
                    <i class="process-icon-delete" style="color:orange"></i> {l s='Clear cache and reset statistics' mod='pagecache'}
                </button>
            {/if}
        </div>

        {if $pagecache_stats}
            <div style="clear: both; padding-top:15px;">
                <table cellspacing="0" cellspadding="0">
                    <tr>
                        <th width="40%" title="{l s='Click on the link to open the page in a new window' mod='pagecache'}">{l s='Page' mod='pagecache'}</th>
                        <th width="20%" title="{l s='Cache has been used, this is good' mod='pagecache'}">{l s='Hit' mod='pagecache'}</th>
                        <th width="20%" title="{l s='Cache has not been used, this is bad' mod='pagecache'}">{l s='Missed' mod='pagecache'}</th>
                        <th width="20%" title="{l s='The higher the value, the better it is.' mod='pagecache'}">{l s='Percent hit' mod='pagecache'}</th>
                    </tr>
                    {foreach $stats as $stat}
                        <tr><td><a href="{$stat['url']|escape:'html'}" target="_blank" title="{$stat['url']|escape:'html'}">{$stat['url']|escape:'html'}</a></td><td>{$stat['hit']|escape:'html'}</td><td>{$stat['missed']|escape:'html'}</td><td>{$stat['percent']|escape:'html'}</td></tr>
                    {foreachelse}
                        <tr><td colspan="4"><i>{l s='No statistics available yet' mod='pagecache'}</i></td></tr>
                    {/foreach}
                </table>
            </div>
        {/if}

    </fieldset>
</form>