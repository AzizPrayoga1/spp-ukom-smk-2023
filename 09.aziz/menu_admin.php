<?php
$result = mysqli_query($conn, "SELECT id_petugas FROM petugas");
$jumlahpetugas = mysqli_num_rows($result);

$result = mysqli_query($conn, "SELECT id_pembayaran FROM pembayaran");
$jumlahpembayaran = mysqli_num_rows($result);

$result = mysqli_query($conn, "SELECT nisn FROM siswa");
$jumlahsiswa = mysqli_num_rows($result);

$result = mysqli_query($conn, "SELECT id_kelas FROM kelas");
$jumlahkelas = mysqli_num_rows($result);

$result = mysqli_query($conn, "SELECT id_spp FROM spp");
$jumlahspp = mysqli_num_rows($result);

?>
<br>
<h2>Selamat Datang <?= $_SESSION['nama_lengkap'] ?> ,kamu sebagai admin</h2>

<ul>
    <li>Jumlah  petugas :<?= $jumlahpetugas ?></li><br>
    <li>Jumlah pembayaran :<?= $jumlahpembayaran ?></li><br>
    <li>Jumlah siswa :<?= $jumlahsiswa ?></li><br>
    <li>Jumlah kelas :<?= $jumlahkelas ?></li><br>
    <li>Jumlahspp :<?= $jumlahspp ?></li>

</ul>