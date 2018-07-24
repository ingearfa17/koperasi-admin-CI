<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Kelembagaan extends REST_Controller{
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->helper('common');
        $this->load->model('Kelembagaan_model');
    }

    function index_get($id_koperasi='') {
        if ($id_koperasi == '') {
            $kelembagaan = $this->db->get('tbl_kelembagaan')->result();
        } else {
            $this->db->where('tbl_kelembagaan', $id_koperasi);
            $kelembagaan = $this->db->get('tbl_kelembagaan')->result();
        }
        $this->response($kelembagaan, 200);
    }

    function list_approval_kelembagaan_post() {
        $id_koperasi = $this->post('id_koperasi');
        $data = $this->Kelembagaan_model->get_list_approval_kelembagaan($id_koperasi);
        $this->response($data, 200);
    }    

    function insert_kelembagaan_post(){
			$config['upload_path']          = './img/mobile_apps/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 1000;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;	

			$this->load->library('upload', $config);		
			if ( ! $this->upload->do_upload('pic')){
				$error = array('error' => $this->upload->display_errors());
				 $arr_response = array(
					'error'=>true,
					'msg'=>$error
				); 			
				$this->response($arr_response);				
			}else{
					$upload_data = $this->upload->data();
					$dtarray = array(       
					'id_koperasi'=>$this->post('id_koperasi'),
					'status_keaktifan'=>$this->post('status_keaktifan'),
					'rapat_anggota'=>$this->post('rapat_anggota'),
					'jml_anggota'=>$this->post('jml_anggota'),
					'photo'=>$upload_data['file_name'],
					'status'=>'1',
					'create_date'=>getsysdate(),
					'create_by'=>$this->post('user_id')
	         	); 
	         	$insert_dt = $this->Kelembagaan_model->insertdata_kelembagaan_step1($dtarray);
				$arr_response = array(
						'error'=>false,
						'msg'=>'Data inserted succesfully',
						'data_info'=>array($dtarray), 
						'file_info'=>$upload_data 
				);				
			}	
          
         $this->response($insert_dt, 200);
    }


    function process_data_post() {
        $id_kelembagaan = $this->put('id');
       $dtarray = array(    
            'status'=>$this->put('status'),
            'update_date'=>getSysDate(),
            'update_by' =>$this->put('user_id')
        );
        $this->db->where('id_kelembagaan', $id_kelembagaan);
        $update = $this->db->update('tbl_kelembagaan', $dtarray);
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
	
	public function aksi_upload_post(){
		$config['upload_path']          = './img/mobile_apps/';
		$config['allowed_types']        = 'gif|jpg|png';
		//$config['max_size']             = 100;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
 
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('pic')){
			 $error = array('error' => $this->upload->display_errors());
             $arr_response = array(
                'error'=>true,
                'msg'=>$error
            ); 			
			$this->response($arr_response);

		}else{
			//$data = array('upload_data' => $this->upload->data());
			$upload_data = $this->upload->data();
			print_r($data);
             $arr_response = array(
                'error'=>false,
                'msg'=>'File upload successfully',
				 'file_name'=>$upload_data['file_name'],
				'fileinfo'=>$upload_data
		
            ); 			
			$this->response($arr_response);
		}
	}
	
   
}
?>