<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("transaksi_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["transaksi"] = $this->transaksi_model->getAllTrans();
        $this->load->view("vtransaksi",$data);
    }

    
    public function tampil($kd = null)
    {
       
        if (!isset($kd)) redirect('Transaksi');
       
        $transaksi = $this->transaksi_model;
        $data["dettransaksi"] = $transaksi->getDataDetail($kd);
        $data["transaksi"] = $transaksi->getDataTrans($kd);
        
        $this->load->view("modal/detail_transaksi", $data);
                   
        
    }
  public function bayar($id = null)
  {
      $trans=$this->transaksi_model->updateBayar($id);
        
      redirect(site_url('Transaksi'));

  }
    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->transaksi_model->delete($id)) {
            redirect(site_url('Transaksi'));
        }
    }
    
}