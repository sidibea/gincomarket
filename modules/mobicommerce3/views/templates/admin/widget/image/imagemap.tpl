{*
 * MobiCommerce
 *
 * @author    MobiCommerce
 * @copyright Copyright (c) MobiCommerce 2017
 * @license   Free license
 *}

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link type="text/css" rel="stylesheet" href="{$module_dir}views/css/admin/imagemap/imagemap.css">
		<link type="text/css" rel="stylesheet" href="{$module_dir}views/css/admin/imagemap/transformable.css">

		<script type="text/javascript" data-cfasync="false" src="{$module_dir}views/js/admin/imagemap/plusone.js"></script>
		<script type="text/javascript" data-cfasync="false" src="{$module_dir}views/js/admin/imagemap/jquery-1.js"></script>
		<script type="text/javascript" data-cfasync="false" src="{$module_dir}views/js/admin/imagemap/jquery.js?v={uniqid()}"></script>
		<script type="text/javascript" data-cfasync="false" src="{$module_dir}views/js/admin/imagemap/transformable.js"></script>
		<script type="text/javascript" data-cfasync="false" src="{$module_dir}views/js/admin/imagemap/canvas.js?v={uniqid()}"></script>
		<script type="text/javascript" data-cfasync="false" src="{$module_dir}views/js/admin/imagemap/mainFunctions.js?v={uniqid()}"></script>

		<script type="text/javascript" data-cfasync="false">
		{literal}
        	jQuery(function(){
				jQuery('.steps').slice(1).hide();
				jQuery('.startArrow').animate({'margin-top':'-10px','margin-left':'-20px'}).animate({'margin-top':'0px','margin-left':'0px'}).animate({'margin-top':'-10px','margin-left':'-20px'}).animate({'margin-top':'0px','margin-left':'0px'}).animate({'margin-top':'-10px','margin-left':'-20px'}).animate({'margin-top':'0px','margin-left':'0px'});
				jQuery('#imageURL').focus(function(){
					jQuery('.startArrow').fadeOut();
				});
			});
         {/literal}
		</script>
	</head>
	<body>
		<div id="mainContainer">
	        <div id="content">
	            <a id="start"></a>
	            <div id="application">
					<input id="imageURL" style="width:400px;" type="hidden" value="http://localhost/{$_request['imageurl']}">
	                <div>                    
	                    <div id="canvasContatiner"></div>
	                    <div id="linkAdder">
	                        <strong>{l s='Enter link URL:'}</strong>
	                        <input class="linkEditor" id="linkURL" autocomplete="on" style="width:200px;" type="text" readonly onclick="parent.showPopup()">
	                        
	                        <select class="linkEditor" id="linkTarget" name="linkTarget" style="display:none;">
	                            <option selected="selected" value="_self">{l s='Same Window'}</option>
	                        </select>
	                    </div>
	                    <button id="step2End">{l s='Click here to finish'}</button>
	                </div>
	            </div>
	        </div>
	    </div>
		<script>
		var imgURL = "{$_request['imageurl']}";
		{literal}
        if(imgURL!=''){
			var newImg = document.createElement('img');
			$(newImg).attr({
				'src': imgURL
				}).load(function(){
					$('.doneMark').eq(0).fadeIn(function(){
						$('#step1').slideUp(function(){
							$('#step2').slideDown();
						});
					});
					
					var canvas = document.createElement('div');
					
                    $(canvas).attr('id','canv').appendTo('#canvasContatiner').css({
						'width': newImg.width,
						'height': newImg.height,
						'background': 'url('+imgURL+') 0 0 no-repeat'
					});
					$.data(canvas,'realSize',{'width':newImg.width,'height':newImg.height});
					$.data(canvas,'url', imgURL);
					assignCanvas();
					drawPreviousRect(canvas);
				}).error(function(){
					$('.loader').hide(); 
					alert('Not a valid image, try a different URL..');
				});
		}
        {/literal}
        
		function drawPreviousRect(canvas)
		{
			{if (isset($_request['map_coords']) && !empty($_request['map_coords']))}
				{$coords = $_request['map_coords']}
				{assign var=coords value="__SEPRATER__"|explode:$coords}
                {assign var=hrefs value="__SEPRATER__"|explode:$_request['map_href']}
				
				{if !empty($coords)}
					{foreach from=$coords item=_coord key=_key}
                        {assign var=__coord value=","|explode:$_coord}
						var Selection = document.createElement("div");
						$(Selection).addClass("selection").css({
							top: {$__coord[1]},
							left: {$__coord[0]},
							width: "{($__coord[2] - $__coord[0])}px",
							height: "{($__coord[3] - $__coord[1])}px"
						});
						$(Selection).appendTo(canvas);
						$(Selection).removeClass("selection").addClass("theBox").transformable({
							unselectHandler: "unSelectBoxes",
							boxSelectHandler: "onBoxSelect",
							boxDeleteHandler: "onBoxDelete"
						}).hover(function() {
							if (!$(this).hasClass("selected")) {
								$(this).stop().animate({
									opacity: "1"
								}, "fast");
							}
						}, function() {
							if (!$(this).hasClass("selected")) {
								$(this).stop().animate({
									opacity: "0.8"
								}, "fast");
							}
						});
						$(Selection).removeClass('selected');
						$.data(Selection,'link',{
							'href': "{$hrefs[$_key]}",
							'alt': "",
							'target': ""
							});
					{/foreach}
				{/if}
                //$('#step2End').trigger('click');
			{/if}
		}
		</script>
	</body>
</html>