<?php
include_once ('../koneksi.php');
session_start();

if (isset($_GET['dari']) && $_GET['sampai']){
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=list pembayaran.xls");
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
    <title>List Pembayaran</title>
</head>
<body>
    <?php
    if ($_SESSION['level'] == "admin" ){
        $result = mysqli_query($conn,"SELECT id_pembayaran, (SELECT nama_petugas FROM petugas where petugas.id_petugas = pembayaran.id_petugas) AS nama_petugas, nisn, tgl_bayar, bulan_dibayar,tahun_dibayar,(SELECT tahun FROM spp WHERE spp.id_spp = pembayaran.id_spp) AS tahunspp, jumlah_bayar FROM pembayaran WHERE tgl_bayar between '$_GET[dari]' AND '$_GET[sampai]'");
    
        if (mysqli_num_rows($result) < 1){
            $_SESSION['info'] = "data tidak ada";
            header("Location: index.php");
            return;
        }
    ?>
    <table border="1">
        <tr>
            <th>No.</th>
            <th>Nama Petugas</th>
            <th>NISN</th>
            <th>Tanggal Bayar</th>
            <th>Bulan Dibayar</th>
            <th>Tahun Dibayar</th>
            <th>Tahun SPP</th>
            <th>Jumlah Bayar</th>
        </tr>
        <?php 
            $no = 1;
            while ($pembayaran = mysqli_fetch_assoc($result)){
                ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $pembayaran['nama_petugas'] ?></td>
                <td><?= $pembayaran['nisn'] ?></td>
                <td><?= $pembayaran['tgl_bayar'] ?></td>
                <td><?= $pembayaran['bulan_dibayar'] ?></td>
                <td><?= $pembayaran['tahun_dibayar'] ?></td>
                <td><?= $pembayaran['tahunspp'] ?></td>
                <td><?= formatrupiah($pembayaran['jumlah_bayar']) ?></td>
            </tr>
            <?php
            $no++;
            }
        
        ?>
    </table>
    <?php
    }else if($_SESSION['level'] == "petugas"){
        ?>
        <table style="margin-top: 10px; width:100%">
        <tr>
            <th>NO</th>
            <th>NISN</th>
            <th>Tanggal Bayar</th>
            <th>Bulan Dibayar</th>
            <th>Tahun Dibayar</th>
            <th>Tahun SPP</th>
            <th>Jumlah Bayar</th>

        </tr>
        <?php 
        $result = mysqli_query($conn,"SELECT id_pembayaran, nisn, tgl_bayar, bulan_dibayar,tahun_dibayar,(SELECT tahun FROM spp WHERE spp.id_spp = pembayaran.id_spp) AS tahunspp, jumlah_bayar FROM pembayaran WHERE id_petugas = '$_SESSION[id]'");

        if (mysqli_num_rows($result) < 1){
            ?>
            <tr>
                <td colspan="9" align="center">Tidak Ada Data</td>
            </tr>
            <?php
        }else {
            $no = 1;
            while ($pembayaran = mysqli_fetch_assoc($result)){
                ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $pembayaran['nisn'] ?></td>
                <td><?= $pembayaran['tgl_bayar'] ?></td>
                <td><?= $pembayaran['bulan_dibayar'] ?></td>
                <td><?= $pembayaran['tahun_dibayar'] ?></td>
                <td><?= $pembayaran['tahunspp'] ?></td>
                <td><?= $pembayaran['jumlah_bayar'] ?></td>
            </tr>
            <?php
            $no++;
            }
        }
        ?>
    </table>
        <?php
    } else if ($_SESSION['level'] == "siswa") {
        ?>
        <table style="margin-top: 10px; width:100%">
        <tr>
            <th>No.</th>
            <th>Nama Petugas</th>
            <th>NISN</th>
            <th>Tanggal Bayar</th>
            <th>Bulan Dibayar</th>
            <th>Tahun Dibayar</th>
            <th>Tahun SPP</th>
            <th>Jumlah Bayar</th>
        </tr>
        <?php 
        $result = mysqli_query($conn,"SELECT id_pembayaran, (SELECT nama_petugas FROM petugas where petugas.id_petugas = pembayaran.id_petugas) AS nama_petugas, tgl_bayar, bulan_dibayar,tahun_dibayar,(SELECT tahun FROM spp WHERE spp.id_spp = pembayaran.id_spp) AS tahunspp, jumlah_bayar FROM pembayaran WHERE nisn = '$_SESSION[id]'");

        if (mysqli_num_rows($result) < 1){
            ?>
            <tr>
                <td colspan="9" align="center">Tidak Ada Data</td>
            </tr>
            <?php
        }else {
            $no = 1;
            while ($pembayaran = mysqli_fetch_assoc($result)){
                ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $pembayaran['nama_petugas'] ?></td>
                <td><?= $pembayaran['tgl_bayar'] ?></td>
                <td><?= $pembayaran['bulan_dibayar'] ?></td>
                <td><?= $pembayaran['tahun_dibayar'] ?></td>
                <td><?= $pembayaran['tahunspp'] ?></td>
                <td><?= $pembayaran['jumlah_bayar'] ?></td>
            </tr>
            <?php
            $no++;
            }
        }
        ?>
    </table>
        <?php
    }
    ?>
</body>
</html>
    <?php
}else {
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=list pembayaran.xls");
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
    <title>List Pembayaran</title>
</head>
<body>
    <?php
    if ($_SESSION['level'] == "admin" ){
    ?>
    <table border="1">
        <tr>
            <th>No.</th>
            <th>Nama Petugas</th>
            <th>NISN</th>
            <th>Tanggal Bayar</th>
            <th>Bulan Dibayar</th>
            <th>Tahun Dibayar</th>
            <th>Tahun SPP</th>
            <th>Jumlah Bayar</th>
        </tr>
        <?php 
        $result = mysqli_query($conn,"SELECT id_pembayaran, (SELECT nama_petugas FROM petugas where petugas.id_petugas = pembayaran.id_petugas) AS nama_petugas, nisn, tgl_bayar, bulan_dibayar,tahun_dibayar,(SELECT tahun FROM spp WHERE spp.id_spp = pembayaran.id_spp) AS tahunspp, jumlah_bayar FROM pembayaran");

        if (mysqli_num_rows($result) < 1){
            ?>
            <tr>
                <td colspan="9" align="center">Tidak Ada Data</td>
            </tr>
            <?php
        }else {
            $no = 1;
            while ($pembayaran = mysqli_fetch_assoc($result)){
                ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $pembayaran['nama_petugas'] ?></td>
                <td><?= $pembayaran['nisn'] ?></td>
                <td><?= $pembayaran['tgl_bayar'] ?></td>
                <td><?= $pembayaran['bulan_dibayar'] ?></td>
                <td><?= $pembayaran['tahun_dibayar'] ?></td>
                <td><?= $pembayaran['tahunspp'] ?></td>
                <td><?= formatrupiah($pembayaran['jumlah_bayar']) ?></td>
            </tr>
            <?php
            $no++;
            }
        }
        ?>
    </table>
    <?php
    }else if($_SESSION['level'] == "petugas"){
        ?>
        <table style="margin-top: 10px; width:100%">
        <tr>
            <th>NO</th>
            <th>NISN</th>
            <th>Tanggal Bayar</th>
            <th>Bulan Dibayar</th>
            <th>Tahun Dibayar</th>
            <th>Tahun SPP</th>
            <th>Jumlah Bayar</th>

        </tr>
        <?php 
        $result = mysqli_query($conn,"SELECT id_pembayaran, nisn, tgl_bayar, bulan_dibayar,tahun_dibayar,(SELECT tahun FROM spp WHERE spp.id_spp = pembayaran.id_spp) AS tahunspp, jumlah_bayar FROM pembayaran WHERE id_petugas = '$_SESSION[id]'");

        if (mysqli_num_rows($result) < 1){
            ?>
            <tr>
                <td colspan="9" align="center">Tidak Ada Data</td>
            </tr>
            <?php
        }else {
            $no = 1;
            while ($pembayaran = mysqli_fetch_assoc($result)){
                ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $pembayaran['nisn'] ?></td>
                <td><?= $pembayaran['tgl_bayar'] ?></td>
                <td><?= $pembayaran['bulan_dibayar'] ?></td>
                <td><?= $pembayaran['tahun_dibayar'] ?></td>
                <td><?= $pembayaran['tahunspp'] ?></td>
                <td><?= $pembayaran['jumlah_bayar'] ?></td>
            </tr>
            <?php
            $no++;
            }
        }
        ?>
    </table>
        <?php
    } else if ($_SESSION['level'] == "siswa") {
        ?>
        <table style="margin-top: 10px; width:100%">
        <tr>
            <th>No.</th>
            <th>Nama Petugas</th>
            <th>NISN</th>
            <th>Tanggal Bayar</th>
            <th>Bulan Dibayar</th>
            <th>Tahun Dibayar</th>
            <th>Tahun SPP</th>
            <th>Jumlah Bayar</th>
        </tr>
        <?php 
        $result = mysqli_query($conn,"SELECT id_pembayaran, (SELECT nama_petugas FROM petugas where petugas.id_petugas = pembayaran.id_petugas) AS nama_petugas, tgl_bayar, bulan_dibayar,tahun_dibayar,(SELECT tahun FROM spp WHERE spp.id_spp = pembayaran.id_spp) AS tahunspp, jumlah_bayar FROM pembayaran WHERE nisn = '$_SESSION[id]'");

        if (mysqli_num_rows($result) < 1){
            ?>
            <tr>
                <td colspan="9" align="center">Tidak Ada Data</td>
            </tr>
            <?php
        }else {
            $no = 1;
            while ($pembayaran = mysqli_fetch_assoc($result)){
                ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $pembayaran['nama_petugas'] ?></td>
                <td><?= $pembayaran['tgl_bayar'] ?></td>
                <td><?= $pembayaran['bulan_dibayar'] ?></td>
                <td><?= $pembayaran['tahun_dibayar'] ?></td>
                <td><?= $pembayaran['tahunspp'] ?></td>
                <td><?= $pembayaran['jumlah_bayar'] ?></td>
            </tr>
            <?php
            $no++;
            }
        }
        ?>
    </table>
        <?php
    }
    ?>
</body>
</html>
<?php
}
