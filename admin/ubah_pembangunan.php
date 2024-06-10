<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Periksa apakah parameter id_program_pembangunan telah diberikan
if (!isset($_GET['id_program_pembangunan'])) {
  header('Location: dashboard.php');
  exit();
}

// Ambil nilai parameter id_program_pembangunan
$id_program_pembangunan = $_GET['id_program_pembangunan'];

// Query untuk mengambil informasi program pembangunan berdasarkan id_program_pembangunan
$query = "SELECT * FROM program_pembangunan WHERE id_program_pembangunan = '$id_program_pembangunan'";
$result = mysqli_query($koneksi, $query);

// Periksa apakah program pembangunan dengan id_program_pembangunan tersebut ada
if (mysqli_num_rows($result) == 0) {
  header('Location: dashboard.php');
  exit();
}

// Ambil data program pembangunan
$data = mysqli_fetch_assoc($result);

// Variabel untuk menyimpan pesan error
$error = '';

// Periksa apakah form telah di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Ambil data yang di-submit
  $program_pembangunan = $_POST['program_pembangunan'];
  $anggaran = $_POST['anggaran'];
  $status = $_POST['status'];

  // Periksa apakah ada file gambar yang di-upload
  if (isset($_FILES['gambar_kegiatan'])) {
    $gambar_kegiatan = $_FILES['gambar_kegiatan'];

    // Periksa apakah file gambar valid
    if ($gambar_kegiatan['error'] === 0) {
      $gambar_name = $gambar_kegiatan['name'];
      $gambar_tmp = $gambar_kegiatan['tmp_name'];
      $gambar_size = $gambar_kegiatan['size'];

      // Periksa ekstensi file gambar
      $ext = pathinfo($gambar_name, PATHINFO_EXTENSION);
      $allowed_ext = array('jpg', 'jpeg', 'png');

      if (!in_array($ext, $allowed_ext)) {
        $error = 'Ekstensi file gambar tidak valid. Harap upload file dengan ekstensi JPG, JPEG, atau PNG.';
      }

     // Periksa ukuran file gambar
$max_size = 10 * 1024 * 1024; // 10MB
if ($gambar_size > $max_size) {
  $error = 'Ukuran file gambar terlalu besar. Harap upload file dengan ukuran maksimal 10MB.';
}


      // Jika tidak ada error, upload gambar
      if (empty($error)) {
        move_uploaded_file($gambar_tmp, '../upload/' . $gambar_name);

        // Update data program pembangunan dengan gambar baru
        $query = "UPDATE program_pembangunan SET program_pembangunan = '$program_pembangunan', anggaran = '$anggaran', status = '$status', gambar_kegiatan = '$gambar_name' WHERE id_program_pembangunan = '$id_program_pembangunan'";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
          // Redirect ke halaman dashboard setelah berhasil mengubah program pembangunan
          header('Location: public_services.php');
          exit();
        } else {
          $error = 'Terjadi kesalahan. Silakan coba lagi.';
        }
      }
    }
  } else {
    // Update data program pembangunan tanpa mengubah gambar
    $query = "UPDATE program_pembangunan SET program_pembangunan = '$program_pembangunan', anggaran = '$anggaran', status = '$status' WHERE id_program_pembangunan = '$id_program_pembangunan'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
      // Redirect ke halaman dashboard setelah berhasil mengubah program pembangunan
      header('Location: public_services.php');
      exit();
    } else {
      $error = 'Terjadi kesalahan. Silakan coba lagi.';
    }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Ubah Program Pembangunan - Admin Panel</title>
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
      <h2 class="section-title">Ubah Program Pembangunan</h2>
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="program_pembangunan" class="form-label">Program Pembangunan</label>
          <input type="text" class="form-control" id="program_pembangunan" name="program_pembangunan" value="<?php echo $data['program_pembangunan']; ?>" required>
        </div>
        <div class="mb-3">
          <label for="anggaran" class="form-label">Anggaran</label>
          <input type="text" class="form-control" id="anggaran" name="anggaran" value="<?php echo $data['anggaran']; ?>" required>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <input type="text" class="form-control" id="status" name="status" value="<?php echo $data['status']; ?>" required>
        </div>
        <div class="mb-3">
          <label for="gambar_kegiatan" class="form-label">Gambar Kegiatan</label>
          <input type="file" class="form-control" id="gambar_kegiatan" name="gambar_kegiatan">
        </div>
        <?php if (!empty($error)): ?>
          <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Ubah</button>
        <a href="public_services.php" class="btn btn-secondary">Batal</a>
      </form>
    </section>
  </div>

  <footer>
    <!-- Kode footer lainnya -->
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
