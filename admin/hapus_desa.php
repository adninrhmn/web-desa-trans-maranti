<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Periksa apakah id profil desa telah diberikan
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Query untuk menghapus data profil desa dari tabel profil
  $query = "DELETE FROM profil WHERE id='$id'";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    // Jika sukses, redirect ke halaman profil.php
    header('Location: profile.php');
    exit();
  } else {
    // Jika gagal, tampilkan pesan error
    echo "Terjadi kesalahan. Silakan coba lagi.";
  }
}
?>
