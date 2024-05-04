<?php

include ("KontrakPresenter.php");


class ProsesPasien implements KontrakPresenter
{
	private $tabelpasien;
	private $data = [];

	function __construct()
	{
		try {
			// Inisialisasi objek TabelPasien
			$db_host = "localhost"; // ganti dengan host database Anda
			$db_user = "root"; // ganti dengan username database Anda
			$db_password = ""; // ganti dengan password database Anda
			$db_name = "mvp_php"; // ganti dengan nama database Anda
			$this->tabelpasien = new TabelPasien($db_host, $db_user, $db_password, $db_name);
			$this->data = array();

// 			// Check apakah terdapat parameter 'action' di URL
// // Di dalam __construct atau di mana saja yang sesuai
// 			if (isset($_GET['action'])) {
// 				if ($_GET['action'] === 'delete') {
// 					// Cek apakah parameter 'id' disertakan dalam request
// 					if (isset($_GET['id'])) {
// 						// Ambil ID pasien dari URL
// 						$id_pasien = $_GET['id'];
// 						// Panggil fungsi deletePasien dengan ID pasien yang sesuai
// 						$this->deletePasien($id_pasien);
// 						// Redirect ke halaman setelah penghapusan berhasil
// 						header("Location: index.php"); // Ganti tampil.php dengan halaman yang sesuai
// 						exit(); // Hentikan eksekusi skrip
// 					} else {
// 						// Tampilkan pesan kesalahan jika parameter id tidak ada
// 						echo "Error: Parameter ID tidak ditemukan.";
// 					}
// 				}
// 			}
			if (isset($_GET['delete'])) {
				$this->deletePasien($_GET['delete']);
			}

		} catch (Exception $e) {
			echo "wiw error" . $e->getMessage();
		}
	}

	// Fungsi untuk mengambil data pasien
	function prosesDataPasien()
	{
		try {
			// Mengambil data di tabel pasien
			$this->tabelpasien->open();
			$this->tabelpasien->getPasien();
			while ($row = $this->tabelpasien->getResult()) {
				// Ambil hasil query
				$pasien = new Pasien(); // Instansiasi objek pasien untuk setiap data pasien
				$pasien->setId($row['id']); // Mengisi id
				$pasien->setNik($row['nik']); // Mengisi nik
				$pasien->setNama($row['nama']); // Mengisi nama
				$pasien->setTempat($row['tempat']); // Mengisi tempat
				$pasien->setTl($row['tl']); // Mengisi tl
				$pasien->setGender($row['gender']); // Mengisi gender
				$pasien->setTelp($row['telp']); // Mengisi gender
				$pasien->setEmail($row['email']); // Mengisi gender

				$this->data[] = $row; // Tambahkan data pasien ke dalam list
			}
			// Tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			// Memproses error
			echo "Error: " . $e->getMessage();
		}
	}

	// Fungsi untuk menghapus data pasien
	function deletePasien($id)
	{
		$this->tabelpasien->open();
		$this->tabelpasien->deletePasien($id);
		$this->tabelpasien->close();
	}

	// function updatePasien($id, $data)
	// {
	//     try {
	//         $this->tabelpasien->updatePasien($id, $data);
	//     } catch (Exception $e) {
	//         // Tangani kesalahan jika terjadi
	//         echo "Error saat mengedit pasien: " . $e->getMessage();
	//     }
	// }
	function getId($i)
	{
		//mengembalikan id Pasien dengan indeks ke i
		return $this->data[$i]['id'];
	}
	function getNik($i)
	{
		//mengembalikan nik Pasien dengan indeks ke i
		return $this->data[$i]['nik'];
	}
	function getNama($i)
	{
		//mengembalikan nama Pasien dengan indeks ke i
		return $this->data[$i]['nama'];
	}
	function getTempat($i)
	{
		//mengembalikan tempat Pasien dengan indeks ke i
		return $this->data[$i]['tempat'];
	}
	function getTl($i)
	{
		//mengembalikan tanggal lahir(TL) Pasien dengan indeks ke i
		return $this->data[$i]['tl'];
	}
	function getGender($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['gender'];
	}
	function getTelp($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['telp'];
	}
	function getEmail($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['email'];
	}
	function getSize()
	{
		return sizeof($this->data);
	}
}
