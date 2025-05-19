<?php
// config.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lexica_db";

// buat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
