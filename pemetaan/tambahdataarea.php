<?php

require_once("db.php");

$name = strip_tags($_POST['name']);
$geolocations = strip_tags($_POST['geolocations']);
$conn = new connectToDB();
$conn->addAreas($name, $geolocations);
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Tambah Area</title>
 </head>
 <body>
  <h1>Data sudah ditambahkan</h1>
 </body>
</html>