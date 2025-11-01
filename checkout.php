<?php 
session_start();

include 'koneksi.php';

//jika tidak ada session pelanggan, diarahkan ke halaman login
if (!isset($_SESSION["pelanggan"]))
{
    echo "<script>alert('silakan login');</script>";
    echo "<script>location='login.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
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

<pre>
    <?php print_r($_SESSION["pelanggan"]); ?>
</pre>
</body>
</html>