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
if(isset($_GET['id_kelas'])){
    $result = mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas = $_GET[id_kelas]");

    if($result < 1){
            $_SESSION['info'] = "Gagal menghapus kelas";
            header("Location: index.php");
            return;
        }
        $_SESSION['info'] = "berhasil menghapus kelas";
            header("Location: index.php");
            return;
}
?>