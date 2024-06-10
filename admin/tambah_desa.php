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
  $namaDesa = $_POST['namaDesa'];
  $alamat = $_POST['alamat'];
  $kodePos = $_POST['kodePos'];

  // Query untuk menambah data profil desa ke tabel profil
  $query = "INSERT INTO profil (nama_desa, alamat, kode_pos) VALUES ('$namaDesa', '$alamat', '$kodePos')";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    // Jika sukses, redirect ke halaman profil.php
    header('Location: profile.php');
    exit();
  } else {
    // Jika gagal, tampilkan pesan error
    $error = "Terjadi kesalahan. Silakan coba lagi.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Desa - Admin Panel</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <style>
    body {
      padding-top: 20px;
    }
    .container {
      max-width: 800px;
    }
    .form-item {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="profile.php">Profil Desa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="population.php">Data Penduduk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="public_services.php">Layanan Publik</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Hubungi Kami</a>
            </li>
          </ul>
        </div>
        <a href="logout.php" class="btn btn-primary">Logout</a>
      </div>
    </nav>
  </header>

  <div class="container">
    <section>
      <h2>Tambah Data Profil Desa</h2>
<?php if ($error !== '') { ?>
  <p><?php echo $error; ?></p>
<?php } ?>
<form method="POST" action="">
  <div class="profile-item">
    <label for="namaDesa" class="form-label">Nama Desa:</label>
    <input type="text" id="namaDesa" name="namaDesa" class="form-control" required>
  </div>
  <div class="profile-item">
    <label for="alamat" class="form-label">Alamat:</label>
    <input type="text" id="alamat" name="alamat" class="form-control" required>
  </div>
  <div class="profile-item">
    <label for="kodePos" class="form-label">Kode Pos:</label>
    <input type="text" id="kodePos" name="kodePos" class="form-control" required>
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
