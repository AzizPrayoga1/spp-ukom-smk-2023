<?php
include_once 'koneksi.php';
session_start();
if(isset($_SESSION['level'])){
    header("Location: index.php");
    return;
}
?>
<style>
    body {
  background-image: url("./assets/laut.jpg");
  background-color: #cccccc;
  background-size: cover;
  background-repeat: no-repeat;
}
      .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sebagai</title>
</head>
<body>
    <center style="margin-top: 210px;">
        <h2> Login Sebagai</h2>
        <a class="button" href="login_petugas.php">Login sebagai petugas</a>
        <a class="button" href="login_siswa.php">Login sebagai siswa</a>
    </center>
</body>
</html>
