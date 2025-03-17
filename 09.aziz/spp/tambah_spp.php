<?php
include_once '../koneksi.php';
session_start();
if (!isset($_SESSION['level'])){
    $_session['info'] = "Silahkan login terlebih dahulu!";
    header("location: ../login.php");
    return;
}

if($_SESSION['level'] !== "admin"){
    $_SESSION['info'] = "Anda Tidak Dapat Mengakses Halaman Ini!";
    header("location: index.php");
    return;
}

if (isset($_POST['tambah_spp'])){
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];


    $result = mysqli_query($conn,"INSERT INTO SPP (tahun, nominal) VALUES ('$tahun', '$nominal')");

    if($result < 1){
        $_SESSION['info'] = "gagal menambahkan SPP" ;
        header("Location: index.php");
        return;
    }
    $_SESSION ['info'] = "berhasil menambahkan SPP" ;
    header("location:index.php"); 
    return;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah SPP</title>
</head>
<body>
<?php include '../navbar.php'; ?><center>
    <H2>Tambah SPP</H2>
    <form action="tambah_spp.php" method="post">
        <p><input type="number" name="tahun" placeholder="masukan tahun SPP" required></p>
        <p><input type="number" name="nominal" placeholder="masukan nominal SPP" required></p>
        <p><input type="submit" name="tambah_spp" value="tambah SPP"></input></p> 
    </form></center>
</body>
</html>