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

if (isset($_POST['update_petugas'])){
    $id_petugas = $_POST['id_petugas'];
    $nama_petugas = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $k = mysqli_query($conn,"UPDATE petugas SET nama_petugas = '$nama_petugas', username = '$username', password = '$password' WHERE petugas.id_petugas = '$id_petugas'");

    if (mysqli_affected_rows($conn) == 0){
        $_SESSION['info'] = "gagal memperbarui petugas";
        header("Location: index.php");
        return;
    }
    $_SESSION['info'] = "berhasil memperbarui petugas";
    header("Location: index.php");
    return;
}


if (!isset($_GET['id_petugas'])){
    $_SESSION['info'] = "Silahkan masukkan id petugas!";
    header("Location: index.php");
    return;
}
    
    $result = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas = $_GET[id_petugas]");

    if (mysqli_num_rows($result) < 1 ){
        $_SESSION['info'] = "Id petugas tidak valid!";
        header("Location: index.php");
        return;
    }
    $petugas  = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update petugas</title>
</head>
<body>
<?php include '../navbar.php'; ?>
<center>
    <h2>update petugas</h2>
    <form action="update_petugas.php" method="post">
        <input type="hidden" name="id_petugas" value="<?= $petugas['id_petugas'] ?>">
        <p><input type="text" name="nama_petugas" value="<?=$petugas['nama_petugas'] ?>" required></p>
        <p><input type="text" name="username" value="<?=$petugas['username'] ?>" required></p>
        <p><input type="password" name="password" value="<?=$petugas['password'] ?>" required></p>
        <p><input type="submit" name="update_petugas" value="update petugas"></input></p> 
    </form></center>
</body>
</html>