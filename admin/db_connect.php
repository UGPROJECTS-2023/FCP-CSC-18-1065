<?php
$hostname = 'localhost'; 
$username = 'root'; 
$password = '';
$database = 'studentadvisingsystem';
$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
