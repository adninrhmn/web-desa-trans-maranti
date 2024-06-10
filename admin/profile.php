<?php
// File koneksi database
include '../includes/db.php';

// Periksa apakah pengguna telah login sebagai admin
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

// Query untuk mengambil informasi desa dari tabel profil
$query = "SELECT * FROM profil";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profil Desa - Admin Panel</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.6.0/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Font+Name&display=swap">
  <style>
    body {
      padding-top: 20px;
      font-family: 'Times New Roman', sans-serif;
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

    .profile-item {
      margin-bottom: 10px;
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

.profile-title {
    margin-top: 80px; /* Sesuaikan jarak dengan header */
  }
     p {
    text-align: justify;
    text-justify: inter-word;
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
      <h2 class="profile-title">Profil Desa</h2>
      <div class="profile-item">
        <label for="namaDesa" class="form-label">Nama Desa:</label>
        <input type="text" id="namaDesa" class="form-control" value="<?php echo $row['nama_desa']; ?>" disabled>
      </div>
      <div class="profile-item">
        <label for="alamat" class="form-label">Alamat:</label>
        <input type="text" id="alamat" class="form-control" value="<?php echo $row['alamat']; ?>" disabled>
      </div>
      <div class="profile-item">
        <label for="kodePos" class="form-label">Kode Pos:</label>
        <input type="text" id="kodePos" class="form-control" value="<?php echo $row['kode_pos']; ?>" disabled>
      </div>
    </section>

    <section>
      <h2 class="profile-title">Sejarah Desa</h2>
      <section>
  <p>
    Selamat datang di halaman Sejarah Desa Trans Maranti! Desa Trans Maranti, yang terletak di Kecamatan Teupah Selatan, Kabupaten Simeulue, memiliki sejarah yang menarik yang telah membentuk kehidupan dan budaya di wilayah ini. Sebagai pusat perdagangan dan pertukaran budaya sejak zaman dahulu, Desa Trans Maranti menjadi tempat penting di Simeulue. Nama "Trans Maranti" sendiri mengacu pada perjalanan dan perahu tradisional yang digunakan oleh penduduk setempat. Desa ini juga dikenal dengan kegiatan nelayannya yang berpengalaman dan keterampilan dalam menjaring ikan di perairan sekitar. Dengan kekayaan sejarah dan budaya yang dimiliki, Desa Trans Maranti menawarkan pengalaman yang unik bagi pengunjung yang ingin menjelajahi warisan budaya dan keindahan alam yang menakjubkan. Selamat menikmati cerita menarik dari Desa Trans Maranti!
  </p>
</section>

<section>
  <h2 class="profile-title">Visi Desa</h2>
  <p>
    Visi Desa Trans Maranti adalah menjadi desa yang maju, berkelanjutan, dan berbudaya. Desa ini bertujuan untuk menciptakan kesejahteraan masyarakat dengan pembangunan ekonomi yang berkelanjutan, peningkatan akses terhadap layanan dasar, serta pelestarian budaya dan warisan lokal.
  </p>
</section>

<section>
  <h2 class="profile-title">Misi Desa</h2>
  <ol>
    <li>Mengembangkan ekonomi lokal yang berkelanjutan.</li>
    <li>Meningkatkan akses dan kualitas layanan dasar bagi masyarakat.</li>
    <li>Melestarikan budaya dan warisan lokal.</li>
    <li>Melindungi dan menjaga lingkungan alam.</li>
    <li>Mendorong partisipasi aktif masyarakat dalam pengambilan keputusan dan pembangunan desa.</li>
    <li>Menggalakkan keterlibatan dan kemitraan dengan pihak eksternal untuk mendukung pembangunan desa.</li>
    <li>Meningkatkan kualitas infrastruktur dan fasilitas desa.</li>
    <li>Memperkuat kapasitas masyarakat dalam hal pengetahuan, keterampilan, dan pendidikan.</li>
    <li>Meningkatkan kesadaran akan pentingnya kebersihan, kesehatan, dan sanitasi.</li>
    <li>Meningkatkan keamanan dan ketertiban di desa melalui penguatan keamanan masyarakat.</li>
  </ol>
</section>

    </section>

    <section>
      <h2 class="profile-title">Struktur Organisasi Pemerintah Desa</h2>
      <div class="text-center">
  <?php
  $queryGambar = "SELECT * FROM gambar_struktur ORDER BY id DESC LIMIT 1";
  $resultGambar = mysqli_query($koneksi, $queryGambar);
  if (mysqli_num_rows($resultGambar) > 0) {
    $rowGambar = mysqli_fetch_assoc($resultGambar);
    $gambarPath = $rowGambar['path_file'];
    $gambarNama = $rowGambar['nama_file'];
    echo "<img src='$gambarPath' alt='$gambarNama' style='max-width: 100%;'>";
  }
  ?>
  <div class="mt-3">
    <a href="ubah_gambar.php" class="btn btn-primary">Ubah Gambar</a>
    <a href="hapus_gambar.php" class="btn btn-danger">Hapus Gambar</a>
  </div>
</div>

    </section>

    <form method="POST" action="upload_gambar.php" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="gambarStruktur" class="form-label">Gambar Struktur:</label>
    <input type="file" id="gambarStruktur" name="gambarStruktur" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Upload</button>
</form>


    <section>
      <h2 class="profile-title">Data Desa</h2>

      <a href="tambah_desa.php" class="btn btn-primary">Tambah Data Desa</a>
      
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Desa</th>
            <th>Alamat</th>
            <th>Kode Pos</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          mysqli_data_seek($result, 0); // Mengatur kursor ke awal hasil query sebelum mengulanginya
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $row['nama_desa']; ?></td>
              <td><?php echo $row['alamat']; ?></td>
              <td><?php echo $row['kode_pos']; ?></td>
              <td>
                <a href="detail_desa.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Detail</a>
                <a href="edit_desa.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Ubah</a>
                <a href="hapus_desa.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Hapus</a>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
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
