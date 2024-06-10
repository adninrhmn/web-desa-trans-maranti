<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Hapus gambar admin
$gambarAdmin = '../images/' . $admin['gambar'];
if (file_exists($gambarAdmin)) {
  unlink($gambarAdmin);

  // Update field gambar di tabel biodata_admin menjadi NULL
  $query = "UPDATE biodata_admin SET gambar = NULL";
  mysqli_query($koneksi, $query);

  // Redirect ke halaman profil admin
  header('Location: index.php');
  exit();
} else {
  echo "Gambar admin tidak ditemukan.";
}
?>
