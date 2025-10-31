<?php 
session_start();
// mendapat id produk dari url
$id_produk = $_GET['id'];

//jika sudah ada produk itu keranjang, maka produk itu jumlahnya +1
if(isset($_SESSION['keranjang'][$id_produk]))
{
    $_SESSION['keranjang'][$id_produk]+=1;
}
//selain itu (belum ada di keranjang), maka akan dianggap beli 1
else
{
    $_SESSION['keranjang'][$id_produk] = 1;
}

//larikan ke halaman keranjang
echo "<script>alert('produk telah masuk ke keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?>