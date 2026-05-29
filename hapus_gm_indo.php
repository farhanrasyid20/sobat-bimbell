<?php
include 'koneksi.php';
$nama_guru = $_GET['id'];
$result = mysqli_query($koneksi, "DELETE FROM mapel WHERE nama_guru='$nama_guru' AND mapel='Bahasa Indonesia'");
header("Location:otoritas_gm_indo.php");
?>