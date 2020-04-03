<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("mmobil");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["mobilku"] = $this->mmobil->getAll();
        $this->load->view("vtables", $data);
    }

    public function add()
    {
        $mobil = $this->mmobil;
        $validation = $this->form_validation;
        $validation->set_rules($mobil->rules());

        if ($validation->run()) {
            $mobil->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("vtables");
    }

    public function edit($id_mobil = null)
    {
        if (!isset($id_mobil)) redirect('Mobil');
       
        $mobil = $this->mmobil;
        $validation = $this->form_validation;
        $validation->set_rules($mobil->rules());

        if ($validation->run()) {
            $mobil->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["mobil_sewa"] = $mobil->getById($id_mobil);
        if (!$data["mobil_sewa"]) show_404();
        
        $this->load->view("vtables", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->mmobil->delete($id)) {
            redirect(site_url('Mobil'));
        }
    }
}