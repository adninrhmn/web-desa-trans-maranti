<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Jika tombol submit ditekan
if (isset($_POST['submit'])) {
  // Ambil data dari form
  $nama = $_POST['nama'];
  $NIK = $_POST['NIK'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $tempat_lahir = $_POST['tempat_lahir'];
  $alamat = $_POST['alamat'];
  $status_perkawinan = $_POST['status_perkawinan'];
  $pekerjaan = $_POST['pekerjaan'];
  $pendidikan = $_POST['pendidikan'];
  $kewarganegaraan = $_POST['kewarganegaraan'];
  $agama = $_POST['agama'];
  $etnis_suku = $_POST['etnis_suku'];
  $status_kependudukan = $_POST['status_kependudukan'];

  // Query untuk menambahkan data penduduk ke tabel penduduk_desa
  $query = "INSERT INTO penduduk_desa (nama, NIK, jenis_kelamin, tanggal_lahir, tempat_lahir, alamat, status_perkawinan, pekerjaan, pendidikan, kewarganegaraan, agama, etnis_suku, status_kependudukan) 
            VALUES ('$nama', '$NIK', '$jenis_kelamin', '$tanggal_lahir', '$tempat_lahir', '$alamat', '$status_perkawinan', '$pekerjaan', '$pendidikan', '$kewarganegaraan', '$agama', '$etnis_suku', '$status_kependudukan')";

  // Eksekusi query
  if (mysqli_query($koneksi, $query)) {
    // Redirect ke halaman data penduduk setelah berhasil ditambahkan
    header('Location: population.php');
    exit();
  } else {
    // Tampilkan pesan error jika query tidak berhasil dieksekusi
    echo "Error: " . mysqli_error($koneksi);
  }
}

// Tutup koneksi database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Data Penduduk - Admin Panel</title>
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
    vertical-align: middle;
  }

  table td img {
    width: 100%;
    height: auto;
    max-height: 100px; /* Atur tinggi maksimum gambar */
    object-fit: cover;
  }

  .table img {
    max-width: 100%;
    height: auto;
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
    <h2 class="section-title">Tambah Data Penduduk</h2>
    <form method="post">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
      </div>
      <div class="mb-3">
        <label for="NIK" class="form-label">NIK</label>
        <input type="text" class="form-control" id="NIK" name="NIK" required>
      </div>
      <div class="mb-3">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
      </div>
      <div class="mb-3">
        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
      </div>
      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
      </div>
      <div class="mb-3">
        <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
        <select class="form-select" id="status_perkawinan" name="status_perkawinan" required>
          <option value="Belum Menikah">Belum Menikah</option>
          <option value="Menikah">Menikah</option>
          <option value="Cerai">Cerai</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="pekerjaan" class="form-label">Pekerjaan</label>
        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
      </div>
      <div class="mb-3">
        <label for="pendidikan" class="form-label">Pendidikan</label>
        <input type="text" class="form-control" id="pendidikan" name="pendidikan" required>
      </div>
      <div class="mb-3">
        <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
        <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan" required>
      </div>
      <div class="mb-3">
        <label for="agama" class="form-label">Agama</label>
        <input type="text" class="form-control" id="agama" name="agama" required>
      </div>
      <div class="mb-3">
        <label for="etnis_suku" class="form-label">Etnis/Suku</label>
        <input type="text" class="form-control" id="etnis_suku" name="etnis_suku" required>
      </div>
      <div class="mb-3">
        <label for="status_kependudukan" class="form-label">Status Kependudukan</label>
        <select class="form-select" id="status_kependudukan" name="status_kependudukan" required>
          <option value="Penduduk Tetap">Penduduk Tetap</option>
          <option value="Penduduk Sementara">Penduduk Sementara</option>
        </select>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
    </form>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
