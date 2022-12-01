<?php
require '..\koneksi.php';
session_start();

$ID = $_SESSION["id_user"];
$select_sql = "SELECT * FROM user WHERE id_user =$ID";
$tampil = $db->query($select_sql);


$KTP = [];

while ($row = mysqli_fetch_assoc($tampil)) {
    $KTP[] = $row;
}



$KTP = $KTP[0];

if (isset($_POST["kirim"])) {
    $username   = htmlspecialchars($_POST['username']);
    $email      = htmlspecialchars($_POST['email']);


    $update_sql = "UPDATE user SET
                   username='$username',
                   email='$email'
                   WHERE id_user =$ID";

    $tampil = mysqli_query($db, $update_sql);

    if ($tampil) {
        echo "<script>
            alert('Data berhasil diupdate!');
            document.location.href = 'profil_user.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diupdate!');
            document.location.href = 'profil_user.php';
        </script>";
    }}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <script src="https://kit.fontawesome.com/6acc3fbd7c.js" crossorigin="anonymous"></script>
    <title>Update Akun</title>


</head>
<body>
<div class="container-ubah" >
        <div class="judul">
            <h2>Ubah Data</h2>
        </div>
        <div class="form" >
            <form  method="post"  autocomplete="off" >
                <div class="ikons">
                    <i class="fa-solid fa-user icon"></i>
                    <input type="text" placeholder="Masukan Username" name="username" value="<?= $KTP["username"] ?>" required>
                </div>
                <div class="ikons">
                    <i class="fa-solid fa-envelope icon"></i> 
                    <input type="text" placeholder="Masukan Email " name="email"  value="<?= $KTP["email"] ?>" required>
                </div>
                <input type="submit" name="kirim" class="submit" value="Update "><br><br>
            </form>
            </p>
        </div>
    </div>
</body>
</html>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

body{
    font-family: 'Poppins', sans-serif;

}

h2{
    font-size:35px;
}
.ikons i{
    background:#87898c;
    position: absolute;
}

.ikons {
    width: 100%;    
    margin-bottom: 10px;
}

.icon {
    padding: 12px;
    margin-top:7px;
    color:white;    
    height:23px;
    /* min-width: -12px; */

}


.logo {
    text-decoration:line-through;
    font-size:22px;
    text-align: center;
    margin-bottom:55px;

}
.container-ubah{
    max-width: 500px;
    margin: auto;
}

  input[type=text], input[type=password] {
  width: 100%;
  padding: 13.5px 20px;
  padding-left:45px;
  margin: 8px 0;
  border: 1px solid #ccc;
  box-sizing: border-box;
  font-size:15px;

}

.submit {
  font-size:18px;
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  border-radius:4px;
}
.regis {
    margin-top:-21px;
    float:right;
}
.regis a{
    text-decoration:none;

}
</style>
