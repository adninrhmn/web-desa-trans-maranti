<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Memeriksa apakah ada parameter ID pada URL
if (!isset($_GET['id'])) {
  header('Location: profile.php');
  exit();
}

$id = $_GET['id'];

// Memeriksa apakah ada permintaan pengubahan data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Ambil data yang dikirim melalui form
  $nama = $_POST['nama'];
  $nik = $_POST['nik'];
  $tempat_lahir = $_POST['tempat_lahir'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $alamat = $_POST['alamat'];

  // Query untuk mengubah data admin
  $query = "UPDATE biodata_admin SET nama='$nama', nik='$nik', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin', alamat='$alamat' WHERE id=$id";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    // Redirect ke halaman profil admin setelah berhasil mengubah data
    header('Location: index.php');
    exit();
  } else {
    echo "Gagal mengubah data admin. Silakan coba lagi.";
  }
}

// Query untuk mengambil data admin berdasarkan ID
$query = "SELECT * FROM biodata_admin WHERE id=$id";
$result = mysqli_query($koneksi, $query);

// Memeriksa apakah data admin ditemukan
if (mysqli_num_rows($result) > 0) {
  $admin = mysqli_fetch_assoc($result);
} else {
  echo "Data admin tidak ditemukan.";
}

// Menutup koneksi ke database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Ubah Biodata Admin - Admin Panel</title>
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
    <h2 class="section-title">Ubah Biodata Admin</h2>
    <form method="POST">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $admin['nama']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="nik" class="form-label">NIK</label>
        <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $admin['nik']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo $admin['tempat_lahir']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $admin['tanggal_lahir']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
          <option value="Laki-laki" <?php if ($admin['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
          <option value="Perempuan" <?php if ($admin['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" required><?php echo $admin['alamat']; ?></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
