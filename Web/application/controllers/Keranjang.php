<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("produk");
        $this->load->library('form_validation');
    }

    public function index()
    {
       // $data["barang"] = $this->shop_model->getAll();
        $this->load->view("vcart");
    }
   
    
    
}