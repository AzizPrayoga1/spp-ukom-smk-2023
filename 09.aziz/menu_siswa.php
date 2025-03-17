<?php

$result = mysqli_query($conn,"SELECT id_spp FROM siswa where nisn = '$_SESSION[id]'");
$data = mysqli_fetch_assoc($result);
$idspp = $data['id_spp'];

$result2 = mysqli_query($conn,"SELECT SUM(nominal) AS jumlahnominalspp from spp where id_spp = '$idspp'");
$data2 = mysqli_fetch_array($result2);
$jumlahnominalspp = $data2[0];

$result3 = mysqli_query($conn, "SELECT SUM(jumlah_bayar) as jumlahygsudahdibayar FROM pembayaran WHERE nisn = '$_SESSION[id]'");
$data3 = mysqli_fetch_assoc($result3);
$jumlahygsudahdibayar = $data3['jumlahygsudahdibayar'];
?>
<h2>halo selamat datang <?= $_SESSION['nama_lengkap'] ?>, kamu sebagai siswa</h2>
<ul>
    <li>jumlah Pembayaran :<?= formatrupiah($jumlahnominalspp);?></li>
    <li>jumlah SPP yang sudah dibayar :<?= formatrupiah($jumlahygsudahdibayar);?></li>
    <li>sisa <?= formatrupiah($jumlahnominalspp - $jumlahygsudahdibayar) ?></li>
</ul>