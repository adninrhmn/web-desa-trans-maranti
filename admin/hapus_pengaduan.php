<?php
// File hapus_pengaduan.php
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Periksa apakah parameter id_pengaduan telah diberikan
if (!isset($_GET['id_pengaduan'])) {
  header('Location: dashboard.php');
  exit();
}

// Ambil nilai id_pengaduan dari parameter
$id_pengaduan = $_GET['id_pengaduan'];

// Query untuk menghapus pengaduan berdasarkan id_pengaduan
$query = "DELETE FROM pengaduan_saran WHERE id_pengaduan = '$id_pengaduan'";
$result = mysqli_query($koneksi, $query);

// Periksa apakah penghapusan berhasil
if ($result) {
  // Redirect kembali ke halaman dashboard dengan pesan sukses
  header('Location: public_services.php?hapus_sukses=true');
} else {
  // Redirect kembali ke halaman dashboard dengan pesan error
  header('Location: public_services.php?hapus_error=true');
}
?>
