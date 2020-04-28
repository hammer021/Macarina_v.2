<?php defined('BASEPATH') OR exit('No direct script access allowed');

class reseller_model extends CI_Model
{
    private $_table = "reseller";

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
    public function rules()
    {
        return [

            ['field' => 'nama_reseller',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'alamat',
            'label' => 'Alamat',
            'rules' => 'required'],
            
            ['field' => 'no_tlp',
            'label' => 'No_tlp',
            'rules' => 'numeric'],

            ['field' => 'no_ktp',
            'label' => 'No_ktp',
            'rules' => 'numeric'],

            ['field' => 'email',
            'label' => 'Email',
            'rules' => 'required'],

            ['field' => 'password',
            'label' => 'Password',
            'rules' => 'required']

        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id_reseller" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id_reseller = uniqid();
        $this->nama_reseller = $post["nama_reseller"];
        $this->alamat = $post["alamat"];
        $this->no_tlp = $post["no_tlp"];
        $this->scan_ktp = $this->_uploadScan();
        $this->no_ktp = $post["no_ktp"];
        $this->email = $post["email"];
        $this->password = $post["password"];
        //$this->status = $post["status"];
        $this->pas_foto = $this->_uploadPas();
        return $this->db->insert($this->_table, $this);
    }
    public function update()
    {
        $post = $this->input->post();
        $this->id_reseller = $post["id_reseller"];
        $this->nama_reseller = $post["nama_reseller"];
        $this->alamat = $post["alamat"];
        $this->no_tlp = $post["no_tlp"];
        if (!empty($_FILES["scan_ktp"]["name"])) {
            $this->scan_ktp = $this->_uploadScan();
        } else {
            $this->scan_ktp = $post["old_scan_ktp"];
        }
        
        $this->no_ktp = $post["no_ktp"];
        $this->email = $post["email"];
        $this->password = $post["password"];
        $this->status = $post["status"];
        if (!empty($_FILES["pas_foto"]["name"])) {
            $this->pas_foto = $this->_uploadPas();
        } else {
            $this->pas_foto = $post["old_pas_foto"];
        }
        return $this->db->update($this->_table, $this, array('id_reseller' => $post['id_reseller']));
    }
    public function delete($id)
    {
        $this->_deleteScan($id);
        $this->_deletePas($id);
        return $this->db->delete($this->_table, array("id_reseller" => $id));
    }
    private function _uploadScan()
    {
    $config['upload_path']          = './theme-assets/images/reseller/scan/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = $this->id_reseller;
    $config['overwrite']			= true;
    $config['max_size']             = 5120;
    $this->load->library('upload', $config);

    if ($this->upload->do_upload('scan_ktp')) {
        return $this->upload->data("file_name");
    }
    
   return "default.jpg";
   //print_r($this->upload->display_errors());
}

private function _uploadPas()
{
$config['upload_path']          = './theme-assets/images/reseller/pas/';
$config['allowed_types']        = 'gif|jpg|png';
$config['file_name']            = $this->id_reseller;
$config['overwrite']			= true;
$config['max_size']             = 5120;
$this->load->library('upload', $config);

if ($this->upload->do_upload('pas_foto')) {
    return $this->upload->data("file_name");
}

return "default.jpg";
//print_r($this->upload->display_errors());
}

private function _deleteScan($id)
{
    $product = $this->getById($id);
    if ($product->scan_ktp != "default.jpg") {
	    $filename = explode(".", $product->scan_ktp)[0];
		return array_map('unlink', glob(FCPATH."theme-assets/images/reseller/scan/$filename.*"));
    }
}

private function _deletePas($id)
{
    $product = $this->getById($id);
    if ($product->pas_foto != "default.jpg") {
	    $filename = explode(".", $product->pas_foto)[0];
		return array_map('unlink', glob(FCPATH."theme-assets/images/reseller/pas/$filename.*"));
    }
}
}