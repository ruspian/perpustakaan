<?php
// db.php - Koneksi database
$host = "localhost";
$user = "root";
$pass = "Ruspian1998.";
$dbname = "perpustakaan";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>