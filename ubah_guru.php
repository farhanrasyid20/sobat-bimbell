<?php
include 'koneksi.php';
	$id=$_POST['id'];
	$nama=$_POST['nama'];
	$tempat=$_POST['tempat'];
	$ttl=$_POST['ttl'];
	$jk=$_POST['jk'];
	$gm=$_POST['gm'];
	$email=$_POST['email'];
	$result = mysqli_query($koneksi, "UPDATE guru SET nama='$nama',tempat='$tempat',ttl='$ttl',jk='$jk',gm='$gm',email='$email' WHERE id='$id'");

	header("Location: data_guru.php");
?>