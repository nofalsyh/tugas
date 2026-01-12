<?php
include "koneksi.php";

$id_buku = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

$query = mysqli_query($conn, "SELECT * FROM tbl_buku WHERE id_buku='$id_buku'");
$data = mysqli_fetch_array($query);

if (!$data) {
    die("Data buku tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Data Buku</title>
    </head>
    <body>
        <h2>Edit Data Buku: <?php echo htmlspecialchars($data['nama_buku']); ?></h2>
        <a href="admin.php?page=buku">Kembali ke Daftar Buku</a>
        <fieldset>
            <legend>Form Edit Buku</legend>
            <form action="edit_form_buku.php?id=<?php echo htmlspecialchars($id_buku); ?>" method="POST">
            <table border="0">
                <tr>
                    <td>ID Buku (Tidak dapat diubah)</td>
                    <td><input type="text" name="id_buku_readonly" value="<?php echo htmlspecialchars($data['id_buku']); ?>" readonly>
                    <input type="hidden" name="id_buku" value="<?php echo htmlspecialchars($data['id_buku']); ?>"></td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td><input type="text" name="kategori" value="<?php echo htmlspecialchars($data['kategori']); ?>"></td>
                </tr>
                <tr>
                    <td>Nama Buku</td>
                    <td><input type="text" name="nama_buku" value="<?php echo htmlspecialchars($data['nama_buku']); ?>"></td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td><input type="text" name="harga" value="<?php echo htmlspecialchars($data['harga']); ?>"></td>
                </tr>
                <tr>
                    <td>Stok</td>
                    <td><input type="text" name="stok" value="<?php echo htmlspecialchars($data['stok']); ?>"></td>
                </tr>
                <tr>
                    <td>Penerbit</td>
                    <td><input type="text" name="penerbit" value="<?php echo htmlspecialchars($data['penerbit']); ?>"></td>
                </tr>

                <tr>
                    <td colspan="2"><input type="submit" name="update" value="UPDATE DATA"></td>
                </tr>

            </table>
            </form>
        </fieldset>
    </body>
</html>

<?php
// BAGIAN PROSES UPDATE DI FILE YANG SAMA
if (isset($_POST['update'])) {
    $id_buku_upd = mysqli_real_escape_string($conn, $_POST['id_buku']);
    $kategori_upd = mysqli_real_escape_string($conn, $_POST['kategori']);
    $nama_buku_upd = mysqli_real_escape_string($conn, $_POST['nama_buku']);
    $harga_upd = mysqli_real_escape_string($conn, $_POST['harga']);
    $stok_upd = mysqli_real_escape_string($conn, $_POST['stok']);
    $penerbit_upd = mysqli_real_escape_string($conn, $_POST['penerbit']);

    $update = mysqli_query($conn, 
        "UPDATE tbl_buku SET 
        kategori='$kategori_upd', 
        nama_buku='$nama_buku_upd', 
        harga='$harga_upd', 
        stok='$stok_upd', 
        penerbit='$penerbit_upd' 
        WHERE id_buku='$id_buku_upd'"
    ) or die(mysqli_error($conn));

    if ($update) {
        echo "
            <script>
                alert('Data Buku Berhasil Diperbarui!');
                window.location.href = 'admin.php?page=buku';
            </script>
        ";
    } else {
        echo "<script>alert('Data Gagal Diperbarui!');</script>";
    }
}
?>