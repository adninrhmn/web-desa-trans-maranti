<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Inisialisasi variabel
$program_pembangunan = "";
$anggaran = "";
$status = "";
$gambar_kegiatan = "";
$error = "";

// Periksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Ambil nilai dari form
  $program_pembangunan = $_POST["program_pembangunan"];
  $anggaran = $_POST["anggaran"];
  $status = $_POST["status"];

  // Periksa apakah gambar kegiatan telah diupload
  if (isset($_FILES["gambar_kegiatan"])) {
    $file_name = $_FILES["gambar_kegiatan"]["name"];
    $file_size = $_FILES["gambar_kegiatan"]["size"];
    $file_tmp = $_FILES["gambar_kegiatan"]["tmp_name"];
    $file_type = $_FILES["gambar_kegiatan"]["type"];
    $file_ext = strtolower(end(explode('.', $file_name)));
    
    $extensions = array("jpeg","jpg","png");

    if (in_array($file_ext, $extensions) === false) {
      $error = "Ekstensi file tidak diperbolehkan, hanya file JPEG, JPG, dan PNG yang diperbolehkan.";
    }

    if ($file_size > 10485760) { // Ubah nilai 10485760 menjadi 10 MB dalam byte
  $error = "Ukuran file harus kurang dari 10MB.";
}


    if (empty($error) == true) {
      move_uploaded_file($file_tmp, "../upload/" . $file_name);
      $gambar_kegiatan = $file_name;
    }
  }

  // Periksa apakah ada error sebelum melakukan query
  if (empty($error) == true) {
    // Query untuk menambahkan program pembangunan ke database
    $query = "INSERT INTO program_pembangunan (program_pembangunan, anggaran, status, gambar_kegiatan) VALUES ('$program_pembangunan', '$anggaran', '$status', '$gambar_kegiatan')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
      // Redirect ke halaman program pembangunan setelah berhasil ditambahkan
      header("Location: public_services.php");
      exit();
    } else {
      $error = "Terjadi kesalahan. Silakan coba lagi.";
    }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Program Pembangunan - Admin Panel</title>
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
      <h2 class="section-title">Tambah Program Pembangunan</h2>
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="program_pembangunan" class="form-label">Program Pembangunan</label>
          <input type="text" class="form-control" id="program_pembangunan" name="program_pembangunan" value="<?php echo $program_pembangunan; ?>" required>
        </div>
        <div class="mb-3">
          <label for="anggaran" class="form-label">Anggaran</label>
          <input type="text" class="form-control" id="anggaran" name="anggaran" value="<?php echo $anggaran; ?>" required>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <input type="text" class="form-control" id="status" name="status" value="<?php echo $status; ?>" required>
        </div>
        <div class="mb-3">
          <label for="gambar_kegiatan" class="form-label">Gambar Kegiatan</label>
          <input type="file" class="form-control" id="gambar_kegiatan" name="gambar_kegiatan" required>
        </div>
        <?php if (!empty($error)): ?>
          <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </form>
    </section>
  </div>

  <footer>
    <!-- Kode footer lainnya -->
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
