<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$DB_servername = "localhost";
$DB_username = "DB_Schoolfeest";
$DB_password = "Zy1me78%";
$DB_dbname = "Lightitup_Schoolfeest";


// error_reporting(E_ALL);
// ini_set('error_reporting', 1);

// Maak de database-verbinding
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_dbname);

// Als de verbinding niet gemaakt kan worden: geef een melding
if (!$conn){
	echo "FOUT: Geen connectie naar database. <br>";
	echo " Errno: " . mysqli_connect_errno() . "<br>";
	echo " Error: " . mysqli_connect_error() .  "<br>";
	exit;
}
?>