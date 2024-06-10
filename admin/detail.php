<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Periksa apakah parameter id telah diberikan
if (!isset($_GET['id'])) {
  header('Location: population.php');
  exit();
}

// Ambil ID penduduk dari parameter
$id = $_GET['id'];

// Query untuk mendapatkan data penduduk berdasarkan ID
$query = "SELECT * FROM penduduk_desa WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

// Periksa apakah data ditemukan
if (mysqli_num_rows($result) === 0) {
  header('Location: population.php');
  exit();
}

// Ambil data penduduk
$penduduk = mysqli_fetch_assoc($result);

// Tutup koneksi database
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Detail Penduduk - Admin Panel</title>
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
    text-align: left;
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
    <h2 class="section-title">Detail Penduduk</h2>
    <table class="table">
      <tbody>
        <tr>
          <th>ID</th>
          <td><?php echo $penduduk['id']; ?></td>
        </tr>
        <tr>
          <th>Nama</th>
          <td><?php echo $penduduk['nama']; ?></td>
        </tr>
        <tr>
          <th>NIK</th>
          <td><?php echo $penduduk['NIK']; ?></td>
        </tr>
        <tr>
          <th>Jenis Kelamin</th>
          <td><?php echo $penduduk['jenis_kelamin']; ?></td>
        </tr>
        <tr>
          <th>Tanggal Lahir</th>
          <td><?php echo $penduduk['tanggal_lahir']; ?></td>
        </tr>
        <tr>
          <th>Tempat Lahir</th>
          <td><?php echo $penduduk['tempat_lahir']; ?></td>
        </tr>
        <tr>
          <th>Alamat</th>
          <td><?php echo $penduduk['alamat']; ?></td>
        </tr>
        <tr>
          <th>Status Perkawinan</th>
          <td><?php echo $penduduk['status_perkawinan']; ?></td>
        </tr>
        <tr>
          <th>Pekerjaan</th>
          <td><?php echo $penduduk['pekerjaan']; ?></td>
        </tr>
        <tr>
          <th>Pendidikan</th>
          <td><?php echo $penduduk['pendidikan']; ?></td>
        </tr>
        <tr>
          <th>Kewarganegaraan</th>
          <td><?php echo $penduduk['kewarganegaraan']; ?></td>
        </tr>
        <tr>
          <th>Agama</th>
          <td><?php echo $penduduk['agama']; ?></td>
        </tr>
        <tr>
          <th>Etnis/Suku</th>
          <td><?php echo $penduduk['etnis_suku']; ?></td>
        </tr>
        <tr>
          <th>Status Kependudukan</th>
          <td><?php echo $penduduk['status_kependudukan']; ?></td>
        </tr>
      </tbody>
    </table>
    <a href="population.php" class="btn btn-secondary">Kembali</a>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
