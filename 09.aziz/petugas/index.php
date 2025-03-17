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
?>
<style>
    table,tr,th,td{
        border:1px solid black;
        border-collapse: collapse;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List petugas</title>
</head>
<body>
    <?php include_once('../navbar.php');?>
    <h2>List petugas</h2>
    <table style="margin-top: 10px; width:100%; text-align:center">
        <tr>
            <th>No.</th>
            <th>username</th>
            <th>Nama Petugas</th>
            <th>Aksi</th>
        </tr>
        <?php 
        $result = mysqli_query($conn,"SELECT * FROM petugas WHERE level = 'petugas' ORDER BY `petugas`.`nama_petugas` ASC ");

        if (mysqli_num_rows($result) < 1){
            ?>
            <tr>
                <td colspan="3" align="center">Tidak Ada Data</td>
            </tr>
            <?php
        }else {
            $no = 1;
            while ($petugas = mysqli_fetch_assoc($result)){
                ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $petugas['username'] ?></td>
                <td><?= $petugas['nama_petugas'] ?></td>
                <td style="height: 100px"><a class="button" href="update_petugas.php?id_petugas=<?= $petugas['id_petugas'] ?>">update</a> atau <a class="hapus" onclick="return confirm('Apakah anda yakin menghapus ?')" href="hapus_petugas.php?id_petugas=<?= $petugas['id_petugas'] ?>">Hapus</button></a></td>
            </tr>
            <?php
            $no++;
            }
        }
        ?>
    </table>
</body>
</html>