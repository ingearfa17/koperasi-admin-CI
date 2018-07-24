<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temuan_model extends CI_Model{
	
	function __construct(){
	   parent::__construct();
	   $this->load->library('session');
       $this->load->database();
       $this->load->helper('common');
	}	

    function insertdata_temuan($dt){
        $sql = $this->db->insert_string('tbl_temuan', $dt);
        if (!$this->db->simple_query($sql))
        {
                $error = $this->db->error(); 
                $msg_error =$error['message'];
                $arr_response = array(
                    'error'=> 'true',
                    'msg'=>$msg_error,
                    'data'=>array($dt)
                );
                return $arr_response ;
        }else{
                $id = $this->db->insert_id();
                $arr_response = array(
                    'error'=> 'false',
                    'msg'=>'Succes insert data temuan',
                    'id_temuan'=>$id,
                    'data'=>array($dt)
                );
             return $arr_response ;
        }
    }
    
    function get_list_approval_temuan(){
        $this->db->select('kd_koperasi, nm_koperasi, no_badan_hukum, tgl_badan_hukum, alamat, status_kantor, kegiatan_usaha, nm_pengelola, no_tlp, jml_anggota, sebaran_anggota, perizinan_dimiliki');
        $this->db->from('tbl_temuan');
        $this->db->where("status='1'");
        return ($query->num_rows() > 0)?$query->result_array():'Data not available';
    }

    function generate_id_temuan_koperasi(){
      $this->db->select('kd_koperasi');
      $this->db->from('tbl_temuan');
      $this->db->order_by('id_temuan DESC');
      $this->db->limit(1,0);
      $query=$this->db->get();
      $rows=$query->row();

      $id_temuan ='TMN-';
      $thn = date("Y")."-";
      $counter = 1 ;
     
      $new_kd =$id_temuan.$thn.str_pad($counter,6,'0',STR_PAD_LEFT);
      if($rows){
        $id_koperasi = $rows->kd_koperasi;
        $no_urut = get_right_string($id_koperasi,1);
        $int_no_urut = (int)$no_urut;
        $incre = $int_no_urut + 1;
        $new_kd =$id_temuan.$thn.str_pad($incre,6,'0',STR_PAD_LEFT);;
      }
      return $new_kd;
    }

    function get_legalitas_temuan_latest($id_temuan){
      $this->db->limit(3); 
      $arr_legal = array();
      $this->db->select('t.type_legalitas, l.no_legalitas, l.tgl_legalitas, l.id_temuan, l.id_koperasi');
      $this->db->from("tbl_legalitas_temuan l");
      $this->db->join("ref_type_legalitas t", "ON l.id_type_legalitas = t.id_type_legalitas","inner");
      $this->db->where("l.id_temuan = '$id_temuan'");
      $this->db->order_by('l.id_legalitas_temuan DESC');
      $query=$this->db->get();
      if($query->num_rows() > 0){
        $i=1;
        foreach ($query->result() as $row){
            $key = 'legal'.$i;
            $info_legal = $row->type_legalitas.' - '.$row->no_legalitas;  
            $arr_legal[$key] = $info_legal;
         $i++;   
        }
      }
      return $arr_legal;
    }

    function insertdata_legalitas_temuan ($dt){
        $sql = $this->db->insert_string('tbl_legalitas_temuan', $dt);
        if (!$this->db->simple_query($sql))
        {
                $error = $this->db->error(); 
                $msg_error =$error['message'];
                $arr_response = array(
                    'error'=> 'true',
                    'msg'=>$msg_error,
                    'data'=>array($dt)
                );
                return $arr_response ;
        }else{
                $id = $this->db->insert_id();
                $arr_response = array(
                    'error'=> 'false',
                    'msg'=>'Succes insert data legalitas temuan',
                    'id_legalitas_temuan'=>$id,
                    'data'=>array($dt)
                );
             return $arr_response ;
        }     
    }


}
?>