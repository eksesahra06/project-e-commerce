<?php
session_start();

// Koneksi database (sesuaikan jika file koneksi terpisah)
$koneksi = new mysqli("localhost", "root", "", "db_ecommerce");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

$username = $koneksi->real_escape_string($_POST['username']);
$password = $koneksi->real_escape_string($_POST['password']);

// Cek ke tabel admin (password plain text)
$query = "SELECT id_admin, username, nama_lengkap FROM admin WHERE username = '$username' AND password = '$password'";
$result = $koneksi->query($query);

if ($result && $result->num_rows == 1) {
    $admin = $result->fetch_assoc();
    $_SESSION['admin_id'] = $admin['id_admin'];
    $_SESSION['admin_username'] = $admin['username'];
    $_SESSION['admin_nama'] = $admin['nama_lengkap'];
    
    header("Location: index.php");
    exit;
} else {
    header("Location: login.php?error=1");
    exit;
}
?>