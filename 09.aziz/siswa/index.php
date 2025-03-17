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
    <title>List siswa</title>
</head>
<body>
    <?php include_once('../navbar.php');?>
    <h2>List siswa</h2>
    <table style="margin-top: 10px; width:100% ; text-align:center">
        <tr>
            <th>No.</th>
            <th>NISN</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>kelas</th>
            <th>Alamat</th>
            <th>No Telp</th>
            <th>tahun spp</th>
            <th>Aksi</th>
        </tr>
        <?php 
        $result = mysqli_query($conn,"SELECT * FROM siswa s INNER JOIN spp p ON s.id_spp = p.id_spp INNER JOIN kelas k ON s.id_kelas = k.id_kelas ORDER BY s.nama ASC");

        if (mysqli_num_rows($result) < 1){
            ?>
            <tr>
                <td colspan="3" align="center">Tidak Ada Data</td>
            </tr>
            <?php
        }else {
            $no = 1;
            while ($siswa = mysqli_fetch_assoc($result)){
                ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $siswa['nisn'] ?></td>
                <td><?= $siswa['nis'] ?></td>
                <td><?= $siswa['nama'] ?></td>
                <td><?= $siswa['nama_kelas'] ?></td>
                <td><?= $siswa['alamat'] ?></td>
                <td><?= $siswa['no_telp'] ?></td>
                <td><?= $siswa['tahun'] ?></td>
                <td style="height: 100px" ><a class="button" href="update_siswa.php?nisn=<?= $siswa['nisn'] ?>">Update</a> atau <a class="hapus" onclick="return confirm('Apakah anda yakin menghapus ?')" href="hapus_siswa.php?nisn=<?= $siswa['nisn'] ?>">Hapus</a></td>
            </tr>
            <?php
            $no++;
            }
        }
        ?>
    </table>
</body>
</html>