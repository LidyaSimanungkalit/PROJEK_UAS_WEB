<?php
  require '..\koneksi.php'; 
  session_start();
  
  if (!isset($_SESSION['username'])) {
      header("Location: login.php");}


  $tampil = "SELECT * FROM user ";


  if( isset($_POST["cari"])){
    $nama_dicari = $_POST["keyword"];
    $tampil = "SELECT *FROM user WHERE username  LIKE '%$nama_dicari%' OR
                                          email     LIKE '%$nama_dicari%' OR
                                          id_user   LIKE  '%$nama_dicari%'";
}
?>  
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6acc3fbd7c.js" crossorigin="anonymous"></script>
    <title>Data User</title>
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
    <p class="info">Data Akun</p>
    <table>
        <tr>
            <th>ID User</th>
            <th>Username</th>
            <th>Email</th>
            <th>Tanggal Buat Akun</th>
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
            <td><?php echo $data ['id_user']?></td>
            <td><?php echo $data ['username']?></td>
            <td><?php echo $data ['email']?></td>
            <td><?php echo $data ['tgl']?></td>
            <td>
              <a href="hapus_user.php?id_user=<?php echo $data ['id_user']?>">
              <i class="fa-solid fa-trash"></i></a>
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
  height:87;
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


