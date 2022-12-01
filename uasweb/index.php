<?php
  require 'koneksi.php'; 
  session_start();

  $tampil  = "SELECT * FROM produk ";
  $hasi    = mysqli_query($db, $tampil);
  $jumlah  = mysqli_num_rows($hasi);
 

  $tampil  = "SELECT * FROM produk ";
  if( isset($_POST["cari"])){
    $nama_dicari = $_POST["keyword"];
    $tampil = "SELECT *FROM produk WHERE gambar         LIKE '%$nama_dicari%' OR
                                            nama        LIKE '%$nama_dicari%' OR
                                            harga       LIKE '%$nama_dicari%' OR
                                            stok        LIKE '%$nama_dicari%' OR
                                            deskripsi   LIKE '%$nama_dicari%' OR
                                            kategori    LIKE '%$nama_dicari%' OR
                                            id_produk   LIKE  '%$nama_dicari%'";
}

if( isset($_POST["car"])){
  $nama_dicari = $_POST["keyword"];
  $select_sql = "SELECT tb_pembelian.id_pembelian ,tb_pembelian.tanggal, 
                tb_produk.gambar, tb_user.username,tb_pembelian.jumlah, tb_pembelian.harga,
                tb_produk.desk,tb_produk.kategori FROM tb_pembelian
                INNER JOIN tb_user on tb_pembelian.id_user = tb_user.id_user
                INNER JOIN tb_produk on tb_pembelian.id_produk = tb_produk.id_produk
                WHERE (id_pembelian       LIKE '%$nama_dicari%' OR
                      jumlah       LIKE '%$nama_dicari%' OR
                      tanggal       LIKE '%$nama_dicari%' OR
                      harga         LIKE '%$nama_dicari%' OR
                      desk          LIKE '%$nama_dicari%' OR 
                      kategori      LIKE '%$nama_dicari%')";}
  
 ?>  
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6acc3fbd7c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <title>Produk</title>
</head>
<html>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<section id="home">
  <nav>
    <ul>
        <?php if(isset($_SESSION['username'])){
        }if(@$_SESSION['username']){
            echo "<li><a href='logout.php'>Logout</a></li>";
        }
    else {
      echo "<li><a href='login.php'>Login</a></li>";
    }
    ?>
    <li><a href="login.php">Keranjang</a></li>
    <li><a href="#about">About</a></li>
    <li><a href="#home">Home</a></li>
    <img src="img/logoo.png" alt="kueLogo" class="logo" width ="150px"> 
    </ul> 
  </nav>
  <div class ="header2">
     <div class="header-logo2"> Cari sesuai dengan keinginan anda </div>
       
      <form METHOD="POST" >
        <input class="srch" type="text" name="keyword"  placeholder="Masukan Keyword . . . .">
        <button  class="create" type="submit" name="cari"><i class="fas fa-search"></i> Cari Kata</button>
      </form>
    
      </div>
    <p class="info">Produk</p>

   

    <?php 
      $halperpage = 5; //jumlah per item per halaman
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $sebelum = $page-1;
      $setelah = $page+1;
      $mulai = ($page>1) ? ($page * $halperpage) - $halperpage : 0;
      $tampil  = "SELECT * FROM produk ";
      $hasi    = mysqli_query($db, $tampil);
      $jumlah  = mysqli_num_rows($hasi);
      $pages = ceil($jumlah/$halperpage);            
      $hasi = mysqli_query($db,"SELECT * FROM produk LIMIT $mulai, $halperpage");
      $no = $mulai+1;
    ?>
 
    <div class="container-card">
      <?php
      if($jumlah > 0){
        while($row = mysqli_fetch_assoc($hasi)){
      ?>
         <div class="card">
            <img src="img/<?=$row['gambar']?>" alt="gambar_produk" width="200px" class="gbrkue">
            <h5><?= $row['kategori'] ?></h5>
            <p class="price">Rp.<?= $row['harga']?></p>
            <p><?= $row['nama']?></p>
            <a href="login.php"class="masukan"><i class="fa-solid fa-cart-plus"></i></a>
            <a href="login.php"><button class="cekout">Beli</button></a>
        </div>
      <?php
          }
      }
      ?>

    </div>
    <div class="next">
      <ul class="pagination">
        <li class="page-item">
          <a class="page-link" <?php if($page > 1){ echo "href='?page=$sebelum'"; } ?>>Previous</a>
        </li>
        <?php 
          for($i=1; $i<=$pages; $i++){
        ?> 
        <li class="page-item"><a class="page-link" href="?page=<?php echo $i ?>"> <?php echo $i; ?></a></li>
        <?php
          }
        ?> 
        <li class="page-item">
          <a  class="page-link" <?php  if($page < $pages) { echo "href='?page=$setelah'"; } ?>>Next</a>
        </li>
      </ul>
    </div>

<footer class=" footer">
<section id="about">
      <div class ="footer-container">
      <div class="row">
        <div class ="footer-nav-section" >
        <h4 class ="heading">Tentang Kue Tradisional</h4>
          <ul class="items">
            <li class="item"><a href="#">Tentang Kami</a></li> 
            <li class="item"><a href="#"> Daftar Kue Tradisional </a></li> 
            <li class="item"><a href="#"> Outlet Cabang </a></li> 
            <li class="item"><a href="#"> Paket Catering</a></li> 
            <li class="item"><a href="#"> Diskon</a></li>
            <li class="item"> <a href="#"> Layanan Kami </a></li> 
          </ul>
      </div>
        <div class=" footer-nav-section">
        <h4 class ="heading"> User Service</h4>
          <ul class =" items">  
            <li class="item" > <a href="#">FAQ(Frequently Asked Question</a></li>  
            <li class="item"> <a href="#">Konfirmasi Pembayaran</a></li> 
            <li class="item"> <a href="#">Transaksi</a></li> 
            <li class="item"> <a href="#"> Panduan Transaksi</a></li> 
            <li class="item"><a href="#">Konfirmasi Keluhan</a></li> 
          </ul>
        </div>
        <div class="footer-nav-section">
          <div class="media">
          <h4 class ="heading">Hubungi Kami</h4>
            <ul class="media-items">
              <li><a href="https://wa.me/6281254424739"><i class="fa1 fas fa-phone"></i> Contact</a></li>
              <li><a href="https://twitter.com/Cnoxerr12345"><i class="fa1 fa-brands fa-twitter"></i> Twiter</a></li>
              <li><a href="https://www.instagram.com/ash4rr/"><i class="fa1 fa-brands fa-instagram"></i> Instagram</a></li>
            </ul>
        </div>
      </div>
    </div>
    </div>
  </section>
  </footer>
</section>
</body>
</html>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Cormorant:wght@700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700;900&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600&display=swap');

*{
    margin: 0;
    padding: 0;
}
body{
    font-family: 'Poppins', sans-serif;

}

.logo{
    margin-top: 15px;
    margin-left:6px;
}
nav{
  height:200px;
  background-image: linear-gradient(to bottom, #E0FFFF,#E6E6FA );
  border-bottom: 50px linear-gradient(to left , #A0F1EA,#EAD6EE);
}
 nav ul {
  list-style-type: none;
  margin: 0;
  font-size:20px;
  overflow: hidden;
  height: 150px;
  font-family: 'Nunito', sans-serif;
  padding : 33px 20px;
  padding-left:10px;
  

}
ul li a:hover{
    color: #145ba3;
    padding-left:10px;
  }

nav ul li {
  float: right;
}

nav ul li a {
  display: block;
  color:black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}



.header2{

   background-image: linear-gradient(to left,#FFF0F5,#E0FFFF);
   height: 50px;
  }
/* tulisan header2 */
.header-logo2{
    font-family: 'Nunito', sans-serif;
    font-size:20px;
    float: left;
    height : 30px;
    padding: 10px 30px;
    color:black;
    color:#505091;
  font-family: 'Cormorant', serif;
}

   /* form searching */
.srch{ 
  
   border: 1px;
   display: inline-block;
   width: 40%; 
   height:30%; 
   margin-top: 30px;color:white; 
  color: black;
  text-align: center;
  padding :10px;
  display: inline-block;
  font-size: 16px;
  border-radius:10px;

}
.create{
  margin-left:80px;
  color:white;
  background-color: #4CAF50; 
  border: 4px;
  color: white;
  text-align: center;
  text-decoration: none;
  padding :5px;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
  border-radius:10px;
}
.placholder{
   border: 1px solid rgb(8, 208, 172);

}

.container-card{
  display: flex;
  flex-wrap: wrap;
  padding:5px;
  
}
.card {
  flex: 0 1 24%;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  margin-bottom:35px;
  text-align: center;
  border-radius: 100 px;
 
}
.gbrkue{
  margin-left:70px;
  margin-top:15px;
  margin-bottom:5px;
}
.price {
  color: grey;
  font-size: 22px;
}
.masukan {  
  border: none;
  outline: 0;
  padding: 10px;
  margin-top: 3px;
  color: white;
  background-color: #145ba3;
  cursor: pointer;
  width: 20%;
  margin-left: 135px;
  margin-top:10px;
  border-radius: 5px;
  font-size: 18px;
}

.cekout {  
  border: none;
  outline: 0;
  padding: 10px;
  color: white;
  background-color: #fb8c00;
  text-align: center;
  cursor: pointer;
  width: 20%;
  height:45px;
  margin-left: 30px;
  margin-bottom:15px;
  font-size: 18px;
  border-radius: 5px;
}

input[type=text] {
  margin-right:-65px;
  padding: 3.5px;
  margin-top: 8px;
  font-size: 15px;
  font-family: 'Poppins', sans-serif;


  
}

.info{
  color:#505091;
  font-size:22px;
  padding-left:22px;
  margin-top:50px;
  font-family: 'Cormorant', serif;
  font-size:50px;
  border-bottom: 2px solid #dee7ec;

  
}

table {
  border-collapse: collapse;
  width: 90%;
  margin: auto;}

th, td {
  text-align: left;
  padding: 8px;
  border-bottom:1px solid #cad1db;

}

th {
  background-color: #242020;
  color: white;
}
.footer{
  /* background-image: linear-gradient(to bottom, #E0FFFF,#E6E6FA ); */
  color: black;
  padding:50px 30px;
  border-top: 50px solid #dee7ec;
  
}
.footer-container{
  color:black;
  max-width:1170px;
  margin:auto;

}
.row{
  display: flex;
  flex:wrap;
}
.footer ul{
  list-style:none;
}
.footer-nav-section{
  width: 25%;
  padding: 0 25px;
}
.footer-nav-section h4{
  color:black;
  font-size: 18px;
  text-transform: capitalize;
  margin-bottom:15px;
  font-family: 'Poppins', sans-serif;
  font-style: bold;
}
.footer-nav-section ul li:not(:last-child){
  margin-bottom:10px;
}
.footer-nav-section ul li a{
  font-size:16px;
  text-decoration:none;
  color: #000000;
  font-weight:300;
  color:#bbbb;
  display:block;
}
.footer-nav-section ul li a:hover{
  color: #000000;
  padding-right:10px;
}
</style>