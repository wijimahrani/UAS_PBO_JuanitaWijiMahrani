<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "DB_UAS_PBO_TRPL1B_JuanitaWijiMahrani";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>