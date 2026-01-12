<?php
include "koneksi.php";

$id_penerbit         = $_POST['id_penerbit'];
$nama_penerbit       = $_POST['nama_penerbit'];
$alamat_penerbit     = $_POST['alamat_penerbit'];
$kota                = $_POST['kota'];
$telp                = $_POST['telp'];

if (isset($_POST['simpan'])) {
    $input = mysqli_query(
        $conn,
        "INSERT INTO tbl_penerbit VALUES ('$id_penerbit', '$nama_penerbit', '$alamat_penerbit', '$kota', '$telp')"
    ) or die(mysqli_error($conn));

    if ($input) {
        echo "
            <script>
                alert('Data Penerbit Berhasil Disimpan!');
                // Mengarahkan ke halaman daftar penerbit di admin.php
                window.location.href = 'admin.php?page=penerbit'; 
            </script>
        ";
    } else {
        echo "Data Gagal Tersimpan";
    }
}
?>