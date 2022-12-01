<?php
  require '..\koneksi.php'; 
  session_start();
  
  if (!isset($_SESSION['username'])) {
      header("Location: login.php");}


  $tampil = "SELECT * FROM produk ";


  if( isset($_POST["cari"])){
    $nama_dicari = $_POST["keyword"];
    $tampil = "SELECT *FROM produk WHERE gambar      LIKE '%$nama_dicari%' OR
                                            nama        LIKE '%$nama_dicari%' OR
                                            harga       LIKE '%$nama_dicari%' OR
                                            stok        LIKE '%$nama_dicari%' OR
                                            deskripsi        LIKE '%$nama_dicari%' OR
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
    <a href="add_produk.php"><button class="tambah" ><i class="fa-solid fa-plus"></i> Tambah Data</button></a>
    <p class="info">Data Produk</p>
    <table>
        <tr>
            <th>ID</th>
            <th>Gambar Produk</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Action</th>
        </tr>
        <?php
        // Memanggil file koneksi.php;
        require "..\koneksi.php";
        // Mengambil data dari table;
        $query = $db->query($tampil);
        foreach ($query as $data ){
        ?>
        <tr>
            <td><?php echo $data ['id_produk']?></td>
            <td><img src="../img/<?=$data['gambar']?>" alt="" width="100px"></td>
            <td><?php echo $data ['nama']?></td>
            <td>Rp.<?php echo number_format ($data ['harga'])?></td>
            <td><?php echo $data ['stok']?></td>
            <td><?php echo $data ['deskripsi']?></td>
            <td><?php echo $data ['kategori']?></td>
            <td colspan='2'>
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                      <a class="ubah"  href="ubah_produk.php?id_produk=<?php echo $data ['id_produk']?>" onclick="return confirm('Ingin Mengubah Data?');" role="button">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                    </svg>
                </a>  
                <a class="hapus" href="hapus_produk.php?id_produk=<?php echo $data ['id_produk']?>" onclick="return confirm('Ingin Mengapus Data?');" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                    </svg>
                </a>
            </td>


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
  height:87px;
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


