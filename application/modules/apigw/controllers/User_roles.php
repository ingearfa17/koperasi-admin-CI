<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class User_roles extends REST_Controller{
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->helper('common');

    }

    function index_get($roles_id='') {
        if ($roles_id == '') {
            $roles = $this->db->get('sys_roles')->result();
        } else {
            $this->db->where('roles_id', $roles_id);
            $roles = $this->db->get('sys_roles')->result();
        }
        $this->response($roles, 200);
    }

    function index_post() {
        $dtarray = array(    
            'roles_name'=>$this->post('roles_name'),
            'roles_desc'=>$this->post('roles_desc'),
            'create_date'=>getSysDate(),
            'create_by' =>$this->post('create_by')
        );
        $insert = $this->db->insert('sys_roles', $dtarray);
        if ($insert) {
            $this->response($dtarray, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put($id) {
       $dtarray = array(    
            'roles_desc'=>$this->put('roles_desc'),
            'update_date'=>getSysDate(),
            'update_by' =>$this->put('update_by')
        );
        $this->db->where('roles_id', $id);
        $update = $this->db->update('sys_roles', $dtarray);
        if ($update) {
            $this->response($dtarray, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>