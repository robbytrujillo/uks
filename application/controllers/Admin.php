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
// 		$data['sakit'] = $this->db->query('SELECT COUNT(nama) AS data, `id_sakit`, `nis`, `nama`, `kelas`, `alamat`, `tgl_sakit`, `tekanan_darah`, `suhu`, `keluhan`, `diagnosa`, `penanganan` FROM `tb_sakit` GROUP BY nama ORDER BY COUNT(nama) DESC
// 			')->result();

    $this->load->library('pagination');

    $limit = 5;

    // offset aman dari null
    $start = $this->uri->segment(3);
    $start = ($start !== null && is_numeric($start)) ? (int)$start : 0;
    $data['start'] = $start;

    /*
    =========================
    HITUNG TOTAL DATA
    =========================
    */
    $total_rows = $this->db->query("
        SELECT COUNT(*) as total FROM (
            SELECT nama
            FROM tb_sakit
            GROUP BY nama
        ) as hasil
    ")->row()->total;

    /*
    =========================
    CONFIG PAGINATION
    =========================
    */
    $config['base_url'] = base_url('admin/index/');
    $config['total_rows'] = $total_rows;
    $config['per_page'] = $limit;
    $config['uri_segment'] = 3;
    $config['use_page_numbers'] = FALSE;

    // Bootstrap style
    $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center mt-4">';
    $config['full_tag_close'] = '</ul></nav>';

    $config['first_link'] = false;
    $config['last_link'] = false;

    $config['prev_link'] = '&laquo;';
    $config['next_link'] = '&raquo;';

    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';

    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $config['attributes'] = array('class' => 'page-link');

    $this->pagination->initialize($config);

    /*
    =========================
    QUERY DATA PAGINATION
    =========================
    */
    $data['sakit'] = $this->db->query("
        SELECT 
            COUNT(nama) AS data,
            id_sakit,
            nis,
            nama,
            kelas,
            alamat,
            tgl_sakit,
            tekanan_darah,
            suhu,
            keluhan,
            diagnosa,
            penanganan
        FROM tb_sakit
        GROUP BY nama
        ORDER BY COUNT(nama) DESC
        LIMIT {$start}, {$limit}
    ")->result();

    $data['pagination'] = $this->pagination->create_links();

    /*
    =========================
    LOAD VIEW
    =========================
    */

        

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