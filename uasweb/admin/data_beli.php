<?php
  require '..\koneksi.php'; 
  session_start();
  
  if (!isset($_SESSION['username'])) {
    header("Location: ..\login.php");}



  if( isset($_POST["cari"])){
    $nama_dicari = $_POST["keyword"];
    $tampil = "SELECT *FROM produk WHERE gambar      LIKE '%$nama_dicari%' OR
                                            nama        LIKE '%$nama_dicari%' OR
                                            harga       LIKE '%$nama_dicari%' OR
                                            stok        LIKE '%$nama_dicari%' OR
                                            deskripsi   LIKE '%$nama_dicari%' OR
                                            kategori    LIKE '%$nama_dicari%' OR
                                            id_produk   LIKE  '%$nama_dicari%'";
}
?>  
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6acc3fbd7c.js" crossorigin="anonymous"></script>
    <title>Data Produk</title>
</head>
<html>
<body>

    <nav>
        <ul>
        <li><a href="index.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
        <li><a href="info_user.php"><i class="fa-solid fa-user"></i> Info User</a></li>
        <li><a href="data_produk.php"><i class="fa-solid fa-box-open"></i> Produk</a></li>
        <li><a href="data_beli.php"><i class="fa-brands fa-google-drive"></i> Data Pembeli</a></li>
        <li><a href="..\logout.php" onclick="return confirm('yakin?')"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
        <li style="float:right"><a href="profil_admin.php" class="active"><?php echo $_SESSION['username']?></a></li> 
        </ul> 
   </nav>
    <div class="tombol">
      <form    METHOD="POST" >
        <input type="text" name="keyword" style="height: 30px;" placeholder="Masukan Keyword .   . . . ">
        <button  class="create" type="submit" name="cari"><i class="fas fa-search"></i> Cari Kata</button>
      </form>
    </div>
    <!-- <a href="add_produk.php"><button class="tambah" ><i class="fa-solid fa-plus"></i> Tambah Data</button></a> -->
    <p class="info">Data Produk</p>
    <table>
        <tr>
            <th>Gambar</th>
            <th>Username</th>
            <th>Jumlah</th>
            <th>Harga</th>  
            <th>Deskripsi</th>  
            <th>Kategori</th>
        </tr>
        <?php
        $data = $db->query("SELECT produk.gambar, user.username,
                        pembelian.jumlah, pembelian.harga, produk.deskripsi,
                        produk.kategori FROM pembelian
                        LEFT JOIN user on pembelian.id_user = user.id_user
                        LEFT JOIN produk on pembelian.id_produk = produk.id_produk
                        ");
        while($hasil = $data->fetch_array()){
        ?>
        <tr>
            <td><img src="../img/<?=$hasil['gambar']?>" alt="" width="100px"></td>
            <td><?php echo $hasil ['username']?></td>
            <td><?php echo $hasil ['jumlah']?></td>
            <td>Rp.<?php echo number_format ($hasil ['harga'])?></td>
            <td><?php echo $hasil ['deskripsi']?></td>
            <td><?php echo $hasil ['kategori']?></td>


        </tr>
        <?php
        }
        ?>	
    </table>

</body>
</html>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');


body{
    font-family: 'Poppins', sans-serif;

}



input[type=text] {
  margin-right:-65px;
  padding: 3.5px;
  margin-top: 8px;
  font-size: 15px;
  font-family: 'Poppins', sans-serif;


}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: green;
  height:100px;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  cursor:pointer;
  background-color: #04AA6D;
}

.tombol{
  float:right;
}
* {
    margin: 0;
    padding: 0;
}
button{
  background-color: #4CAF50; 
  border: 4px;
  color: white;
  padding: 12px 17px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 35px 69px 0 75px;
  cursor: pointer;

}

.info{
    color:black;
    font-size:22px;
    padding-left:67px;
    margin-top:100px;
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
  background-color: green;
  color: white;
}

.ubah{
    height:24px;
    width:24px;
    text-decoration: none;
    color:green;
}
.hapus{
  text-decoration: none;
  color:red;
}

.jumlahdata{
    text-align:center;
}
</style>


