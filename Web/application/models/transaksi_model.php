<?php defined('BASEPATH') OR exit('No direct script access allowed');

class transaksi_model extends CI_Model
{
    private $_table = "transaksi";

    public $id_reseller;
    public $nama_reseller;
    public $alamat;
    public $no_tlp;
    public $scan_ktp="default.jpg";
    public $no_ktp;
    public $email;
    public $password;
    public $status="0";
    public $pas_foto="default.jpg";
   

    public function getAllTrans()
    {
        $this->db->select('transaksi.*, reseller.nama_reseller');
        $this->db->from('transaksi');
        $this->db->join('reseller', 'transaksi.id_reseller = reseller.id_reseller');
        $this->db->order_by('transaksi.tgl_transaksi', 'desc');

        $income = $this->db->get()->result();
        return $income;
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["kd_transaksi" => $id])->row();
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_reseller = $post["id_reseller"];
        $this->nama_reseller = $post["nama_reseller"];
        $this->alamat = $post["alamat"];
        $this->no_tlp = $post["no_tlp"];
        
        
        $this->no_ktp = $post["no_ktp"];
        $this->email = $post["email"];
        $this->password = $post["password"];
        $this->status = $post["status"];
        
        return $this->db->update($this->_table, $this, array('kd_transaksi' => $post['kd_transaksi']));
    }
    public function delete($id)
    {
       
        return $this->db->delete($this->_table, array("kd_transaksi" => $id));
    }
    

}