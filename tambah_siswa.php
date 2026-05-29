<?php
include 'koneksi.php';

// Pseudocode:
// FUNCTION tambahSiswa(id, nama, tempat, ttl, jk, sekolah, email)
// HASH default password
// INSERT data siswa into table siswa

// Mengambil data dari form dan menyimpannya ke dalam variabel
$id = $_POST['id'];         // Menyimpan data ID siswa dari form
$nama = $_POST['nama'];     // Menyimpan data nama siswa dari form
$tempat = $_POST['tempat']; // Menyimpan data tempat lahir siswa dari form
$ttl = $_POST['ttl'];       // Menyimpan data tanggal lahir siswa dari form
$jk = $_POST['jk'];         // Menyimpan data jenis kelamin siswa dari form
$sekolah = $_POST['sekolah']; // Menyimpan data nama sekolah siswa dari form
$email = $_POST['email'];   // Menyimpan data email siswa dari form

// Hash password untuk keamanan dan menyimpannya dalam variabel
$password = password_hash('123456', PASSWORD_DEFAULT); // Menyimpan kata sandi hash
$role = 'siswa';            // Menyimpan peran pengguna sebagai siswa

// Simpan data ke tabel siswa
$inputSiswa = mysqli_query($koneksi, "INSERT INTO siswa (id, nama, tempat, ttl, jk, sekolah, email) 
VALUES('$id', '$nama', '$tempat', '$ttl', '$jk', '$sekolah', '$email')");

if($inputSiswa){
    // Simpan data ke tabel user
    $inputUser = mysqli_query($koneksi, "INSERT INTO user (id, username, password, role) 
    VALUES('$id', '$nama', '$password', '$role')");
    
    if($inputUser){
        echo "<script>
                alert('Data Berhasil Disimpan');
                window.location.href = 'data_siswa.php';
              </script>";
    } else {
        // Hapus data siswa jika gagal menambahkan ke tabel user
        mysqli_query($koneksi, "DELETE FROM siswa WHERE id = '$id'");
        echo "<script>
                alert('Gagal Menyimpan Data ke Tabel User');
                window.location.href = 'data_siswa.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Gagal Menyimpan Data');
            window.location.href = 'data_siswa.php';
          </script>";
}
?>
