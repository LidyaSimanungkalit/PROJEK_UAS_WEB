<?php
  require '..\koneksi.php'; 
  session_start();
  


  $id_user = $_SESSION['pelanggan']['id_user'];
  
  $data = $db->query("SELECT pembelian.id_pembelian ,pembelian.tanggal, 
                    produk.gambar, user.username,pembelian.jumlah, pembelian.harga,
                    produk.deskripsi,produk.kategori FROM pembelian
                    LEFT JOIN user on pembelian.id_user = user.id_user
                    LEFT JOIN produk on pembelian.id_produk = produk.id_produk
                    WHERE pembelian.id_user = '$id_user ' ");

?>  
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6acc3fbd7c.js" crossorigin="anonymous"></script>
    <title>Histori Pembelian</title>
</head>
<html>
<body>


    <div class="tombol">
      <form    METHOD="POST" >
        <input type="text" name="keyword" style="height: 30px;" placeholder="Masukan Keyword .   . . . ">
        <button  class="create" type="submit" name="cari"><i class="fas fa-search"></i> Cari Kata</button>
      </form>
    </div>
    <p class="info">Data Produk</p>
    <!-- <pre><?php print_r($_SESSION['pelanggan'])?></pre> -->

    <table>
        <tr>
              <th>NoBeli</th>
              <th>Gambar</th>
              <th>Username</th>
              <th>Jumlah</th>
              <th>Harga</th>  
              <th>Tanggal</th>
              <th>Deskripsi</th>  
              <th>Kategori</th>
        </tr>
        <?php foreach ($data as $hasil) { ?>
        <tr>
          <td><?php echo $hasil ['id_pembelian']?></td>
            <td><img src="../img/<?=$hasil['gambar']?>" alt="" width="100px"></td>
            <td><?php echo $hasil ['username']?></td>
            <td><?php echo $hasil ['jumlah']?></td>
            <td>Rp.<?php echo number_format ($hasil ['harga'])?></td>
            <td><?php echo $hasil ['tanggal']?></td>
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
  background-color: #333;
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
    padding-left:97px;
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
  background-color: #242020;
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


