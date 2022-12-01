<?php
session_start();


if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])){
    echo "<script> alert('keranjang masih kosong');</script>";
    echo "<script> location='index.php'; </script>"; 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6acc3fbd7c.js" crossorigin="anonymous"></script>
    <title>Keranjang Pembelian</title>
    
</head>
<body>
<p class="info">Data Produk</p>

    <table>
        <tr>
            <th>Gambar Produk</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Opsi</th>
        </tr>
        <?php foreach($_SESSION['keranjang'] as $id_produk => $jumlah){?>
            <!-- Menampilkan Data Produk -->
            <?php
            require '..\koneksi.php';
            $tampil = $db->query("SELECT * FROM produk
                                WHERE id_produk ='$id_produk'");
            $data =   $tampil->fetch_assoc();
            $total = $data['harga'] * $jumlah;
            ?>
            <tr>
                <td><img src="../img/<?=$data['gambar']?>" alt="" width="160px"></td>
                <td>Rp.<?php echo number_format ($data ['harga'])?></td>
                <td><?php echo $data ['deskripsi']?></td>
                <td><?php echo $data ['kategori']?></td>
                <td><?php echo $jumlah?></td>
                <td>Rp.<?php echo number_format ($total)?></td>
                <td>
                    <a href="hapus_produk.php?id_produk=<?php echo $id_produk ?>">
                    <i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php } ?>	
    </table>    

    <a href="index.php"><button class="kembali"><i class="fa-solid fa-arrow-left"></i> Kembali</button></a>
    <a href="cekout.php" onclick="return confirm('Yakin?')"><button class="cekout"><i class="fa-solid fa-basket-shopping"></i> CheckOut</button></a>


    <!-- <pre><?php print_r($_SESSION['pelanggan'])?></pre> -->
    
</body>
</html>

<style>

*{
    margin: 0;
    padding: 0;
}

.info{
    color:black;
    font-size:22px;
    padding-left:67px;
    margin-top:50px;
}
table {
    border-collapse: collapse;
    width: 90%;
    margin: auto;
}

th, td {
    text-align: left;
    padding: 8px;
    border-bottom:1px solid #cad1db;

}

th {
    background-color: #242020;
    color: white;
}

.kembali{
    background-color: #f2f0f0; 
    border: none;
    color: black;
    padding: 12px 17px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-left:68px;
    margin-top:25px;
    cursor: pointer;

}

.cekout{
    background-color: #4CAF50; 
    border: 4px;
    color: white;
    padding: 12px 17px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-left:12px;
    margin-top:25px;
    cursor: pointer;
}

</style>
