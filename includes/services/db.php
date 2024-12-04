<?php
$host = "db";
$dbname = "lottery";
$username = "admin";  
$password = "admin";      

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}
?>
