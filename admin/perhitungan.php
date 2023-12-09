<?php
session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../xml_get_current_byte_index(parser).php?pesan=logindahulu");
  exit;
}
require '../functions.php';




// JIKA TIDAK MENERIMA DATA ID ALTERNATIF MAKA LEMPAR KEMBALI KE data_sepatu_sport.php
if (!isset($_POST['id_alternatif'])) {
  echo "<script>
  alert('Pilih Data Pegawai Dahulu ! ')
  document.location.href='data_pegawai.php'
  </script>";
} else {

  //JIKA MENERIMA DATA ID ALTERNATIF MAKA JALANKAN HALAMAN perhitungan.php

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD ABSEN
  $data_kriteria_absen = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Absen'");
  $absen = mysqli_fetch_assoc($data_kriteria_absen);

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD MASA KERJA
  $data_kriteria_masa_kerja = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Masa Kerja'");
  $masa_kerja = mysqli_fetch_assoc($data_kriteria_masa_kerja);

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD PENCAPAIAN KERJA
  $data_kriteria_pencapaian_kerja = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Pencapaian Kerja'");
  $pencapaian_kerja = mysqli_fetch_assoc($data_kriteria_pencapaian_kerja);

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD KERJASAMA
  $data_kriteria_kerjasama = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Kerjasama'");
  $kerjasama = mysqli_fetch_assoc($data_kriteria_kerjasama);

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD KOMUNIKASI
  $data_kriteria_komunikasi = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Komunikasi'");
  $komunikasi = mysqli_fetch_assoc($data_kriteria_komunikasi);

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD TANGGUNG JAWAB
  $data_kriteria_tanggung_jawab = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Tanggung Jawab'");
  $tanggung_jawab = mysqli_fetch_assoc($data_kriteria_tanggung_jawab);

  //MEMBUAT KODE OTOMATIS

  //MENGAMBIL DATA PEGAWAI DENGAN KODE PALING BESAR
  $a = mysqli_query($con, "SELECT max(kode) AS kodeterbesar from hasil_akhir");
  $b = mysqli_fetch_array($a);
  $kodepegawai = $b['kodeterbesar'];

  //MENGAMBIL ANGKA DARI KODE PEGAWAI TERBESAR MENGGUNAKAN FUNSI substr
  //DAN DIUBAH KE INTEGER (int)

  $urutan = (int) substr($kodepegawai, 3, 3);

  //BILANGAN YANG DIAMBIL INI DI TAMBAH 1 UNTUK MENENTUKAN NOMOR URUT BERIKUTNYA
  $urutan++;

  //MEMBENTUK KODE BARU
  //PERINTAH printf("%03s",$urutan); BERGUNA UNTUK MEMBUAT STRING MENJADI 3 KARAKTER
  //MISAL printf("%03s",15); MAKAMENGHASILKAN '015'
  $kodepegawai = "k" . sprintf("%03s", $urutan);

  //JIKA TOMBOL SIMPAN DITEKAN MAKA
  if (isset($_POST['simpan'])) {
    if (insert_hasil_perankingan($_POST) > 0) {
      echo "<script>
          alert('data tersimpan')
          document.location.href='laporan.php'
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
        font-weight: bold;
        color: darkblue;
      }

      tr:hover {
        -webkit-transform: scale(1.03);
        transform: scale(1.03);
        font-weight: bold;
      }
    </style>

    <title>PERHITUNGAN</title>
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
        <center><b>DATA PEGAWAI TERPILIH</b></center>
      </div>

      <div class="table-responsive p-4">
        <table class="table table-striped shadow">
          <tr class="bg-info">
            <th width="150">Id Alternatif</th>
            <th>Nama Alternatif</th>
            <th>Absen (C1)</th>
            <th>Masa Kerja (C2)</th>
            <th>Pencapaian Kerja (C3)</th>
            <th>Kerjasama (C4)</th>
            <th>Komunikasi (C6)</th>
            <th>Tanggung Jawab (C6)</th>
          </tr>

          <?php
          $id_alternatifs = $_POST['id_alternatif'];

          foreach ($id_alternatifs as $id_alternatif) {
            $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
            while ($pegawai = mysqli_fetch_assoc($data)) {
          ?>


              <tr>
                <td><?= $pegawai['id_alternatif']; ?></td>
                <td><?= $pegawai['nama_alternatif']; ?></td>
                <td><?= $pegawai['c1']; ?></td>
                <td><?= $pegawai['c2']; ?></td>
                <td><?= $pegawai['c3']; ?></td>
                <td><?= $pegawai['c4']; ?></td>
                <td><?= $pegawai['c5']; ?></td>
                <td><?= $pegawai['c6']; ?></td>
              </tr>


          <?php
            }
          }

          ?>

          </form>
        </table>
      </div>


      <br><br>
      <h1 style="border-bottom:3px dodgerblue solid"></h1>
      <br><br>

      <div class="alert alert-info">
        <center><b>NORMALISASI MATRIKS</b></center>
      </div>

      <div class="table-responsive p-4">
        <table class="table table-striped shadow">
          <tr class="bg-info">
            <th width="150">Id Alternatif</th>
            <th>Nama Alternatif</th>
            <th>Absen (C1)</th>
            <th>Masa Kerja (C2)</th>
            <th>Pencapaian Kerja (C3)</th>
            <th>Kerjasama (C4)</th>
            <th>Komunikasi (C5)</th>
            <th>Tanggung Jawab (C6)</th>
          </tr>

          <?php

          $pembagi1 = 0;
          $pembagi2 = 0;
          $pembagi3 = 0;
          $pembagi4 = 0;
          $pembagi5 = 0;
          $pembagi6 = 0;

          $id_alternatifs = $_POST['id_alternatif'];
          foreach ($id_alternatifs as $id_alternatif) {
            $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
            while ($pegawai = mysqli_fetch_assoc($data)) {

              $pembagi1 += pow($pegawai['c1'], 2);
              $akar1 = sqrt($pembagi1);

              $pembagi2 += pow($pegawai['c2'], 2);
              $akar2 = sqrt($pembagi2);

              $pembagi3 += pow($pegawai['c3'], 2);
              $akar3 = sqrt($pembagi3);

              $pembagi4 += pow($pegawai['c4'], 2);
              $akar4 = sqrt($pembagi4);

              $pembagi5 += pow($pegawai['c5'], 2);
              $akar5 = sqrt($pembagi5);

              $pembagi6 += pow($pegawai['c6'], 2);
              $akar6 = sqrt($pembagi6);
            }
          }

          ?>



          <?php
          $id_alternatifs = $_POST['id_alternatif'];
          foreach ($id_alternatifs as $id_alternatif) {
            $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
            while ($pegawai = mysqli_fetch_assoc($data)) {

          ?>


              <tr>
                <td><?= $pegawai['id_alternatif']; ?></td>
                <td><?= $pegawai['nama_alternatif']; ?></td>
                <!-- -----------C1----------- -->
                <td>
                  <?php $c1 = $pegawai['c1'] / $akar1;
                  echo round($c1, 3); ?>
                </td>
                <!-- -----------C2----------- -->
                <td>
                  <?php $c2 = $pegawai['c2'] / $akar2;
                  echo round($c2, 3); ?>
                </td>
                <!-- -----------C3----------- -->
                <td>
                  <?php $c3 = $pegawai['c3'] / $akar3;
                  echo round($c3, 3); ?>
                </td>
                <!-- -----------C4----------- -->
                <td><?php $c4 = $pegawai['c4'] / $akar4;
                    echo round($c4, 3); ?>
                </td>
                <td><?php $c5 = $pegawai['c5'] / $akar5;
                    echo round($c5, 3); ?>
                </td>
                <td><?php $c6 = $pegawai['c6'] / $akar6;
                    echo round($c6, 3); ?>
                </td>
              </tr>


          <?php

            }
          }
          ?>
        </table>
      </div>


      <br><br>
      <h1 style="border-bottom:3px dodgerblue solid"></h1>
      <br><br>

      <div class="alert alert-info">
        <center><b>OPTIMASI MATRIKS

            <div class="table-responsive p-4">
              <table class="table table-striped shadow">
                <tr class="bg-info">
                  <th width="150">Id Alternatif</th>
                  <th>Nama Alternatif</th>
                  <th>Absen (C1)</th>
                  <th>Masa Kerja (C2)</th>
                  <th>Pencapaian Kerja (C3)</th>
                  <th>Kerjasama (C4)</th>
                  <th>Komunikasi (C5)</th>
                  <th>Tanggung Jawab (C6)</th>
                </tr>

                <?php
                $id_alternatifs = $_POST['id_alternatif'];
                foreach ($id_alternatifs as $id_alternatif) {
                  $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
                  while ($pegawai = mysqli_fetch_assoc($data)) {

                ?>

                    <tr>
                      <td><?= $pegawai['id_alternatif']; ?></td>
                      <td><?= $pegawai['nama_alternatif']; ?></td>
                      <!-- -----------C1----------- -->
                      <td>
                        <?php $c1 = $pegawai['c1'] / $akar1;
                        $absen1 = $absen['bobot'] * $c1;
                        // echo $merek['bobot'] . " * " . round($c1, 6) . " = " . round($merek1, 6);
                        echo round($absen1, 3);
                        ?>
                      </td>
                      <!-- -----------C2----------- -->
                      <td>
                        <?php $c2 = $pegawai['c2'] / $akar2;
                        $masa_kerja1 = $masa_kerja['bobot'] * $c2;
                        // echo $bahan['bobot'] . " * " . round($c2, 6) . " = " . round($bahan1, 6);
                        echo round($masa_kerja1, 3);
                        ?>
                      </td>
                      <!-- -----------C3----------- -->
                      <td>
                        <?php $c3 = $pegawai['c3'] / $akar3;
                        $pencapaian_kerja1 = $pencapaian_kerja['bobot'] * $c3;
                        // echo $berat['bobot'] . " * " . round($c3, 6) . " = " . round($berat1, 6);
                        echo round($pencapaian_kerja1, 3);
                        ?>
                      </td>
                      <!-- -----------C4----------- -->
                      <td>
                        <?php $c4 = $pegawai['c4'] / $akar4;
                        $kerjasama1 = $kerjasama['bobot'] * $c4;
                        // echo $harga['bobot'] . " * " . round($c4, 6) . " = " . round($harga1, 6);
                        echo round($kerjasama1, 3);
                        ?>
                      </td>
                      <!-- -----------C5----------- -->
                      <td>
                        <?php $c5 = $pegawai['c5'] / $akar5;
                        $komunikasi1 = $komunikasi['bobot'] * $c5;
                        // echo $harga['bobot'] . " * " . round($c4, 6) . " = " . round($harga1, 6);
                        echo round($komunikasi1, 3);
                        ?>
                      </td>
                      <!-- -----------C6----------- -->
                      <td>
                        <?php $c6 = $pegawai['c6'] / $akar6;
                        $tanggung_jawab1 = $tanggung_jawab['bobot'] * $c6;
                        // echo $harga['bobot'] . " * " . round($c4, 6) . " = " . round($harga1, 6);
                        echo round($tanggung_jawab1, 3);
                        ?>
                      </td>
                    </tr>

                <?php
                  }
                }

                ?>

              </table>
            </div>


            <br><br>
            <h1 style="border-bottom:3px dodgerblue solid"></h1>
            <br><br>

            <div class="alert alert-info">
              <center><b>HASIL AKHIR</b></center>
            </div>

            <div class="table-responsive p-4">
              <table class="table table-striped shadow">
                <tr class="bg-info">
                  <th width="150">Id Alternatif</th>
                  <th>Nama Alternatif</th>
                  <th>Total</th>
                </tr>



                <?php
                $id_alternatifs = $_POST['id_alternatif'];
                foreach ($id_alternatifs as $id_alternatif) {
                  $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
                  while ($pegawai = mysqli_fetch_assoc($data)) {

                ?>


                    <?php $pegawai['id_alternatif']; ?>
                    <?php $pegawai['nama_alternatif']; ?>
                    <!-- -----------C1----------- -->

                    <?php $c1 = $pegawai['c1'] / $akar1;
                    $absen1 = $absen['bobot'] * $c1;
                    // echo $merek['bobot'] . " * " . round($c1, 6) . " = " . round($merek1, 6);
                    round($absen1, 3);
                    ?>
                    <!-- -----------C2----------- -->
                    <?php $c2 = $pegawai['c2'] / $akar2;
                    $masa_kerja1 = $masa_kerja['bobot'] * $c2;
                    // echo $bahan['bobot'] . " * " . round($c2, 6) . " = " . round($bahan1, 6);
                    round($masa_kerja1, 3);
                    ?>
                    <!-- -----------C3----------- -->
                    <?php $c3 = $pegawai['c3'] / $akar3;
                    $pencapaian_kerja1 = $pencapaian_kerja['bobot'] * $c3;
                    // echo $berat['bobot'] . " * " . round($c3, 6) . " = " . round($berat1, 6);
                    round($pencapaian_kerja1, 3);
                    ?>
                    <!-- -----------C4----------- -->
                    <?php $c4 = $pegawai['c4'] / $akar4;
                    $kerjasama1 = $kerjasama['bobot'] * $c4;
                    // echo $harga['bobot'] . " * " . round($c4, 6) . " = " . round($harga1, 6);
                    round($kerjasama1, 3);
                    ?>
                    <!-- -----------C5----------- -->
                    <?php $c5 = $pegawai['c5'] / $akar5;
                    $komunikasi1 = $komunikasi['bobot'] * $c5;
                    // echo $harga['bobot'] . " * " . round($c4, 6) . " = " . round($harga1, 6);
                    round($komunikasi1, 3);
                    ?>
                    <!-- -----------C6----------- -->
                    <?php $c6 = $pegawai['c6'] / $akar6;
                    $tanggung_jawab1 = $tanggung_jawab['bobot'] * $c6;
                    // echo $harga['bobot'] . " * " . round($c4, 6) . " = " . round($harga1, 6);
                    round($tanggung_jawab1, 3);
                    ?>

                    <form action="" method="POST" class="form-group">
                      <tr>
                        <input type="hidden" name="kode" value="<?= $kodepegawai; ?>">
                        <!-- --------------ID ALTERNATIF-------------- -->
                        <input type="hidden" name="id_alternatif[]" value="<?= $pegawai['id_alternatif'] ?>">
                        <td><?= $pegawai['id_alternatif']; ?></td>
                        <!-- --------------NAMA ALTERNATIF-------------- -->
                        <input type="hidden" name="nama_alternatif[]" value="<?= $pegawai['nama_alternatif'] ?>">
                        <td><?= $pegawai['nama_alternatif']; ?></td>
                        <!-- --------------TOTAL HASIL-------------- -->
                        <td>
                          <?php
                          $totalll = $masa_kerja1 + $pencapaian_kerja1 + $kerjasama1 + $komunikasi1 + $tanggung_jawab1 - $absen1;
                          echo round($totalll, 3);
                          ?>
                          <input type="hidden" name="total_hasil[]" value="<?= round($totalll, 3); ?>">
                        </td>
                      </tr>


                  <?php
                  }
                }

                  ?>

                  <button type="submit" name="simpan" class="btn btn-success" style="float: right;">Simpan</button>
                  <br><br>
                    </form>

              </table>
            </div>


      </div>
      <div class="col-md-12" style="background-color: #5bc8ac;">
        <div class="copyright">
          <h6 style="color: #000;">Copyright&copy; Kelompok 4</h6>
        </div>
      </div>
    <?php   } ?>
    <!-- 
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
       -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

  </body>

  </html>