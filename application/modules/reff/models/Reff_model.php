<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reff_model extends CI_Model{
	
	function __construct(){
	   parent::__construct();
       $this->load->database();
	}	

  function getRows($tblname, $params = array()){
         $arr_col = $this->db->list_fields($tblname); 
         $the_field = '';
         foreach($arr_col as $col){
            $the_field.=$col.",";
         }
         $field_to_select=substr($the_field, 0, -1);
         
         $this->db->select($field_to_select);
         $this->db->from($tblname);

        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $likeCriteria = "(".$arr_col[1]." LIKE '%".$params['search']['keywords']."%')";
            $this->db->where($likeCriteria);
        }

        //sort data by ascending or desceding order
        $this->db->order_by($arr_col[1]. ' ASC');

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get(); //echo $this->db->last_query();
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

     function insertdata($tblname, $dt_hdr){
        $sql_hdr = $this->db->insert_string($tblname, $dt_hdr);
        if (!$this->db->simple_query($sql_hdr))
        {
                $error = $this->db->error(); // Has keys 'code' and 'message'
                $msg_error =$error['message'];
                $this->db->trans_rollback();
                return $msg_error;
        }else{
           
            return "Data saved succesfully" ;
        }
    }

    function getdata_for_init($tblname, $id){
       $arr_col = $this->db->list_fields($tblname); 
       $the_field = '';
       foreach($arr_col as $col){
          $the_field.=$col.",";
       }
       $field_to_select=substr($the_field, 0, -1);

        $this->db->select($field_to_select);
        $this->db->from($tblname);
        $this->db->where($arr_col[0]."='$id'");
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->row():FALSE;
    } 

    function updatedata($tblname, $dt_hdr, $id){
        $arr_col = $this->db->list_fields($tblname); 
        $where = $arr_col[0]."= '$id'"; 
        $sql_hdr = $this->db->update_string($tblname, $dt_hdr, $where);
        if (!$this->db->simple_query($sql_hdr))
        {
                $error = $this->db->error(); // Has keys 'code' and 'message'
                $msg_error =$error['message'];
                $this->db->trans_rollback();
                return $msg_error;
        }else{
            return "Data updated succesfully";
        }
    }

    function deletedata($tblname, $key_field, $arr_id){
          foreach($arr_id as $id){    
              $this->db->where($key_field, $id);
              $this->db->delete($tblname);
          } 
          $msg='Records(s) deleted successfully';
          return $msg;
    }


    function getkelurahanbykec_id($kec_id){
        $data = array();
        $sql = "SELECT substr(kode,12,2) kode, nama FROM ref_kelurahan WHERE substr(kode, 1,5) = '32.76' and substr(kode_kecamatan,7,2) = '$kec_id'";
        $query = $this->db->query($sql);
        $dt_array = $query->result();

        foreach ($query->result() as $row) {
        $arr[] = array(
               'kd' => $row->kode,
               'nm' => $row->nama
                );
        }
        echo json_encode($arr);       
    }
}
?>