<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class EditUser extends REST_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('Reseller_model' , 'reseller');
    }
    public function index_get()
    {
        $id = $this->get('id_reseller');
        
     
        $user = $this->reseller->index($id);
 
        if ($user) {
            $this->response([
                'status' => TRUE,
                'data' => $user
            ], REST_Controller::HTTP_OK);
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'User Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_put()
    {
        if ($this->put('id_reseller'))
        {
            $id = $this->put('id_reseller');

            $config = uniqid().'.jpeg';
            $path = '../uploads/reseller/scan_ktp/'.$config;

            $config2 = uniqid().'.jpeg';
            $path2 = '../uploads/reseller/pas_foto/'.$config2;

            $reseller = $this->db->get_where('reseller', ['id_reseller' => $id])->row_array();
            
            if($reseller) {
                if($this->put('scan_ktp') && $this->put('pas_foto')) {
                    $scan_ktp = $this->put('scan_ktp');
                    $pas_foto = $this->put('pas_foto');

                    $data = array(
                        'nama_reseller' => $this->put('nama_reseller'),
                        'alamat' => $this->put('alamat'),
                        'no_tlp' => $this->put('no_tlp'),
                        'scan_ktp' => $config,
                        'no_ktp' => $this->put('no_ktp'),
                        'email' => $this->put('email'),
                        'password' => md5($this->put('password')),
                        'pas_foto' => $config2
                    );

                        if ($this->db->update('reseller', $data, ['id_reseller' => $id])) {
                            file_put_contents($path, base64_decode($scan_ktp));
                            file_put_contents($path2, base64_decode($pas_foto));
                            // jika berhasil
                            $this->set_response([
                                'status' => true,
                                'message' => 'Berhasil Mengupdate Profil'
                            ], 200);
                        } else {
                            // jika gagal
                            $this->set_response([
                                'status' => false,
                                'message' => 'Gagal Mengupdate Profil'
                            ], 401);
                        }

                    } else {
                        $data = array(
                            'nama_reseller' => $this->put('nama_reseller'),
                            'alamat' => $this->put('alamat'),
                            'no_tlp' => $this->put('no_tlp'),
                            'scan_ktp' => $config,
                            'no_ktp' => $this->put('no_ktp'),
                            'email' => $this->put('email'),
                            'password' => md5($this->put('password'))               
                        );
                        
                        if ($this->db->update('reseller', $data, ['id_reseller' => $id])) {                        
                            // jika berhasil
                            $this->set_response([
                                'status' => true,
                                'message' => 'Berhasil Mengupdate Profil'
                            ], 200);
                        } else {
                            // jika gagal
                            $this->set_response([
                                'status' => false,
                                'message' => 'Gagal Mengupdate Profil'
                            ], 401);
                        }
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