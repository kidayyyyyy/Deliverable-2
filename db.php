<?php
// db.php
$host = 'localhost';
$db   = 'EquipEase_DEV'; 
$user = 'root';    
$pass = '';      

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>