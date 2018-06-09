function initializeMap(lat, lng, zoom, canvas) {
    var centerPos = new google.maps.LatLng(lat, lng);
    var mapOptions = {
        zoom: zoom,
        center: centerPos,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById(canvas), mapOptions);
}

function showMarkerDetail(title) {
    $.ajax({
        type: 'POST',
        url: baseDir + 'modules/agilepickupcenter/ajax_location_info.php',
        data: 'id_location=' + title,
        success: function (content) {
            marker = getMarkerByTitle(title);
            infowindow.setContent(content);
            infowindow.open(map, marker);
        }
    });

}

function getMarkerByTitle(title) {
    for (idx = 0; idx < markersArray.length; idx++) {
        if (markersArray[idx].title == title) return markersArray[idx];
    }
    return null;
}

function addMarker(key, location) {
    marker = new google.maps.Marker({
        position: location,
        map: map,
        title: key
    });
    google.maps.event.addListener(marker, 'click', function () {
        showMarkerDetail(key);
    });

    markersArray.push(marker);
}

/** _agile_  Removes the overlays from the map, but keeps them in the array _agile_  **/
function clearOverlays() {
    if (markersArray) {
        for (i in markersArray) {
            markersArray[i].setMap(null);
        }
    }
}

/** _agile_  Shows any overlays currently in the array _agile_  **/
function showOverlays() {
    if (markersArray) {
        for (i in markersArray) {
            markersArray[i].setMap(map);
        }
    }
}

/** _agile_  Deletes all markers in the array by removing references to them _agile_  **/
function deleteOverlays() {
    if (markersArray) {
        for (i in markersArray) {
            markersArray[i].setMap(null);
        }
        markersArray.length = 0;
    }
}

