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
    <title>Data Guru</title>
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
            display: block;
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
            <h3>DATA GURU</h3>
            <div class="col-md-11 mx-auto">
                <button type="button" class="btn-simpan mt-3" data-bs-toggle="modal" data-bs-target="#tambahDataModal1">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Guru
                </button>   
                <table class="table table-striped table-bordered mt-4 text-center">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">TEMPAT LAHIR</th>
                            <th scope="col">TANGGAL LAHIR</th>
                            <th scope="col">JENIS KELAMIN</th>
                            <th scope="col">GURU MAPEL</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'koneksi.php';
                        $query = mysqli_query($koneksi, "SELECT * FROM guru");
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td><?php echo $data['id']; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['tempat']; ?></td>
                                <td><?php echo $data['ttl']; ?></td>
                                <td><?php echo $data['jk']; ?></td>
                                <td><?php echo $data['gm']; ?></td>
                                <td><?php echo $data['email']; ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm me-1 edit-button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editDataModal1"
                                            data-id="<?php echo $data['id']; ?>"
                                            data-nama="<?php echo $data['nama']; ?>"
                                            data-tempat="<?php echo $data['tempat']; ?>"
                                            data-ttl="<?php echo $data['ttl']; ?>"
                                            data-jk="<?php echo $data['jk']; ?>"
                                            data-gm="<?php echo $data['gm']; ?>"
                                            data-email="<?php echo $data['email']; ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <a href="hapus_guru.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <!-- Modal Tambah Data -->
                <div class="modal fade" id="tambahDataModal1" tabindex="-1" aria-labelledby="tambahDataLabel1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahDataLabel1">Tambah Data Guru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="tambah_guru.php" method="POST">
                                    <div class="mb-3">
                                        <label for="id" class="form-label">ID</label>
                                        <input type="text" class="form-control" id="id" name="id" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="tempat" class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempat" name="tempat" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="ttl" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="ttl" name="ttl" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jk" class="form-label">Jenis Kelamin</label>
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <input type="radio" id="jk-l" name="jk" value="Laki-Laki" required>
                                                <label for="jk-l">Laki-Laki</label>
                                            </div>
                                            <div>
                                                <input type="radio" id="jk-p" name="jk" value="Perempuan" required>
                                                <label for="jk-p">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="gm" class="form-label">Guru Mapel</label>
                                        <input type="text" class="form-control" id="gm" name="gm" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" required>
                                    </div>
                                    <button type="submit" class="btn-simpan"><i class="fas fa-archive me-2"></i>Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Edit Data -->
                <div class="modal fade" id="editDataModal1" tabindex="-1" aria-labelledby="editDataLabel1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editDataLabel1">Edit Data Guru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="ubah_guru.php" method="POST">
                                    <input type="hidden" id="edit-id" name="id">
                                    <div class="mb-3">
                                        <label for="edit-nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="edit-nama" name="nama" required>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                            <label for="edit-tempat" class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="edit-tempat" name="tempat" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="edit-ttl" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="edit-ttl" name="ttl" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit-jk" class="form-label">Jenis Kelamin</label>
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <input type="radio" id="edit-jk-l" name="jk" value="Laki-Laki" required>
                                                <label for="edit-jk-l">Laki-Laki</label>
                                            </div>
                                            <div>
                                                <input type="radio" id="edit-jk-p" name="jk" value="Perempuan" required>
                                                <label for="edit-jk-p">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit-gm" class="form-label">Guru Mapel</label>
                                        <input type="text" class="form-control" id="edit-gm" name="gm" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit-email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="edit-email" name="email" required>
                                    </div>
                                    <button type="submit" class="btn-simpan">Perbarui</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
            document.addEventListener('DOMContentLoaded', function () {
                const editButtons = document.querySelectorAll('.edit-button');
                editButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const id = this.getAttribute('data-id');
                        const nama = this.getAttribute('data-nama');
                        const tempat = this.getAttribute('data-tempat');
                        const ttl = this.getAttribute('data-ttl');
                        const jk = this.getAttribute('data-jk');
                        const gm = this.getAttribute('data-gm');
                        const email = this.getAttribute('data-email');

                        document.getElementById('edit-id').value = id;
                        document.getElementById('edit-nama').value = nama;
                        document.getElementById('edit-tempat').value = tempat;
                        document.getElementById('edit-ttl').value = ttl;
                        document.getElementById('edit-jk-l').checked = jk === 'Laki-Laki';
                        document.getElementById('edit-jk-p').checked = jk === 'Perempuan';
                        document.getElementById('edit-gm').value = gm;
                        document.getElementById('edit-email').value = email;
                    })
                })
            })
    </script>
</body>
</html>