<?php
include "koneksi.php";

$id_buku        = $_POST['id_buku'];
$kategori       = $_POST['kategori'];
$nama_buku      = $_POST['nama_buku'];
$harga          = $_POST['harga'];
$stok           = $_POST['stok'];
$penerbit       = $_POST['penerbit'];

if (isset($_POST['simpan'])) {
    $input = mysqli_query(
        $conn,
        "INSERT INTO tbl_buku VALUES ('$id_buku', '$kategori', '$nama_buku', '$harga', '$stok', '$penerbit')"
    ) or die(mysqli_error($conn));

    if ($input) {
        echo "
            <script>
                alert('Data Berhasil Disimpan');
                // Asumsi halaman daftar buku Anda adalah admin.php?page=buku
                window.location.href = 'admin.php?page=buku'; 
            </script>
        ";

    } else {
        echo "Data Gagal Tersimpan";
    }
}
?>