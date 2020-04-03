<?php defined('BASEPATH') OR exit('No direct script access allowed');

class mmobil extends CI_Model
{
    private $_table = "mobil_sewa";

    public $id_mobil;
    public $merk_mobil;
    public $warna_mobil;

    public function rules()
    {
        return [
            ['field' => 'merk_mobil',
            'label' => 'merk_mobil',
            'rules' => 'required'],

            ['field' => 'warna_mobil',
            'label' => 'warna_mobil',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id_mobil" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id_mobil = uniqid();
        $this->merk_mobil = $post["merk_mobil"];
        $this->warna_mobil = $post["warna_mobil"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_mobil = $post["id_mobil"];
        $this->merk_mobil = $post["merk_mobil"];
        $this->warna_mobil = $post["warna_mobil"];
        return $this->db->update($this->_table, $this, array('id_mobil' => $post['id_mobil']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_mobil" => $id));
    }
}