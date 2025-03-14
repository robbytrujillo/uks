<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

	/**
	 * Menampilkan data yang sudah di-import.
	 *
	 */
	public function index()
	{
		$data['tb_siswa'] = $this->SiswaModel->get_all();
		$this->load->view('data', $data);
	}
}