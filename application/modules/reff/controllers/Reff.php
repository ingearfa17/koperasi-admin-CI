<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Reff extends CI_Controller{
	public $menu = "Home";
	public function __construct() {
	  parent::__construct();
	  $this->load->database();
      $this->load->model('Reff_model');
	  $this->load->database();
	  $this->load->helper('url');
      $this->load->helper('html');
 	  $this->load->helper('form');
	  $this->load->helper('common');
	  $this->load->helper(array('url','file'));
	  $this->load->library('form_validation');
      $this->load->library('Ajax_pagination');
      $this->perPage = get_sys_setting("004");
	
	}

	function list_data($tblname){
        if($this->session->userdata('user_id')){
            $data = array(
                'menu'=> $this->menu,
                'title'=> "User Management",
            );            

			$url = $tblname;
			$tblname = "ref_".$tblname;
			$arr_col = $this->db->list_fields($tblname); 

            //total rows count
            $totalRec = count($this->Reff_model->getRows($tblname));
            $idmenu = $this->input->post('idmenu');
           //pagination configuration
            $config['target']      = '#postList';
            $config['base_url']    = base_url().'reff/ajaxPaginationData';
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchFilter';
            $this->ajax_pagination->initialize($config);
            //get the posts data
            $data_src = $this->Reff_model->getRows($tblname,array('limit'=>$this->perPage));
            $breadcrumb = get_breadcrumb_info($idmenu);     
            $data=array('title' => $breadcrumb,
                        'posts'=>$data_src,
                        'isi' => 'reff',
                        'root'=> $this->menu,
                        'tblname'=>$tblname,
                        'arr_col'=>$arr_col
                    );
            $this->load->view('layout/wrapper_content',$data);
        }else{
            $this->load->view('auth/login');
        }    
	}

	function ajaxPaginationData(){
		 if($this->session->userdata('user_id')){
			$tblname= $this->input->post('tblname');

	 		$conditions = array();
	        //set conditions for search
	        $keywords = $this->input->post('keywords');

	        if(!empty($keywords)){
	            $conditions['search']['keywords'] = $keywords;
	        }
	        
	        $rowcount= count($this->Reff_model->getRows($tblname,$conditions));
	        $paging_url = base_url().'users/ajaxPaginationData';	

		 	$data['posts'] = $this->ajaxPaginationDatax($conditions, $rowcount,'searchFilter',$paging_url );
		 	$data['arr_col'] = $this->db->list_fields($tblname);
		 	$this->load->view('reff_data', $data, false);
		 }else{
		 	$this->load->view('auth/login'); 
		 }
	}

 	function ajaxPaginationDatax($conditions, $rowcount, $func_name_from_view,$paging_url){
      if($this->session->userdata('user_id')){
      	$tblname= $this->input->post('tblname');

        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        $model_name = 'Reff_model';
        $funct_model_name = 'getRows';
       
       
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = $paging_url; //base_url().'wbadmin/article_manag/ajaxPaginationData';
        $config['total_rows']  = $rowcount;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = $func_name_from_view ;//'searchFilter';
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

        return $this->$model_name->$funct_model_name($tblname, $conditions);
     }else{
        $this->load->view('auth/login'); 
     }
   }

	function savedata(){
			if($this->session->userdata('user_id')){
				$tblname= $this->input->post('tblname_to_add');
				$deskripsi= $this->input->post('deskripsi');
				$user_id = $this->session->userdata('user_id');
				$arr_col = $this->db->list_fields($tblname);
	            $data_dtl= array();
				$msg_save='';

	            $data_exist = is_data_exist($tblname, $arr_col[1], "".$arr_col[1]." ='$deskripsi'");
				if(!$data_exist){
					$dtarray = array(    
	                    $arr_col[1]=>$deskripsi,
	                    'create_date'=>getSysDate(),
	                    'create_by' =>$user_id 
		            );
					$msg = $this->Reff_model->insertdata($tblname, $dtarray);
	                echo $msg;
				}else{
	                echo $deskripsi." already exist, please input another one";
	            } 
	        }else{
	            $this->load->view('auth/login'); 
	        }
	}

    function editdata(){
        if($this->session->userdata('user_id')){    
           $id = $this->input->post('the_id');
           $tblname = $this->input->post('tblname');
           $arr_col = $this->db->list_fields($tblname); 
           $data_init = $this->Reff_model->getdata_for_init($tblname, $id);
           $data=array( 
            			'data_init'=>$data_init,
            			'tblname'=>$tblname,
            			'arr_col'=>$arr_col

                   );
            $this->load->view('reff_edit',$data);
        }else{
            $this->load->view('auth/login');     
        }   
    }

	function updatedata(){
        if($this->session->userdata('user_id')){
        	$tblname = $this->input->post('tblname_edit');
            $arr_col = $this->db->list_fields($tblname);
            $update_by = $this->session->userdata('user_id');
            $id = $this->input->post('id_edit'); 
            $msg_save='';
			$dtarray = array(    
                $arr_col[1]=>$this->input->post('deskripsi'),
                'update_date'=>getSysDate(),
                'update_by' =>$update_by 
            );

        	$msg = $this->Reff_model->updatedata($tblname, $dtarray, $id);
        	echo $msg;
 
        }else{
            $this->load->view('auth/login'); 
        }
    }

	function row_delete(){
		$tblname= $this->input->post('tblname');
		$arr_col = $this->db->list_fields($tblname);
		$arr_id = $this->input->post('id_content');
		echo $this->Reff_model->deletedata($tblname, $arr_col[0], $arr_id);
	}


	public function kelurahanbykec_id(){
        $kec_id = $this->input->post('kodex');
        $this->Reff_model->getkelurahanbykec_id($kec_id);
    }



}
?>