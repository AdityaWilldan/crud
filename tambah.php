<?php 
 session_start();
    
 if( !isset($_SESSION["login"])){
     header("Location: login.php");
     exit;
 }

require 'functions.php';
//   cek apakah tombol submit sudah di tekan atau belum
if ( isset($_POST["submit"])) {
   
    // cek apakah data berhasil di tambahkan atau tidak
    if (tambah($_POST) > 0){
        echo "
            <script>
            alert('data berhasil di tambahkan!');
            document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('data gagal di tambahkan!');
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
    <title>Tambah data mahasiswa</title>
    <link rel="stylesheet" href="style3.css">
    <script>
    window.addEventListener('beforeunload', function() {
      document.body.style.animation = 'slide-out 0.5s ease forwards';
    });
  </script>
</head>
<body>
    <h1>Tambah data mahasiswa</h1>    

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nrp">NRP : </label>
                <input type="text" name="nrp" id="nrp" required>
            </li>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama">
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email">
            </li>
            <li>
                <label for="jurusan">Jurusan : </label>
                <input type="text" name="jurusan" id="jurusan">
            </li>
            <li>
            <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit" class="button-animation">Tambah data</button>
            </li>
        </ul>

    </form>


</body>
</html>