<?php
include 'koneksi.php';

// Ambil data dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$tempat = $_POST['tempat'];
$ttl = $_POST['ttl'];
$jk = $_POST['jk'];
$gm = $_POST['gm'];
$email = $_POST['email'];

// Hash password
$password = password_hash('123456', PASSWORD_DEFAULT);
$role = 'guru';

// Simpan data ke tabel guru
$inputGuru = mysqli_query($koneksi, "INSERT INTO guru (id, nama, tempat, ttl, jk, gm, email) VALUES('$id', '$nama', '$tempat', '$ttl', '$jk', '$gm', '$email')");

if($inputGuru){
    // Simpan data ke tabel user
    $inputUser = mysqli_query($koneksi, "INSERT INTO user (id, username, password, role) VALUES('$id', '$nama', '$password', '$role')");
    
    if($inputUser){
        echo "<script>
                alert('Data Berhasil Disimpan');
                window.location.href = 'data_guru.php';
              </script>";
    } else {
        // Hapus data guru jika gagal menambahkan ke tabel user
        mysqli_query($koneksi, "DELETE FROM guru WHERE id = '$id'");
        echo "<script>
                alert('Gagal Menyimpan Data ke Tabel User');
                window.location.href = 'data_guru.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Gagal Menyimpan Data');
            window.location.href = 'data_guru.php';
          </script>";
}
?>
