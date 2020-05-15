<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	//function __construct(){
	//	parent::__construct();
	
	//	if($this->session->userdata('status') != "login"){
	//		redirect(site_url("Login"));
	//	}
	//}
	
	public function index()
	{
		$this->load->view('vhome');
    }
    
    public function barang()
    {
        redirect(site_url("Produk"));
	}

	public function reseller()
    {
        redirect(site_url("Reseller"));
	}

	public function profil()
    {
        $this->load->view('vProfilPerusahaan');
	}
	
	public function shop()
    {
        $this->load->view('vshop');
	}
	public function kontak()
    {
        $this->load->view('vkontak');
	}
}
