<div id="product-images" class="panel product-tab">
  <input type="hidden" name="submitted_tabs[]" value="Images" />

  <h3 class="tab" >
    {l s='Images' mod='agilemultipleseller'}
    <span class="badge" id="countImage">{$countImages}</span>
  </h3>

  <div class="row">
    <div class="form-group">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3 file_upload_label">
        <span class="label-tooltip" data-toggle="tooltip"
          title="{l s='Format:' mod='agilemultipleseller'} JPG, GIF, PNG. {l s='Filesize:' mod='agilemultipleseller'} {$max_image_size|string_format:"%.2f"} {l s='kB max.' mod='agilemultipleseller'}">
          {if isset($id_image)}{l s='Edit this product image' mod='agilemultipleseller'}{else}{l s='Add a new image to this product'  mod='agilemultipleseller'}{/if}
        </span>
      </label>
      <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
        <input type="file" name="qqfile" size="55" />
        <button type="submit" class="agile-btn agile-btn-default" name="submitAddImage" value="{l s='   Upload   ' mod='agilemultipleseller'}">
          <i class="icon-upload "></i>&nbsp;<span>{l s='Upload' mod='agilemultipleseller'}</span>
        </button >
       </div>
    </div>

    <div class="form-group">
      <input type="hidden" name="resizer" value="auto" />
      {if Tools::getValue('id_image')}<input type="hidden" name="id_image" value="{Tools::getValue('id_image')}" />{/if}
    </div>
    
  </div>

  <div class="table-responsive">
    <table cellspacing="0" cellpadding="0" class="table tableDnD" id="imageTable">
      <thead>
        <tr class="nodrag nodrop">
          <th>{l s='Image' mod='agilemultipleseller'}</th>
          <th>{l s='Position' mod='agilemultipleseller'}</th>
          {*
          {if $shops}
          {foreach from=$shops item=shop}
          <th>{$shop.name}</th>
          {/foreach}
          {/if}
          *}
          <th>{l s='Cover' mod='agilemultipleseller'}</th>
          <th>{l s='Action' mod='agilemultipleseller'}</th>
        </tr>
      </thead>
      <tbody id="imageList">
      </tbody>
    </table>
  </div>
  <div class="table-responsive"  style="display:none;">
    <table id="lineType">
      <tr id="image_id">
        <td style="padding: 4px;">
          <a href="{$smarty.const._THEME_PROD_DIR_}image_path.jpg" target="_blank">
            <img src="{$smarty.const._THEME_PROD_DIR_}en-default-small_default.jpg" alt="image_id" title="image_id" />
          </a>
        </td>
        <td id="td_image_id" class="pointer dragHandle center positionImage">
          image_position
        </td>
        {*
        {if $shops}
        {foreach from=$shops item=shop}
        <td class="center">
          <input type="checkbox" class="image_shop" name="id_image" id="{$shop.id_shop}image_id" value="{$shop.id_shop}" />
        </td>
        {/foreach}
        {/if}
        *}
        <td class="center cover">
          <a href="#">
            <img class="covered" src="{$base_dir_ssl}img/admin/blank.gif" alt="e" />
          </a>
        </td>
        <td class="center">
          <a href="#" class="delete_product_image" >
            <img src="{$base_dir_ssl}img/admin/delete.gif" alt="{l s='Delete this image' mod='agilemultipleseller'}" title="{l s='Delete this image' mod='agilemultipleseller'}" />
          </a>
        </td>
      </tr>
    </table>
  </div>
</div>

	<script type="text/javascript">
		var upbutton = "{l s='Upload an image' mod='agilemultipleseller'}";
		var token = '{$token}';
		var come_from = '{$table}';
		var success_add =  "{l s='image has been successfully added' mod='agilemultipleseller'}";
		var id_tmp = 0;
		var ajax_products_url = "{$base_dir_ssl}modules/agilemultipleseller/ajax_products.php";
		{literal}
		/** _agile_ Ready Function _agile_ **/
		$(document).ready(function(){
			{/literal}
			{foreach from=$images item=image}
				assoc = {literal}"{"{/literal};
				{if $shops}
					{foreach from=$shops item=shop}
						assoc += '"{$shop.id_shop}" : {if $image->isAssociatedToShop($shop.id_shop)}1{else}0{/if},';
					{/foreach}
				{/if}
				if (assoc != {literal}"{"{/literal})
				{
					assoc = assoc.slice(0, -1);
					assoc += {literal}"}"{/literal};
					assoc = jQuery.parseJSON(assoc);
				}
				else
					assoc = false;
				imageLine({$image->id}, "{$image->getExistingImgPath()}", {$image->position}, "{if $image->cover}enabled{else}forbbiden{/if}", assoc);
			{/foreach}
			{literal}
			$("#imageTable").tableDnD(
			{
				onDrop: function(table, row) {
				current = $(row).attr("id");
				stop = false;
				image_up = "{";
				$("#imageList").find("tr").each(function(i) {
					$("#td_" +  $(this).attr("id")).html(i + 1);
					if ($(this).attr("id") == current)
					{	
						image_up += '"' + $(this).attr("id") + '" : ' + (i + 1) + ',';
						stop = true;
					}
					if (!stop || (i + 1) == 2)
						image_up += '"' + $(this).attr("id") + '" : ' + (i + 1) + ',';
				});
				image_up = image_up.slice(0, -1);
				image_up += "}";
				updateImagePositon(image_up);
				}
			});
			var filecheck = 1;

			/**
			 * on success function 
			 */
			function afterDeleteProductImage(data)
			{
				data = $.parseJSON(data);
				if (data)
				{
					cover = 0;
					id = data.content.id;
					if(data.status == 'ok')
					{
						if ($("#" + id).find(".covered").attr("src") == "{$base_dir_ssl}img/admin/enabled.gif")
							cover = 1;
						$("#" + id).remove();
					}
					if (cover)
						$("#imageTable tr").eq(1).find(".covered").attr("src", "{$base_dir_ssl}img/admin/enabled.gif");
					$("#countImage").html(parseInt($("#countImage").html()) - 1);
					refreshImagePositions($("#imageTable"));
					
					showSuccessMessage(data.confirmations);

				}
			}

			$('.delete_product_image').die().live('click', function(e)
			{
				e.preventDefault();
				id = $(this).parent().parent().attr('id');
				if (confirm("{/literal}{l s='Are you sure?' js=1}{literal}"))
				doFrontAjax(ajax_products_url,
				        {
						    "action":"deleteProductImage",
						    "id_image":id,
						    "id_product" : {/literal}{$id_product}{literal},
						    "id_category" : {/literal}{$id_category_default}{literal},
						    "ajax" : 1 
						}, 
						afterDeleteProductImage
				);
			});
			
			$('.covered').die().live('click', function(e)
			{
				e.preventDefault();
				id = $(this).parent().parent().parent().attr('id');
				$("#imageList .cover img").each( function(i){
					$(this).attr("src", $(this).attr("src").replace("enabled", "forbbiden"));
				});
				$(this).attr("src", $(this).attr("src").replace("forbbiden", "enabled"));
				doFrontAjax(ajax_products_url,
				{
					"action":"UpdateCover",
					"id_image":id,
					"id_product" : {/literal}{$id_product}{literal},
					"ajax" : 1 }
				);
				
			});
			
			$('.image_shop').die().live('click', function()
			{
				active = false;
				if ($(this).attr("checked"))
					active = true;
				id = $(this).parent().parent().attr('id');
				id_shop = $(this).attr("id").replace(id, "");
				doFrontAjax(ajax_products_url,
				{
					"action":"UpdateProductImageShopAsso",
					"id_image":id,
					"id_shop": id_shop,
					"active":active,
					"token" : "{/literal}{$token}{literal}",
					"tab" : "AdminProducts",
					"ajax" : 1 
				});
			});
			
			/** _agile_ function	_agile_ **/
			function updateImagePositon(json)
			{
				doFrontAjax(ajax_products_url,
				{
					"action":"updateImagePosition",
					"json":json,
					"token" : "{/literal}{$token}{literal}",
					"tab" : "AdminProducts",
					"ajax" : 1
				});
	
			}
			
			function delQueue(id)
			{
				$("#img" + id).fadeOut("slow");
				$("#img" + id).remove();
			}
			
			function imageLine(id, path, position, cover, shops)
			{
				line = $("#lineType").html();
				line = line.replace(/image_id/g, id);
    			line = line.replace(/en-default/g, path);
	    		line = line.replace(/image_path/g, path);
				line = line.replace(/image_position/g, position);
				line = line.replace(/blank/g, cover);
				line = line.replace("<tbody>", "");
				line = line.replace("</tbody>", "");
				if (shops != false)
				{
					$.each(shops, function(key, value){
						if (value == 1)
							line = line.replace('id="' + key + '' + id + '"','id="' + key + '' + id + '" checked=checked');
					});
				}
				$("#imageList").append(line);
			}

			function refreshImagePositions(imageTable)
			{
				var reg = /_[0-9]$/g;
				var up_reg  = new RegExp("imgPosition=[0-9]+&");

				imageTable.find("tbody tr").each(function(i,el) {
					$(el).find("td.positionImage").html(i + 1);
				});
				imageTable.find("tr td.dragHandle a:hidden").show();
				imageTable.find("tr td.dragHandle:first a:first").hide();
				imageTable.find("tr td.dragHandle:last a:last").hide();
			}

		});
		{/literal}
	</script>

