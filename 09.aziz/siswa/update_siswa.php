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

if (isset($_POST['update_siswa'])){
    $nisn = $_POST['nisn'];
    $nis  = $_POST['nis'];
    $nama = $_POST['nama'];
    $idkelas = $_POST['id_kelas'];
    $alamat = $_POST['alamat'];
    $notelp = $_POST['no_telp'];
    $idspp = $_POST['id_spp'];

    $result = mysqli_query($conn, "UPDATE siswa SET nis = '$nis', nama = '$nama', id_kelas = '$idkelas', alamat = '$alamat', no_telp = '$notelp', id_spp = '$idspp' WHERE `siswa`.`nisn` = '$nisn'") ;

    if (mysqli_affected_rows($conn) == 0){
        $_SESSION['info'] = "gagal mengubah siswa";
        header("location: index.php");
        return;
    }
    $_SESSION['info'] = "berhasil mengubah siswa";
    header("location: index.php");
    return;
}


    if (!isset($_GET['nisn'])){
        $_SESSION['info'] = "Silahkan masukkan id siswa!";
        header("Location: index.php");
        return;
    }
        
        $result = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn = $_GET[nisn]");
    
        if (mysqli_num_rows($result) < 1 ){
            $_SESSION['info'] = "Id siswa tidak valid!";
            header("Location: index.php");
            return;
        }
        
    $siswa = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update siswa</title>
</head>
<body>
<?php include '../navbar.php'; ?>
<center>
    <h2>Update siswa</h2>
<form action="update_siswa.php" method="post">
    <p><input type="hidden" name="nisn" value="<?= $siswa['nisn']?>"></p>
    <p><input type="text" name="nis" value="<?= $siswa['nis']?>" placeholder="Masukkan nisn"></p>
    <p><input type="text" name="nama" value="<?= $siswa['nama']?>" placeholder="masukkan nama siswa"></p>
    <p>
        <select name="id_kelas" >
            <option value="id_kelas" required>Pilih Kelas</option>
            <?php
            $result = mysqli_query($conn,"SELECT * FROM kelas");

            if (mysqli_num_rows($result) < 1){
            ?>
            <option value="">Tidak ada Tahun kelas</option>
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
    <p><input type="text" name="alamat" value="<?= $siswa['alamat']?>" placeholder="Masukkan alamat"></p>
    <p><input type="text" name="no_telp" value="<?= $siswa['no_telp']?>" placeholder="Masukkan no telp"></p>
    <p>
        <select name="id_spp" >
            <option value="id_spp" required>Pilih SPP</option>
            <?php
            $result = mysqli_query($conn,"SELECT * FROM spp");

            if (mysqli_num_rows($result) < 1){
            ?>
            <option value="">Tidak ada SPP</option>
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
    <p><input type="submit" name="update_siswa" value="update siswa"></input></p>
</form></center>
</body>
</html>
