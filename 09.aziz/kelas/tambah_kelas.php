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

if (isset($_POST['tambah_kelas'])){
    $namakelas = $_POST['nama_kelas'];
    $kompetensikeahlian = $_POST['kompetensi_keahlian'];

    $result = mysqli_query($conn,"INSERT INTO kelas (nama_kelas, kompetensi_keahlian) VALUES ('$namakelas', '$kompetensikeahlian')");

    if($result < 1){
        $_SESSION['info'] = "gagal menambahkan kelas" ;
        header("Location: index.php");
        return;
    }
    $_SESSION ['info'] = "berhasil menambahkan kelas" ;
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
    <title>Tambah kelas</title>
</head>
<body>
<?php include '../navbar.php'; ?><center>
    <h2>Tambah kelas</h2>
    <form action="tambah_kelas.php" method="post">
        <p><input type="text" name="nama_kelas" placeholder="masukan nama kelas" required></p>
        <p><input type="text" name="kompetensi_keahlian" placeholder="masukan kompetensi keahlian" required></p>
        <p><input type="submit" name="tambah_kelas" value="tambah kelas"></input></p> 
    </form></center>
</body>
</html>