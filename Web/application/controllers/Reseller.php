<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reseller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("reseller_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["reseller"] = $this->produk_model->getAll();
        $this->load->view("vreseller",$data);
    }

    public function add()
    {
        $produk = $this->produk_model;
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());

        if ($validation->run()) {
            $produk->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        redirect(site_url("Reseller"));
    }
    
    public function edit($id_reseller = null)
    {
       
        if (!isset($id_reseller)) redirect('Produk');
       
        $produk = $this->produk_model;
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());

        if ($validation->run()) {
            $produk->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('Reseller'));
        }

        $data["reseller"] = $produk->getById($id_reseller);
        if (!$data["reseller"]) show_404();
        
        $this->load->view("modal/edit_reseller", $data);
                   
        
    }
  
    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->produk_model->delete($id)) {
            redirect(site_url('Reseller'));
        }
    }
    
}