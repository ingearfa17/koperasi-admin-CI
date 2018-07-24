<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approval_model extends CI_Model{
	
	function __construct(){
	   // Call the Model constructor
	   parent::__construct();
	   $this->load->library('session');
       $this->load->database();
       $this->load->helper('common');
	}	

    
    function get_list_approval(){
        $this->db->select("kop.id_koperasi, kop.nm_koperasi, IF(lmb.status='1', 'Done', 'Not Done')  AS status_kelembagaan, IF(png.status='1', 'Done', 'Not Done')   AS status_pengawas, IF(keu.status='1', 'Done', 'Not Done') AS status_usaha, IF(kmb.status='1', 'Done', 'Not Done') as status_perkembangan");
        $this->db->from('tbl_koperasi kop');
        $this->db->join('tbl_kelembagaan lmb', 'ON kop.id_koperasi = lmb.id_koperasi', 'left');
        $this->db->join('tbl_pengawas_lembaga png', 'ON kop.id_koperasi = png.id_koperasi', 'left');
        $this->db->join('tbl_usaha_keu keu', 'ON kop.id_koperasi = keu.id_koperasi', 'left');
        $this->db->join('tbl_perkembangan_lembaga kmb', 'ON kop.id_koperasi = kmb.id_koperasi', 'left');
        $this->db->where("lmb.status ='1'");
        $this->db->where("png.status ='1'");
        $this->db->where("keu.status ='1'");
        $this->db->where("kmb.status ='1'");
        $this->db->where('lmb.id_kelembagaan is not NULL');
        $this->db->group_by('kop.nm_koperasi');
        $query= $this->db->get();
        $data = $query->result_array();
        return $data;       
    }

    public  function process_data_approval_kecamatan($dtarray, $id_koperasi){
        $this->db->where('id_koperasi', $id_koperasi);
        $update = $this->db->update('tbl_kelembagaan', $dtarray);
        $count_error = 0; 
        $msg_response = array();
        if ($update) {
            $arr_response = array(
                'error'=> 'false',
                'msg'=>'Succes update data kelembagaan',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        } else {
            $count_error = $count_error+1;
            $arr_response = array(
                'error'=> 'true',
                'msg'=>'Failed update data kelembagaan',
                'data'=>array($dtarray)

            );
            $msg_response[]= $arr_response;
        }

        $this->db->where('id_koperasi', $id_koperasi);
        $update = $this->db->update('tbl_pengawas_lembaga', $dtarray);
        if ($update) {
            $arr_response = array(
                'error'=> 'false',
                'msg'=>'Succes update data pengawas',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        } else {
            $count_error = $count_error+1;
            $arr_response = array(
                'error'=> 'true',
                'msg'=>'Failed update data pengawas',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        }

        $this->db->where('id_koperasi', $id_koperasi);
        $update = $this->db->update('tbl_pengurus_lembaga', $dtarray);

        if ($update) {
            $arr_response = array(
                'msg'=>'Succes update data pengurus',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        } else {
            $count_error = $count_error+1;
            $arr_response = array(
                'msg'=>'Failed update data pengurus',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        }

        $this->db->where('id_koperasi', $id_koperasi);
        $update = $this->db->update('tbl_usaha_keu', $dtarray);
        if ($update) {
            $arr_response = array(
                'msg'=>'Succes update data usaha keuangan',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        } else {
            $count_error = $count_error+1;
            $arr_response = array(
                'msg'=>'Failed update data usaha keuangan',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        }

        $this->db->where('id_koperasi', $id_koperasi);
        $update = $this->db->update('tbl_perkembangan_lembaga', $dtarray);
        if ($update) {
            $arr_response = array(
                'msg'=>'Succes update data perkembangan',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        } else {
            $count_error = $count_error+1;
            $arr_response = array(
                'msg'=>'Failed update data perkembangan',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        }

        if($count_error==0){
             $arr_response = array(
                'error'=>false,
                'msg'=>'Success process data',
                'data'=>array($dtarray)
            );           
        }

        return $arr_response;

    }

    function get_list_approval_pemkot(){
        $this->db->select("kop.id_koperasi, kop.nm_koperasi, IF(lmb.status='2', 'Done', 'Not Done')  AS status_kelembagaan, IF(png.status='2', 'Done', 'Not Done')   AS status_pengawas, IF(keu.status='2', 'Done', 'Not Done') AS status_usaha, IF(kmb.status='2', 'Done', 'Not Done') as status_perkembangan");
        $this->db->from('tbl_koperasi kop');
        $this->db->join('tbl_kelembagaan lmb', 'ON kop.id_koperasi = lmb.id_koperasi', 'left');
        $this->db->join('tbl_pengawas_lembaga png', 'ON kop.id_koperasi = png.id_koperasi', 'left');
        $this->db->join('tbl_usaha_keu keu', 'ON kop.id_koperasi = keu.id_koperasi', 'left');
        $this->db->join('tbl_perkembangan_lembaga kmb', 'ON kop.id_koperasi = kmb.id_koperasi', 'left');
        $this->db->where("lmb.status ='2'");
        $this->db->where('lmb.id_kelembagaan is not NULL');
        $this->db->group_by('kop.nm_koperasi');
        $query= $this->db->get();
        $data = $query->result_array();
        return $data;       
    }

public  function process_data_approval_pemkot($dtarray, $id_koperasi){
        $this->db->where('id_koperasi', $id_koperasi);
        $update = $this->db->update('tbl_kelembagaan', $dtarray);
        $count_error = 0; 
        $msg_response = array();
        if ($update) {
            $arr_response = array(
                'error'=> 'false',
                'msg'=>'Succes update data kelembagaan',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        } else {
            $count_error = $count_error+1;
            $arr_response = array(
                'error'=> 'true',
                'msg'=>'Failed update data kelembagaan',
                'data'=>array($dtarray)

            );
            $msg_response[]= $arr_response;
        }

        $this->db->where('id_koperasi', $id_koperasi);
        $update = $this->db->update('tbl_pengawas_lembaga', $dtarray);
        if ($update) {
            $arr_response = array(
                'error'=> 'false',
                'msg'=>'Succes update data pengawas',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        } else {
            $count_error = $count_error+1;
            $arr_response = array(
                'error'=> 'true',
                'msg'=>'Failed update data pengawas',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        }

        $this->db->where('id_koperasi', $id_koperasi);
        $update = $this->db->update('tbl_pengurus_lembaga', $dtarray);

        if ($update) {
            $arr_response = array(
                'msg'=>'Succes update data pengurus',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        } else {
            $count_error = $count_error+1;
            $arr_response = array(
                'msg'=>'Failed update data pengurus',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        }

        $this->db->where('id_koperasi', $id_koperasi);
        $update = $this->db->update('tbl_usaha_keu', $dtarray);
        if ($update) {
            $arr_response = array(
                'msg'=>'Succes update data usaha keuangan',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        } else {
            $count_error = $count_error+1;
            $arr_response = array(
                'msg'=>'Failed update data usaha keuangan',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        }

        $this->db->where('id_koperasi', $id_koperasi);
        $update = $this->db->update('tbl_perkembangan_lembaga', $dtarray);
        if ($update) {
            $arr_response = array(
                'msg'=>'Succes update data perkembangan',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        } else {
            $count_error = $count_error+1;
            $arr_response = array(
                'msg'=>'Failed update data perkembangan',
                'data'=>array($dtarray)
            );
            $msg_response[]= $arr_response;
        }

        if($count_error==0){
             $arr_response = array(
                'error'=>false,
                'msg'=>'Success process data',
                'data'=>array($dtarray)
            );           
        }

        return $arr_response;

    }

}
?>