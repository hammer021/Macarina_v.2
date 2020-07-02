<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';

class Barang extends REST_Controller {
    public function __construct() {
        parent::__construct();
        // Load Akun Model
        $this->load->model('Barang_model', 'a');
    }

    public function index_get()
    {
        $id = $this->get('id_reseller');
        if ($id === null || $id === ''){
            $this->response([
                'status' => FALSE,
                'message' => 'Masukkan Email Anda'
            ], REST_Controller::HTTP_NOT_FOUND);
        }else{
            $riwayat = $this->a->getDataTrans($id);
            $this->response([
                'status' => TRUE,
                'data' => $riwayat
            ], REST_Controller::HTTP_OK);
        }
    }
} 