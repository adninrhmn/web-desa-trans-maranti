<?php
class Logout {
  public function __construct() {
    session_start();
  }

  public function destroySession() {
    session_unset();
    session_destroy();
  }

  public function redirectToLogin() {
    header("Location: ../index.php");
    exit();
  }

  public function displayLogoutPage() {
    echo '
    <!DOCTYPE html>
    <html>
    <head>
      <title>Logout</title>
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
      <style>
        .logout-container {
          max-width: 400px;
          margin: 0 auto;
          padding: 40px;
          border: 1px solid #ccc;
          border-radius: 5px;
          margin-top: 100px;
          text-align: center;
        }
        .logout-title {
          margin-bottom: 20px;
        }
        .logout-link {
          color: #007bff;
          text-decoration: none;
        }
        .logout-link:hover {
          text-decoration: underline;
        }
      </style>
    </head>
    <body>
      <div class="container">
        <div class="logout-container">
          <h2 class="logout-title">Logout</h2>
          <p>Anda telah berhasil logout dari akun admin.</p>
          <p><a href="login.php" class="logout-link">Klik di sini</a> untuk kembali ke halaman login.</p>
        </div>
      </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>';
  }
}

$logout = new Logout();
$logout->destroySession();
$logout->redirectToLogin();
$logout->displayLogoutPage();
?>
