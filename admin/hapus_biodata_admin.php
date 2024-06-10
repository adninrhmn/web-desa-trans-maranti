<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Memeriksa apakah ada parameter ID pada URL
if (!isset($_GET['id'])) {
  header('Location: profile.php');
  exit();
}

$id = $_GET['id'];

// Query untuk menghapus data admin berdasarkan ID
$query = "DELETE FROM biodata_admin WHERE id=$id";
$result = mysqli_query($koneksi, $query);

if ($result) {
  // Redirect ke halaman profil admin setelah berhasil menghapus data
  header('Location: index.php');
  exit();
} else {
  echo "Gagal menghapus data admin. Silakan coba lagi.";
}

// Menutup koneksi ke database
mysqli_close($koneksi);
?>
