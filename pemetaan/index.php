<?php
 require_once("db.php");
 $conn = new  connectToDB();
 $companies = $conn->getCompaniesList();
 $streets = $conn->getStreetsList();
 $areas = $conn->getAreasList();
?>
<!DOCTYPE html>
<html>
<head>
 <title>Leaflet basic example</title>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <link rel="shortcut icon" type="image/x-icon" href="../../docs/images/favicon.ico" />
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>

  <style>
		html, body {
			height: 100%;
			margin: 0;
		}
		.leaflet-container {
			height: 400px;
			width: 600px;
			max-width: 100%;
			max-height: 100%;
		}
	</style>

</head>
<body>
 <div id="map" style="width: 1300px; height: 800px"></div>
 <script>




//const map = L.map('map').setView([-0.9466289578746304, 100.41702571440919], 13);

var perusahaan = L.layerGroup();
    var jalan = L.layerGroup();
    var area = L.layerGroup();

    const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	})

  /* var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map); */
  
  var mapboxUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
    var street = L.tileLayer(mapboxUrl, {
        id : 'mapbox/streets-v11',
        tileSize : 512,
        zoomOffset : -1
    });
    var satellite = L.tileLayer(mapboxUrl, {
        id : 'mapbox/satellite-v9',
        tileSize : 512,
        zoomOffset : -1
    })

	var map = L.map('map', {
		center: [-0.9466289578746304, 100.41702571440919],
		zoom: 14,
		layers: [osm, perusahaan]
	});

	$(document).ready(function() {
   addCompanies();   
   addStreets();   
   addAreas();   
  });

    var baseMaps = {
        "OpenStreetMap" : osm,
        "MapBoxStreet" : street,
        "Satellite" : satellite
    }

    var overlays = {
        "Perusahaan" : perusahaan,
        "Jalan" : jalan,
        "Area" : area
    }
  
 
  function addCompanies() {
   for(var i=0; i<companies.length; i++) {
    var marker = L.marker( [companies[i]['latitude'], companies[i]['longitude']]).addTo(perusahaan);
    marker.bindPopup( "<b>" + companies[i]['company']+"</b><br>Details:" + companies[i]['details'] + "<br />Telephone: " + companies[i]['telephone']);
   }
  }
  
  function stringToGeoPoints( geo ) {
   var linesPin = geo.split(",");

   var linesLat = new Array();
   var linesLng = new Array();

  for(i=0; i < linesPin.length; i++) {
    if(i % 2) {
     linesLat.push(linesPin[i]);
    }else{
     linesLng.push(linesPin[i]);
    }
  }

  var latLngLine = new Array();

   for(i=0; i<linesLng.length;i++) {
    latLngLine.push( L.latLng( linesLat[i], linesLng[i]));
   }
   
   return latLngLine;
  }
  
  function addAreas() {
   for(var i=0; i < areas.length; i++) {
    var polygon = L.polygon( stringToGeoPoints(areas[i]['geolocations']), { color: 'blue'}).addTo(area);
    polygon.bindPopup( "<b>" + areas[i]['name']);   
   }
  }
  
  function addStreets() {
   for(var i=0; i < streets.length; i++) {
    var polyline = L.polyline(stringToGeoPoints(streets[i]['geolocations']), { color: 'red'}).addTo(jalan);
    polyline.bindPopup( "<b>" + streets[i]['name']);   
   }
  }
  
  var companies = JSON.parse( '<?php echo json_encode($companies) ?>' );
  var streets = JSON.parse( '<?php echo json_encode($streets) ?>' );
  var areas = JSON.parse( '<?php echo json_encode($areas) ?>' );

  var layerControl = L.control.layers(baseMaps, overlays).addTo(map);
 </script>
</body>
</html>