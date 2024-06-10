<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Periksa apakah ada parameter id yang dikirim melalui URL
if (!isset($_GET['id'])) {
  header('Location: contact.php');
  exit();
}

// Ambil nilai id dari parameter URL
$id = $_GET['id'];

// Query untuk menghapus pesan berdasarkan id
$query = "DELETE FROM pesan WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

// Periksa apakah penghapusan berhasil
if ($result) {
  // Jika berhasil, arahkan kembali ke halaman contact.php
  header('Location: contact.php');
} else {
  // Jika gagal, tampilkan pesan error
  echo "Error: " . mysqli_error($koneksi);
}
