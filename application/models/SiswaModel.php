<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SiswaModel extends CI_Model {

    // Menampilkan semua data siswa
    public function view(){
        return $this->db->get('tb_siswa')->result();
    }

    // Fungsi upload file CSV
    public function upload_file($filename){

        $this->load->library('upload');

        $config['upload_path']   = FCPATH.'csv/';   // path absolut
        $config['allowed_types'] = 'csv';
        $config['max_size']      = 2048;            // 2MB
        $config['overwrite']     = true;
        // $config['file_name']     = $filename;
        $config['file_name'] = time().'_siswa';

        $this->upload->initialize($config);

        if(!$this->upload->do_upload('file')){
            return array(
                'result' => 'failed',
                'file'   => '',
                'error'  => $this->upload->display_errors()
            );
        }else{
            return array(
                'result' => 'success',
                'file'   => $this->upload->data(),
                'error'  => ''
            );
        }
    }

    // Insert banyak data sekaligus
    public function insert_multiple($data){

        if(!empty($data)){
            return $this->db->insert_batch('tb_siswa', $data);
        }

        return false;
    }

    // Insert 1 data
    public function insert($data){
        return $this->db->insert('tb_siswa', $data);
    }

    // Ambil 1 data by NIS
    public function getById($nis){
        return $this->db->get_where('tb_siswa', ['nis' => $nis])->row();
    }

    // Update data
    public function update($nis, $data){
        $this->db->where('nis', $nis);
        return $this->db->update('tb_siswa', $data);
    }

    // Delete data
    public function delete($nis){
        $this->db->where('nis', $nis);
        return $this->db->delete('tb_siswa');
    }

}