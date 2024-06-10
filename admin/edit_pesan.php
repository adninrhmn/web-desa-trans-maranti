<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Periksa apakah parameter id pesan telah diberikan
if (!isset($_GET['id'])) {
  header('Location: contact.php');
  exit();
}

// Ambil id pesan dari parameter
$id = $_GET['id'];

// Query untuk mengambil informasi pesan berdasarkan id
$query = "SELECT * FROM pesan WHERE id = $id"; // Ubah "pesan" sesuai dengan nama tabel yang tepat
$result = mysqli_query($koneksi, $query);

// Periksa apakah pesan ditemukan
if (mysqli_num_rows($result) == 0) {
  header('Location: contact.php');
  exit();
}

// Ambil data pesan
$row = mysqli_fetch_assoc($result);
$nama = $row['nama'];
$email = $row['email'];
$pesan = $row['pesan'];

// Periksa apakah form telah disubmit
if (isset($_POST['submit'])) {
  // Ambil data dari form
  $namaBaru = $_POST['nama'];
  $emailBaru = $_POST['email'];
  $pesanBaru = $_POST['pesan'];

  // Query untuk mengupdate pesan
  $queryUpdate = "UPDATE pesan SET nama = '$namaBaru', email = '$emailBaru', pesan = '$pesanBaru' WHERE id = $id";
  $resultUpdate = mysqli_query($koneksi, $queryUpdate);

  if ($resultUpdate) {
    header('Location: contact.php');
    exit();
  } else {
    echo 'Error saat mengupdate pesan.';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Pesan - Admin Panel</title>
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
      <h2 class="contact-title">Edit Pesan</h2>
      <form method="POST">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama:</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="mb-3">
          <label for="pesan" class="form-label">Pesan:</label>
          <textarea class="form-control" id="pesan" name="pesan"><?php echo $pesan; ?></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <a href="contact.php" class="btn btn-secondary">Batal</a>
      </form>
    </section>
  </div>

  <footer class="mt-5">
    <div class="container">
      <p>&copy; <?php echo date('Y'); ?>. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
