{*
* Page Cache powered by Jpresta (jpresta . com)
* 
*    @author    Jpresta
*    @copyright Jpresta
*    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
*               is permitted for one Prestashop instance only but you can install it on your test instances.
*}

{if $avec_bootstrap}
    {assign var=logo value='logo.png'}
{else}
    {assign var=logo value='logo.gif'}
{/if}

<script type="text/javascript">
    function addWidget(widgetDisplayName, widgetName, hookName) {
        $("#widgetTables").append("<tr><td>"+widgetDisplayName+" ("+widgetName+")</td><td>"+hookName+"</td><td><button type=\"button\" onclick=\"removeWidget(\'"+widgetName+"\', \'"+hookName+"\'); this.closest(\'tr\').remove();\"><i class=\"icon-remove\"></i> {l s='Remove' mod='pagecache'}</button><input type=\"hidden\" name=\"pagecache_dynwidgets[]\" value=\""+widgetName+"|"+hookName+"\"/></td></tr>");
    }
    function removeWidget(widgetName, hookName) {
    }
</script>

<form id="pagecache_form_dynhooks" action="{$request_uri|escape:'html'}" method="post">
    <input type="hidden" name="submitModule" value="true"/>
    <input type="hidden" name="pctab" value="dynhooks"/>
    <fieldset>
        <div style="clear: both; padding-top:15px;">
            {if !$pagecache_debug}
                {if $avec_bootstrap}
                    <div class="bootstrap"><div class="alert alert-warning" style="display: block;">&nbsp;{l s='To be able to modify dynamic modules and widgets you must go back in "test mode" in first tab' mod='pagecache'}</div></div>
                {else}
                    <div class="warn clear" style="display: block;">&nbsp;{l s='To be able to modify dynamic modules and widgets you must go back in "test mode" in first tab' mod='pagecache'}</div>
                {/if}
            {/if}
            
            <p>{l s='Some modules or widgets need to be loaded dynamically like blockmyaccount that will display only if a customer is logged in. Blockviewed is another example and can be marked as dynamic. If you enabled ajax in blockcart then do not make it dynamic.' mod='pagecache'}</p>
            
            {if $avec_bootstrap}
                <div class="bootstrap"><div class="alert alert-info" style="display: block;">&nbsp;{l s='Note that dynamic module Ajax call are done all at once (one HTTP request)' mod='pagecache'}</div></div>
            {else}
                <div class="hint clear" style="display: block;">&nbsp;{l s='Note that dynamic module Ajax call are done all at once (one HTTP request)' mod='pagecache'}</div>
            {/if}
            
            <hr/><h3 id="tabdynhooksmodules">{l s='Dynamic modules' mod='pagecache'}</h3>
            <p><label class="t">{l s='Display all hooks' mod='pagecache'}: <input type="checkbox" onclick="$('.morehook').toggle()" name="displayall"/></label></p>

            {assign var=indexRow value=0}
            {foreach $module_list as $hook_name => $modules}
                <div style="clear: both;" {if !$modules['is_standard']}class="morehook"{/if}>
                    <label class="conf_title">{$hook_name|escape:'html'}</label>
                    <div class="margin-form">
                    {foreach $modules as $module}
                        {if is_array($module) && array_key_exists('dyn_is_checked', $module)}
                            <input {if $module['dyn_is_checked']}checked{/if} {if !$pagecache_debug}disabled{/if} type="checkbox" name="pagecache_hooks[]" id="dyn{$indexRow|escape:'html'}" value="{$hook_name|escape:'html'}|{$module['module']|escape:'html'}" onclick="$('#emptyspan{$indexRow|escape:'html'}').toggle();"/>
                            <label class="t" for="dyn{$indexRow|escape:'html'}" title="{$module['module_description']|escape:'html'}">
                                <img src="../modules/{$module['module']|escape:'html'}/{$logo|escape:'html'}" width="16" height="16" alt=""/>{$module['module_display_name']|escape:'html'}
                            </label>
                            <span {if !$module['dyn_is_checked']}style="display:none"{/if} id="emptyspan{$indexRow|escape:'html'}">
                                <input {if $module['empty_option_checked']}checked{/if} {if !$pagecache_debug}disabled{/if} type="checkbox" name="pagecache_hooks_empty_{$hook_name|escape:'html'}_{$module['module']|escape:'html'}" id="emptyoption{$indexRow|escape:'html'}" value="1"/>&nbsp;<label class="t" for="emptyoption{$indexRow|escape:'html'}">{l s='First, display an empty box' mod='pagecache'}</label>
                            </span>
                            <br/>
                            {assign var=indexRow value=$indexRow+1}
                        {/if}
                    {/foreach}
                    </div>
                </div>
            {/foreach}

            <br/><h3 id="tabdynhookswidgets">{l s='Dynamic widgets' mod='pagecache'}</h3>
            <input type="hidden" name="pcdynwidgets" value=""/>
            <p>{l s='Widgets are modules that can be displayed anywhere in the theme; they do not need any hook. This feature has been added in Prestashop 1.7. A widget can be displayed with an optional "hookName" that is used to choose a specific template.' mod='pagecache'}</p>
            <p>{l s='Here you can specify which widget must be refreshed dynamically (is relative to the current visitor).' mod='pagecache'}</p>
            
            <div style="margin:5px;">
                <label for="widgetName" style="float:inherit">{l s='Widget' mod='pagecache'}</label>
                <select name="widgetName" id="widgetName" style="width: 200px">
                    {foreach $widgets as $widget_name => $widget_display_name}
                        <option value="{$widget_name|escape:'html'}">{$widget_display_name|escape:'html'}</option>
                    {/foreach}
                </select>
                <label for="widgetHookName" style="float:inherit; padding-left: 20px">{l s='Hook name (optional)' mod='pagecache'}</label>
                <input id="widgetHookName" name="widgetHookName" style="width: 200px;" value="" type="text"/>
                <button type="button" onclick="addWidget($('#widgetName option:selected').text(), $('#widgetName').val(), $('#widgetHookName').val())" class="btn btn-default"><i class="icon-plus"></i> {l s='Add' mod='pagecache'}</button>
            </div>
            <div class="bootstrap">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr><th>{l s='Widget' mod='pagecache'}</th><th>{l s='Hook name' mod='pagecache'}</th><th></th></tr>
                    </thead>
                    <tbody id="widgetTables">
                        {foreach $dynamic_widgets as $dynWidget}
                            <tr><td>{$dynWidget['displayName']|escape:'html'} ({$dynWidget['name']|escape:'html'})</td><td>{$dynWidget['hook']|escape:'html'}</td><td><button type="button" onclick="removeWidget('{$dynWidget['name']|escape:'html'}', '{$dynWidget['hook']|escape:'html'}'); this.closest('tr').remove();"><i class="icon-remove"></i> {l s='Remove' mod='pagecache'}</button><input type="hidden" name="pagecache_dynwidgets[]" value="{$dynWidget['name']|escape:'html'}|{$dynWidget['hook']|escape:'html'}"/></td></tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
            
            <br/><h3 id="tabdynhooksjs">{l s='Javascript to execute' mod='pagecache'}</h3>
            <div id="cfgadvanced">
                <p>{l s='Here you can modify javascript code that is executed after dynamic modules and widgets have been displayed on the page.' mod='pagecache'}</p>
                <p>{l s='If you meet problems with your theme, ask your theme designer what javascript you should add here.' mod='pagecache'}</p>
                <textarea {if !$pagecache_debug}disabled{/if} name="cfgadvancedjs" style="width:95%" rows="20">{$pagecache_cfgadvancedjs|escape:'html'}</textarea>
            </div>

        </div>
        <div class="bootstrap">
            <button type="submit" value="1" id="submitModuleDynhooks" name="submitModuleDynhooks" class="btn btn-default pull-right">
                <i class="process-icon-save"></i> {l s='Save' mod='pagecache'}
            </button>
        </div>
    </fieldset>
</form>