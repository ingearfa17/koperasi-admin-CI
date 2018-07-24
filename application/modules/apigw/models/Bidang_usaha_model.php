<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bidang_usaha_model extends CI_Model{
	
	function __construct(){
	   parent::__construct();
	   $this->load->library('session');
       $this->load->database();
       $this->load->helper('common');
	}	

    function insert_bidang_usaha($dt){
        $sql_hdr = $this->db->insert_string('tbl_usaha_keu', $dt);
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
                    'id_klembagaan'=>$id,
                    'data'=>array($dt)
                );
             return $arr_response ;
        }
    }

   public  function get_list_approval_bidang_usaha($id_koperasi){
        $this->db->select('BU.id_usaha_keu, BU.id_koperasi, K.nm_koperasi, K.no_badan_hukum, BU.`status`');
        $this->db->from('tbl_koperasi K');
        $this->db->join('tbl_usaha_keu BU', 'ON K.id_koperasi = BU.id_koperasi','inner');
        $this->db->where("BU.id_koperasi='$id_koperasi'");
        $this->db->where("status='1'");
        $query = $this->db->get();
        echo $this->db->last_query();
        $data = $query->result_array();
        return $data;
   }

}
?>