<?php
include "koneksi.php";

$id_buku = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

if (empty($id_buku)) {
    die("Error: ID Buku tidak ditemukan.");
}

// Perintah SQL DELETE
$delete = mysqli_query($conn, "DELETE FROM tbl_buku WHERE id_buku='$id_buku'") 
    or die("Gagal menghapus data: " . mysqli_error($conn));

if ($delete) {
    echo "
        <script>
            alert('Data Buku dengan ID $id_buku Berhasil Dihapus!');
            window.location.href = 'admin.php?page=buku';
        </script>
    ";
} else {
    echo "Data Buku Gagal Dihapus!";
    echo "<br><a href='admin.php?page=buku'>Kembali</a>";
}
?>