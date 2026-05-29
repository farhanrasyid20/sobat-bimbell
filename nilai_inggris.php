<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
include 'koneksi.php';

// Cek jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mapel = mysqli_real_escape_string($koneksi, $_POST['mapel']); // Sanitize input
    $minggu = mysqli_real_escape_string($koneksi, $_POST['minggu']); // Sanitize input

    // Ambil data nilai dari form
    foreach ($_POST['nilai'] as $siswa_id => $nilai) {
        // Validasi nilai
        $nilai = mysqli_real_escape_string($koneksi, $nilai); // Sanitize nilai
        $siswa_id = mysqli_real_escape_string($koneksi, $siswa_id); // Sanitize siswa_id

        // Cek apakah data nilai sudah ada untuk siswa ini, mapel, dan minggu
        $checkQuery = "SELECT id FROM nilai WHERE siswa = '$siswa_id' AND mapel = '$mapel' AND minggu = '$minggu'";
        $checkResult = mysqli_query($koneksi, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // Jika data sudah ada, update data yang sudah ada.
            $updateQuery = "UPDATE nilai SET nilai = '$nilai', tgl_input = NOW() WHERE siswa = '$siswa_id' AND mapel = '$mapel' AND minggu = '$minggu'";
            if (!mysqli_query($koneksi, $updateQuery)) {
                echo "Error updating record: " . mysqli_error($koneksi);
                exit();
            }
            continue; // Lanjut ke siswa berikutnya
        }

        // Simpan data nilai siswa ke database
        $query = "INSERT INTO nilai (siswa, mapel, minggu, nilai, tgl_input)
                  VALUES ('$siswa_id', '$mapel', '$minggu', '$nilai', NOW())";

        if (!mysqli_query($koneksi, $query)) {
            // Jika terjadi error saat menyimpan
            echo "Error inserting record: " . mysqli_error($koneksi);
            exit();
        }
    }

    // Setelah simpan, redirect ke halaman status_nilai.php dengan parameter mapel dan minggu
    header("Location: status_nilai.php?mapel=$mapel&minggu=$minggu");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Nilai Guru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
            padding-left: 30px;
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
            padding: 8px;
            margin: 8px 0;
            background-color: #F0F0F0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th {
            color: #5F4A8B;
        }

        table th,
        table td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        tbody {
            max-height: 300px;
            overflow-y: auto;
            display: block;
        }

        thead,
        tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .form-control {
            max-width: 200px;
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
        }

        .form-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            flex: 1;
        }

        .btn-simpan {
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
                    <a class="nav-link text-white" href="daftar_hadir_guru.php"><i class="fa-solid fa-calendar-check"></i> DAFTAR HADIR</a>
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
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-white" href="logout.php">Keluar</a></li>
                    </ul>
                </div>
            </div>
            <div class="profil">
                <div class="profil-info">
                    <h4>INPUT NILAI SISWA</h4>
                    <div class="col-md-10 mx-auto">
                        <div class="container mt-5">
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label for="mataPelajaran" class="form-label">Mata Pelajaran</label>
                                    <input type="text" class="form-control" id="mataPelajaran" name="mapel" value="Bahasa Inggris" readonly>
                                </div>
                                <div class="form-header">
                                    <div class="form-group">
                                        <label for="mingguKe" class="form-label">Minggu Ke</label>
                                        <input type="number" class="form-control" id="mingguKe" name="minggu" min="1" max="16" value="1">
                                    </div>
                                    <button type="submit" class="btn-simpan"><i class="fas fa-archive me-2"></i>Simpan</button>
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($koneksi, "SELECT id, nama FROM siswa");
                                        $no = 1;
                                        while ($data = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $data['nama']; ?></td>
                                                <td><input type="number" name="nilai[<?php echo $data['id']; ?>]" class="form-control" min="0" max="100" step="1"></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>