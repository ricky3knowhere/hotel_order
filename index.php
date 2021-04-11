<?php
	//	Fungsi untuk menghitung durasi menginap.
	//	Masukan yang digunakan adalah variabel $tglCekIn yang berisi tanggal check-in dan variabel $tglCekOut yang berisi tanggal check-out.
	//	Durasi (berapa malam menginap) didapat dari selisih tanggal check-in dan check-out.
	//	Fungsi mengembalikan variabel $durasi yang berisi nilai durasi.
	function durasi($tglCekIn, $tglCekOut){
	    $date1 = date_create($tglCekIn);
		$date2 = date_create($tglCekOut);
		$diff = date_diff($date1,$date2);
		$durasi = $diff->format("%d%");

	    return $durasi;
	}
	
	//	Instruksi Kerja Nomor 1.
	//	Fungsi untuk menghitung tagihan awal.
	//	.....
	
	
	//Daftar kota
	$DAFTAR_KOTA = [
		"Jakarta","Bandung","Semarang","Yogyakarta","Surabaya","Denpasar"
	];

	//Mengurutkan array kota
	sort($DAFTAR_KOTA);

	$hargaKamar = 500000;
	
	function hitung_tagihan_awal($durasiInap, $hargaKamar){
		// Menghitung tagihan awal
		$tagihanAwal = $durasiInap * $hargaKamar;

		return $tagihanAwal;
	}

	//	Instruksi Kerja Nomor 2.
	//	Variabel berisi data kota lokasi/cabang hotel dalam bentuk array.
	//	$lokasi = .....
	
	//	Instruksi Kerja Nomor 3.
	//	Mengurutkan array $lokasi sesuai abjad A-Z.
	//	.....

	//	Instruksi Kerja Nomor 4.
	//	Variabel untuk menyimpan harga kamar per malam.
	//	$hargaKamar .....
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Perhitungan Kamar Hotel</title>
		<!-- Instruksi Kerja Nomor 5. -->
		<!-- Menghubungkan berkas PHP dengan library CSS. -->
		<link rel="stylesheet" href="css/bootstrap.css">
	</head>
	
	<body>
	<div class="container border">
		<!-- Instruksi Kerja Nomor 6. -->
		<!-- Judul halaman -->
		<h3 class="text-primary">Form Pemesanan Kamar Hote</h3>
		
		<!-- Form untuk memasukkan data pemesanan. -->
		<form action="index.php" method="post" id="formTagihan">
			<div class="row">
				<!-- Masukan tanggal check-in. Tipe data date -->
				<div class="col-lg-2"><label for="tanggal">Tanggal Check-in:</label></div>
				<div class="col-lg-2"><input type="date" id="tglCekIn" name="tglCekIn"></div>
			</div>
			<div class="row">
				<!-- Masukan tanggal check-out. Tipe data date. -->
				<div class="col-lg-2"><label for="tanggal">Tanggal Check-out:</label></div>
				<div class="col-lg-2"><input type="date" id="tglCekOut" name="tglCekOut"></div>
			</div>
			<div class="row">
				<!-- Masukan pilihan lokasi hotel. -->
				<div class="col-lg-2"><label for="tipe">Cabang Hotel:</label></div>
				<div class="col-lg-2">
					<select id="lokasi" name="lokasi">
					<option value="">- Pilih Cabang -</option>
					<?php
						//	Instruksi Kerja Nomor 7.
						// Menampilkan dropdown pilihan cabang/lokasi berdasarkan data pada array $lokasi.
						foreach($DAFTAR_KOTA as $kota){
							echo "<option value=".$kota.">".$kota."</option>";
						}
					?>	
					</select>
				</div>
			</div>
			<div class="row">
				<!-- Masukan data nama pelanggan. Tipe data text. -->
				<div class="col-lg-2"><label for="nama">Nama Pelanggan:</label></div>
				<div class="col-lg-2"><input type="text" id="nama" name="nama"></div>
			</div>
			<div class="row">
				<!-- Masukan data nomor identitas pelanggan. Tipe data number. -->
				<div class="col-lg-2"><label for="nomor">Nomor Identitas:</label></div>
				<div class="col-lg-2"><input type="number" id="noid" name="noid" maxlength="16"></div>
			</div>
			
			<div class="row">
				<!-- Instruksi Kerja Nomor 8. -->
				<!-- Tombol Submit -->
				<div class="col-lg-2"><button class="btn btn-primary" type="submit" form="formTagihan" value="Pesan" name="Pesan">Pesan</button></div>
				<div class="col-lg-2"></div>
			</div>
		</form>
	</div>

	<?php
		//	Kode berikut dieksekusi setelah tombol Hitung ditekan.
		if(isset($_POST['Pesan'])) {
			
			//	Variabel $dataPesanan berisi data-data pemesanan dari form dalam bentuk array.
			$dataPesanan = array(
				'tglCekIn' => $_POST['tglCekIn'],
				'tglCekOut' => $_POST['tglCekOut'],
				'lokasi' => $_POST['lokasi'],
				'nama' => $_POST['nama'],
				'noid' => $_POST['noid']
			);
			
			//	Variabel berisi path file data.json yang digunakan untuk menyimpan data pemesanan.
			$berkas = "data.json";
			
			//	Mengubah data pemesanan yang berbentuk array PHP menjadi bentuk JSON.
			$dataJson = json_encode($dataPesanan, JSON_PRETTY_PRINT);
			
			//	Instruksi Kerja Nomor 9.
			//	Menyimpan data pemesanan yang berbentuk JSON ke dalam file JSON
			//	.....
			file_put_contents('data/data.json', $dataJson);


			//	Instruksi Kerja Nomor 10.
			//	Mengambil data pemesanan dari file JSON
			//	$dataJson = .....

				$dataJson = file_get_contents('data/data.json');
			
			//	Mengubah data pemesanan dalam format JSON ke dalam format array PHP.
			$dataPesanan = json_decode($dataJson, true);
			
			//	Variabel $durasiInap berisi nilai durasi menginap yang dihitung dengan menggunakan fungsi durasi().
			$durasiInap = durasi($dataPesanan['tglCekIn'], $dataPesanan['tglCekOut']);

			//	Variabel $tagihanAwal berisi nilai tagihan awal (sebelum diskon) yang dihitung dengan menggunakan fungsi hitung_tagihan_awal().
			$tagihanAwal = hitung_tagihan_awal($durasiInap, $hargaKamar);

			//	Instruksi Kerja Nomor 11.
			//	Menghitung diskon.
			//	Variabel $diskon berisi nilai diskon sesuai kriteria.
			//	.....
			//	.....
			
			$diskon = 0;
			
			if ($tagihanAwal >= 1500000) {
				//	Jika tagihan awal lebih besar atau sama dengan Rp1.500.000 maka diberikan diskon sebesar 10%
				
				$diskon = ($tagihanAwal * 0.1);
				
				$tagihanAkhir = $tagihanAwal - $diskon;
			} else {
				//	Jika tagihan awal lebih kecil dari Rp1.500.000 maka diberikan diskon sebesar 5%.

				$diskon = ($tagihanAwal * 0.05);
				$tagihanAkhir = $tagihanAwal - $diskon;
			}
			





			//	Variabel $tagihanAkhir berisi nilai tagihan akhir yang didapat dari nilai tagihan awal dikurangi diskon.
			$tagihanAkhir = $tagihanAwal - $diskon;
			
			//	Menampilkan data pemesanan dan hasil perhitungan diskon dan tagihan.
			echo "
				<br/>
				<div class='container'>
				
					<div class='row'>
						<!-- Menampilkan tanggal check-in. -->
						<div class='col-lg-2'>Tanggal Check-in:</div>
						<div class='col-lg-2'>".$dataPesanan['tglCekIn']."</div>
					</div>
					<div class='row'>
						<!-- Menampilkan tanggal check-out. -->
						<div class='col-lg-2'>Tanggal Check-out:</div>
						<div class='col-lg-2'>".$dataPesanan['tglCekOut']."</div>
					</div>
					<div class='row'>
						<!-- Menampilkan lokasi/cabang hotel. -->
						<div class='col-lg-2'>Cabang:</div>
						<div class='col-lg-2'>".$dataPesanan['lokasi']."</div>
					</div>
					<div class='row'>
						<!-- Menampilkan nama pelanggan. -->
						<div class='col-lg-2'>Nama Pelanggan:</div>
						<div class='col-lg-2'>".$dataPesanan['nama']."</div>
					</div>
					<div class='row'>
						<!-- Menampilkan nomor identitas pelanggan. -->
						<div class='col-lg-2'>Nomor Identitas:</div>
						<div class='col-lg-2'>".$dataPesanan['noid']."</div>
					</div>
					<div class='row'>
						<!-- Menampilkan durasi menginap. -->
						<div class='col-lg-2'>Durasi Menginap:</div>
						<div class='col-lg-2'>".$durasiInap." malam</div>
					</div>
					<div class='row'>
						<!-- Menampilkan tagihan awal (sebelum diskon). -->
						<div class='col-lg-2'>Tagihan Awal:</div>
						<div class='col-lg-2'>Rp".number_format($tagihanAwal, 0, ".", ".").",-</div>
					</div>
					<div class='row'>
						<!-- Menampilkan tarif pemesanan. -->
						<div class='col-lg-2'>Diskon:</div>
						<div class='col-lg-2'>Rp".number_format($diskon, 0, ".", ".").",-</div>
					</div>
					<div class='row'>
						<!-- Menampilkan tagihan akhir (setelah diskon). -->
						<div class='col-lg-2'>Tagihan Akhir:</div>
						<div class='col-lg-2'>Rp".number_format($tagihanAkhir, 0, ".", ".").",-</div>
					</div>
			</div>
			";
		}
	?>
	</body>
</html>