<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller{
	protected $view_data = array();
	protected $user_session = NULL;



	public function __construct()
	{
		parent::__construct();
        $this->session->userdata("user_session");
	}	




	public function index() {	
		$this->load->view('logreg');
	}



	public function process()
	{
		$result = $this->user->validate_login($this->input->post());
    	if($result == "valid"){
			$get_user = $this->user->get_user($this->input->post());

			if($get_user){
				$this->session->set_userdata("user_session", $get_user);
				redirect(base_url("users/welcome"));
			}
		}else{	
			$errors = array(validation_errors());
			$this->session->set_flashdata('message', validation_errors());
			redirect(base_url('users'));
		}
	}




	public function add(){
		// var_dump($this->input->post());
		$result = $this->user->validate_register($this->input->post());
    	if($result == "valid"){
      		$user_data = $this->input->post();
			$add_user = $this->user->add_user($user_data);

			if($add_user){
				$this->session->set_userdata("user_session", $user_data);
				redirect(base_url());
			}
		}else{
			$errors = array(validation_errors());
			$this->session->set_flashdata('message', validation_errors());
			redirect(base_url('users'));
		}
	}



	public function logout()
	{
		$user_session_data = $this->session->all_userdata();
		
		foreach($user_session_data as $key)
		{
			$this->session->unset_userdata($key);
		}
		
		$this->session->sess_destroy();
		redirect(base_url());
	}

}