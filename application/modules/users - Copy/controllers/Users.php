<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/Class.upload.php';
require APPPATH . '/libraries/Cryptlib.php';

class Users extends CI_Controller{
	private $error;
    private $success;
    public $menu = "Home";

	public function __construct() {
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');
      $this->load->helper('html');
 	  $this->load->helper('form');
	  $this->load->helper('common');
	  $this->load->helper(array('url','file'));
 	  $this->load->library('session');
	  $this->load->library('form_validation');
      $this->load->library('Ajax_pagination');
      $this->load->model('Users_model');
      $this->perPage = 5;// get_sys_setting("004");
	}

	private function handle_error($err) {
       echo  $this->error .= $err . "\r\n";
    }
 
    private function handle_success($succ) {
      echo  $this->success .= $succ . "\r\n";
    }	

    function index(){
    	$data ='';
		if($this->session->userdata('user_id')){
			$data=load_template('mainpage');	
			$this->load->view('user_main',$data);
		}else{
			$this->load->view('login');
		}
	}

	function list_data(){
        if($this->session->userdata('user_id')){
            $data = array(
                'menu'=> $this->menu,
                'title'=> "User Management",
            );
            
            //total rows count
            $totalRec = count($this->Users_model->getRows());
           //pagination configuration
            $config['target']      = '#postList';
            $config['base_url']    = base_url().'users/ajaxPaginationData';
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchFilter';
            $this->ajax_pagination->initialize($config);

            //get the posts data
            $data['posts'] = $this->Users_model->getRows(array('limit'=>$this->perPage));
            $selected_data = '';
		
            $data['dt_cbo_role'] = create_chosen_db_combo('roles','tbl_roles', 'roles_id', 'roles_name', 'roles_id', '', $selected_data, '',false);  
            $data['dt_cbo_opd'] = create_chosen_db_combo('opd','ref_opd', 'id_opd', 'nm_opd', 'id_opd', '', $selected_data, '', false);  
            $data['dt_cbo_urusan'] = create_chosen_db_combo('urusan','ref_urusan', 'kd_urusan', 'nm_urusan', 'kd_urusan', '', $selected_data, '', true);  

            $return = array(
                'data'=>$this->load->view('users', $data, true)
            );
            echo json_encode($return);die();
        }else{
            $this->load->view('auth/login');
        }    
	}

function ajaxPaginationData(){
	 if($this->session->userdata('user_id')){
 		$conditions = array();
        //set conditions for search
        $keywords = $this->input->post('keywords');

        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        
        $rowcount= count($this->Users_model->getRows($conditions));
        $paging_url = base_url().'users/ajaxPaginationData';	

	 	$data['posts'] = $this->ajaxPaginationDatax($conditions, $rowcount,'searchFilter',$paging_url );
	 	$this->load->view('users_data', $data, false);
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
        
        $model_name = 'Users_model';
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

        return $this->$model_name->$funct_model_name($conditions);
     }else{
        $this->load->view('auth/login'); 
     }
   }

	function savedata(){
		if($this->session->userdata('user_id')){
            $converter = new Encryption;
            $id_opd = $this->input->post('opd');
            $user_id = $this->session->userdata('user_id');
            $user_name = $this->input->post('user_name');
            $email = $this->input->post('email');

            $data_dtl= array();
			$msg_save='';
            $data_exist = is_data_exist('tbl_users', 'user_name', "user_name ='$user_name' OR email ='$email'  ");
			if(!$data_exist){
				$dtarray = array(    
                    'user_name'=>$this->input->post('user_name'),
                    'pwd'=>$converter->encode($this->input->post('Password')),
                    'email'=>$this->input->post('email'),
                    'full_name'=>$this->input->post('full_name'),
                    'roles_id'=>$this->input->post('roles'),
                    'id_opd'=>$id_opd,
                    'create_date'=>getSysDate(),
                    'create_by' =>$user_id 
	            );

                $arr_kd_urusan = $this->input->post('urusan');
                foreach ($arr_kd_urusan as $kd_urusan) {
                    $array_dtl=array(
                            'kd_urusan'=>$kd_urusan,
                            'opd_id'=>$id_opd,
                            'user_name'=>$user_name
                    );
                     $data_dtl[] = $array_dtl;                     
                 } 

				$msg = $this->Users_model->insertdata($dtarray, $data_dtl);
                echo $msg;
			}else{
                echo "This user name or Email already exist, please use another one";
            } 
        }else{
            $this->load->view('auth/login'); 
        }
	}

    public function get_sub_bagian_by_sub_bag(){
        $kd_bagian = $this->input->post('kd_bagian');
        $this->Users_model->get_sub_bagian_by_sub_bag($kd_bagian);
    }

    function editdata(){
        if($this->session->userdata('user_id')){    
           $id = $this->input->post('the_id');
           $data['hdr'] = $this->Users_model->getdatauser_hdr($id);
           $dtmultiple = $this->Users_model->getdataurusan_for_init($id);
           $row = $this->Users_model->getdatauser_hdr_for_init($id);
           $data['dt_cbo_role'] = create_chosen_db_combo('roles_edit','tbl_roles', 'roles_id', 'roles_name', 'roles_id', '', $row->roles_id, '',false,'');  
           $data['dt_cbo_opd'] = create_chosen_db_combo('opd_edit','ref_opd', 'id_opd', 'nm_opd', 'id_opd', '', $row->id_opd, '', false,'');  
           $data['dt_cbo_urusan'] = create_chosen_db_combo('urusan_edit','ref_urusan', 'kd_urusan', 'nm_urusan', 'kd_urusan', '', '', '', true,$dtmultiple);  

           $this->load->view('users_edit', $data, false);
        }else{
            $this->load->view('auth/login');     
        }   
    }

function updatedata(){
        if($this->session->userdata('user_id')){
            $converter = new Encryption;
            $id_opd = $this->input->post('opd_edit');
            $createby = $this->session->userdata('user_id_edit');
            $user_name = $this->input->post('user_name_edit');
            $email = $this->input->post('email_edit');
            $id = $this->input->post('user_id_edit'); 

            $data_dtl= array();
            $msg_save='';
            $data_exist = false; // force data_exit to false for edit mode becaue user name & email unchangeable
            if(!$data_exist){
                $dtarray = array(    
                    'pwd'=>$converter->encode($this->input->post('Password_edit')),
                    'full_name'=>$this->input->post('full_name_edit'),
                    'roles_id'=>$this->input->post('roles_edit'),
                    'id_opd'=>$id_opd,
                    'create_date'=>getSysDate(),
                    'create_by' =>$createby 
                );

                $arr_kd_urusan = $this->input->post('urusan_edit');
                foreach ($arr_kd_urusan as $kd_urusan) {
                    $array_dtl=array(
                            'kd_urusan'=>$kd_urusan,
                            'opd_id'=>$id_opd,
                            'user_name'=>$user_name
                    );
                     $data_dtl[] = $array_dtl;                     
                 } 

                $msg = $this->Users_model->updatedata($dtarray, $id, $data_dtl);
                echo $msg;
            }else{
                echo "This user name or Email already exist, please use another one";
            } 
        }else{
            $this->load->view('auth/login'); 
        }
    }



	function deletedata(){
		$arr_id = $this->input->post('id_content');
		echo $this->Users_model->deletedata($arr_id);
	}


}
?>