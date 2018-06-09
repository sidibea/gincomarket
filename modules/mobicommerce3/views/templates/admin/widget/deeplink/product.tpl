{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<div class="entry-edit">
    <div class="entry-edit-head">
		<h4 class="icon-head head-edit-form fieldset-legend">{l s='Product Link'}</h4>
	</div>
	<div class="fieldset ">
		<div class="hor-scroll">
            <div>
                <div class="totalRecords" style="float:left;">
                    <span>Total Products : {$totalRecords}</span>
                </div>
                <div class="searchBox" style="float:right;">
                    Search:
                    <input name="q" id="q" value="{$q}" />
                    <button onclick="pn=1;getProductList();return false;" >Search</button>
                </div>
            </div>
            <div style="clear:both">
                <input id="linktype" type="hidden" name="type" value="product">
                <table class="form-list" cellspacing="0" style="width: 100%">
                    <tbody>
				        <tr>
				            <td colspan="2">
                                <div class="product-grid">
                                    {if isset($products)}
                                        <table class="table product">
                                            <colgroup>
                                                <col width="10%" />
                                                <col width="10%" />
                                                <col width="10%" />
                                                <col width="70%" />
                                            </colgroup>
                                            <tr>
                                                <th align="center">{l s=''}</th>
                                                <th style="text-align:center;">{l s='Id'}</th>
                                                <th>{l s='Image'}</th>
                                                <th>{l s='Name'}</th>
                                        	</tr>
                                            {foreach from=$products item=product name=products}
                                                <tr>
                                                    <td align="center"><input type="radio" name="radiochecked" value="{$product.id_product}" /></td>
                                                    <td align="center">{$product.id_product}</td>
                                                    <td>
                                                        <img src="../img/tmp/product_mini_{$product.id_product}_1.jpg" alt="{$product.legend|escape:'htmlall':'UTF-8'}" width="35" height="35" />
                                                    </td>
                                                    <td>{$product.name|strip_tags:'UTF-8'|truncate:100:'...'}</td>
                                                </tr>
                                            {/foreach}
                                        </table>
                                    {/if}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
		</div>
        <ul class="pagination">
            {for $i=1 to $totalPages}
                <li>
                    <a href="#" onclick="pn={$i};getProductList();return false;">{$i}</a>
                </li>
            {/for}
        </ul>
	</div>		
</div>
<script language="javascript" data-cfasync="false">
    var pn = {$currentPage};
    var ps = {$pageSize};
    var q = "";

    function getProductList()
    {
        var selectedlinktype = jQuery( "#popuplinktype option:selected" ).val();
        var selectedlinktypevalue = "";
        lang_id = $('#languageSelected').val();
        q = $('#q').val();       
        if(selectedlinktype != 0)
        {
            jQuery('#mobi_loading_mask',parent.document).show();
    	   
            $.ajax({
                type: 'POST',
                async: true,
                cache: false,
                data : {
                    'ajax' : "1",
                    'action' : 'getlinkData',
                    'lang_id' : lang_id,
                    'link_type':selectedlinktype,
                    'link_type_value':selectedlinktypevalue,
                    'cat':cat,
                    'pn':pn,
                    'ps':ps,
                    'q':q,
                },
                "url": urlFordellpLinkData,
                
                success: function(response)
                {
                    jQuery('#mobi_loading_mask',parent.document).hide();
    				jQuery('.link-response-content').html(response);
                    jQuery("#deeplinkForm").show();
                },
                error: function(response, textStatus, errorThrown)
                {
                    var json = response.responseText.evalJSON(true);
    		        alert(json.error);
                }
            });
        }
        else
        {
    	   jQuery('.link-response-content').html('');
        }
    }
</script>