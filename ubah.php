<?php 
 session_start();
    
 if( !isset($_SESSION["login"])){
     header("Location: login.php");
     exit;
 }

require 'functions.php';

// ambil data di url
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

//   cek apakah tombol submit sudah di tekan atau belum
if ( isset($_POST["submit"])) {

    // cek apakah data berhasil di ubah atau tidak
    if (ubah($_POST) > 0){
        echo "
            <script>
            alert('data berhasil di ubah!');
            document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('data gagl di ubah!');
            document.location.href = 'index.php';
            </script>
        ";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ubah data mahasiswa</title>
    <link rel="stylesheet" href="style3.css">
    <script>
    window.addEventListener('beforeunload', function() {
      document.body.style.animation = 'slide-out 0.5s ease forwards';
    });
  </script>
</head>
<body>
    <h1>ubah data mahasiswa</h1>    

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs ["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $mhs ["gambar"]; ?>">
        <ul>
            <li>
                <label for="nrp">NRP : </label>
                <input type="text" name="nrp" id="nrp" required value="<?= $mhs["nrp"];?>">
            </li>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" value="<?= $mhs["nama"];?>">
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email" value="<?= $mhs["email"];?>">
            </li>
            <li>
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan" value="<?= $mhs["jurusan"];?>">
            </li>
            <li>
                <label for="gambar">Gambar : </label> <br>
                <img src="img/<?= $mhs['gambar']; ?>" width="40" alt="">
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit" class="button-animation">ubah data</button>
            </li>
        </ul>

    </form>


</body>
</html>