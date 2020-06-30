<?php 
 
class Reseller_model extends CI_Model {
    protected $akun_reseller = 'reseller';

    public function insert_akun(array $data) {
        $this->db->insert($this->akun_reseller, $data);
        return $this->db->insert_id();
    }

    public function insert($tabel, $arr)
    {
        $cek = $this->db->insert($tabel, $arr);
        return $cek;
        
    }

    public function akun_login($email, $password) 
    {
        $this->db->where('email', $email);
        $q = $this->db->get($this->akun_reseller);

        if($q->num_rows()) {
            $akun_pass = $q->row('password');
            if(md5($password) === $akun_pass) {
                return $q->row();
            }
            return FALSE;
        } else {
            return FALSE;
        }
    }
    public function getReseller()
    {
        {
            return $this->db->get('reseller', ['id_reseller' => $id])->result_array();
        }
        
    }

    public function updateReseller($data, $id)
        {
            $this->db->update('reseller', $data, ['id_reseller' => $id]);
            return $this->db->affected_rows();
        }

        public function index($id){
      
            return $this->db->get_where('reseller' , ['id_reseller' => $id])->result_array();
        
    }

    public function buat_kode(){
        $this->db->select('RIGHT(reseller.id_reseller,6) as kode',FALSE);
        $this->db->order_by('id_reseller', 'DESC');
        $this->db->limit(1);

        $query=$this->db->get('reseller');

        if ($query->num_rows()<>0) {
            $data=$query->row();
            $kode=intval($data->kode)+1;
        }else{
            $kode=1;
        }
        $kode_max=str_pad($kode,6,"0",STR_PAD_LEFT);
        $kode_jadi="RSL000".$kode_max;
        return $kode_jadi;
    }

}