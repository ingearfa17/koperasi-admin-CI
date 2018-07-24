<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik extends CI_Controller {

	public $menu = "Home";
	function __construct() {
	    parent::__construct(); 
		$this->load->helper('common');
        $this->load->model('auth/Auth_model');
	 }

	public function index()
	{
	    $isLoggedIn =  $this->session->userdata('isLoggedIn');
	    if(isset($isLoggedIn) || $isLoggedIn == TRUE){
			$data=array('title' =>'Statistik',
						'isi' => 'dashboard/home',
						'root'=> $this->menu,
					);

			$this->load->view('layout/wrapper',$data);
		}else{
			$this->load->view('auth/login');	
		}
	}



	
}