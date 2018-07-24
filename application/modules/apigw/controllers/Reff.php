<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Reff extends REST_Controller{
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->helper('common');

    }

    function jabatan_get() {
        $this->db->select('id_jabatan, nm_jabatan');
        $this->db->from('ref_jabatan');
        $query = $this->db->get();
        if($query){
            $jabatan = ($query->num_rows() > 0)?$query->result_array():FALSE;
               $arr_response = array(
                    'success'=> 1,
                    'name'=>$jabatan
                   );
               $this->response($arr_response, 200);
        }else{

            $arr_response = array(
                'success'=> 1,
                'msg'=>'Data does not exist'
               );
            $this->response($arr_response);
        }       
    }   

    function jenis_usaha_get() {
        $this->db->select('id_unit_usaha,   unit_usaha_koperasi ');
        $this->db->from('ref_unit_usaha');
        $query = $this->db->get();
        if($query){
            $jabatan = ($query->num_rows() > 0)?$query->result_array():FALSE;
               $arr_response = array(
                    'success'=> 1,
                    'name'=>$jabatan
                   );
               $this->response($arr_response, 200);
        }else{

            $arr_response = array(
                'success'=> 1,
                'msg'=>'Data does not exist'
               );
            $this->response($arr_response);
        }       
    } 
 
    function status_kantor_temuan_get() {
        $this->db->select('id_status,   status_koperasi ');
        $this->db->from('ref_status_kantor_temuan');
        $query = $this->db->get();
        if($query){
            $status_kantor = ($query->num_rows() > 0)?$query->result_array():FALSE;
               $arr_response = array(
                    'success'=> 1,
                    'name'=>$status_kantor
                   );
               $this->response($arr_response, 200);
        }else{

            $arr_response = array(
                'success'=> 1,
                'msg'=>'Data does not exist'
               );
            $this->response($arr_response);
        }       
    }


    function type_legalitas_get() {
        $this->db->select('id_type_legalitas,   type_legalitas ');
        $this->db->from('ref_type_legalitas');
        $query = $this->db->get();
        if($query){
            $type_legalitas = ($query->num_rows() > 0)?$query->result_array():FALSE;
               $arr_response = array(
                    'success'=> 1,
                    'name'=>$type_legalitas
                   );
               $this->response($arr_response, 200);
        }else{

            $arr_response = array(
                'success'=> 1,
                'msg'=>'Data does not exist'
               );
            $this->response($arr_response);
        }       
    } 

}
?>