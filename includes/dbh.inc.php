<?php

//connect to mysql database
$servername = "localhost";
  $username = "wh01";
  $password = "Kauqylw7tpP1FNMt";
  $databasename = "swimclub";

  $conn =  mysqli_connect($servername, $username, $password,$databasename);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }



//$conn = mysqli_connect("localhost", "username", "password", "swimclub") or die("Connection Failed" .
//mysqli_error($conn));
?>
