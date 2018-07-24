<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model{
	
	function __construct(){
			  // Call the Model constructor
		parent::__construct();
	   $this->load->library('session');
       $this->load->database();
       $this->load->helper('common');
	}	

    function getRows($params = array()){
         $this->db->select('tbl_users.user_id, email, id_opd, user_name, pwd, full_name, mobile, tbl_roles.roles_id, roles_name');
         $this->db->from('tbl_users');
         $this->db->join('tbl_roles', 'tbl_users.roles_id = tbl_roles.roles_id', 'inner');

        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $likeCriteria = "(user_name  LIKE '%".$params['search']['keywords']."%')";
            $this->db->where($likeCriteria);
        }

        //sort data by ascending or desceding order
		 $this->db->order_by('user_name DESC');

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        //echo$this->db->last_query();
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

    function insertdata($dt_hdr, $dt_dtl){
        $this->db->trans_begin();
        $sql_hdr = $this->db->insert_string('tbl_users', $dt_hdr);
        if (!$this->db->simple_query($sql_hdr))
        {
                $error = $this->db->error(); // Has keys 'code' and 'message'
                $msg_error =$error['message'];
                $this->db->trans_rollback();
                return $msg_error;
        }else{
            foreach($dt_dtl as $dtl){
                $sql_dtl = $this->db->insert_string('tbl_useropd', $dtl);
                if (!$this->db->simple_query($sql_dtl)){
                    $error = $this->db->error(); // Has keys 'code' and 'message'
                    $msg_error =$error['message'];
                    $this->db->trans_rollback();
                    return $msg_error;                    
                }
            }
            $this->db->trans_commit();
            return "Data saved succesfully" ;
        }
    }

    function updatedata($dt_hdr, $id, $dt_dtl){
        $this->db->trans_begin();
        $where = "user_id = '$id'"; 
        $sql_hdr = $this->db->update_string('tbl_users', $dt_hdr, $where);
        if (!$this->db->simple_query($sql_hdr))
        {
                $error = $this->db->error(); // Has keys 'code' and 'message'
                $msg_error =$error['message'];
                $this->db->trans_rollback();
                return $msg_error;
        }else{
            $user_name = get_info_by_id_global_param('tbl_users', 'user_name', " WHERE user_id = '$id' ");
            $this->db->where('user_name', $user_name);
            $this->db->delete('tbl_useropd');
            foreach($dt_dtl as $dtl){
                $sql_dtl = $this->db->insert_string('tbl_useropd', $dtl);
                if (!$this->db->simple_query($sql_dtl)){
                    $error = $this->db->error(); // Has keys 'code' and 'message'
                    $msg_error =$error['message'];
                    $this->db->trans_rollback();
                    return $msg_error;                    
                }
            }
            $this->db->trans_commit();
            return "Data updated succesfully" ;
        }
    }

    function getdatauser_hdr($id){
        $this->db->select('user_id, email, user_name, pwd, full_name, roles_id, id_opd');
        $this->db->from('tbl_users');
        $this->db->where(" user_id='$id' ");
        $query = $this->db->get();
        $converter = new Encryption;
        foreach ($query->result() as $row) {
            $pwd = $converter->decode($row->pwd);   
            $arr[] = array(
                   'user_id' => $row->user_id,
                   'email' => $row->email,
                   'user_name' => $row->user_name,
                   'pwd' => $pwd,
                   'full_name' => $row->full_name,
                   'roles_id' => $row->roles_id
            );
        }
        return ($query->num_rows() > 0)?$arr[0]:FALSE;
    }

     function getdatauser_hdr_for_init($id){
        $this->db->select('user_id, email, user_name, pwd, full_name, roles_id, id_opd');
        $this->db->from('tbl_users');
        $this->db->where(" user_id='$id' ");
        $query = $this->db->get();
        return ($query->num_rows() > 0)?$query->row():FALSE;
    }   

     function getdataurusan_for_init($id){
        $this->db->select('kd_urusan');
        $arr_kd_urusan =array(); 
        $user_name = get_info_by_id_global_param('tbl_users', 'user_name', " WHERE user_id = '$id' ");
        $this->db->from('tbl_useropd');
        $this->db->where(" user_name='$user_name' ");
        $query = $this->db->get();
        foreach ($query->result() as $row){
            $arr_kd_urusan[]= $row->kd_urusan;
        }
        return $arr_kd_urusan;
    } 


    function get_sub_bagian_by_sub_bag($kd_bagian){
        $data = array();
        $sql = "SELECT kd_sub_bagian, nm_sub_bagian FROM ref_sub_bagian WHERE  kd_bagian = '$kd_bagian'";
        $query = $this->db->query($sql);
        $dt_array = $query->result();

        foreach ($query->result() as $row) {
        $arr[] = array(
               'kd_sub_bagian' => $row->kd_sub_bagian,
               'nm_sub_bagian' => $row->nm_sub_bagian
                );
        }
        echo json_encode($arr);       
    }

	function deletedata($arr_id){
        foreach($arr_id as $id){    
            $user_name = get_info_by_id_global_param('tbl_users', 'user_name', " WHERE user_id = '$id' ");
            $this->db->where('user_name', $user_name);
            $this->db->delete('tbl_useropd');

            $this->db->where('user_id', $id);
            $this->db->delete('tbl_users');
        } 
        $msg='Records(s) deleted successfully';
        return $msg;
	}
}
?>