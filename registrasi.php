<?php 
require 'functions.php';

 if(isset($_POST["register"])){

    if( registrasi($_POST) > 0){
        echo "<script>
                    alert('data berhasil di tambahkan!');
                </script>";
    } else{
        echo mysqli_error($conn);
    }
 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman registrasi</title>
    <style>
        label{
            display: block;
        }
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

        input[type="text"],
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
    <h1>Halaman registrasi</h1>

    <form action="" method="post">
    <ul>
        <li>
            <label for="username">username :</label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="password">password :</label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <label for="password2">konfirmasi password :</label>
            <input type="password" name="password2" id="password2">
        </li>
        <li>
            <button type="submit" name="register">Register</button>
        </li>
    </ul>

    </form>


</body>
</html>