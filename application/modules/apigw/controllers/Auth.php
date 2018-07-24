<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */

class Auth extends REST_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');

    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn =  $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('login');
        }
        else
        {
            redirect('home');
        }
    }
    
    
    /**
     * This function used to logged in user
     */
    public function index_post()
    {
        
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $result = $this->Auth_model->loginme($email, $password);
            if(count($result) > 0)
            {
                foreach ($result as $res)
                {
                    $sessionArray = array('error'=>'false',  
                                          'user_id'=>$res->user_id,                    
                                          'user_name'=>$res->user_name,
                                          'full_name'=>$res->full_name,
                                          'isLoggedIn' => TRUE,
                                          'roles_id'=>$res->roles_id,
                                          'roles_name' =>$res->roles_name,
                                          'id_kec' =>$res->id_kecamatan,
                                          'id_kel' =>$res->id_kelurahan
                                );
                                    
                    $this->response($sessionArray, 200);
               }
            }
            else
            {
               $this->response(array('error' => 'true' , 502)); 
            }
    }


    function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }

}

?>