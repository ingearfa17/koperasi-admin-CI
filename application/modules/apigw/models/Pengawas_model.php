<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengawas_model extends CI_Model{
	
	function __construct(){
	   parent::__construct();
	   $this->load->library('session');
       $this->load->database();
       $this->load->helper('common');
	}	

    

    function insertdata_pengawas($dt){
        $sql_hdr = $this->db->insert_string('tbl_pengawas_lembaga', $dt);
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
                    'id_pengawas'=>$id,
                    'data'=>array($dt)
                );
             return $arr_response ;
        }
    }

       public  function get_list_approval_pengawas(){
        $this->db->select('P.id_pengurus, P.id_koperasi, K.nm_koperasi, K.no_badan_hukum, P.`status`');
        $this->db->from('tbl_koperasi K');
        $this->db->join('tbl_pengawas_lembaga P', 'ON K.id_koperasi = P.id_koperasi','inner');
        $this->db->where("status='1'");
        $query = $this->db->get();

         return ($query->num_rows() > 0)?$query->result_array():'Data not available';
        
    }
}
?>