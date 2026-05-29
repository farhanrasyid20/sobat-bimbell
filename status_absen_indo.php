<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';

// Ambil nilai mata pelajaran dan minggu yang dipilih
$mapel = $_GET['mapel'];
$minggu = $_GET['minggu'];

// Query untuk mengambil data kehadiran berdasarkan mata pelajaran dan minggu
$query = "SELECT s.nama, k.status
          FROM kehadiran k
          JOIN siswa s ON k.siswa = s.id
          WHERE k.mapel = '$mapel' AND k.minggu = $minggu";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($koneksi));
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
        .button-container {
            display: flex;
            justify-content: flex-end;
        }
        .btn-simpan {
            display: block;
            margin-left: 20px;
            margin: 0 10px;
            float: left;
            padding: 7px 20px;
            background-color: #5F4A8B;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-simpan:hover {
            background-color: #522D80;
            color: white;
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
                    <h4><?php echo $mapel; ?> (Minggu ke <?php echo $minggu; ?>)</h4>
                    <div class="container mt-5">
                        <table class="table table-striped table-bordered mt-4 text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($data = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $no++ . "</td>";
                                    echo "<td>" . htmlspecialchars($data['nama']) . "</td>";
                                    echo "<td>" . htmlspecialchars($data['status']) . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>