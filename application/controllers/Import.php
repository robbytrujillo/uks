<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

	/**
	 * Menampilkan halaman import data.
	 *
	 */
	public function index()
	{
		// Action form.
		$data['action'] = site_url('import/process');

		$this->load->view('import', $data);
	}

	/**
	 * Memproses data yang di-import.
	 *
	 */
	public function process()
	{
		if ( isset($_POST['import'])) {

            $file = $_FILES['tb_siswa']['tmp_name'];

			// Mendapatkan ekstensi file csv yang akan di-import.
			$ekstensi  = explode('.', $_FILES['pelanggan']['name']);

			// Tampilkan peringatan jika submit tanpa memilih menambahkan file.
			if (empty($file)) {
				echo 'File tidak boleh kosong!';
			} else {
				// Validasi apakah file yang di-upload benar-benar file csv.
				if (strtolower(end($ekstensi)) === 'csv' && $_FILES["pelanggan"]["size"] > 0) {

					$i = 0;
					$handle = fopen($file, "r");
					while (($row = fgetcsv($handle, 2048))) {
						$i++;
						if ($i == 1) continue;

						// Data yang akan disimpan ke dalam database
						$data = [
							'nis' => $row[0],
							'nama' => $row[1],
							'jk' => $row[2],
							'alamat' => $row[3],
							'kelas' => $row[4],
							'angkatan' => $row[5],
						];

						// Simpan data ke database.
						$this->Siswa->save($data);
					}

					fclose($handle);
					redirect('data');

				} else {
					echo 'Format file tidak valid!';
				}
			}
        }
	}
}