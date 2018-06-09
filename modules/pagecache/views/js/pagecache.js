/*
* Page Cache powered by Jpresta (jpresta . com)
* 
*    @author    Jpresta
*    @copyright Jpresta
*    @license   You are just allowed to modify this copy for your own use. You must not redistribute it. License
*               is permitted for one Prestashop instance only but you can install it on your test instances.
*/

function pcGetParameterValue(e) {
    var t = "[\\?&]" + e + "=([^&#]*)";
    var n = new RegExp(t);
    var r = n.exec(window.location.href);
    if (r == null) return "";
    else return r[1]
}

function pcSplitUri(uri) {
    var splitRegExp = new RegExp('^' + '(?:' + '([^:/?#.]+)' + ':)?' + '(?://' + '(?:([^/?#]*)@)?' + '([\\w\\d\\-\\u0100-\\uffff.%]*)' + '(?:(:[0-9]+))?' + ')?' + '([^?#]+)?' + '(?:(\\?[^#]*))?' + '(?:(#.*))?' + '$');
    var split = uri.match(splitRegExp);
    for (var i = 1; i < 8; i++) {
        if (typeof split[i] == 'undefined') {
            split[i] = '';
        }
    }
    return {
        'scheme': split[1],
        'user_info': split[2],
        'domain': split[3],
        'port': split[4],
        'path': split[5],
        'query_data': split[6],
        'fragment': split[7]
    }
}

$(document).ready(function () {
    /* Refresh dynamic modules */
    try {
    	if (typeof processDynamicModules == 'function') {
			var hooks = '';
			$('.dynhook').each(function(index, domhook){
				hooks = hooks + '&hook_' + index + '=' + $(this).data('hook') + '%7C' + $(this).data('module');
			});
			if (hooks.length > 0) {
				var urlparts = pcSplitUri(document.URL);
				var url = urlparts['scheme'] + '://' + urlparts['domain'] + urlparts['port'] + urlparts['path'] + urlparts['query_data'];
				var indexEnd = url.indexOf('?');
				if (indexEnd >= 0 && indexEnd < url.length) { url += '&ajax=true';}
				else { url += '?ajax=true';}
				url += hooks;
				url += urlparts['fragment'];
				url += '&nocache=' + new Date().getTime();
				$.getJSON(url, processDynamicModules).fail(function(jqXHR, textStatus, errorThrown) {
					try {
						var indexStart = jqXHR.responseText.indexOf('{');
						var responseFixed = jqXHR.responseText.substring(indexStart, jqXHR.responseText.length);
						dyndatas = $.parseJSON(responseFixed);
						if (dyndatas != null) {
							processDynamicModules(dyndatas);
							return;
						}
					}
					catch(err) {
						console.error("PageCache cannot parse data of error=" + err, err);
					}
					console.error("PageCache cannot display dynamic modules: error=" + textStatus + " exception=" + errorThrown);
					console.log("PageCache dynamic module URL: " + url);
				});
			}
			else {
				processDynamicModules(new Array());
			}
    	}
    } catch (e) {
        console.error("PageCache cannot display dynamic modules: " + e.message, e);
    }
    
	/* Forward dbgpagecache parameter */
    try {
    	if (typeof baseDir == 'undefined') {
    		baseDir = prestashop.urls.base_url;
    	}
        if (window.location.href.indexOf("dbgpagecache=") > 0) {
            $("a:not(.pagecache)").each(function () {
                var e = $(this).attr("href");
                var t = this.search;
                var n = "dbgpagecache=" + pcGetParameterValue("dbgpagecache");
                var r = baseDir.replace("https", "http");
                if (typeof e != "undefined" && e.substr(0, 1) != "#" && (e.replace("https", "http").substr(0, r.length) == r || e.indexOf('://') == -1)) {
                    if (t.length == 0) this.search = n;
                    else this.search += "&" + n
                }
            })
        }
    } catch (e) {
        console.warn("Cannot forward dbgpagecache parameter on all links: " + e.message, e)
    }

});
