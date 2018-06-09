{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<form enctype="multipart/form-data" method="post" action="{$link->getAdminLink('MCManageApp')|addslashes}" class="defaultForm form-horizontal" id="addWidgetForm">
	<input type="hidden" value="HomePageWidgets" name="process_action" />
	<input type="hidden" value="1" id="widgetAdd" name="widgetAdd"> 
	<div class="panel">
		{l s='With category widget you can define product display in the way you wanted. Select Grid, List or Image view. Configure them with as much detail as you want like pricing, reviews, product name and rating. Create widgets like product display, Shop by Category, New Arrivals and many more.

		Leave blank If you dont want to customize the landing pages '}

		<div id="widgetLang" class="panel cart_rule_tab clearfix">
			<div class="panel-heading">
				{l s='Select Language [Store View]'}
			</div>
			<div class="form-wrapper">
				<div class="form-group">
					<label class="control-label col-lg-3">
						{l s='Store Languages'}  :
					</label>
					<div class="col-lg-9 ">
						<select id="languageSelected" name="languageSelected">
							{foreach $languages key=langIndex item=language}
								<option {if isset($language['id_lang']) && $language['id_lang'] == $lang}selected="selected"{/if} value="{$language.id_lang}">{$language.name}</option>
							{/foreach}
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-lg-3">
						{l s='Select Category'}
					</label>
					<div class="col-lg-9">
						{$categories->render()}
					</div>
				</div>
			</div>

			<div class="form-wrapper">
				<div class="form-group">
					<label class="control-label col-lg-3">
						{l s='Thumbnail Image'}  :
					</label>
					{if (isset($widgetImage['0']['mci_thumbnail']) && !empty($widgetImage['0']['mci_thumbnail']))}
						{$imagePath = $path}
						{$imageName = $widgetImage['0']['mci_thumbnail']}
					{else}
						{$imagePath = '../modules/mobicommerce3/views/img/admin/'}
						{$imageName = 'no_image.jpg'}
					{/if}

					<div class="col-lg-9">
						<div class="form-group">
							<div class="col-sm-6">
								<input type="file" accept="image/*" class="" name="categoryImage" id="categoryImage">
								<img  style="width:100pxa;height:100px" src="{$imagePath}{$imageName}"/>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="form-wrapper">
				<div class="form-group">
					<label class="control-label col-lg-3">
						{l s='Banner Image'}  :
					</label>
					{if (isset($widgetImage['0']['mci_banner']) && !empty($widgetImage['0']['mci_banner']))}
						{$imagePath = $path}
						{$imageName = $widgetImage['0']['mci_banner']}
					{else}
						{$imagePath = '../modules/mobicommerce3/views/img/admin/'}
						{$imageName = 'no_image.jpg'}
					{/if}

					<div class="col-lg-9">
						<div class="form-group">
							<div class="col-sm-6">
								<input type="file" accept="image/*" class="" name="categoryBannerImage" id="categoryBannerImage">
								<img  style="width:100px;height:100px" src="{$imagePath}{$imageName}"/>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="panel-footer">
				<button class="btn btn-default pull-right" name="submitAddCategoryImage" id="category_image_form_submit_btn" value="1" type="submit" onclick="return changeAction('ImageUpload')">
					<i class="process-icon-save"></i> {l s='Upload'}
				</button>
			</div>
		</div>
	</div>

	<div class="panel" style="display: none">
		<div id="CategoryList" class="form-wrapper" style="margin-top:25px">
			<div class="panel col-lg-12">
				<div class="panel-heading">
					{l s='Category Widgets'}<span class="badge">{count($widgetList)}</span>
					<span class="panel-heading-action">
						<a onclick="return addNewWidget();" id="desc-mobicommerce_category_widget-new">
							<span class="label-tooltip" data-toggle="tooltip" title="">
								<i class="process-icon-new"></i>
							</span>
						</a>
					</span>
				</div>

				<style>
					@media (max-width: 992px) {
						.table-responsive-row td:nth-of-type(1):before {
							content: "ID";
						}
						.table-responsive-row td:nth-of-type(2):before {
							content: "Lable";
						}
						.table-responsive-row td:nth-of-type(3):before {
							content: "Widget Code";
						}
						.table-responsive-row td:nth-of-type(4):before {
							content: "Position";
						}
						.table-responsive-row td:nth-of-type(5):before {
							content: "Displayed";
						}
					}
				</style>


				<div class="table-responsive-row clearfix">
					<table class="table mobicommerce_category_widget">
						<thead>
							<tr class="nodrag nodrop">
								<th class="fixed-width-xs center">
									<span class="title_box active">{l s='ID'}</span>
								</th>
								<th class="">
									<span class="title_box">{l s='Lable'}</span>
								</th>
								<th class="">
									<span class="title_box">{l s='Widget Code'}</span>
								</th>
								<th class="">
									<span class="title_box">{l s='Status'}</span>
								</th>

								<th class="">
									<span class="title_box">{l s='Position'}</span>
								</th>

								<th class="">
									<span class="title_box">{l s='Action'}</span>
								</th>
							</tr>
						</thead>
						<tbody>
							{assign var="widget_tabindex" value=100}
							{foreach $widgetList key=pageIndex item=widget}
								<tr class="row_{$widget['widget_id']} odd">
									<td class="pointer fixed-width-xs center">{$widget['widget_id']}</td>
									<td class="pointer">{$widget['widget_label']}</td>
									<td class="pointer">
										{if ($widget['widget_code']=="widget_image_slider")} 
											{l s='Image Slider'}
										{elseif ($widget['widget_code']=="widget_category")}
											{l s='Category'}
										{elseif ($widget['widget_code']=="widget_product_slider")}
											{l s='Product List'}
										{elseif ($widget['widget_code']=="widget_image")}
											{l s='Image'}
										{/if} 
									</td>
									<td class="pointer">
										{if ($widget['widget_status']=="1")}
											{l s='Enable'}
										{else}
											{l s='Disable'}
										{/if}
									</td>
									<td class="pointer fixed-width-sm center">
										<input style="width:40px" onchange="change_position({$widget['widget_id']},this)"  name="widget_position_list[{$widget['widget_id']}]" id="widget_position_{$widget['widget_id']}" value="{$widget['widget_position']}" tabindex="{$widget_tabindex}" />
									</td>
									<td class="pointer left">
										<a href="javascript:void(0);" onclick="return editWidget({$widget['widget_id']});">Edit</a> | <a href="javascript:void(0);" onclick="return deleteWidget({$widget['widget_id']});fetchWidgetList();"> {l s='Delete'}</a>
									</td>
								</tr>
								{capture assign=widget_tabindex}{$widget_tabindex+1}{/capture}
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</form>
<div id="mobi_loading_mask" style="display: none">
	<p id="loading_mask_loader" class="loader"><img alt="Loading..." src="{$module_dir}views/img/admin/ajax-loader-tr.gif">
	<!--<br>Please wait...-->
	</p>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		jQuery('#languageSelected').change(function(){   
			fetchCategories();
		});
		jQuery('input[name="categoryBox"]').click(function(){
			fetchCategories();
		})
	});

	function changeAction(action)
	{
		var imageupload = "{$link->getAdminLink('MCCategoryWidget')|addslashes}&action=uploadCategoryImage";

		$('#addWidgetForm').attr('action', imageupload);
	}

	function change_position(widget_id,ele)
	{
		return;
		$.ajax({
			type: 'POST',
			async: true,
			cache: false,
			data : {
				'ajax' : "1",
				'action' : 'changeWidgetPosition',
				'widget_id' : widget_id,
				'position' : ele.value,
				'type' : "widget_category",
			},
			"url": "{$link->getAdminLink('MCManageApp')|addslashes}",

			success: function(data)
			{
				
			},
			error: function(msg, textStatus, errorThrown)
			{
				jAlert("Network error in changing position, Please try again later");
			}
		});
	}

	function fetchCategories()
	{
		var lang_id = $('#languageSelected').val();
		var cat = jQuery('input[name="categoryBox"]:checked').val();
		window.location.href = "{$link->getAdminLink('MCCategoryWidget')|addslashes}&lang="+lang_id+"&id_category="+cat;
	}

	function fetchWidgetList()
	{
		window.location.reload();
	}

	function addNewWidget()
	{
		$('#widgetList').hide();
		$('#mobi_loading_mask').show();
		var lang_id = $('#languageSelected').val();
		var cat = jQuery('input[name="categoryBox"]:checked').val()
		$.ajax({
			type: 'POST',
			async: true,
			cache: false,
			data : {
				'ajax' : "1",
				'action' : 'addHomepageWidget',
				'lang_id' : lang_id,
				'cat':cat
			},
			"url": "{$link->getAdminLink('MCManageApp')|addslashes}",

			success: function(data)
			{
				$('#CategoryList').html(data);
				$('#CategoryList').show();
			},
			error: function(msg, textStatus, errorThrown)
			{
				jAlert("TECHNICAL ERROR:");
			},
			complete: function()
			{
				$('#mobi_loading_mask').hide();
			}
		});

		return false;
	}

	function editWidget(widget_id)
	{
		$('#widgetList').hide();
		$('#mobi_loading_mask').show();
		var lang_id = $('#languageSelected').val();
		var cat = jQuery('input[name="categoryBox"]:checked').val();

		$.ajax({
			type: 'POST',
			async: true,
			cache: false,
			data : {
				'ajax' : "1",
				'action' : 'addHomepageWidget',
				'lang_id' : lang_id,
				'widget_id' : widget_id,
				'cat':cat
			},
			"url": "{$link->getAdminLink('MCManageApp')|addslashes}",

			success: function(data)
			{
				$('#CategoryList').html(data);
				$('#CategoryList').show();
				$('#mobi_loading_mask').hide();
			},
			error: function(msg, textStatus, errorThrown)
			{
				jAlert("TECHNICAL ERROR:");
			}
		});
	}

	function deleteWidget(widget_id)
	{
		var confirm_msg = confirm("Are you sure you want to delete this widget?");
		if(!confirm_msg){
			return false;
		}

		$('#widgetList').hide();
		$('#mobi_loading_mask').show();
		
		var lang_id = $('#languageSelected').val();
		var cat = jQuery('input[name="categoryBox"]:checked').val();
		$.ajax({
			type: 'POST',
			async: true,
			cache: false,
			data : {
				'ajax' : "1",
				'action' : 'deleteHomepageWidget',
				'lang_id' : lang_id,
				'widget_id' : widget_id,
				'cat':cat
			},
			"url": "{$link->getAdminLink('MCManageApp')|addslashes}",

			success: function(data)
			{
				$(".row_"+widget_id).fadeOut(500);
				$('#mobi_loading_mask').hide();
			},
			error: function(msg, textStatus, errorThrown)
			{
				jAlert("TECHNICAL ERROR:");
			}
		});
	}
</script>