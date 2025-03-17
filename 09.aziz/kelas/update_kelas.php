<?php
include_once '../koneksi.php';
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

if(isset($_POST['id_kelas'])){
    $idkelas = $_POST['id_kelas'];
    $namakelas = $_POST['nama_kelas'];
    $kompetensikeahlian = $_POST['kompetensi_keahlian'];
    $result = mysqli_query($conn, "UPDATE kelas SET nama_kelas = '$namakelas', kompetensi_keahlian = '$kompetensikeahlian' WHERE id_kelas=$idkelas");

    if ($result < 1){
        $_SESSION['info'] = "Gagal memperbarui kelas";
        header("Location: index.php");
        return;
    }
    $_SESSION['info'] = "berhasil memperbarui kelas";
        header("Location: index.php");
        return;

}

if (!isset($_GET['id_kelas'])){
$_SESSION['info'] = "Silahkan masukkan id kelas!";
header("Location: index.php");
return;
}

$result = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas = $_GET[id_kelas]");

if (mysqli_num_rows($result) < 1 ){
    $_SESSION['info'] = "Id kelas tidak valid!";
    header("Location: index.php");
    return;
}
$kelas  = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update kelas</title>
</head>
<body>
<?php include '../navbar.php'; ?><center>
    <h2>Update kelas</h2>
    <form action="update_kelas.php" method="post">
        <p><input type="hidden" name="id_kelas" value="<?=$kelas['id_kelas'] ?>"  required></p>
        <p><input type="text" name="nama_kelas" value="<?=$kelas['nama_kelas'] ?>" required></p>
        <p><input type="text" name="kompetensi_keahlian" value="<?=$kelas['kompetensi_keahlian'] ?>" required></p>
        <p><input type="submit" name="update_kelas" value="Update kelas"></input></p> 
    </form></center>
</body>
</html>