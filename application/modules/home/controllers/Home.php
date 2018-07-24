<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public $menu = "Home";
	function __construct() {
	    parent::__construct(); 
		$this->load->helper('common');
		$this->load->helper('chart');
		$this->load->library('session');
		$this->load->model('dashboard/Dashboard_model');
	 }

	public function index()
	{
	    $isLoggedIn =  $this->session->userdata('isLoggedIn');
	    if(isset($isLoggedIn) || $isLoggedIn == TRUE)
        {	
			$data_status_koperasi = $this->Dashboard_model->get_statistic_status_koperasi();
			$data_omset_koperasi = $this->Dashboard_model->get_statistic_asset_koperasi();
			$data_jumlah_kop_by_kec = $this->Dashboard_model->get_statistic_jml_koperasi_by_kecamatan();
			$data_jumlah_kop_by_kel = $this->Dashboard_model->get_statistic_jml_koperasi_by_kelurahan();
			$anggota_by_gender = $this->Dashboard_model->get_anggota_by_gender();
			$manajer_by_gender = $this->Dashboard_model->get_manajer_by_gender();
			$karyawan_by_gender = $this->Dashboard_model->get_karyawan_by_gender();

			$lbl_array = array();
			$dt_array = array();
			foreach($data_status_koperasi as $dt_stat){
				if($dt_stat['status_kantor']!='FALSE'){
					$stat = 'Aktif';
				}else{
					$stat = 'Inaktif';
				}
				$lbl_array[] = $stat;
				$dt_array[] = $dt_stat['jml'];	
			}
			$chart_status_kop=generate_chart('bar', $lbl_array, $dt_array,2);

			$lbl_array = array();
			$dt_array = array();
			foreach($data_jumlah_kop_by_kec as $dt_stat){

				$lbl_array[] = $dt_stat['kecamatan'];
				$dt_array[] = $dt_stat['jmlkop'];	
			}
			$chart_kop_by_kec = generate_chart('line',$lbl_array, $dt_array,0);


			$lbl_array = array();
			$dt_array = array();
			foreach($data_jumlah_kop_by_kel as $dt_stat){

				$lbl_array[] = $dt_stat['kelurahan'];
				$dt_array[] = $dt_stat['jmlkop'];	
			}
			$chart_kop_by_kel = generate_chart('line',$lbl_array, $dt_array,0);

			$lbl_array = array();
			$dt_array = array();
			foreach($data_omset_koperasi as $dt_stat){

				$lbl_array[] = $dt_stat['kecamatan'];
				$dt_array[] = $dt_stat['jml'];	
			}
			$chart_kop_by_asset = generate_chart('line',$lbl_array, $dt_array,0);
			$chart_status_kop = $this->status_kantor();
			$chart_jenis_koperasi = $this->jenis_koperasi();
			$chart_jumlah_anggota = $this->jumlah_anggota();
			
			$selected_data ='01';
			$dt_cbo_kec = create_chosen_db_combo('id_kecamatan', 'ref_kecamatan', ' substr(kode,7,2) ', 'nama', 'nama','', $selected_data, " WHERE kode_kabupaten = '32.76'", false);

			$dt_cbo_kec_jenis = create_chosen_db_combo('id_kecamatan_jenis', 'ref_kecamatan', ' substr(kode,7,2) ', 'nama', 'nama','', $selected_data, " WHERE kode_kabupaten = '32.76'", false);

			$dt_cbo_kec_jml_ang = create_chosen_db_combo('id_kecamatan_jml_ang', 'ref_kecamatan', ' substr(kode,7,2) ', 'nama', 'nama','', $selected_data, " WHERE kode_kabupaten = '32.76'", false);
			
			$dt_cbo_kec_omset = create_chosen_db_combo('id_kecamatan_omset', 'ref_kecamatan', ' substr(kode,7,2) ', 'nama', 'nama','', $selected_data, " WHERE kode_kabupaten = '32.76'", false);

			$dt_cbo_kec_shu = create_chosen_db_combo('id_kecamatan_shu', 'ref_kecamatan', ' substr(kode,7,2) ', 'nama', 'nama','', $selected_data, " WHERE kode_kabupaten = '32.76'", false);


			$chart_status_kop = $this->status_kantor();
			$chart_jenis_koperasi = $this->jenis_koperasi();
			$chart_jumlah_anggota =  $this->jumlah_anggota();
			$chart_omset =  $this->omset();
			$chart_shu =  $this->shu();

			$data=array('title' =>'Dashboard',
						'isi' => 'dashboard/dashboard',
						'root'=> $this->menu,
						'chart_status_kop'=>$chart_status_kop,
						'chart_jenis_koperasi'=>$chart_jenis_koperasi,
						'chart_kop_by_kel'=>$chart_kop_by_kel,
						'chart_jumlah_anggota'=>$chart_jumlah_anggota,
						'chart_shu'=>$chart_shu,
						'chart_omset'=>$chart_omset,
						'state'=>'View Data',
						'anggota_by_gender'=>$anggota_by_gender,
						'manajer_by_gender'=>$manajer_by_gender,
						'karyawan_by_gender'=>$karyawan_by_gender,
						'dt_cbo_kec'=>$dt_cbo_kec,
						'dt_cbo_kec_jenis'=>$dt_cbo_kec_jenis,
						'dt_cbo_kec_jml_ang'=>$dt_cbo_kec_jml_ang,
						'dt_cbo_kec_omset'=>$dt_cbo_kec_omset,
						'dt_cbo_kec_shu'=>$dt_cbo_kec_shu,
					);

			$this->load->view('layout/wrapper',$data);
		}else{
			$this->load->view('auth/login');	
		}
	}

public function status_kantor(){
    	$id_kecamatan = $this->input->post('id_kecamatan');
    	if($id_kecamatan==''){
    		$id_kecamatan='01';
    	}
    	$filter = $this->input->post('filter');
    	$status_kantor = $this->Dashboard_model->status_kantor($id_kecamatan);
		$lbl_array = array();
		$dt_array_p = array();
		$dt_array_w = array();
		$dt_array_all = array();
		if(is_array($status_kantor)){
	    	foreach($status_kantor as $dt_stat){
	    		$jml_aktif = $dt_stat['aktif'];
	    		$jml_inaktif = $dt_stat['inaktif'];
	    		$dt_array_p[] = $jml_aktif;
	    		$dt_array_w[] = $jml_inaktif;

	    		$lbl_kec = $dt_stat['kelurahan'];
	    		$lbl_array[] = $lbl_kec;
	    	}
	    }
    	$legend = array('Aktif', 'Tidak Aktif');
    	$dt_array_all = array($dt_array_p, $dt_array_w);
		$colors = array(
              array('backgroundColor' => '#15d861', 'borderColor' => '#15d861'),
              array('backgroundColor' => '#5fced8', 'borderColor' => '#5fced8'),
              array('backgroundColor' => '#5eb6d1', 'borderColor' => '#5eb6d1'),
              array('backgroundColor' => '#a89a70', 'borderColor' => '#a89a70'),
          );
		$array_dataset=array();
		$i=0;
		foreach( $dt_array_all as $dt){  
		    $the_data =array('data' => $dt_array_all[$i], 'label' => $legend[$i]);    
		    $array_dataset[] =  $the_data + $colors[$i];
		  $i++;
		}
		$selected_data ='';
		$dt_cbo_kec = create_chosen_db_combo('id_kecamatan', 'ref_kecamatan', ' substr(kode,7,2) ', 'nama', 'nama','', $selected_data, " WHERE kode_kabupaten = '32.76'", false);
		$chart_anggota=group_bar_chart($dt_array_all, $lbl_array, $array_dataset, 'true', '', 'true', "bottom", 'gender','Koperasi berdasarkan status', 'top');
		$data['content']= $chart_anggota;		
		if($filter==1){
			$this->load->view('chart_content',$data);
		}else{
			return $chart_anggota;
		}
 }


public function jenis_koperasi(){
    	$id_kecamatan = $this->input->post('id_kecamatan_jenis');
    	if($id_kecamatan==''){
    		$id_kecamatan='01';
    	}
    	$filter = $this->input->post('filter');
    	$data_status = $this->Dashboard_model->jenis_kantor($id_kecamatan);
		$lbl_array = array();
		$dt_array_jasa = array();
		$dt_array_konsumen = array();
		$dt_array_sp = array();
		$dt_array_produsen = array();
		$dt_array_pemasaran = array();
		$dt_array_all = array();
		if(is_array($data_status)){
	    	foreach($data_status as $dt_stat){
				$dt_array_jasa[] = $dt_stat['jasa'];
				$dt_array_konsumen[] = $dt_stat['konsumen'];
				$dt_array_sp[] = $dt_stat['simpan_pinjam'];
				$dt_array_produsen[] = $dt_stat['produsen'];
				$dt_array_pemasaran[] = $dt_stat['pemasaran'];

	    		$lbl_array[] =  $dt_stat['kelurahan'];
	    	}
	    }
    	$legend = array('Jasa', 'Konsumen', 'Simpan Pinjam', 'Produsen', "Pemasaran");
    	$dt_array_all = array($dt_array_jasa, $dt_array_konsumen, $dt_array_sp, $dt_array_produsen, $dt_array_pemasaran);
		$colors = array(
              array('backgroundColor' => '#5fced8', 'borderColor' => '#5fced8'),
              array('backgroundColor' => '#0bc490', 'borderColor' => '#0bc490'),
              array('backgroundColor' => '#2e85aa', 'borderColor' => '#2e85aa'),
              array('backgroundColor' => '#b29f90', 'borderColor' => '#b29f90'),
              array('backgroundColor' => '#15d861', 'borderColor' => '#15d861'),
          );
		$array_dataset=array();
		$i=0;
		foreach($dt_array_all as $dt){  
		    $the_data =array('data' => $dt_array_all[$i], 'label' => $legend[$i]);    
		    $array_dataset[] =  $the_data + $colors[$i];
		  $i++;
		}

		//print("<pre>".print_r($array_dataset,true)."</pre>");
		$selected_data ='';
		$dt_cbo_kec = create_chosen_db_combo('id_kecamatan_jenis', 'ref_kecamatan', ' substr(kode,7,2) ', 'nama', 'nama','', $selected_data, " WHERE kode_kabupaten = '32.76'", false);
		$chart_anggota=group_bar_chart($dt_array_all, $lbl_array, $array_dataset, 'true', '', 'true', "bottom", 'Jenis Koperasi','Jenis Koperasi', 'top');

		$data['content']= $chart_anggota;		
		if($filter==1){
			$this->load->view('chart_content',$data);
		}else{
			return $chart_anggota;
		}
    }

	public function jumlah_anggota(){
    	$id_kecamatan = $this->input->post('id_kecamatan_jml_ang');
    	if($id_kecamatan==''){
    		$id_kecamatan='01';
    	}    	
    	$filter = $this->input->post('filter');
    	$data_anggota_by_kec = $this->Dashboard_model->anggota_koperasi_by_kecamatan($id_kecamatan);
		$lbl_array = array();
		$dt_array_p = array();
		$dt_array_w = array();
		$dt_array_all = array();
		if(is_array($data_anggota_by_kec)){
	    	foreach($data_anggota_by_kec as $dt_angg){
	    		$jml_pria = $dt_angg['pria'];
	    		$jml_wanita = $dt_angg['wanita'];
	    		$dt_array_p[] = $jml_pria;
	    		$dt_array_w[] = $jml_wanita;

	    		$lbl_kec = $dt_angg['kelurahan'];
	    		$lbl_array[] = $lbl_kec;
	    	}
	    }
    	$legend = array('Pria', 'Wanita');
    	$dt_array_all = array($dt_array_p, $dt_array_w);
		$colors = array(
              array('backgroundColor' => '#5fced8', 'borderColor' => '#5fced8'),
              array('backgroundColor' => '#15d861', 'borderColor' => '#15d861'),
              array('backgroundColor' => '#5eb6d1', 'borderColor' => '#5eb6d1'),
              array('backgroundColor' => '#a89a70', 'borderColor' => '#a89a70'),
              array('backgroundColor' => array('blue', 'purple', 'red', 'black', 'brown', 'pink', 'green'))
          );
		$array_dataset=array();
		$i=0;
		foreach( $dt_array_all as $dt){  
		    $the_data =array('data' => $dt_array_all[$i], 'label' => $legend[$i]);    
		    $array_dataset[] =  $the_data + $colors[$i];
		  $i++;
		}
		$selected_data ='';
		$dt_cbo_kec = create_chosen_db_combo('id_kecamatan', 'ref_kecamatan', ' substr(kode,7,2) ', 'nama', 'nama','', $selected_data, " WHERE kode_kabupaten = '32.76'", false);
		$chart_anggota=group_bar_chart($dt_array_all, $lbl_array, $array_dataset, 'true', 'Jumlah Anggota', 'true', "bottom", 'gender','Anggota berdasarkan gender', 'top');

		$data['content']= $chart_anggota;		
		if($filter==1){
			$this->load->view('chart_content',$data);
		}else{
			return $chart_anggota;
		}
    }


public function omset(){
	$id_kecamatan = $this->input->post('id_kecamatan');
	if($id_kecamatan==''){
		$id_kecamatan='01';
	}
	$filter = $this->input->post('filter');

	$lbl_array = array();
	$dt_array = array();
	$data_omset_koperasi = $this->Dashboard_model->get_statistic_omset_koperasi($id_kecamatan);
	foreach($data_omset_koperasi as $dt_stat){

		$lbl_array[] = $dt_stat['kelurahan'];
		$dt_array[] = $dt_stat['jml'];	
	}
	$chart_omset = generate_chart('line',$lbl_array, $dt_array,0, '', '', 'Omset Koperasi Berdasar Kelurahan' , true, 'bottom','top','Omset');
	$data['content']= $chart_omset;		
	if($filter==1){
		$this->load->view('chart_content',$data);
	}else{
		return $chart_omset;
	}
}

public function shu(){
	$id_kecamatan = $this->input->post('id_kecamatan');
	if($id_kecamatan==''){
		$id_kecamatan='01';
	}
	$filter = $this->input->post('filter');

	$lbl_array = array();
	$dt_array = array();
	$data_omset_koperasi = $this->Dashboard_model->get_statistic_shu_koperasi($id_kecamatan);
	foreach($data_omset_koperasi as $dt_stat){

		$lbl_array[] = $dt_stat['kelurahan'];
		$dt_array[] = $dt_stat['jml'];	
	}
	$chart_omset = generate_chart('line',$lbl_array, $dt_array,0, '', '', 'SHU Koperasi Berdasar Kelurahan' , true, 'bottom','top','SHU');
	$data['content']= $chart_omset;		
	if($filter==1){
		$this->load->view('chart_content',$data);
	}else{
		return $chart_omset;
	}
}



}