<?php
// File koneksi database
include 'includes/db.php';

// Mengecek apakah ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai inputan dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];

    // Mengeksekusi query untuk menyimpan data ke tabel pesan
    $query = "INSERT INTO pesan (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";
    $result = mysqli_query($koneksi, $query);

    // Menampilkan pesan berhasil atau gagal
    if ($result) {
        echo "Pesan berhasil dikirim!";
        echo "<br>";
        echo "<a href='index.php'>Kembali ke halaman utama</a>";
        exit(); // Menghentikan eksekusi script
    } else {
        echo "Terjadi kesalahan saat mengirim pesan.";
    }
}
?>
