<?php 
session_start();

// 🔑 INISIALISASI KERANJANG JIKA BELUM ADA
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = []; // buat array kosong
}

// Hanya tampilkan print_r jika keranjang tidak kosong (opsional)
// echo "<pre>";
// print_r($_SESSION['keranjang']);
// echo "</pre>";

include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Keranjang</title>
        <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    </head>
    <body>
        <!-- navbar -->
        <nav class="navbar navbar-default">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="keranjang.php">Keranjang</a></li>
                    <!-- jika sudah login ada session pelanggan -->
                    <?php if (isset($_SESSION["pelanggan"])): ?>
                        <li><a href="logout.php">Logout</a></li>
                    <!-- selain itu belum login, belum ada session pelanggan -->
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                    <?php endif ?>
                    <li><a href="checkout.php">Checkout</a></li>
                </ul>
            </div>
        </nav>

        <section class="konten">
            <div class="container">
                <h1>Keranjang Belanja</h1>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subharga</th>
                            <th>AKsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($_SESSION['keranjang'])): ?>
                            <tr>
                                <td colspan="6" class="text-center">Keranjang anda masih kosong</td>
                            </tr>
                        <?php else: ?>
                            <?php $nomor = 1; ?>
                            <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                                <?php 
                                $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                $pecah = $ambil->fetch_assoc();
                                $subharga = $pecah["harga_produk"] * $jumlah;
                                ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo htmlspecialchars($pecah["nama_produk"]); ?></td>
                                    <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
                                    <td><?php echo $jumlah; ?></td>
                                    <td>Rp. <?php echo number_format($subharga); ?></td>
                                    <td>
                                        <a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
                                    </td>
                                </tr>
                                <?php $nomor++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
                <a href="checkout.php" class="btn btn-primary">Checkout</a>
            </div>
        </section>
    </body
</html>