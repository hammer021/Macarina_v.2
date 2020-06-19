<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';

class Trans extends REST_Controller {
    public function __construct() {
        parent::__construct();
        // Load Akun Model
        $this->load->model('Trans_model', 'a');
    } 

    public function index_get()
    {
        $id = $this->get('id_reseller');
        if($id === null){
            $rsl = $this->a->getDataTrans();
        } else {
            $rsl = $this->a->getDataTrans($id);
        }

        if ($rsl){
            $this->response([
                'status' => true,
                'message' => $rsl
            ], REST_Controller::HTTP_OK);
        }
    }

}