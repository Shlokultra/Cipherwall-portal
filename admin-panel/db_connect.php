<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$host = "localhost";
$user = "root";
$pass = "";
$db = "admin-panel";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>

