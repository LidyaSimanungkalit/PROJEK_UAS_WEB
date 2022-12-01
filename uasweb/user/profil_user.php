<?php 
require '..\koneksi.php'; 
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ..\login.php");}

$US = $_SESSION['id_user'];

$select_sql = "SELECT * FROM user WHERE id_user = $US";
$tampil = @$db->query($select_sql);
$result = mysqli_query($db, $select_sql);

$KTP = [];  

while ($row = mysqli_fetch_assoc($result)) {
    $KTP[] = $row;
}
    $KTP = $KTP[0];
    $username        = $KTP["username"];
    $email           = $KTP["email"];
    $tanggal         = $KTP["tgl"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6acc3fbd7c.js" crossorigin="anonymous"></script>
    <title>PROFIL</title>
</head>
<body>
</body>
</html>
<table>
    <div class="links">
        <a href="..\logout.php"  onclick="return confirm('yakin?')"><p class="keluar"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</p></a>
        <a href="index.php"><p class="balik"><i class="fa-solid fa-angle-left"></i> Kembali</p></a>
    </div>

    <tr>
        <th colspan="4">Profile User</th>
    </tr>
    <tr>
        <th colspan="3">
            <img src="..\img/poto.jpg" height=206px width=300px>
        </th>
    </tr>
    <tr>
        <td>Username </td>
        <td> : </td>
        <td><?php echo $username?></td>
    </tr>
    <tr>
        <td>Email </td>
        <td> : </td>
        <td><?php echo $email   ?></td>
    </tr>
    <tr>
        <td>Tanggal Buat Akun </td>
        <td> : </td>
        <td><?php echo $tanggal?></td>
    </tr>
</table>
<a href="bukun.php"  onclick="return confirm('yakin?')"><button class="ubah"><i class="fa-solid fa-file-pen"></i> Ubah Data</button></a>
<a href="histori.php"><button class="histori"><i class="fa-solid fa-notes-medical"></i> Histori Beli</button></a>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');


body{
font-family: 'Poppins', sans-serif;
max-height:10000;

}


.links a{
text-decoration:none;
}

.keluar{
float:right;
font-size:22px;
margin-top:-4.5px;
}

.ubah{
margin-right:45px;
}

.balik{
font-size:22px;
}
table {
border-collapse: collapse;
width: 55%;
margin: auto;
}

td {
text-align: left;
padding: 8px;
border-bottom:1px solid #cad1db;
}

th {
font-size:22px;
}

.ubah{
background-color: #4CAF50; 
border: 4px;
color: white;
padding: 12px 17px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin-left:305px;
margin-top:25px;
cursor: pointer;
}

.histori{
background-color: #254ea1; 
border: 4px;
color: white;
padding: 12px 17px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin-left:-34px;
margin-top:25px;
cursor: pointer;
}

@media (min-width: 627px) {
.keluar{
padding-right: 82px;
font-size:22px;
margin-top:-4.5px;
}
}

@media (min-width: 1021px) {
.keluar{
padding-right:17px;
font-size:22px;
margin-top:-4.5px;
}
}

@media (min-width: 528px) {
.ubah{
background-color: #4CAF50; 
border: 4px;
color: white;
padding: 12px 17px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin-left:105px;
margin-top:25px;
cursor: pointer;
}
}
@media (min-width: 495px) {
.ubah{
background-color: #4CAF50; 
border: 4px;
color: white;
padding: 12px 17px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin-left:90px;
margin-top:25px;
cursor: pointer;
}
}
@media (min-width: 1021px) {
.ubah{
background-color: #4CAF50; 
border: 4px;
color: white;
padding: 12px 17px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin-left:220px;
margin-top:25px;
cursor: pointer;
}
}

@media (min-width: 1010px) {
.ubah{
background-color: #4CAF50; 
border: 4px;
color: white;
padding: 12px 17px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin-left:220px;
margin-top:25px;
cursor: pointer;
}
}
@media (min-width: 1001px) {
.ubah{
background-color: #4CAF50; 
border: 4px;
color: white;
padding: 12px 17px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin-left:220px;
margin-top:25px;
cursor: pointer;
}
.keluar{
padding-right:17px;
font-size:22px;
margin-top:-4.5px;
}
}

@media (min-width: 1010px) {
.ubah{
background-color: #4CAF50; 
border: 4px;
color: white;
padding: 12px 17px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin-left:301px;
margin-top:25px;
cursor: pointer;
}
}
/* @media (min-width: 1187px) {
.ubah{
background-color: #4CAF50; 
border: 4px;
color: white;
padding: 12px 17px;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
margin-left:261px;
margin-top:25px;
cursor: pointer;
}
.keluar{
padding-right:17px;
font-size:22px;
margin-top:-4.5px;
}
} */

</style>
