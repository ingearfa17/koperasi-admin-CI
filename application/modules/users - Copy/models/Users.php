<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/Class.upload.php';
require APPPATH . '/libraries/Cryptlib.php';

class Users extends CI_Controller{
	private $error;
    private $success;

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
      $this->perPage = get_sys_setting("004");
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
        // if($this->session->userdata('user_id')){
            $data = array();
            
            //total rows count
            $totalRec = count($this->Users_model->getRows());
            
            //pagination configuration
            $config['target']      = '#postList';
            $config['base_url']    = base_url().'user/users/ajaxPaginationData';
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            $config['link_func']   = 'searchFilter';
            $this->ajax_pagination->initialize($config);
            
            //get container Template
			//$data=load_template('users');	

            //get the posts data
            $data['posts'] = $this->Users_model->getRows(array('limit'=>$this->perPage));
            $selected_data = '';
		
			$data['dt_cbo_role'] = create_chosen_db_combo('roles','roles','tbl_roles', 'roles_id', 'roles_name', 'roles_id', '-Please Select-', $selected_data, True);  

            $data['dt_cbo_bagian'] = create_chosen_db_combo('bagian','nm_bagian','ref_bagian', 'kd_bagian', 'nm_bagian', 'kd_bagian', '-Please Select-', $selected_data, True);         
 
            $data['dt_cbo_sub_bagian'] = create_chosen_db_combo('sub_bagian','nm_sub_bagian','ref_sub_bagian', 'kd_sub_bagian', 'nm_sub_bagian', 'id_sub_bagian', '-Please Select-', $selected_data, True);  

            //load the view
            $this->load->view('template/adm_main',$data);
       // }else{
        //    $this->load->view('user/login');
       // }    
	}

function ajaxPaginationData(){
	 //if($this->session->userdata('user_id')){
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

        $rowcount= count($this->Users_model->getRows($conditions));
        $paging_url = base_url().'user/users/ajaxPaginationData';	

	 	$data['posts'] = $this->ajaxPaginationDatax($conditions, $rowcount,'searchFilter',$paging_url );
	 	$this->load->view('user/users_data', $data, false);
	/* }else{
	 	$this->load->view('user/login'); 
	 }*/
}

 function ajaxPaginationDatax($conditions, $rowcount, $func_name_from_view,$paging_url){
     // if($this->session->userdata('user_id')){
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
        $config['uri_segment'] = 4;
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

        return $this->$model_name->$funct_model_name($conditions);
    }


	function upload_data_no_image(){
		//if($this->session->userdata('user_id')){
            $converter = new Encryption;
			date_default_timezone_set("Asia/Bangkok");
		 	$t = time();
		 	$flag_save=$this->input->post('flag_save');
			$sysdate = date("Y-m-d H:i:s");
			$msg_save='';	
			if($flag_save=='1'){
				$dtarray = array(    
                    'user_name'=>$this->input->post('user_name'),
                    'pwd'=>$converter->encode($this->input->post('Password')),
                    'email'=>$this->input->post('email'),
                    'full_name'=>$this->input->post('full_name'),
                    'roles_id'=>$this->input->post('roles'),
                    'kd_bagian'=>$this->input->post('bagian'),
                    'kd_sub_bagian'=>$this->input->post('sub_bagian')
                    'create_date'=>$sysdate,
                    'create_by' =>$this->session->userdata('name')
	            );
				$this->Users_model->save_data($dtarray);
	            $msg_save.= 'Data Saved successfully ';
			}else{
				$id = $this->input->post('user_id');
				$dtarray = array(    
                    'user_name'=>$this->input->post('user_name'),
                    'pwd'=>$converter->encode($this->input->post('password')),
                    'email'=>$this->input->post('email'),
                    'full_name'=>$this->input->post('full_name'),
                    'roles_id'=>$this->input->post('roles'),
                    'kd_bagian'=>$this->input->post('bagian'),
                    'kd_sub_bagian'=>$this->input->post('sub_bagian')
                    'update_date'=>$sysdate,
                    'update_by' =>$this->session->userdata('name')
	            );
				$this->Users_model->update_data($dtarray, $id);
				$msg_save.= 'Data Updated successfully ';
			}
			echo $msg_save; 
	//	}else{
       //   	$this->load->view('user/login'); 
      //	}	
	}

    function upload_data(){
        //if($this->session->userdata('user_id')){
            $converter = new Encryption;
            date_default_timezone_set("Asia/Bangkok");
            $img_folder ='assets/images/upload/';
            $t = time();
            $flag_save=$this->input->post('flag_save');
            $sysdate = date("Y-m-d H:i:s");
            $msg_save='';   
            $ret_msg_save='';
            $img_change=true;
            if($_FILES['file']['error']!=4){ //if image selected to upload
                $path = $_FILES['file']['name'];
                $ext = ".".pathinfo($path, PATHINFO_EXTENSION);
                //echo $ext;
                 $handle = new Upload($_FILES['file']);
                 $handle->allowed = 'image/*';
                    if($handle->uploaded) {//IF image begin to upload
                        $img_name_to_save = "imguser_$t";
                        $handle->file_new_name_body = $img_name_to_save;
                        $handle->Process($img_folder);
                        if($handle->processed) {//if data saved with image
                            $dtarray = array(    
                                'user_name'=>$this->input->post('user_name'),
                                'pwd'=>$converter->encode($this->input->post('Password')),
                                'email'=>$this->input->post('email'),
                                'full_name'=>$this->input->post('full_name'),
                                'roles_id'=>$this->input->post('roles'),
                                'kd_bagian'=>$this->input->post('bagian'),
                                'kd_sub_bagian'=>$this->input->post('sub_bagian')
                                'img_files'=> $img_name_to_save.$ext,
                                'create_date'=>$sysdate,
                                'create_by' =>$this->session->userdata('name')
                            );
                            $msg_save.= 'Completed successfully ';

                        }
                    }
            }else{// image not selected - image can upload later using edit mode
                $img_change=false;
                $dtarray = array(    
                    'user_name'=>$this->input->post('user_name'),
                    'pwd'=>$converter->encode($this->input->post('Password')),
                    'email'=>$this->input->post('email'),
                    'full_name'=>$this->input->post('full_name'),
                    'roles_id'=>$this->input->post('roles'),
                    'kd_bagian'=>$this->input->post('bagian'),
                    'kd_sub_bagian'=>$this->input->post('sub_bagian')
                    'create_date'=>$sysdate,
                    'create_by' =>$this->session->userdata('name')
                );
                $msg_save.= 'With no image included/changes, you can add/change image later using edit menu ';
            }
            $img_name_with_folder='';
            if($img_change!=false){
                $img_name_with_folder = $img_folder.$img_name_to_save.$ext;
            }
            if($flag_save=='1'){
                $result= $this->Users_model->save_data($dtarray,$img_name_with_folder);
                if($result==1){
                    $ret_msg_save="Data Saved  ". $msg_save;
                }else{
                    $ret_msg_save="Error occured .  ". $result;
                }
            }else{

                $id = $this->input->post('user_id');
                $fname = get_user_image($id);
                $full_fname = $img_folder.$fname;
                if($this->input->post('flag_img_del')=='1'){//if deleted is checked
                    if($fname!=''){
                        if(file_exists($full_fname)){
                            unlink($full_fname);
                        }
                        $dtarray = array(    
                            'img_files'=>'',
                            'update_date'=>$sysdate,
                            'update_by' =>$this->session->userdata('name')
                           );   
                        $msg_save=' with image deleted';
                    }
                }
                if($img_change==true && $fname !=''){
                    unlink($full_fname);
                }
                $this->Users_model->update_data($dtarray, $id,$img_name_with_folder);
                $ret_msg_save.="Data Updated  ". $msg_save;
            }
            echo $ret_msg_save; 
       /* }else{
            $this->load->view('user/login'); 
        } */  
    }

    public function get_sub_bagian_by_sub_bag(){
        $kd_bagian = $this->input->post('kd_bagian');
        $this->Users_model->get_sub_bagian_by_sub_bag($kd_bagian);
    }



    function get_data(){
        //if($this->session->userdata('user_id')){    
            $id = $this->input->post('user_id');
            $this->Users_model->get_data_by_id($id);
        // }else{
         //   $this->load->view('user/login');     
        //}   
    }

	function row_delete(){
        $img_folder ='assets/images/upload/';
		$arr_id = $this->input->post('id_content');
		echo $this->Users_model->row_delete($arr_id);
	}


}
?>