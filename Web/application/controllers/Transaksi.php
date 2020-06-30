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

    
    // public function edit($id_reseller = null)
    // {
       
    //     if (!isset($id_reseller)) redirect('Reseller');
       
    //     $reseller = $this->reseller_model;
    //     $validation = $this->form_validation;
    //     $validation->set_rules($reseller->rules());

    //     if ($validation->run()) {
    //         $reseller->update();
    //         $this->session->set_flashdata('success', 'Berhasil disimpan');
    //         redirect(site_url('Reseller'));
    //     }

    //     $data["reseller"] = $reseller->getById($id_reseller);
    //     if (!$data["reseller"]) show_404();
        
    //     $this->load->view("modal/edit_reseller", $data);
                   
        
    // }
  
    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->transaksi_model->delete($id)) {
            redirect(site_url('Transaksi'));
        }
    }
    
}