<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller
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
        $this->load->view("vshop2",$data);
    }
   
    public function Shop2()
    {
        $this->load->view("vshop");
    }
    
}