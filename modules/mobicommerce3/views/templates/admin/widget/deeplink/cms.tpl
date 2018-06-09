{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

{$lang = 1}
{$parrent = 1}
<div class="entry-edit">
    <div class="entry-edit-head">
		<h4 class="icon-head head-edit-form fieldset-legend">{l s='Cms Link'}</h4>
	</div>
	<div class="fieldset ">
		<div class="hor-scroll">
			<table class="form-list" cellspacing="0" style="width: 100%">
			    <tbody>
					<input id="linktype" type="hidden" name="type" value="cms">
					<tr>
						<td colspan="2">
							<div class="product-grid">
								<table class="table product">
									<colgroup>
                                        <col width="10%" />
                                        <col width="10%" />
                                        <col width="70%" />
                                    </colgroup>
                                    <tr>
                                        <th align="center">{l s=''}</th>
                                        <th style="text-align:center;">{l s='Id'}</th>
                                        <th>{l s='Name'}</th>
                                	</tr>
			                        {foreach from=CMS::getCMSPages($lang,$parrent,true) item=cmspages}
			                        	<tr>
			                        		<td align="center">
			                        			<input type="radio" value="{$cmspages.id_cms}" name="radiochecked" />
			                        		</td>
			                        		<td align="center">{$cmspages.id_cms}</td>
			                        		<td>
					                            <a href="{$link->getCMSLink($cmspages.id_cms, $cmspages.link_rewrite)|escape:'htmlall':'UTF-8'}" target="_blank">{$cmspages.meta_title|escape:'htmlall':'UTF-8'}</a>
					                    	</td>
				                    	</tr>
			                        {/foreach}
		                    	</table>
                        	</div>
                        </td>
					</tr>
			    </tbody>
			</table>
		</div>
	</div>		
</div>