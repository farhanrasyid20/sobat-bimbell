<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Include file koneksi
include 'koneksi.php';

// Ambil username dari session
$username = $_SESSION['id'];

// Query untuk mengambil data guru berdasarkan nama (username)
$query = "SELECT * FROM guru WHERE id = '$username'";
$result = mysqli_query($koneksi, $query);

// Cek apakah data guru ditemukan
if ($result && mysqli_num_rows($result) > 0) {
    // Ambil data guru dari hasil query
    $guru = mysqli_fetch_assoc($result);
} else {
    // Jika data guru tidak ditemukan
    echo "Data guru tidak ditemukan.";
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            width: 240px;
            background-color: #5F4A8B;
            color: white;
            text-align: fixed;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #F7C319;  
            text-align: fixed;
            text-decoration: none;
        }
        .sidebar .nav-link {
            padding-left: 35px;
        }
        .sidebar .nav-link i {
            margin-right: 5px;
        }
        .sidebar h6 {
            padding-top: 10px;
            font-size: 15px;
            text-align: center;
        }
        .content {
            flex-grow: 1;
            width: 90%;
        }
        .header {
            background-color: #F7C319;
            color: white;
            padding: 18px;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .dropdown i {
            cursor: pointer;
        }
        .dropdown ul {
            background-color: #5F4A8B;
        }
        .dropdown-item:hover {
            background-color: #F7C319;
        }
        .profil {
            margin-top: 25px;
            padding-left: 25px;
            display: flex;
        }
        .profil-info h4 {
            color: #5F4A8B;
            font-weight: bold;
        }
        .profil-info label {
            color: #5F4A8B;
            font-weight: bold;
        }
        .profil-info input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            background-color: #F0F0F0;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar p-3">
            <img src="sb-ptih-pnjg.png" alt="image">
            <h6>SISTEM INFORMASI SISWA/I SOBAT BIMBEL</h6><br>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active text-white" href="profil_guru.php"><i class="fa-solid fa-user-large"></i> PROFIL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="daftar_hadir_guru.php"><i class="fa-solid fa-calendar-check"></i></i> DAFTAR HADIR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="nilai_guru.php"><i class="fa-solid fa-graduation-cap"></i> NILAI</a>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="header">
                <?php echo "SELAMAT DATANG, " . htmlspecialchars(strtoupper($_SESSION['role'])) . "!"; ?>
                <div class="dropdown">
                    <i class="fa-regular fa-circle-user" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item text-white" href="ganti_kata_sandi_guru.php">Ganti Kata Sandi</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-white" href="logout.php">Keluar</a></li>
                    </ul>
                </div>
            </div>
            <div class="profil">
                <div class="profil-info">
                    <h4>PROFIL</h4>
                    <div class="col-md-10 mt-3 mx-auto">
                        <label>ID</label>
                        <input type="text" name="id" value="<?php echo $guru['id']; ?>" readonly>

                        <label>Nama</label>
                        <input type="text" name="nama" value="<?php echo $guru['nama']; ?>" readonly>

                        <label>Tempat</label>
                        <input type="text" name="tempat" value="<?php echo $guru['tempat']; ?>" readonly>

                        <label>Tanggal Lahir</label>
                        <input type="text" name="ttl" value="<?php echo $guru['ttl']; ?>" readonly>

                        <label>Jenis Kelamin</label>
                        <input type="text" name="jenis kelamin" value="<?php echo $guru['jk']; ?>" readonly>

                        <label>Guru Mata Pelajaran</label>
                        <input type="text" name="gm" value="<?php echo $guru['gm']; ?>" readonly>

                        <label>Email</label>
                        <input type="text" name="email" value="<?php echo $guru['email']; ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>