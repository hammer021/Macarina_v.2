<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';

class Trans extends REST_Controller {
    public function __construct() {
        parent::__construct();
        // Load Akun Model
        $this->load->model('Trans_model', 'a');
        $this->load->model('Det_model', 'b');
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
    public function transBelum_get()
    {
        $id = $this->get('id_reseller');
        if ($id === null || $id === ''){
            $this->response([
                'status' => FALSE,
                'message' => 'Masukkan Email Anda'
            ], REST_Controller::HTTP_NOT_FOUND);
        }else{
            $riwayat = $this->a->getDataTransbelum($id);
            $this->response([
                'status' => TRUE,
                'data' => $riwayat
            ], REST_Controller::HTTP_OK);
        }
    }
    public function transSudah_get()
    {
        $id = $this->get('id_reseller');
        if ($id === null || $id === ''){
            $this->response([
                'status' => FALSE,
                'message' => 'Masukkan Email Anda'
            ], REST_Controller::HTTP_NOT_FOUND);
        }else{
            $riwayat = $this->a->getDataTranssudah($id);
            $this->response([
                'status' => TRUE,
                'data' => $riwayat
            ], REST_Controller::HTTP_OK);
        }
    }
    public function berat_get()
    {
        $id = $this->get('id_reseller');
        if ($id === null || $id === ''){
            $this->response([
                'status' => FALSE,
                'message' => 'Masukkan Email Anda'
            ], REST_Controller::HTTP_NOT_FOUND);
        }else{
            $riwayat = $this->a->getBerat($id);
            $this->response([
                'status' => TRUE,
                'data' => $riwayat
            ], REST_Controller::HTTP_OK);
        }
    }
    public function grand_get()
    {
        $id = $this->get('id_reseller');
        if ($id === null || $id === ''){
            $this->response([
                'status' => FALSE,
                'message' => 'Masukkan Email Anda'
            ], REST_Controller::HTTP_NOT_FOUND);
        }else{
            $riwayat = $this->a->getDataGrandTotal($id);
            $this->response([
                'status' => TRUE,
                'data' => $riwayat
            ], REST_Controller::HTTP_OK);
        }
    }

    public function index_post()
    {
        
        $id_reseller = $this->input->post('id_reseller');
        $kd_transaksi = $this->a->buat_kode();
        $grand= $this->a->getDataGrandTotal($id_reseller);
        $a=$grand['total'];

        $arr = [
            'kd_transaksi' => $kd_transaksi,
            'tgl_transaksi' => date('Y-m-d'),
            'grand_total' => $a,
            'id_reseller' => $id_reseller,
            'status_bayar' => "belum_bayar"
        ];

            $input = $this->a->insert('transaksi', $arr);
            $this->db->set('status', 'Pending');
            $this->db->set('kd_transaksi', $kd_transaksi);
            $this->db->where('id_reseller', $id_reseller);
            $this->db->where('status', 'Added to cart');
            $this->db->update('detail_transaksi');

            

            $response = [
                'status' => true,
                'pesan' => 'Data berhasil ditambahkan di Cart',
            ];
            $this->response($response, 200);
    }
    public function bayar_put()
    {
        if ($this->put('kd_transaksi'))
        {
            $kd = $this->put('kd_transaksi');

            $config = uniqid().'.jpeg';
            $path = '../uploads/reseller/bukti_bayar/'.$config;

            $transaksi = $this->a->getTrans($kd);
            $detTrans = $this->b->getDataDetTransPending($kd);

            
            if($transaksi && $detTrans) {
                if($this->put('bukti_bayar')) {
                    $bukti_bayar = $this->put('bukti_bayar');

                    $data = array(
                        'bukti_bayar' => $config,
                        'status_bayar' => "sudah_bayar"
                        
                    );
                    $data2 = array(
                            'status'=> 'Selesai'
                    );

                        if ($this->db->update('transaksi', $data, ['kd_transaksi' => $kd]) && 
                        $this->db->update('detail_transaksi', $data2, ['kd_transaksi' => $kd]) ) {
                            file_put_contents($path, base64_decode($bukti_bayar));
                            // jika berhasil
                            $this->set_response([
                                'status' => true,
                                'message' => 'Berhasil '
                            ], 200);
                        } else {
                            // jika gagal
                            $this->set_response([
                                'status' => false,
                                'message' => 'Gagal'
                            ], 401);
                        }

                    } else {
                        
                            // jika gagal
                            $this->set_response([
                                'status' => false,
                                'message' => 'Gagal Mengupdate Profil'
                            ], 401);
                        
                    }
                    
                } else {
                    // jika data pengguna tidak ada
                    $this->set_response([
                        'status' => false,
                        'message' => 'User could not be found'
                    ], 404);
                }

        } else {
            // jika tidak ada parameter id
            $this->set_response([
                'status' => false,
                'message' => 'User could not be found'
            ], 404);
        }
    }

}