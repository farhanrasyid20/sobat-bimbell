<?php
include 'koneksi.php';

// Password default admin (plaintext)
$password = '123456'; // Ganti dengan password default admin yang Anda inginkan
// Membuat password hash
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Update password admin di database
$update_query = "UPDATE user SET password = '$hashed_password' WHERE username = 'admin'";
if (mysqli_query($koneksi, $update_query)) {
    echo "Password admin berhasil diupdate!";
} else {
    echo "Gagal mengupdate password admin.";
}
?>
