function initMap() {
	//get the street address of the displayed brewery from the document
	var streetAddy = $("#street-address").text() + " " + $("#city-address").text();
	var mapDiv = "<div id=\"map\"></div>";

	$(".brewery").append(mapDiv);

	var geocoder = new google.maps.Geocoder();

	//start the map off in Pittsburgh
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 10,
		center: {lat: 40.4406, lng: -79.9959}
	});

	encodeAddress(geocoder, map, streetAddy);
}

//need to geocode the address to display map at the proper location because i will be damned
//if i'm going to look up latitude/longitude information for all these places
function encodeAddress(geocoder, map, streetAddy) {
	geocoder.geocode({'address' : streetAddy}, function(results, status) {
		if(status === google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			var mark = new google.maps.Marker({
				map: map,
				position: results[0].geometry.location
			});

			//increase the zoom level.
			map.setZoom(14);
		}
		else {
			alert("Brewery not found on map.");
		}
	});
}