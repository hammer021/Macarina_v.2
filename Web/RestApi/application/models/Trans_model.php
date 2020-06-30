<?php 
 
class Trans_model extends CI_Model {
    protected $user_table = 'transaksi';

    public function getDataTrans($id = null)
    {
            return $this->db->get_where('transaksi' , ['id_reseller' => $id])->result_array();
    }

    public function insert($tabel, $arr)
    {
        return $this->db->insert($tabel, $arr);
    }
    
    public function getDataGrandTotal($id)
    {
        $this->db->select('SUM(detail_transaksi.subtotal) AS total');
        $this->db->from('detail_transaksi');
        $this->db->where('detail_transaksi.id_reseller',$id);
        $this->db->where('detail_transaksi.status','Added to cart');
        // $query = "SELECT SUM(detail_transaksi.subtotal) AS total FROM detail_transaksi 
        //  WHERE detail_transaksi.id_reseller = '$id' 
        //  AND detail_transaksi.status = 'Added to cart'";
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function buat_kode(){
        $this->db->select('RIGHT(transaksi.kd_transaksi,6) as kode',FALSE);
        $this->db->order_by('kd_transaksi', 'DESC');
        $this->db->limit(1);

        $query=$this->db->get('transaksi');

        if ($query->num_rows()<>0) {
            $data=$query->row();
            $kode=intval($data->kode)+1;
        }else{
            $kode=1;
        }
        $kode_max=str_pad($kode,6,"0",STR_PAD_LEFT);
        $kode_jadi="TR0000".$kode_max;
        return $kode_jadi;
    }

}