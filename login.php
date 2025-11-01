<?php
session_start();

include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Pelanggan</title>
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

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-little">Login Pelanggan</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <button class="btn btn-primary" name="login">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
if (isset($_POST["login"]))
{
    $email = $_POST["email"];
    $password = $_POST["password"];
    //lakukan query pengecekan akun pelanggan pada db
    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

    //hitung akun yang diambil
    $akunyangcocok = $ambil->num_rows;

    //jika ada 1 yang cocok, maka diloginkan
    if ($akunyangcocok==1)
    {
        //sukses login, mendapatkan akun dalam bentuk array
        $akun = $ambil->fetch_assoc();
        //simpan ke session pelanggan
        $_SESSION["pelanggan"] = $akun;

        echo "<script>alert('anda sukses login');</script>";
        echo "<script>location='checkout.php';</script>";
    } 
    else
    {
        //gagal login
        echo "<script>alert('anda gagal login, periksa akun anda');</script>";
        echo "<script>location='login.php';</script>";
    }
}
?>

</body>
</html>