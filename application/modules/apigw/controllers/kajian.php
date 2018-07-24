<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Koperasi extends REST_Controller{
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->helper('common');

    }

    function index_get($id_kajian='') {
        if ($id_kajian == '') {
            $kajian = $this->db->get('tbl_kajian')->result();
        } else {
            $this->db->where('id_kajian', $id_kajian);
            $koperasi = $this->db->get('tbl_kajian')->result();
        }
        $this->response($kajian, 200);
    }
}
?>
