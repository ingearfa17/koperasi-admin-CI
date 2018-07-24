<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Pengawas extends REST_Controller{
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->helper('common');
        $this->load->model('Pengawas_model');
    }

    function insert_pengawas_post(){
          $dtarray = array(       
            'id_koperasi'=>$this->post('id_koperasi'),
            'id_kelembagaan'=>$this->post('id_kelembagaan'),
            'nm_anggota'=>$this->post('nm_anggota'),
            'id_jabatan'=>$this->post('id_jabatan'),
            'no_tlp'=>$this->post('no_tlp'),
            'alamat'=>$this->post('alamat'),
            'jen_kel'=>$this->post('jen_kel'),
            'status'=>'1',
            'create_date'=>getsysdate(),
            'create_by'=>$this->post('user_id')
         ); 

         $insert_dt = $this->Pengawas_model->insertdata_pengawas($dtarray);
         $this->response($insert_dt, 200);
    }


    function list_approval_pengawas_get() {
        $data = $this->Pengawas_model->get_list_approval_pengawas();
        $this->response($data, 200);
    } 

    function process_data_post() {
        $id_pengurus = $this->put('id');
       $dtarray = array(    
            'status'=>$this->put('status'),
            'update_date'=>getSysDate(),
            'update_by' =>$this->put('user_id')
        );
        $this->db->where('id_pengurus', $id_pengurus);
        $update = $this->db->update('tbl_pengawas_lembaga', $dtarray);
        if ($update) {
            $arr_response = array(
                'error'=> 'false',
                'msg'=>'Succes update data',
                'data'=>array($dtarray)
            );
            $this->response($arr_response, 200);
        } else {
            $arr_response = array(
                'error'=> 'true',
                'msg'=>'Failed update data',
                'data'=>array($dtarray)
            );
            $this->response($arr_response, 502);
        }
    }
}
?>