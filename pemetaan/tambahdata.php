<?php

require_once("db.php");

$company = strip_tags($_POST['company']);
$details = strip_tags($_POST['details']);
$latitude = strip_tags($_POST['latitude']);
$longitude = strip_tags($_POST['longitude']);
$telephone = strip_tags($_POST['telephone']);
$conn = new connectToDB();
$conn->addCompany($company, $details, $latitude, $longitude, $telephone);
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Tambah data</title>
 </head>
 <body>
  <h1>Data sudah ditambahkan</h1>
 </body>
</html>