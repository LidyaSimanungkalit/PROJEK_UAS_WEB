<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/"> -->
    <script src="https://kit.fontawesome.com/6acc3fbd7c.js" crossorigin="anonymous"></script>
    <title>Login Form</title>



    
    <!-- Custom styles for this template -->
    <!-- <link href="signin.css" rel="stylesheet"> -->
</head>
<body class="text-center">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- <div class="container-login">
        <div class="judul">
        <h2>Login</h2>
        </div>
        <div class="form-login">
            <form action="" method="POST"  autocomplete="off">
                <div class="ikons">
                    <i class="fa-solid fa-user icon"></i>
                    <input class="input-field" type="text" name="username" placeholder="Masukan Username Anda" class="input" required>
                </div>
                <div class="ikons">
                <i class="fa-solid fa-lock icon"></i>
                    <input class="input-field" type="password" id="password" name="password" placeholder="Masukan Password Anda" class="input" required>
                    <span class="show-hide">
                    <i id="mata" class="fa fa-eye"></i>
                </span>
                </div>
                <input type="submit" name="login" value="Masuk  " class="submit"><br><br>
            </form>
            <p class="regis">Belum punya akun? <i class="fa-solid fa-arrow-right"></i>
                <a href="register.php">Daftar?</a>
            </p>
        </div>
    </div>
    <script src= "js/slide.js"></script> -->
    <div class="container">
    <main class="form-signin w-100 m-auto">
  <form action="" method="POST"  autocomplete="off">
    <img class="mb-4" src="img/logoo.png" alt="" width="90" height="90">
    <h1 class="h3 mb-3 fw-normal">Login</h1>

    <div class="form-floating">
      <input type="text"  name="username" class="form-control" id="floatingInput" placeholder="name@example.com"  required>
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control"  id="password" name="password"  placeholder="Password"  required>
      <label for="Password">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Ingat Saya
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit"   name="login" >Login</button>
    </form>
    <p class="regis">Belum punya akun? <i class="fa-solid fa-arrow-right"></i>
    <a href="register.php">Daftar?</a>
     </p>
    </main>
    </div>
</body>
</html>
<?php 
require 'koneksi.php';
session_start();

if (isset($_SESSION['login'])) {
    header("Location: admin/index.php");
}


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM user WHERE username='$username' AND psw='$password'";
    $result = mysqli_query($db, $sql);
    if ($result->num_rows > 0) {    
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['pelanggan'] = $row;
        if($username == "admin"){        
            echo "<script>
            alert('Welcome @$username!');
            document.location.href = 'admin/index.php';
          </script>";}
        echo "<script>
                alert('Login berhasil! @$username');
                document.location.href = 'user/index.php';
              </script>";
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}
?>
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

.show-hide{
    position: absolute;
    right:430px;
    bottom:366px;
    font-size:18px;
}
.show-hide i{
    background-color: #ffffff;
    cursor: pointer;
    display: none;
}
.show-hide i.hide:before{
    content: '\f070';
}

#password:valid ~ .show-hide i{
    display: block;
}
.logo {
    text-decoration:line-through;
    font-size:22px;
    text-align: center;
    margin-bottom:55px;

}
.container-login{
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
    margin-top:30px;
    /* float:right; */
    text-align: center;
}
.regis a{
    text-decoration:none;

}

@media (max-width: 430px) {
    .container-login {
    width: 300px;
    }
}
@media (max-width: 638px) {
    .show-hide{
    position: absolute;
    right:60px;
    bottom:297px;
    font-size:18px;
    }
}
/* boostrap */


</style>
