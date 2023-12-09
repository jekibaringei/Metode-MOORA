<?php

session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../index.php?pesan=logindahulu");
  exit;
}

require '../functions.php';

//BUKA SEMUA DATA YANG ADA DI TABLE hasil_akhir DAN URUTKAN KODE TERBARU TAMPIL DIATAS
$data = query("SELECT * FROM hasil_akhir ORDER BY kode DESC");

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
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
      color: #CDD0D4;

    }

    a font {
      color: whitesmoke;
    }

    .navbar-nav a:hover {
      color: darkblue;
    }

    .text-riwayat {
      width: 100%;
      color: grey;
      text-align: center;
      border-bottom: 1px solid grey;
      line-height: 0.1em;
      margin: 10px 0 20px;
    }

    h6 span {
      padding: 0 10px;
    }

    tr:hover {
      -webkit-transform: scale(1.03);
      transform: scale(1.03);
      font-weight: bold;
    }
  </style>

  <title>LAPORAN</title>
</head>

<body bgcolor="f0f0f0">
  <form method="post" action="perhitungan.php">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #5bc8ac;">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav" style="margin: 10px;">
          <a class="nav-link active" href="index.php">
            <font size="4"><b>Home</b> </font><span class="sr-only">(current)</span>
          </a>
          <a class="nav-link" href="data_kriteria.php">
            <font size="4"><b>Kriteria</b></font>
          </a>
          <a class="nav-link" href="data_pegawai.php">
            <font size="4"><b>Data Pegawai</b></font>
          </a>
          <a class="nav-link" href="#">
            <font size="4"><b><button type="submit" name="perhitungan" class="btn btn" style="font-size: 20px; margin-top: -10px; color: #fff;"><b>Perhitungan</b></button></b></font>
          </a>
          <a class="nav-link" href="laporan.php">
            <font size="4"><b>Laporan</b></font>
          </a>
        </div>

        <div class="navbar-nav ms-auto" style="margin: 10px;">
          <a class="log nav-link m-auto" href="../logout.php">
            <font size="4"><b>Logout</b></font>
            <img src="../img/logout.png" width="30">
          </a>
        </div>
      </div>
    </nav>
  </form>

  <br>
  <div class="container bg-light shadow p-3 mb-5">

    <div class="alert alert-info">
      <center><b>LAPORAN PEGAWAI TERBAIK</b></center>
    </div>

    <div class="table-responsive p-4">
      <table class="table table-striped shadow">
        <tr class="bg-info">
          <th width="150">Kode</th>
          <th width="300">Tanggal</th>
          <th>Total Data</th>
          <th>Aksi</th>
        </tr>

        <?php $no = 1; ?>
        <?php
        foreach ($data as $hasil_akhir) {
        ?>

          <?php
          //memanggil kode yang ada di table hasil_akhir
          $kode = $hasil_akhir['kode'];
          //menghitung total data dari data masing masing kode
          $total = mysqli_query($con, "SELECT COUNT(kode_hasil) AS TOTAL FROM nilai WHERE kode_hasil = '$kode'");
          $totaldata = mysqli_fetch_assoc($total);
          ?>

          <tr>
            <td><?= $hasil_akhir['kode']; ?></td>
            <td><?= $hasil_akhir['tanggal']; ?></td>
            <td><?= $totaldata['TOTAL']; ?></td>
            <td>
              <a href="detail_laporan.php?kode=<?= $hasil_akhir['kode']; ?>" class="btn btn-info">Lihat</a>
              <a href="hapus_laporan.php?kode=<?= $hasil_akhir['kode']; ?>" class="btn btn-danger">Hapus</a>
            </td>
          </tr>

        <?php } ?>
      </table>
    </div>


    <br><br>
    <h6 class="text-riwayat"><span class="bg-light">Riwayat Terbaru Perankingan</span></h6>

    <br><br>
  </div>

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