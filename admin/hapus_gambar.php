<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Query untuk mengambil informasi gambar dari tabel gambar_struktur
$query = "SELECT * FROM gambar_struktur";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

// Cek apakah gambar ditemukan
if (!$row) {
  echo "Gambar tidak ditemukan.";
  exit();
}

// Cek apakah tombol "Hapus Gambar" diklik
if (isset($_POST['hapusGambar'])) {
  $gambarPath = $row['path_file'];

  // Hapus gambar dari direktori
  unlink($gambarPath);

  // Hapus informasi gambar dari database
  $deleteQuery = "DELETE FROM gambar_struktur";
  mysqli_query($koneksi, $deleteQuery);

  // Arahkan pengguna kembali ke halaman profil.php setelah proses selesai
  header('Location: profile.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Hapus Gambar Struktur Organisasi - Admin Panel</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <!-- Kode navbar -->
    </nav>
  </header>

  <div class="container">
    <section>
      <h2>Hapus Gambar Struktur Organisasi</h2>
      <p>Apakah Anda yakin ingin menghapus gambar struktur organisasi?</p>
      <form method="POST">
        <button type="submit" name="hapusGambar" class="btn btn-danger">Hapus Gambar</button>
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
