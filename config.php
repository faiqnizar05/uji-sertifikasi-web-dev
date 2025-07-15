<?php
// config ini untuk menghubungkan kedalama database
$host = "localhost";
$user = "root";     
$pass = "";         
$db   = "data";

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");
?>
