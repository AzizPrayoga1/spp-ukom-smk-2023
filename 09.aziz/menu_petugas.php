<?php

$result = mysqli_query($conn, "SELECT id_pembayaran FROM pembayaran");
$jumlahpembayaran = mysqli_num_rows($result);
?>
<br>
<h2>Selamat Datang <?= $_SESSION['nama_lengkap'] ?> ,kamu sebagai Petugas</h2>

<ul>
    <li>Jumlah pembayaran :<?= $jumlahpembayaran ?></li>

</ul>