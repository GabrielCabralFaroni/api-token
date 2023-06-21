<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
$hostname = 'localhost';
$username = 'root'; 
$password = ''; 
$database = 'users';
$conn = mysqli_connect( $hostname, $username, $password, $database );
?>