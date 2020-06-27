<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class RegistrasiReseller extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Reseller_model' , 'a');
    }

    public function index_post(){
        
        $nama_reseller = $this->input->post('nama_reseller');
        $email = $this->input->post('email');
        $no_tlp = $this->input->post('no_tlp');
        $password = md5($this->input->post('password'));

        $cek = $this->db->get_where('reseller', ['email' => $email])->row_array();
        if ($cek > 0) {
            $response = [
                'status' => false,
                'message' => 'Email Telah Digunakan',
            ];
        }else {
            $arr = [      
                'id_reseller' => uniqid(),          
                'nama_reseller' => $nama_reseller,
                'email' => $email,
                'no_tlp' => $no_tlp,
                'password' => $password,
                'status' => 1,
            ];
            $cek = $this->a->insert('reseller', $arr);

            $response = [
                'status' => true,
                'pesan' => 'Pendaftaran Akun Berhasil',
            ];
        }
        $this->response($response, 200);
    }


}