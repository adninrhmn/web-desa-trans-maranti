<?php
// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Cek apakah ada file yang diunggah
if (isset($_FILES['gambar_profil'])) {
  $file = $_FILES['gambar_profil'];

  // Ambil informasi file yang diunggah
  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];
  $fileSize = $file['size'];
  $fileError = $file['error'];

  // Periksa apakah ada kesalahan saat mengunggah
  if ($fileError === 0) {
    // Tentukan direktori tujuan untuk menyimpan gambar profil
    $uploadDir = '../uploads/profile/';
    // Buat nama file unik dengan menggabungkan timestamp dengan nama file asli
    $uniqueFileName = time() . '_' . $fileName;
    // Tentukan path lengkap file yang akan disimpan
    $uploadPath = $uploadDir . $uniqueFileName;

    // Pindahkan file yang diunggah ke direktori tujuan
    if (move_uploaded_file($fileTmpName, $uploadPath)) {
      // File berhasil diunggah, lakukan langkah lain yang diperlukan (misalnya update database, tampilkan pesan sukses, dll.)
      // ...

      // Redirect ke halaman profile.php setelah mengunggah gambar profil
      header('Location: profile.php');
      exit();
    } else {
      // Gagal memindahkan file, tampilkan pesan error
      $errorMessage = 'Terjadi kesalahan saat mengunggah file. Silakan coba lagi.';
    }
  } else {
    // Kesalahan saat mengunggah file, tampilkan pesan error
    $errorMessage = 'Terjadi kesalahan saat mengunggah file. Silakan coba lagi.';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel - Upload Gambar Profil</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <!-- ... (kode navbar lainnya) ... -->
    </nav>
  </header>

  <main class="container py-4">
    <section>
      <h2>Upload Gambar Profil</h2>
      <!-- Form untuk mengunggah gambar profil -->
      <form action="upload.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="gambar_profil" class="form-label">Pilih gambar profil:</label>
          <input type="file" name="gambar_profil" class="form-control" id="gambar_profil">
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
      </form>

      <?php if (isset($errorMessage)): ?>
        <div class="alert alert-danger mt-3"><?php echo $errorMessage; ?></div>
      <?php endif; ?>
    </section>
  </main>

  <footer class="bg-dark text-light py-3 mt-auto">
    <div class="container text-center">
      <!-- ... (kode footer lainnya) ... -->
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
