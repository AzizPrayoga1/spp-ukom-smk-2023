<?php
include_once ('../koneksi.php');
session_start();

if(isset($_POST['submit'])){
    $nisn = $_POST['nisn'];
    $jumlah_bayar = $_POST['jumlah_bayar'];

    $result = mysqli_query($conn, "SELECT id_spp FROM siswa WHERE nisn = $nisn");
    if(mysqli_affected_rows($conn) == 0){
        $_SESSION['info'] = "NISN tidak valid" ;
        header("Location: index.php");
        return;
    }

    $data = mysqli_fetch_assoc($result);
    $idspp = $data['id_spp'];

    $result2 = mysqli_query($conn, "SELECT nominal FROM spp WHERE id_spp = '$idspp'");
    $data2 = mysqli_fetch_assoc($result2);
    $nominalspp = $data2['nominal'];

    $result3 =  mysqli_query($conn, "SELECT SUM(jumlah_bayar) AS totalbayar FROM pembayaran WHERE nisn = $nisn");
    $data3 = mysqli_fetch_assoc($result3);
    $totalbayar = $data3['totalbayar'];

    if ($totalbayar >= $nominalspp) {
        $_SESSION['info'] = "SPP siswa dengan NISN" . $nisn . "Sudah Lunas!";
        header("Location: index.php");
        return;
    }
    $idpetugas = $_SESSION['id'];
    $tgl_bayar = date("Y-m-d");
    $bulan_dibayar = date("F");
    $tahun_dibayar = date("Y");
    $result4 = mysqli_query($conn, "INSERT INTO pembayaran(id_petugas, nisn, tgl_bayar, bulan_dibayar, tahun_dibayar, id_spp, jumlah_bayar) VALUES ('$idpetugas', '$nisn', '$tgl_bayar', '$bulan_dibayar', '$tahun_dibayar', '$idspp', '$jumlah_bayar')");

    if (mysqli_affected_rows($conn) < 1){
        $_SESSION['info'] = "Gagal Menambahkan transaksi";
        header("Location: index.php");
        return;
    }

    $_SESSION['info'] = "Berhasil menambahkan transaksi";
    header("Location: index.php");
    return;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah pembayaran</title>
</head>
<body>
    <?php include_once ('../navbar.php')?><center>
    <form action="tambah_pembayaran.php" method="post">
        <p><input type="text" name="nisn" placeholder="masukkan nisn" required></p>
        <p><input type="text" name="jumlah_bayar" placeholder="Masukkan jumlah bayar" required></p>
        <p><input type="submit" name="submit" value="tambahkan Pembayaran"></input></p>
    </form></center>
</body>
</html>