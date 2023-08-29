<?php 
session_start();
require 'functions.php';

// cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if( $key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
}

if( isset($_SESSION["login"])){
    header("Location: index.php");
}


if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if(mysqli_num_rows($result) === 1){
        // cek password
        $row = mysqli_fetch_assoc($result);
       if( password_verify($password, $row["password"])) {
        // set session
        $_SESSION["login"] = true;
        // cek remember me
        if(isset($_POST['remember'])){
            // buat cookie
            setcookie('id', $row['id'], time() + 60);
            setcookie('key', hash('sha256', $row['username']),
                time() + 60);
        }
        
        header("Location: index.php");
        exit;

        
       }
    }

        $error = true;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-bottom: 20px;
        }

        li {
            margin-bottom: 10px;
        }

        label {
            display: block;
            font-weight: bold;
            color: #fff;
        }

        input[type="username"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #555;
        }

        p.error {
            color: red;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h1>Halaman Login</h1>
    <?php if(isset($error)) :?>
        <p style="color: red; font-style: italic; ">Username / Password salah</p>
        <?php endif; ?>

    <form action="" method="post">

    <ul>
        <li>
            <label for="username">Username :</label>
            <input type="username" name="username" id="username">
        </li>
        <li>
            <label for="password">Password :</label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <label for="remember">remember :</label>
            <input type="checkbox" name="remember" id="remember">
        </li>
        <li>
            <button type="submit" name="login">Login</button>
        </li>
    </ul>


    </form>
</body>
</html>