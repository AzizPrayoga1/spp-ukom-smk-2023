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

if (isset($_POST['update_spp'])){
    $id_spp = $_POST['id_spp'];
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];
    
    $k = mysqli_query($conn,"UPDATE spp SET tahun = '$tahun', nominal = '$nominal' WHERE spp.id_spp = '$id_spp'");

    if (mysqli_affected_rows($conn) == 0){
        $_SESSION['info'] = "gagal memperbarui spp";
        header("Location: index.php");
        return;
    }
    $_SESSION['info'] = "berhasil memperbarui spp";
    header("Location: index.php");
    return;
}


if (!isset($_GET['id_spp'])){
    $_SESSION['info'] = "Silahkan masukkan id spp!";
    header("Location: index.php");
    return;
}
    
    $result = mysqli_query($conn, "SELECT * FROM spp WHERE id_spp = $_GET[id_spp]");

    if (mysqli_num_rows($result) < 1 ){
        $_SESSION['info'] = "Id spp tidak valid!";
        header("Location: index.php");
        return;
    }
    $spp  = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update spp</title>
</head>
<body>
<?php include '../navbar.php'; ?>
<center>
    <h2>update spp</h2>
    <form action="update_spp.php" method="post">
        <input type="hidden" name="id_spp" value="<?= $spp['id_spp'] ?>">
        <p><input type="number" name="tahun" value="<?=$spp['tahun'] ?>" required></p>
        <p><input type="number" name="nominal" value="<?=$spp['nominal'] ?>" required></p>
        <p><input type="submit" name="update_spp" value="update spp"></input></p> 
    </form></center>
</body>
</html>