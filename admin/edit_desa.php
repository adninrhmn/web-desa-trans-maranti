<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Inisialisasi variabel error
$error = '';

// Periksa apakah form telah disubmit
if (isset($_POST['submit'])) {
  // Ambil data dari form
  $id = $_POST['id'];
  $namaDesa = $_POST['namaDesa'];
  $alamat = $_POST['alamat'];
  $kodePos = $_POST['kodePos'];

  // Query untuk mengubah data profil desa di tabel profil
  $query = "UPDATE profil SET nama_desa='$namaDesa', alamat='$alamat', kode_pos='$kodePos' WHERE id='$id'";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    // Jika sukses, redirect ke halaman profil.php
    header('Location: profile.php');
    exit();
  } else {
    // Jika gagal, tampilkan pesan error
    $error = "Terjadi kesalahan. Silakan coba lagi.";
  }
} else {
  // Ambil data profil desa berdasarkan id
  $id = $_GET['id'];
  $query = "SELECT * FROM profil WHERE id='$id'";
  $result = mysqli_query($koneksi, $query);
  $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Desa - Admin Panel</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.6.0/font/bootstrap-icons.min.css">
  <!-- atau menggunakan Font Awesome -->
  <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"> -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Font+Name&display=swap">
  <style>
    /* ... kode CSS lainnya ... */
    body {
      padding-top: 20px;
      font-family: 'Times New Roman', sans-serif;
    }
    body {
    background-image: url('../images/saya.png'); /* Ganti 'nama_gambar.jpg' dengan nama dan ekstensi gambar Anda */
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
  }

   header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 999;
}

.section-title {
    margin-top: 80px; /* Sesuaikan jarak dengan header */
  }
     table {
    width: 100%;
    margin-bottom: 20px;
    border-collapse: collapse;
  }

 table th,
  table td {
    padding: 8px;
    border: 1px solid #000;
    text-align: center;
    vertical-align: middle;
  }

  table td img {
    width: 100%;
    height: auto;
    max-height: 100px; /* Atur tinggi maksimum gambar */
    object-fit: cover;
  }

  .table img {
    max-width: 100%;
    height: auto;
  }

    .container {
      max-width: 800px;
    }
    .dashboard-title {
      margin-bottom: 20px;
    }
    .dashboard-modules {
      margin-top: 40px;
    }
    .dashboard-modules .module {
      padding: 20px;
      border-radius: 5px;
      margin-bottom: 20px;
    }
    .dashboard-modules .module a {
      color: #fff;
      text-decoration: none;
    }
    .dashboard-modules .module.profile {
      background-color: #007bff;
    }
    .dashboard-modules .module.population {
      background-color: #28a745;
    }
    .dashboard-modules .module.services {
      background-color: #dc3545;
    }
    .dashboard-modules .module h4 {
      margin-top: 0;
      margin-bottom: 10px;
    }
    .dashboard-modules .module p {
      margin-bottom: 0;
    }
  </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php"><i
                                class="bi bi-house"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php"><i class="bi bi-person-fill"></i> Profil Desa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="population.php"><i class="bi bi-people-fill"></i> Data Penduduk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="public_services.php"><i class="bi bi-card-checklist"></i> Layanan
                            Publik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php"><i class="bi bi-chat-dots-fill"></i> Hubungi Kami</a>
                    </li>
                </ul>
                <a href="logout.php" class="btn btn-light">Logout</a>
            </div>
        </div>
    </nav>
</header>

  <div class="container">
    <section>
     <h2 class="section-title">Ubah Data Profil Desa</h2>
<?php if ($error !== '') { ?>
  <p><?php echo $error; ?></p>
<?php } ?>
<form method="POST" action="">
  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
  <div class="profile-item">
    <label for="namaDesa" class="form-label">Nama Desa:</label>
    <input type="text" id="namaDesa" name="namaDesa" class="form-control" value="<?php echo $row['nama_desa']; ?>" required>
  </div>
  <div class="profile-item">
    <label for="alamat" class="form-label">Alamat:</label>
    <input type="text" id="alamat" name="alamat" class="form-control" value="<?php echo $row['alamat']; ?>" required>
  </div>
  <div class="profile-item">
    <label for="kodePos" class="form-label">Kode Pos:</label>
    <input type="text" id="kodePos" name="kodePos" class="form-control" value="<?php echo $row['kode_pos']; ?>" required>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
</form>
    </section>
  </div>

  <footer class="bg-light text-center">
    <div class="container py-3">
      <p>&copy; <?php echo date('Y'); ?>. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
