<?php 
 
class Reseller_model extends CI_Model {
    protected $akun_reseller = 'reseller';

    public function insert_akun(array $data) {
        $this->db->insert($this->akun_reseller, $data);
        return $this->db->insert_id();
    }

    public function akun_login($email, $password) 
    {
        $this->db->where('email', $email);
        $q = $this->db->get($this->akun_reseller);

        if($q->num_rows()) {
            $akun_pass = $q->row('password');
            if($password === $akun_pass) {
                return $q->row();
            }
            return FALSE;
        } else {
            return FALSE;
        }
    }

    public function getReseller($id = null)
    {
        if($id === null){
            return $this->db->get('reseller')->result_array();
        } else {
            return $this->db->get_where('reseller', ['id_reseller' => $id])->result_array();
        }
        
    }

}