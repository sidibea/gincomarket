{*
* Page Cache powered by Jpresta (jpresta . com)
*
*    @author    Jpresta
*    @copyright Jpresta
*    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
*               is permitted for one Prestashop instance only but you can install it on your test instances.
*}
<script type="text/javascript">
function pcDisplayError(status, error, msg) {
    $('#pcanalysisError div').html("{l s='An error occured' mod='pagecache'}: <!--" + status + ' - ' + error + '--><br/>' + msg + "<br/>{l s='If you have SSL, please browse your back office with HTTPS.' mod='pagecache'}<br/><br/>{l s='Anyway, don\'t worry, it does not break the cache feature.' mod='pagecache'}");
    $('#pcanalysisError').show();
}
function pcRunAnalysis() {
    {if $avec_bootstrap}
        var loading = '<span class="icon-refresh icon-spin icon-fw"></span>';
	{else}
	    var loading = '<img width="16" height="16" src="../img/admin/ajax-loader.gif" alt="">';
	{/if}
    $('#pcanalysis').show();
    $('#pcanalysisExplain').show();
    $('#pcRunAnalysisBtn').hide();
    $('#pchomenocache').html(loading);
    $.ajax({ url: '{$url_home_ctrl|escape:'javascript':'UTF-8'}', cache: true}).success(function() {
        var startTime = new Date().getTime();
        $.ajax({ url: '{$url_home_nocache_ctrl|escape:'javascript':'UTF-8'}', cache: true}).success(function() {
            var pchomenocacheTime = new Date().getTime() - startTime;
            $('#pchomenocache').html(pchomenocacheTime + 'ms');
            $('#pchomewithcache').html(loading);
            startTime = new Date().getTime();
            $.ajax({ url: '{$url_home_ctrl|escape:'javascript':'UTF-8'}', cache: true}).success(function() {
                var pchomewithcacheTime = new Date().getTime() - startTime;
                $('#pchomewithcache').html(pchomewithcacheTime + 'ms');
                var percent = parseFloat((pchomenocacheTime - pchomewithcacheTime) * 100 / pchomenocacheTime);
                var numAnim1 = new CountUp('pchomepercent', 0, percent.toFixed(2), 2, 2);
                numAnim1.start();
                if (percent > 0) {
                    $('#pchomepercent').parent().addClass('success');
                }
                {if isset($url_product)}
                    $('#pcproductnocache').html(loading);
                    $.ajax({ url: '{$url_product_ctrl|escape:'javascript':'UTF-8'}', cache: true}).success(function() {
                        var startTime = new Date().getTime();
                        $.ajax({ url: '{$url_product_nocache_ctrl|escape:'javascript':'UTF-8'}', cache: true}).success(function() {
                            var pcproductnocacheTime = new Date().getTime() - startTime;
                            $('#pcproductnocache').html(pcproductnocacheTime + 'ms');
                            $('#pcproductwithcache').html(loading);
                            startTime = new Date().getTime();
                            $.ajax({ url: '{$url_product_ctrl|escape:'javascript':'UTF-8'}', cache: true}).success(function() {
                                var pcproductwithcacheTime = new Date().getTime() - startTime;
                                $('#pcproductwithcache').html(pcproductwithcacheTime + 'ms');
                                var percent = parseFloat((pcproductnocacheTime - pcproductwithcacheTime) * 100 / pcproductnocacheTime);
                                var numAnim2 = new CountUp('pcproductpercent', 0, percent.toFixed(2), 2, 2);
                                numAnim2.start();
                                if (percent > 0) {
                                    $('#pcproductpercent').parent().addClass('success');
                                }
                                {if isset($url_category)}
                                    $('#pccategorynocache').html(loading);
                                    $.ajax({ url: '{$url_category_ctrl|escape:'javascript':'UTF-8'}', cache: true}).success(function() {
                                        var startTime = new Date().getTime();
                                        $.ajax({ url: '{$url_category_nocache_ctrl|escape:'javascript':'UTF-8'}', cache: true}).success(function() {
                                            var pccategorynocacheTime = new Date().getTime() - startTime;
                                            $('#pccategorynocache').html(pccategorynocacheTime + 'ms');
                                            $('#pccategorywithcache').html(loading);
                                            startTime = new Date().getTime();
                                            $.ajax({ url: '{$url_category_ctrl|escape:'javascript':'UTF-8'}', cache: true}).success(function() {
                                                var pccategorywithcacheTime = new Date().getTime() - startTime;
                                                $('#pccategorywithcache').html(pccategorywithcacheTime + 'ms');
                                                var percent = parseFloat((pccategorynocacheTime - pccategorywithcacheTime) * 100 / pccategorynocacheTime);
                                                var numAnim3 = new CountUp('pccategorypercent', 0, percent.toFixed(2), 2, 2);
                                                numAnim3.start();
                                                if (percent > 0) {
                                                    $('#pccategorypercent').parent().addClass('success');
                                                }
                                            }).error(function(result, status, error) { $('#pccategorywithcache').html('!'); pcDisplayError(status, error, result.responseText)});
                                        }).error(function(result, status, error) { $('#pccategorynocache').html('!'); pcDisplayError(status, error, result.responseText)});
                                    }).error(function(result, status, error) { $('#pccategorynocache').html('!'); pcDisplayError(status, error, result.responseText)});
                                {/if}
                            }).error(function(result, status, error) { $('#pcproductwithcache').html('!'); pcDisplayError(status, error, result.responseText)});
                        }).error(function(result, status, error) { $('#pcproductnocache').html('!'); pcDisplayError(status, error, result.responseText)});
                    }).error(function(result, status, error) { $('#pcproductnocache').html('!'); pcDisplayError(status, error, result.responseText)});
                {/if}
            }).error(function(result, status, error) { $('#pchomewithcache').html('!'); pcDisplayError(status, error, result.responseText)});
        }).error(function(result, status, error) { $('#pchomenocache').html('!'); pcDisplayError(status, error, result.responseText)});
    }).error(function(result, status, error) { $('#pchomenocache').html('!'); pcDisplayError(status, error, result.responseText)});
}
</script>
<div class="bootstrap">
<h3>{l s='PageCache performance analysis' mod='pagecache'}</h3>
{if $avec_bootstrap}
    <a href="#" id="pcRunAnalysisBtn" class="btn btn-default" onclick="pcRunAnalysis();return false;"><span style="color: green" class="icon-user-md"></span>&nbsp;{l s='Run analysis' mod='pagecache'}</a>
{else}
    <button id="pcRunAnalysisBtn" onclick="pcRunAnalysis();return false;"><span style="color: green" class="icon-user-md"></span>&nbsp;{l s='Run analysis' mod='pagecache'}</button>
{/if}

{if $avec_bootstrap}
    <div id="pcanalysisExplain" class="bootstrap" style="display:none"><div class="alert alert-info" style="display: block;">
    <strong>{l s='Good to know' mod='pagecache'}</strong> {l s='Tools like PageSpeed give you a score that indicates how far is your website from the best optimisation practices. The score is not relative to the real speed, it\'s relative on how your theme is built. PageCache reduces the time to first byte (TTFB), that means the time spent to generate the very first request.' mod='pagecache'}
    </div></div>
{else}
    <div id="pcanalysisExplain" class="hint clear" style="display: none;"><div>
    <strong>{l s='Good to know' mod='pagecache'}</strong> {l s='Tools like PageSpeed give you a score that indicates how far is your website from the best optimisation practices. The score is not relative to the real speed, it\'s relative on how your theme is built. PageCache reduces the time to first byte (TTFB), that means the time spent to generate the very first request.' mod='pagecache'}
    </div></div>
{/if}


{if $avec_bootstrap}
    <div id="pcanalysisError" class="bootstrap" style="display:none"><div class="alert alert-danger" style="display: block;"></div></div>
{else}
    <div id="pcanalysisError" class="error clear" style="display: none;"><div></div></div>
{/if}

<table id="pcanalysis" style="display: none; width:initial" class="table table-bordered table-striped">
<colgroup>
    <col style="width:150px">
    <col style="width:150px">
    <col style="width:150px">
    <col style="width:70px">
</colgroup>
<thead>
    <tr><th>{l s='Tested page' mod='pagecache'}</th><th style="text-align:center">{l s='TTFB Without cache' mod='pagecache'}</th><th style="text-align:center">{l s='TTFB With PageCache' mod='pagecache'}</th><th style="text-align:center">{l s='%' mod='pagecache'}</th></tr>
</thead>
<tbody>
<tr>
<td><a href="{$url_home_nocache|escape:'javascript':'UTF-8'}" target="_blank">{l s='The home page' mod='pagecache'}</a></td><td id="pchomenocache" style="text-align:center"></td><td id="pchomewithcache" style="text-align:center"></td><td style="text-align:center; font-weight:bold"><span id="pchomepercent">-</span>&nbsp;%</td>
</tr>
{if isset($url_product)}
<tr>
<td><a href="{$url_product_nocache|escape:'javascript':'UTF-8'}" target="_blank">{l s='A product page' mod='pagecache'}</a></td><td id="pcproductnocache" style="text-align:center"></td><td id="pcproductwithcache" style="text-align:center"></td><td style="text-align:center; font-weight:bold"><span id="pcproductpercent">-</span>&nbsp;%</td>
</tr>
    {if isset($url_category)}
    <tr>
    <td><a href="{$url_category_nocache|escape:'javascript':'UTF-8'}" target="_blank">{l s='A category page' mod='pagecache'}</a></td><td id="pccategorynocache" style="text-align:center"></td><td id="pccategorywithcache" style="text-align:center"></td><td style="text-align:center; font-weight:bold"><span id="pccategorypercent">-</span>&nbsp;%</td>
    </tr>
    {/if}
{/if}
</tbody>
</table>
</div>