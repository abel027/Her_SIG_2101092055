<?php

require_once("db.php");

$name = strip_tags($_POST['name']);
$geolocations = strip_tags($_POST['geolocations']);
$conn = new connectToDB();
$conn->addStreets($name, $geolocations);
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Tambah data Streets</title>
 </head>
 <body>
  <h1>Data sudah ditambahkan</h1>
 </body>
</html>