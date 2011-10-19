<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

require_once('PasswordHash.php');

class User_model extends CI_Model {

	public function create() {
    $hasher = new PasswordHash(8, false);
    $hashedPassword = $hasher->HashPassword($this->input->post('password'));
    if (strlen($hashedPassword) < 20) {
      return false;
    }
  
		$new_user_data = array(
			'username' => $this->input->post('first_name').$this->input->post('last_name'),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),			
			'password' => $hashedPassword
		);
		$insert = $this->db->insert('users', $new_user_data);
		return $insert;
	}

	function validate() {
		$this->db->where('username', $this->input->post('username'));
		$query = $this->db->get('users');   
    
		if($query->num_rows == 1) {
      $hasher = new PasswordHash(8, false);
      $hasher->CheckPassword($this->input->post('password'), $query->row(0)->password);
			return $hasher;
		}
		return false;
	}
  
}