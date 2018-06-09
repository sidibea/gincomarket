<?php /* Smarty version Smarty-3.1.19, created on 2018-06-04 05:42:56
         compiled from "/home/abdouhanne/www/pr/modules/categorysearch/categorysearch-instantsearch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5451716605b14d160f203d7-03723640%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea9a3b6ac90d7f9d1013ea2f8250aa29551eee9a' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/categorysearch/categorysearch-instantsearch.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5451716605b14d160f203d7-03723640',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'instantsearch' => 0,
    'categorysearch_type' => 0,
    'search_ssl' => 0,
    'link' => 0,
    'cookie' => 0,
    'ajaxsearch' => 0,
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5b14d16109b410_52625657',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b14d16109b410_52625657')) {function content_5b14d16109b410_52625657($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['instantsearch']->value) {?>
	<script type="text/javascript">
	// <![CDATA[
		function tryToCloseInstantSearch() {
			if ($('#old_center_column').length > 0)
			{
				$('#center_column').remove();
				$('#old_center_column').attr('id', 'center_column');
				$('#center_column').show();
				return false;
			}
		}
		
		instantSearchQueries = new Array();
		function stopInstantSearchQueries(){
			for(i=0;i<instantSearchQueries.length;i++) {
				instantSearchQueries[i].abort();
			}
			instantSearchQueries = new Array();
		}
		
		$("#search_query_<?php echo $_smarty_tpl->tpl_vars['categorysearch_type']->value;?>
").keyup(function(){
			if($(this).val().length > 0){
				stopInstantSearchQueries();
				instantSearchQuery = $.ajax({
					url: '<?php if ($_smarty_tpl->tpl_vars['search_ssl']->value==1) {?><?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getModuleLink('categorysearch','catesearch',array(),true));?>
<?php } else { ?><?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getModuleLink('categorysearch','catesearch'));?>
<?php }?>',
					data: {
						instantSearch: 1,
						id_lang: <?php echo $_smarty_tpl->tpl_vars['cookie']->value->id_lang;?>
,
						q: $(this).val()
					},
					dataType: 'html',
					type: 'POST',
					success: function(data){
						if($("#search_query_<?php echo $_smarty_tpl->tpl_vars['categorysearch_type']->value;?>
").val().length > 0)
						{
							tryToCloseInstantSearch();
							$('#center_column').attr('id', 'old_center_column');
							$('#old_center_column').after('<div id="center_column" class="' + $('#old_center_column').attr('class') + '">'+data+'</div>');
							$('#old_center_column').hide();
							// Button override
							ajaxCart.overrideButtonsInThePage();
							$("#instant_search_results a.close").click(function() {
								$("#search_query_<?php echo $_smarty_tpl->tpl_vars['categorysearch_type']->value;?>
").val('');
								return tryToCloseInstantSearch();
							});
							return false;
						}
						else
							tryToCloseInstantSearch();
					}
				});
				instantSearchQueries.push(instantSearchQuery);
			}
			else
				tryToCloseInstantSearch();
		});
	// ]]>
	</script>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['ajaxsearch']->value) {?>
	<script type="text/javascript">
    var moduleDir = "<?php echo $_smarty_tpl->tpl_vars['module_dir']->value;?>
";
	var searchUrl = baseDir + 'modules/categorysearch/finds.php?rand=' + new Date().getTime();
    var maxResults = 15;
    //var search_category = $('#search_category option:selected').val()
	// <![CDATA[
		$('document').ready( function() {
            var select = $( "#search_category" ),
            options = select.find( "option" ),
            selectType = options.filter( ":selected" ).attr( "value" );
            
            $("#search_query_<?php echo $_smarty_tpl->tpl_vars['categorysearch_type']->value;?>
").autocomplete(
                searchUrl, {
        			minChars: 3,
        			max: maxResults,
        			width: 500,
        			selectFirst: false,
        			scroll: false,
                    cacheLength: 0,
        			dataType: "json",
        			formatItem: function(data, i, max, value, term) {
        				return value;
        			},
        			parse: function(data) {
							var mytab = new Array();
							for (var i = 0; i < data.length; i++)
								mytab[mytab.length] = { data: data[i], value: '<img src="' + data[i].product_image + '" alt="' + data[i].pname + '" height="30" /> &nbsp;&nbsp;' + data[i].cname + ' > ' + data[i].pname, icon: data[i].product_image};
							return mytab;
						},
        			extraParams: {
        				ajax_Search: 1,
        				id_lang: <?php echo $_smarty_tpl->tpl_vars['cookie']->value->id_lang;?>
,
                        id_category: selectType
        			}
                }
            )
            .result(function(event, data, formatted) {
				$('#search_query_<?php echo $_smarty_tpl->tpl_vars['categorysearch_type']->value;?>
').val(data.pname);
				document.location.href = data.product_link;
			});
        
            select.change(function () {
                selectType = options.filter( ":selected" ).attr( "value" );
                $( ".ac_results" ).remove();
                $("#search_query_<?php echo $_smarty_tpl->tpl_vars['categorysearch_type']->value;?>
").autocomplete(
                    searchUrl, {						
            			minChars: 3,
            			max: maxResults,
            			width: 500,
            			selectFirst: false,
            			scroll: false,
                        cacheLength: 0,
            			dataType: "json",
            			formatItem: function(data, i, max, value, term) {
            				return value;
            			},
            			parse: function(data) {
            			     
							var mytab = new Array();
							for (var i = 0; i < data.length; i++)
								mytab[mytab.length] = { data: data[i], value: data[i].cname + ' > ' + data[i].pname };
                                mytab[mytab.length] = { data: data[i], value: '<img src="' + data[i].product_image + '" alt="' + data[i].pname + '" height="30" />' + '<span class="ac_product_name">' + pname + '</span>' };
							return mytab;
						},
            			extraParams: {
            				ajax_Search: 1,
            				id_lang: <?php echo $_smarty_tpl->tpl_vars['cookie']->value->id_lang;?>
,
                            id_category: selectType
            			}
                    }
                );
            });
		});
	// ]]>
	</script>
<?php }?>

<?php }} ?>
