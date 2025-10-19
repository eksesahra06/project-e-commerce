<h2>Data Produk</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Berat</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$koneksi->query("SELECT * FROM produk"); ?>
        <?php while($pecah = $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_produk']; ?></td>
            <td><?php echo $pecah['harga_produk']; ?></td>
            <td><?php echo $pecah['berat_produk']; ?></td>
            <td><?php echo $pecah['foto_produk']; ?></td>
            <td>
                <a href="" class="btn-danger btn">hapus</a>
                <a href="" class="btn-warning btn">ubah</a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>