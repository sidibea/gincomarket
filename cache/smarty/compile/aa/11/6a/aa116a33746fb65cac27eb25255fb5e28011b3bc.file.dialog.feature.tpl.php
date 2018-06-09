<?php /* Smarty version Smarty-3.1.19, created on 2017-04-30 21:07:43
         compiled from "/home/abdouhanne/www/pr/modules/groupcategory/views/templates/admin/dialog.feature.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3568016185906521fbdea49-45927406%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa116a33746fb65cac27eb25255fb5e28011b3bc' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/groupcategory/views/templates/admin/dialog.feature.tpl',
      1 => 1492385467,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3568016185906521fbdea49-45927406',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5906521fbe3cb5_57849348',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5906521fbe3cb5_57849348')) {function content_5906521fbe3cb5_57849348($_smarty_tpl) {?><div id="dialog-feature" class="modal dts-modal fade" tabindex="-1">    <div class="modal-dialog modal-lg">        <div class="modal-content">            <div class="modal-header">                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                <span class="modal-title"><?php echo smartyTranslate(array('s'=>' Add feature','mod'=>'groupcategory'),$_smarty_tpl);?>
</span>            </div>            <div class="modal-body">            	            	<ul id="all-features"></ul>	            </div>                   </div>    </div></div><div class="clearfix"></div>	<script type="text/javascript" language="JavaScript">		var ext = '';        jQuery(function($){            	            $(document).on('click', '.link-open-dialog-feature', function(){                loadFeatureList();                                            });            $(document).on('click','.link-add-feature',function(){                        var itemId = $(this).data('id');                   var itemName = $(this).data('name');                            	$(this).removeClass('link-add-feature').addClass('link-add-feature-off').html('<i class="icon-check-square-o"></i>');    	        var html = '<li id="feature-'+itemId+'"><input type="hidden" class="feature_selected" name="features[]" value="'+itemId+'" /><span>'+itemName+'</span><a title="delete" href="javascript:void(0)" class="link-trash-feature c-red pull-right" data-id="'+itemId+'"><i class="icon-trash"></i></a></li>';    	        $("#list-features").append(html);        	});            $(document).on('click','.link-trash-feature',function(){                        var itemId = $(this).data('id');                 $("#feature-"+itemId).remove();                $("#link-add-feature-"+itemId).removeClass('link-add-feature-off').addClass('link-add-feature').html('<i class="icon-plus"></i>');                        	});            });            function loadFeatureList(page){            var error = false;            var selecteds = new Array();            if($("#modalGroup").hasClass('in')){            	if($("#modalGroup .feature_selected").length >0){        	    	$("#modalGroup .feature_selected").each(function (index){        	    		selecteds[index] = $(this).val();        	    	});        	    }                }else error = true;                        if(error == false){                var data={'action':'loadFeatureList', 'selecteds':selecteds, 'secure_key':secure_key};                $.ajax({            		type:'POST',            		url: currentUrl,            		data: data,            		dataType:'json',            		cache:false,            		async: true,            		beforeSend: function(){},            		complete: function(){},            		success: function(response){                        $("#all-features").html(response.list);                        showModal('dialog-feature', '');             		}		            	});                }                    }        	</script><?php }} ?>
