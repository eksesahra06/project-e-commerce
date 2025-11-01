<?php
session_start();

//mengahancurkan session pelanggan
session_destroy();

echo "<script>alert('anda sudah logout');</script>";
echo "<script>location='index.php';</script>";
?>