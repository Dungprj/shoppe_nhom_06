<?php

$sever = "localhost";
$username = "root";
$password = "";
$db = "shopee";


$conn = mysqli_connect($sever,$username,$password,$db);

if (!$conn)
{
	die("Kết nối thất bại: " . mysqli_connect_error());
}

?>