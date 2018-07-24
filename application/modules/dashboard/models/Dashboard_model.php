<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model{
	
	function __construct(){
	 // Call the Model constructor
		parent::__construct();
        $this->load->helper('common');
	}	

    function get_statistic_status_koperasi(){
        $this->db->select('status_kantor, count(status_kantor) jml');
        $this->db->from('tbl_koperasi'); 
        $this->db->group_by('status_kantor');
        $query = $this->db->get();
        if(!$query){
            $error = $this->db->error(); 
            $msg_error =$error['message'];
            return $msg_error;
        }else{
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
    }   

    function get_statistic_jml_koperasi_by_kecamatan(){
        $this->db->select('count(id_koperasi) jmlkop, kecamatan');
        $this->db->from('tbl_koperasi');
        $this->db->where('kecamatan is not null');
        $this->db->group_by('kecamatan');
        $query=$this->db->get();
        if(!$query){
            $error = $this->db->error(); 
            $msg_error =$error['message'];
            return $msg_error;
        }else{
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }        
    }

    function get_statistic_jml_koperasi_by_kelurahan(){
        $this->db->select('count(id_koperasi) jmlkop, kelurahan');
        $this->db->from('tbl_koperasi');
        $this->db->group_by('kelurahan');
        $query=$this->db->get();
        if(!$query){
            $error = $this->db->error(); 
            $msg_error =$error['message'];
            return $msg_error;
        }else{
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }        
    }

    function get_anggota_by_gender(){
        $this->db->select('SUM(anggota_pria) jmlpria, sum(anggota_wanita) jmlwanita');
        $this->db->from('tbl_koperasi'); 
        $query = $this->db->get();
        if(!$query){
            $error = $this->db->error(); 
            $msg_error =$error['message'];
            return $msg_error;
        }else{
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
    }

    function get_manajer_by_gender(){
        $this->db->select('SUM(manajer_pria) jmlpria, sum(manajer_wanita) jmlwanita');
        $this->db->from('tbl_koperasi'); 
        $query = $this->db->get();
        if(!$query){
            $error = $this->db->error(); 
            $msg_error =$error['message'];
            return $msg_error;
        }else{
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
    }

    function get_karyawan_by_gender(){
        $this->db->select('SUM(karyawan_pria) jmlpria, sum(karyawan_wanita) jmlwanita');
        $this->db->from('tbl_koperasi'); 
        $query = $this->db->get();
        if(!$query){
            $error = $this->db->error(); 
            $msg_error =$error['message'];
            return $msg_error;
        }else{
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
    }

    function get_statistic_asset_koperasi(){
        $this->db->select('kecamatan, sum(asset) jml');
        $this->db->from('tbl_koperasi'); 
        $this->db->where('kecamatan IS NOT NULL');
        $this->db->where("kecamatan <> ''");
        $this->db->group_by('kecamatan');
        $query = $this->db->get();
        if(!$query){
            $error = $this->db->error(); 
            $msg_error =$error['message'];
            return $msg_error;
        }else{
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
    }

function get_statistic_omset_koperasi($id_kecamatan){
        $this->db->select('kecamatan, `kelurahan`, sum(IFNULL(volume_usaha,0)) jml');
        $this->db->from('tbl_koperasi'); 
        $this->db->where('kecamatan IS NOT NULL');
        $this->db->where("kecamatan <> ''");
        $this->db->where("id_kecamatan ='$id_kecamatan'");
        $this->db->group_by('kecamatan,kelurahan');
        $query = $this->db->get();
        if(!$query){
            $error = $this->db->error(); 
            $msg_error =$error['message'];
            return $msg_error;
        }else{
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
}


 function get_statistic_shu_koperasi($id_kecamatan){
        $this->db->select('kecamatan, `kelurahan`, sum(IFNULL(shu,0)) jml');
        $this->db->from('tbl_koperasi'); 
        $this->db->where('kecamatan IS NOT NULL');
        $this->db->where("kecamatan <> ''");
        $this->db->where("id_kecamatan ='$id_kecamatan'");
        $this->db->group_by('kecamatan,kelurahan');
        $query = $this->db->get();
        if(!$query){
            $error = $this->db->error(); 
            $msg_error =$error['message'];
            return $msg_error;
        }else{
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
    }

    function get_data_kelembagaan(){
        $this->db->distinct();
        $this->db->select("K.nm_koperasi, K.no_badan_hukum, L.status_keaktifan, L.rapat_anggota, L.jml_anggota, DATE_FORMAT(L.create_date, '%d/%m/%Y') tglkunjungan");
        $this->db->from('tbl_koperasi AS K'); 
        $this->db->join('tbl_kelembagaan AS L','ON L.id_koperasi = K.id_koperasi','inner');
        $query = $this->db->get();
        if(!$query){
            $error = $this->db->error(); 
            $msg_error =$error['message'];
            return $msg_error;
        }else{
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
    } 

    function get_data_pengurus(){
        $this->db->distinct();
        $this->db->select("K.nm_koperasi, K.no_badan_hukum, P.nm_pengurus, J.nm_jabatan, P.no_tlp, P.alamat, DATE_FORMAT(P.create_date, '%d/%m/%Y') tglkunjungan");
        $this->db->from('tbl_koperasi AS K'); 
        $this->db->join('tbl_pengurus_lembaga AS P','ON P.id_koperasi = K.id_koperasi','inner');
        $this->db->join('ref_jabatan AS J','ON P.id_jabatan = J.id_jabatan','inner');
        $query = $this->db->get();
        if(!$query){
            $error = $this->db->error(); 
            $msg_error =$error['message'];
            return $msg_error;
        }else{
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
    } 

    function get_data_pengawas(){
        $this->db->distinct();
        $this->db->select("K.nm_koperasi, K.no_badan_hukum, P.nm_anggota, J.nm_jabatan, P.no_tlp, P.alamat, DATE_FORMAT(P.create_date, '%d/%m/%Y')");
        $this->db->from('tbl_koperasi AS K'); 
        $this->db->join('tbl_pengawas_lembaga AS P','ON P.id_koperasi = K.id_koperasi','inner');
        $this->db->join('ref_jabatan AS J','ON P.id_jabatan = J.id_jabatan','inner');
        $query = $this->db->get();
        if(!$query){
            $error = $this->db->error(); 
            $msg_error =$error['message'];
            return $msg_error;
        }else{
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
    } 

    function get_data_perkembangan(){
        $this->db->distinct();
        $this->db->select("K.nm_koperasi, K.no_badan_hukum, P.jml_anggota_awal, P.jml_anggota_berjalan, P.shu_awal, 
            P.shu_berjalan, P.jml_simpok_awal, P.jml_simpok_berjalan, DATE_FORMAT(P.create_date, '%d/%m/%Y') createdate");
        $this->db->from('tbl_koperasi AS K'); 
        $this->db->join('tbl_perkembangan_lembaga AS P','ON P.id_koperasi = K.id_koperasi','inner');
        $query = $this->db->get();
        if(!$query){
            $error = $this->db->error(); 
            $msg_error =$error['message'];
            return $msg_error;
        }else{
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
    } 

    function get_data_temuan(){
        $this->db->distinct();
        $this->db->select("kd_koperasi, nm_koperasi, no_badan_hukum, alamat, status_kantor, kegiatan_usaha, nm_pengelola, no_tlp, jml_anggota, sebaran_anggota, DATE_FORMAT(create_date, '%d/%m/%Y') tglkunjungan");
        $this->db->from('tbl_temuan'); 
        $query = $this->db->get();
        if(!$query){
            $error = $this->db->error(); 
            $msg_error =$error['message'];
            return $msg_error;
        }else{
            return ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
    }   

function anggota_koperasi_by_kecamatan($id_kec){
    $this->db->select('kabupaten,  kecamatan,  kelurahan, sum(anggota_wanita) wanita, sum(anggota_pria) pria');
    $this->db->from('tbl_koperasi');
    $this->db->where("id_kecamatan = '$id_kec'");
    $this->db->where("kecamatan is not null");
    $this->db->group_by('kelurahan');
    $query= $this->db->get();
    return ($query->num_rows() > 0)?$query->result_array():FALSE;
}

function status_kantor($id_kec){
    $this->db->select("kabupaten,  kecamatan,  kelurahan, SUM(case when status_kantor='AKTIF' then 1 else 0 end) as aktif, SUM(case when status_kantor='TIDAK AKTIF' then 1 else 0 end) as inaktif");
    $this->db->from('tbl_koperasi');
    $this->db->where("id_kecamatan = '$id_kec'");
    $this->db->where("kecamatan is not null");
    $this->db->group_by('kelurahan');
    $query= $this->db->get();
    return ($query->num_rows() > 0)?$query->result_array():FALSE;
}

function jenis_kantor($id_kec){
    $data_arr=array();
    $sql = " SELECT 
    K.kecamatan, K.kelurahan ,
        SUM(CASE WHEN  K.jenis_koperasi = 'Jasa' THEN 1 ELSE 0 END) as `jasa`,
        SUM(CASE WHEN  K.jenis_koperasi = 'Konsumen' THEN 1  ELSE 0 END) as `konsumen`,
        SUM(CASE WHEN  K.jenis_koperasi = 'Simpan Pinjam' THEN 1  ELSE 0 END) as `simpan_pinjam`,
        SUM(CASE WHEN  K.jenis_koperasi = 'Produsen' THEN 1  ELSE 0 END) as `produsen`,
        SUM(CASE WHEN  K.jenis_koperasi = 'Pemasaran' THEN 1  ELSE 0 END) as `pemasaran`
    FROM tbl_koperasi K
    WHERE kecamatan IS NOT NULL AND id_kecamatan = '$id_kec'
    GROUP BY kecamatan, kelurahan";
    $query = $this->db->query($sql);
    return ($query->num_rows() > 0)?$query->result_array():FALSE;
}

}
?>