<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Memperbarui data admin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Ambil data dari form
  $nama = $_POST['nama'];
  $nik = $_POST['nik'];
  $tempatLahir = $_POST['tempat_lahir'];
  $tanggalLahir = $_POST['tanggal_lahir'];
  $alamat = $_POST['alamat'];

  // Query untuk memperbarui data admin
  $sql = "UPDATE admin SET nama = '$nama', nik = '$nik', tempat_lahir = '$tempatLahir', tanggal_lahir = '$tanggalLahir', alamat = '$alamat' WHERE id = 1";

  // Jalankan query
  if (mysqli_query($conn, $sql)) {
    // Redirect ke halaman profile.php setelah memperbarui data
    header('Location: profile.php');
    exit();
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}

// Mengambil data admin
$sql = "SELECT * FROM admin WHERE id = 1";
$result = mysqli_query($conn, $sql);
$admin = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>
