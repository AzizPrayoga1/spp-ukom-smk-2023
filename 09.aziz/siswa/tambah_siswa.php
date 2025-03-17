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

if (isset($_POST['tambah_siswa'])){
    $nisn = $_POST['nisn'];
    $nis  = $_POST['nis'];
    $nama = $_POST['nama'];
    $idkelas = $_POST['id_kelas'];
    $alamat = $_POST['alamat'];
    $notelp = $_POST['no_telp'];
    $idspp = $_POST['id_spp'];

    $result = mysqli_query($conn, "INSERT INTO siswa (nisn, nis, nama, id_kelas, alamat, no_telp, id_spp) VALUES ('$nisn', '$nis', '$nama', '$idkelas', '$alamat', '$notelp', '$idspp')") ;

    if (mysqli_affected_rows($conn) == 0){
        $_SESSION['info'] = "gagal menambahkan siswa";
        header("location: index.php");
        return;
    }
    $_SESSION['info'] = "berhasil menambahkan siswa";
    header("location: index.php");
    return;


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah siswa</title>
</head>
<body>
<?php include '../navbar.php'; ?>
<center>
    <h2>Tambah Siswa</h2>
<form action="tambah_siswa.php" method="post">
    <p><input type="text" name="nisn" placeholder="Masukkan nisn" required></p>
    <p><input type="text" name="nis" placeholder="Masukkan nisn"required></p>
    <p><input type="text" name="nama" placeholder="masukkan nama siswa"required></p>
    <p>
        <select name="id_kelas"required >
            <option value="id_kelas" required>Pilih kelas</option>
            <?php
            $result = mysqli_query($conn,"SELECT * FROM kelas ");

            if (mysqli_num_rows($result) < 1){
            ?>
            <option value="">Tidak ada kelas</option>
            <?php
            }
            else{
                while ($kelas = mysqli_fetch_assoc($result)){
                    ?>
                 <option value="<?= $kelas["id_kelas"] ?>"><?= $kelas["nama_kelas"] ?></option>
                <?php
                }
            }
            ?>
        </select>
    </p>
    <p><input type="text" name="alamat" placeholder="Masukkan alamat" required></p>
    <p><input type="text" name="no_telp" placeholder="Masukkan no telp" required></p>
    <p>
        <select name="id_spp" required >
            <option value="id_spp" required>Pilih spp</option>
            <?php
            $result = mysqli_query($conn,"SELECT * FROM spp");

            if (mysqli_num_rows($result) < 1){
            ?>
            <option value="">Tidak ada spp</option>
            <?php
            }
            else{
                while ($spp = mysqli_fetch_assoc($result)){
                    ?>
                 <option value="<?= $spp["id_spp"] ?>"><?= $spp["tahun"] ?></option>
                <?php
                }
            }
            ?>
        </select>
    </p>
    <p><input type="submit" name="tambah_siswa" value="tambah siswa"></input></p>
</form></center>
</body>
</html>