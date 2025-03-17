<?php
if (isset($_SESSION['info'])) {
?>
  <script>
    alert("<?= $_SESSION['info'] ?>")
  </script>
<?php
  unset($_SESSION['info']);
}
$baseurl = "http://localhost/09.aziz/";
  ?>
<style>
select{
  width: 81%;
  height: 40px;
}
input{
  width: 80%;
  height: 40px;
}

  *{
    font-family: Arial, Helvetica, sans-serif;
  }
  body {
    background: linear-gradient(90deg, rgb(113 242 255) 0%, rgb(112 165 162) 100%);
}
  HTML CSSResult Skip Results Iframe EDIT ON body {
    margin: 0;
    font-family: 'tahoma'
  }

  nav {
    margin: 0 auto;
    width: 100%;
    height: auto;
    display: inline-block;
    background: #37bc9b;
  }

  nav ul {
    margin: 0;
    padding: 0;
    list-style-type: none;
    display: inline-block;
  }

  nav ul li {
    position: relative;
    margin: 0 70px 0 0;
    display: inline-block;
  }
  .button {
  background-color: #4CAF50; 
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
.hapus {
  background-color: #ff0000; 
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
.submit {
  background-color: #fff; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
  li>a:after {
    content: ' »';
  }

  /* Change this in order to change the Dropdown symbol */

  li>a:only-child:after {
    content: '';
  }

  nav ul li a {
    padding: 20px;
    display: inline-block;
    color: white;
    text-decoration: none;
  }

  nav ul li a:hover {
    opacity: 0.5;
  }

  nav ul li ul {
    display: none;
    position: absolute;
    left: 0;
    background: #37bc9b;
    float: left;
  }

  nav ul li ul li {
    width: 100%;
    border-bottom: 1px solid rgba(255, 255, 255, .3);
  }

  nav ul li:hover ul {
    display: block;
  }
</style>

<nav>
  <ul>
    <li><a href="<?= $baseurl?>">APP Pembayaran SPP</a></li>
<?php
if (isset($_SESSION['level'])){
?>
    <?php
    if ($_SESSION['level'] == 'admin') {
      
      ?>
      <li><a href="#">Petugas</a>
        <ul>
          <li><a href="<?= $baseurl . "petugas/"?>">List Petugas</a></li>
          <li><a href="<?= $baseurl . "petugas/tambah_petugas.php"?>">Tambah petugas</a></li>
        </ul>
      </li>
      <li><a href="#">siswa</a>
        <ul>
          <li><a href="<?= $baseurl . "siswa/"?>">List Siswa</a></li>
          <li><a href="<?= $baseurl . "siswa/tambah_siswa.php"?>">Tambah Siswa</a></li>
        </ul>
      </li>
      <li><a href="#">Kelas</a>
        <ul>
          <li><a href="<?= $baseurl . "kelas/"?>">List Kelas</a></li>
          <li><a href="<?= $baseurl . "kelas/tambah_kelas.php"?>">Tambah Kelas</a></li>
        </ul>
      </li>
      <li><a href="#">SPP</a>
        <ul>
          <li><a href="<?= $baseurl . "spp/"?>">List SPP</a></li>
          <li><a href="<?= $baseurl . "spp/tambah_spp.php"?>">Tambah SPP</a></li>
        </ul>
      </li>
      <li><a href="#">Pembayaran</a>
        <ul>
          <li><a href="<?= $baseurl . "pembayaran/"?>">List Pembayaran</a></li>
          <li><a href="<?= $baseurl . "pembayaran/tambah_pembayaran.php"?>">Isi pembayaran</a></li>
          <li><a href="<?= $baseurl . "pembayaran/generate.php"?>">export to excel</a></li>
        </ul>
      </li>
    <?php
    } if ( $_SESSION['level'] == 'petugas'|| $_SESSION['level'] == 'siswa') {
      ?>

      <li><a href="#">Pembayaran</a>
        <ul>
          <li><a href="<?= $baseurl . "pembayaran/"?>">List Pembayaran</a></li>
          <?php
          if ($_SESSION['level'] == 'petugas'){
          ?>
          <li><a href="<?= $baseurl . "pembayaran/tambah_pembayaran.php"?>">Isi pembayaran</a></li>
        <?php
        }
          ?>
        </ul>
      </li>
    <?php
    }if ($_SESSION['level'] == 'petugas'){
      ?>
      <li><a href="<?= $baseurl . "listsiswa/"?>">List siswa</a>
      </li>
      <?php
    }
    ?>
    
    <li><a href="<?= $baseurl . "logout.php"?>" onclick="return confirm('Apakah anda yakin ingin keluar ?')">Logout</a></li>
    <?php  
    }
    ?>
    </ul>
    </nav>