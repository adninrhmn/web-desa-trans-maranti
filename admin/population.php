<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Query untuk mengambil data penduduk dari tabel penduduk_desa
$query = "SELECT * FROM penduduk_desa";
$result = mysqli_query($koneksi, $query);


function calculateAge($birthdate) {
  $birthDate = new DateTime($birthdate);
  $today = new DateTime();
  $age = $today->diff($birthDate)->y;
  return $age;
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Penduduk - Admin Panel</title>
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

.penduduk {
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
    .container-ku {
      max-width: 100%;
      padding-right: 15px;
      padding-left: 15px;
      margin-right: auto;
      margin-left: auto;
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

  <div class="container-ku">
    <section>
      <h2 class="penduduk">Data Penduduk</h2>
      <div class="mb-3">
        <a href="add_data.php" class="btn btn-primary">Tambah Data</a>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>NIK</th>
              <th>Tempat/Tanggal Lahir</th>
              <th>Umur</th>
              <th>Alamat</th>
              <th>Jenis Kelamin</th>
              <th>Pekerjaan</th>
              <th>Pendidikan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['NIK']; ?></td>
                <td><?php echo $row['tempat_lahir'] . '/' . $row['tanggal_lahir']; ?></td>
                <td><?php echo calculateAge($row['tanggal_lahir']); ?></td>
                <td><?php echo $row['alamat']; ?></td>
                <td><?php echo $row['jenis_kelamin']; ?></td>
                <td><?php echo $row['pekerjaan']; ?></td>
                <td><?php echo $row['pendidikan']; ?></td>
                <td>
                  <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Detail</a>
                  <a href="edit_data.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Ubah</a>
                  <a href="delete_data.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Hapus</a>
                </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </section>
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

<?php
// Tutup koneksi database
mysqli_close($koneksi);
?>
