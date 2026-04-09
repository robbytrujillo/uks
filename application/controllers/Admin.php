<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');

		if($this->session->userdata('status') != 'login') {
			redirect(base_url());
		}

		$this->role = $this->session->userdata('role');
	}

	private function cek_superadmin()
	{
		if ($this->session->userdata('role') != 'superadmin') {
			show_error('Akses ditolak! Hanya Superadmin yang boleh melakukan aksi ini.');
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

	public function detail($id)
	{
		$this->db->select('tb_sakit.*, tb_petugas.nama_petugas');
		$this->db->from('tb_sakit');
		$this->db->join('tb_petugas', 'tb_petugas.id = tb_sakit.id_petugas', 'left');
		$this->db->where('tb_sakit.id_sakit', $id);

		$data['detail'] = $this->db->get()->row();

		$this->load->view('templates/header_admin');
		$this->load->view('admin/content/detail_sakit', $data);
		$this->load->view('templates/footer_admin');
	}

	public function delete($id){
		$this->cek_superadmin();	

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
		$this->cek_superadmin();

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

	public function get_siswa()
	{
		$keyword = $this->input->get('term');

		$this->db->like('nama', $keyword);
		$data = $this->db->get('tb_siswa')->result();

		$result = [];

		foreach ($data as $row)
		{
			$result[] = [
				'label' => $row->nama . ' - ' . $row->kelas,
				'value' => $row->nama
			];
		}

		echo json_encode($result);
	}

	public function report(){
		$report['data'] = $this->db->get('tb_sakit')->result();

		$this->load->view('templates/header_admin');
		$this->load->view('admin/content/report' , $report);
		$this->load->view('templates/footer_admin');
	}

	public function laporan(){
		$date = date('Y-m-d');

		$laporan['data'] = $this->db->select('tb_sakit.*, tb_petugas.nama_petugas')
			->from('tb_sakit')
			->join('tb_petugas', 'tb_sakit.id_petugas = tb_petugas.id', 'left')
			->where('DATE(tb_sakit.tgl_sakit)', $date)
			->order_by('tb_sakit.tgl_sakit', 'DESC')
			->get()
			->result();

		$this->load->view('templates/header_laporan');
		$this->load->view('admin/content/laporan', $laporan);
		$this->load->view('templates/footer_admin');
	}

	public function laporanbulanan(){
	$this->cek_superadmin();

    $bulan = $this->input->post('bulan');

    if ($bulan == null) {
        redirect(base_url('admin/report'));
    }

    $laporan['data'] = $this->db->select('tb_sakit.*, tb_petugas.nama_petugas')
        ->from('tb_sakit')
        ->join('tb_petugas', 'tb_sakit.id_petugas = tb_petugas.id', 'left')
        ->where('MONTH(tb_sakit.tgl_sakit)', $bulan)
        ->order_by('tb_sakit.tgl_sakit', 'DESC')
        ->get()
        ->result();

    $nama_bulan = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];

    $laporan['bulan'] = $nama_bulan[$bulan];

    $this->load->view('templates/header_laporan');
    $this->load->view('admin/content/laporanbulanan', $laporan);
    $this->load->view('templates/footer_admin');
}

}

?>