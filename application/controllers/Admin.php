<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');

		if($this->session->userdata('status') != 'login') {
			redirect(base_url());
		}
	}

	public function index()
	{
		$data['sakit'] = $this->db->query('SELECT COUNT(nama) AS data, `id_sakit`, `nis`, `nama`, `kelas`, `alamat`, `tgl_sakit`, `tekanan_darah`, `suhu`, `keluhan`, `diagnosa`, `penanganan` FROM `tb_sakit` GROUP BY nama ORDER BY COUNT(nama) DESC
			')->result();
         
		
		$this->load->view('templates/header_admin');
		$this->load->view('admin/admin', $data);
		$this->load->view('templates/footer_admin');
	}

	public function siswa(){
		// $this->db->order_by('tgl_sakit' , 'DESC');
		// $data['sakit'] = $this->db->get('tb_sakit')->result();

		$this->db->select('tb_sakit.*, tb_petugas.nama_petugas');
		$this->db->from('tb_sakit');
		$this->db->join('tb_petugas', 'tb_petugas.id = tb_sakit.id_petugas', 'left');
		$this->db->order_by('tb_sakit.tgl_sakit', 'DESC');
		$data['sakit'] = $this->db->get()->result();

		$this->load->view('templates/header_admin');
		$this->load->view('admin/content/input_sakit' , $data);
		$this->load->view('templates/footer_admin');
	}

	public function cari(){
		$nama = $this->input->post('nama');

		$data['siswa'] = $this->db->get_where('tb_siswa' , ['nama' => $nama])->result();
		$data['petugas'] = $this->db->get('tb_petugas')->result(); // ✅ TAMBAHKAN INI
		
		$nis = $this->db->get_where('tb_siswa' , ['nama' => $nama])->row_array();

		if ($nis == null) {
			$this->session->set_flashdata('cari', 'Siswa dengan nama tersebut tidak ada !!!');
			redirect(base_url('admin/siswa'));
		}else{
			$this->load->view('templates/header_admin');
			$this->load->view('admin/content/data_siswa' , $data);
			$this->load->view('templates/footer_admin');
		}
	}

	public function add($nis){
	date_default_timezone_set('Asia/Jakarta');	
	
	$get = $this->db->get_where('tb_siswa' , ['nis' => $nis])->row_array();
	
	// Ambil dari input datetime-local
    $tgl_input = $this->input->post('tgl_sakit');

    // Ubah format 2026-02-26T10:30 menjadi 2026-02-26 10:30:00
    $tgl_sakit = str_replace("T", " ", $tgl_input) . ":00";
	
	$uwa = $get['nis'];
		$data = [
			'nis' => $uwa,
			'nama' => $get['nama'],
			'kelas' => $get['kelas'],
			'alamat' => $get['alamat'],
			// 'tgl_sakit' => date('Y-m-d'),
			'tgl_sakit' => $tgl_sakit, // ✅ sekarang simpan jam
			'tekanan_darah' => $this->input->post('tekanan_darah'),
			'suhu' => $this->input->post('suhu'),
			'keluhan' => $this->input->post('keluhan'),
			'diagnosa' => $this->input->post('diagnosa'),
			'penanganan' =>$this->input->post('penanganan'),
			'id_petugas' => $this->input->post('id_petugas') // ✅ TAMBAHKAN
		];

		$this->db->insert('tb_sakit' , $data);

		redirect(base_url('admin/siswa'));
	}

	public function delete($id){
		$where = ['id_sakit' => $id];
		$this->db->where($where);
		$this->db->delete('tb_sakit');
		$this->session->set_flashdata('flash', 'Dihapus');

		redirect(base_url('admin/siswa'));
	}

	public function edit($id){
		$data['sakit'] = $this->db->get_where('tb_sakit' , ['id_sakit' => $id])->result();
		$data['petugas'] = $this->db->get('tb_petugas')->result(); // ✅ TAMBAHKAN

		$this->load->view('templates/header_admin');
		$this->load->view('admin/content/edit_siswa' , $data);
		$this->load->view('templates/footer_admin');

	}

	public function update($id){
		// $get = $this->db->get_where('tb_sakit' , ['id_sakit' => $id])->row_array();
		// $uwa = $get['nis'];
		// $data = [
		// 	'nis' => $uwa,
		// 	'tgl_sakit' => $this->input->post('tgl_sakit'),
		// 	'tekanan_darah' => $this->input->post('tekanan_darah'),
		// 	'suhu' => $this->input->post('suhu'),
		// 	'keluhan' => $this->input->post('keluhan'),
		// 	'diagnosa' => $this->input->post('diagnosa'),
		// 	'penanganan' => $this->input->post('penanganan')
		// ];
		

		// $where = array('id_sakit' => $id);
		// $this->db->where($where);
		// $this->db->update('tb_sakit' , $data);


		// redirect(base_url('admin/siswa'));

		date_default_timezone_set('Asia/Jakarta');

		
		$tgl_input = $this->input->post('tgl_sakit');
		$tgl_sakit = str_replace("T", " ", $tgl_input) . ":00";

		$data = [
			'tgl_sakit' => $tgl_sakit,
			'tekanan_darah' => $this->input->post('tekanan_darah'),
			'suhu' => $this->input->post('suhu'),
			'keluhan' => $this->input->post('keluhan'),
			'diagnosa' => $this->input->post('diagnosa'),
			'penanganan' => $this->input->post('penanganan'),
			'id_petugas' => $this->input->post('id_petugas')
		];

		$this->db->where('id_sakit', $id);
		$this->db->update('tb_sakit' , $data);

		redirect(base_url('admin/siswa'));
	}

	public function report(){
		$report['data'] = $this->db->get('tb_sakit')->result();

		$this->load->view('templates/header_admin');
		$this->load->view('admin/content/report' , $report);
		$this->load->view('templates/footer_admin');
	}

	public function laporan($date){
		$date = date('Y-m-d');
		$where = array('tgl_sakit' => $date);
		$laporan['data'] = $this->db->get_where('tb_sakit' , ['tgl_sakit' => $date])->result();

		$this->load->view('templates/header_laporan');
		$this->load->view('admin/content/laporan' , $laporan);
		$this->load->view('templates/footer_admin');
	}

	public function laporanbulanan(){
		$bulan = $this->input->post('bulan');

		$this->db->select('*');
		$this->db->from('tb_sakit');
		$this->db->where('MONTH(tgl_sakit)' , $bulan);
		$laporan['data'] = $this->db->get()->result();

		if ($bulan == null) {
			redirect(base_url('admin/report'));
		}else{
			if ($bulan == '01') {
			$laporan['bulan'] = 'Januari';
			}elseif ($bulan == '02') {
				$laporan['bulan'] = 'Februari';
			}elseif ($bulan == '03') {
				$laporan['bulan'] = 'Maret';
			}elseif ($bulan == '04') {
				$laporan['bulan'] = 'April';
			}elseif ($bulan == '05') {
				$laporan['bulan'] = 'Mei';
			}elseif ($bulan == '06') {
				$laporan['bulan'] = 'Juni';
			}elseif ($bulan == '07') {
				$laporan['bulan'] = 'Juli';
			}elseif ($bulan == '08') {
				$laporan['bulan'] = 'Agustus';
			}elseif ($bulan == '09') {
				$laporan['bulan'] = 'September';
			}elseif ($bulan == '10') {
				$laporan['bulan'] = 'Oktober';
			}elseif ($bulan == '11') {
				$laporan['bulan'] = 'November';
			}elseif ($bulan == '12') {
				$laporan['bulan'] = 'Desember';
			}

			$this->load->view('templates/header_laporan');
			$this->load->view('admin/content/laporanbulanan' , $laporan);
			$this->load->view('templates/footer_admin');
		}
		
	}

}

?>