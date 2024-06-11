<?php
  include('wequery.php');
  $brand = "BMW";
  $q = wequery("SELECT * FROM cars WHERE brand=?", "s", $brand);
  while($row = $q->fetch_assoc()) {
    echo $row['brand'].": ".$row['number']." cars available";
  }
?>
