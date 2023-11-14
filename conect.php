<?php

$sever = "localhost";
$username = "root";
$password = "";
$db = "shopee";


$conn = mysqli_connect($sever,$username,$password,$db);

if (!$conn)
{
	die ("Connection failed ".mysql_connect_error());
}

?>