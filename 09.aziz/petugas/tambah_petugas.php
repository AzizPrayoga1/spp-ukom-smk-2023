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

if (isset($_POST['tambah_petugas'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $namapetugas = $_POST['nama_petugas'];

    $result = mysqli_query($conn,"INSERT INTO petugas (username, password, nama_petugas, level) VALUES ('$username', '$password','$namapetugas','petugas')");

    if($result < 1){
        $_SESSION['info'] = "gagal menambahkan petugas" ;
        header("Location: index.php");
        return;
    }
    $_SESSION ['info'] = "berhasil menambahkan petugas" ;
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
    <title>Tambah petugas</title>
</head>
<body>
<?php include '../navbar.php'; ?><center>
    <H2>Tambah petugas</H2>
    <form action="tambah_petugas.php" method="post">
        <p><input type="text" name="nama_petugas" placeholder="masukan nama petugas" required></p>
        <p><input type="text" name="username" placeholder="masukan username petugas" required></p>
        <p><input type="text" name="password" placeholder="masukan password petugas" required></p>
        <p><input type="submit" name="tambah_petugas" value="Tambah Petugas"></input></p> 
    </form></center>
</body>
</html>