<?php
include_once ('../koneksi.php');
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
if(isset($_GET['nisn'])){
    $result = mysqli_query($conn, "DELETE FROM siswa WHERE nisn = $_GET[nisn]");

    if($result < 1){
            $_SESSION['info'] = "Gagal menghapus siswa";
            header("Location: index.php");
            return;
        }
        $_SESSION['info'] = "berhasil menghapus siswa";
            header("Location: index.php");
            return;
}
?>