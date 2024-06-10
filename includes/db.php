<?php
// Konfigurasi koneksi ke database
$host = '127.0.0.1:3307'; // Ganti dengan host database Anda
$username = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda
$database = 'db_webdesa'; // Ganti dengan nama database Anda

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $username, $password, $database);

// Memeriksa apakah koneksi berhasil
if (!$koneksi) {
  die('Koneksi database gagal: ' . mysqli_connect_error());
}
