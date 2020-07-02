<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('mdaftar');
 
	}
 
	function index(){
		$this->load->view('vdaftar');
	}
    
	function aksi_daftar(){
        $this->form_validation->set_rules('nama', 'NAMA-LENGKAP','required');
        $this->form_validation->set_rules('no_tlp', 'NO-HP','required');
        $this->form_validation->set_rules('email','EMAIL','required|valid_email');
        $this->form_validation->set_rules('password','PSW','required');
        $this->form_validation->set_rules('rptpass','PSW-REPEAT','required|matches[password]');
        if($this->form_validation->run() == FALSE) {
            $this->load->view('vdaftar');
        }else{

            $data = $this->input->post('nama-lengkap');
            $data = $this->input->post('no-hp');
            $data = $this->input->post('email');
            $data = $this->input->post('psw');
            $data = $this->input->post('psw-repeat');
            $data = 0;

            $this->mdaftar->daftar($data);
            
            $pesan['message'] =    "Pendaftaran berhasil";
            
            $this->load->view($pesan);
        }
    }
}

