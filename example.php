<?php
  include('wequery.php');
  $brand = "BMW";
  $q = wequery("SELECT * FROM cars WHERE brand=?", "s, $brand");
  if(sizeof($q)) {
    foreach($q as $row) {
      echo $row['brand'].": ".$row['number']." cars available";
    }
  }
?>
