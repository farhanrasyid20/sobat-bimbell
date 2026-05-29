<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
} 

// Koneksi ke database
include 'koneksi.php';

// Periksa apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mengambil daftar nilai siswa berdasarkan sesi ID
$id_siswa = $_SESSION['id'];
$query = "
    SELECT k.mapel, k.minggu, k.nilai 
    FROM nilai k
    WHERE k.siswa = '$id_siswa'
    ORDER BY k.mapel, k.minggu ASC
";
$result = mysqli_query($koneksi, $query);

// Data akan diatur dalam array multidimensi
$nilai = [];
while ($data = mysqli_fetch_assoc($result)) {
    $nilai[$data['mapel']][$data['minggu']] = $data['nilai'];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Nilai</title>
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
        table {
            width: 80%;
            background-color: #f4f4f4;
            border-collapse: collapse;
            margin-top: 60px;
            margin-left: auto;
            margin-right: auto;
            table-layout: fixed;
        }
        h4 {
            color: #5F4A8B;
            font-weight: bold;
            margin-top: 25px;
            padding-left: 25px;
        }
        table th, table td {
            padding: 10px;
            border: 2px solid #000000;
            text-align: center;
            font-size: 14px;
        }
        .subject-column {
            width: 150px;
            text-align: center;
            font-weight: bold;
            padding-left: 10px;
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
                    <a class="nav-link active text-white" href="profil_siswa.php"><i class="fa-solid fa-user-large"></i> PROFIL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="daftar_hadir_siswa.php"><i class="fa-solid fa-calendar-check"></i></i> DAFTAR HADIR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="nilai_siswa.php"><i class="fa-solid fa-graduation-cap"></i> NILAI</a>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="header">
                <?php echo "SELAMAT DATANG, " . htmlspecialchars(strtoupper($_SESSION['role'])) . "!"; ?>
                <div class="dropdown">
                    <i class="fa-regular fa-circle-user" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item text-white" href="ganti_kata_sandi_siswa.php">Ganti Kata Sandi</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-white" href="logout.php">Keluar</a></li>
                    </ul>
                </div>
            </div>
            <div class="table-container">
                <h4>DAFTAR NILAI</h4>
                <table>
                    <tr>
                        <th rowspan="2" class="subject-column">Mapel</th>
                        <th colspan="16">Minggu ke</th>
                    </tr>
                    <tr>
                        <?php for ($i = 1; $i <= 16; $i++) { ?>
                            <th><?php echo $i; ?></th>
                        <?php } ?>
                    </tr>
                    <?php foreach ($nilai as $mapel => $minggu_data) { ?>
                        <tr>
                            <td class="subject-column"><?php echo htmlspecialchars($mapel); ?></td>
                            <?php for ($i = 1; $i <= 16; $i++) { ?>
                                <td><?php echo isset($minggu_data[$i]) ? htmlspecialchars($minggu_data[$i]) : '-'; ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
