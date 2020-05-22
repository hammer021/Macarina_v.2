<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';

class Reseller extends REST_Controller {
    public function __construct() {
        parent::__construct();
        // Load Akun Model
        $this->load->model('Reseller_model', 'a');
    } 

    public function index_get()
    {
        $id = $this->get('id_reseller');
        if($id === null){
            $rsl = $this->a->getReseller();
        } else {
            $rsl = $this->a->getReseller($id);
        }

        if ($rsl){
            $this->response([
                'status' => true,
                'message' => $rsl
            ], REST_Controller::HTTP_OK);
        }
    }

    /**
    * Login Akun
    *------------------------------
    * @param: email
    * @param: password
    *------------------------------
    * @method : POST
    * @link : api/Reseller/login
    */
    public function index_post() {

        # Form Validation
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            // Form Validation
            $message = array(
                'status' => false,
                'error' => $this->form_validation->error_array(),
                'message' => validation_errors()
            );
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        } else {
            // Load Login Function
            $output = $this->a->akun_login($this->input->post('email'), $this->input->post('password'));
            if(!empty($output) AND $output != FALSE) {

                // Load Authorization Token Library
                $this->load->library('Authorization_Token');

                // Generate Token
                $token_data['id_reseller'] = $output->id_reseller;
                $token_data['nama_reseller'] = $output->nama_reseller;
                $token_data['alamat'] = $output->alamat;
                $token_data['no_tlp'] = $output->no_tlp;
                $token_data['scan_ktp'] = $output->scan_ktp;
                $token_data['no_ktp'] = $output->no_ktp;
                $token_data['email'] = $output->email;
                $token_data['password'] = $output->password;
                $token_data['pas_foto'] = $output->pas_foto;
                $token_data['status'] = $output->status;

                $akun_token = $this->authorization_token->generateToken($token_data);

                $return_data = [
                    'id_reseller' => $output->id_reseller,
                    'nama_reseller' => $output->nama_reseller,
                    'alamat' => $output->alamat,
                    'no_tlp' => $output->no_tlp,
                    'scan_ktp' => $output->scan_ktp,
                    'no_ktp' => $output->no_ktp,
                    'email' => $output->email,
                    'password' => $output->password,
                    'pas_foto' => $output->pas_foto,
                    'status' => $output->status,
                    'token' => $akun_token,
                    'pesan' => "Selamat Datang di Macarina",
                ];

                // Login Success
                $message = [
                    'status' => TRUE,
                    'data' => $return_data,
                    'message' => "Selamat Datang di Macarina"
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            } else {
                // LoginError
                $message = [
                    'status' => FALSE,
                    'message' => "Email atau Password Salah"
                ];
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
}