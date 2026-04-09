<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		$this->load->view('templates/header_login');
		$this->load->view('auth/login');
		$this->load->view('templates/footer_login');
	}

	public function login()
	{
		// $user = $this->input->post('username');
		// $password = $this->input->post('password');

		// $pass = md5($password);

		// $data = $this->db->get_where('tb_pegawai' , ['username' => $user])->row_array();

		// if ($data['password'] == $pass) {
		// 	$data_session = array(
		// 		'username' => $data['username'],
		// 		'status' => 'login'
		// 	);

		// 	$this->session->set_userdata($data_session);
		// 	redirect('admin');
		// }else{
		// 	$this->session->set_flashdata('msg','Username / Password Salah!');
		// 	redirect('');
		// }

		$user = $this->input->post('username');
		$password = md5($this->input->post('password'));

    	$data = $this->db->get_where('tb_pegawai', ['username' => $user])->row_array();

    	if($data){

        	if($data['password'] == $password){

				$data_session = array(
					'id' => $data['id'],
					'username' => $data['username'],
					'role' => $data['role'], // ambil role
					'status' => 'login'
				);

            $this->session->set_userdata($data_session);

            redirect('admin');

			}else{

				$this->session->set_flashdata('msg','Password Salah!');
				redirect('');

			}

    	}else{

        $this->session->set_flashdata('msg','Username tidak ditemukan!');
        redirect('');

    }
	}

	public function logout(){
		$this->session->sess_destroy();

		redirect(base_url());
	}
}