    <?php 
    session_start();

    if( !isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

   require 'functions.php';

//    pagination
    // konfigurasi
    $jumlahDataPerHalaman = 2;
    $jumlahData = count(query("SELECT * FROM mahasiswa"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif =(isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


   $mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman");
    // tombol cari ditekan
    if( isset($_POST["cari"])){
        $mahasiswa = cari($_POST["keyword"]);
    }

    ?>



    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Admin</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="fade-in">

    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php">tambah data mahasiswa</a>

    <a href="logout.php">logout</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="keyword" size="30" 
        autofocus placeholder="masukkan keyword database.." autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form>
    <br><br>

    <!-- start pagination -->
    <?php if($halamanAktif > 1) : ?>
    <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
    <?php endif; ?>

    <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if($i == $halamanAktif) :?>
        <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: #333;"><?= $i; ?></a>
            <?php else : ?>
                <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
            <?php endif; ?>
    <?php endfor; ?>

    <?php if($halamanAktif < $jumlahHalaman) : ?>
    <a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
    <?php endif; ?>
    <!-- end pagination -->
    <br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>NRP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach( $mahasiswa as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> |
                <a href="hapus.php?id=<?= $row["id"]; ?>"
                 onclick="return confirm('yakin?');">hapus</a>
            </td>
            <td><img src="img/<?php echo $row["gambar"]; ?>" onerror="this.onerror=null; this.src='https://i.pinimg.com/originals/77/c7/01/77c701da8e4c052f89258d83820ea39b.png';" alt="" width="80"></td>
            <td><?= $row["nrp"] ?></td>
            <td><?= $row["nama"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["jurusan"] ?></td>
        </tr>
            <?php $i++; ?>
            <?php endforeach; ?>

    </table>

    </body>
    </html>