<?php
include 'koneksi.php';
$id = $_GET['id'];
$result = mysqli_query($koneksi, "DELETE FROM guru WHERE id='$id'");
header("Location:data_guru.php");
?>