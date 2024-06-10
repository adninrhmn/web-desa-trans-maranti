<?php
// File koneksi database
include 'includes/db.php';

// Query untuk mengambil informasi wisata lokal dari tabel wisata_lokal
$queryWisata = "SELECT * FROM wisata_lokal";
$resultWisata = mysqli_query($koneksi, $queryWisata);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>tampilan beranda</title>
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.6.0/font/bootstrap-icons.min.css">
  <!-- atau menggunakan Font Awesome -->
  <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"> -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Font+Name&display=swap">
  <style>
    /* Reset CSS */
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  /*background-color: #26d0c9;*/
  font-family: "Lucida Grande";
  margin: 0;
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
    .saya{
      padding-top: 160px;
      padding-bottom: 10px;
    }

a {
  text-decoration: none;
}

.clear {
  clear: left;
}

.container {
  width: 100%;
  padding: 0 15px;
  margin: 0 auto;
}

.top-wrapper {
  padding: 180px 0 100px 0;
  background-image: url(gambar/gambarku.jpg);
  background-size: cover;
  color: white;
  text-align: center;
}

.top-wrapper h1 {
  opacity: 0.7;
  font-size: 45px;
  letter-spacing: 5px;
  margin-bottom: 10px;
}

.top-wrapper h2 {
  opacity: 0.7;
  font-size: 40px;
  letter-spacing: 5px;
  margin-bottom: 10px;
}

.top-wrapper p {
  opacity: 0.7;
  margin-bottom: 3px;
}

.section-title {
  border-bottom: 2px solid #dee7ec;
  font-size: 28px;
  padding-bottom: 15px;
  margin-bottom: 50px;
  text-align: center;
}

header {
  height: 145px;
  width: 100%;
  background-color: rgba(38, 208, 201, 0.9);
  position :fixed;
  top: 0;
  z-index: 10;
}

.logo {
  width : 124px;
  float: left;
  padding-top: 10px;
  padding-right: 10px
}

.header-left {
  float: left;
  height: 100px;
  width: 800px;
  color : black;
  font-size: 20px;
  padding: 10px 0;
}


.header-right {
  float: right;
  margin-right: 0;
}


.header-right a {
  line-height: 45px;
  padding: 0 18px;
  color: black;
  display: block;
  float: left;
  transition: all 0.5s;
  font-size: 20px;
}

.header-right a:hover {
  background-color: rgba(255, 255, 255, 0.3);
}

.dropdown {
  position: relative;
  float: left;
}

.dropdown-content {
  margin-top: 45px;
  margin-left: 20px;
  display: none;
  position: absolute;
  z-index: 1;
  background-color: rgba(38, 208, 201, 0.9);
}

.dropdown-content a {
  padding: 5px;
  text-decoration: none;
  color: black;
  min-width: 250px;
  font-size: 15px;
  border-radius: 5px;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.search-form {
  display: inline-block;
  float: right;
  margin-top: 25px;
  padding-right: 10px; /* Tambahkan padding kanan */
}


.search-form input[type="text"] {
  padding: 10px 2px;
  border: none;
  border-radius: 4px;
}

.search-form button {
  padding: 10px 20px;
  background-color: #555;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.container-ku {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin: 20px;
  background-color: rgba(34, 49, 52, 0.9);
}

section.module {
  background-color: #fff;
  width: calc(33.33% - 20px);
  margin: 10px;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.module h2 {
  font-size: 18px;
  margin-bottom: 10px;
}

.content {
  text-align: center;
}

/* Lanjutan CSS */

.content img {
  max-width: 100%;
  height: auto;
  margin-bottom: 10px;
  border-radius: 5px;
}

.content p {
  margin-bottom: 10px;
}

.content a {
  color: #45aaf2;
  text-decoration: none;
}

.btn {
  padding: 12px 24px;
  color: white;
  display: inline-block;
  opacity: 0.8;
  border-radius: 4px;
  text-align: center;
}

.btn:hover {
  opacity: 1;
}

.main {
  padding: 10px 80px;
}

.contact-form input, textarea {
  width : 400px;
  margin-top : 10px;
  margin-bottom : 30px;
  padding : 20px;
  font-size : 18px;
  border : 1px solid #dee7ec;
}

.contact-submit {
  background-color: #239b76;
}

.contact-form {
  margin: 20px 0;
}

.contact-form p {
  margin: 10px 0;
}

.contact-submit {
  padding: 12px 24px;
  color: white;
  display: inline-block;
  opacity: 0.8;
  border-radius: 4px;
  text-align: center;
}

.contact-submit:hover {
  opacity: 1;
}

footer {
  padding: 20px 0;
  height: 50%;
  width: 100%;
  background-color: rgba(34, 49, 52, 0.9);
}

.container-footer {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
  color: white;
}

.footer-content {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
}

.logoku img {
  width: 100px;
  height: 100px;
}

.logoku h3 {
  margin-top: 38px;
  margin-left: 10px;
  color: white;
  float: right;
  font-size: 25px;
}

.links ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.links ul li {
  display: inline-block;
  margin-right: 15px;
}

.links ul li a {
  text-decoration: none;
  color: white;
  font-size: 20px;
}

.contact-footer h3 {
  margin-bottom: 10px;
  text-align: center;
}

.contact-footer ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.contact-footer ul li {
  margin-bottom: 5px;
}

.contact-footer ul li img {
  width: 20px;
  height: 20px;
  margin-right: 5px;
}

.contact-footer ul li a {
  text-decoration: none;
  color: white;
}
  </style>
</head>
<body>
   <header>
  <div class="container">
    <div class="header-left">
      <img class="logo" src="gambar/himatif.png">
      <h1>Sistem Informasi Desa Trans Maranti</h1>
    </div>
    <div class="search-form">
      <form>
        <input type="text" placeholder="Search...">
        <button type="submit">Cari</button>
      </form>
    </div>
    <div class="header-right">
      <a href="index.php"><i class="bi bi-house-door-fill"></i> Beranda</a>
      <a href="profile.php"><i class="bi bi-person-fill"></i> Profil Desa</a>
      <a href="population.php"><i class="bi bi-people-fill"></i> Data Penduduk</a>
      <div class="dropdown">
        <a href=""><i class="bi bi-newspaper"></i> Layanan Publik</a>
        <div class="dropdown-content">
          <a href="pembangunan.php"><i class="bi bi-gear-fill"></i> Informasi Kegiatan Pembangunan</a>
          <a href="wisata.php"><i class="bi bi-compass-fill"></i> Informasi Wisata Lokal</a>
          <a href="pengaduan_saran.php"><i class="bi bi-chat-left-dots-fill"></i> Pengaduan dan Saran</a>
        </div>
      </div>
      <a href="contact.php"><i class="bi bi-envelope-fill"></i> Hubungi Kami</a>
      <a href="admin/index.php" class="admin-login"><i class="bi bi-person-circle"></i> Login Admin</a>
    </div>
  </div>
</header>

  <div class="container">

    <!-- Tabel Informasi Wisata Lokal -->
        <div class="table-responsive mb-5">
          <h3 class="saya">Informasi Wisata Lokal</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Gambar Tempat Wisata</th>
                <th>Alamat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($row = mysqli_fetch_assoc($resultWisata)) {
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><img src="upload/<?php echo $row['gambar']; ?>" alt="Gambar Wisata" style="max-width: 100%;"></td>
                  <td><?php echo $row['alamat']; ?></td>
                  <td>
                    <a href="detail_wisata.php?id_wisata=<?php echo $row['id_wisata']; ?>" class="btn btn-primary btn-sm">Detail</a>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        </div>

    <div class="main">
    <div id="bagian-hubungi-kami" class="contact-form">
        <h3 class="section-title">Hubungi kami</h3>
        <form action="input_hubungi.php" method="POST">
            <p>Nama (Wajib Diisi)</p>
            <input type="text" name="nama" required>

            <p>Email (Wajib Diisi)</p>
            <input type="email" name="email" required>
            
            <p>Pesan (Wajib Diisi)</p>
            <textarea name="pesan" required></textarea>
            <p>*Bidang wajib diisi.</p>
            <input class="contact-submit" type="submit" value="Kirim">
        </form>
    </div>
</div>


     <footer class="mt-5">
    <div class="container">
      <div class="row text-white">
        <div class="col-md-5 d-flex align-items-center">
          <img class="" src="images/himatif.png" alt="Logo Desa" width="50" height="50">
          <div class="ms-4">
            <p class="m-0">&copy; <?php echo date('Y'); ?> <b>PemDes Trans Maranti</b></p>
          </div>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-end">
          <div class="row">
            <div class="col-md-6">
              <p class="text-left"><b>Panel</b></p>
              <ul class="list-unstyled text-white">
                <li><a href="index.php"><i class="bi bi-house"></i> Beranda</a></li>
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
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
  </body>
</html>