<?php
include "koneksi.php";

$id_penerbit = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

if (empty($id_penerbit)) {
    die("Error: ID Penerbit tidak ditemukan.");
}

// Perintah SQL DELETE
$delete = mysqli_query($conn, "DELETE FROM tbl_penerbit WHERE id_penerbit='$id_penerbit'") 
    or die("Gagal menghapus data: " . mysqli_error($conn));

if ($delete) {
    echo "
        <script>
            alert('Data Penerbit dengan ID $id_penerbit Berhasil Dihapus!');
            window.location.href = 'admin.php?page=penerbit';
        </script>
    ";
} else {
    echo "Data Penerbit Gagal Dihapus!";
    echo "<br><a href='admin.php?page=penerbit'>Kembali</a>";
}
?>