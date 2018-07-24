<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perkembangan_model extends CI_Model{
	
	function __construct(){
	   parent::__construct();
	   $this->load->library('session');
       $this->load->database();
       $this->load->helper('common');
	}	

    function insertdata_perkembangan($dt){
        $sql = $this->db->insert_string('tbl_perkembangan_lembaga', $dt);
        if (!$this->db->simple_query($sql))
        {
                $error = $this->db->error(); 
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
                    'msg'=>'Succes insert data kelembagaan',
                    'id_perkembangan'=>$id,
                    'data'=>array($dt)
                );
             return $arr_response ;
        }
    }


    function updatedata_perkembangan_usaha($dt, $id){
        $where = "id_perkembangan = '$id'"; 
        $sql = $this->db->update_string('tbl_perkembangan_lembaga', $dt, $where);
        if (!$this->db->simple_query($sql))
        {
                $error = $this->db->error(); 
                $msg_error =$error['message'];
                $arr_response = array(
                    'error'=> 'true',
                    'msg'=>$msg_error,
                    'data'=>array($dt)
                );
                return $arr_response ;
        }else{
                $arr_response = array(
                    'error'=> 'false',
                    'msg'=>'Succes insert data perkembangan usaha',
                    'id_perkembangan'=>$id,
                    'data'=>array($dt)
                );
             return $arr_response ;
        }
    }


    function updatedata_perkembangan_keuangan($dt, $id){
        $where = "id_perkembangan = '$id'"; 
        $sql = $this->db->update_string('tbl_perkembangan_lembaga', $dt, $where);
        if (!$this->db->simple_query($sql))
        {
                $error = $this->db->error(); 
                $msg_error =$error['message'];
                $arr_response = array(
                    'error'=> 'true',
                    'msg'=>$msg_error,
                    'data'=>array($dt)
                );
                return $arr_response ;
        }else{
                $arr_response = array(
                    'error'=> 'false',
                    'msg'=>'Succes insert data perkembangan keuangan',
                    'id_perkembangan'=>$id,
                    'data'=>array($dt)
                );
             return $arr_response ;
        }
    }

    function get_list_approval_perkembangan($id_koperasi){
        $this->db->select('*');
        $this->db->from('tbl_koperasi K');
        $this->db->join('tbl_perkembangan_lembaga P', 'ON K.id_koperasi = P.id_koperasi','inner');
        $this->db->where("P.id_koperasi='$id_koperasi'");
        $this->db->where("status='1'");
        $query = $this->db->get();

        return ($query->num_rows() > 0)?$query->result_array():'Data not available';
    }

function get_legalitas_perkembangan_latest($id_perkembangan){
      $this->db->limit(3); 
      $arr_legal = array();
      $this->db->select('t.type_legalitas, l.no_legalitas, l.tgl_legalitas, l.id_perkembangan, l.id_koperasi');
      $this->db->from("tbl_legalitas_lembaga l");
      $this->db->join("ref_type_legalitas t", "ON l.id_type_legalitas = t.id_type_legalitas","inner");
      $this->db->where("l.id_perkembangan = '$id_perkembangan'");
      $this->db->order_by('l.id_legalitas_lembaga DESC');
      $query=$this->db->get();
      if($query->num_rows() > 0){
        $i=1;
        foreach ($query->result() as $row){
            $key = 'legal'.$i;
            $info_legal = $row->type_legalitas.' - '.$row->no_legalitas;  
            $arr_legal[$key] = $info_legal;
         $i++;   
        }
      }
      return $arr_legal;
    }


    function insertdata_legalitas_lembaga ($dt){
        $sql = $this->db->insert_string('tbl_legalitas_lembaga', $dt);
        if (!$this->db->simple_query($sql))
        {
                $error = $this->db->error(); 
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
                    'msg'=>'Succes insert data legalitas kelembagaan',
                    'id_legalitas_lembaga'=>$id,
                    'data'=>array($dt)
                );
             return $arr_response ;
        }    	
    }

}
?>