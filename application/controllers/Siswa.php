<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class Siswa extends CI_Controller {

    private $filename = "import_data";

    public function __construct(){
        parent::__construct();
        $this->load->model('SiswaModel');
    }

    public function index(){
        $data['siswa'] = $this->SiswaModel->view();

        $this->load->view('templates/header_admin');
        $this->load->view('admin/content/view', $data);
        $this->load->view('templates/footer_admin');
    }

    public function form(){

        $data = array();

        if(isset($_POST['preview'])){

            $upload = $this->SiswaModel->upload_file($this->filename);

            if($upload['result'] == "success"){

                // Load PHPExcel
                include APPPATH.'third_party/PHPExcel/PHPExcel.php';

                $csvreader = PHPExcel_IOFactory::createReader('CSV');

                // Supaya delimiter aman
                $csvreader->setDelimiter(',');
                $csvreader->setEnclosure('"');
                $csvreader->setSheetIndex(0);

                // Gunakan path absolut
                $loadcsv = $csvreader->load(FCPATH.'csv/'.$this->filename.'.csv');

                $sheet = $loadcsv->getActiveSheet()->getRowIterator();

                $data['sheet'] = $sheet;

            }else{

                $data['upload_error'] = $upload['error'];

            }
        }

        $this->load->view('templates/header_admin');
        $this->load->view('admin/content/form', $data);
        $this->load->view('templates/footer_admin');
    }

    // public function import(){

    //     include APPPATH.'third_party/PHPExcel/PHPExcel.php';

    //     $csvreader = PHPExcel_IOFactory::createReader('CSV');

    //     $csvreader->setDelimiter(',');
    //     $csvreader->setEnclosure('"');
    //     $csvreader->setSheetIndex(0);

    //     $loadcsv = $csvreader->load(FCPATH.'csv/'.$this->filename.'.csv');

    //     $sheet = $loadcsv->getActiveSheet()->getRowIterator();

    //     $data = array();

    //     $numrow = 1;

    //     foreach($sheet as $row){

    //         if($numrow > 1){

    //             $cellIterator = $row->getCellIterator();
    //             $cellIterator->setIterateOnlyExistingCells(false);

    //             $get = array();

    //             foreach ($cellIterator as $cell) {
    //                 $get[] = $cell->getValue();
    //             }

    //             $nis      = isset($get[0]) ? $get[0] : "";
    //             $nama     = isset($get[1]) ? $get[1] : "";
    //             $jk       = isset($get[2]) ? $get[2] : "";
    //             $alamat   = isset($get[3]) ? $get[3] : "";
    //             $kelas    = isset($get[4]) ? $get[4] : "";
    //             $angkatan = isset($get[5]) ? $get[5] : "";

    //             // Validasi minimal data
    //             if($nis != "" && $nama != ""){

    //                 $data[] = array(
    //                     'nis' => $nis,
    //                     'nama' => $nama,
    //                     'jk' => $jk,
    //                     'alamat' => $alamat,
    //                     'kelas' => $kelas,
    //                     'angkatan' => $angkatan
    //                 );

    //             }
    //         }

    //         $numrow++;
    //     }

    //     // Insert ke database
    //     if(!empty($data)){
    //         $this->SiswaModel->insert_multiple($data);
    //     }

    //     redirect("Siswa");

    // }

	public function import()
	{
		$file = $_FILES['file']['tmp_name'];

		if (($handle = fopen($file, "r")) !== FALSE) {

			$data = [];
			$no = 0;

			while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {

				if ($no > 0) { // skip header

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

	// public function import_excel()
	// {
	// 	include APPPATH.'third_party/vendor/autoload.php';

	// 	$file = $_FILES['file']['tmp_name'];

	// 	$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

	// 	$sheet = $spreadsheet->getActiveSheet()->toArray();

	// 	$data = [];

	// 	$numrow = 1;

	// 	foreach($sheet as $row){

	// 		if($numrow > 1){ // skip header

	// 			$data[] = [
	// 				'nis' => $row[0],
	// 				'nama' => $row[1],
	// 				'jk' => $row[2],
	// 				'alamat' => $row[3],
	// 				'kelas' => $row[4],
	// 				'angkatan' => $row[5]
	// 			];

	// 		}

	// 		$numrow++;

	// 	}

	// 	$this->SiswaModel->insert_multiple($data);

	// 	redirect('Siswa');
	// }

	public function import_excel()
{
    $file = $_FILES['file']['tmp_name'];

    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet()->toArray();

    $data = [];

    foreach ($sheet as $key => $row) {

        if ($key == 0) continue; // skip header

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