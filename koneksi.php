<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "tugasakhir";

$conn = mysqli_connect($server, $username, $password);
$select_db = mysqli_select_db($conn, $db);

if ($conn) {
    echo "";
    if ($select_db) {
        echo "";
    } else {
        echo "Nama database anda tidak ditemukan";
    }
} else {
    echo "Anda gagal terhubung ke database";
}
?>
