<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Periksa apakah parameter id_wisata telah diberikan
if (!isset($_GET['id_wisata'])) {
  header('Location: public_services.php');
  exit();
}

// Ambil informasi wisata lokal berdasarkan id_wisata
$id_wisata = $_GET['id_wisata'];
$query = "SELECT * FROM wisata_lokal WHERE id_wisata = $id_wisata";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

// Periksa apakah data wisata lokal ditemukan
if (!$row) {
  header('Location: public_services.php');
  exit();
}

// Proses update data wisata lokal
if (isset($_POST['submit'])) {
  $alamat = $_POST['alamat'];

  // Periksa apakah gambar baru diupload
  if (!empty($_FILES['gambar']['tmp_name'])) {
    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];

    // Pindahkan gambar ke folder upload
    move_uploaded_file($gambar_tmp, '../upload/' . $gambar);

    // Update data wisata lokal dengan gambar baru
    $query = "UPDATE wisata_lokal SET gambar = '$gambar', alamat = '$alamat' WHERE id_wisata = $id_wisata";
  } else {
    // Update data wisata lokal tanpa mengubah gambar
    $query = "UPDATE wisata_lokal SET alamat = '$alamat' WHERE id_wisata = $id_wisata";
  }

  $result = mysqli_query($koneksi, $query);

  if ($result) {
    header('Location: public_services.php');
    exit();
  } else {
    $error = "Terjadi kesalahan. Silakan coba lagi.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Wisata Lokal - Admin Panel</title>
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
      <h2 class="section-title">Edit Wisata Lokal</h2>

      <?php if (isset($error)): ?>
      <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php endif; ?>

      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="gambar" class="form-label">Gambar Tempat Wisata</label>
          <input type="file" class="form-control" id="gambar" name="gambar">
          <div class="mt-2">
            <img src="../upload/<?php echo $row['gambar']; ?>" alt="Gambar Wisata" style="max-width: 300px;">
          </div>
        </div>
        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat</label>
          <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
      </form>
    </section>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
