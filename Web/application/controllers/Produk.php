<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("produk_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["barang"] = $this->produk_model->getAll();
        $data["kemasan"] = $this->produk_model->getKemasan();
        $data["varian"] = $this->produk_model->getVarian();
        $this->load->view("vbarang",$data);
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

        redirect(site_url("Produk"));
    }
    
    public function edit($kd_barang = null)
    {
       
        if (!isset($kd_barang)) redirect('Produk');
       
        $produk = $this->produk_model;
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());

        if ($validation->run()) {
            $produk->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('Produk'));
        }

        $data["barang"] = $produk->getById($kd_barang);
        $data["kemasan"] = $this->produk_model->getKemasan();
        $data["varian"] = $this->produk_model->getVarian();
        if (!$data["barang"]) show_404();
        
        $this->load->view("modal/edit_barang", $data);
                   
        
    }
  
    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->produk_model->delete($id)) {
            redirect(site_url('Produk'));
        }
    }
    
}