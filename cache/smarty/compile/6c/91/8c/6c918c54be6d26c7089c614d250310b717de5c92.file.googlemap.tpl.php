<?php /* Smarty version Smarty-3.1.19, created on 2017-04-27 15:13:17
         compiled from "/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/googlemap.tpl" */ ?>
<?php /*%%SmartyHeaderCode:202482466759020a8d45e0f6-08062244%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c918c54be6d26c7089c614d250310b717de5c92' => 
    array (
      0 => '/home/abdouhanne/www/pr/modules/agilemultipleseller/views/templates/googlemap.tpl',
      1 => 1493122817,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '202482466759020a8d45e0f6-08062244',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'base_dir_ssl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59020a8d464b62_12869868',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59020a8d464b62_12869868')) {function content_59020a8d464b62_12869868($_smarty_tpl) {?>    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;?>
modules/agilemultipleseller/js/googlemaps.js"></script>
    <script type="text/javascript">
        var map;
        var geocoder = new google.maps.Geocoder();
        var markersArray = [];

        $(document).ready(function() {
            resetMap();
        });

        function resetMap() {
            initializeMap($("input#latitude").val(), $("input#longitude").val(), 12, "map_canvas");
            loc = new google.maps.LatLng($("input#latitude").val(), $("input#longitude").val());
            addMarker("0", loc);
        }

        function codeAddress() {
            var address = $("input#address1").val() + " " +
                          $("input#address2").val() + "," +
                          $("input#city").val() + " " +
                          $("select#id_state option:selected").text() + "," +
                            $("input#postcode").val() + " " +
                          $("select#id_country option:selected").text();
			if(is_multilang)
				address = $("input#address1_" + id_language).val() + " " +
                          $("input#address2_" + id_language).val() + "," +
                          $("input#city_" + id_language).val() + " " +
                          $("select#id_state option:selected").text() + "," +
                            $("input#postcode").val() + " " +
                          $("select#id_country option:selected").text();

            geocoder.geocode({ "address": address }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    $("input#latitude").val(results[0].geometry.location.lat());
                    $("input#longitude").val(results[0].geometry.location.lng());
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }

                resetMap();
            });
        }
		
    </script>
	<input type="button" name="btnGeoCode" value="<?php echo smartyTranslate(array('s'=>'Click Here To Get Map Location','mod'=>'agilemultipleseller'),$_smarty_tpl);?>
" onclick="javascript:codeAddress()" />
	<div id="map_canvas" class="agile-map-canvas"></div>
<?php }} ?>
