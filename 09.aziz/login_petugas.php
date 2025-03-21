<?php
include 'koneksi.php';
session_start();
if(isset($_SESSION['level'])){
    header("Location: index.php");
    return;
}
?>

<style>
    
@import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins:wght@500&display=swap');
body{
    margin: 0;
    padding: 0;
    font-family: montserrat ;
    height: 100vh;
    overflow: hidden;
}
.conter{
    position: absolute;
    top:50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 400px;
    background: white;
    border-radius: 10px;
}
.conter h1{
    text-align: center;
    padding: 0 0 20px 0;
}
.conter form{
    padding: 0 40px;
    box-sizing: border-box;
}
form .txt_field{
    position: relative;
    margin: 30px 0;
}
.txt_field input{
    width: 100%;
    padding:  0 5px;
    height: 40px;
    font-size: 16px;
    border: none;
    background: none;
    outline: none;
}

.txt_field label{
    position: absolute;
    top: 50%;
    left: 5px;
    color: #adadad;
    transform: translateY(-50%);
    font-size: 16px;
    pointer-events: none;
    transition: .5s;
}

.txt_field span::before{
    content: '';
    position: absolute;
    top: 40px;
    left: 0;
    width: 0%;
    height: 2px;
    background: #2691d9;
    transition: .5s;

}
.txt_field input:focus ~ label,
.txt_field input:valid ~ label{
    top: -5px;
    color: #2691d9;
}
.txt_field input:focus ~ span::before,
.txt_field input:valid ~ span::before{

    width: 100%;
}
.pass{
    margin: -5px 0 20px 5px;
    color: #a6a6a6;
    cursor: pointer;
}
.pass:hover{
    text-decoration: underline;
}
input[type="submit"]{
    width: 100%;
    height: 50px;
    border: 1px solid;
    background: #2691d9;
    border-radius: 25px;
    font-size: 18px;
    color: #e9f4fb;
    font-weight: 700;
    cursor: pointer;
    outline: none;
}
input[type="submit"]:hover{
    border-color: #2691d9
    transparent 0.5s;
}
.signup_link{
    margin: 30px;
    text-align: center;
    font-size: 16px;
    color: #666666;
}
.signup_link a{
    color: #2691d9;
    text-decoration: none;
}
.signup_link a:hover{
    text-decoration: underline;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login siswa</title>
</head>

<body>
    <?php include_once 'navbar.php'?>
    <div class="conter">
    <img style="margin-left: 130px; width: 130px;" src="./assets/logo.png">
        <h1>Login</h1>
        <form action="login_proses.php" method="post">
            <div class="txt_field">
                <input type="text" name="username" required>
                <span></span>
                <label >UserName</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required>
                <span></span>
                <label >Password</label>
            </div>
            <input type="submit" name="Login">
        </form>
        
        <p>&nbsp &nbsp &nbsp &nbsp &nbsp Bukan petugas?<a href="login_siswa.php">login siswa</a></p>
    </div>
</body>

</html>
