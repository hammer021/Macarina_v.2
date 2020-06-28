<?php defined('BASEPATH') OR exit('No direct script access allowed');

class produk_model extends CI_Model
{
    private $_table = "barang";

    public $kd_barang;
    public $nama_barang;
    public $harga;
    public $stok;
    public $gambar_brg="default.jpg";
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

                     
            ['field' => 'deskripsi',
            'label' => 'Deskripsi',
            'rules' => 'required']

        ];
    }
    public function buat_kode(){
        $this->db->select('RIGHT(barang.kd_barang,3) as kode',FALSE);
        $this->db->order_by('kd_barang', 'DESC');
        $this->db->limit(1);

        $query=$this->db->get('barang');

        if ($query->num_rows()<>0) {
            $data=$query->row();
            $kode=intval($data->kode)+1;
        }else{
            $kode=1;
        }
        $kode_max=str_pad($kode,3,"0",STR_PAD_LEFT);
        $kode_jadi="BR00".$kode_max;
        return $kode_jadi;
    }
    public function getAll()
    {
        $this->db->select('barang.*, kemasan.kemasan, varian.varian');
        $this->db->from('barang');
        $this->db->join('kemasan', 'barang.id_kemasan = kemasan.id_kemasan');
        $this->db->join('varian', 'barang.id_varian = varian.id_varian');
        $income = $this->db->get()->result();
        return $income;
      
    }
    public function getKemasan()
    {
        $this->db->select('kemasan.*');
        $this->db->from('kemasan');
        $income = $this->db->get()->result();
        return $income;
    }
    public function getVarian()
    {
        $this->db->select('varian.*');
        $this->db->from('varian');
        $income = $this->db->get()->result();
        return $income;
    }
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["kd_barang" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->kd_barang = $this->buat_kode();
        $this->nama_barang = $post["nama_barang"];
        $this->harga = $post["harga"];
        $this->stok = $post["stok"];
        $this->gambar_brg = $this->_uploadImage();
        $this->deskripsi = $post["deskripsi"];
        $this->id_kemasan = $post["kemasan"];
        $this->id_varian = $post["varian"];
        return $this->db->insert($this->_table, $this);
    }
    public function update()
    {
        $post = $this->input->post();
        $this->kd_barang = $post["kd_barang"];
        $this->nama_barang = $post["nama_barang"];
        $this->harga = $post["harga"];
        $this->stok = $post["stok"];
        
        if (!empty($_FILES["gambar"]["name"])) {
            $this->gambar_brg = $this->_uploadImage();
        } else {
            $this->gambar_brg = $post["old_image"];
        }
        
        $this->deskripsi = $post["deskripsi"];
        return $this->db->update($this->_table, $this, array('kd_barang' => $post['kd_barang']));
    }
    public function delete($id)
    {
        $this->_deleteImage($id);
        return $this->db->delete($this->_table, array("kd_barang" => $id));
    }
    private function _uploadImage()
    {
    $config['upload_path']          = './theme-assets/images/barang/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = $this->kd_barang;
    $config['overwrite']			= true;
    $config['max_size']             = 5120;

    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('gambar')) {
        return $this->upload->data("file_name");
    }
    
   return "default.jpg";
   //print_r($this->upload->display_errors());
}
private function _deleteImage($id)
{
    $product = $this->getById($id);
    if ($product->gambar_brg != "default.jpg") {
	    $filename = explode(".", $product->gambar_brg)[0];
		return array_map('unlink', glob(FCPATH."theme-assets/images/barang/$filename.*"));
    }
}
}