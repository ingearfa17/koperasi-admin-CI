<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Koperasi_model extends CI_Model{
	
	function __construct(){
	 // Call the Model constructor
		parent::__construct();
        $this->load->helper('common');
	}	

    function getRows($params = array()){
	   $this->db->select('id_koperasi, kd_koperasi, nm_koperasi, no_badan_hukum, tgl_badan_hukum, alamat_kantor');
	   $this->db->from('tbl_koperasi');
        //filter data by searched keywords

        if(!empty($params['search']['keywords'])){
            $likeCriteria = "(nm_koperasi  LIKE '%".$params['search']['keywords']."%')";
            $this->db->where($likeCriteria);
        }

        //sort data by ascending or desceding order
		 $this->db->order_by('nm_koperasi ASC');

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
         $query = $this->db->get();
         return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

    function savedata($dt_array){
        $sql = $this->db->insert_string('tbl_koperasi', $dt_array);
        $insert_id = '';
        if (!$this->db->simple_query($sql))
        {
                $error = $this->db->error(); // Has keys 'code' and 'message'
                $msg_error =$error['message'];
                return $msg_error;
        }else{
          return "Data saved succesfully" ;
        }
    }

    function updatedata($dt_array, $id){
        $where = "id_koperasi = '$id'"; 
        $sql_hdr = $this->db->update_string('tbl_koperasi', $dt_array, $where);
        if (!$this->db->simple_query($sql_hdr)){
                $error = $this->db->error(); // Has keys 'code' and 'message'
                $msg_error =$error['message'];
                return $msg_error;
        }else{
            return "Data updated succesfully" ;
        }
    }

    function row_delete($arr_id){//prepare for image del
        $msg ='';
        foreach($arr_id as $id){    
                $this->db->where('id_koperasi', $id);
                $this->db->delete('tbl_koperasi');
        } 
        $msg='Records(s) deleted succesfully';
        return $msg;
    }

    function get_dataforinit($id){
        $this->db->select('id_koperasi, nm_koperasi, no_badan_hukum, tgl_badan_hukum,    alamat_kantor,  kode_pos,   no_tlp1,    no_tlp2,    no_fax, email,  website,    status_kantor,  ketua,  no_tlp_ketua,   sekretaris, no_tlp_sekretaris,  bendahara,  no_tlp_bendahara,   bentuk_koperasi,    jenis_koperasi, klp_koperasi,   sektor_usaha,   unit_usaha, klasifikasi,    kesehatan,  anggota_pria,   anggota_wanita, manajer_pria,   manajer_wanita, karyawan_pria,  karyawan_wanita,    rat,    thn_ind_usaha,  modal_sendiri,  modal_luar, asset,  volume_usaha,   shu,    id_kecamatan,   id_kelurahan');
        $this->db->from('tbl_koperasi');
        $this->db->where("id_koperasi='$id'");
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->row():FALSE;
    } 


    function get_data_by_id($id){
        $this->db->select('roles_id, roles_name, roles_desc');
        $this->db->from('sys_roles');
        $this->db->where(" roles_id = '$id' ");
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->row():FALSE;
    } 

    function is_role_used_by_user($arr_id){
        $msg = ''; $sql ='';
        foreach($arr_id as $id){    
            $sql = "SELECT u.roles_id, u.user_name, r.roles_name FROM sys_users u INNER JOIN sys_roles r ON u.roles_id = r.roles_id WHERE u.roles_id = '$id'";
            $query = $this->db->query($sql);
            foreach ($query->result() as $row){
                    $msg.="<i class='fa fa-trash'></i> <strong>[".$row->roles_name."]</strong> used by User: <strong>". $row->user_name ."</strong><br>";
            }
        }  
        return "This Role cannot deleted. Role : <br>". $msg;    
    }

}
?>