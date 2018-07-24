<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Perkembangan extends REST_Controller{
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->helper('common');
        $this->load->model('Perkembangan_model');
    }

    function insert_perkembangan_kelembagaan_post(){
          $dtarray = array(       
                'id_koperasi'=>$this->post('id_koperasi'),
                'tgl_kunjungan'=> format_date_as_db_format($this->post('tgl_kunjungan')),
                'jml_anggota_awal'=>$this->post('jml_anggota_awal'),
                'jml_anggota_berjalan'=>$this->post('jml_anggota_berjalan'),
                'rapat_anggota_awal'=>$this->post('rapat_anggota_awal'),
                'rapat_anggota_berjalan'=>$this->post('rapat_anggota_berjalan'),
                'anggaran_dasar_awal'=>$this->post('anggaran_dasar_awal'),
                'anggaran_dasar_berjalan'=>$this->post('anggaran_dasar_berjalan'),
                'art_awal'=>$this->post('art_awal'),
                'art_berjalan'=>$this->post('art_berjalan'),
                'ubah_anggaran_dsr_awal'=>$this->post('ubah_anggaran_dsr_awal'),
                'ubah_anggaran_dsr_berjalan'=>$this->post('ubah_anggaran_dsr_berjalan'),
                'peraturan_khusus_awal'=>$this->post('peraturan_khusus_awal'),
                'peraturan_khusus_berjalan'=>$this->post('peraturan_khusus_berjalan'),
                'anggota_dekopinda_awal'=>$this->post('anggota_dekopinda_awal'),
                'anggota_dekopinda_berjalan'=>$this->post('anggota_dekopinda_berjalan'),
                'legalitas_awal'=>$this->post('legalitas_awal'),
                'legalitas_berjalan'=>$this->post('legalitas_berjalan'),
                'create_date'=>getSysDate(),
                'create_by' =>$this->post('user_id')
         ); 

         $insert_dt = $this->Perkembangan_model->insertdata_perkembangan($dtarray);
         $this->response($insert_dt, 200);
    }

    function updatedata_perkembangan_usaha_post(){
        $id = $this->post('id_perkembangan');
        $dtarray = array(    
            'kegiatan_usaha_awal'=>$this->post('kegiatan_usaha_awal'),
            'kegiatan_usaha_berjalan'=>$this->post('kegiatan_usaha_berjalan'),
            'volume_usaha_awal'=>$this->post('volume_usaha_awal'),
            'volume_usaha_berjalan'=>$this->post('volume_usaha_berjalan'),
            'update_date'=>getSysDate(),
            'update_by' =>$this->post('user_id')
        );

        $update_dt = $this->Perkembangan_model->updatedata_perkembangan_usaha($dtarray, $id);
        $this->response($update_dt, 200);
    }

    function updatedata_perkembangan_keuangan_post(){
        $id = $this->post('id_perkembangan');
        $dtarray = array(    
            'jml_simpok_awal'=>$this->post('jml_simpok_awal'),
            'jml_simpok_berjalan'=>$this->post('jml_simpok_berjalan'),
            'jml_simwaj_awal'=>$this->post('jml_simwaj_awal'),
            'jml_simwaj_berjalan'=>$this->post('jml_simwaj_berjalan'),
            'jml_sim_srela_awal'=>$this->post('jml_sim_srela_awal'),
            'jml_sim_srela_berjalan'=>$this->post('jml_sim_srela_berjalan'),
            'piutang_awal'=>$this->post('piutang_awal'),
            'piutang_berjalan'=>$this->post('piutang_berjalan'),
            'hutang_awal'=>$this->post('hutang_awal'),
            'hutang_berjalan'=>$this->post('hutang_berjalan'),
            'cadangan_awal'=>$this->post('cadangan_awal'),
            'cadangan_berjalan'=>$this->post('cadangan_berjalan'),
            'shu_awal'=>$this->post('shu_awal'),
            'shu_berjalan'=>$this->post('shu_berjalan'),
            'permasalahan'=>$this->post('permasalahan'),
            'foto_kunjungan'=>$this->post('foto_kunjungan'),
            'update_date'=>getSysDate(),
            'update_by'=>$this->post('user_id'),
            'status'=>'1'        
        );
        $update_dt = $this->Perkembangan_model->updatedata_perkembangan_keuangan($dtarray, $id);
        $this->response($update_dt, 200);
    }


    function list_approval_perkembangan_post() {
        $id_koperasi = $this->post('id_koperasi');
        $data = $this->Perkembangan_model->get_list_approval_perkembangan($id_koperasi);
        $this->response($data, 200);
    } 

    function process_data_post() {
        $id_perkembangan = $this->put('id');
        $dtarray = array(    
            'status'=>$this->put('status'),
            'update_date'=>getSysDate(),
            'update_by' =>$this->put('user_id')
        );
        $this->db->where('id_perkembangan', $id_perkembangan);
        $update = $this->db->update('tbl_perkembangan_lembaga', $dtarray);
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