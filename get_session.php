<?php
session_start();

if (isset($_SESSION['nama'])) {
	echo "Nama: " . $_SESSION['nama'] . "<br>";
	echo "Role: " . $_SESSION['role'] . "<br>";
	echo "<a href='destroy_session.php'>Hapus Session</a>";
} else {
	echo "Session belum diset. <a href='set_session.php'>Set Session</a>";
}
?>