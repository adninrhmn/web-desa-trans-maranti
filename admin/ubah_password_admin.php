<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Memeriksa koneksi ke database
if (!$koneksi) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}

// Mengambil id admin dari sesi
$admin_id = $_SESSION['admin']['id'];

// Query untuk mengambil data admin berdasarkan id
$query = "SELECT * FROM admin WHERE id = $admin_id";
$result = mysqli_query($koneksi, $query);

// Memeriksa apakah data admin ditemukan
if ($result && mysqli_num_rows($result) > 0) {
  $admin = mysqli_fetch_assoc($result);

  // Memeriksa apakah form ubah password disubmit
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data password dari form
    $password_baru = $_POST['password_baru'];
    $verifikasi_password_baru = $_POST['verifikasi_password_baru'];

    // Memeriksa apakah verifikasi password baru cocok
    if ($password_baru !== $verifikasi_password_baru) {
      echo "Verifikasi password baru tidak cocok.";
    } else {
  // Mengenkripsi password baru
  $password_md5 = md5($password_baru);

  // Query untuk mengupdate password admin
  $update_query = "UPDATE admin SET password = '$password_md5' WHERE id = $admin_id";
  $update_result = mysqli_query($koneksi, $update_query);

  if ($update_result) {
    echo "Password berhasil diubah.";
  } else {
    echo "Terjadi kesalahan saat mengubah password.";
  }
}

  }
} else {
  echo "Data admin tidak ditemukan.";
}

// Menutup koneksi ke database
mysqli_close($koneksi);
?>
