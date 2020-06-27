<?php 
 
class Trans_model extends CI_Model {
    protected $akun_resellerTr = 'transaksi';


    public function getDataTrans($id = null)
    {
            return $this->db->get_where('transaksi' , ['id_reseller' => $id])->result_array();
    }

}