<?php
include_once 'koneksi.php';
session_start();
if(isset($_SESSION['level'])){
    header("Location: index.php");
    return;
}

if(isset($_POST['login'])){  
    header("Location: login.php");
}

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $login = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'");

    if(mysqli_num_rows($login) < 1){
        $_SESSION['info'] = "username atau password salah!";
        header("Location: login_petugas.php");
        return;
    }
    $data = mysqli_fetch_assoc($login);
    $_SESSION['id'] = $data['id_petugas'];
    $_SESSION['nama_lengkap'] = $data['nama_petugas'];
    $_SESSION['level'] = $data['level'];
    $_SESSION['info'] = "berhasil login!";
    header("Location: index.php");

}
if(isset($_POST['nisn']) && isset($_POST['nis'])){
    $nisn = $_POST['nisn'];
    $nis =  $_POST['nis'];

    $login = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn = '$nisn' AND nis = '$nis'");

    if(mysqli_num_rows($login) < 1){
        $_SESSION['info'] = "nisn atau nis salah!";
        header("Location: login_siswa.php");
        return;
    }
    $data = mysqli_fetch_assoc($login);
    $_SESSION['id'] = $data['nisn'];
    $_SESSION['nama_lengkap'] = $data['nama'];
    $_SESSION['level'] = 'siswa';
    $_SESSION['info'] = "berhasil login!";
    header("Location: index.php");

}
?>