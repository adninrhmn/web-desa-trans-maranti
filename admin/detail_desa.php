<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Periksa apakah parameter id tersedia
if (!isset($_GET['id'])) {
  header('Location: profile.php');
  exit();
}

$id = $_GET['id'];

// Query untuk mengambil informasi desa berdasarkan id
$query = "SELECT * FROM desa WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

// Periksa apakah desa dengan id tersebut ada
if (!$row) {
  header('Location: profile.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Detail Desa - Admin Panel</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <style>
    body {
      padding-top: 20px;
    }
    .container {
      max-width: 800px;
    }
    .detail-item {
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
      <h2>Detail Desa</h2>
      <div class="detail-item">
        <label for="namaDesa" class="form-label">Nama Desa:</label>
        <input type="text" id="namaDesa" class="form-control" value="<?php echo $row['nama_desa']; ?>" disabled>
      </div>
      <div class="detail-item">
        <label for="alamat" class="form-label">Alamat:</label>
        <input type="text" id="alamat" class="form-control" value="<?php echo $row['alamat']; ?>" disabled>
      </div>
      <div class="detail-item">
        <label for="kodePos" class="form-label">Kode Pos:</label>
        <input type="text" id="kodePos" class="form-control" value="<?php echo $row['kode_pos']; ?>" disabled>
      </div>
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
