<?php
include_once 'koneksi.php';
session_start();

if(!isset($_SESSION['level'])){
    $_SESSION['info'] = "anda belum login!";
    header("Location: login.php");
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MENU</title>
</head>
<body>
    <?php include_once 'navbar.php' ?>
    <?php
    switch($_SESSION['level']){
        case 'admin':
            include_once ('menu_admin.php');
            break;

        case 'petugas';
        include_once ('menu_petugas.php');
        break;

        case 'siswa';
        include_once ('menu_siswa.php');
        break;
    }
    ?>
</body>
</html>