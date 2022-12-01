<?php
session_start();


if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])){
    echo "<script> alert('keranjang masih kosong');</script>";
    echo "<script> location='index.php'; </script>"; 
}
require '..\koneksi.php';
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6acc3fbd7c.js" crossorigin="anonymous"></script>
    <title>CheckOut</title>

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
            <th>Sub Harga</th>
        </tr>
        <?php $total = 0;?>
        <?php foreach($_SESSION['keranjang'] as $id_produk => $jumlah){?>
            <!-- Menampilkan Data Produk -->
            <?php
            $tampil = $db->query("SELECT * FROM produk
                                WHERE id_produk ='$id_produk'");
            $data =   $tampil->fetch_assoc();
            $subharga = $data['harga'] * $jumlah;
            ?>
            <tr>
                <td><img src="../img/<?=$data['gambar']?>" alt="" width="160px"></td>
                <td>Rp.<?php echo number_format ($data ['harga'])?></td>
                <td><?php echo $data ['deskripsi']?></td>
                <td><?php echo $data ['kategori']?></td>
                <td><?php echo $jumlah?></td>
                <td>Rp.<?php echo number_format ($subharga)?></td>
            </tr>
            <?php 
            @$jumlah_total += $jumlah;
            $total+=$subharga; 
            } 
            ?>	
            <tfoot>
                <tr>
                    <td colspan="4"><b>Total Harga : </b></td>
                    <td><?php echo $jumlah_total ?></td>
                    <td><b>Rp.<?php echo number_format($total)?></b></td>
                </tr>   
            </tfoot>
            <tfoot>
            <tr>
                <td colspan="6">Nama  : <?php echo $_SESSION['pelanggan']['username'] ?></td>
            </tr>
            <tr>
                <td colspan="6">Email : <?php echo $_SESSION['pelanggan']['email'] ?></td>
            </tr>
            </tfoot>
    </table>   
    <form action="" method="post">
        <select name="id_ongkir">
            <option disabled selected>Ongkir </option>
            <?php 
            $tampil = $db->query("SELECT * FROM ongkir");
            while($ongkir = $tampil->fetch_assoc()){
                ?>
            <option value="<?php echo $ongkir['id_ongkir']?>">
                <?php echo $ongkir['nama_kota']?> - 
                Rp.<?php echo number_format($ongkir['tarif'])?> 
            </option>
            <?php } ?>  
        </select>
        <button class="cekout" name="chekout"><i class="fa-solid fa-dolly"></i> Buat Pesanan</button>
    </form>
    <a href="keranjang.php"><button class="kembali"><i class="fa-solid fa-arrow-left"></i> Kembali</button></a>

    <?php
    if(isset($_POST['chekout'])){
        $id_user   = $_SESSION['pelanggan']['id_user'];
        $id_ongkir = $_POST['id_ongkir'];
        $tanggal   = date("Y-m-d");

        $tampil = $db->query("SELECT * FROM produk
                         WHERE id_produk ='$id_produk'");
        $data =   $tampil->fetch_assoc();

        $tampil = $db->query("SELECT * FROM ongkir WHERE
                    id_ongkir = '$id_ongkir'");

        $result     = $tampil->fetch_assoc();
        $tarif      = $result['tarif'];
        $total_beli =  $total+$tarif;

        $db->query("INSERT INTO pembelian(
                    id_user,id_produk,id_ongkir,jumlah,tanggal,harga)
                    VALUES('$id_user','$id_produk', '$id_ongkir','$jumlah_total','$tanggal','$total_beli')");

        unset($_SESSION['keranjang']);
         if($db){
            echo "<script>alert('pembelian berhasil :)');</script>";
            echo "<script>location='index.php';</script>";
        }else{
            echo "<script>alert('pembelian gagal :(');</script>";
            echo "<script>location='index.php';</script>";
        }

      
    }
    ?>
    
    <pre><?php print_r($_SESSION['pelanggan'])?></pre>
    <pre><?php print_r($_SESSION['keranjang'])?></pre>
    
</body>
</html>

<style>

*{
    margin: 0;
    padding: 0;
}
select{
    width: 40px;
    padding: 10px 15px;
    border: 1px solid #3d3c3c;
    outline:none;
    background:none;
    color:black;
    border-radius: 2px;
    
}
select{
    margin-left:70px;
    margin-bottom:25px;
	width: 200px;
	padding: 12px 15px;
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
    margin-bottom:px;
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

.hapus{
    background-color: #de2a2a; 
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
