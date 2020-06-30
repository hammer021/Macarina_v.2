<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Det_model extends CI_Model
{
    protected $user_table = 'detail_transaksi';

    public function getDataDetTrans($id = null)
    {
            return $this->db->get_where('detail_transaksi' , ['id_reseller' => $id])->result_array();
    }
    
    public function insert($tabel, $arr)
    {
        $cek = $this->db->insert($tabel, $arr);
        return $cek;
    }
    public function buat_kode(){
        $this->db->select('RIGHT(detail_transaksi.id_detail,6) as kode',FALSE);
        $this->db->order_by('id_detail', 'DESC');
        $this->db->limit(1);

        $query=$this->db->get('detail_transaksi');

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
  
    function randomkode($maxlength) {
        $chary = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
                        "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
                        "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        $return_str = "";
        for ( $x=0; $x<$maxlength; $x++ ) {
            $return_str .= $chary[rand(0, count($chary)-1)];
        }
        return $return_str;
      }

}
