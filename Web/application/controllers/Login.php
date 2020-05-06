<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('mlogin');
 
	}
 
	function index(){
		$this->load->view('vlogin');
	}
	
	function aksi_login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$where = array(
			'email' => $email,
			'password' => $password
			);
		$cek = $this->mlogin->cek_login("reseller",$where)->num_rows();
		if($cek > 0){
	 
			$data_session = array(
				'email' => $email,
				'status' => "login"
				);
	 
			$this->session->set_userdata($data_session);
	 
			redirect(base_url("Home"));
		}else{
			echo "Username dan password salah !";
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('Login/index'));
	}
}
