<!DOCTYPE html>
<html>
 <head>
  <title>Input Data Streets</title>
  <script src="js/jquery.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" />  <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>

 </head>
 <body>
  <div id="map" style="width: 600px; height: 400px"></div>
  <form action="tambahdatastreet.php" method="post">
   <h1>Input Data Streets</h1>
   <table cellpadding="5" cellspacing="0" border="0">
    <tbody>
     <tr align="left" valign="top">
      <td align="left" valign="top">Street name</td>
      <td align="left" valign="top"><input type="text" name="name" /></td>
     </tr>

     <tr align="left" valign="top">
      <td align="left" valign="top">Geolocations</td>
      <td align="left" valign="top"><input id="lng" type="text" name="geolocations" /></td>
     </tr>

    <tr align="left" valign="top">
     <td align="left" valign="top"></td>
     <td align="left" valign="top"><input type="submit" value="Save"></td>
    </tr>
   </tbody>
  </table>
 </form>
 <script>
  var map = L.map('map').setView([-0.9462510832514028, 100.41665073650391], 13);

  L.tileLayer( 'https://api.mapbox.com/styles/v1/mapbox/streets-v10/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWVnYTYzODIiLCJhIjoiY2ozbXpsZHgxMDAzNjJxbndweDQ4am5mZyJ9.uHEjtQhnIuva7f6pAfrdTw', {
   maxZoom: 18,
   attribution: 'Map data &copy; <a href="http://openstreetmap.org/"> OpenStreetMap </a> contributors, ' +
    '<a href="http://creativecommons.org/"> CC-BY-SA </a>, ' +
    'Imagery © <a href="http://mapbox.com">Mapbox</a>',
   id: 'examples.map-i875mjb7'
  }).addTo(map);
   
  function putDraggable() {
   /* create a draggable marker in the center of the map */
   draggableMarker = L.marker([ map.getCenter().lat, map.getCenter().lng], {draggable:true, zIndexOffset:900}).addTo(map);
   
   /* collect Lat,Lng values */
   draggableMarker.on('dragend', function(e) {
    $("#lat").val(this.getLatLng().lat);
    $("#lng").val(this.getLatLng().lng);
   });
  }
   
  $( document ).ready(function() {
   putDraggable();
  });
 </script>
 </body>
</html>

<?php//100.35340792282031, -0.9078304492935907, 100.35224920850965, -0.9066182428188294, 100.3513372574318, -0.9058887732401514
//100.46839738295868, -0.8765593784604259, 100.39098457279454, -0.9425678451741288, 100.54819957524829 -0.9939459527143699, 100.55554035357298, -0.8728392089642503