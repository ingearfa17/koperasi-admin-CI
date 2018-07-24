<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kajian_model extends CI_Model{

	function __construct(){
	   parent::__construct();
	   $this->load->library('session');
       $this->load->database();
       $this->load->helper('common');
	}

    function insertdata_kajian($dt){
        $sql_hdr = $this->db->insert_string('tbl_kajian', $dt);
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

       public  function get_list_kajian(){
        $this->db->select('id_kajian, nama_ustad, lokasi_kajian, waktu');
        $this->db->where("status='1'");
        $query = $this->db->get();

         return ($query->num_rows() > 0)?$query->result_array():'Data not available';

    }
}
?>
