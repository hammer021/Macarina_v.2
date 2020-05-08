<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller
{


    public function index()
    {
        $this->load->view("vshop");
    }
   
    public function Shop2()
    {
        $this->load->view("vshop2");
    }
    
}