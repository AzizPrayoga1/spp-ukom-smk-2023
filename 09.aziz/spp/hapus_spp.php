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
if(isset($_GET['id_spp'])){
    $result = mysqli_query($conn, "DELETE FROM spp WHERE id_spp = $_GET[id_spp]");

    if($result < 1){
            $_SESSION['info'] = "Gagal menghapus spp";
            header("Location: index.php");
            return;
        }
        $_SESSION['info'] = "berhasil menghapus spp";
            header("Location: index.php");
            return;
}
?>