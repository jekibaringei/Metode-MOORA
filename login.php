<?php
session_start();

require 'functions.php';

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (login($_POST) > 0) {
    $login = mysqli_query($con, "SELECT * FROM login WHERE username = '$username' AND password = '$password' ");
    $user = mysqli_fetch_assoc($login);

    if ($user['level'] == 'admin') {
      $_SESSION['status'] = "log_in";
      echo "<script>
	 				alert('Selamat Datang Admin')
           document.location.href='admin/index.php'
	 			</script>";
    } else if ($user['level'] == 'user') {
      $_SESSION['status'] = "log_in";
      echo "<script>
	 				alert('Selamat Datang User')
           document.location.href='konsumen/index.php'
	 			</script>";
    }
  } else {
    echo "<script>
          document.location.href='login.php?pesan=username/passwordsalah'
        </script>";
  }
}



?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


  <style>
    body {
      color: white;
      background-color: #fff;

    }


    .col-md-3 h1 {
      padding: 10px;
      text-transform: uppercase;
    }

    .panel {
      text-align: left;
      padding: 10px;
    }


    .col-md-3 {
      text-align: left;
    }
  </style>

  <title>login</title>
</head>

<body>

  <center>
    <br><br><br><br><br>

    <div class="col-md-3" style="padding: 10px; ">
      <?php
      if (isset($_GET['pesan'])) {

        if ($_GET['pesan'] == "username/passwordsalah") {
          echo "<div class='alert alert-danger'>Gagal! Username/Password Salah</div>";
        } else if ($_GET['pesan'] == "logoutberhasil") {
          echo "<div class='alert alert-info'>Logout Berhasil</div>";
        } else if ($_GET['pesan'] == "logindahulu") {
          echo "<div class='alert alert-warning'>Anda harus Login Dahulu</div>";
        }
      }
      ?>


      <div class="col-md-13 bg-info">
        <center>
          <h1>Sign In</h1>
        </center>
      </div>

    </div>
    <div class="col-md-3 bg-light">
      <form method="post">
        <div class="panel">
          <div class="panel-body">
            <div class="form-group">
              <input type="text" name="username" placeholder="Username" autocomplete="off" required autofocus class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="password" autocomplete="off" required class="form-control">
            </div>
            <div class="form-group">
              <center><button type="submit" name="login" class="btn btn-info" style="width: 100%;">Log In</button></center>
              <hr>
            </div>
          </div>
        </div>
      </form>
    </div>
  </center>



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/   reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//   I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>

</html>