<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class AddCart extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Cart_model' , 'a');
    }

    public function index_post(){
        $iddetail = $this->input->post('id_detail');
        $kodebarang = $this->input->post('kd_barang');
        $qtydet = md5($this->input->post('qty_det'));
        $kodeku = $this->a->randomkode(32);
        $subtotal = $this->input->post('subtotal');

        $cek = $this->db->get_where('detail_transaksi', ['id_detail' => $iddetail])->row_array();
        $kode = $this->a->buat_kode();
        if ($cek > 0) {
            $response = [
                'status' => false,
                'message' => 'Email Telah Digunakan',
            ];
        }else {
            $arr = [
                'id_detail' => $kode,
                'kd_barang' => $kodebarang,
                'qty_det' => $qtydet,
                'subtotal' => $subtotal,
                'status' => "Added to Cart",
            ];
            $cek = $this->a->insert('detail_transaksi', $arr);

            $response = [
                'status' => true,
                'pesan' => 'Pendaftaran Akun Berhasil',
            ];
        }
        $this->response($response, 200);
    }


}