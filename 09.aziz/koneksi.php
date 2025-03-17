<?php
$conn = mysqli_connect('localhost','root','','spp_ukom' );

date_default_timezone_set('Asia/Jakarta');

function formatrupiah($nominal){
    return "Rp " . number_format($nominal,2,',','.');
}
?>