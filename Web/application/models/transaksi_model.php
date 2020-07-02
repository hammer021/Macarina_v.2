<?php defined('BASEPATH') OR exit('No direct script access allowed');

class transaksi_model extends CI_Model
{
    private $_table = "transaksi";

    public $kd_transaksi;
    public $tgl_transaksi;
    public $grand_total;
    public $id_reseller;
    public $bukti_bayar;
    public $status_bayar;
    public $kd_barang;
    public $qty_det;
    public $subtotal;
    public $status;
   
    
    public function getAllTrans()
    {
        $this->db->select('transaksi.*, reseller.nama_reseller');
        $this->db->from('transaksi');
        $this->db->join('reseller', 'transaksi.id_reseller = reseller.id_reseller');
        $this->db->order_by('transaksi.tgl_transaksi', 'desc');

        $income = $this->db->get()->result();
        return $income;
    }
    public function getDataTrans($id)
    {
        $this->db->select('transaksi.*, reseller.nama_reseller');
        $this->db->from('transaksi');
        $this->db->join('reseller', 'transaksi.id_reseller = reseller.id_reseller');
        $this->db->where('transaksi.kd_transaksi', $id);

        $income = $this->db->get()->row();
        return $income;
    }
    public function getDataDetail($id)
    {
        $this->db->select('detail_transaksi.*, reseller.nama_reseller, barang.nama_barang, barang.harga');
        $this->db->from('detail_transaksi');
        $this->db->join('reseller', 'detail_transaksi.id_reseller = reseller.id_reseller');
        $this->db->join('barang', 'detail_transaksi.kd_barang = barang.kd_barang');
        $this->db->where('detail_transaksi.status', 'Pending');
        $this->db->where('detail_transaksi.kd_transaksi', $id);

        $income = $this->db->get()->result();
        return $income;
    }

    
    public function delete($id)
    {
       
        return $this->db->delete($this->_table, array("kd_transaksi" => $id));
    }
    

}