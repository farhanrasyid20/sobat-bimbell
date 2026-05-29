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
    <title>Input Guru Matematika</title>
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
        h3 {
            margin-top: 25px;
            text-align: center;
            color: #5F4A8B;
            font-weight: bold;
        }
        h5 {
            color: #5F4A8B;
            font-weight: bold;
        }
        .btn-simpan {
            margin: 0 10px;
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
            <h3>INPUT GURU MATEMATIKA</h3>
            <div class="col-md-3 mx-auto text-center">
                <table class="table table-striped table-bordered mt-4">
                    <thead>
                        <tr>
                            <th scope="col">NAMA</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'koneksi.php';
                        $query = mysqli_query($koneksi, "SELECT * FROM mapel WHERE mapel = 'Matematika'");
                        
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td><?php echo $data['nama_guru']; ?></td> 
                                <td>
                                    <a href="hapus_gm_mtk.php?id=<?php echo $data['nama_guru']; ?>" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <button type="button" class="btn-simpan mt-3" data-bs-toggle="modal" data-bs-target="#tambahGuruMapelModal"><i class="fas fa-pen me-2"></i>Pilih Guru</button>
                <!-- Modal Tambah Data Guru -->
                <div class="modal fade" id="tambahGuruMapelModal" tabindex="-1" aria-labelledby="tambahGuruMapelLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahGuruMapelLabel">Pilih Guru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="simpan_gm_mtk.php" method="POST">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <?php
                                            include 'koneksi.php';
                                            $queryGuru = mysqli_query($koneksi, "SELECT nama FROM guru");
                                            while ($guru = mysqli_fetch_assoc($queryGuru)) {
                                                echo '
                                                <div>
                                                    <input class="form-check-input" type="checkbox" id="guru' . $guru['nama'] . '" name="guru[]" value="' . $guru['nama'] . '">
                                                    <label class="form-check-label" for="guru' . $guru['nama'] . '">' . $guru['nama'] . '</label>
                                                </div>
                                                ';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn-simpan"><i class="fas fa-archive me-2"></i>Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>