<?php

session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../index.php?pesan=logindahulu");
  exit;
}

require '../functions.php';

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <style>
    body {
      background-color: #f0f0f0;
    }

    .container {
      min-height: calc(100vh - 211px - -60px);
    }


    .col-md-12 {
      padding: 8px;
    }

    .copyright {
      text-align: center;
      color: white;

    }

    a font {
      color: whitesmoke;
    }

    .navbar-nav a:hover {
      color: darkblue;
    }

    .visi {
      width: 500px;
      height: 150px;
      margin-top: -100px;
      border: 1px solid grey;
      float: left;
      position: absolute;
    }

    .misi {
      width: 500px;
      height: 150px;
      border: 1px solid grey;
      position: absolute;
      margin-left: 605px;
      margin-top: -100px;
    }

    @media (max-width: 1000px) {
      .visi {
        width: 90%;
        margin-top: -250px;
      }

      .misi {
        width: 90%;
        margin-left: 0;
        margin-top: -50px;
      }

      .telp {
        margin-right: 350px;
        margin-bottom: 10px;

      }

      .alamat {
        margin-right: 350px;
        margin-bottom: 10px;
      }


      .email {
        margin-right: 350px;
        margin-bottom: 10px;
      }


    }
  </style>

  <title>Tentang Kami</title>
</head>

<body bgcolor="f0f0f0">
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #5bc8ac;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav" style="margin: 10px;">
        <a class="nav-link active" href="index.php">
          <font size="4"><b>Home</b> </font><span class="sr-only">(current)</span>
        </a>
        <a class="nav-link" href="data_pegawai.php">
          <font size="4"><b>Data Pegawai</b></font>
        </a>
        <a class="nav-link" href="laporan.php">
          <font size="4"><b>Laporan</b></font>
        </a>
        <a class="nav-link" href="tentang.php">
          <font size="4"><b>Tentang</b></font>
        </a>
      </div>
    </div>
    <div class="navbar-nav ms-auto" style="margin: 10px;">
      <a class="log nav-link m-auto" href="../logout.php">
        <font size="4"><b>Logout</b></font>
        <img src="../img/logout.png" width="30">
      </a>
    </div>
  </nav>

  <br>
  <div class="container bg-light shadow p-3 mb-5">

    <div class="alert alert-info">
      <center><b>TENTANG KAMI</b></center>
    </div>
    <center>

      <font size="5" class="judul"><b>Final projek kelompok 4 dalam matakuliah Sistem Pengambilan Keputusan telah berhasil diselesaikan dengan sukses. Fokus proyek ini adalah implementasi perhitungan metode MOORA, yang sebelumnya dilakukan di dalam lembar kerja Excel, kini telah berhasil diadaptasi ke dalam lingkungan website. Dengan menyesuaikan dan mentransfer perhitungan tersebut, kelompok kami berhasil membuat sebuah platform web yang memungkinkan pengguna untuk dengan mudah dan efisien melakukan perhitungan menggunakan metode MOORA. Proses pengembangan melibatkan transformasi perhitungan yang awalnya terbatas pada Excel menjadi fitur yang dapat diakses secara online, memberikan kemudahan aksesibilitas dan penggunaan bagi para pengguna. Keberhasilan proyek ini merupakan tonggak penting dalam mengintegrasikan teknologi web dengan aplikasi pengambilan keputusan, memberikan kontribusi positif terhadap pemahaman dan penerapan metode MOORA dalam konteks teknologi informasi.</b></font>
    </center>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="col-md-12" style="background-color: #5bc8ac;">
      <div class="copyright">
        <h6 style="color: #000;">Copyright&copy; Kelompok 4</h6>
      </div>
    </div>


    <!-- 
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
   -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>

</html>