<?php
$server_db = "localhost";
$user_db = "gnutlam";
$pass_db = "20210507";
$database_mysql = "tunglamdb";

$conn = new mysqli($server_db, $user_db, $pass_db, $database_mysql);

if ($conn->connect_error) 
    die("Kết nối thất bại: " . $conn->connect_error);

?>
