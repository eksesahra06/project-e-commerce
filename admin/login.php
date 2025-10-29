<?php
session_start();

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

// Inisialisasi pesan kosong
$pesan = '';
$pesan_tipe = 'info'; // bisa 'info', 'success', 'error'

// Tangani semua jenis pesan
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] === 'logout') {
        $pesan = 'Anda telah berhasil logout.';
        $pesan_tipe = 'success';
    } elseif ($_GET['pesan'] === 'harus_login') {
        $pesan = 'Silakan login terlebih dahulu untuk mengakses halaman admin.';
        $pesan_tipe = 'info';
    }
}

// Tangani error login
$error = '';
if (isset($_GET['error']) && $_GET['error'] == '1') {
    $error = 'Username atau password salah!';
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Binary Admin</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <style>
        body {
            background: #f0f0f0;
            padding-top: 80px;
        }
        .login-panel {
            margin: 0 auto;
            max-width: 400px;
            padding: 20px;
            background: white;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .login-panel .panel-heading {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            height: 40px;
            font-size: 16px;
        }
        .btn-login {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background: #DA251C; /* Warna merah Binary Admin */
            border: none;
            border-radius: 4px;
            color: white;
        }
        .btn-login:hover {
            background: #b71c1c;
        }
        .error {
            color: #d9534f;
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-panel">
            <div class="panel-heading">
                <h3><i class="fa fa-lock"></i> Admin Login</h3>
            </div>

            <!-- Tampilkan PESAN (telah logout/harus login) -->
            <?php if ($pesan): ?>
                <div class="alert" style="<?php if ($pesan_tipe === 'success'): ?> background: #d4edda; border-color: #c3e6cb; color: #155724; <?php else: ?> background: #d9edf7; border-color: #bce8f1; color: #31708f; <?php endif; ?> padding: 12px; border-radius: 4px; margin-bottom: 20px; text-align: center;">
                    <i class="fa fa-<?php echo $pesan_tipe === 'success' ? 'check-circle' : 'info-circle'; ?>"></i>
                    <?= htmlspecialchars($pesan) ?>
                </div>
            <?php endif; ?>

            <!-- Tampilkan ERROR (username/password salah) -->
            <?php if ($error): ?>
                <div class="alert" style="
                    background: #f8d7da;
                    border-color: #f5c6cb;
                    color: #721c24;
                    padding: 12px;
                    border-radius: 4px;
                    margin-bottom: 20px;
                    text-align: center;
                ">
                    <i class="fa fa-exclamation-triangle"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="proses_login.php">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn-login">MASUK</button>
            </form>
        </div>
    </div>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>