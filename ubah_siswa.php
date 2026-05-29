<?php
include 'koneksi.php';
	$id=$_POST['id'];
	$nama=$_POST['nama'];
	$tempat=$_POST['tempat'];
	$ttl=$_POST['ttl'];
	$jk=$_POST['jk'];
	$sekolah=$_POST['sekolah'];
	$email=$_POST['email'];
	$result = mysqli_query($koneksi, "UPDATE siswa SET nama='$nama',tempat='$tempat',ttl='$ttl',jk='$jk',sekolah='$sekolah',email='$email' WHERE id='$id'");

	header("Location: data_siswa.php");
?>