<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class History_model extends CI_Model{
	
	function __construct(){
	   // Call the Model constructor
	   parent::__construct();
	   $this->load->library('session');
       $this->load->database();
       $this->load->helper('common');
	}	

    
    function get_list_history($user_id){
        $this->db->select("K.nm_koperasi,  K.no_badan_hukum, L.`status`");
        $this->db->from('tbl_koperasi K');
        $this->db->join('tbl_perkembangan_lembaga L', 'ON K.id_koperasi = L.id_koperasi', 'inner');
        $this->db->where("L.create_by ='$user_id'");
        $query= $this->db->get();
        $data = $query->result_array();
        return $data;       
    }

   

}
?>