<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class Siswa extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('SiswaModel');

        // proteksi login
        if($this->session->userdata('status') != 'login'){
            redirect(base_url());
        }
    }

    // ================= LIST DATA =================
    public function index(){
        $data['siswa'] = $this->SiswaModel->view();

        $this->load->view('templates/header_admin');
        $this->load->view('admin/content/view', $data);
        $this->load->view('templates/footer_admin');
    }

    // ================= FORM TAMBAH =================
    public function tambah(){
        $this->load->view('templates/header_admin');
        $this->load->view('admin/content/tambah_siswa');
        $this->load->view('templates/footer_admin');
    }

    // ================= SIMPAN =================
    public function store(){

        $data = [
            'nis' => $this->input->post('nis'),
            'nama' => $this->input->post('nama'),
            'jk' => $this->input->post('jk'),
            'alamat' => $this->input->post('alamat'),
            'kelas' => $this->input->post('kelas'),
            'angkatan' => $this->input->post('angkatan'),
        ];

        $this->SiswaModel->insert($data);

        redirect('Siswa');
    }

    // ================= EDIT =================
    public function edit($nis){
        $data['siswa'] = $this->SiswaModel->getById($nis);

        $this->load->view('templates/header_admin');
        $this->load->view('admin/content/ubah_siswa', $data);
        $this->load->view('templates/footer_admin');
    }

    // ================= UPDATE =================
    public function update(){

        $nis = $this->input->post('nis');

        $data = [
            'nama' => $this->input->post('nama'),
            'jk' => $this->input->post('jk'),
            'alamat' => $this->input->post('alamat'),
            'kelas' => $this->input->post('kelas'),
            'angkatan' => $this->input->post('angkatan')
        ];

        $this->SiswaModel->update($nis, $data);

        redirect('Siswa');
    }

    // ================= DELETE =================
    public function delete($nis){
        $this->SiswaModel->delete($nis);
        redirect('Siswa');
    }

    // ================= IMPORT CSV =================
    public function import(){
        $file = $_FILES['file']['tmp_name'];

        if (($handle = fopen($file, "r")) !== FALSE) {

            $data = [];
            $no = 0;

            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {

                if ($no > 0) {
                    $data[] = [
                        'nis' => $row[0],
                        'nama' => $row[1],
                        'jk' => $row[2],
                        'alamat' => $row[3],
                        'kelas' => $row[4],
                        'angkatan' => $row[5]
                    ];
                }

                $no++;
            }

            fclose($handle);
            $this->SiswaModel->insert_multiple($data);
        }

        redirect('Siswa');
    }

    // ================= IMPORT EXCEL =================
    public function import_excel(){

        $file = $_FILES['file']['tmp_name'];
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        $data = [];

        foreach ($sheet as $key => $row) {
            if ($key == 0) continue;

            $data[] = [
                'nis' => $row[0],
                'nama' => $row[1],
                'jk' => $row[2],
                'alamat' => $row[3],
                'kelas' => $row[4],
                'angkatan' => $row[5]
            ];
        }

        $this->SiswaModel->insert_multiple($data);

        redirect('Siswa');
    }
}