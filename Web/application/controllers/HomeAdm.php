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
		$this->load->model('reseller_model');
		$this->load->model('produk_model');
		
		$data["res"] = $this->reseller_model->getAll();
		$data["barangs"] = $this->produk_model->getAll();
		$this->load->view('vHomeAdm',$data);
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
	public function transaksi()
    {
        redirect(site_url("Transaksi"));
	}
}
