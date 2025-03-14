<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Model {

    /**
     * Constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fungsi untuk insert data ke dalam database.
     *
     */
    public function save($data)
    {
        return $this->db->insert('tb_siswa', $data);
    }

    /**
     * Fungsi untuk menampilkan data dari database.
     *
     */
    public function get_all()
    {
        return $this->db->get('tb_siswa')->result_array();
    }
}