{*
*}
{extends file="helpers/form/form.tpl"}

{block name="field"}
	{if $input.type == 'text_sellerinfo'}
		<div class="col-lg-9 ">
	    {if $is_seller}
			<input name="id_seller" type="hidden" value="$sellerinfo->id_seller">
	    {else}
			<select name="id_seller" style="width:250px;">
				{foreach from=$sellers item=seller}
					<option value="{$seller.id_seller}" {if $sellerinfo->id_seller==$seller.id_seller}selected{/if}>{$seller.name}</option>
				{/foreach}
			</select>
			{/if}
        </div>
	{elseif $input.type == 'textarea'}
		<div class="col-lg-9 ">
		<textarea name="{$input.name}" id="{$input.name}" rows="3" cols="45">{if isset($fields_value[$input.name])}{$fields_value[$input.name]|escape:'htmlall':'UTF-8'}{/if}</textarea>
		</div>
    {elseif $input.name=="module_name"}
		<script type="text/javascript">
			$(document).ready(function() {
				$("#module_name").change(function() {
					set_field_labels($("#module_name").val());
				});

				set_field_labels($("#module_name").val());
			});

			{$labels}

			function set_field_labels(module)
			{
				if(module =='')return;
				for(idx=1;idx<=5;idx++)
				{
					field = "info" + idx;
					$('[name=' + field + ']').parent().prev().html(labels[module][field]);
					if(labels[module][field] != 'N/A')
					{
						$('[name=' + field + ']').parent().show();
						$('[name=' + field + ']').parent().prev().show();
					}
					else
					{
						$('[name=' + field + ']').parent().hide();
						$('[name=' + field + ']').parent().prev().hide();
					}
				}
			}		

		</script>
		{$smarty.block.parent}
    {else}
		{$smarty.block.parent}
	{/if}
{/block}
