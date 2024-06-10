<?php
// File ubah_gambar_admin.php

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Periksa apakah file gambar telah diunggah
if (isset($_FILES['gambar'])) {
  $file = $_FILES['gambar'];

  // Periksa apakah terjadi error pada file
  if ($file['error'] === 0) {
    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];

    // Pindahkan file yang diunggah ke direktori tujuan
    $destination = '../images/' . $fileName;
    if (move_uploaded_file($fileTmp, $destination)) {
      // Update field gambar di tabel biodata_admin
      $query = "UPDATE biodata_admin SET gambar = '$fileName'";
      mysqli_query($koneksi, $query);

      // Redirect ke halaman profil admin
      header('Location: index.php');
      exit();
    } else {
      echo "Gagal mengunggah file.";
    }
  } else {
    echo "Error: " . $file['error'];
  }
}
?>
