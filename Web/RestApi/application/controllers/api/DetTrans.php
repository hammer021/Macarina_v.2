<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class DetTrans extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Det_model' , 'a');
    }

    public function index_post(){
        $id_reseller = $this->input->post('id_reseller');
        $kodebarang = $this->input->post('kd_barang');
        $qtydet = $this->input->post('qty_det');
        $subtotal = $this->input->post('subtotal');

        $cek = $this->db->get_where('barang', ['kd_barang' => $kodebarang])->row_array();
        // if ($cek > 0) {
        //     $response = [
        //         'status' => false,
        //         'message' => 'Email Telah Digunakan',
        //     ];
        // }else {
        $harga = $cek['harga'];
        $stok = $cek['stok'];

        if($qtydet > $stok){
            $response = [
                'status' => false,
                'pesan' => 'Gagal menambahkan, stok tidak mencukupi',
            ];
        } else {
            $arr = [
                'kd_barang' => $kodebarang,
                'qty_det' => $qtydet,
                'subtotal' => ($qtydet*$harga),
                'id_reseller' => $id_reseller,
                'status' => "Added to cart"
            ];
            
            $input = $this->a->insert('detail_transaksi', $arr);
            $this->db->set('stok', ($stok-$qtydet));
            $this->db->where('kd_barang', $kodebarang);
            $this->db->update('barang');


            $response = [
                'status' => true,
                'pesan' => 'Data berhasil ditambahkan di Cart',
            ];
        }
        
        $this->response($response, 200);
    }
    public function index_get()
    {
        $id = $this->get('id_reseller');
        if ($id === null || $id === ''){
            $this->response([
                'status' => FALSE,
                'message' => 'Data tidak dapat ditampilkan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }else{
            $riwayat = $this->a->getDataDetTrans($id);
            $this->response([
                'status' => TRUE,
                'data' => $riwayat
            ], REST_Controller::HTTP_OK);
        }
    }


}