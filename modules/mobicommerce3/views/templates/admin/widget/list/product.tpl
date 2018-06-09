{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<div>&nbsp;</div>
<div class="entry-edit">
	<div class="panel">
    	<h4 class="panel-heading">{l s='Product Link'}</h4>
        <div class="fieldset ">
    		<div class="hor-scroll">
                <div>
                    <div class="totalRecords" style="float:left;"><span>Total Products : {$totalRecords}</span></div>
                    <div class="searchBox" style="float:right;">
                        Search:<input name="q" id="q" value="{$q}"/>
                        <button onclick="pn=1;getProductList();return false;" >Search</button>
                    </div>
                </div>
                <div style="clear:both">
                    <table class="form-list" cellspacing="0" style="width:100%">
        			    <tbody>
        					<input id="linktype" type="hidden" name="type" value="product">
        					<tr>
            					<td colspan="2">
                                    <div class="product-grid">
                                        {if isset($products)}
                                            <table class="table product">
                                            	<colgroup>
                                                    <col width="10%">
                                                    <col width="10%">
                                                    <col width="10%">
                                                    <col width="60%">
                                                    <col width="10%">
                                                </colgroup>
                                            	<tr>
                                                	<th>{l s=''}</th>
                                                    <th>{l s='Id'}</th>
                                                    <th>{l s='Image'}</th>
                                                    <th>{l s='Name'}</th>
                                                    <th>{l s='Position'}</th>
                                        		</tr>
                                                {foreach from=$products item=product name=products}
                                                    <tr>
                                                    	<td align="center"><input type="checkbox" onchange="saveProduct('{$product.id_product}')" data-href="{$product.id_product}" name="products[{$product.id_product}]" {if ($product.id_product|array_key_exists:$selectedProductArr)}checked="checked"{/if}/></td>
                                                        <td>{$product.id_product}</td>
                                                        <td>
                                                            <img src="../img/tmp/product_mini_{$product.id_product}_1.jpg" alt="{$product.legend|escape:'htmlall':'UTF-8'}" width="35" height="35" />
                                                        </td>
                                                        <td>{$product.name|strip_tags:'UTF-8'|truncate:100:'...'}</td>
                                                        <td><input type="text" onchange="saveProduct('{$product.id_product}')" name="prod_position[{$product.id_product}]" value="{$selectedProductArr[$product.id_product]}"></td>
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
</div>
<script type="text/javascript" data-cfasync="false">
    var pn = {$currentPage};
    var ps = {$pageSize};
    var q = "";

    function getProductList(e)
    {
        var widget_id_value = jQuery( "#widget_id" ).val();
        var selectedwidget = jQuery( "#productslider_type" ).val();
        var checked_productsjson = jQuery('.selectedproducts').val();
        lang_id = $('#languageSelected').val();
        q = $('#q').val();     
        if(selectedwidget == 'selected'){
            $.ajax({
                type: 'POST',
                async: true,
                cache: false,
                data : {
                    'ajax' : "1",
                    'action' : 'productgrid',
                    'lang_id' : lang_id,
                    'cat' : cat,
                    'widget_id':widget_id_value,
                    'pn':pn,
                    'ps':ps,
                    'q':q,
                    'checked_products':checked_productsjson,
                },
                "url": urlProductListData,
                success: function(response)
                {
                    jQuery('.product-grid').html(response);
                },
                error: function(msg, textStatus, errorThrown)
                {
                    alert(json.error);
                }
            });
        }
        else
        {
        	jQuery('.product-grid').html('');
        }
    }
</script>