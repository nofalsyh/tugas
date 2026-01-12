<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Admin Toko Buku</title>
    <style>
        /* Gaya dasar */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0;}
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .menu-bar { border: 1px solid black; margin-bottom: 20px;}
        .menu-bar td { text-align: center; border: 1px solid black; }
        .menu-bar a { text-decoration: none; display: block; padding: 10px; color: #333; font-weight: bold;}
        .menu-bar summary { padding: 10px; cursor: pointer; font-weight: bold; list-style: none; }
        .submenu a { padding: 5px; font-weight: normal; display: block; }
        h2 { text-align: center; }
        h3 { margin-top: 30px; }
        
        details > summary::-webkit-details-marker { display: none; }
        details > summary { list-style: none; }
    </style>
</head>
<body>

<div class="menu-bar">
    <table>
        <tr>
            <td width="50%">
                <a href="index.html">HOME</a>
            </td>
            <td width="50%">
                <details open> <summary>ADMIN</summary>
                    <div class="submenu">
                        <a href="admin.php?page=buku">BUKU</a>
                        <a href="admin.php?page=penerbit">PENERBIT</a>
                    </div>
                </details>
            </td>
        </tr>
    </table>
</div>

<br>

<div style="padding: 0 10px;">
<h2>Pengelolaan Data</h2>

<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

if ($page == 'home') {
    echo "<h3>Selamat datang di Halaman Pengelolaan Data Admin. Silakan pilih BUKU atau PENERBIT pada menu ADMIN di atas.</h3>";
} elseif ($page == 'buku') {
    echo "<h3>Daftar Buku</h3>";
    echo "<a href='create_form_buku.html'>+ Tambah Data Buku</a><br><br>"; 

    $query_buku = mysqli_query($conn, "SELECT * FROM tbl_buku") or die(mysqli_error($conn));
?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Buku</th>
                <th>Kategori</th>
                <th>Nama Buku</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Penerbit</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no_buku = 1;
            while ($data_buku = mysqli_fetch_array($query_buku)) {
            ?>
            <tr>
                <td><?php echo $no_buku++; ?></td>
                <td><?php echo htmlspecialchars($data_buku['id_buku']); ?></td>
                <td><?php echo htmlspecialchars($data_buku['kategori']); ?></td>
                <td><?php echo htmlspecialchars($data_buku['nama_buku']); ?></td>
                <td><?php echo 'Rp ' . number_format($data_buku['harga'], 0, ',', '.'); ?></td>
                <td><?php echo htmlspecialchars($data_buku['stok']); ?></td>
                <td><?php echo htmlspecialchars($data_buku['penerbit']); ?></td>
                <td>
                    <a href='edit_form_buku.php?id=<?php echo htmlspecialchars($data_buku['id_buku']); ?>'>Edit</a> | 
                    <a href='delete_form_buku.php?id=<?php echo htmlspecialchars($data_buku['id_buku']); ?>' onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php
            }
            if (mysqli_num_rows($query_buku) == 0) {
                echo '<tr><td colspan="8" align="center">Belum ada data buku.</td></tr>';
            }
            ?>
        </tbody>
    </table>

<?php
} elseif ($page == 'penerbit') {
    echo "<h3>Daftar Penerbit</h3>";
    echo "<a href='create_form_penerbit.html'>+ Tambah Data Penerbit</a><br><br>"; 

    $query_penerbit = mysqli_query($conn, "SELECT * FROM tbl_penerbit") or die(mysqli_error($conn));
?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Penerbit</th>
                <th>Nama Penerbit</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Telp</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no_penerbit = 1;
            while ($data_penerbit = mysqli_fetch_array($query_penerbit)) {
            ?>
            <tr>
                <td><?php echo $no_penerbit++; ?></td>
                <td><?php echo htmlspecialchars($data_penerbit['id_penerbit']); ?></td>
                <td><?php echo htmlspecialchars($data_penerbit['nama_penerbit']); ?></td>
                <td><?php echo htmlspecialchars($data_penerbit['alamat_penerbit']); ?></td>
                <td><?php echo htmlspecialchars($data_penerbit['kota']); ?></td>
                <td><?php echo htmlspecialchars($data_penerbit['telp']); ?></td>
                <td>
                    <a href='edit_form_penerbit.php?id=<?php echo htmlspecialchars($data_penerbit['id_penerbit']); ?>'>Edit</a> | 
                    <a href='delete_form_penerbit.php?id=<?php echo htmlspecialchars($data_penerbit['id_penerbit']); ?>' onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php
            }
            if (mysqli_num_rows($query_penerbit) == 0) {
                echo '<tr><td colspan="7" align="center">Belum ada data penerbit.</td></tr>';
            }
            ?>
        </tbody>
    </table>
<?php
}
?>
</div>

</body>
</html>