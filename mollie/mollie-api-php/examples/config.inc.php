<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

$db_hostname = 'localhost';
$db_username = '75405_DB';
$db_password = '6lin0z7g34';
$db_database = '75405_DB';

$mysqli = new mysqli($db_hostname, $db_username, $db_password, $db_database);

if ($mysqli->connect_error){
	die ("Connection failed: " . $mysqli->connect_error);
}