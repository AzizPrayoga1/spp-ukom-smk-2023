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
if(isset($_GET['id_petugas'])){
    $result = mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas = $_GET[id_petugas]");

    if($result < 1){
            $_SESSION['info'] = "Gagal menghapus petugas";
            header("Location: index.php");
            return;
        }
        $_SESSION['info'] = "berhasil menghapus petugas";
            header("Location: index.php");
            return;
}
?>