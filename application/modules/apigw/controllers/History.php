<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class History extends REST_Controller{
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->helper('common');
        $this->load->model('History_model');
    }
   
    function list_history_post() {
        $user_id = $this->post('user_id');
        $data = $this->History_model->get_list_history($user_id);
        $arr_response = array(
                'success'=> 1,
                'name'=>$data
               );
        $this->response($arr_response, 200);
    }    
    
    
   

   
}
?>