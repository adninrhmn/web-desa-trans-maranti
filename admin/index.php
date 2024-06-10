<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
header('Location: login.php');
exit();
}

// Memeriksa koneksi ke database
if (!$koneksi) {
die("Koneksi database gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data admin
$query = "SELECT * FROM biodata_admin";
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
  <title>Profil Admin - Admin Panel</title>
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

    footer {
      background-color: #303030;
      color: #ffffff;
      padding: 20px 0;
    }

    .contact-title {
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
      vertical-align: middle;
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
      background-color: rgba(38, 208, 201, 0.9);
    }

    .dashboard-modules .module.population {
      background-color: rgba(38, 208, 201, 0.9);
    }

    .dashboard-modules .module.services {
      background-color: rgba(38, 208, 201, 0.9);
    }

    .dashboard-modules .module h4 {
      margin-top: 0;
      margin-bottom: 10px;
    }

    .dashboard-modules .module p {
      margin-bottom: 0;
    }

    .oke {
      text-align: center;
    }

    .me {
      font-size: 20px;
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
    <div class="dashboard-title">
      <h2 class="contact-title">Selamat Datang di Admin Panel</h2>
      <p>Anda dapat mengelola berbagai fitur dan konten pada halaman ini.</p>
    </div>

    <div class="dashboard-modules">
      <div class="module profile">
        <h4 class="oke"><b>Profil Admin</b></h4>
        <div class="row">
          <div class="col-md-4">
            <?php
            if (!empty($admin['gambar'])) {
            $gambarAdmin = '../images/' . $admin['gambar'];
            echo '<img src="' . $gambarAdmin . '" alt="Foto Admin" class="img-fluid rounded-circle">';
          } else {
          echo '<img src="../images/default.jpg" alt="Foto Admin" class="img-fluid rounded-circle">';
        }
        ?>
        <div class="mt-3">
          <form action="upload_foto_admin.php" method="post" enctype="multipart/form-data">
            <input type="file" name="foto" accept="image/jpeg, image/png">
            <input type="submit" value="Upload Gambar" class="btn btn-primary mt-2">
          </form>
        </div>
        <?php if (!empty($admin['gambar'])): ?>
        <div class="mt-3">
          <form action="hapus_gambar_admin.php" method="post">
            <input type="submit" value="Hapus Gambar" class="btn btn-danger mt-2">
          </form>
        </div>
        <?php endif; ?>
      </div>
      <div class="col-md-8">
        <h4 class="oke"><b><u>Biodata Admin</u></b></h4>
        <p class="me"><strong>Nama:</strong> <?php echo $admin['nama']; ?></p>
        <p class="me"><strong>NIK:</strong> <?php echo $admin['nik']; ?></p>
        <p class="me"><strong>Tempat Tanggal Lahir:</strong> <?php echo $admin['tempat_lahir'].', '.$admin['tanggal_lahir']; ?></p>
        <p class="me"><strong>Jenis Kelamin:</strong> <?php echo $admin['jenis_kelamin']; ?></p>
        <p class="me"><strong>Alamat:</strong> <?php echo $admin['alamat']; ?></p>
        <div class="form-group">
          <div class="text-end">
            <a href="ubah_biodata_admin.php?id=<?php echo $admin['id']; ?>" class="btn btn-warning">Ubah</a>
            <a href="hapus_biodata_admin.php?id=<?php echo $admin['id']; ?>" class="btn btn-danger">Hapus</a>
          </div>
        </div>
        <h4 class="oke"><b><u>Ubah Password</u></b></h4>
        <form action="ubah_password_admin.php" method="post">
          <div class="form-group">
            <label for="password_lama">Password Lama:</label>
            <input type="password" name="password_lama" id="password_lama" class="form-control" required>
          </div>
          <div class="form-group" method="post">
            <label for="verifikasi_password_lama">Verifikasi Password Lama:</label>
            <input type="password" name="verifikasi_password_lama" id="verifikasi_password_lama" class="form-control" required>
          </div>
          <div class="form-group" method="post">
            <label for="password_baru">Password Baru:</label>
            <input type="password" name="password_baru" id="password_baru" class="form-control" required>
          </div>
          <div class="form-group" method="post">
            <label for="verifikasi_password_baru">Verifikasi Password Baru:</label>
            <input type="password" name="verifikasi_password_baru" id="verifikasi_password_baru" class="form-control" required>
          </div>

          <div class="form-group">
            <div class="text-end">
              <input type="submit" value="Ubah Password" class="btn btn-warning mt-2">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<footer class="mt-5">
    <div class="container">
      <div class="row text-white">
        <div class="col-md-5 d-flex align-items-center">
          <img class="" src="../images/himatif.png" alt="Logo Desa" width="50" height="50">
          <div class="ms-3">
            <p class="m-0">&copy; <?php echo date('Y'); ?> <b>PemDes Trans Maranti</b></p>
          </div>
        </div>
        <div class="col-md-7 d-flex align-items-center justify-content-end">
          <div class="row">
            <div class="col-md-6">
              <p class="text-left"><b>Panel</b></p>
              <ul class="list-unstyled text-white">
                <li><a href="dashboard.php"><i class="bi bi-house"></i> Dashboard</a></li>
                <li><a href="profile.php"><i class="bi bi-person-fill"></i> Profil Desa</a></li>
                <li><a href="population.php"><i class="bi bi-people-fill"></i> Penduduk</a></li>
                <li><a href="public_services.php"><i class="bi bi-card-checklist"></i> Layanan</a></li>
                <li><a href="contact.php"><i class="bi bi-chat-dots-fill"></i> Hubungi Kami</a></li>
              </ul>
            </div>
            <div class="col-md-6">
              <p class="text-left"><b>Kontak Desa</b></p>
              <ul class="list-unstyled">
                <li><i class="bi bi-envelope-fill"></i> TrnsMrnti@gmail.com</li>
                <li><i class="bi bi-whatsapp"></i> WA : 082274611265</li>
                <li><i class="bi bi-facebook"></i> Facebook Pemdes Trans Maranti</li>
                <li><i class="bi bi-phone"></i> No HP : 082274611265</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
