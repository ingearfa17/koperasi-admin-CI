<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Temuan extends REST_Controller{
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->helper('common');
        $this->load->model('Temuan_model');
    }

    function insert_temuan_post(){
          $dtarray = array( 
                'kd_koperasi'=>$this->Temuan_model->generate_id_temuan_koperasi(),      
                'nm_koperasi'=>$this->post('nm_koperasi'),
                'no_badan_hukum'=>$this->post('no_badan_hukum'),
                'tgl_badan_hukum'=>$this->post('tgl_badan_hukum'),
                'alamat'=>$this->post('alamat'),
                'status_kantor'=>$this->post('status_kantor'),
                'kegiatan_usaha'=>$this->post('kegiatan_usaha'),
                'nm_pengelola'=>$this->post('nm_pengelola'),
                'no_tlp'=>$this->post('no_tlp'),
                'jml_anggota'=>$this->post('jml_anggota'),
                'sebaran_anggota'=>$this->post('sebaran_anggota'),
                'perizinan_dimiliki'=>$this->post('perizinan_dimiliki'),
                'status'=>'1',
                'create_date'=>getSysDate(),
                'create_by'=>$this->post('user_id'),
         ); 

         $insert_dt = $this->Temuan_model->insertdata_temuan($dtarray);
         $this->response($insert_dt, 200);
    }



    function insert_legalitas_temuan_post(){
        $dtarray = array(
                    'id_temuan' => $this->post('id_temuan'),
                    'id_koperasi' => $this->post('id_koperasi'),
                    'id_type_legalitas' => $this->post('id_type_legalitas'),
                    'no_legalitas' => $this->post('no_legalitas'),
                    'tgl_legalitas' => format_date_as_db_format($this->post('tgl_legalitas')),
        );
         $insert_dt = $this->Temuan_model->insertdata_legalitas_temuan($dtarray);
         $this->response($insert_dt, 200);  
    }

    function legalitas_temuan_post(){
        $id_temuan = $this->post('id_temuan');
        $data=$this->Temuan_model->get_legalitas_temuan_latest($id_temuan);
        $arr_response = array(
            'error'=> 'false',
            'msg'=>'Succes inquiry data',
            'data'=>array($data)
        );
        $this->response($arr_response, 200);       
    }
    
    function list_approval_temuan_get() {
        $data = $this->Temuan_model->get_list_approval_temuan();
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
        $update = $this->db->update('tbl_temuan', $dtarray);
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