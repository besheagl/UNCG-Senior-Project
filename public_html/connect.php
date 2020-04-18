<?php
//	connection info
$sname = 		"localhost";
$dbuname = 		"id12568920_armchairappdb_admin";
$password = 	"Cscarm!ch678";
$database = 	"id12568920_armchairappdb";

$con = mysqli_connect($sname, $dbuname, $password, $database);
if (!$con) {
	die("failed to connect: " . mysqli_connect_error());
} else {
//	echo "did it";
}
?>