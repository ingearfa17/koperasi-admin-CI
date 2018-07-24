<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koperasi extends CI_Controller {
    public $menu = "Home";
	public function __construct() {
	  parent::__construct();
	  $this->load->helper('url');
      $this->load->helper('html');
 	  $this->load->helper('form');
	  $this->load->helper('common');
	  $this->load->helper(array('url','file'));
      $this->load->library('form_validation');
      $this->load->library('curl');
      $this->load->library('Ajax_pagination');
      $this->load->model('Koperasi_model');
      $this->perPage = get_sys_setting("004");
	}

    function index(){
		if($this->session->userdata('user_id')){

            $totalRec = count($this->Koperasi_model->getRows());
            $idmenu = $this->input->post('idmenu');
            //pagination configuration
            $config['target']      = '#postList';
            $config['base_url']    = base_url().'koperasi/ajaxPaginationData';
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchFilter';
            $this->ajax_pagination->initialize($config);
            $selected_data ='';
            $data_src = $this->Koperasi_model->getRows(array('limit'=>$this->perPage));

            $dt_cbo_kec = create_chosen_db_combo('id_kecamatan', 'ref_kecamatan', ' substr(kode,7,2) ', 'nama', 'nama','', $selected_data, " WHERE kode_kabupaten = '32.76'", false); 
            $dt_cbo_kel = create_chosen_db_combo('id_kelurahan','ref_kelurahan', ' substr(kode,12,2) ', 'nama', 'nama', '', $selected_data, " WHERE substr(kode,1,5)='32.76'", false);  
            $dt_cbo_status_kop = create_chosen_db_combo('status_kantor','ref_status', ' status_koperasi kode ', 'status_koperasi', 'status_koperasi', '', $selected_data, " ", false);  
            $dt_cbo_bentuk_kop = create_chosen_db_combo('bentuk_koperasi','ref_bentuk', 'bentuk_koperasi kode', 'bentuk_koperasi', 'bentuk_koperasi', '', $selected_data, " ", false);  
            $dt_cbo_jenis_kop = create_chosen_db_combo('jenis_koperasi','ref_jenis', 'jenis_koperasi kode', 'jenis_koperasi', 'jenis_koperasi', '', $selected_data, " ", false);  
            $dt_cbo_klp_kop = create_chosen_db_combo('klp_koperasi','ref_kelompok', 'kelompok_koperasi kode', 'kelompok_koperasi', 'kelompok_koperasi', '', $selected_data, " ", false);  

            $dt_cbo_sektor_usaha_kop = create_chosen_db_combo('sektor_usaha','ref_sektor_usaha', 'sektor_usaha_koperasi kode', 'sektor_usaha_koperasi', 'sektor_usaha_koperasi', '', $selected_data, " ", false);  
            $dt_cbo_unit_usaha_kop = create_chosen_db_combo('unit_usaha','ref_unit_usaha', 'unit_usaha_koperasi kode', 'unit_usaha_koperasi', 'unit_usaha_koperasi', '', $selected_data, " ", false);  
            $dt_cbo_klasifikasi_kop = create_chosen_db_combo('klasifikasi','ref_klasifikasi', 'klasifikasi_koperasi kode', 'klasifikasi_koperasi', 'klasifikasi_koperasi', '', $selected_data, " ", false);  
            $dt_cbo_kesehatan_kop = create_chosen_db_combo('kesehatan','ref_kesehatan', 'kesehatan_koperasi kode', 'kesehatan_koperasi', 'kesehatan_koperasi', '', $selected_data, " ", false);  

            $breadcrumb = get_breadcrumb_info($idmenu);     
            $data=array('title' => $breadcrumb,
                        'posts'=>$data_src,
                        'isi' => 'koperasi',
                        'root'=> $this->menu,
                        'dt_cbo_kec'=>$dt_cbo_kec,
                        'dt_cbo_kel'=>$dt_cbo_kel,
                        'dt_cbo_status_kop'=>$dt_cbo_status_kop,
                        'dt_cbo_bentuk_kop'=>$dt_cbo_bentuk_kop,
                        'dt_cbo_jenis_kop'=>$dt_cbo_jenis_kop,
                        'dt_cbo_klp_kop'=>$dt_cbo_klp_kop,
                        'dt_cbo_sektor_usaha_kop'=>$dt_cbo_sektor_usaha_kop,
                        'dt_cbo_unit_usaha_kop'=>$dt_cbo_unit_usaha_kop,
                        'dt_cbo_klasifikasi_kop'=>$dt_cbo_klasifikasi_kop,
                        'dt_cbo_kesehatan_kop'=>$dt_cbo_kesehatan_kop

                    );
            $this->load->view('layout/wrapper_content',$data);
		}else{
			$this->load->view('auth/login');
		}
	}

	
function ajaxPaginationData(){
	 if($this->session->userdata('user_id')){
 		$conditions = array();
        
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }

        $rowcount= count($this->Koperasi_model->getRows($conditions));
        $paging_url = base_url().'koperasi/ajaxPaginationData';	

	 	$data['posts'] = $this->ajaxPaginationDatax($conditions, $rowcount,'searchFilter',$paging_url );
	 	$this->load->view('koperasi/koperasi_data', $data, false);
	 }else{
	 	$this->load->view('auth/login'); 
	 }
}

 function ajaxPaginationDatax($conditions, $rowcount, $func_name_from_view,$paging_url){
      if($this->session->userdata('user_id')){
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        $model_name = 'Koperasi_model';
        $funct_model_name = 'getRows';
       
       
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = $paging_url; 
        $config['total_rows']  = $rowcount;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = $func_name_from_view ;//'searchFilter';
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

        return $this->$model_name->$funct_model_name($conditions);
     }else{
        $this->load->view('auth/login'); 
     }
    }


	function savedata(){
		//echo "kode baru". generate_kd_koperasi('03', '10');
		if($this->session->userdata('user_id')){
			$msg_save='';	
			$id_kec = $this->input->post('id_kecamatan');
			$id_kel = $this->input->post('id_kelurahan');

			$dtarray = array(    	
				'kd_koperasi'=>generate_kd_koperasi($id_kec, $id_kel),
				'nm_koperasi'=>$this->input->post('nm_koperasi'),
				'no_badan_hukum'=>$this->input->post('no_badan_hukum'),
				'tgl_badan_hukum'=>format_date_as_db_format($this->input->post('tgl_badan_hukum')),
				'alamat_kantor'=>$this->input->post('alamat_kantor'),
				'desa'=>$this->input->post('desa'),
				'kelurahan'=>$this->input->post('kelurahan'),
				'kecamatan'=>$this->input->post('kecamatan'),
				'kabupaten'=>$this->input->post('kabupaten'),
				'propinsi'=>$this->input->post('propinsi'),
				'kode_pos'=>$this->input->post('kode_pos'),
				'no_tlp1'=>$this->input->post('no_tlp1'),
				'no_tlp2'=>$this->input->post('no_tlp2'),
				'no_fax'=>$this->input->post('no_fax'),
				'email'=>$this->input->post('email'),
				'website'=>$this->input->post('website'),
				'status_kantor'=>$this->input->post('status_kantor'),
				'ketua'=>$this->input->post('ketua'),
				'no_tlp_ketua'=>$this->input->post('no_tlp_ketua'),
				'sekretaris'=>$this->input->post('sekretaris'),
				'no_tlp_sekretaris'=>$this->input->post('no_tlp_sekretaris'),
				'bendahara'=>$this->input->post('bendahara'),
				'no_tlp_bendahara'=>$this->input->post('no_tlp_bendahara'),
				'bentuk_koperasi'=>$this->input->post('bentuk_koperasi'),
				'Jenis_koperasi'=>$this->input->post('Jenis_koperasi'),
				'klp_koperasi'=>$this->input->post('klp_koperasi'),
				'sektor_usaha'=>$this->input->post('sektor_usaha'),
				'unit_usaha'=>$this->input->post('unit_usaha'),
				'klasifikasi'=>$this->input->post('klasifikasi'),
				'kesehatan'=>$this->input->post('kesehatan'),
				'thn_ind_kelembagaan'=>$this->input->post('thn_ind_kelembagaan'),
				'anggota_pria'=>$this->input->post('anggota_pria'),
				'anggota_wanita'=>$this->input->post('anggota_wanita'),
				'jml_anggota'=>$this->input->post('jml_anggota'),
				'manajer_pria'=>$this->input->post('manajer_pria'),
				'manajer_wanita'=>$this->input->post('manajer_wanita'),
				'jml_manajer'=>$this->input->post('jml_manajer'),
				'karyawan_pria'=>$this->input->post('karyawan_pria'),
				'karyawan_wanita'=>$this->input->post('karyawan_wanita'),
				'jml_karyawan'=>$this->input->post('jml_karyawan'),
				'rat'=>format_date_as_db_format($this->input->post('rat')),
				'thn_ind_usaha'=>$this->input->post('thn_ind_usaha'),
				'modal_sendiri'=>$this->input->post('modal_sendiri'),
				'modal_luar'=>$this->input->post('modal_luar'),
				'asset'=>$this->input->post('asset'),
				'volume_usaha'=>$this->input->post('volume_usaha'),
				'total'=>$this->input->post('total'),
				'shu'=>$this->input->post('shu'),
				'id_propinsi'=>get_sys_setting ('005'),
				'id_kabupaten'=>get_sys_setting ('006'),
				'id_kecamatan'=>$this->input->post('id_kecamatan'),
				'id_kelurahan'=>$this->input->post('id_kelurahan')
			);	
				$msg = $this->Koperasi_model->savedata($dtarray);
                echo $msg;
		}else{
          	$this->load->view('auth/login'); 
      	}	
	}

    function updatedata(){
	if($this->session->userdata('user_id')){
			$msg_save='';	
			$id = $this->input->post('id_koperasi_edit');
			$dtarray = array(    	
				'nm_koperasi'=>$this->input->post('nm_koperasi_edit'),
				'no_badan_hukum'=>$this->input->post('no_badan_hukum_edit'),
				'tgl_badan_hukum'=>format_date_as_db_format($this->input->post('tgl_badan_hukum_edit')),
				'alamat_kantor'=>$this->input->post('alamat_kantor_edit'),
				'kode_pos'=>$this->input->post('kode_pos_edit'),
				'no_tlp1'=>$this->input->post('no_tlp1_edit'),
				'no_tlp2'=>$this->input->post('no_tlp2_edit'),
				'no_fax'=>$this->input->post('no_fax_edit'),
				'email'=>$this->input->post('email_edit'),
				'website'=>$this->input->post('website_edit'),
				'status_kantor'=>$this->input->post('status_kantor_edit'),
				'ketua'=>$this->input->post('ketua_edit'),
				'no_tlp_ketua'=>$this->input->post('no_tlp_ketua_edit'),
				'sekretaris'=>$this->input->post('sekretaris_edit'),
				'no_tlp_sekretaris'=>$this->input->post('no_tlp_sekretaris_edit'),
				'bendahara'=>$this->input->post('bendahara_edit'),
				'no_tlp_bendahara'=>$this->input->post('no_tlp_bendahara_edit'),
				'bentuk_koperasi'=>$this->input->post('bentuk_koperasi_edit'),
				'Jenis_koperasi'=>$this->input->post('Jenis_koperasi_edit'),
				'klp_koperasi'=>$this->input->post('klp_koperasi_edit'),
				'sektor_usaha'=>$this->input->post('sektor_usaha_edit'),
				'unit_usaha'=>$this->input->post('unit_usaha_edit'),
				'klasifikasi'=>$this->input->post('klasifikasi_edit'),
				'kesehatan'=>$this->input->post('kesehatan_edit'),
				'thn_ind_kelembagaan'=>$this->input->post('thn_ind_kelembagaan_edit'),
				'anggota_pria'=>$this->input->post('anggota_pria_edit'),
				'anggota_wanita'=>$this->input->post('anggota_wanita_edit'),
				'jml_anggota'=>$this->input->post('jml_anggota_edit'),
				'manajer_pria'=>$this->input->post('manajer_pria_edit'),
				'manajer_wanita'=>$this->input->post('manajer_wanita_edit'),
				'karyawan_pria'=>$this->input->post('karyawan_pria_edit'),
				'karyawan_wanita'=>$this->input->post('karyawan_wanita_edit'),
				'rat'=>format_date_as_db_format($this->input->post('rat_edit')),
				'thn_ind_usaha'=>$this->input->post('thn_ind_usaha_edit'),
				'modal_sendiri'=>$this->input->post('modal_sendiri_edit'),
				'modal_luar'=>$this->input->post('modal_luar_edit'),
				'asset'=>$this->input->post('asset_edit'),
				'volume_usaha'=>$this->input->post('volume_usaha_edit'),
				'shu'=>$this->input->post('shu_edit'),
				'id_propinsi'=>$this->input->post('id_propinsi_edit'),
				'id_kabupaten'=>$this->input->post('id_kabupaten_edit'),
				'id_kecamatan'=>$this->input->post('id_kecamatan_edit'),
				'id_kelurahan'=>$this->input->post('id_kelurahan_edit'),

			);	
				$msg = $this->Koperasi_model->updatedata($dtarray,$id);
                echo $msg;
		}else{
          	$this->load->view('auth/login'); 
      	}   
    }    

    function editdata(){
        if($this->session->userdata('user_id')){    
            $id = $this->input->post('the_id');
            $init_data=$this->Koperasi_model->get_dataforinit($id);


            $id_kec=$init_data->id_kecamatan;
            $id_kel=$init_data->id_kecamatan;
            $status_kop = $init_data->status_kantor;
            $bentuk_kop = $init_data->bentuk_koperasi;
            $jenis_kop = $init_data->jenis_koperasi;
            $klp_kop = $init_data->klp_koperasi;
            $sektor = $init_data->sektor_usaha;
            $unit = $init_data->unit_usaha;
            $klas = $init_data->klasifikasi;
            $kesehatan = $init_data->kesehatan;

            $selected_item=$this->Koperasi_model->get_dataforinit($id);

            $dt_cbo_kec = create_chosen_db_combo('id_kecamatan_edit', 'ref_kecamatan', ' substr(kode,7,2) ', 'nama', 'nama','', $id_kec, " WHERE kode_kabupaten = '32.76'", false); 
            $dt_cbo_kel = create_chosen_db_combo('id_kelurahan_edit','ref_kelurahan', ' substr(kode,12,2) ', 'nama', 'nama', '', $id_kel, " WHERE substr(kode,1,5)='32.76'", false);  
            $dt_cbo_status_kop = create_chosen_db_combo('status_kantor_edit','ref_status', ' status_koperasi kode ', 'status_koperasi', 'status_koperasi', '', $status_kop, " ", false);  
            $dt_cbo_bentuk_kop = create_chosen_db_combo('bentuk_koperasi_edit','ref_bentuk', 'bentuk_koperasi kode', 'bentuk_koperasi', 'bentuk_koperasi', '', $bentuk_kop, " ", false);  
            $dt_cbo_jenis_kop = create_chosen_db_combo('jenis_koperasi_edit','ref_jenis', 'jenis_koperasi kode', 'jenis_koperasi', 'jenis_koperasi', '', $jenis_kop, " ", false);  
            $dt_cbo_klp_kop = create_chosen_db_combo('klp_koperasi_edit','ref_kelompok', 'kelompok_koperasi kode', 'kelompok_koperasi', 'kelompok_koperasi', '', $klp_kop, " ", false);  

            $dt_cbo_sektor_usaha_kop = create_chosen_db_combo('sektor_usaha_edit','ref_sektor_usaha', 'sektor_usaha_koperasi kode', 'sektor_usaha_koperasi', 'sektor_usaha_koperasi', '', $sektor, " ", false);  
            $dt_cbo_unit_usaha_kop = create_chosen_db_combo('unit_usaha_edit','ref_unit_usaha', 'unit_usaha_koperasi kode', 'unit_usaha_koperasi', 'unit_usaha_koperasi', '', $unit, " ", false);  
            $dt_cbo_klasifikasi_kop = create_chosen_db_combo('klasifikasi_edit','ref_klasifikasi', 'klasifikasi_koperasi kode', 'klasifikasi_koperasi', 'klasifikasi_koperasi', '', $klas, " ", false);  
            $dt_cbo_kesehatan_kop = create_chosen_db_combo('kesehatan_edit','ref_kesehatan', 'kesehatan_koperasi kode', 'kesehatan_koperasi', 'kesehatan_koperasi', '', $kesehatan, " ", false);  

            $data=array('dt_init'=>$selected_item,
                        'isi' => 'koperasi',
                        'root'=> $this->menu,
                        'dt_cbo_kec'=>$dt_cbo_kec,
                        'dt_cbo_kel'=>$dt_cbo_kel,
                        'dt_cbo_status_kop'=>$dt_cbo_status_kop,
                        'dt_cbo_bentuk_kop'=>$dt_cbo_bentuk_kop,
                        'dt_cbo_jenis_kop'=>$dt_cbo_jenis_kop,
                        'dt_cbo_klp_kop'=>$dt_cbo_klp_kop,
                        'dt_cbo_sektor_usaha_kop'=>$dt_cbo_sektor_usaha_kop,
                        'dt_cbo_unit_usaha_kop'=>$dt_cbo_unit_usaha_kop,
                        'dt_cbo_klasifikasi_kop'=>$dt_cbo_klasifikasi_kop,
                        'dt_cbo_kesehatan_kop'=>$dt_cbo_kesehatan_kop

                    );


            $this->load->view('koperasi_edit', $data, false);
         }else{
            $this->load->view('auth/login');     
        }   
    }

	function row_delete(){
		$arr_id = $this->input->post('id_content');
		echo $this->Koperasi_model->row_delete($arr_id);
	}
}