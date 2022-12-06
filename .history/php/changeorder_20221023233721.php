<?php
ini_set('display_errors', 1);

 

ini_set('display_startup_errors', 1);

 

error_reporting(E_ALL);

session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phporders';
// Try and connect using the info above.
$con = new mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if($con ->connect_error) {
    die("Failed to connect : " .$con ->connect_error) 
} else {
    $stmt = $con ->prepare
}