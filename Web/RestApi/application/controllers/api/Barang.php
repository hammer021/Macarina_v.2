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
            $riwayat = $this->a->index($id);
            $this->response([
                'status' => TRUE,
                'data' => $riwayat
            ], REST_Controller::HTTP_OK);
        }
    }

    public function ori_get()
    {
        $orinya = $this->a->ori();
        $this->response([
            'status' => TRUE,
            'data' => $orinya
        ], REST_Controller::HTTP_OK);
    }
    public function coklat_get()
    {
        $orinya = $this->a->coklat();
        $this->response([
            'status' => TRUE,
            'data' => $orinya
        ], REST_Controller::HTTP_OK);
    }
    public function box_get()
    {
        $orinya = $this->a->box();
        $this->response([
            'status' => TRUE,
            'data' => $orinya
        ], REST_Controller::HTTP_OK);
    }

    
} 