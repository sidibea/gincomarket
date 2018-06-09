{capture name=path}<a href="{$link->getPageLink('my-account', true)}">{l s='My Account' mod='agilesellershipping'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='My Seller Account'  mod='agilesellershipping'}{/capture}

<h1>{l s='My Seller Account' mod='agilesellershipping'}</h1>
{include file="$agilemultipleseller_views./templates/front/seller_tabs.tpl"}
{include file="$tpl_dir./errors.tpl"}
<script type="text/javascript">
	var id_carrier = {$id_carrier};
	
	$('document').ready(function() {
		$('a.range_fancybox').fancybox({
			modal: true,
			width: 450,
		    autoDimensions: false
		});
	});

	function addRangeToTable(from, to, range_id)
	{
		var header_html = "";
		header_html +="<a href=\"#rangeedit\" class=\"agile-btn agile-btn-default range_fancybox\" onclick=\"preEditRange("+range_id +"," + parseFloat(from).toFixed(2) + "," + parseFloat(to).toFixed(2) +");\">\n";
		header_html +="<i class=\"icon-pencil\"></i></a>\n";
		header_html +="<a href=\"javascript:deleteRange(" + range_id + ");\" class=\"agile-btn agile-btn-default\" onclick=\"return confirm('{l s='Are you sure to delete the range?' mod='agilesellershipping'}');\">\n";
		header_html +="<i class=\"icon-trash\"></i></a>\n";
		header_html +="<br><label id=\"l_range_" + range_id +"\">" + parseFloat(from).toFixed(2) + "{l s=' to ' mod='agilesellershipping'}";
		header_html += "<br>" + parseFloat(to).toFixed(2) + "</lable>\n";

		/* for existing range, only replace header */
		var editing_range_id = parseInt( $('#edit_range_id').val());
		if(editing_range_id > 0){
			$("td[id=range_col_" + range_id + "_header]").html(header_html);
			return;
		}

		$("tr[id^=zone_]").each(function(){
			var lasttd = $(this).find("td").last();
			var id_zone = $(this).attr("id").replace("zone_","");
		    var newcell = "";
			if(id_zone == "header"){
				newcell = "<td id=\"range_col_" + range_id + "_header\">" + header_html + "</td>";
			}
			else if(id_zone == "all"){
				newcell = "<td id=\"range_col_" + range_id + "_all\"><input size=\"10\" type=\"text\" name=\"fees_" + id_zone + "_" + range_id +"\" id=\"fees_" + id_zone + "_" + range_id +"\" value=\"\"  onkeyup=\"if ((event.keyCode||event.which) != 9){ spreadZoneFees(" + range_id + ")}\" /></td>";
			}
			else {
				newcell = "<td id=\"range_col_" + range_id + "_" + id_zone + "\"><input size=\"10\" type=\"text\" name=\"fees_" + id_zone + "_" + range_id +"\" id=\"fees_" + id_zone + "_" + range_id +"\" value=\"\" /></td>";
			}

			$(newcell).insertAfter(lasttd);
		});
	}

	function spreadZoneFees(id_range)
	{
		newVal = $('#fees_all_'+id_range).val().replace(/,/g, '.');
		$("[id ^=fees_][id $=_" + id_range + "]").val(newVal);
	}
	function deleteRangeFromTable(range_id)
	{
		 $("td[id^=range_col_" + range_id + "]").remove();
	}
	
	function preEditRange(range_id, from, to)
	{
		$("#tblRangeInput").show();
		$('#edit_range_id').val(range_id);
		$('#range_from').val(from);
		$('#range_to').val(to);
	}

	function editRange() {
		$("#spanProcessing").show();
		$("#tblRangeInput").hide();
		var from = $('#range_from').val();
		var to = $('#range_to').val();
		var range_id = $('#edit_range_id').val();

		$.ajax({
			type:'POST',
			url: baseDir  + 'index.php?process=shipping&fc=module&module=agilesellershipping&controller=sellercarrierranges&id_carrier=' + {$id_carrier},
			data: {
				ajax: true,
				from: from,
				to: to,
				action: 'edit',
				range_id: range_id
			},
			success: function(data) 
			{
				var obj = JSON && JSON.parse(data) || $.parseJSON(data);
				if(obj["success"] == 1)
				{
					addRangeToTable(obj["from"],obj["to"],obj["range_id"]);
				}else
				{
					alert(obj["errors"]);
				}
				$("#spanProcessing").hide();
				$.fancybox.close();
			}
		});
	}

	function deleteRange(range_id) {
		$.ajax({
			type:'POST',
			url: baseDir  + 'index.php?process=shipping&fc=module&module=agilesellershipping&controller=sellercarrierranges&id_carrier=' + {$id_carrier},
			data: {
				ajax: true,
				action: 'delete',
				range_id : range_id
			},
			success: function(data) 
			{
				var obj = JSON && JSON.parse(data) || $.parseJSON(data);
				if(obj["success"] == 1)
				{
					deleteRangeFromTable(obj["range_id"]);
				}else
				{
					alert(obj["errors"]);
				}
			}
		});
	}
</script>
{if isset($isSeller) AND $isSeller AND ($hasOwnerShip OR $isSharedCarrier)}
	<div id="agile">
    <form action="{$link->getModuleLink('agilesellershipping', 'sellercarrierranges', ['process' =>'carrierdetail','id_carrier'=>$id_carrier], true)}" enctype="multipart/form-data" method="post" class="std">
	<div id="fieldset_range" class="panel box">
 		<div class="row">
			<h3>
			<span class="agile-pull-right">
				<a  class="agile-btn agile-btn-default" href="{$link->getModuleLink('agilesellershipping', 'sellercarriers', ['process' =>'carriers'], true)}">
				<i class="icon-th-list"></i>{l s=' Back to list ' mod='agilesellershipping'}
				</a>
			</span>
			<span class="agile-pull-left">
				{if $hasOwnerShip}
					<a href="#rangeedit" class="agile-btn agile-btn-default range_fancybox" onclick="preEditRange(-1,'','');">
					<i class="icon-plus-sign"></i>{l s=' Add Range' mod='agilesellershipping'}</a>
				{/if}
			</span></h3>
		</div>

		<div class="panel-heading">
			{if $range_type == "Weight Ranges"}
				<label><b>{l s='Fees by geographical zone, and weight ranges' mod='agilesellershipping'}</b></label>({l s='Unit:' mod='agilesellershipping'}{$range_suffix})&nbsp;&nbsp;&nbsp;&nbsp;({l s='Fee Currency:' mod='agilesellershipping'}{$currency->getSign('left')}&nbsp;{$currency->getSign('right')}&nbsp;{l s='tax excl.'})
			{else}
				<label><b>{l s='Fees by geographical zone, and price ranges' mod='agilesellershipping'}</b></label>({l s='Currency:' mod='agilesellershipping'}{$range_suffix})&nbsp;&nbsp;&nbsp;&nbsp;({l s='Fee Currency:' mod='agilesellershipping'}{$currency->getSign('left')}&nbsp;{$currency->getSign('right')}&nbsp;{l s='tax excl.'})
			{/if}
		</div>
		<div class="table-responsive clearfix">
			<div>
				<table id="zone" class="table table-bordered table-condensed">
					<tr id="zone_header" class="info">
						<td align="center">
						<label>{l s='Carrier Zone' mod='agilesellershipping'}</label>
						</td>
						{foreach $ranges AS $range}	
						<td id="range_col_{$range[$rangeIdentifier]}_header" align="center">
							{if $hasOwnerShip}
								<a href="#rangeedit" class="agile-btn agile-btn-default range_fancybox" onclick="preEditRange({$range[$rangeIdentifier]},{$range.delimiter1|string_format:"%.2f"},{$range.delimiter2|string_format:"%.2f"});">
								<i class="icon-pencil"></i></a>
								<a href="javascript:deleteRange({$range[$rangeIdentifier]});" class="agile-btn agile-btn-default" onclick="return confirm('{l s='Are you sure to delete the range?' mod='agilesellershipping'}');">
								<i class="icon-trash"></i></a>
								<br>
							{/if}
								<label id="l_range_{$range[$rangeIdentifier]}">{$range.delimiter1|string_format:"%.2f"}{l s=' to ' mod='agilesellershipping'}
								<br>
								{$range.delimiter2|string_format:"%.2f"}</label>
						</td>
						{/foreach}
					</tr>
					<tr valign="top" id="zone_all" class="active">
						<td id ="all_zones" align="center">
							{l s='All Zones' mod='agilesellershipping'}
						</td>
						{foreach $ranges AS $range}	
						<td id="range_col_{$range[$rangeIdentifier]}_all" >
							<input type="text" size="10" id="fees_all_{$range[$rangeIdentifier]}" onkeyup="if ((event.keyCode||event.which) != 9){ spreadZoneFees({$range[$rangeIdentifier]})}">
						</td>
						{/foreach}
					</tr>

					{foreach $carrier_zones AS $carrier_zone}
					<tr valign="top" id="zone_{$carrier_zone.id_zone}">
						<td nowrap>
							{$carrier_zone.name}
						</td>
						{foreach $ranges AS $range}	
							<td nowrap  id="range_col_{$range[$rangeIdentifier]}_{$carrier_zone.id_zone}">
								<input type="text" size="10" name="fees_{$carrier_zone.id_zone}_{$range[$rangeIdentifier]}" id="fees_{$carrier_zone.id_zone}_{$range[$rangeIdentifier]}"
								 value="{if (isset($deliveryArray[$carrier_zone.id_zone][$range[$rangeIdentifier]]))}{$deliveryArray[$carrier_zone.id_zone][$range[$rangeIdentifier]]|string_format:"%.2f"}{else}0.00{/if}" />
							</td>
						{/foreach}
					</tr>
					{/foreach}
				</table>
			</div>
			<div style="display: none">
				<div id="rangeedit">
					<table id="tblRangeInput">
					<tr>
						<input type="hidden" id="edit_range_id" />
						<td><label>{l s='From: ' mod='agilesellershipping'}</label></td>
						<td>
							<input type="text" name="range_from" id="range_from" value="" /><br>
							{l s='Range start (included)' mod='agilesellershipping'}
						</td>
					</tr>
					<tr>
						<td><label>{l s='To: ' mod='agilesellershipping'}</label></td>
						<td>
							<input type="text" name="range_to" id="range_to" value="" /><br>
							{l s='Range end (excluded)' mod='agilesellershipping'}
						</td>
					</tr>
					<tr>
					<td colspan="2">
						<button type="submit" class="agile-btn agile-btn-default" name="submitBack" onclick="editRange();">
						<i class="icon-save"></i> <span>{l s='Save' mod='agilesellershipping'}</span></button>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<button type="button" class="agile-btn agile-btn-default" name="submitBack" onclick="$.fancybox.close();">
						<i class="icon-remove"></i> <span>{l s='Cancel' mod='agilesellershipping'}</span></button>
					</td>
					</tr>
					</table>
					<span id="spanProcessing" style="display:none;">{l s='Processing...' mod='agilesellershipping'}</span>
				</div>
			</div>
		{if $hasOwnerShip}				
		<div class="form-group agile-align-center clearfix">
			<div class="submitSave pull-left">
				<button type="submit" class="agile-btn agile-btn-default" name="submitSave" value="{l s='Save' mod='agilesellershipping'}">
				<i class="icon-save"></i> <span>{l s='Save' mod='agilesellershipping'}</span></button>
			</div>
			<div class="submitNext pull-right">
				<button type="submit" class="agile-btn agile-btn-default" name="submitBack" value="{l s='Back To Detail' mod='agilesellershipping'}">
				<i class="icon-arrow-left"></i> <span>{l s='Back To Detail' mod='agilesellershipping'}</span></button>
			</div>
		</div>
		{else}
		<div class="alert alert-warning">
			{l s='This is a shared carrier, you do not have permission to edit it.' mod='agilesellershipping'}
			<a style="color:blue;text-decoration:underline;" href="{$link->getModuleLink('agilesellershipping', 'sellercarrierdetail', ['process' =>'carrierdetail','id_carrier'=>$id_carrier], true)}">{l s='Go back to carrier info' mod='agilesellershipping'}</a>
		</div>
		{/if}	
		</div> <!-- end of panel -->
		</form>
		</div> <!-- end of agile -->
{/if}

{include file="$agilemultipleseller_views./templates/front/seller_footer.tpl"}

