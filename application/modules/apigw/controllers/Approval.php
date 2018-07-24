<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Approval extends REST_Controller{
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->helper('common');
        $this->load->model('Approval_model');
    }
   
    function list_approval_get() {
        $data = $this->Approval_model->get_list_approval();
        $arr_response = array(
                'success'=> 1,
                'name'=>$data
               );
        $this->response($arr_response, 200);
    }    
    
    function process_data_post() {
       $id_koperasi = $this->post('id_koperasi');
       $dtarray = array(    
            'status'=>$this->post('status'),
            'update_date'=>getSysDate(),
            'update_by' =>$this->post('user_id')
        );

        $response_info = $this->Approval_model->process_data_approval_kecamatan($dtarray,$id_koperasi);
        $this->response($response_info, 200);
    }

    function list_approval_pemkot_get() {
        $data = $this->Approval_model->get_list_approval_pemkot();
        $arr_response = array(
                'success'=> 1,
                'name'=>$data
               );
        $this->response($arr_response, 200);
    }    
    
    function process_data_pemkot_post() {
       $id_koperasi = $this->post('id_koperasi');
       $dtarray = array(    
            'status'=>$this->post('status'),
            'update_date'=>getSysDate(),
            'update_by' =>$this->post('user_id')
        );

        $response_info = $this->Approval_model->process_data_approval_pemkot($dtarray,$id_koperasi);
        $this->response($response_info, 200);
    }
   

   
}
?>