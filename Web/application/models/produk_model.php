<?php defined('BASEPATH') OR exit('No direct script access allowed');

class produk_model extends CI_Model
{
    private $_table = "barang";

    public $kd_barang;
    public $nama_barang;
    public $harga;
    public $stok;
    public $gambar_brg;
    public $deskripsi;

    public function rules()
    {
        return [
            

            ['field' => 'nama_barang',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'harga',
            'label' => 'Harga',
            'rules' => 'numeric'],
            
            ['field' => 'stok',
            'label' => 'Stok',
            'rules' => 'numeric'],

            ['field' => 'gambar_brg',
            'label' => 'Gambar',
            'rules' => 'required'],
            
            ['field' => 'deskripsi',
            'label' => 'Deskripsi',
            'rules' => 'required']

        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["kd_barang" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->kd_barang = uniqid();
        $this->nama_barang = $post["nama_barang"];
        $this->harga = $post["harga"];
        $this->stok = $post["stok"];
        $this->gambar_brg = $post["gambar_brg"];
        $this->deskripsi = $post["deskripsi"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->kd_barang = $post["kd_barang"];
        $this->nama_barang = $post["nama_barang"];
        $this->harga = $post["harga"];
        $this->stok = $post["stok"];
        $this->gambar_brg = $post["gambar_brg"];
        $this->deskripsi = $post["deskripsi"];
        return $this->db->update($this->_table, $this, array('kd_barang' => $post['kd_barang']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("kd_barang" => $id));
    }
}