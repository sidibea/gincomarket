    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="{$base_dir_ssl}modules/agilemultipleseller/js/googlemaps.js"></script>
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
	<input type="button" name="btnGeoCode" value="{l s='Click Here To Get Map Location' mod='agilemultipleseller'}" onclick="javascript:codeAddress()" />
	<div id="map_canvas" class="agile-map-canvas"></div>
