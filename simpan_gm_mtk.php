<?php
include 'koneksi.php';

// Nama mapel langsung didefinisikan di sini
$mapel = 'Matematika'; // Ganti sesuai mapel di halaman ini

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $guruNames = $_POST['guru']; // Array nama guru yang di pilih

    foreach ($guruNames as $guruName) {
        $query = "INSERT INTO mapel (mapel, nama_guru) VALUES ('$mapel', '$guruName')";
        mysqli_query($koneksi, $query);
    }

    header('Location: otoritas_gm_mtk.php');
}
?>