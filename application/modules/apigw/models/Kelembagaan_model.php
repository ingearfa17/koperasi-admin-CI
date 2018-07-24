<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelembagaan_model extends CI_Model{
	
	function __construct(){
			  // Call the Model constructor
		parent::__construct();
	   $this->load->library('session');
       $this->load->database();
       $this->load->helper('common');
	}	

    
    function insertdata_kelembagaan_step1($dt){
        $sql_hdr = $this->db->insert_string('tbl_kelembagaan', $dt);
        if (!$this->db->simple_query($sql_hdr))
        {
                $error = $this->db->error(); // Has keys 'code' and 'message'
                $msg_error =$error['message'];
                $arr_response = array(
                    'error'=> 'true',
                    'msg'=>$msg_error,
                    'data'=>array($dt)
                );
                return $arr_response ;
        }else{
                $id = $this->db->insert_id();
                $arr_response = array(
                    'error'=> 'false',
                    'msg'=>'Succes insert data',
                    'id_kelembagaan'=>$id,
                    'data'=>array($dt)
                );
             return $arr_response ;
        }
    }

    public  function get_list_approval_kelembagaan($id_koperasi){
        $this->db->select('L.id_kelembagaan, L.id_koperasi, K.nm_koperasi, K.no_badan_hukum, L.`status`');
        $this->db->from('tbl_koperasi K');
        $this->db->join('tbl_kelembagaan L', 'ON K.id_koperasi = L.id_koperasi','inner');
        $this->db->where("L.id_koperasi='$id_koperasi'");
        $this->db->where("status='1'");
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
}
?>