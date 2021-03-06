<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');


class User_roles extends CI_Controller{
	private $error;
    private $success;
    public $menu = "Home";
    var $API = '';
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
      $this->load->model('User_roles_model');
      $this->perPage = get_sys_setting("004");
      $this->API= base_url()."apigw";

	}

	private function handle_error($err) {
       echo  $this->error .= $err . "\r\n";
    }
 
    private function handle_success($succ) {
      echo  $this->success .= $succ . "\r\n";
    }	

    function create(){
                $dtarray = array(    
                    'roles_name'=>$this->input->post('roles_name'),
                    'roles_desc'=>$this->input->post('roles_desc'),
                    'create_date'=>getSysDate(),
                    'create_by' =>$this->session->userdata('full_name')
                );
                $insert = $this->curl->simple_post($this->API.'/user_roles',$dtarray, array(CURLOPT_BUFFERSIZE=>10));
                if($insert){
                   echo $insert;
                }else{
                   echo $insert;
                }
     }


    function index(){
		if($this->session->userdata('user_id')){

            $totalRec = count($this->User_roles_model->getRows());
            $idmenu = $this->input->post('idmenu');
            //pagination configuration
            $config['target']      = '#postList';
            $config['base_url']    = base_url().'user/user_roles/ajaxPaginationData';
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchFilter';
            $this->ajax_pagination->initialize($config);
            $selected_data ='';
            $data_src = $this->User_roles_model->getRows(array('limit'=>$this->perPage));
            $dt_cbo_menu = create_chosen_db_combo('menu','sys_admin_menu', 'id_menu', 'menu_label', 'id_menu', '', $selected_data, '', true); 
            $breadcrumb = get_breadcrumb_info($idmenu);     
            $data=array('title' => $breadcrumb,
                        'posts'=>$data_src,
                        'isi' => 'user_roles',
                        'root'=> $this->menu,
                        'dt_cbo_menu'=>$dt_cbo_menu

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

        $rowcount= count($this->User_roles_model->getRows($conditions));
        $paging_url = base_url().'users/user_roles/ajaxPaginationData';	

	 	$data['posts'] = $this->ajaxPaginationDatax($conditions, $rowcount,'searchFilter',$paging_url );
	 	$this->load->view('users/user_roles_data', $data, false);
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
        
        $model_name = 'User_roles_model';
        $funct_model_name = 'getRows';
       
       
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = $paging_url; 
        $config['total_rows']  = $rowcount;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = $func_name_from_view ;//'searchFilter';
        $config['uri_segment'] = 4;
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
		if($this->session->userdata('user_id')){
			$msg_save='';	
				$dtarray = array(    
                    'roles_name'=>$this->input->post('roles_name'),
                    'roles_desc'=>$this->input->post('roles_desc'),
                    'create_date'=>getSysDate(),
                    'create_by' =>$this->session->userdata('full_name')
	            );

                $arr_dtl = $this->input->post('menu');
				$msg = $this->User_roles_model->savedata($dtarray, $arr_dtl);
                echo $msg;
		}else{
          	$this->load->view('auth/login'); 
      	}	
	}

    function updatedata(){
        if($this->session->userdata('user_id')){
            $id = $this->input->post('role_id');
            $msg_save='';   
                $dtarray = array(    
                    'roles_name'=>$this->input->post('roles_name'),
                    'roles_desc'=>$this->input->post('roles_desc'),
                    'update_date'=>getSysDate(),
                    'update_by' =>$this->session->userdata('full_name')
                );
                $arr_dtl = $this->input->post('menu');
                $msg = $this->User_roles_model->updatedata($dtarray, $id, $arr_dtl);
                echo $msg;
        }else{
            $this->load->view('auth/login'); 
        }   
    }    

    function editdata(){
        if($this->session->userdata('user_id')){    
            $id = $this->input->post('the_id');
            $data['dtrole']=$this->User_roles_model->get_data_by_id($id);
            $selected_item=$this->User_roles_model->getdtmenu_for_init($id);
            $data['dt_cbo_menu'] = create_chosen_db_combo('menu','sys_admin_menu', 'id_menu', 'menu_label', 'id_menu', '', '', '', true, $selected_item); 
            $this->load->view('user_roles_edit', $data, false);
         }else{
            $this->load->view('auth/login');     
        }   
    }

	function row_delete(){
		$arr_id = $this->input->post('id_content');
		echo $this->User_roles_model->row_delete($arr_id);
	}

	function verify_delete(){
	  $arr_id = $this->input->post('id_content');

	  //print_r($arr_id);
	  echo $this->User_roles_model->is_role_used_by_user($arr_id);
	}


}
?>