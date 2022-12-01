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
    <title>Profile</title>
    
</head>
<body>
    
</body>
</html>
<table>
    <a href="index.php"><p class="links"><i class="fa-solid fa-angle-left"></i> Kembali</p></a>
    <tr>
         <th colspan="4">Profile Admin</th>
    </tr>
    <tr>
        <th colspan="3">
            <img src="..\img/koboy.gif">
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

<!-- Tampilan CSS -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');


body{
    font-family: 'Poppins', sans-serif;

}
a{
    font-size:22px;
    text-decoration:none;   
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
</style>
