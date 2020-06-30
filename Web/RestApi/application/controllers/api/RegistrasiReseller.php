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
                'id_reseller' => $this->a->buat_kode(),
                'nama_reseller' => $nama_reseller,
                'email' => $email,
                'no_tlp' => $no_tlp,
                'password' => $password,
                'status' => 0,
            ];

            $tokennya = uniqid(true);
            $user_token = [
                'email' => $email,
                'token' => $tokennya
            ];

            $cek = $this->a->insert('reseller', $arr);
            $cek2 = $this->db->insert('user_token', $user_token);

            $this->_sendEmail($tokennya, $email, 'verify');

            $response = [
                'status' => true,
                'pesan' => 'Pendaftaran Akun Berhasil',
            ];
        }
        $this->response($response, 200);
    }

    private function _sendEmail($token, $email, $type)
    {
        $config = [
            'protocol'      => 'smtp',
            'smtp_host'     => 'smtp.gmail.com',
            'smtp_user'     => 'macarinashake@gmail.com',
            'smtp_pass'     => 'macarinaadmin',
            'smtp_port'     => 465,
            'mailtype'      => 'html',
            'charset'       => 'utf-8',
            'smtp_crypto'   => 'ssl',
            'crlf'          => "\r\n",
            'newline'       => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('macarinashake@gmail.com', 'MACARINA');
        $this->email->to($email);

        if ($type == 'verify') {
            $message = 'Klik link berikut untuk melakukan aktivasi akun anda <a href="' . base_url("RestApi/api/RegistrasiReseller/verify") . '?email=' . $email . '&token=' . $token . '">AKTIVASI AKUN</a>';

            $this->email->subject('Verifikasi Akun MACARINA');
            $this->email->message($message);
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify_get(){
        $email = $this->get('email');
        $token = $this->get('token');

        $reseller = $this->db->get_where('reseller', ['email' => $email])->row_array();
        if($reseller) {
            $tokennya = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if($tokennya) {
                $this->db->set('status', 1);
                $this->db->where('email', $email);
                $this->db->update('reseller');

                $this->db->delete('user_token', ['email' => $email]);

                $response = [
                    'status' => true,
                    'pesan' => 'Akun anda sudah di VERIFIKASI',
                ];
            } else {
                $response = [
                    'status' => false,
                    'pesan' => 'Token tidak valid',
                ];
            }
        } else {
            $response = [
                'status' => false,
                'pesan' => 'Email tidak valid',
            ];
        }
        $this->response($response, 200);
    }

}