<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Periksa apakah parameter id_wisata telah diberikan
if (!isset($_GET['id_wisata'])) {
  header('Location: public_services.php');
  exit();
}

// Hapus data wisata lokal berdasarkan id_wisata
$id_wisata = $_GET['id_wisata'];
$query = "DELETE FROM wisata_lokal WHERE id_wisata = $id_wisata";
$result = mysqli_query($koneksi, $query);

if ($result) {
  header('Location: public_services.php');
  exit();
} else {
  echo "Gagal menghapus informasi wisata lokal.";
}
?>
