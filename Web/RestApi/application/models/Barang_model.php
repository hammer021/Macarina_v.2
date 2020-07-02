<?php 
 
class Barang_model extends CI_Model {
    protected $akun_reseller = 'barang';
    public function index($id){
      
        return $this->db->get_where('barang' , ['id_barang' => $id])->result_array();
        
    }

}