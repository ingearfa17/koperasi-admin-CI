<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Koperasi extends REST_Controller{
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->helper('common');

    }

    function index_get($id_koperasi='') {
        if ($id_koperasi == '') {
            $koperasi = $this->db->get('tbl_koperasi')->result();
        } else {
            $this->db->where('id_koperasi', $id_koperasi);
            $koperasi = $this->db->get('tbl_koperasi')->result();
        }
        $this->response($koperasi, 200);
    }

    function getkoperasibyid_post() {
        $id_kecamatan = $this->post('id_kec');
        $id_kelurahan =$this->post('id_kel');
        $this->db->select('id_koperasi, nm_koperasi, alamat_kantor, no_badan_hukum, no_tlp1');
        $this->db->from('tbl_koperasi');
        if ($id_kecamatan != '') {
            $this->db->where('id_kecamatan', $id_kecamatan);
            $this->db->where('id_kelurahan', $id_kelurahan);
        }
        $query = $this->db->get();
       
        if($query->num_rows() > 0){
           $koperasi = $query->result_array();
		   $arr_response = array(
				'success'=> 1,
				'name'=>$koperasi
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

 function getdtlkoperasibyid_post() {
        $id_kecamatan = $this->post('id_kec');
        $id_kelurahan = $this->post('id_kel');
        $id_koperasi = $this->post('id_kop');
        $this->db->select('id_koperasi, alamat_kantor, no_badan_hukum, no_tlp1, no_tlp2, email, npwp, status_kantor');
        $this->db->from('tbl_koperasi');
        if ($id_kecamatan != '') {
            $this->db->where('id_kecamatan', $id_kecamatan);
            $this->db->where('id_kelurahan', $id_kelurahan);
            $this->db->where('id_koperasi', $id_koperasi);
        }
        $query = $this->db->get();
        if($query){
            $koperasi = ($query->num_rows() > 0)?$query->result_array():FALSE;
            $this->response($koperasi, 200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
    }

    
}
?>