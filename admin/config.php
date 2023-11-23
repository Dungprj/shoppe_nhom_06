<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db = "shoppe_new";

  $conn = mysqli_connect($servername,$username,$password,$db);
  //  Check connection
  if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
  }
  // echo "Connected successfully!";
?>