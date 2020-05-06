<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeAdm extends CI_Controller {

	//function __construct(){
	//	parent::__construct();
	
	//	if($this->session->userdata('status') != "login"){
	//		redirect(site_url("Login"));
	//	}
	//}
	
	public function index()
	{
		$this->load->view('vHomeAdm');
    }
    
    public function barang()
    {
        redirect(site_url("Produk"));
	}

	public function reseller()
    {
        redirect(site_url("Reseller"));
	}

	public function charts()
    {
        $this->load->view('vcharts');
	}
	
	public function shop()
    {
        $this->load->view('Shop');
	}
}
