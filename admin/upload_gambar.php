<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// ...
if (isset($_FILES['gambarStruktur'])) {
  $file = $_FILES['gambarStruktur'];
  $fileName = $file['name'];
  $fileTmpPath = $file['tmp_name'];
  $fileError = $file['error'];

  // Cek apakah tidak ada error pada unggahan file
  if ($fileError === UPLOAD_ERR_OK) {
    // Tentukan direktori tujuan untuk menyimpan gambar
    $uploadDir = '../images/';
    $uploadPath = $uploadDir . $fileName;

    // Pindahkan file yang diunggah ke direktori tujuan
    if (move_uploaded_file($fileTmpPath, $uploadPath)) {
      // Simpan informasi gambar ke database
      $insertQuery = "INSERT INTO gambar_struktur (nama_file, path_file) VALUES ('$fileName', '$uploadPath')";
      mysqli_query($koneksi, $insertQuery);

      // Arahkan pengguna ke profile.php setelah proses selesai
      header('Location: profile.php');
      exit();
    } else {
      echo "Gagal mengunggah gambar.";
    }
  } else {
    echo "Terjadi kesalahan saat mengunggah gambar.";
  }
  
}
// ...
?>
