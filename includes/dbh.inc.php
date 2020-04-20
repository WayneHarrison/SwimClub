<?php

//connect to mysql database
$servername = "b8rg15mwxwynuk9q.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
  $username = "m0a8ocouho4elhr3";
  $password = "fbhf47zimyqaf4kn";
  $databasename = "tqxi9rz9zqkfnnhw";

  $conn =  mysqli_connect($servername, $username, $password,$databasename);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }



//$conn = mysqli_connect("localhost", "username", "password", "swimclub") or die("Connection Failed" .
//mysqli_error($conn));
?>
