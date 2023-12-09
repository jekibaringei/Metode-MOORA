<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$con = mysqli_connect("localhost", "root", "root", "spkmoora");
function login($data)
{
	global $con;

	$username = $data['username'];
	$password = $data['password'];

	$login = mysqli_query($con, "SELECT * FROM login WHERE username = '$username' AND password = '$password' ");

	return mysqli_affected_rows($con);
}

function query($query)
{

	global $con;

	$data = mysqli_query($con, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function tampilkriteria($query)
{

	global $con;

	$data = mysqli_query($con, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function edit_kriteria($data)
{
	global $con;
	$id_kriteria = $data['id_kriteria'];
	$kriteria = $data['kriteria'];
	$bobot = $data['bobot'];
	$type = $data['type'];

	mysqli_query($con, "UPDATE kriteria SET 
		kriteria = '$kriteria',
		bobot = '$bobot',
		type = '$type'
		WHERE id_kriteria = '$id_kriteria'
		");

	return mysqli_affected_rows($con);
}

function tampilpegawai($query)
{

	global $con;

	$data = mysqli_query($con, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($data)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah_pegawai($data)
{
	global $con;

	$id_alternatif = $data['id_alternatif'];
	$nama_alternatif = $data['nama_alternatif'];
	$c1 = $data['c1'];
	$c2 = $data['c2'];
	$c3 = $data['c3'];
	$c4 = $data['c4'];
	$c5 = $data['c5'];
	$c6 = $data['c6'];


	mysqli_query($con, "INSERT INTO alternatif VALUES ('$id_alternatif','$nama_alternatif','$c1','$c2','$c3','$c4', '$c5','$c6') ");

	return mysqli_affected_rows($con);
}



function edit_pegawai($data)
{
	global $con;

	$id_alternatif = $data['id_alternatif'];
	$nama_alternatif = $data['nama_alternatif'];
	$c1 = $data['c1'];
	$c2 = $data['c2'];
	$c3 = $data['c3'];
	$c4 = $data['c4'];
	$c5 = $data['c5'];
	$c6 = $data['c6'];


	mysqli_query($con, "UPDATE alternatif SET
						 id_alternatif = '$id_alternatif',
						 nama_alternatif = '$nama_alternatif',
						 c1 = '$c1',
						 c2 = '$c2',
						 c3 = '$c3',
						 c4 = '$c4',
						 c5 = '$c5',
						 c6 = '$c6'
						 WHERE id_alternatif = '$id_alternatif'
						  ");

	return mysqli_affected_rows($con);
}

function hapus_pegawai($id_alternatif)
{
	global $con;

	mysqli_query($con, "DELETE FROM alternatif WHERE id_alternatif = '$id_alternatif' ");

	return mysqli_affected_rows($con);
}

function insert_hasil_perankingan($data)
{
	date_default_timezone_set('Asia/Jakarta');
	global $con;

	$kode = $data['kode'];
	$id_alternatif = $data['id_alternatif'];
	$nama_alternatif = $data['nama_alternatif'];
	$total_hasil = $data['total_hasil'];

	$tanggal = date('d - M - Y | H : i : s');


	$checkQuery = mysqli_query($con, "SELECT * FROM nilai WHERE kode_hasil = '$kode'");
	if (!$checkQuery) {
		die('Error: ' . mysqli_error($con));
	}

	if (mysqli_num_rows($checkQuery) > 0) {
		echo "<script>
            alert('Gagal')
            document.location.href='data_pegawai.php'
          </script>";
		exit;
	}
	// if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM nilai WHERE kode_hasil = '$kode' "))) {
	// 	echo "<script>
	// 			alert('Gagal')
	// 			document.location.href='data_pegawai.php'
	// 		  </script>	";
	// 	exit;
	// }


	for ($x = 0; $x < count($nama_alternatif); $x++) {
		$input = mysqli_query($con, "INSERT INTO nilai (kode_hasil, id_alternatif, nama_alternatif, total) VALUES ('$kode', '$id_alternatif[$x]', '$nama_alternatif[$x]', '$total_hasil[$x]')");
		if (!$input) {
			// Cek apakah error adalah karena duplikasi kode_hasil
			if (mysqli_errno($con) == 1062) {
				echo "<script>
						alert('Gagal, data sudah ada')
						document.location.href='data_pegawai.php'
					  </script>";
				exit;
			} else {
				die('Error: ' . mysqli_error($con));
			}
		}
	}

	$tambahHasilAkhir = mysqli_query($con, "INSERT INTO hasil_akhir (kode, tanggal) VALUES ('$kode', '$tanggal')");
	if (!$tambahHasilAkhir) {
		die('Error: ' . mysqli_error($con));
	}

	// for ($x = 0; $x < count($nama_alternatif); $x++) {
	// 	$input = mysqli_query($con, "INSERT INTO nilai (kode_hasil, id_alternatif, nama_alternatif, total) VALUES ('$kode', '$id_alternatif[$x]', '$nama_alternatif[$x]', '$total_hasil[$x]')");
	// }
	// if ($input) {
	// 	mysqli_query($con, "INSERT INTO hasil_akhir VALUES('','$kode','$tanggal') ");
	// } else {
	// 	echo "<script>alert('Data Gagal Tersimpan Coba Lagi')
	// 				document.location.href='data_pegawai.php'
	// 			</script>";
	// }



	return mysqli_affected_rows($con);
}


function hapus_laporan($kode)
{
	global $con;

	mysqli_query($con, "DELETE FROM hasil_akhir WHERE kode = '$kode' ");
	mysqli_query($con, "DELETE FROM nilai WHERE kode_hasil = '$kode' ");

	return mysqli_affected_rows($con);
}
