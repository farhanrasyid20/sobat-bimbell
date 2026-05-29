<?php
session_start();
include 'koneksi.php';

// Pseudocode:
// FUNCTION gantiKataSandi(id, sandiBaru, konfirSandi)

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sandibaru = $_POST['sandibaru'];
    $konfirsandi = $_POST['konfirsandi'];

    // Validasi kata sandi baru 
    if (strlen($sandibaru) < 6) {
        $error = "Kata sandi harus minimal 6 karakter.";
    } elseif ($sandibaru !== $konfirsandi) {
        $error = "Konfirmasi kata sandi tidak cocok.";
    } else {
        // Hash kata sandi baru
        $hashed_sandi = password_hash($sandibaru, PASSWORD_DEFAULT);

        // Update password di database
        $id = $_SESSION['id'];
        $update = mysqli_query($koneksi, "UPDATE user SET password='$hashed_sandi' WHERE id='$id'");

        if ($update) {
            $success = "Kata sandi berhasil diperbarui!";
        } else {
            $error = "Gagal memperbarui kata sandi. Coba lagi.";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ganti Kata Sandi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
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
        .container {
            max-width: 1000px;
            margin-top: 50px;
        }
        .container h3 {
            color: #5F4A8B;
            font-weight: bold;
            text-align: center;
        }
        .form-label {
            color: #5F4A8B;
            font-weight: bold;
            padding-top: 25px;
        }
        .form-control {
            background-color: #F0F0F0;
            border: 2px solid #ccc;
        }
        .form-control:focus {
            border-color: #5F4A8B;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }
        .button-container {
            display: flex;
            justify-content: center; 
            gap: 30px;
        }
        .btn-simpan {
            background-color: #F7C319; 
            color: white; 
            border: none; 
            padding: 8px 30px;
            border-radius: 10px;
            cursor: pointer;
            display: block;
        }
        .btn-simpan:hover {
            background-color: #FFB300; 
        }
        .error-message {
            color: #F7C319;
            display: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <?php echo "SELAMAT DATANG, " . htmlspecialchars(strtoupper($_SESSION['role'])) . "!"; ?> <i class="fa-regular fa-circle-user"></i>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3>GANTI KATA SANDI</h3>
                <?php if (isset($success)) : ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="sandibaru" class="form-label">Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="sandibaru" name="sandibaru" required>
                    </div>
                    <div class="mb-3">
                        <label for="konfirsandi" class="form-label">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="konfirsandi" name="konfirsandi" required>
                    </div>
                    <div class="button-container">
                        <button type="submit" class="btn-simpan mt-3"><i class="fas fa-archive me-2"></i>Simpan</button>
                        <button type="submit" class="btn-simpan mt-3" onclick="location.href='data_profil.php'"><i class="fas fa-reply me-2"></i>Kembali</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
    <script>
        document.getElementById('katasandi').addEventListener('submit', function (event) {
            event.preventDefault();
            let sandibaru = document.getElementById('sandibaru').value;
            let konfirsandi = document.getElementById('konfirsandi').value;
            let valid = true;
            if (sandibaru.length < 6) {
                document.getElementById('sandibaruError').style.display = 'block';
                valid = false;
            } else {
                document.getElementById('sandibaruError').style.display = 'none';
            }
            if (sandibaru !== konfirsandi) {
                document.getElementById('konfirsandiError').style.display = 'block';
                valid = false;
            } else {
                document.getElementById('konfirsandiError').style.display = 'none';
            }
            if (valid) {
                alert('Ganti Kata Sandi berhasil!');
                window.location.href = 'data_profil.php';
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>