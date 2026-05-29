<?php
include 'koneksi.php';
$nama_guru = $_GET['id'];
$result = mysqli_query($koneksi, "DELETE FROM mapel WHERE nama_guru='$nama_guru' AND mapel='Matematika'");
header("Location:otoritas_gm_mtk.php");
?>