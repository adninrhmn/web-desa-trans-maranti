<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Periksa apakah parameter id telah diberikan
if (!isset($_GET['id'])) {
  header('Location: population.php');
  exit();
}

// Ambil ID penduduk dari parameter
$id = $_GET['id'];

// Query untuk menghapus data penduduk berdasarkan ID
$query = "DELETE FROM penduduk_desa WHERE id = '$id'";

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
  // Redirect ke halaman data penduduk setelah berhasil dihapus
  header('Location: population.php');
  exit();
} else {
  // Tampilkan pesan error jika query tidak berhasil dieksekusi
  echo "Error: " . mysqli_error($koneksi);
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
