<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Bidang_usaha extends REST_Controller{
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->helper('common');
        $this->load->model('Bidang_usaha_model');
    }


    function insert_bidang_usaha_post(){
        $config['upload_path']          = './img/mobile_apps/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;  
        $config['overwrite']            = true; 

        $this->load->library('upload', $config);        
        if ( ! $this->upload->do_upload('pic')){
            $error = $this->upload->display_errors();
             $arr_response = array(
                'error'=>true,
                'msg'=>$error
            );          
            $this->response($arr_response);             
        }else{
            $upload_data = $this->upload->data();        
            $dtarray = array(       
                'id_koperasi'=>$this->post('id_koperasi'),
                'bidang_usaha'=>$this->post('bidang_usaha'),
                'alamat_usaha'=>$this->post('alamat_usaha'),
                'status_usaha'=>$this->post('status_usaha'),
                'omzet'=>$this->post('omzet'),
                'foto_tempat'=>$upload_data['file_name'],
                'simp_pokok'=>$this->post('simp_pokok'),
                'jml_simp_pokok'=>$this->post('jml_simp_pokok'),
                'simp_wajib'=>$this->post('simp_wajib'),
                'jml_simp_wajib'=>$this->post('jml_simp_wajib'),
                'shu_tahunan'=>$this->post('shu_tahunan'),            
                'status'=>'1',
                'create_date'=>getsysdate(),
                'create_by'=>$this->post('user_id')
             ); 
             $insert_dt = $this->Bidang_usaha_model->insert_bidang_usaha($dtarray);
             /*$arr_response = array(
                    'msg'=>$insert_dt,
                    'data_info'=>array($dtarray), 
                    'file_info'=>$upload_data 
            ); */             
            $this->response($insert_dt, 200);
        }

    }


    function list_approval_bidang_usaha_post() {
        $id_koperasi = $this->post('id_koperasi');
        $data = $this->Bidang_usaha_model->get_list_approval_bidang_usaha($id_koperasi);
        $this->response($data, 200);
    }   


    function process_data_post() {
       $id_usaha_keu = $this->put('id');
       $dtarray = array(    
            'status'=>$this->put('status'),
            'update_date'=>getSysDate(),
            'update_by' =>$this->put('user_id')
        );
        $this->db->where('id_usaha_keu', $id_usaha_keu);
        $update = $this->db->update('tbl_usaha_keu', $dtarray);
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