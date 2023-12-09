<?php

require '../functions.php';

//AMBIL DATA YG DIKLIK HAPUS DI HALAMAN laporan.php TADI 
$kode = $_GET['kode'];

//JALANKAN FUNGSI
if (hapus_laporan($kode)) {
    echo "<script>
          alert ('Data Berhasil Di Hapus')
          document.location.href='laporan.php'
          </script>";
}
