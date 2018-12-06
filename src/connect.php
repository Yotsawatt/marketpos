<?php

// $host="localhost";
// $username="root";
// $password="12345678";
// $dbname="pos";

$host="localhost";
$username="root";
$password="";
$dbname="marketpos";

$connect = new mysqli($host,$username,$password,$dbname);
mysqli_set_charset($connect,"utf8");
//mysql_select_db($dbname,$connect);

if ($connect->connect_error) {
	die("Connected failed".$connect->connect_error);
}
else{

	//echo "Connected ";
}

?>