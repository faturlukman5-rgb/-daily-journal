<?php
session_start();
include "koneksi.php";
//check jika sudah ada user yang login arahkan ke halaman admin
if (isset($_SESSION['username'])) { 
	header("location:admin.php"); 
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['user'];
  $password = md5($_POST['pass']);

  $stmt = $conn->prepare("SELECT username 
                          FROM user 
                          WHERE username=? AND password=?");

  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $hasil = $stmt->get_result();
  $row = $hasil->fetch_array(MYSQLI_ASSOC);

  if (!empty($row)) {
    $_SESSION['username'] = $row['username'];
    header("location:admin.php");
  } else {
    header("location:login.php");
  }
  $stmt->close();
  $conn->close();
} else {
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | My Daily Journal</title>

    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link rel="icon" href="img/logo.png" />
  </head>

  <body style="background-color: #f3c8c8;">
    
    <!-- FORM LOGIN -->
    <div class="container mt-5 pt-5">
      <div class="row">
        <div class="col-12 col-sm-8 col-md-6 m-auto">
          <div class="card border-0 shadow rounded-5">
            <div class="card-body">
              <div class="text-center mb-3">
                <i class="bi bi-person-circle h1 display-4"></i>
                <p> welcome My Daily Journal</p>
                <hr />
              </div>

              <form action="" method="post">
                <input
                  type="text"
                  name="user"
                  class="form-control my-4 py-2 rounded-4"
                  placeholder="Username"
                />
                <input
                  type="password"
                  name="pass"
                  class="form-control my-4 py-2 rounded-4"
                  placeholder="Password"
                />
                <div class="text-center my-3 d-grid">
                  <button class="btn btn-danger rounded-4">Login</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- NOTIFIKASI -->
    <div class="container">
      <?php
      // dummy data
      $username = "admin";
      $password = "123456";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

          if($_POST['user'] == $username AND $_POST['pass'] == $password){

              echo '
              <div class="alert alert-success text-center  mx-auto rounded-4 shadow mt-4" style="max-width: 350px;">
                  <strong>user :</strong> admin<br>
                  <strong>pass :</strong> 123456<br>
                  Username dan Password Benar
              </div>';

          } else {

              echo '
              <div class="alert alert-danger text-center  mx-auto rounded-4 shadow mt-4" style="max-width: 350px;">
                  <strong>user :</strong> admin<br>
                  <strong>pass :</strong> 123<br>
                  Username dan Password Salah
              </div>';
          }
      }
      ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
<?php
}
?>
