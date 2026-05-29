<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Profil</title>
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
            padding-left: 29px;
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
        h4 {
            color: #5F4A8B;
            font-weight: bold;
            margin-top: 25px;
            padding-left: 25px;
        }
        .table-container a {
            text-decoration: none;
        }
        .card-container {
            display: flex;
            justify-content: space-around;
            margin-top: 150px;
        }
        .card {
            width: 250px;
            height: 200px;
            background-color: #5F4A8B;
            color: white;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 35px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .card h2 {
            font-size: 20px;
            text-align: center;
            font-weight: bold;
        }
        .card button {
            background-color: #F7C319;
            color: #5F4A8B;
            border: none;
            border-radius: 10px;
            padding: 5px 18px;
            font-weight: bold;
            cursor: pointer;
        }

        .card button:hover {
            background-color: #FFB300;
        }
        .btn-logout {
            background-color: #5F4A8B; 
            color: white; 
            border: none; 
            padding: 8px 30px;
            border-radius: 10px;
            cursor: pointer;
            display: block;
            margin: 180px auto 0;
        }
        .btn-logout:hover {
            background-color: #522D80; 
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
                    <a class="nav-link active text-white" href="data_profil.php"><i class="fa-solid fa-user-large"></i> DATA PROFIL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="otoritas_guru.php"><i class="fa-solid fa-calendar-check"></i></i> OTORITAS GURU</a>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="header">
                <?php echo "SELAMAT DATANG, " . htmlspecialchars(strtoupper($_SESSION['role'])) . "!"; ?>
                <div class="dropdown">
                    <i class="fa-regular fa-circle-user" data-bs-toggle="dropdown" aria-expanded="false"></i>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item text-white" href="ganti_kata_sandi_admin.php">Ganti Kata Sandi</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-white" href="logout.php">Keluar</a></li>
                    </ul>
                </div>
            </div>
            <div class="table-container">
                <h4>DATA PROFIL</h4>
                <div class="card-container">
                    <div class="card">
                        <h2>SISWA</h2>
                        <button onclick="window.location.href='data_siswa.php'">
                            <i class="fas fa-plus-circle me-2"></i>INPUT
                        </button>
                    </div>
                    <div class="card">
                        <h2>GURU</h2>
                        <button onclick="window.location.href='data_guru.php'">
                            <i class="fas fa-plus-circle me-2"></i>INPUT
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>