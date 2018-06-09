{*
* Page Cache powered by Jpresta (jpresta . com)
* 
*    @author    Jpresta
*    @copyright Jpresta
*    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
*               is permitted for one Prestashop instance only but you can install it on your test instances.
*}

<style>
    #pagecachecfg { margin-top: 10px;}
    #pagecachecfg ul, #pagecachecfg ol{ margin-left:20px;}
    #pagecachecfg .dynhooks label{ line-height:18px;}
    #pagecachecfg .cachemanagement table{ width:100%;border:1px solid #CCCED7;border-right:none;}
    #pagecachecfg .cachemanagement td, #pagecachecfg .cachemanagement th{ border-right:1px solid #CCCED7;padding:3px;}
    #pagecachecfg .cachemanagement td{ border-bottom:1px solid #CCCED7;}
    #pagecachecfg .cachemanagement th{ background-color:#eee;border-bottom:1px solid #CCCED7;}
    #pagecachecfg .tag{ background-color:#eee;border:1px solid #CCCED7;border-radius:4px;display:inline-block;margin:2px;padding:3px;}
    #linkadvanced{ font-weight:700;display:block;margin:15px 5px;}
    #pagecachecfg input[disabled]{ opacity:0.5;filter:alpha(opacity=50);}
    #pagecachecfg .bootstrap .nav-tabs{ margin-left:0;}
    #pagecachecfg .bootstrap .nav-tabs li a{ font-size:1.2em;}
    #pagecachecfg .bootstrap .nav-tabs li.active a, #pagecachecfg .bootstrap .nav-tabs li.active a:visited,.bootstrap .nav-tabs li.active a:hover, #pagecachecfg .bootstrap .nav-tabs li.active a:focus{ background-color:#ebedf4;}
    #pagecachecfg .nobootstrap fieldset{ border:1px solid #ddd;margin:0;}
    #pagecachecfg .installstep{ font-size:1.3em;margin:5px 0 20px;}
    #pagecachecfg a.browsebtn{ display:inline-block;color:#FFF;background-color:#F0AD4E;border:1px solid #EEA236;border-radius:3px;text-decoration:none;padding:2px;}
    #pagecachecfg a.browsebtn:hover{ background-color:#F5C177}
    #pagecachecfg .okbtn{ display:inline-block;color:#FFF;background-color:#59C763;border:1px solid #4EA948;border-radius:3px;text-decoration:none;margin:3px;padding:2px;}
    #pagecachecfg .okbtn:hover{ background-color:#7DD385}
    #pagecachecfg a.kobtn{ display:inline-block;color:#DA0000;border-radius:3px;margin:3px;padding:2px;}
    #pagecachecfg a.kobtn:hover{ color:#ED8080}
    #pagecachecfg div.step{ margin:5px 0 5px 20px;}
    #pagecachecfg .step span{ border-radius:.8em;color:#FFF;display:inline-block;font-weight:700;line-height:1.6em;margin-right:15px;text-align:center;width:1.6em;}
    #pagecachecfg .step img{ margin-right:15px;}
    #pagecachecfg .steptodo span{ background:#CCC;}
    #pagecachecfg .stepok span{ background:#5EA226;color:#FFF;}
    #pagecachecfg .stepok{ color:#5EA226;}
    #pagecachecfg .stepdesc{ border-left:2px solid #CCCED7;margin-left:44px;padding:10px 0 10px 24px;}
    #pagecachecfg .stepdesc img{ margin:2px;}
    #pagecachecfg .stepdesc ol,.stephelp ol{ margin:0;padding:0 0 0 24px;}
    #pagecachecfg .stephelp { display:none;border: 1px solid rgb(229, 229, 29);background-color: lightyellow;border-radius: 8px;padding: 10px;margin: 10px 0;}
    #pagecachecfg .morehook { display: none}
    #pagecachecfg .actions { margin: 15px 0 0 15px;}
    #pagecachecfg .btn { margin-right: 5px}
    #pagecachecfg.ps15 ul.nav-tabs li{ display: inline-block; padding: 5px; margin: 0 5px 0 0; border-radius: 5px 5px 0 0; background-color: #EBEDF4; border: 1px solid #CCCED7; border-bottom: none;}
    #pagecachecfg.ps15 ul.nav-tabs li.active{ background-color: #49B2FF; color:white}
    #pagecachecfg.ps15 ul.nav-tabs li a, #pagecachecfg.ps15 a.okbtn, #pagecachecfg.ps15 a.browsebtn { text-decoration: none;}
    #pagecachecfg.ps15 .bootstrap .nav-tabs li.active a { background-color: #49B2FF; color:white;text-decoration: none;}
    #pagecachecfg.ps15 a { text-decoration: underline;}
    #pagecachecfg.ps15 ol { list-style-type: decimal;}
    #pagecachecfg #timeouts { font-size: 1.2em;}
    #pagecachecfg #timeouts .slider-horizontal { margin: 5px 10px;}
    #pagecachecfg #timeouts table td { padding: 3px;text-align:right}
    #pagecachecfg #timeouts table td.slider { text-align:left}
    #pagecachecfg #timeouts table td.label { padding-right: 5px; font-weight: bold;}
    #pagecachecfg #timeouts table .first td { padding-top: 20px;}
</style>
<script type="text/javascript">
    $( document ).ready(function() {
        switch (window.location.hash) {
            case "#tabinstall":    displayTab("install"); break;
            case "#tabdynhooks":    displayTab("dynhooks"); break;
            case "#tabdynhooksjs":    displayTab("dynhooks"); break;
            case "#taboptions":    displayTab("options"); break;
            case "#tabtypecache":    displayTab("typecache"); break;
            case "#tabdiagnostic":    displayTab("diagnostic"); break;
            case "#tabtimeouts":    displayTab("timeouts"); break;
            case "#tabstats":    displayTab("stats"); break;
            case "#tabcron":    displayTab("cron"); break;
            case "#tabcachemanagement":    displayTab("cachemanagement"); break;
        }
    });
    function displayTab(tab) {
        $(".pctab").hide();
        $("#"+tab).show();
        $(".nav-tabs .active").removeClass("active");
        $("#li"+tab).addClass("active");
    }
</script>

<div id="pagecachecfg" {if !$avec_bootstrap}class="ps15"{/if}>


    {foreach $msg_success as $msg}
    <div class="bootstrap">
        <div class="module_confirmation conf confirm alert alert-success">{if $avec_bootstrap}<button type="button" class="close" data-dismiss="alert">&times;</button>{/if}{$msg|escape:'html'}</div>
    </div>
    {/foreach}
    {foreach $msg_infos as $msg}
    <div class="bootstrap">
        <div class="alert alert-info">{if $avec_bootstrap}<button type="button" class="close" data-dismiss="alert">&times;</button>{/if}{$msg|escape:'html'}</div>
    </div>
    {/foreach}
    {foreach $msg_warnings as $msg}
    <div class="bootstrap">
        <div class="module_warning alert alert-warning">{if $avec_bootstrap}<button type="button" class="close" data-dismiss="alert">&times;</button>{/if}{$msg|escape:'html'}</div>
    </div>
    {/foreach}
    {foreach $msg_errors as $msg}
    <div class="bootstrap">
        <div class="module_error alert alert-danger">{if $avec_bootstrap}<button type="button" class="close" data-dismiss="alert">&times;</button>{/if}{$msg|escape:'html'}</div>
    </div>
    {/foreach}

<div class="bootstrap">
   <ul class="nav nav-tabs">
      <li id="liinstall" role="presentation" {if $pctab eq 'install'}class="active"{/if}><a href="#tabinstall" onclick="displayTab('install');return true;">{if $avec_bootstrap}<i class="icon-wrench"></i>{else}<img width="16" height="16" src="../img/admin/prefs.gif" alt=""/>{/if}&nbsp;{l s='Installation' mod='pagecache'}</a></li>
      <li id="lidynhooks" role="presentation" {if $pctab eq 'dynhooks'}class="active"{/if}><a href="#tabdynhooks" onclick="displayTab('dynhooks');return true;">{if $avec_bootstrap}<i class="icon-puzzle-piece"></i>{else}<img width="16" height="16" src="../img/admin/tab-plugins.gif" alt=""/>{/if}&nbsp;{l s='Dynamic modules and widgets' mod='pagecache'}</a></li>
      {*ULTIMATE*}
      <li id="litypecache" role="presentation" {if $pctab eq 'typecache'}class="active"{/if}><a href="#tabtypecache" onclick="displayTab('typecache');return true;">{if $avec_bootstrap}<i class="icon-gear"></i>{else}<img width="16" height="16" src="../img/admin/AdminPreferences.gif" alt=""/>{/if}&nbsp;{l s='Caching system' mod='pagecache'}</a></li>
      <li id="lidiagnostic" role="presentation" {if $pctab eq 'diagnostic'}class="active"{/if}><a href="#tabdiagnostic" onclick="displayTab('diagnostic');return true;">{if $avec_bootstrap}<i class="icon-user-md"></i>{else}<img width="16" height="16" src="../img/admin/binoculars.png" alt=""/>{/if}&nbsp;{l s='Diagnostic' mod='pagecache'} ({$diagnostic_count|escape:'html'})</a></li>
      {*ULTIMATE£*}
      {if $advanced_mode}
      <li id="lioptions" role="presentation" {if $pctab eq 'options'}class="active"{/if}><a href="#taboptions" onclick="displayTab('options');return true;">{if $avec_bootstrap}<i class="icon-gear"></i>{else}<img width="16" height="16" src="../img/admin/AdminPreferences.gif" alt=""/>{/if}&nbsp;{l s='Options' mod='pagecache'}</a></li>
      {/if}
      <li id="litimeouts" role="presentation" {if $pctab eq 'timeouts'}class="active"{/if}><a href="#tabtimeouts" onclick="displayTab('timeouts');return true;">{if $avec_bootstrap}<i class="icon-time"></i>{else}<img width="16" height="16" src="../img/admin/time.gif" alt=""/>{/if}&nbsp;{l s='Pages & timeouts' mod='pagecache'}</a></li>
      <li id="listats" role="presentation" {if $pctab eq 'stats'}class="active"{/if}><a href="#tabstats" onclick="displayTab('stats');return true;">{if $avec_bootstrap}<i class="icon-line-chart"></i>{else}<img width="16" height="16" src="../img/admin/AdminStats.gif" alt=""/>{/if}&nbsp;{l s='Statistics' mod='pagecache'}</a></li>
      {*ULTIMATE*}
      <li id="licron" role="presentation" {if $pctab eq 'cron'}class="active"{/if}><a href="#tabcron" onclick="displayTab('cron');return true;">{if $avec_bootstrap}<i class="icon-link"></i>{else}<img width="16" height="16" src="../img/admin/subdomain.gif" alt=""/>{/if}&nbsp;{l s='CRON' mod='pagecache'}</a></li>
      {*ULTIMATE£*}
      {if $advanced_mode}
      <!--li id="licachemanagement" role="presentation" {if $pctab eq 'cachemanagement'}class="active"{/if}><a href="#tabcachemanagement" onclick="displayTab('cachemanagement');return true;">{if $avec_bootstrap}<i class="icon-wrench"></i>{else}<img width="16" height="16" src="../img/admin/AdminTools.gif" alt=""/>{/if}&nbsp;{l s='Cache management' mod='pagecache'}</a></li-->
      {/if}
   </ul>
</div>

<div id="install" class="pctab" {if $pctab neq 'install'}style="display:none"{/if}>
{include file='./get-content-tab-install.tpl'}
</div>
<div id="dynhooks" class="pctab" {if $pctab neq 'dynhooks'}style="display:none"{/if}>
{include file='./get-content-tab-dynhooks.tpl'}
</div>
<div id="timeouts" class="pctab" {if $pctab neq 'timeouts'}style="display:none"{/if}>
{include file='./get-content-tab-timeouts.tpl'}
</div>
<div id="stats" class="pctab" {if $pctab neq 'stats'}style="display:none"{/if}>
{include file='./get-content-tab-stats.tpl'}
</div>
<div id="cron" class="pctab" {if $pctab neq 'cron'}style="display:none"{/if}>
{include file='./get-content-tab-cron.tpl'}
</div>

{if $advanced_mode}
<div id="options" class="pctab" {if $pctab neq 'options'}style="display:none"{/if}>
{include file='./get-content-tab-options.tpl'}
</div>
<div id="cachemanagement" class="pctab" {if $pctab neq 'cachemanagement'}style="display:none"{/if}>
{include file='./get-content-tab-cachemanagement.tpl'}
</div>
{/if}

{*ULTIMATE*}
<div id="typecache" class="pctab" {if $pctab neq 'typecache'}style="display:none"{/if}>
{include file='./get-content-tab-typecache.tpl'}
</div>
<div id="diagnostic" class="pctab" {if $pctab neq 'diagnostic'}style="display:none"{/if}>
{include file='./get-content-tab-diagnostic.tpl'}
</div>
{*ULTIMATE£*}

</div>
v{$module_version|escape:'html'}{if !$advanced_mode} - <a href="{$advanced_mode_url|escape:'html'}">{l s='Advanced mode' mod='pagecache'}</a>{/if}