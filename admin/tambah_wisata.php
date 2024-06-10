<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Proses tambah wisata
if (isset($_POST['submit'])) {
  // Tangkap data dari form
  $gambar = $_FILES['gambar']['name'];
  $alamat = $_POST['alamat'];

  // Proses upload gambar
  $target_dir = "../upload/";
  $target_file = $target_dir . basename($gambar);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Cek apakah file gambar
  $check = getimagesize($_FILES['gambar']['tmp_name']);
  if ($check !== false) {
    $uploadOk = 1;
  } else {
    echo "File yang diunggah bukan gambar.";
    $uploadOk = 0;
  }

  // Cek apakah file sudah ada
  if (file_exists($target_file)) {
    echo "Maaf, file sudah ada.";
    $uploadOk = 0;
  }

  // Cek ukuran file
  if ($_FILES['gambar']['size'] > 500000) {
    echo "Maaf, ukuran file terlalu besar.";
    $uploadOk = 0;
  }

  // Format file yang diizinkan
  if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" &&
    $imageFileType != "gif"
  ) {
    echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
    $uploadOk = 0;
  }

  // Cek apakah file diupload
  if ($uploadOk == 0) {
    echo "Maaf, file tidak dapat diunggah.";
  } else {
    // Jika semua kondisi terpenuhi, upload file gambar
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
      // Query untuk tambah informasi wisata lokal ke tabel wisata_lokal
      $query = "INSERT INTO wisata_lokal (gambar, alamat) VALUES ('$gambar', '$alamat')";
      $result = mysqli_query($koneksi, $query);

      if ($result) {
        header('Location: public_services.php');
        exit();
      } else {
        echo "Gagal menambah informasi wisata lokal.";
      }
    } else {
      echo "Maaf, terjadi kesalahan saat mengunggah file.";
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Informasi Wisata Lokal - Admin Panel</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.6.0/font/bootstrap-icons.min.css">
  <!-- atau menggunakan Font Awesome -->
  <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"> -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Font+Name&display=swap">
  <style>
    /* ... kode CSS lainnya ... */
    body {
      padding-top: 20px;
      font-family: 'Times New Roman', sans-serif;
    }
    body {
    background-image: url('../images/saya.png'); /* Ganti 'nama_gambar.jpg' dengan nama dan ekstensi gambar Anda */
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
  }

   header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 999;
}

.section-title {
    margin-top: 80px; /* Sesuaikan jarak dengan header */
  }
     table {
      width: 100%;
      margin-bottom: 20px;
      border-collapse: collapse;
    }
    table th,
table td {
  padding: 8px;
  border: 1px solid #000;
  text-align: center;
}

    .container {
      max-width: 800px;
    }
    .dashboard-title {
      margin-bottom: 20px;
    }
    .dashboard-modules {
      margin-top: 40px;
    }
    .dashboard-modules .module {
      padding: 20px;
      border-radius: 5px;
      margin-bottom: 20px;
    }
    .dashboard-modules .module a {
      color: #fff;
      text-decoration: none;
    }
    .dashboard-modules .module.profile {
      background-color: #007bff;
    }
    .dashboard-modules .module.population {
      background-color: #28a745;
    }
    .dashboard-modules .module.services {
      background-color: #dc3545;
    }
    .dashboard-modules .module h4 {
      margin-top: 0;
      margin-bottom: 10px;
    }
    .dashboard-modules .module p {
      margin-bottom: 0;
    }
  </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php"><i
                                class="bi bi-house"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php"><i class="bi bi-person-fill"></i> Profil Desa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="population.php"><i class="bi bi-people-fill"></i> Data Penduduk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="public_services.php"><i class="bi bi-card-checklist"></i> Layanan
                            Publik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php"><i class="bi bi-chat-dots-fill"></i> Hubungi Kami</a>
                    </li>
                </ul>
                <a href="logout.php" class="btn btn-light">Logout</a>
            </div>
        </div>
    </nav>
</header>
  <div class="container">
    <section>
      <h2 class="section-title">Tambah Informasi Wisata Lokal</h2>

      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="gambar" class="form-label">Gambar Tempat Wisata</label>
          <input type="file" class="form-control" id="gambar" name="gambar" required>
        </div>
        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat</label>
          <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
      </form>
    </section>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
