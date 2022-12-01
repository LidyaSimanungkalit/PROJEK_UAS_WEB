<?php
// Memamnggil file koneksi.php;
require '..\koneksi.php';
	
    // Mengambail nilai maximum dari id as = ALiAS maxKode;
    // Membuat id automatis;
	$tampil = "SELECT max(id_produk) as maxKode FROM produk";
	$query = $db->query($tampil);



    if(isset($_POST['simpan'])){
        $id          = $kos; 
        $nama        = $_POST['nama'];
        $harga       = $_POST['harga'];
        $stok        = $_POST['stok'];
        $deskripsi   = $_POST['deskripsi'];
        $kategori    = $_POST['kategori'];
        // $gambar             = $_POST['gambar'];
        
        $gambar = $_FILES['foto']['name'];
        // $x = explode( $gambar);
        // $ekstensi = strtolower(end($x));

        $gambar_baru = "$gambar";
        $tmp = $_FILES['foto']['tmp_name'];

        if(move_uploaded_file($tmp, '..\img/'.$gambar_baru)){
            $query = "INSERT INTO produk (id_produk, gambar, nama, harga, stok, deskripsi, kategori)
                                  VALUES ('','$gambar_baru','$nama', '$harga', '$stok',
                                          '$deskripsi','$kategori')";
            $result = $db->query($query);

            if($result){
                header("Location:data_produk.php");
            }else{

                echo "gagal kirim";
            }
        }
        
    if ($query)
        echo "<span class=berhasil>Data Barang Berhasil Di Tambah,<a href=about.php>Lihat Data</a></span>";
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6acc3fbd7c.js" crossorigin="anonymous"></script>
    <title>Form Data Akun</title>

</head>
<body>
    <div class="form">  
    <p class="asa" >Dessert Store</p>
    <form  method="POST" enctype="multipart/form-data" autocomplete="off">
        <table border = "0">
            <tr>
                <td>Nama Makanan</td>
                <td>    
                    <input type="text" name="nama" placeholder="Nama Barang" required>
                </td>
            </tr>
            <tr>    
                <td>Harga</td>
                <td>
                    <input type="text" name="harga" placeholder="Harga" required>
                </td>
            </tr>
            <tr>
                <td>Stok</td>
                <td>
                    <input type="text" name="stok" placeholder="Stok" required>
                </td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td>
                <input type="text" name="deskripsi" placeholder="Deskripsi" required>
            </td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td>
                <select class="choose" name="kategori" >
                    <option disabled selected>Kategori</option>
                    <option value="Kue-Tradisional">Kue Tradisional</option>
                    <option value="Minuman_Tradisional">Minuman Tradisional</option>
                </select>
                </td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td>
                <input type="file"  name="foto" required >
                </td>
            </tr>
            <tr class= "tombol">
                <td colspan="2">
                    <button type="submit" name="simpan"><i class="fa fa-check-circle"></i>  Simpan Data</button>
                    <a href="data_produk.php" class="kembali"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
			    </td>
            </tr>   
    </table>
    </form>     
    </div>
</body>
</html>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');


body{
    font-family: 'Poppins', sans-serif;
    background-color: white;
    

}
.form{
 	width: 1106px;
 	position: fixed;
 	margin-left: 142px;
	top: 122px;
	color: black;
}
.tombol{
    text-align:center;
}


.asa{
    text-decoration:line-through;
    color: white;
    font-weight: 700;
	text-align: center;
    margin-top: 14px;
    font-size: 22px;

}

table{
    border-collapse : collapse;
    margin-left: 20px;
    margin-top: 20px;
    font-size: 14px;
    width: 759px;
    margin: 2% auto;
}
table td{
    padding: 5px 5px;
}

input, select, textarea{
    width: 500px;
    padding: 10px 15px;
    border: 1px solid #3d3c3c;
    outline:none;
    background:none;
    color: white    ;
    border-radius: 2px;
}
select{
	width: 533px;
	padding: 12px 15px;
    background-color:#26282b;
}
input:focus,textarea:focus{
    border: 1px solid #f2af13;
    box-shadow: 0 0 5px #43c3ef;
    transition: 0.3s;
}
.berhasil{
    text-decoration:none;
    background: #5cb85c;
    padding: 10px 20px;
    color: #fff;
    margin-top: 45px;
    font-weight: bold;
    position: absolute;
    margin-left: 581px;
    font-size: 12px;
    border-radius: 2px;
}
button{
	outline: none;
	border: 1px solid #25476a;
	padding: 10px 20px;
	background: #25476a;
	color: #fff;
	border-radius: 2px;
	cursor: pointer;
	margin-right: 15px;
}
button:hover{
	background: #3a5f86;
}
.kembali{
	background: #f9924d;
	color: #fff;
	border-radius: 2px;
	cursor: pointer;
	border: 1px solid #f9924d;
	padding: 9px 20px;
	text-decoration: none;
}
.kembali:hover{
	background: #f9924d;
}
</style>
