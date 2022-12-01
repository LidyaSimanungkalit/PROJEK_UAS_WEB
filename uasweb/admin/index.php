<?php
  require '..\koneksi.php'; 
  session_start();

  
  if (!isset($_SESSION['username'])) {
      header("Location: ..\login.php");
  }


  $tampil = "SELECT * FROM user ";


  if( isset($_POST["cari"])){
    $nama_dicari = $_POST["keyword"];
    $tampil = "SELECT *FROM user WHERE username     LIKE '%$nama_dicari%' OR
                                          email     LIKE '%$nama_dicari%'";
}

?>  
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6acc3fbd7c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Dashboard</title>
</head>
<html>
<body>
  <nav>
    <ul>
    <li><a href="index.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
    <li><a href="info_user.php"><i class="fa-solid fa-user"></i>   Info User</a></li>
    <li><a href="data_produk.php"><i class="fa-solid fa-box-open"></i> Produk</a></li>
    <li><a href="data_beli.php"><i class="fa-brands fa-google-drive"></i> Data Pembeli</a></li>
    <li><a href="..\logout.php" onclick="return confirm('yakin?')"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
    <li style="float:right"><a href="profil_admin.php" class="active"><?php echo $_SESSION['username']?></a></li> 
    </ul> 
  </nav>
    <p class="info">Dashboard</p>
    <div class="centered">
      <section class="cards">
        <article class="card">
          <h2><i class="fa-solid fa-database"></i> Data User</h2>
          <?php
            $rows = $db->query('SELECT * FROM user'); 
            $jumlah = $rows->num_rows;
          ?>
          <p>Jumlah Data : <?php echo $jumlah ?></p>
        </article>
        <article class="card">
          <h2><i class="fa-solid fa-database"></i> Data Produk</h2>
          <?php
            $rows = $db->query('SELECT * FROM produk'); 
            $jumlah = $rows->num_rows;
          ?>
          <p>Jumlah Data : <?php echo $jumlah ?></p>
        </article>
        <article class="card">
          <h2><i class="fa-solid fa-database"></i> Data Pembelian</h2>
          <?php
            $rows = $db->query('SELECT * FROM pembelian'); 
            $jumlah = $rows->num_rows;
          ?>
          <p>Jumlah Data : <?php echo $jumlah ?></p>
        </article>
      </section>
    </div>

</body>
</html>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');


body{
    font-family: 'Poppins', sans-serif;

}



.cards {
   height: 400px;
   /* display: flex;
   flex-wrap: wrap; */
   justify-content: space-between;
   padding: 25px;

   
}
 
.card {
    flex: 0 1 24%;
    text-align:center;
    height:115px;
  
    background-color: green;
    color:white;
    transition: 0.3s;
    width: 40%;
    border-radius: 5px;
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
  height: 87px;
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
  margin: 35px 69px;
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


