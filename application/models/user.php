<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Model{
	


  	public function validate_login($post){
  		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|md5');
		
		if($this->form_validation->run()){
			return "valid";	        
        }else{
        	return array(validation_errors()); 
        }
	}


	public function validate_register($post){

		$this->form_validation->set_rules('screenname', 'Screen Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[confirm_password]|md5');
		$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|min_length[8]|md5');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('country', 'Country', 'required');
	

		if($this->form_validation->run()){
			return "valid";	        
        }else{
        	return array(validation_errors()); 
        }
	}



	function add_user($users) {
		$query = "INSERT INTO user (screenname, email, password, city, state, country, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())";
		$values = array($users['screenname'], $users['email'], $users['password'], $users['city'], $users['state'], $users['country']);
		return $this->db->query($query, $values);
	}




    function get_user($user_info){
        return $this->db->query("SELECT * FROM user WHERE email = '{$user_info['email']}' AND password = '{$user_info['password']}'")->row_array();
	}

	Function get_location(){
    $query = $this->db->query('SELECT * FROM user');
    return $query->result_array();
    }

    Function distinct_country(){
        $query = $this->db->query("SELECT DISTINCT country FROM user");
        return $query->result_array();
    }

    Function view_user_by_id($id){
        $query = ('SELECT * FROM user WHERE id = ?');
        return $this->db->query($query, $id)->row_array();
    }
}