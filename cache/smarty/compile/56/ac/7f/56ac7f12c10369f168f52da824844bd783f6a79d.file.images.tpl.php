<?php /* Smarty version Smarty-3.1.19, created on 2017-04-28 18:51:45
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/products/images.tpl" */ ?>
<?php /*%%SmartyHeaderCode:178771501259038f41495547-35142094%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '56ac7f12c10369f168f52da824844bd783f6a79d' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/front/products/images.tpl',
      1 => 1493122817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178771501259038f41495547-35142094',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'countImages' => 0,
    'max_image_size' => 0,
    'id_image' => 0,
    'base_dir_ssl' => 0,
    'token' => 0,
    'table' => 0,
    'images' => 0,
    'shops' => 0,
    'shop' => 0,
    'image' => 0,
    'id_product' => 0,
    'id_category_default' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59038f41509791_85785585',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59038f41509791_85785585')) {function content_59038f41509791_85785585($_smarty_tpl) {?><div id="product-images" class="panel product-tab">
  <input type="hidden" name="submitted_tabs[]" value="Images" />

  <h3 class="tab" >
    <?php echo smartyTranslate(array('s'=>'Images','mod'=>'agilemultipleseller'),$_smarty_tpl);?>

    <span class="badge" id="countImage"><?php echo $_smarty_tpl->tpl_vars['countImages']->value;?>
</span>
  </h3>

  <div class="row">
    <div class="form-group">
      <label class="control-label agile-col-md-3 agile-col-lg-3 agile-col-xl-3 file_upload_label">
        <span class="label-tooltip" data-toggle="tooltip"
          title="<?php echo smartyTranslate(array('s'=>'Format:','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
 JPG, GIF, PNG. <?php echo smartyTranslate(array('s'=>'Filesize:','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
 <?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['max_image_size']->value);?>
 <?php echo smartyTranslate(array('s'=>'kB max.','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
">
          <?php if (isset($_smarty_tpl->tpl_vars['id_image']->value)) {?><?php echo smartyTranslate(array('s'=>'Edit this product image','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
<?php } else { ?><?php echo smartyTranslate(array('s'=>'Add a new image to this product','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
<?php }?>
        </span>
      </label>
      <div class="agile-col-md-9 agile-col-lg-9 agile-col-xl-9">
        <input type="file" name="qqfile" size="55" />
        <button type="submit" class="agile-btn agile-btn-default" name="submitAddImage" value="<?php echo smartyTranslate(array('s'=>'   Upload   ','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
">
          <i class="icon-upload "></i>&nbsp;<span><?php echo smartyTranslate(array('s'=>'Upload','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</span>
        </button >
       </div>
    </div>

    <div class="form-group">
      <input type="hidden" name="resizer" value="auto" />
      <?php if (Tools::getValue('id_image')) {?><input type="hidden" name="id_image" value="<?php echo Tools::getValue('id_image');?>
" /><?php }?>
    </div>
    
  </div>

  <div class="table-responsive">
    <table cellspacing="0" cellpadding="0" class="table tableDnD" id="imageTable">
      <thead>
        <tr class="nodrag nodrop">
          <th><?php echo smartyTranslate(array('s'=>'Image','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</th>
          <th><?php echo smartyTranslate(array('s'=>'Position','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</th>
          
          <th><?php echo smartyTranslate(array('s'=>'Cover','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</th>
          <th><?php echo smartyTranslate(array('s'=>'Action','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
</th>
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
          <a href="<?php echo @constant('_THEME_PROD_DIR_');?>
image_path.jpg" target="_blank">
            <img src="<?php echo @constant('_THEME_PROD_DIR_');?>
en-default-small_default.jpg" alt="image_id" title="image_id" />
          </a>
        </td>
        <td id="td_image_id" class="pointer dragHandle center positionImage">
          image_position
        </td>
        
        <td class="center cover">
          <a href="#">
            <img class="covered" src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
img/admin/blank.gif" alt="e" />
          </a>
        </td>
        <td class="center">
          <a href="#" class="delete_product_image" >
            <img src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
img/admin/delete.gif" alt="<?php echo smartyTranslate(array('s'=>'Delete this image','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Delete this image','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
" />
          </a>
        </td>
      </tr>
    </table>
  </div>
</div>

	<script type="text/javascript">
		var upbutton = "<?php echo smartyTranslate(array('s'=>'Upload an image','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
";
		var token = '<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
';
		var come_from = '<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
';
		var success_add =  "<?php echo smartyTranslate(array('s'=>'image has been successfully added','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
";
		var id_tmp = 0;
		var ajax_products_url = "<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
modules/agilemultipleseller/ajax_products.php";
		
		/** _agile_ Ready Function _agile_ **/
		$(document).ready(function(){
			
			<?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['images']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value) {
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
				assoc = "{";
				<?php if ($_smarty_tpl->tpl_vars['shops']->value) {?>
					<?php  $_smarty_tpl->tpl_vars['shop'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['shop']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['shops']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['shop']->key => $_smarty_tpl->tpl_vars['shop']->value) {
$_smarty_tpl->tpl_vars['shop']->_loop = true;
?>
						assoc += '"<?php echo $_smarty_tpl->tpl_vars['shop']->value['id_shop'];?>
" : <?php if ($_smarty_tpl->tpl_vars['image']->value->isAssociatedToShop($_smarty_tpl->tpl_vars['shop']->value['id_shop'])) {?>1<?php } else { ?>0<?php }?>,';
					<?php } ?>
				<?php }?>
				if (assoc != "{")
				{
					assoc = assoc.slice(0, -1);
					assoc += "}";
					assoc = jQuery.parseJSON(assoc);
				}
				else
					assoc = false;
				imageLine(<?php echo $_smarty_tpl->tpl_vars['image']->value->id;?>
, "<?php echo $_smarty_tpl->tpl_vars['image']->value->getExistingImgPath();?>
", <?php echo $_smarty_tpl->tpl_vars['image']->value->position;?>
, "<?php if ($_smarty_tpl->tpl_vars['image']->value->cover) {?>enabled<?php } else { ?>forbbiden<?php }?>", assoc);
			<?php } ?>
			
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
				if (confirm("<?php echo smartyTranslate(array('s'=>'Are you sure?','js'=>1),$_smarty_tpl);?>
"))
				doFrontAjax(ajax_products_url,
				        {
						    "action":"deleteProductImage",
						    "id_image":id,
						    "id_product" : <?php echo $_smarty_tpl->tpl_vars['id_product']->value;?>
,
						    "id_category" : <?php echo $_smarty_tpl->tpl_vars['id_category_default']->value;?>
,
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
					"id_product" : <?php echo $_smarty_tpl->tpl_vars['id_product']->value;?>
,
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
					"token" : "<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
",
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
					"token" : "<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
",
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
		
	</script>

<?php }} ?>
