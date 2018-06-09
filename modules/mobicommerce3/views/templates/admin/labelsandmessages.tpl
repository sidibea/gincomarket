{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<div class="panel">        
    <div id="widgetLang" class="panel">
        <form novalidate="" enctype="multipart/form-data" method="post" action="{$tab['href']}" class="defaultForm form-horizontal MCManageApp" id="labelsForm">
		    <input type="hidden" value="Labels" name="process_action" />
            <input type="hidden" value="1" id="labels" name="labels">
            <input type="hidden" value="{$sel_tab}" id="sel_tab" name="sel_tab">
            
            {if (count($languages)>=1)}
				<div class="panel-heading">
				    {l s='Select Language [Store View]'}
				</div>
				<div class="form-wrapper">
		            <div class="form-group">
					    <label class="control-label col-lg-3">
					      	{l s='Store Languages  :'}
						</label>
						<div class="col-lg-9 ">
							<select id="languageSelected" name="languageSelected">
                                {foreach $languages key=langIndex item=language}
                                    <option {if isset($language['id_lang']) && $language['id_lang'] == $lang}selected="selected"{/if}  value="{$language.id_lang}">{$language.name}</option>
                                {/foreach}
                            </select>
						</div>
					</div>
		      	</div>
	        {/if} 
        </form>
    </div>
    
    <div class="productTabs">
		<ul class="tab nav nav-tabs">
		  	{foreach $product_tabs key=numStep item=tab}
				<li class="tab-row">
					<a class="tab-page {if $sel_tab == $tab.name}active{/if}" id="cart_{$numStep}" data-item='{$numStep|strtolower}' href="javascript:displayCartRuleTab('{$numStep|strtolower}');" onclick="$('#sel_tab').val('{$tab.name|strtolower}')"><i class="icon-wrench"></i> {$tab.name}</a>
				</li>
  	        {/foreach}
		</ul>
	</div>
	<form novalidate="" enctype="multipart/form-data" method="post" class="defaultForm form-horizontal MCLabels" id="mobicommerce_applications_labels_form" onsubmit="$('#mobicommerce_applications_labels_form').validate();">
		{foreach $product_tabs key=numStep item=tab}
			<div id="cart_rule_{$numStep|strtolower}" class="panel cart_rule_tab clearfix">   
				<div id="fieldset_0">
					{include file="$modulepath/views/templates/admin/labelsandmessages/{$numStep|strtolower}.tpl"}
					<div class="panel-footer">
						<button class="btn btn-default pull-right" name="updateLabels" value="1" type="submit" onclick="$('#sel_lab_tab').val('labels');">
							<i class="process-icon-save"></i>    {l s='Save'}   
						</button>
						<a onclick="window.history.back();" class="btn btn-default" href="index.php?controller=MCLabels&amp;token=8c2ddd9a14c2f34253a3908894842c65">
						   <i class="process-icon-cancel"></i> {l s='Cancel'}
						</a>
					</div>
				</div>
			</div>
		{/foreach}
	</form>
</div>


<script type="text/javascript">
    $(document).ready(function() {
    	jQuery('#languageSelected').change(function(){   
    	    fetchLabels();
    	});
    });
    
    function fetchLabels()
    {
        lang_id = $('#languageSelected').val();
        sel_tab = $('#sel_tab').val();
        window.location.href = "{$link->getAdminLink('MCLabels')|addslashes}&lang="+lang_id+"&sel_tab="+sel_tab;
    }
    
    var currentFormtab = $('.tab li a').data('item');
	$('.cart_rule_tab').hide();
	$('.tab-row.active').removeClass('active');
	$('#cart_rule_'+ currentFormtab).show();
	$('#cart_rule_link_' + currentFormtab).parent().addClass('active');
	function displayCartRuleTab(tab)
	{
		$('.cart_rule_tab').hide();
		$('.tab-row .tab-page.active').removeClass('active');
		$('#cart_rule_' + tab).show();
		$('#cart_rule_link_' + tab).parent().addClass('active');
		$('.tab-page[data-item="'+tab+'"]').addClass('active');
		$('#currentFormTab').val(tab);
	}

    displayCartRuleTab('{$sel_tab|strtolower}');
</script>