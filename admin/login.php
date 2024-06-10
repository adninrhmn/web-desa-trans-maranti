<?php

// File koneksi database
include '../includes/db.php';

class AdminLogin {
  private $koneksi;
  
  public function __construct($koneksi) {
    $this->koneksi = $koneksi;
  }

  public function isUserLoggedIn() {
    session_start();
    if (isset($_SESSION['admin'])) {
      header('Location: index.php');
      exit();
    }
  }

  public function processLogin() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];

      // Mengenkripsi password menggunakan md5
      $encrypted_password = md5($password);

      // Query untuk memeriksa keberadaan admin dengan username dan password yang sesuai
      $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$encrypted_password'";
      $result = mysqli_query($this->koneksi, $query);

      if (mysqli_num_rows($result) == 1) {
        // Login berhasil, set session admin
        $admin = mysqli_fetch_assoc($result);
        $_SESSION['admin']['id'] = $admin['id']; // Menyimpan ID admin dalam sesi
        header('Location: index.php');
        exit();
      } else {
        // Login gagal, tampilkan pesan error
        $error = "Username atau password salah!";
        return $error;
      }
    }
  }

  public function renderLoginPage($error) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <title>Login Admin</title>
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Font+Name&display=swap">
      <style>
        /* ... kode CSS lainnya ... */
        body {
          padding-top: 20px;
          font-family: 'Times New Roman', sans-serif;
        }
        body {
          background-image: url('../gambar/gambarku.jpg'); /* Ganti 'nama_gambar.jpg' dengan nama dan ekstensi gambar Anda */
          background-repeat: no-repeat;
          background-size: cover;
          background-position: center;
        }
        .login-container {
          background-color: rgba(38, 208, 201, 0.9);
          max-width: 400px;
          margin: 0 auto;
          padding: 40px;
          border: 1px solid #ccc;
          border-radius: 5px;
          margin-top: 100px;
        }
        .login-title {
          text-align: center;
          margin-bottom: 20px;
        }
        .login-form .form-group {
          margin-bottom: 20px;
        }
        .login-form label {
          display: block;
          margin-bottom: 5px;
        }
        .login-button {
          display: block;
          width: 100%;
          padding: 10px;
          background-color: #007bff;
          color: #fff;
          border: none;
          border-radius: 5px;
          cursor: pointer;
        }
        .login-button:hover {
          background-color: #0069d9;
        }
      </style>
    </head>
    <body>
      <div class="container">
        <div class="login-container">
          <h2 class="login-title">Login Admin</h2>
          <form action="login.php" method="POST" class="login-form">
            <?php if (isset($error)) { ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
              </div>
            <?php } ?>
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="login-button">Login</button>
          </form>
        </div>
      </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
  }
}

$adminLogin = new AdminLogin($koneksi);
$adminLogin->isUserLoggedIn();
$error = $adminLogin->processLogin();
$adminLogin->renderLoginPage($error);

?>
