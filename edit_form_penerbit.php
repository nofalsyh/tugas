<?php
include "koneksi.php";

$id_penerbit = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

$query = mysqli_query($conn, "SELECT * FROM tbl_penerbit WHERE id_penerbit='$id_penerbit'");
$data = mysqli_fetch_array($query);

if (!$data) {
    die("Data penerbit tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Data Penerbit</title>
    </head>
    <body>
        <h2>Edit Data Penerbit: <?php echo htmlspecialchars($data['nama_penerbit']); ?></h2>
        <a href="admin.php?page=penerbit">Kembali ke Daftar Penerbit</a>
        <fieldset>
            <legend>Form Edit Penerbit</legend>
            <form action="edit_form_penerbit.php?id=<?php echo htmlspecialchars($id_penerbit); ?>" method="POST">
            <table border="0">
                <tr>
                    <td>ID Penerbit (Tidak dapat diubah)</td>
                    <td><input type="text" name="id_penerbit_readonly" value="<?php echo htmlspecialchars($data['id_penerbit']); ?>" readonly>
                    <input type="hidden" name="id_penerbit" value="<?php echo htmlspecialchars($data['id_penerbit']); ?>"></td>
                </tr>
                <tr>
                    <td>Nama Penerbit</td>
                    <td><input type="text" name="nama_penerbit" value="<?php echo htmlspecialchars($data['nama_penerbit']); ?>"></td>
                </tr>
                <tr>
                    <td>Alamat Penerbit</td>
                    <td><input type="text" name="alamat_penerbit" value="<?php echo htmlspecialchars($data['alamat_penerbit']); ?>"></td>
                </tr>
                <tr>
                    <td>Kota</td>
                    <td><input type="text" name="kota" value="<?php echo htmlspecialchars($data['kota']); ?>"></td>
                </tr>
                <tr>
                    <td>Telp</td>
                    <td><input type="text" name="telp" value="<?php echo htmlspecialchars($data['telp']); ?>"></td>
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
    $id_penerbit_upd = mysqli_real_escape_string($conn, $_POST['id_penerbit']);
    $nama_penerbit_upd = mysqli_real_escape_string($conn, $_POST['nama_penerbit']);
    $alamat_penerbit_upd = mysqli_real_escape_string($conn, $_POST['alamat_penerbit']);
    $kota_upd = mysqli_real_escape_string($conn, $_POST['kota']);
    $telp_upd = mysqli_real_escape_string($conn, $_POST['telp']);

    $update = mysqli_query($conn, 
        "UPDATE tbl_penerbit SET 
        nama_penerbit='$nama_penerbit_upd', 
        alamat_penerbit='$alamat_penerbit_upd', 
        kota='$kota_upd', 
        telp='$telp_upd' 
        WHERE id_penerbit='$id_penerbit_upd'"
    ) or die(mysqli_error($conn));

    if ($update) {
        echo "
            <script>
                alert('Data Penerbit Berhasil Diperbarui!');
                window.location.href = 'admin.php?page=penerbit';
            </script>
        ";
    } else {
        echo "<script>alert('Data Gagal Diperbarui!');</script>";
    }
}
?>